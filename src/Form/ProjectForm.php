<?php
/**
 * Project form
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Copyright (c) Pi Engine http://www.xoopsengine.org
 * @license         http://www.xoopsengine.org/license New BSD License
 * @author          Hossein Azizabadi <azizabadi@faragostaresh.com>
 * @since           3.0
 * @package         Module\Portfolio
 * @version         $Id$
 */

namespace Module\Portfolio\Form;

use Pi;
use Pi\Form\Form as BaseForm;

class ProjectForm extends BaseForm
{

    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    public function getInputFilter()
    {
        if (!$this->filter) {
            $this->filter = new ProjectFilter;
        }
        return $this->filter;
    }

    public function init()
    {
        // id
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        // title
        $this->add(array(
            'name' => 'title',
            'options' => array(
                'label' => __('Title'),
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'span6',
            )
        ));
        // slug
        $this->add(array(
            'name' => 'slug',
            'options' => array(
                'label' => __('Slug'),
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'span6',
            )
        ));
        // service
        $this->add(array(
            'name' => 'service',
            'options' => array(
                'label' => __('Service'),
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'span6',
            )
        ));
        // Technology
        $this->add(array(
            'name' => 'technology',
            'options' => array(
                'label' => __('Technology'),
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'span6',
            )
        ));
        // Website
        $this->add(array(
            'name' => 'website',
            'options' => array(
                'label' => __('Website'),
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'span6',
            )
        ));
        // Information
        $this->add(array(
            'name' => 'information',
            'options' => array(
                'label' => __('Information'),
            ),
            'attributes' => array(
                'type' => 'textarea',
                'rows' => '10',
                'cols' => '40',
                'class' => 'span6',
            )
        ));
        // keywords
        $this->add(array(
            'name' => 'keywords',
            'options' => array(
                'label' => __('Keywords'),
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'span6',
            )
        ));
        // description
        $this->add(array(
            'name' => 'description',
            'options' => array(
                'label' => __('Description'),
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'span6',
            )
        ));
        // Delivery
        $this->add(array(
            'name' => 'delivery',
            'options' => array(
                'label' => __('Delivery'),
            ),
            'attributes' => array(
                'type' => 'text',
                'value' => date('Y-m-d', strtotime('-1 month')),
            )
        ));
        // image
        $this->add(array(
            'name' => 'image',
            'options' => array(
                'label' => __('Image'),
            ),
            'attributes' => array(
                'type' => 'file',
                'description' => '',
            )
        ));
        // status
        $this->add(array(
            'name' => 'status',
            'type' => 'select',
            'options' => array(
                'label' => __('Status'),
                'value_options' => array(
                    1 => __('Published'),
                    2 => __('Pending review'),
                    3 => __('Draft'),
                    4 => __('Private'),
                    5 => __('Expired'),
                ),
            ),
        ));
        // extra
        $this->add(array(
            'name' => 'extra',
            'type' => 'fieldset',
            'options' => array(
                'label' => __('Customer comment'),
            ),
        ));
        // Comment
        $this->add(array(
            'name' => 'comment',
            'options' => array(
                'label' => __('Comment'),
            ),
            'attributes' => array(
                'type' => 'textarea',
                'rows' => '5',
                'cols' => '40',
                'class' => 'span6',
            )
        ));
        // comment by
        $this->add(array(
            'name' => 'commentby',
            'options' => array(
                'label' => __('Comment By'),
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'span6',
            )
        ));
        // Save
        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => __('Submit'),
            )
        ));
    }
}   