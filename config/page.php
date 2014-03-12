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
    // Admin section
    'admin' => array(
        array(
            'controller'    => 'project',
        ),
    ),
    // Front section
    'front' => array(
        array(
            'controller'    => 'index',
            'block'         => 1,
        ),
        array(
            'controller'    => 'project',
            'block'         => 1,
        ),
    ),
);