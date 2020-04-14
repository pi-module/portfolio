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
use Pi\Mvc\Controller\ActionController;
use Pi\Paginator\Paginator;
use Zend\Db\Sql\Predicate\Expression;

class IndexController extends ActionController
{
    public function indexAction()
    {
        // Get info from url
        $module = $this->params('module');
        $page   = $this->params('page', 1);

        // Get config
        $config = Pi::service('registry')->config->read($module);

        // Set template
        switch ($config['view_type']) {
            default:
            case 'normal':
            case 'angular':
                $where  = ['status' => 1];
                $order  = ['time_create DESC', 'id DESC'];
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
                                'controller' => 'index',
                                'action'     => 'index',
                            ]
                        ),
                    ]
                );

                // Set view
                $this->view()->setTemplate('project-list');
                $this->view()->assign('paginator', $paginator);
                break;

            case 'single':
                $where = ['status' => 1];
                $order = ['time_create DESC', 'id DESC'];

                // Get info
                $select = $this->getModel('project')->select()->where($where)->order($order);
                $rowset = $this->getModel('project')->selectWith($select);

                // Make list
                foreach ($rowset as $row) {
                    $project[$row->id] = Pi::api('project', 'portfolio')->canonizeProject($row);
                }

                // Set view
                $this->view()->setTemplate('project-gallery');
                break;
        }

        // Get type list
        $typeList = Pi::api('type', 'portfolio')->getList(['set_all' => 1]);

        // Set title
        $title = !empty($config['homepage_title']) ? $config['homepage_title'] : __('List of our projects');

        // Set view
        $this->view()->assign('projects', $project);
        $this->view()->assign('config', $config);
        $this->view()->assign('title', $title);
        $this->view()->assign('typeList', $typeList);
    }
}