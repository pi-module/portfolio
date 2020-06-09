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

namespace Module\Portfolio\Block;

use Pi;
use Laminas\Db\Sql\Predicate\Expression;

class Block
{
    public static function projectList($options = [], $module = null)
    {
        // Set options
        $block = [];
        $block = array_merge($block, $options);

        // Set info
        $where   = ['status' => 1,];
        $limit   = intval($options['number']);
        $project = [];

        // Set order
        switch ($block['order']) {
            case 'random':
                $order = [new Expression('RAND()')];
                break;

            case 'updateASC':
                $order = ['time_update ASC', 'id ASC'];;
                break;

            case 'updateDESC':
                $order = ['time_update DESC', 'id DESC'];;
                break;

            case 'createASC':
                $order = ['time_create ASC', 'id ASC'];;
                break;

            case 'createDESC':
            default:
                $order = ['time_create DESC', 'id DESC'];;
                break;
        }

        // Check recommended
        if ($block['recommended']) {
            $where['recommended'] = 1;
        }

        // Check
        if ($block['type'] > 0) {
            $where['type'] = $block['type'];
        }

        // Get list of project
        $select = Pi::model('project', $module)->select()->where($where)->order($order)->limit($limit);
        $rowset = Pi::model('project', $module)->selectWith($select);

        // Make list
        foreach ($rowset as $row) {
            $project[$row->id] = Pi::api('project', 'portfolio')->canonizeProject($row);
        }

        $block['resources'] = $project;
        return $block;
    }

    public static function projectComment($options = [], $module = null)
    {
        // Set options
        $block = [];
        $block = array_merge($block, $options);

        return $block;
    }
}