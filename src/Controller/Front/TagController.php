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
use Zend\Db\Sql\Predicate\Expression;

class TagController extends ActionController
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
            $this->jump($url, __('The tag not set.'), 'error');
        }
        // Get id from tag module
        $tagId = array();
        $tags = Pi::service('tag')->getList($slug, $module);
        foreach ($tags as $tag) {
            $tagId[] = $tag['item'];
        }
        // Check slug
        if (empty($tagId)) {
            $url = array('', 'module' => $module, 'controller' => 'index', 'action' => 'index');
            $this->jump($url, __('The tag not found.'), 'error');
        }
        // Set info
        $where = array('status' => 1, 'id' => $tagId);
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
            'router' => $this->getEvent()->getRouter(),
            'route' => $this->getEvent()->getRouteMatch()->getMatchedRouteName(),
            'params' => array_filter(array(
                'module' => $this->getModule(),
                'controller' => 'index',
                'action' => 'tag',
                'slug' => $slug,
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
            $typeList[$row->id]['active'] = 0;
            $typeList[$row->id]['typeUrl'] = Pi::url($this->url('', array(
                'module'        => $this->getModule(),
                'controller'    => 'type',
                'action'        => 'index',
                'slug'          => $row->slug,
            )));
        }
        // Set header and title
        $title = sprintf(__('All projects by %s tag'), $slug);
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
        $this->view()->assign('title', $slug);
        $this->view()->assign('typeList', $typeList);
    }
}