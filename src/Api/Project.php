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

namespace Module\Portfolio\Api;

use Pi;
use Pi\Application\Api\AbstractApi;
use Zend\Db\Sql\Predicate\Expression;

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
        return $this->canonizeProject($project);
    }

    public function getProjectList($params)
    {
        // Get config
        $config = Pi::service('registry')->config->read($this->getModule());

        // Set
        $projectList = [];

        // Set allowed fields
        $fields = [
            'id',
            'title',
            'slug',
            'type',
            'recommended',
            'text_description',
            'time_create',
            'time_update',
            'hits',
            'main_image',
            'additional_images',
            'status',
            'time_create_view',
            'time_update_view',
            'projectUrl',
            'largeUrl',
            'mediumUrl',
            'thumbUrl',
        ];

        // Set
        $order  = ['time_create DESC', 'id DESC'];
        $limit  = isset($params['limit']) ? $params['limit'] : intval($config['view_perpage']);
        $offset = (int)($params['page'] - 1) * $limit;

        // Set where
        $where = function ($where) use ($params) {
            $whereMain = clone $where;
            $whereKey  = clone $where;

            // Check status
            $whereMain->equalTo('status', 1);

            // Check recommended
            if (!empty($params['recommended']) && $params['recommended'] == 1) {
                $whereMain->equalTo('recommended', 1);
            }

            // Check type
            if (!empty($params['type']) && intval($params['type']) > 0) {
                $whereMain->equalTo('type', intval($params['type']));
            }

            // Set title
            if (isset($params['title']) && !empty($params['title'])) {
                if (Pi::service('module')->isActive('search')) {
                    $titles = Pi::api('api', 'search')->parseQuery($params['title']);
                    foreach ($titles as $title) {
                        $whereKey->like('title', '%' . $title . '%')->and;
                    }
                } else {
                    $whereKey->like('title', '%' . _strip($params['title']) . '%')->and;
                }

                $where->andPredicate($whereMain)->andPredicate($whereKey);
            } else {
                $where->andPredicate($whereMain);
            }
        };

        // Get info
        $select = Pi::model('project', $this->getModule())->select()->where($where)->order($order)->offset($offset)->limit($limit);
        $rowset = Pi::model('project', $this->getModule())->selectWith($select);

        // Make list
        foreach ($rowset as $row) {
            $projectSingle = $this->canonizeProject($row);

            // Clean
            foreach ($projectSingle as $key => $value) {
                if (!in_array($key, $fields)) {
                    unset($projectSingle[$key]);
                }
            }

            $projectList[$row->id] = $projectSingle;
        }

        // get count
        $columns = ['count' => new Expression('count(*)')];
        $select  = Pi::model('project', $this->getModule())->select()->where($where)->columns($columns);
        $count   = Pi::model('project', $this->getModule())->selectWith($select)->current()->count;

        // Set title
        $pageTitle = __('Project list');

        // Set result
        $result = [
            'projects'  => array_values($projectList),
            'paginator' => [
                'count' => $count,
                'limit' => $limit,
                'page'  => $params['page'],
            ],
            'condition' => [
                'title' => $pageTitle,
            ],
        ];

        return $result;
    }

    public function getListFromId($id)
    {
        $list   = [];
        $where  = ['id' => $id, 'status' => 1];
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
        $project['projectUrl'] = Pi::url(
            Pi::service('url')->assemble(
                'portfolio', [
                    'module'     => $this->getModule(),
                    'controller' => 'project',
                    'action'     => 'index',
                    'slug'       => $project['slug'],
                ]
            )
        );

        // Set text
        $project['text_description'] = Pi::service('markup')->render($project['text_description'], 'html', 'html');

        // Set image
        if ($project['main_image']) {
            $project['largeUrl']  = Pi::url(
                (string)Pi::api('doc', 'media')->getSingleLinkUrl($project['main_image'])->setConfigModule('portfolio')->thumb('large')
            );
            $project['mediumUrl'] = Pi::url(
                (string)Pi::api('doc', 'media')->getSingleLinkUrl($project['main_image'])->setConfigModule('portfolio')->thumb('medium')
            );
            $project['thumbUrl']  = Pi::url(
                (string)Pi::api('doc', 'media')->getSingleLinkUrl($project['main_image'])->setConfigModule('portfolio')->thumb('thumbnail')
            );
        } else {
            $project['largeUrl']  = '';
            $project['mediumUrl'] = '';
            $project['thumbUrl']  = '';
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
        $list   = [];
        $order  = ['id DESC', 'time_create DESC'];
        $limit  = 20;
        $where  = ['type' => $type, 'status' => 1, 'id <> ?' => $id];
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

            $select            = $projectModel->select();
            $projectCollection = $projectModel->selectWith($select);

            foreach ($projectCollection as $project) {

                $toSave = false;

                $mediaData = [
                    'active'       => 1,
                    'time_created' => time(),
                    'uid'          => $project->uid,
                    'count'        => 0,
                ];

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
                        $imagePath = sprintf(
                            "upload/%s/original/%s/%s",
                            $config["image_path"],
                            $project["path"],
                            $project["image"]
                        );

                        $mediaData['title'] = $project->title;
                        $mediaId            = Pi::api('doc', 'media')->insertMedia($mediaData, $imagePath);

                        if ($mediaId) {
                            $project->main_image = $mediaId;
                            $toSave              = true;
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