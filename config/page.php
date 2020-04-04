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
    // Admin section
    'admin' => [
        [
            'title'      => _a('Projects'),
            'controller' => 'project',
            'permission' => 'project',
        ],
        [
            'title'      => _a('Project type'),
            'controller' => 'type',
            'permission' => 'type',
        ],
        [
            'title'      => _a('Tools'),
            'controller' => 'tools',
            'permission' => 'tools',
        ],
    ],
    // Front section
    'front' => [
        [
            'title'      => _a('Index'),
            'controller' => 'index',
            'block'      => 1,
        ],
        [
            'title'      => _a('Tag'),
            'controller' => 'tag',
            'block'      => 1,
        ],
        [
            'title'      => _a('Project'),
            'controller' => 'project',
            'block'      => 1,
        ],
    ],
];