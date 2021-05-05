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
use Laminas\InputFilter\InputFilter;

class ProjectFilter extends InputFilter
{
    public function __construct($option = [])
    {
        // title
        $this->add(
            [
                'name'     => 'title',
                'required' => true,
                'filters'  => [
                    [
                        'name' => 'StringTrim',
                    ],
                ],
            ]
        );

        // slug
        $this->add(
            [
                'name'       => 'slug',
                'required'   => false,
                'filters'    => [
                    [
                        'name' => 'StringTrim',
                    ],
                ],
                'validators' => [
                    new \Module\Portfolio\Validator\SlugDuplicate(
                        [
                            'module' => Pi::service('module')->current(),
                            'table'  => 'project',
                            'id'     => $option['id'],
                        ]
                    ),
                ],
            ]
        );

        // type
        $this->add(
            [
                'name'     => 'type',
                'required' => true,
            ]
        );

        // main_image
        $this->add(
            [
                'name'     => 'main_image',
                'required' => true,
            ]
        );

        // additional_images
        $this->add(
            [
                'name'     => 'additional_images',
                'required' => false,
            ]
        );

        // text_description
        $this->add(
            [
                'name'     => 'text_description',
                'required' => false,
            ]
        );

        // status
        $this->add(
            [
                'name'     => 'status',
                'required' => true,
            ]
        );

        // seo_title
        $this->add(
            [
                'name'     => 'seo_title',
                'required' => false,
            ]
        );

        // seo_keywords
        $this->add(
            [
                'name'     => 'seo_keywords',
                'required' => false,
            ]
        );

        // seo_description
        $this->add(
            [
                'name'     => 'seo_description',
                'required' => false,
            ]
        );

        // tag
        if (Pi::service('module')->isActive('tag')) {
            $this->add(
                [
                    'name'     => 'tag',
                    'required' => false,
                ]
            );
        }

        /*
                // service
        $this->add(
            [
                'name'     => 'service',
                'required' => false,
            ]
        );

        // technology
        $this->add(
            [
                'name'     => 'technology',
                'required' => false,
            ]
        );

        // website
        $this->add(
            [
                'name'     => 'website',
                'required' => false,
            ]
        );

        // website_view
        $this->add(
            [
                'name'     => 'website_view',
                'required' => false,
            ]
        );

        // phone
        $this->add(
            [
                'name'     => 'phone',
                'required' => false,
            ]
        );

        // phone_view
        $this->add(
            [
                'name'     => 'phone_view',
                'required' => false,
            ]
        );

        // customer
        $this->add(array(
            'name' => 'customer',
            'required' => false,
        ));

        // version
        $this->add(array(
            'name' => 'version',
            'required' => false,
        ));

        // size
        $this->add(array(
            'name' => 'size',
            'required' => false,
        ));

        // comment
        $this->add(array(
            'name' => 'comment',
            'required' => false,
        ));

        // commentby
        $this->add(array(
            'name' => 'commentby',
            'required' => false,
        ));

        // link_1
        $this->add(array(
            'name' => 'link_1',
            'required' => false,
        ));

        // link_2
        $this->add(array(
            'name' => 'link_2',
            'required' => false,
        ));

        // link_3
        $this->add(array(
            'name' => 'link_3',
            'required' => false,
        ));

        // link_4
        $this->add(array(
            'name' => 'link_4',
            'required' => false,
        ));

        // link_5
        $this->add(array(
            'name' => 'link_5',
            'required' => false,
        ));

        // image_1
        $this->add(array(
            'name' => 'image_1',
            'required' => false,
        ));

        // image_2
        $this->add(array(
            'name' => 'image_2',
            'required' => false,
        ));

        // image_3
        $this->add(array(
            'name' => 'image_3',
            'required' => false,
        ));

        // image_4
        $this->add(array(
            'name' => 'image_4',
            'required' => false,
        ));

        // image_5
        $this->add(array(
            'name' => 'image_5',
            'required' => false,
        )); */
    }
}