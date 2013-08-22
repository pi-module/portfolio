<?php
/**
 * Portfolio block class
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

namespace Module\Portfolio;

use Pi;

class Block
{
    public static function project_list($options = array(), $module = null)
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
            $project[$row->id] = $row->toArray();
            $project[$row->id]['thumburl'] = Pi::url('/upload/portfolio/thumb/' . $project[$row->id]['path'] . '/' . $project[$row->id]['image']);
            $project[$row->id]['mediumurl'] = Pi::url('/upload/portfolio/medium/' . $project[$row->id]['path'] . '/' . $project[$row->id]['image']);
        }
        $block['resources'] = $project;
        return $block;
    }

    public static function project_comment($options = array(), $module = null)
    {

    }
}