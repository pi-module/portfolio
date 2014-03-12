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
return array(
    'project-list' => array(
        'name'          => 'project-list',
        'title'         => _b('Project list'),
        'description'   => '',
        'render'        => array('block', 'projectList'),
        'template'      => 'project_list',
        'config'        => array(
            'number' => array(
                'title' => _b('Number'),
                'description' => '',
                'edit' => 'text',
                'filter' => 'number_int',
                'value' => 10,
            ),
            'effect' => array(
                'title' => _b('Use effect ?'),
                'description' => '',
                'edit' => 'checkbox',
                'filter' => 'number_int',
                'value' => 0,
            ),
        ),
    ),
    'project-comment' => array(
        'name'          => 'project-comment',
        'title'         => _b('Project Comment'),
        'description'   => '',
        'render'        => array('block', 'projectComment'),
        'template'      => 'project_comment',
    ),
);