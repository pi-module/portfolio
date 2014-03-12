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
    // route name
    'portfolio'  => array(
        'name'      => 'portfolio',
        'type'      => 'Module\Portfolio\Route\Portfolio',
        'options'   => array(
            'route'     => '/portfolio',
            'defaults'  => array(
                'module'        => 'portfolio',
                'controller'    => 'index',
                'action'        => 'index'
            )
        ),
    )
);