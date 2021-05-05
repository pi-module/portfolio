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

namespace Module\Portfolio\Form;

use Pi;
use Pi\Form\Form as BaseForm;

class ProjectForm extends BaseForm
{

    public function __construct($name = null, $option = [])
    {
        $this->option = $option;
        parent::__construct($name);
    }

    public function getInputFilter()
    {
        if (!$this->filter) {
            $this->filter = new ProjectFilter($this->option);
        }
        return $this->filter;
    }

    public function init()
    {
        // title
        $this->add(
            [
                'name'       => 'title',
                'options'    => [
                    'label' => __('Title'),
                ],
                'attributes' => [
                    'type'     => 'text',
                    'required' => true,
                ],
            ]
        );

        // slug
        $this->add(
            [
                'name'       => 'slug',
                'options'    => [
                    'label' => __('Slug'),
                ],
                'attributes' => [
                    'type' => 'text',
                ],
            ]
        );

        // type
        $this->add(
            [
                'name'       => 'type',
                'type'       => 'Module\Portfolio\Form\Element\Type',
                'options'    => [
                    'label'    => __('Project type'),
                    'category' => '',
                ],
                'attributes' => [
                    'required' => true,
                ],
            ]
        );

        // main_image
        $this->add(
            [
                'name'    => 'main_image',
                'type'    => 'Module\Media\Form\Element\Media',
                'options' => [
                    'label'    => __('Main image'),
                    'required' => true,
                ],
            ]
        );

        // additional_images
        $this->add(
            [
                'name'    => 'additional_images',
                'type'    => 'Module\Media\Form\Element\Media',
                'options' => [
                    'label'         => __('Additional images'),
                    'media_gallery' => true,
                ],
            ]
        );

        // text_description
        $this->add(
            [
                'name'       => 'text_description',
                'options'    => [
                    'label'  => __('Description'),
                    'editor' => 'html',
                ],
                'attributes' => [
                    'type'        => 'editor',
                    'description' => '',
                ],
            ]
        );

        // status
        $this->add(
            [
                'name'    => 'status',
                'type'    => 'select',
                'options' => [
                    'label'         => __('Status'),
                    'value_options' => [
                        1 => __('Published'),
                        2 => __('Pending review'),
                        3 => __('Draft'),
                        4 => __('Private'),
                        5 => __('Remove'),
                    ],
                ],
            ]
        );

        // extra_seo
        $this->add(
            [
                'name'    => 'extra_seo',
                'type'    => 'fieldset',
                'options' => [
                    'label' => __('SEO options'),
                ],
            ]
        );

        // seo_title
        $this->add(
            [
                'name'       => 'seo_title',
                'options'    => [
                    'label' => __('SEO Title'),
                ],
                'attributes' => [
                    'type'        => 'textarea',
                    'rows'        => '2',
                    'cols'        => '40',
                    'description' => '',
                ],
            ]
        );

        // seo_keywords
        $this->add(
            [
                'name'       => 'seo_keywords',
                'options'    => [
                    'label' => __('SEO Keywords'),
                ],
                'attributes' => [
                    'type'        => 'textarea',
                    'rows'        => '2',
                    'cols'        => '40',
                    'description' => '',
                ],
            ]
        );

        // seo_description
        $this->add(
            [
                'name'       => 'seo_description',
                'options'    => [
                    'label' => __('SEO Description'),
                ],
                'attributes' => [
                    'type'        => 'textarea',
                    'rows'        => '3',
                    'cols'        => '40',
                    'description' => '',
                ],
            ]
        );

        // tag
        if (Pi::service('module')->isActive('tag')) {
            $this->add(
                [
                    'name'       => 'tag',
                    'type'       => 'tag',
                    'options'    => [
                        'label' => __('Tags'),
                    ],
                    'attributes' => [
                        'id'          => 'tag',
                        'description' => __('Use `|` as delimiter to separate tag terms'),
                    ],
                ]
            );
        }

        /*
                // service
        $this->add(
            [
                'name'       => 'service',
                'options'    => [
                    'label' => __('Service'),
                ],
                'attributes' => [
                    'type' => 'text',
                ],
            ]
        );

        // Technology
        $this->add(
            [
                'name'       => 'technology',
                'options'    => [
                    'label' => __('Technology'),
                ],
                'attributes' => [
                    'type' => 'text',
                ],
            ]
        );

        // Website
        $this->add(
            [
                'name'       => 'website',
                'options'    => [
                    'label' => __('Website'),
                ],
                'attributes' => [
                    'type' => 'text',
                ],
            ]
        );

        // website_view
        $this->add(
            [
                'name'       => 'website_view',
                'type'       => 'checkbox',
                'options'    => [
                    'label' => __('View website link'),
                ],
                'attributes' => [
                    'value' => '1',
                ],
            ]
        );

        // phone
        $this->add(
            [
                'name'       => 'phone',
                'options'    => [
                    'label' => __('Phone'),
                ],
                'attributes' => [
                    'type' => 'text',
                ],
            ]
        );

        // phone_view
        $this->add(
            [
                'name'       => 'phone_view',
                'type'       => 'checkbox',
                'options'    => [
                    'label' => __('View phone'),
                ],
                'attributes' => [
                    'value' => '1',
                ],
            ]
        );

        // Version
        $this->add(array(
            'name' => 'version',
            'options' => array(
                'label' => __('Version'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        ));

        // Size
        $this->add(array(
            'name' => 'size',
            'options' => array(
                'label' => __('Size'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        ));

        // extra_comment
        $this->add(array(
            'name' => 'extra_comment',
            'type' => 'fieldset',
            'options' => array(
                'label' => __('Customer comment'),
            ),
        ));

        // Customer
        $this->add(array(
            'name' => 'customer',
            'options' => array(
                'label' => __('Customer'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
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

        // extra_link
        $this->add(array(
            'name' => 'extra_link',
            'type' => 'fieldset',
            'options' => array(
                'label' => __('Extra links'),
            ),
        ));

        // link_1
        $this->add(array(
            'name' => 'link_1',
            'options' => array(
                'label' => __('Link 1'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        ));

        // link_2
        $this->add(array(
            'name' => 'link_2',
            'options' => array(
                'label' => __('Link 2'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        ));

        // link_3
        $this->add(array(
            'name' => 'link_3',
            'options' => array(
                'label' => __('Link 3'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        ));

        // link_4
        $this->add(array(
            'name' => 'link_4',
            'options' => array(
                'label' => __('Link 4'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        ));

        // link_5
        $this->add(array(
            'name' => 'link_5',
            'options' => array(
                'label' => __('Link 5'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        ));

        // extra_image
        $this->add(array(
            'name' => 'extra_image',
            'type' => 'fieldset',
            'options' => array(
                'label' => __('Extra images'),
            ),
        ));

        // image_1
        $this->add(array(
            'name' => 'image_1',
            'options' => array(
                'label' => __('Image 1'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        ));

        // image_2
        $this->add(array(
            'name' => 'image_2',
            'options' => array(
                'label' => __('Image 2'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        ));

        // image_3
        $this->add(array(
            'name' => 'image_3',
            'options' => array(
                'label' => __('Image 3'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        ));

        // image_4
        $this->add(array(
            'name' => 'image_4',
            'options' => array(
                'label' => __('Image 4'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        ));

        // image_5
        $this->add(array(
            'name' => 'image_5',
            'options' => array(
                'label' => __('Image 5'),
            ),
            'attributes' => array(
                'type' => 'text',
            )
        )); */

        // Save
        $this->add(
            [
                'name'       => 'submit',
                'type'       => 'submit',
                'attributes' => [
                    'value' => __('Submit'),
                ],
            ]
        );
    }
}   