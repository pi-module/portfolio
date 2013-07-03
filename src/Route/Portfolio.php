<?php
/**
 * Portfolio route implementation
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
 * @author          Taiwen Jiang <taiwenjiang@tsinghua.org.cn>
 * @author          Hossein Azizabadi <azizabadi@faragostaresh.com>
 * @since           3.0
 * @package         Module\Portfolio
 * @subpackage      Route
 * @version         $Id$
 */

namespace Module\Portfolio\Route;

use Pi\Mvc\Router\Http\Standard;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\Stdlib\RequestInterface as Request;

class Portfolio extends Standard
{

    protected $prefix = '/portfolio';

    /**
     * Default values.
     *
     * @var array
     */
    protected $defaults = array(
        'module' => 'portfolio',
        'controller' => 'index',
        'action' => 'index'
    );

    /**
     * match(): defined by Route interface.
     *
     * @see    Route::match()
     * @param  Request $request
     * @return RouteMatch
     */
    public function match(Request $request, $pathOffset = null)
    {
        $result = $this->canonizePath($request, $pathOffset);
        if (null === $result) {
            return null;
        }

        list($path, $pathLength) = $result;
        if (empty($path)) {
            return null;
        }

        list($path, $item) = explode($this->paramDelimiter, $path, 2);

        switch ($path) {
            case 'page':
                $matches = array(
                    'action' => 'index',
                    'page' => $item ? intval($item) : null,
                );
                break;

            case 'project':
                $matches = array(
                    'controller' => 'project',
                    'action' => 'index',
                    'project' => $item ? urldecode($item) : null,
                );
                break;
        }

        return new RouteMatch(array_merge($this->defaults, $matches), $pathLength);
    }

    /**
     * assemble(): Defined by Route interface.
     *
     * @see    Route::assemble()
     * @param  array $params
     * @param  array $options
     * @return mixed
     */
    public function assemble(array $params = array(), array $options = array())
    {
        $mergedParams = array_merge($this->defaults, $params);
        if (!$mergedParams) {
            return $this->prefix;
        }

        if (!empty($mergedParams['project'])) {
            $url['project'] = 'project' . $this->paramDelimiter . $mergedParams['project'];
        }

        if (!empty($mergedParams['page'])) {
            $url['page'] = 'page' . $this->paramDelimiter . $mergedParams['page'];
        }

        $url = implode($this->paramDelimiter, $url);

        if (empty($url)) {
            return $this->prefix;
        }
        return $this->prefix . $this->paramDelimiter . $url;
    }
}