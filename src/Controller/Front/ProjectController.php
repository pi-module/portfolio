<?php
/**
 * Portfolio project controller
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

namespace Module\Portfolio\Controller\Front;

use Pi;
use Pi\Mvc\Controller\ActionController;

class ProjectController extends ActionController
{
    public function indexAction()
    {
        // Get page ID or slug from url
        $params = $this->params()->fromRoute();
        // Get config
        $config = Pi::service('registry')->config->read($params['module']);
        // check
        if (empty($params['project'])) {
            $this->jump(array('route' => '.portfolio', 'controller' => 'index'), __('The Project not found.'));
        }
        // Find project
        $project = $this->getModel('project')->find($params['project'], 'slug');
        if (empty($project)) {
            $this->jump(array('route' => '.portfolio', 'controller' => 'index'), __('The Project not set.'));
        }
        // toArray
        $project = $project->toArray();
        // Update Hits
        $this->getModel('project')->update(array('hits' => $project['hits'] + 1), array('id' => $project['id']));
        // Set parameters
        $project['mediumurl'] = Pi::url('/upload/' . $this->config('image_path') . '/medium/' . $project['path'] . '/' . $project['image']);
        $project['delivery'] = date('Y/m/d', $project['delivery']);
        // Set view
        $this->view()->headTitle($project['title']);
        $this->view()->headDescription($project['keywords'], 'set');
        $this->view()->headKeywords($project['description'], 'set');
        $this->view()->setTemplate('project_index');
        $this->view()->assign('project', $project);
        $this->view()->assign('config', $config);
    }
}	