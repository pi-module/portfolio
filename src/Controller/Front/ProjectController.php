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

class ProjectController extends ActionController
{
    public function indexAction()
    {
        // Get info from url
        $slug = $this->params('slug');
        $module = $this->params('module');
        // Get Module Config
        $config = Pi::service('registry')->config->read($module);
        // Find project
        $project = Pi::api('project', 'portfolio')->getProject($slug, 'slug');
        // Check status
        if (!$project || $project['status'] != 1) {
            $this->jump(array('', 'module' => $module, 'controller' => 'index'), __('The project not found.'));
        }
        // Update Hits
        $this->getModel('project')->increment('hits', array('id' => $project['id']));
        // Set tag
        if ($config['show_tag'] && Pi::service('module')->isActive('tag')) {
            $tag = Pi::service('tag')->get($module, $project['id'], '');
            $this->view()->assign('tag', $tag);  
        }
        // Set view
        $this->view()->headTitle($project['seo_title']);
        $this->view()->headdescription($project['seo_description'], 'set');
        $this->view()->headkeywords($project['seo_keywords'], 'set');
        $this->view()->setTemplate('project_index');
        $this->view()->assign('project', $project);
        $this->view()->assign('config', $config);
    }
}	