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
    ),
);