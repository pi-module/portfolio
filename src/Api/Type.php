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
use Pi\Application\Api\AbstractApi;

/*
 * Pi::api('type', 'portfolio')->getList($params);
 */

class Type extends AbstractApi
{
    public function getList($params = [])
    {
        // Get info
        $list   = [];
        $where  = ['status' => 1];
        $order  = ['view_order DESC', 'id DESC'];
        $select = Pi::model('type', $this->getModule())->select()->where($where)->order($order);
        $rowset = Pi::model('type', $this->getModule())->selectWith($select);


        // Set all
        if (isset($params['set_all']) && $params['set_all'] == 1) {
            $list[0] = [
                'title'   => __('All'),
                'active'  => 1,
                'typeUrl' => Pi::url(
                    Pi::service('url')->assemble(
                        'portfolio', [
                            'module'     => $this->getModule(),
                            'controller' => 'index',
                            'action'     => 'index',
                        ]
                    )
                ),
            ];
        }

        // Make list
        foreach ($rowset as $row) {
            $list[$row->id]            = $row->toArray();
            $list[$row->id]['active']  = (isset($params['active_id']) && $params['active_id'] == $row->id) ? 1 : 0;
            $list[$row->id]['typeUrl'] = Pi::url(
                Pi::service('url')->assemble(
                    'portfolio', [
                        'module'     => $this->getModule(),
                        'controller' => 'type',
                        'action'     => 'index',
                        'slug'       => $row->slug,
                    ]
                )
            );
        }

        return $list;
    }
}