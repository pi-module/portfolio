<?php
/**
 * Pi Engine (http://piengine.org)
 *
 * @link            http://code.piengine.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://piengine.org
 * @license         http://piengine.org/license.txt New BSD License
 */

/**
 * @author Hossein Azizabadi <azizabadi@faragostaresh.com>
 */

namespace Module\Portfolio\Controller\Admin;

use Pi;
use Pi\Filter;
use Pi\Mvc\Controller\ActionController;
use Pi\Paginator\Paginator;
use Pi\File\Transfer\Upload;
use Zend\Db\Sql\Predicate\Expression;
use Module\Portfolio\Form\ProjectForm;
use Module\Portfolio\Form\ProjectFilter;

class ProjectController extends ActionController
{
    protected $ImagePrefix = 'project-';

    public function indexAction()
    {
        // Get page
        $page = $this->params('page', 1);

        // Get info
        $list   = [];
        $order  = ['id DESC', 'time_create DESC'];
        $offset = (int)($page - 1) * $this->config('admin_perpage');
        $limit  = intval($this->config('admin_perpage'));
        $where  = ['status' => [1, 2, 3, 4]];

        // Select
        $select = $this->getModel('project')->select()->where($where)->order($order)->offset($offset)->limit($limit);
        $rowset = $this->getModel('project')->selectWith($select);

        // Make list
        foreach ($rowset as $row) {
            $list[$row->id] = Pi::api('project', 'portfolio')->canonizeProject($row);
        }

        // Set count
        $columns = ['count' => new Expression('count(*)')];
        $select  = $this->getModel('project')->select()->columns($columns);
        $count   = $this->getModel('project')->selectWith($select)->current()->count;

        // Set paginator
        $paginator = Paginator::factory(intval($count));
        $paginator->setItemCountPerPage($this->config('admin_perpage'));
        $paginator->setCurrentPageNumber($page);
        $paginator->setUrlOptions(
            [
                'router' => $this->getEvent()->getRouter(),
                'route'  => $this->getEvent()->getRouteMatch()->getMatchedRouteName(),
                'params' => array_filter(
                    [
                        'module'     => $this->getModule(),
                        'controller' => 'project',
                        'action'     => 'index',
                    ]
                ),
            ]
        );

        // Set view
        $this->view()->setTemplate('project-index');
        $this->view()->assign('projects', $list);
        $this->view()->assign('paginator', $paginator);
    }

    public function updateAction()
    {
        // Get id
        $id     = $this->params('id');
        $module = $this->params('module');

        // Set option
        $option = [
            'id' => $id,
        ];

        // Set form
        $form = new ProjectForm('project', $option);
        $form->setAttribute('enctype', 'multipart/form-data');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();

            // Set slug
            $slug         = ($data['slug']) ? $data['slug'] : $data['title'];
            $filter       = new Filter\Slug;
            $data['slug'] = $filter($slug);

            // Form filter
            $form->setInputFilter(new ProjectFilter($option));
            $form->setData($data);
            if ($form->isValid()) {
                $values = $form->getData();

                // Tag
                if (!empty($values['tag'])) {
                    $tag = explode('|', $values['tag']);
                }

                // Set seo_title
                $title               = ($values['seo_title']) ? $values['seo_title'] : $values['title'];
                $filter              = new Filter\HeadTitle;
                $values['seo_title'] = $filter($title);

                // Set seo_keywords
                $keywords = ($values['seo_keywords']) ? $values['seo_keywords'] : $values['title'];
                $filter   = new Filter\HeadKeywords;
                $filter->setOptions(
                    [
                        'force_replace_space' => (bool)$this->config('force_replace_space'),
                    ]
                );
                $values['seo_keywords'] = $filter($keywords);

                // Set seo_description
                $description               = ($values['seo_description']) ? $values['seo_description'] : $values['title'];
                $filter                    = new Filter\HeadDescription;
                $values['seo_description'] = $filter($description);

                // Set time
                if (empty($id)) {
                    $values['time_create'] = time();
                    $values['uid']         = Pi::user()->getId();
                }
                $values['time_update'] = time();

                // Save values
                if (!empty($id)) {
                    $row = $this->getModel('project')->find($id);
                } else {
                    $row = $this->getModel('project')->createRow();
                }
                $row->assign($values);
                $row->save();

                // Tag
                if (isset($tag) && is_array($tag) && Pi::service('module')->isActive('tag')) {
                    if (empty($id)) {
                        Pi::service('tag')->add($module, $row->id, '', $tag);
                    } else {
                        Pi::service('tag')->update($module, $row->id, '', $tag);
                    }
                }

                // Add / Edit sitemap
                if (Pi::service('module')->isActive('sitemap')) {
                    // Set loc
                    $loc = Pi::url(
                        $this->url(
                            'portfolio', [
                                'module'     => $module,
                                'controller' => 'project',
                                'slug'       => $values['slug'],
                            ]
                        )
                    );

                    // Update sitemap
                    Pi::api('sitemap', 'sitemap')->singleLink($loc, $row->status, $module, 'project', $row->id);
                }

                // Jump
                $message = __('Project data saved successfully.');
                $url     = ['action' => 'index'];
                $this->jump($url, $message);
            }
        } else {
            if ($id) {
                $values = $this->getModel('project')->find($id)->toArray();

                // Get tag list
                if (Pi::service('module')->isActive('tag')) {
                    $tag = Pi::service('tag')->get($module, $id, '');
                    if (is_array($tag)) {
                        $values['tag'] = implode('|', $tag);
                    }
                }

                // Set data
                $form->setData($values);
            }
        }
        $this->view()->setTemplate('project-update');
        $this->view()->assign('form', $form);
        $this->view()->assign('title', __('Manage Project'));
    }

    public function recommendAction()
    {
        // Get id and recommended
        $id          = $this->params('id');
        $recommended = $this->params('recommended');
        $return      = [];

        // set project
        $project = $this->getModel('project')->find($id);

        // Check
        if ($project && in_array($recommended, [0, 1])) {

            // Accept
            $project->recommended = $recommended;
            $project->time_update = time();

            // Save
            if ($project->save()) {
                $return['message']     = sprintf(__('%s set recommended successfully'), $project->title);
                $return['ajaxstatus']  = 1;
                $return['id']          = $project->id;
                $return['recommended'] = $project->recommended;
            } else {
                $return['message']     = sprintf(__('Error in set recommended for %s project'), $project->title);
                $return['ajaxstatus']  = 0;
                $return['id']          = 0;
                $return['recommended'] = $project->recommended;
            }
        } else {
            $return['message']     = __('Please select project');
            $return['ajaxstatus']  = 0;
            $return['id']          = 0;
            $return['recommended'] = 0;
        }
        return $return;
    }

    public function deleteAction()
    {
        // Get information
        $this->view()->setTemplate(false);
        $module = $this->params('module');
        $id     = $this->params('id');
        $row    = $this->getModel('project')->find($id);
        if ($row) {
            $row->status = 5;
            $row->save();
            // Remove sitemap
            if (Pi::service('module')->isActive('sitemap')) {
                $loc = Pi::url(
                    $this->url(
                        'portfolio', [
                            'module'     => $module,
                            'controller' => 'project',
                            'slug'       => $row->slug,
                        ]
                    )
                );
                Pi::api('sitemap', 'sitemap')->remove($loc);
            }
            // Remove page
            $this->jump(['action' => 'index'], __('This project deleted'));
        }
        $this->jump(['action' => 'index'], __('Please select project'));
    }
}