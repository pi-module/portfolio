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
        'list' => array(
            'label'         => __('Projects'),
            'route'         => 'admin',
            'module'        => 'portfolio',
            'controller'    => 'project',
            'action'        => 'index',
        ),
        'add' => array(
            'label'         => __('Add Projects'),
            'route'         => 'admin',
            'module'        => 'portfolio',
            'controller'    => 'project',
            'action'        => 'update',
        ),
    ),
);