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
namespace Module\Portfolio\Block;

use Pi;

class Block
{
    public static function projectList($options = array(), $module = null)
    {
        // Set options
        $block = array();
        $block = array_merge($block, $options);
        // Set info
        $order = array(new \Zend\Db\Sql\Predicate\Expression('RAND()'));
        $where = array('status' => 1,);
        $limit = intval($options['number']);
        $project = array();
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

    }
}