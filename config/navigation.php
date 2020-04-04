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
    'admin' => [
        'projects' => [
            'label'      => _a('Projects'),
            'permission' => [
                'resource' => 'projects',
            ],
            'route'      => 'admin',
            'module'     => 'portfolio',
            'controller' => 'project',
            'action'     => 'index',
            'pages'      => [
                'projects' => [
                    'label'      => _a('Projects'),
                    'permission' => [
                        'resource' => 'project',
                    ],
                    'route'      => 'admin',
                    'module'     => 'portfolio',
                    'controller' => 'project',
                    'action'     => 'index',
                ],
                'update'   => [
                    'label'      => _a('Add projects'),
                    'permission' => [
                        'resource' => 'project',
                    ],
                    'route'      => 'admin',
                    'module'     => 'portfolio',
                    'controller' => 'project',
                    'action'     => 'update',
                ],
            ],
        ],
        'type'     => [
            'label'      => _a('Project type'),
            'permission' => [
                'resource' => 'type',
            ],
            'route'      => 'admin',
            'module'     => 'portfolio',
            'controller' => 'type',
            'action'     => 'index',
            'pages'      => [
                'type' => [
                    'label'      => _a('Project type'),
                    'permission' => [
                        'resource' => 'type',
                    ],
                    'route'      => 'admin',
                    'module'     => 'portfolio',
                    'controller' => 'type',
                    'action'     => 'index',
                ],

                'update' => [
                    'label'      => _a('Add project type'),
                    'permission' => [
                        'resource' => 'type',
                    ],
                    'route'      => 'admin',
                    'module'     => 'portfolio',
                    'controller' => 'type',
                    'action'     => 'update',
                ],
            ],
        ],
        'tools'    => [
            'label'      => _a('Tools'),
            'permission' => [
                'resource' => 'type',
            ],
            'route'      => 'admin',
            'module'     => 'portfolio',
            'controller' => 'tools',
            'action'     => 'index',
        ],
    ],
];