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
return [
    'category' => [
        [
            'title' => _a('Admin'),
            'name'  => 'admin',
        ],
        [
            'title' => _a('Show'),
            'name'  => 'show',
        ],
        [
            'title' => _a('Image'),
            'name'  => 'image',
        ],
        [
            'title' => _a('Social'),
            'name'  => 'social',
        ],

    ],
    'item'     => [
        // Admin
        'admin_perpage'            => [
            'category'    => 'admin',
            'title'       => _a('Perpage'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 10,
        ],
        // Show
        'homepage_title'           => [
            'category'    => 'view',
            'title'       => _a('Homepage title'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'string',
        ],
        'view_perpage'             => [
            'category'    => 'show',
            'title'       => _a('Perpage'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 12,
        ],
        'view_column'              => [
            'title'       => _a('Columns'),
            'description' => '',
            'edit'        => [
                'type'    => 'select',
                'options' => [
                    'options' => [
                        1 => _a('One columns'),
                        2 => _a('Two columns'),
                        3 => _a('Three columns'),
                        4 => _a('Four columns'),
                        6 => _a('Six columns'),
                    ],
                ],
            ],
            'filter'      => 'text',
            'value'       => 3,
            'category'    => 'view',
        ],
        'view_type'                => [
            'title'       => _a('View type'),
            'description' => _a('Item list view type'),
            'edit'        => [
                'type'    => 'select',
                'options' => [
                    'options' => [
                        'normal'  => _a('Normal'),
                        'single'  => _a('Single page by gallery effect'),
                        'angular' => _a('Angular ( Not finish )'),
                    ],
                ],
            ],
            'filter'      => 'text',
            'value'       => 'normal',
            'category'    => 'view',
        ],
        'show_type'                => [
            'category'    => 'show',
            'title'       => _a('Show type list'),
            'description' => '',
            'edit'        => 'checkbox',
            'filter'      => 'number_int',
            'value'       => 1,
        ],
        'type_menu'                => [
            'title'       => _a('Menu type'),
            'description' => _a('Position and style'),
            'edit'        => [
                'type'    => 'select',
                'options' => [
                    'options' => [
                        'side' => _a('Side'),
                        'top'  => _a('Top'),
                    ],
                ],
            ],
            'filter'      => 'text',
            'value'       => 'side',
            'category'    => 'view',
        ],
        'show_service'             => [
            'category'    => 'show',
            'title'       => _a('Show Service'),
            'description' => '',
            'edit'        => 'checkbox',
            'filter'      => 'number_int',
            'value'       => 1,
        ],
        'show_technology'          => [
            'category'    => 'show',
            'title'       => _a('Show Technology'),
            'description' => '',
            'edit'        => 'checkbox',
            'filter'      => 'number_int',
            'value'       => 1,
        ],
        'show_website'             => [
            'category'    => 'show',
            'title'       => _a('Show Website'),
            'description' => '',
            'edit'        => 'checkbox',
            'filter'      => 'number_int',
            'value'       => 1,
        ],
        'show_phone'               => [
            'category'    => 'show',
            'title'       => _a('Show phone'),
            'description' => '',
            'edit'        => 'checkbox',
            'filter'      => 'number_int',
            'value'       => 1,
        ],
        'show_description'         => [
            'category'    => 'show',
            'title'       => _a('Show description'),
            'description' => '',
            'edit'        => 'checkbox',
            'filter'      => 'number_int',
            'value'       => 1,
        ],
        'show_hits'                => [
            'category'    => 'show',
            'title'       => _a('Show Hits'),
            'description' => '',
            'edit'        => 'checkbox',
            'filter'      => 'number_int',
            'value'       => 1,
        ],
        'show_tag'                 => [
            'category'    => 'show',
            'title'       => _a('Show Tags'),
            'description' => '',
            'edit'        => 'checkbox',
            'filter'      => 'number_int',
            'value'       => 1,
        ],
        'show_related'             => [
            'category'    => 'show',
            'title'       => _a('Show relateds'),
            'description' => '',
            'edit'        => 'checkbox',
            'filter'      => 'number_int',
            'value'       => 1,
        ],
        // Image
        'image_size'               => [
            'category'    => 'image',
            'title'       => _a('Image Size'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 1000000,
        ],
        'image_quality'            => [
            'category'    => 'image',
            'title'       => _a('Image quality'),
            'description' => _a('Between 0 to 100 and support both of JPG and PNG, default is 75'),
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 75,
        ],
        'image_path'               => [
            'category'    => 'image',
            'title'       => _a('Image path'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'string',
            'value'       => 'portfolio/image',
        ],
        'image_extension'          => [
            'category'    => 'image',
            'title'       => _a('Image Extension'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'string',
            'value'       => 'jpg,jpeg,png,gif',
        ],
        'image_largeh'             => [
            'category'    => 'image',
            'title'       => _a('Large Image height'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 1200,
        ],
        'image_largew'             => [
            'category'    => 'image',
            'title'       => _a('Large Image width'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 1200,
        ],
        'image_itemw'              => [
            'category'    => 'image',
            'title'       => _a('Item Image width'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 800,
        ],
        'image_itemh'              => [
            'category'    => 'image',
            'title'       => _a('Item Image height'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 800,
        ],
        'image_mediumh'            => [
            'category'    => 'image',
            'title'       => _a('Medium Image height'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 500,
        ],
        'image_mediumw'            => [
            'category'    => 'image',
            'title'       => _a('Medium Image width'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 500,
        ],
        'image_thumbh'             => [
            'category'    => 'image',
            'title'       => _a('Thumb Image height'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 250,
        ],
        'image_thumbw'             => [
            'category'    => 'image',
            'title'       => _a('Thumb Image width'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'number_int',
            'value'       => 250,
        ],
        'image_watermark'          => [
            'category'    => 'image',
            'title'       => _a('Add Watermark'),
            'description' => '',
            'edit'        => 'checkbox',
            'filter'      => 'number_int',
            'value'       => 0,
        ],
        'image_watermark_source'   => [
            'category'    => 'image',
            'title'       => _a('Watermark Image'),
            'description' => '',
            'edit'        => 'text',
            'filter'      => 'string',
            'value'       => '',
        ],
        'image_watermark_position' => [
            'title'       => _a('Watermark Positio'),
            'description' => '',
            'edit'        => [
                'type'    => 'select',
                'options' => [
                    'options' => [
                        'top-left'     => _a('Top Left'),
                        'top-right'    => _a('Top Right'),
                        'bottom-left'  => _a('Bottom Left'),
                        'bottom-right' => _a('Bottom Right'),
                    ],
                ],
            ],
            'filter'      => 'text',
            'value'       => 'bottom-right',
            'category'    => 'image',
        ],
        // Social
        'social_sharing'           => [
            'title'       => _t('Social sharing items'),
            'description' => '',
            'edit'        => [
                'type'    => 'multi_checkbox',
                'options' => [
                    'options' => Pi::service('social_sharing')->getList(),
                ],
            ],
            'filter'      => 'array',
            'category'    => 'social',
        ],
        // Texts
        'text_description_index'   => [
            'category'    => 'head_meta',
            'title'       => _a('Description for index page'),
            'description' => '',
            'edit'        => 'textarea',
            'filter'      => 'string',
            'value'       => '',
        ],
    ],
];