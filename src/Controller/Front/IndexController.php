<?php
/**
 * Pi Engine (http://pialog.org)
 *
 * @link            http://code.pialog.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://pialog.org
 * @license         http://pialog.org/license.txt New BSD License
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
        $page = $this->params('page', 1);
        // Get config
        $config = Pi::service('registry')->config->read($module);
        // Set info
        $where = array('status' => 1);
        $order = array('id DESC', 'time_create DESC');
        $offset = (int)($page - 1) * $this->config('show_perpage');
        $limit = intval($this->config('show_perpage'));
        // Get info
        $select = $this->getModel('project')->select()->where($where)->order($order)->offset($offset)->limit($limit);
        $rowset = $this->getModel('project')->selectWith($select);
        // Make list
        foreach ($rowset as $row) {
            $project[$row->id] = Pi::api('project', 'portfolio')->canonizeProject($row);
        }
        // get count     
        $columns = array('count' => new Expression('count(*)'));
        $select = $this->getModel('project')->select()->where($where)->columns($columns);
        $count = $this->getModel('project')->selectWith($select)->current()->count;
        // paginator
        $paginator = Paginator::factory(intval($count));
        $paginator->setItemCountPerPage(intval($limit));
        $paginator->setCurrentPageNumber(intval($page));
        $paginator->setUrlOptions(array(
            'router'    => $this->getEvent()->getRouter(),
            'route'     => $this->getEvent()->getRouteMatch()->getMatchedRouteName(),
            'params'    => array_filter(array(
                'module'        => $this->getModule(),
                'controller'    => 'index',
                'action'        => 'index',
            )),
        ));
        // Set view
        $this->view()->setTemplate('project-list');
        $this->view()->assign('projects', $project);
        $this->view()->assign('paginator', $paginator);
        $this->view()->assign('config', $config);
        $this->view()->assign('title', __('List of our projects'));
    }
}