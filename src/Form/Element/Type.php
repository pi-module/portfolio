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
namespace Module\Portfolio\Form\Element;

use Pi;
use Zend\Form\Element\Select;

class Type extends Select
{
    public function getValueOptions()
    {
        if (empty($this->valueOptions)) {
            $options = array();
            $options[0] = '';
            $where = array('status' => 1);
            $order = array('title ASC', 'id DESC');
            $select = Pi::model('type', 'portfolio')->select()->where($where)->order($order);
            $rowset = Pi::model('type', 'portfolio')->selectWith($select);
            foreach ($rowset as $row) {
                $options[$row->id] = $row->title;
            }
            $this->valueOptions = $options;
        }
        return $this->valueOptions;
    }


    public function getAttributes()
    {
        $this->Attributes = array(
            'size' => 1,
            'multiple' => 0,
            'class' => 'form-control',
            'required' => true,
        );
        // check form size
        if (isset($this->attributes['size'])) {
            $this->Attributes['size'] = $this->attributes['size'];
        }
        // check form multiple
        if (isset($this->attributes['multiple'])) {
            $this->Attributes['multiple'] = $this->attributes['multiple'];
        }
        return $this->Attributes;
    }
}