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
    // Module meta
    'meta'     => [
        'title'       => _a('Portfolio'),
        'description' => _a('List of your works and simple gallery'),
        'version'     => '1.3.6',
        'license'     => 'New BSD',
        'logo'        => 'image/logo.png',
        'readme'      => 'docs/readme.txt',
        'demo'        => 'http://pialog',
        'icon'        => 'fa-camera',
    ],
    // Author information
    'author'   => [
        'Name'    => 'Hossein Azizabadi',
        'email'   => 'azizabadi@faragostaresh.com',
        'website' => 'http://www.xoopsengine.org',
        'credits' => 'Pi Engine Team',
    ],
    // Resource
    'resource' => [
        'database'   => 'database.php',
        'config'     => 'config.php',
        'permission' => 'permission.php',
        'page'       => 'page.php',
        'navigation' => 'navigation.php',
        'block'      => 'block.php',
        'route'      => 'route.php',
        'comment'    => 'comment.php',
    ],
];