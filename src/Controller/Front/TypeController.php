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
use Pi\Filter;
use Pi\Mvc\Controller\ActionController;
use Pi\Paginator\Paginator;
use Zend\Db\Sql\Predicate\Expression;

class TypeController extends ActionController
{
    public function indexAction()
    {
        // Get info from url
        $module = $this->params('module');
        $page = $this->params('page', 1);
        $slug = $this->params('slug');
        // Get config
        $config = Pi::service('registry')->config->read($module);
        // Check slug
        if (!isset($slug) || empty($slug)) {
            $url = array('', 'module' => $module, 'controller' => 'index', 'action' => 'index');
            $this->jump($url, __('The type not set.'), 'error');
        }
        // Find project
        $type = $this->getModel('type')->find($slug, 'slug')->toArray();
        // Check status
        if (!$type || $type['status'] != 1) {
            $this->jump(array('', 'module' => $module, 'controller' => 'index'), __('The type not found.'));
        }
        // Set info
        $where = array('status' => 1, 'type' => $type['id']);
        $order = array('id DESC', 'time_create DESC');
        $offset = (int)($page - 1) * $this->config('view_perpage');
        $limit = intval($this->config('view_perpage'));
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
                'controller'    => 'type',
                'action'        => 'index',
                'slug'          => $type['slug'],
            )),
        ));
        // Get type list
        $typeList = array();
        $where = array('status' => 1);
        $order = array('id DESC');
        // Get info
        $select = $this->getModel('type')->select()->where($where)->order($order);
        $rowset = $this->getModel('type')->selectWith($select);
        // Make list
        foreach ($rowset as $row) {
            $typeList[$row->id] = $row->toArray();
            $typeList[$row->id]['active'] = ($row->slug == $type['slug']) ? 1 : 0;
            $typeList[$row->id]['typeUrl'] = Pi::url($this->url('', array(
                'module'        => $this->getModule(),
                'controller'    => 'type',
                'action'        => 'index',
                'slug'          => $row->slug,
            )));
        }
        // Set header and title
        $title = sprintf(__('All projects by %s type'), $type['title']);
        // Set seo_keywords
        $filter = new Filter\HeadKeywords;
        $filter->setOptions(array(
            'force_replace_space' => true
        ));
        $seoKeywords = $filter($title);
        // Set view
        $this->view()->headTitle($title);
        $this->view()->headDescription($title, 'set');
        $this->view()->headKeywords($seoKeywords, 'set');
        $this->view()->setTemplate('project-list');
        $this->view()->assign('projects', $project);
        $this->view()->assign('paginator', $paginator);
        $this->view()->assign('config', $config);
        $this->view()->assign('title', $title);
        $this->view()->assign('typeList', $typeList);
    }
}