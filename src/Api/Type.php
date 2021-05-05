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
 * Pi::api('type', 'portfolio')->canonizeType($type);
 */

class Type extends AbstractApi
{
    public function getList($params = [])
    {
        // Get info
        $list = [];
        $where = ['status' => 1];
        $order = ['view_order DESC', 'id DESC'];
        $select = Pi::model('type', $this->getModule())->select()->where($where)->order($order);
        $rowset = Pi::model('type', $this->getModule())->selectWith($select);


        // Set all
        if (isset($params['set_all']) && $params['set_all'] == 1) {
            $list[0] = [
                'title'   => __('All'),
                'active'  => (isset($params['active_id']) && $params['active_id'] > 0) ? 0 : 1,
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
            $list[$row->id] = $this->canonizeType($row);
            $list[$row->id]['active'] = (isset($params['active_id']) && $params['active_id'] == $row->id) ? 1 : 0;
        }

        return $list;
    }

    public function canonizeType($type)
    {
        // Check
        if (empty($type)) {
            return [];
        }

        if (is_object($type)) {
            $type = $type->toArray();
        }


        $type['typeUrl'] = Pi::url(
            Pi::service('url')->assemble(
                'portfolio', [
                    'module'     => $this->getModule(),
                    'controller' => 'type',
                    'action'     => 'index',
                    'slug'       => $type['slug'],
                ]
            )
        );

        // Set image
        if ($type['main_image']) {
            /* $type['mediumUrl'] = Pi::url(
                (string)Pi::api('doc', 'media')->getSingleLinkUrl($type['main_image'])->setConfigModule('portfolio')->thumb('medium')
            ); */
            $type['thumbUrl'] = Pi::url(
                (string)Pi::api('doc', 'media')->getSingleLinkUrl($type['main_image'])->setConfigModule('portfolio')->thumb('thumbnail')
            );
        } else {
            //$type['mediumUrl'] = '';
            $type['thumbUrl'] = '';
        }

        return $type;
    }
}