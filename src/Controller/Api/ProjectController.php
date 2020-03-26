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

namespace Module\Portfolio\Controller\Api;

use Pi;
use Pi\Mvc\Controller\ActionController;

class ProjectController extends ActionController
{
    public function listAction()
    {
        // Set default result
        $result = [
            'result' => false,
            'data'   => [],
            'error'  => [
                'code'        => 1,
                'message'     => __('Nothing selected'),
                'messageFlag' => false,
            ],
        ];

        // Get info from url
        $token = $this->params('token');

        // Check token
        $check = Pi::api('token', 'tools')->check($token);
        if ($check['status'] == 1) {

            // Get post request
            $post = $this->request->getPost();

            // Clean params
            $params = [];
            foreach ($post as $key => $value) {
                $key               = _strip($key);
                $value             = _strip($value);
                $params[$key] = $value;
            }

            if (!isset($params['page']) || empty($params['page'])) {
                $params['page'] = 1;
            }

            // Get request
            $list = Pi::api('project', 'portfolio')->getProjectList($params);

            // Set result
            $result = [
                'result' => true,
                'data'   => array_values($list),
                'error'  => [
                    'code'    => 0,
                    'message' => '',
                ],
            ];
        } else {
            // Set error
            $result['error'] = [
                'code'    => $check['code'],
                'message' => $check['message'],
            ];
        }

        return $result;
    }

    public function singleAction()
    {
        // Set default result
        $result = [
            'result' => false,
            'data'   => [],
            'error'  => [
                'code'        => 1,
                'message'     => __('Nothing selected'),
                'messageFlag' => false,
            ],
        ];

        // Get info from url
        $token = $this->params('token');
        $projectId = $this->params('project_id');

        // Check token
        $check = Pi::api('token', 'tools')->check($token);
        if ($check['status'] == 1) {

            // Check
            if (intval($projectId) > 0) {
                // Get project
                $project = Pi::api('project', 'portfolio')->getProject(intval($projectId));

                // Set result
                $result = [
                    'result' => true,
                    'data'   => [
                        $project
                    ],
                    'error'  => [
                        'code'    => 0,
                        'message' => '',
                    ],
                ];
            } else {
                // Set error
                $result['error'] = [
                    'code'    => 1,
                    'message' => __('Please select project !'),
                ];
            }
        } else {
            // Set error
            $result['error'] = [
                'code'    => $check['code'],
                'message' => $check['message'],
            ];
        }

        return $result;
    }
}