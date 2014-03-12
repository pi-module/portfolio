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
namespace Module\Portfolio\Form;

use Pi;
use Pi\Form\Form as BaseForm;

class ProjectForm extends BaseForm
{

    public function __construct($name = null, $options = array())
    {
        $this->thumbUrl = (isset($options['thumbUrl'])) ? $options['thumbUrl'] : '';
        $this->removeUrl = empty($options['removeUrl']) ? '' : $options['removeUrl'];
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
            )
        ));
        // website_view
        $this->add(array(
            'name'          => 'website_view',
            'type'          => 'checkbox',
            'options'       => array(
                'label' => __('View website link'),
            ),
            'attributes'    => array(
                'value'     => '1',
            )
        ));
        // Information
        $this->add(array(
            'name' => 'information',
            'options' => array(
                'label' => __('Information'),
            ),
            'attributes' => array(
                'description' => __('You can use HTML tag here'),
                'type' => 'textarea',
                'rows' => '10',
                'cols' => '40',
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
                    5 => __('Remove'),
                ),
            ),
        ));
        // Image
        if ($this->thumbUrl) {
            $this->add(array(
                'name' => 'imageview',
                'type' => 'Module\Portfolio\Form\Element\Image',
                'options' => array(
                    //'label' => __('Image'),
                ),
                'attributes' => array(
                    'src' => $this->thumbUrl,
                ),
            ));
            $this->add(array(
                'name' => 'remove',
                'type' => 'Module\Portfolio\Form\Element\Remove',
                'options' => array(
                    'label' => __('Remove image'),
                ),
                'attributes' => array(
                    'link' => $this->removeUrl,
                ),
            ));
            $this->add(array(
                'name' => 'image',
                'attributes' => array(
                    'type' => 'hidden',
                ),
            ));
        } else {
            $this->add(array(
                'name' => 'image',
                'options' => array(
                    'label' => __('Upload image'),
                ),
                'attributes' => array(
                    'type' => 'file',
                    'description' => '',
                )
            ));
        }
        // extra_comment
        $this->add(array(
            'name' => 'extra_comment',
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
            )
        ));
        // extra_seo
        $this->add(array(
            'name' => 'extra_seo',
            'type' => 'fieldset',
            'options' => array(
                'label' => __('SEO options'),
            ),
        ));
        // seo_title
        $this->add(array(
            'name' => 'seo_title',
            'options' => array(
                'label' => __('SEO Title'),
            ),
            'attributes' => array(
                'type' => 'text',
                'description' => '',
            )
        ));
        // seo_keywords
        $this->add(array(
            'name' => 'seo_keywords',
            'options' => array(
                'label' => __('SEO Keywords'),
            ),
            'attributes' => array(
                'type' => 'text',
                'description' => '',
            )
        ));
        // seo_description
        $this->add(array(
            'name' => 'seo_description',
            'options' => array(
                'label' => __('SEO Description'),
            ),
            'attributes' => array(
                'type' => 'text',
                'description' => '',
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