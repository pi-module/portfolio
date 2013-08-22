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
use Zend\InputFilter\InputFilter;

class ProjectFilter extends InputFilter
{
    public function __construct($options = array())
    {
        	
		$params = array(
            'table' => 'project',
        );
        if (isset($options['id']) and $options['id']) {
            $params['id'] = $options['id'];
        }	
			
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
            'name' => 'slug',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'Module\Portfolio\Validator\Slug',
                    'options' => $params,
                ),
            ),
        ));
        // type
        $this->add(array(
            'name' => 'type',
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
        // information
        $this->add(array(
            'name' => 'information',
            'required' => false,
        ));
        // description
        $this->add(array(
            'name' => 'description',
            'required' => false,
        ));
        // keywords
        $this->add(array(
            'name' => 'keywords',
            'required' => false,
        ));
        // delivery
        $this->add(array(
            'name' => 'delivery',
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
    }
}