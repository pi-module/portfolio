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
                'action'        => 'tag',
                'slug'          => $slug,
            )),
        ));
        // Set header and title
        $title = sprintf(__('All projects by %s tag'), $slug);
        $seoTitle = Pi::api('text', 'portfolio')->title($title);
        $seoDescription = Pi::api('text', 'portfolio')->description($title);
        $seoKeywords = Pi::api('text', 'portfolio')->keywords($title);
        // Set view
        $this->view()->setTemplate('index_index');
        $this->view()->headTitle($seoTitle);
        $this->view()->headDescription($seoDescription, 'set');
        $this->view()->headKeywords($seoKeywords, 'set');
        $this->view()->assign('projects', $project);
        $this->view()->assign('paginator', $paginator);
        $this->view()->assign('config', $config);
    }
}	