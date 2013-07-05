<?php
/**
 * Portfolio module block
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

return array(
    // Item block
    'project-list' => array(
        'title' => __('Project list'),
        'description' => '',
        'render' => array('block', 'project_list'),
        'template' => 'project_list',
        'config' => array(
            'number' => array(
                'title' => __('Number'),
                'description' => '',
                'edit' => 'text',
                'filter' => 'number_int',
                'value' => 4,
            ),
        ),
        'access' => array(
            'guest' => 1,
            'member' => 1,
        ),
    ),
    // Item block
    'project-comment' => array(
        'title' => __('Project Comment'),
        'description' => '',
        'render' => array('block', 'project_comment'),
        'template' => 'project_comment',
        'access' => array(
            'guest' => 1,
            'member' => 1,
        ),
    ),
);