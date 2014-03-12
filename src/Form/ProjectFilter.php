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
    public function __construct()
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
    }
}