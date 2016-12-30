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
        'name' => 'project-list',
        'title' => _a('Project list'),
        'description' => '',
        'render' => array('block', 'projectList'),
        'template' => 'project-list',
        'config' => array(
            'type' => array(
                'title' => _a('Project type'),
                'description' => '',
                'edit' => 'Module\Portfolio\Form\Element\Type',
                'filter' => 'string',
                'value' => 0,
            ),
            'number' => array(
                'title' => _a('Number'),
                'description' => '',
                'edit' => 'text',
                'filter' => 'number_int',
                'value' => 4,
            ),
            'recommended' => array(
                'title' => _a('Show just recommended'),
                'description' => '',
                'edit' => 'checkbox',
                'filter' => 'number_int',
                'value' => 0,
            ),
            'order' => array(
                'title' => _a('Project order'),
                'description' => _a('Project list order options'),
                'edit' => array(
                    'type' => 'select',
                    'options' => array(
                        'options' => array(
                            'createDESC' => _a('Create time DESC'),
                            'createhASC' => _a('Create time ASC'),
                            'updateDESC' => _a('Update time DESC'),
                            'updateASC' => _a('Update time ASC'),
                            'random' => _a('Random'),
                        ),
                    ),
                ),
                'filter' => 'text',
                'value' => 'createDESC',
            ),
            'blockEffect' => array(
                'title' => _a('Use block effects'),
                'description' => _a('Use block effects or set custom effect on theme'),
                'edit' => 'checkbox',
                'filter' => 'number_int',
                'value' => 1,
            ),
        ),
    ),
    'project-comment' => array(
        'name' => 'project-comment',
        'title' => _a('Project Comment'),
        'description' => '',
        'render' => array('block', 'projectComment'),
        'template' => 'project-comment',
    ),
);