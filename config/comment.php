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
    'portfolio' => array(
        'title' => _a('Portfolio comments'),
        'icon' => 'icon-post',
        'callback' => 'Module\Portfolio\Api\Comment',
        'locator' => 'Module\Portfolio\Api\Comment',
    ),
);