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

namespace Module\Portfolio\Controller\Front;

use Pi;
use Pi\Filter;
use Pi\Mvc\Controller\ActionController;
use Pi\Paginator\Paginator;
use Laminas\Db\Sql\Predicate\Expression;

class TypeController extends ActionController
{
    public function indexAction()
    {
        // Get info from url
        $module = $this->params('module');
        $page   = $this->params('page', 1);
        $slug   = $this->params('slug');

        // Get config
        $config = Pi::service('registry')->config->read($module);

        // Check slug
        if (!isset($slug) || empty($slug)) {
            $url = ['', 'module' => $module, 'controller' => 'index', 'action' => 'index'];
            $this->jump($url, __('The type not set.'), 'error');
        }

        // Find project
        $type = $this->getModel('type')->find($slug, 'slug')->toArray();

        // Check status
        if (!$type || $type['status'] != 1) {
            $this->jump(['', 'module' => $module, 'controller' => 'index'], __('The type not found.'));
        }
        $type['text_description'] = Pi::service('markup')->render($type['text_description'], 'html', 'html');

        // Set info
        $where  = ['status' => 1, 'type' => $type['id']];
        $order  = ['id DESC', 'time_create DESC'];
        $offset = (int)($page - 1) * $this->config('view_perpage');
        $limit  = intval($this->config('view_perpage'));

        // Get info
        $select = $this->getModel('project')->select()->where($where)->order($order)->offset($offset)->limit($limit);
        $rowset = $this->getModel('project')->selectWith($select);

        // Make list
        foreach ($rowset as $row) {
            $project[$row->id] = Pi::api('project', 'portfolio')->canonizeProject($row);
        }

        // get count     
        $columns = ['count' => new Expression('count(*)')];
        $select  = $this->getModel('project')->select()->where($where)->columns($columns);
        $count   = $this->getModel('project')->selectWith($select)->current()->count;

        // paginator
        $paginator = Paginator::factory(intval($count));
        $paginator->setItemCountPerPage(intval($limit));
        $paginator->setCurrentPageNumber(intval($page));
        $paginator->setUrlOptions(
            [
                'router' => $this->getEvent()->getRouter(),
                'route'  => $this->getEvent()->getRouteMatch()->getMatchedRouteName(),
                'params' => array_filter(
                    [
                        'module'     => $this->getModule(),
                        'controller' => 'type',
                        'action'     => 'index',
                        'slug'       => $type['slug'],
                    ]
                ),
            ]
        );

        // Get type list
        $typeList = Pi::api('type', 'portfolio')->getList(['set_all' => 1, 'active_id' => $type['id']]);

        // Set seo_keywords
        $filter = new Filter\HeadKeywords;
        $filter->setOptions(
            [
                'force_replace_space' => true,
            ]
        );
        $seoKeywords = $filter($type['title']);

        // Set view
        $this->view()->headTitle($type['title']);
        $this->view()->headDescription($type['title'], 'set');
        $this->view()->headKeywords($seoKeywords, 'set');
        $this->view()->setTemplate('project-list');
        $this->view()->assign('projects', $project);
        $this->view()->assign('paginator', $paginator);
        $this->view()->assign('config', $config);
        $this->view()->assign('title', $type['title']);
        $this->view()->assign('type', $type);
        $this->view()->assign('typeList', $typeList);
    }
}