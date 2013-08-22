<?php
/**
 * Portfolio admin Project controller
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Copyright (c) Pi Engine http://www.xoopsengine.org
 * @license         http://www.xoopsengine.org/license New BSD License
 * @author          Hossein Azizabadi <azizabadi@faragostaresh.com>
 * @since           3.0
 * @package         Module\Portfolio
 * @version         $Id$
 */

namespace Module\Portfolio\Controller\Admin;

use Pi;
use Pi\Mvc\Controller\ActionController;
use Pi\File\Transfer\Upload;
use Module\Portfolio\Form\ProjectForm;
use Module\Portfolio\Form\ProjectFilter;

class ProjectController extends ActionController
{
    protected $ImagePrefix = 'image_';
    protected $projectColumns = array(
        'id', 'title', 'slug', 'type', 'technology', 'website', 'information', 'keywords', 'description',
        'create', 'delivery', 'author', 'hits', 'image', 'path', 'status', 'commentby', 'comment'
    );

    public function indexAction()
    {
        // Get page
        $page = $this->params('p', 1);
        $module = $this->params('module');
        // Get info
        $select = $this->getModel('project')->select()->order(array('id DESC', 'create DESC'));
        $rowset = $this->getModel('project')->selectWith($select);
        // Make list
        foreach ($rowset as $row) {
            $project[$row->id] = $row->toArray();
            $project[$row->id]['url'] = $this->url('.portfolio', array('action' => 'project', 'project' => $project[$row->id]['slug']));
            $project[$row->id]['thumburl'] = Pi::url('/upload/' . $this->config('image_path') . '/thumb/' . $project[$row->id]['path'] . '/' . $project[$row->id]['image']);
        }
        // Go to update page if empty
        if (empty($project)) {
            return $this->redirect()->toRoute('', array('action' => 'update'));
        }
        // Set paginator
        $paginator = \Pi\Paginator\Paginator::factory($project);
        $paginator->setItemCountPerPage($this->config('admin_perpage'));
        $paginator->setCurrentPageNumber($page);
        $paginator->setUrlOptions(array(
            // Use router to build URL for each page
            'pageParam' => 'p',
            'totalParam' => 't',
            'router' => $this->getEvent()->getRouter(),
            'route' => $this->getEvent()->getRouteMatch()->getMatchedRouteName(),
            'params' => array(
                'module' => $this->getModule(),
                'controller' => 'project',
                'action' => 'index',
            ),
        ));
        // Set view
        $this->view()->setTemplate('project_index');
        $this->view()->assign('projects', $paginator);
    }

    public function updateAction()
    {
        // Get id
        $id = $this->params('id');
        $module = $this->params('module');
        // Set form
        $form = new ProjectForm('project');
        $form->setAttribute('enctype', 'multipart/form-data');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $file = $this->request->getFiles();

			/*
			 *  Start Check slug
			 */
			// Set option
			$options = array();
			if(isset($data['id']) && !empty($data['id'])) {
				$options['id'] = $data['id'];
			}
			// Set slug
            $slug = ($data['slug']) ? $data['slug'] : $data['title'];
			$slug = _strip($slug);
			$slug = strtolower(trim($slug));
			$slug = array_filter(explode(' ', $slug));
			$data['slug'] = implode('-', $slug);
			/*
			 *  End Check slug
			 */			
			
            $form->setInputFilter(new ProjectFilter($options));
            $form->setData($data);
            if ($form->isValid()) {
                $values = $form->getData();
                // upload image
                if (!empty($file['image']['name'])) {
                    // Set path
                    $values['path'] = date('Y') . '/' . date('m');
                    $original_path = $this->config('image_path') . '/original/' . $values['path'];
                    $large_path = $this->config('image_path') . '/large/' . $values['path'];
                    $medium_path = $this->config('image_path') . '/medium/' . $values['path'];
                    $thumb_path = $this->config('image_path') . '/thumb/' . $values['path'];
                    // Do upload
                    $uploader = new Upload(array('destination' => $original_path, 'rename' => $this->ImagePrefix . '%random%'));
                    $uploader->setExtension($this->config('image_extension'));
                    $uploader->setSize($this->config('image_size'));
                    if ($uploader->isValid()) {
                        $uploader->receive();
                        // Get image name
                        $values['image'] = $uploader->getUploaded('image');
                        // Resize
                        Pi::service('api')->portfolio(array('Resize', 'start'), $values['image'], $original_path, $large_path, $this->config('image_largew'), $this->config('image_largeh'));
                        Pi::service('api')->portfolio(array('Resize', 'start'), $values['image'], $original_path, $medium_path, $this->config('image_mediumw'), $this->config('image_mediumh'));
                        Pi::service('api')->portfolio(array('Resize', 'start'), $values['image'], $original_path, $thumb_path, $this->config('image_thumbw'), $this->config('image_thumbh'));
                    } else {
                        $this->jump(array('action' => 'update'), __('Problem in upload image. please try again'));
                    }
                } else {
                    $values['image'] = '';
                }
                // Set just story fields
                foreach (array_keys($values) as $key) {
                    if (!in_array($key, $this->projectColumns)) {
                        unset($values[$key]);
                    }
                }
                // Set time
                if (empty($values['id'])) {
                    $values['create'] = time();
                }
                // Set user
                if (empty($values['id'])) {
                    $values['author'] = Pi::registry('user')->id;
                }
                // Set keywords
                $keywords = ($values['keywords']) ? $values['keywords'] : $values['title'];
				$keywords = _strip($keywords);
				$keywords = strtolower(trim($keywords));
                $keywords = array_unique(array_filter(explode(' ', $keywords)));
                $values['keywords'] = implode(',', $keywords);
                // Set description
                $description = ($values['description']) ? $values['description'] : $values['title'];
				$description = _strip($description);
				$description = strtolower(trim($description));
                $values['description'] = preg_replace('/[\s]+/', ' ', $description);
                // Save values
                if (!empty($values['id'])) {
                    $row = $this->getModel('project')->find($values['id']);
                } else {
                    $row = $this->getModel('project')->createRow();
                }
                $row->assign($values);
                $row->save();
                // Check it save or not
                if ($row->id) {
                    $message = __('Project data saved successfully.');
                    $url = array('action' => 'index');
                    $this->jump($url, $message);
                } else {
                    $message = __('Project data not saved.');
                }
            } else {
                $message = __('Invalid data, please check and re-submit.');
            }
        } else {
            if ($id) {
                $values = $this->getModel('project')->find($id)->toArray();
                $form->setData($values);
                $message = 'You can edit this project';
            } else {
                $message = 'You can add new project';
            }
        }
        $this->view()->setTemplate('project_update');
        $this->view()->assign('form', $form);
        $this->view()->assign('title', __('Add a Project'));
        $this->view()->assign('message', $message);
    }
}