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
 * Pi::api('project', 'portfolio')->getProjectList($options);
 * Pi::api('project', 'portfolio')->getListFromId($id);
 * Pi::api('project', 'portfolio')->canonizeProject($project);
 * Pi::api('project', 'portfolio')->related($id, $type);
 * Pi::api('project', 'portfolio')->migrateMedia();
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

    public function getProjectList($options)
    {
        // Get config
        $config = Pi::service('registry')->config->read($this->getModule());

        // Set
        $projectList = array();

        // Set
        $where = array('status' => 1);
        $order = array('time_create DESC', 'id DESC');
        $offset = (int)($options['page'] - 1) * $config['view_perpage'];
        $limit = intval($config['view_perpage']);

        // Get info
        $select = Pi::model('project', $this->getModule())->select()->where($where)->order($order)->offset($offset)->limit($limit);
        $rowset = Pi::model('project', $this->getModule())->selectWith($select);
        // Make list
        foreach ($rowset as $row) {
            $projectList[] = $this->canonizeProject($row);
        }

        return $projectList;
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
        // boject to array
        $project = $project->toArray();
        // Set times
        $project['time_create_view'] = _date($project['time_create']);
        $project['time_update_view'] = _date($project['time_update']);
        // Set project url
        $project['projectUrl'] = Pi::url(Pi::service('url')->assemble('portfolio', array(
            'module' => $this->getModule(),
            'controller' => 'project',
            'action' => 'index',
            'slug' => $project['slug'],
        )));
        // Set text
        $project['text_description'] = Pi::service('markup')->render($project['text_description'], 'html', 'html');

        // Set image
        if ($project['main_image']) {
            $project['largeUrl'] = Pi::url((string)Pi::api('doc', 'media')->getSingleLinkUrl($project['main_image'])->setConfigModule('portfolio')->thumb('large'));
            $project['mediumUrl'] = Pi::url((string)Pi::api('doc', 'media')->getSingleLinkUrl($project['main_image'])->setConfigModule('portfolio')->thumb('medium'));
            $project['thumbUrl'] = Pi::url((string)Pi::api('doc', 'media')->getSingleLinkUrl($project['main_image'])->setConfigModule('portfolio')->thumb('thumbnail'));
        } else {
            $project['largeUrl'] = '';
            $project['mediumUrl'] = '';
            $project['thumbUrl'] = '';
        }

        // Set ribbon
        $project['ribbon'] = '';
        if ($project['recommended']) {
            $project['ribbon'] = __('Recommended');
        }
        // return project
        return $project;
    }

    public function related($id, $type)
    {
        $list = array();
        $order = array('id DESC', 'time_create DESC');
        $limit = 20;
        $where = array('type' => $type, 'status' => 1, 'id <> ?' => $id);
        $select = Pi::model('project', $this->getModule())->select()->where($where)->order($order)->limit($limit);
        $rowset = Pi::model('project', $this->getModule())->selectWith($select);
        foreach ($rowset as $row) {
            $list[$row->id] = $this->canonizeProject($row);
        }
        return $list;
    }

    public function migrateMedia()
    {
        if (Pi::service("module")->isActive("media")) {

            $msg = '';

            // Get config
            $config = Pi::service('registry')->config->read($this->getModule());

            $projectModel = Pi::model("project", $this->getModule());

            $select = $projectModel->select();
            $projectCollection = $projectModel->selectWith($select);

            foreach ($projectCollection as $project) {

                $toSave = false;

                $mediaData = array(
                    'active' => 1,
                    'time_created' => time(),
                    'uid' => $project->uid,
                    'count' => 0,
                );

                /**
                 * Check if media item have already migrate or no image to migrate
                 */
                if (!$project->main_image) {

                    /**
                     * Check if media item exists
                     */
                    if (empty($project["image"]) || empty($project["path"])) {

                        $draft = $project->status == 3 ? ' (' . __('Draft') . ')' : '';

                        $msg .= __("Missing image or path value from db for project ID") . " " . $project->id . $draft . "<br>";
                    } else {
                        $imagePath = sprintf("upload/%s/original/%s/%s",
                            $config["image_path"],
                            $project["path"],
                            $project["image"]
                        );

                        $mediaData['title'] = $project->title;
                        $mediaId = Pi::api('doc', 'media')->insertMedia($mediaData, $imagePath);

                        if ($mediaId) {
                            $project->main_image = $mediaId;
                            $toSave = true;
                        }
                    }
                }

                if ($toSave) {
                    $project->save();
                }
            }

            return $msg;
        }

        return false;
    }
}