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
use Pi\Application\Api\AbstractBreadcrumbs;

class Breadcrumbs extends AbstractBreadcrumbs
{
    /**
     * {@inheritDoc}
     */
    public function load()
    {
        // Get params
        $params = Pi::service('url')->getRouteMatch()->getParams();

        // Set module link
        $moduleData = Pi::registry('module')->read($this->getModule());
        $result     = [];

        // Set module internal links
        switch ($params['controller']) {
            case 'index':
                $result[] = [
                    'label' => $moduleData['title'],
                ];
                break;

            case 'tag':
                $result[] = [
                    'label' => $moduleData['title'],
                    'href'  => Pi::service('url')->assemble(
                        'portfolio', [
                        'module' => $this->getModule(),
                    ]
                    ),
                ];
                $result[] = [
                    'label' => $params['slug'],
                ];
                break;

            case 'type':
                $type     = Pi::model('type', 'portfolio')->find($params['slug'], 'slug')->toArray();
                $result[] = [
                    'label' => $moduleData['title'],
                    'href'  => Pi::service('url')->assemble(
                        'portfolio', [
                        'module' => $this->getModule(),
                    ]
                    ),
                ];
                $result[] = [
                    'label' => $type['title'],
                ];
                break;

            case 'project':
                $project  = Pi::api('project', 'portfolio')->getProject($params['slug'], 'slug');
                $result[] = [
                    'label' => $moduleData['title'],
                    'href'  => Pi::service('url')->assemble(
                        'portfolio', [
                        'module' => $this->getModule(),
                    ]
                    ),
                ];
                // Set main tag on Breadcrumbs
                if (Pi::service('module')->isActive('tag')) {
                    $tag = Pi::service('tag')->get($this->getModule(), $project['id'], '');

                    $result[] = [
                        'label' => $tag[0],
                        'href'  => Pi::service('url')->assemble(
                            'portfolio', [
                            'module'     => $this->getModule(),
                            'controller' => 'tag',
                            'slug'       => urlencode($tag[0]),
                        ]
                        ),
                    ];
                }
                $result[] = [
                    'label' => $project['title'],
                ];
                break;
        }
        // return
        return $result;
    }
}
