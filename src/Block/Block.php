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
use Zend\Db\Sql\Predicate\Expression;

class Block
{
    public static function projectList($options = array(), $module = null)
    {
        // Set options
        $block = array();
        $block = array_merge($block, $options);
        // Set info
        $where = array('status' => 1,);
        $limit = intval($options['number']);
        $project = array();
        // Set order
        switch ($block['order']) {
            case 'random':
                $order = array(new Expression('RAND()'));
                break;

            case 'updateASC':
                $order = array('time_update ASC', 'id ASC');;
                break;

            case 'updateDESC':
                $order = array('time_update DESC', 'id DESC');;
                break;

            case 'createASC':
                $order = array('time_create ASC', 'id ASC');;
                break;

            case 'createDESC':
            default:
                $order = array('time_create DESC', 'id DESC');;
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
        foreach ($rowset as $row) {
            $project[$row->id] = Pi::api('project', 'portfolio')->canonizeProject($row);
        }
        $block['resources'] = $project;
        return $block;
    }

    public static function projectComment($options = array(), $module = null)
    {
        // Set options
        $block = array();
        $block = array_merge($block, $options);

        return $block;
    }
}