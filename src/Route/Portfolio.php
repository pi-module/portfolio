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

namespace Module\Portfolio\Route;

use Pi\Mvc\Router\Http\Standard;

class Portfolio extends Standard
{

    /**
     * Default values.
     *
     * @var array
     */
    protected $defaults
        = [
            'module'     => 'portfolio',
            'controller' => 'index',
            'action'     => 'index',
        ];


    /**
     * {@inheritDoc}
     */
    protected $structureDelimiter = '/';

    protected $controllerList
        = [
            'index', 'project', 'tag', 'type',
        ];

    /**
     * {@inheritDoc}
     */
    protected function parse($path)
    {
        $matches = [];
        $parts   = array_filter(explode($this->structureDelimiter, $path));

        // Set controller
        $matches = array_merge($this->defaults, $matches);
        if (isset($parts[0]) && in_array($parts[0], $this->controllerList)) {
            $matches['controller'] = $this->decode($parts[0]);
        }

        // Make Match
        if (isset($matches['controller'])) {
            switch ($matches['controller']) {
                case 'index':
                    if (isset($parts[0]) && !empty($parts[0])) {
                        $matches['controller'] = 'project';
                        $matches['slug']       = $this->decode($parts[0]);
                    }
                    break;

                case 'tag':
                    $matches['slug'] = $parts[1] ? $this->decode($parts[1]) : null;
                    break;

                case 'type':
                    $matches['slug'] = $parts[1] ? $this->decode($parts[1]) : null;
                    break;

                case 'project':
                    $matches['slug'] = $parts[1] ? $this->decode($parts[1]) : null;
                    break;
            }
        }

        /* echo '<div>';
        print_r($parts);
        print_r($matches);
        echo '</div>'; */

        return $matches;
    }

    /**
     * assemble(): Defined by Route interface.
     *
     * @param array $params
     * @param array $options
     *
     * @return string
     * @see    Route::assemble()
     */
    public function assemble(
        array $params = [],
        array $options = []
    ) {
        $mergedParams = array_merge($this->defaults, $params);
        if (!$mergedParams) {
            return $this->prefix;
        }

        // Set module
        if (!empty($mergedParams['module'])) {
            $url['module'] = $mergedParams['module'];
        }
        if (!empty($mergedParams['controller'])
            && $mergedParams['controller'] != 'index'
            && $mergedParams['controller'] != 'project'
        ) {
            $url['controller'] = $mergedParams['controller'];
        }
        if (!empty($mergedParams['action']) && $mergedParams['action'] != 'index') {
            $url['action'] = $mergedParams['action'];
        }
        if (!empty($mergedParams['slug'])) {
            $url['slug'] = $mergedParams['slug'];
        }
        if (!empty($mergedParams['page'])) {
            $url['page'] = 'page' . $this->paramDelimiter . $mergedParams['page'];
        }

        // Make url
        $url = implode($this->paramDelimiter, $url);

        if (empty($url)) {
            return $this->prefix;
        }
        return $this->paramDelimiter . $url;
    }
}