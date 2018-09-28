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
namespace Module\Portfolio\Api;

use Pi;
use Pi\Application\Api\AbstractComment;

class Comment extends AbstractComment
{
    /** @var string */
    protected $module = 'portfolio';

    /**
     * Get target data
     *
     * @param int|int[] $item Item id(s)
     *
     * @return array
     */
    public function get($item)
    {
        
        $result = array();
        $items = (array) $item;

        // Set options
        $projects = Pi::api('project', 'portfolio')->getListFromId($items);

        foreach ($items as $id) {
            $result[$id] = array(
                'title' => $projects[$id]['title'],
                'url'   => $projects[$id]['projectUrl'],
                'uid'   => $projects[$id]['uid'],
                'time'  => $projects[$id]['time_create'],
            );
        }

        if (is_scalar($item)) {
            $result = $result[$item];
        }

        return $result;
    }

    /**
     * Locate source id via route
     *
     * @param RouteMatch|array $params
     *
     * @return mixed|bool
     */
    public function locate($params = null)
    {
        if (null == $params) {
            $params = Pi::engine()->application()->getRouteMatch();
        }
        if ($params instanceof RouteMatch) {
            $params = $params->getParams();
        }
        if ('portfolio' == $params['module']
            && !empty($params['slug'])
        ) {
            $project = Pi::api('project', 'portfolio')->getProject($params['slug'], 'slug');
            $item = $project['id'];
        } else {
            $item = false;
        }
        return $item;
    }
}
