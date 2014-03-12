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
namespace Module\Portfolio\Api;

use Pi;
use Pi\Application\Api\AbstractApi;

/*
 * Pi::api('project', 'portfolio')->canonizeProject($keywords);
 */

class Project extends AbstractApi
{         
	public function canonizeProject($project = '') 
	{
        // Check
        if (empty($project)) {
            return '';
        }
        // Get config
        $config = Pi::service('registry')->config->read($this->getModule());
        // boject to array
        $project = $project->toArray();
        // Set times
        $project['time_create_view'] = _date($project['time_create']);
        $project['time_update_view'] = _date($project['time_update']);
        // Set project url
        $project['projectUrl'] = Pi::url(Pi::service('url')->assemble('portfolio', array(
            'module'        => $this->getModule(),
            'controller'    => 'project',
            'action'        => 'index',
            'slug'          => $project['slug'],
        )));
        // Set image url
        if ($project['image']) {
            // Set image original url
            $project['originalUrl'] = Pi::url(
                sprintf('upload/%s/original/%s/%s', 
                    $config['image_path'], 
                    $project['path'], 
                    $project['image']
                ));
            // Set image large url
            $project['largeUrl'] = Pi::url(
                sprintf('upload/%s/large/%s/%s', 
                    $config['image_path'], 
                    $project['path'], 
                    $project['image']
                ));
            // Set image medium url
            $project['mediumUrl'] = Pi::url(
                sprintf('upload/%s/medium/%s/%s', 
                    $config['image_path'], 
                    $project['path'], 
                    $project['image']
                ));
            // Set image thumb url
            $project['thumbUrl'] = Pi::url(
                sprintf('upload/%s/thumb/%s/%s', 
                    $config['image_path'], 
                    $project['path'], 
                    $project['image']
                ));
        }
        // return project
        return $project; 
	}     
}