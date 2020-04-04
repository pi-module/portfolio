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

namespace Module\Portfolio\Api;

use Pi;
use Pi\Search\AbstractSearch;

class Search extends AbstractSearch
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'project';

    /**
     * {@inheritDoc}
     */
    protected $searchIn
        = [
            'title',
            'text_description',
        ];

    /**
     * {@inheritDoc}
     */
    protected $meta
        = [
            'id'               => 'id',
            'title'            => 'title',
            'text_description' => 'content',
            'time_create'      => 'time',
            'main_image'       => 'main_image',
            'slug'             => 'slug',
        ];

    /**
     * {@inheritDoc}
     */
    protected $condition
        = [
            'status' => 1,
        ];

    /**
     * {@inheritDoc}
     */
    protected function buildUrl(array $item, $table = '')
    {
        $link = Pi::service('url')->assemble(
            'portfolio', [
                'module'     => $this->getModule(),
                'controller' => 'project',
                'slug'       => $item['slug'],
            ]
        );

        return $link;
    }

    /**
     * {@inheritDoc}
     */
    protected function buildImage(array $item, $table = '')
    {
        return Pi::url((string)Pi::api('doc', 'media')->getSingleLinkUrl($item['main_image'])->setConfigModule('portfolio')->thumb('thumbnail'));
    }
}
