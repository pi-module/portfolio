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
 * Pi::api('project', 'portfolio')->getProject($parameter, $type);
 * Pi::api('project', 'portfolio')->getListFromId($id);
 * Pi::api('project', 'portfolio')->canonizeProject($project);
 */

class Project extends AbstractApi
{         
    public function getProject($parameter, $type = 'id')
    {
        // Get project
        $project = Pi::model('project', $this->getModule())->find($parameter, $type);
        $project = $this->canonizeProject($project);
        return $project;
    }

    public function getListFromId($id)
    {
        $list = array();
        $where = array('id' => $id, 'status' => 1);
        $select = Pi::model('project', $this->getModule())->select()->where($where);
        $rowset = Pi::model('project', $this->getModule())->selectWith($select);
        foreach ($rowset as $row) {
            $list[$row->id] = $this->canonizeProject($row);
        }
        return $list;
    }

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

        $project['information'] = Pi::service('markup')->render($project['information'], 'html', 'html');

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
        // Set ribbon
        $project['ribbon'] = '';
        if ($project['recommended']) {
            $project['ribbon'] = __('Recommended');
        }
        // return project
        return $project; 
	}     
}