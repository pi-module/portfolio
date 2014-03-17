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
        $result = array(
            array(
                'label' => $moduleData['title'],
                'href'  => Pi::service('url')->assemble('default', array(
                    'module' => $this->getModule(),
                )),
            ),
        );
        // Set module internal links
        switch ($params['controller']) {
            case 'tag':
                $result[] = array(
                    'label' => $params['slug'],
                    'href'  => Pi::service('url')->assemble('portfolio', array(
                        'controller' => 'tag', 
                        'action' => 'index', 
                        'slug' => urlencode($params['slug'])
                    )),
                );
                break;

            case 'project':
                $project = Pi::api('project', 'portfolio')->getProject($params['slug'], 'slug');
                $result[] = array(
                    'label' => $project['title'],
                    'href'  => $project['projectUrl'],
                );
                break;    
        }

        return $result;
    }
}
