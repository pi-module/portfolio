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
return [
    'project-list'    => [
        'name'        => 'project-list',
        'title'       => _a('Project list'),
        'description' => '',
        'render'      => ['block', 'projectList'],
        'template'    => 'project-list',
        'config'      => [
            'list-type'   => [
                'title'       => _a('Project list type'),
                'description' => '',
                'edit'        => [
                    'type'    => 'select',
                    'options' => [
                        'options' => [
                            'horizontal' => _a('Horizontal'),
                            'slide'      => _a('Slide'),
                            'gallery'    => _a('Gallery'),
                        ],
                    ],
                ],
                'filter'      => 'text',
                'value'       => 'horizontal',
            ],
            'column'      => [
                'title'       => _a('Columns'),
                'description' => '',
                'edit'        => [
                    'type'    => 'select',
                    'options' => [
                        'options' => [
                            1 => _a('One columns'),
                            2 => _a('Two columns'),
                            3 => _a('Three columns'),
                            4 => _a('Four columns'),
                            6 => _a('Six columns'),
                        ],
                    ],
                ],
                'filter'      => 'text',
                'value'       => 3,
            ],
            'type'        => [
                'title'       => _a('Project type'),
                'description' => '',
                'edit'        => 'Module\Portfolio\Form\Element\Type',
                'filter'      => 'string',
                'value'       => 0,
            ],
            'number'      => [
                'title'       => _a('Number'),
                'description' => '',
                'edit'        => 'text',
                'filter'      => 'number_int',
                'value'       => 4,
            ],
            'recommended' => [
                'title'       => _a('Show just recommended'),
                'description' => '',
                'edit'        => 'checkbox',
                'filter'      => 'number_int',
                'value'       => 0,
            ],
            'show_title'  => [
                'title'       => _a('Show title'),
                'description' => '',
                'edit'        => 'checkbox',
                'filter'      => 'number_int',
                'value'       => 1,
            ],
            'order'       => [
                'title'       => _a('Project order'),
                'description' => '',
                'edit'        => [
                    'type'    => 'select',
                    'options' => [
                        'options' => [
                            'createDESC' => _a('Create time DESC'),
                            'createhASC' => _a('Create time ASC'),
                            'updateDESC' => _a('Update time DESC'),
                            'updateASC'  => _a('Update time ASC'),
                            'random'     => _a('Random'),
                        ],
                    ],
                ],
                'filter'      => 'text',
                'value'       => 'createDESC',
            ],
            'blockEffect' => [
                'title'       => _a('Use block effects'),
                'description' => _a('Use block effects or set custom effect on theme'),
                'edit'        => 'checkbox',
                'filter'      => 'number_int',
                'value'       => 1,
            ],
        ],
    ],
    'project-comment' => [
        'name'        => 'project-comment',
        'title'       => _a('Project Comment'),
        'description' => '',
        'render'      => ['block', 'projectComment'],
        'template'    => 'project-comment',
    ],
];