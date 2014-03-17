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
            'title' => __('Admin'),
            'name' => 'admin'
        ),
        array(
            'title' => __('Image'),
            'name' => 'image'
        ),
        array(
            'title' => __('Show'),
            'name' => 'show'
        ),
        array(
            'title' => __('Social'),
            'name' => 'social'
        ),
        array(
            'title' => __('Texts'),
            'name' => 'text'
        ),
    ),
    'item' => array(
        // Admin
        'admin_perpage' => array(
            'category' => 'admin',
            'title' => __('Perpage'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 10
        ),
        // Image
        'image_size' => array(
            'category' => 'image',
            'title' => __('Image Size'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 1000000
        ),
        'image_path' => array(
            'category' => 'image',
            'title' => __('Image path'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'string',
            'value' => 'portfolio'
        ),
        'image_extension' => array(
            'category' => 'image',
            'title' => __('Image Extension'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'string',
            'value' => 'jpg,jpeg,png,gif'
        ),
        'image_largeh' => array(
            'category' => 'image',
            'title' => __('Large Image height'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 800
        ),
        'image_largew' => array(
            'category' => 'image',
            'title' => __('Large Image width'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 800
        ),
        'image_mediumh' => array(
            'category' => 'image',
            'title' => __('Medium Image height'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 300
        ),
        'image_mediumw' => array(
            'category' => 'image',
            'title' => __('Medium Image width'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 300
        ),
        'image_thumbh' => array(
            'category' => 'image',
            'title' => __('Thumb Image height'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 150
        ),
        'image_thumbw' => array(
            'category' => 'image',
            'title' => __('Thumb Image width'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 150
        ),
        'image_watermark' => array(
            'category' => 'image',
            'title' => __('Add Watermark'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 0
        ),
        'image_watermark_source' => array(
            'category' => 'image',
            'title' => __('Watermark Image'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'string',
            'value' => ''
        ),
        'image_watermark_position' => array(
            'title' => __('Watermark Positio'),
            'description' => '',
            'edit' => array(
                'type' => 'select',
                'options' => array(
                    'options' => array(
                        'top-left' => __('Top Left'),
                        'top-right' => __('Top Right'),
                        'bottom-left' => __('Bottom Left'),
                        'bottom-right' => __('Bottom Right'),
                    ),
                ),
            ),
            'filter' => 'text',
            'value' => 'bottom-right',
            'category' => 'image',
        ),
        // Show
        'show_perpage' => array(
            'category' => 'show',
            'title' => __('Perpage'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'number_int',
            'value' => 12
        ),
        'show_service' => array(
            'category' => 'show',
            'title' => __('Show Service'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_technology' => array(
            'category' => 'show',
            'title' => __('Show Technology'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_website' => array(
            'category' => 'show',
            'title' => __('Show Website'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_information' => array(
            'category' => 'show',
            'title' => __('Show Information'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_hits' => array(
            'category' => 'show',
            'title' => __('Show Hits'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'show_tag' => array(
            'category' => 'show',
            'title' => __('Show Tags'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        // Social
        'social_gplus' => array(
            'category' => 'social',
            'title' => __('Show Google Plus'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'social_facebook' => array(
            'category' => 'social',
            'title' => __('Show facebook'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        'social_twitter' => array(
            'category' => 'social',
            'title' => __('Show Twitter'),
            'description' => '',
            'edit' => 'checkbox',
            'filter' => 'number_int',
            'value' => 1
        ),
        // Texts
        'text_title' => array(
            'category' => 'text',
            'title' => __('Module main title'),
            'description' => __('Title for main page and all non-title pages'),
            'edit' => 'text',
            'filter' => 'string',
            'value' => 'List of all our projects'
        ),
        'text_description' => array(
            'category' => 'text',
            'title' => __('Module main description'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'string',
            'value' => 'List of all our projects'
        ),
        'text_keywords' => array(
            'category' => 'text',
            'title' => __('Module main keywords'),
            'description' => '',
            'edit' => 'text',
            'filter' => 'string',
            'value' => 'projects,project,website,art,design,development'
        ),
    ),
);