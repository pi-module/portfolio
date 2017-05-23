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
namespace Module\Portfolio\Model;

use Pi\Application\Model\Model;

class Project extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $columns = array(
        'id',
        'title',
        'slug',
        'type',
        'recommended',
        'service',
        'technology',
        'website',
        'website_view',
        'phone',
        'phone_view',
        'information',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'time_create',
        'time_update',
        'uid',
        'hits',
        'image',
        'path',
        'status',
        'point',
        'count',
        'favourite',
        'commentby',
        'comment',
        'customer',
        'version',
        'size',
        'link_1',
        'link_2',
        'link_3',
        'link_4',
        'link_5',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5'
    );
}