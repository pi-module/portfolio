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
return array(
    'admin' => array(
        'projects' => array(
            'label' => _a('Projects'),
            'permission' => array(
                'resource' => 'projects',
            ),
            'route' => 'admin',
            'module' => 'portfolio',
            'controller' => 'project',
            'action' => 'index',
            'pages' => array(
                'projects' => array(
                    'label' => _a('Projects'),
                    'permission' => array(
                        'resource' => 'project',
                    ),
                    'route' => 'admin',
                    'module' => 'portfolio',
                    'controller' => 'project',
                    'action' => 'index',
                ),
                'update' => array(
                    'label' => _a('Add projects'),
                    'permission' => array(
                        'resource' => 'project',
                    ),
                    'route' => 'admin',
                    'module' => 'portfolio',
                    'controller' => 'project',
                    'action' => 'update',
                ),
            ),
        ),
        'type' => array(
            'label' => _a('Project type'),
            'permission' => array(
                'resource' => 'type',
            ),
            'route' => 'admin',
            'module' => 'portfolio',
            'controller' => 'type',
            'action' => 'index',
            'pages' => array(
                'type' => array(
                    'label' => _a('Project type'),
                    'permission' => array(
                        'resource' => 'type',
                    ),
                    'route' => 'admin',
                    'module' => 'portfolio',
                    'controller' => 'type',
                    'action' => 'index',
                ),

                'update' => array(
                    'label' => _a('Add project type'),
                    'permission' => array(
                        'resource' => 'type',
                    ),
                    'route' => 'admin',
                    'module' => 'portfolio',
                    'controller' => 'type',
                    'action' => 'update',
                ),
            ),
        ),
        'tools' => array(
            'label' => _a('Tools'),
            'permission' => array(
                'resource' => 'type',
            ),
            'route' => 'admin',
            'module' => 'portfolio',
            'controller' => 'tools',
            'action' => 'index',
        ),
    ),
);