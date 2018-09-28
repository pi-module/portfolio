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
    // route name
    'portfolio' => array(
        'name' => 'portfolio',
        'type' => 'Module\Portfolio\Route\Portfolio',
        'options' => array(
            'route' => '/portfolio',
            'defaults' => array(
                'module' => 'portfolio',
                'controller' => 'index',
                'action' => 'index'
            )
        ),
    )
);