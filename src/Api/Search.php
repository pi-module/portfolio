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
    protected $searchIn = array(
        'title',
        'information',
    );

    /**
     * {@inheritDoc}
     */
    protected $meta = array(
        'id'            => 'id',
        'title'         => 'title',
        'information'   => 'content',
        'time_create'   => 'time',
        'uid'           => 'uid',
        'slug'          => 'slug',
    );

    /**
     * {@inheritDoc}
     */
    protected $condition = array(
        'status'    => 1,
    );

    /**
     * {@inheritDoc}
     */
    protected function buildUrl(array $item)
    {
        $link = Pi::service('url')->assemble('portfolio', array(
            'module'        => $this->getModule(),
            'controller'    => 'project',
            'slug'          => $item['slug'],
        ));

        return $link;
    }
}
