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
use Zend\InputFilter\InputFilter;

class TypeFilter extends InputFilter
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
                            'table'  => 'type',
                        ]
                    ),
                ],
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
                'required' => false,
            ]
        );

        // view_order
        $this->add(
            [
                'name'     => 'view_order',
                'required' => false,
            ]
        );
    }
}