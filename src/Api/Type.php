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
 * Pi::api('type', 'portfolio')->getList();
 */

class Type extends AbstractApi
{
    public function getList()
    {
        // Get info
        $list   = [];
        $where  = ['status' => 1];
        $order  = ['id DESC'];
        $select = Pi::model('type', $this->getModule())->select()->where($where)->order($order);
        $rowset = Pi::model('type', $this->getModule())->selectWith($select);

        // Make list
        foreach ($rowset as $row) {
            $list[$row->id] = $row->toArray();
        }

        return $list;
    }
}