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
return array(
    'category' => array(
        array(
            'title' => _a('Admin'),
            'name' => 'admin'
        ),
        array(
            'title' => _a('Show'),
            'name' => 'show'
        ),
        array(
            'title' => _a('Image'),
            'name' => 'image'
        ),
        array(
            'title' => _a('Social'),
            'name' => 'social'
        ),

    ),
    'item' => array(
        // Admin
        'admin_perpage' => array(
            'category' => 'admin',
            'title' => _a('Perpage'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 10
        ),
        // Show
        'homepage_title' => array(
            'category' => 'view',
            'title' => _a('Homepage title'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'string',
        ),
        'view_perpage' => array(
            'category' => 'show',
            'title' => _a('Perpage'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 12
        ),
        'view_column' => array(
            'title' => _a('Columns'),
            'description' => '',
            'edit' => array(
                'type' => 'select',
                'options' => array(
                    'options' => array(
                        1 => _a('One columns'),
                        2 => _a('Two columns'),
                        3 => _a('Three columns'),
                        4 => _a('Four columns'),
                        6 => _a('Six columns'),
                    ),
                ),
            ),
            'filter' => 'text',
            'value' => 3,
            'category' => 'view',
        ),
        'view_type' => array(
            'title' => _a('View type'),
            'description' => _a('Item list view type'),
            'edit' => array(
                'type' => 'select',
                'options' => array(
                    'options' => array(
                        'normal' => _a('Normal'),
                        'single' => _a('Single page by gallery effect'),
                        'angular' => _a('Angular ( Not finish )'),
                    ),
                ),
            ),
            'filter' => 'text',
            'value' => 'ajax',
            'category' => 'view',
        ),
        'show_type' => array(
            'category' => 'show',
            'title' => _a('Show type list'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_service' => array(
            'category' => 'show',
            'title' => _a('Show Service'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_technology' => array(
            'category' => 'show',
            'title' => _a('Show Technology'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_website' => array(
            'category' => 'show',
            'title' => _a('Show Website'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_phone' => array(
            'category' => 'show',
            'title' => _a('Show phone'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_description' => array(
            'category' => 'show',
            'title' => _a('Show description'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_hits' => array(
            'category' => 'show',
            'title' => _a('Show Hits'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_tag' => array(
            'category' => 'show',
            'title' => _a('Show Tags'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        // Image
        'image_size' => array(
            'category' => 'image',
            'title' => _a('Image Size'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 1000000
        ),
        'image_quality' => array(
            'category' => 'image',
            'title' => _a('Image quality'),
            'description' => _a('Between 0 to 100 and support both of JPG and PNG, default is 75'),
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 75
        ),
        'image_path' => array(
            'category' => 'image',
            'title' => _a('Image path'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'string',
            'value' => 'portfolio/image'
        ),
        'image_extension' => array(
            'category' => 'image',
            'title' => _a('Image Extension'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'string',
            'value' => 'jpg,jpeg,png,gif'
        ),
        'image_largeh' => array(
            'category' => 'image',
            'title' => _a('Large Image height'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 1200
        ),
        'image_largew' => array(
            'category' => 'image',
            'title' => _a('Large Image width'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 1200
        ),
        'image_itemw' => array(
            'category' => 'image',
            'title' => _a('Item Image width'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 800
        ),
        'image_itemh' => array(
            'category' => 'image',
            'title' => _a('Item Image height'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 800
        ),
        'image_mediumh' => array(
            'category' => 'image',
            'title' => _a('Medium Image height'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 500
        ),
        'image_mediumw' => array(
            'category' => 'image',
            'title' => _a('Medium Image width'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 500
        ),
        'image_thumbh' => array(
            'category' => 'image',
            'title' => _a('Thumb Image height'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 250
        ),
        'image_thumbw' => array(
            'category' => 'image',
            'title' => _a('Thumb Image width'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 250
        ),
        'image_watermark' => array(
            'category' => 'image',
            'title' => _a('Add Watermark'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 0
        ),
        'image_watermark_source' => array(
            'category' => 'image',
            'title' => _a('Watermark Image'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'string',
            'value' => ''
        ),
        'image_watermark_position' => array(
            'title' => _a('Watermark Positio'),
            'description' => '',
            'edit' => array(
                'type' => 'select',
                'options' => array(
                    'options' => array(
                        'top-left' => _a('Top Left'),
                        'top-right' => _a('Top Right'),
                        'bottom-left' => _a('Bottom Left'),
                        'bottom-right' => _a('Bottom Right'),
                    ),
                ),
            ),
            'filter' => 'text',
            'value' => 'bottom-right',
            'category' => 'image',
        ),
        // Social
        'social_sharing' => array(
            'title' => _t('Social sharing items'),
            'description' => '',
            'edit' => array(
                'type' => 'multi_checkbox',
                'options' => array(
                    'options' => Pi::service('social_sharing')->getList(),
                ),
            ),
            'filter' => 'array',
            'category' => 'social',
        ),
        // Texts
        'text_description_index' => array(
            'category' => 'head_meta',
            'title' => _a('Description for index page'),
            'description' => '',
            'edit' => 'textarea',
            'filter' => 'string',
            'value' => ''
        ),
    ),
);