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
use Zend\InputFilter\InputFilter;

class ProjectFilter extends InputFilter
{
    public function __construct($option = array())
    {
        // id
        $this->add(array(
            'name' => 'id',
            'required' => false,
        ));
        // title
        $this->add(array(
            'name' => 'title',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
        // slug
        $this->add(array(
            'name'          => 'slug',
            'required'      => false,
            'filters'       => array(
                array(
                    'name'  => 'StringTrim',
                ),
            ),
            'validators'    => array(
                new \Module\Portfolio\Validator\SlugDuplicate(array(
                    'module'            => Pi::service('module')->current(),
                    'table'             => 'project',
                )),
            ),
        ));
        // type
        $this->add(array(
            'name' => 'type',
            'required' => true,
        ));
        // service
        $this->add(array(
            'name' => 'service',
            'required' => false,
        ));
        // technology
        $this->add(array(
            'name' => 'technology',
            'required' => false,
        ));
        // website
        $this->add(array(
            'name' => 'website',
            'required' => false,
        ));
        // website_view
        $this->add(array(
            'name' => 'website_view',
            'required' => false,
        ));
        // phone
        $this->add(array(
            'name' => 'phone',
            'required' => false,
        ));
        // phone_view
        $this->add(array(
            'name' => 'phone_view',
            'required' => false,
        ));
        // information
        $this->add(array(
            'name' => 'information',
            'required' => false,
        ));
        // image
        $this->add(array(
            'name' => 'image',
            'required' => false,
        ));
        // status
        $this->add(array(
            'name' => 'status',
            'required' => true,
        ));
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
        // seo_title
        $this->add(array(
            'name' => 'seo_title',
            'required' => false,
        ));
        // seo_keywords
        $this->add(array(
            'name' => 'seo_keywords',
            'required' => false,
        ));
        // seo_description
        $this->add(array(
            'name' => 'seo_description',
            'required' => false,
        ));
        // tag
        if (Pi::service('module')->isActive('tag')) {
            $this->add(array(
                'name' => 'tag',
                'required' => false,
            ));
        }
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
        ));
    }
}