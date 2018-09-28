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

namespace Module\Portfolio\Controller\Admin;

use Pi;
use Pi\Mvc\Controller\ActionController;

class ToolsController extends ActionController
{
    public function indexAction()
    {}

    public function migrateMediaAction()
    {
        $message = Pi::api('project', 'portfolio')->migrateMedia();

        if (empty($message)) {
            $message = __('Media have migrate successfully');
        }
        $this->jump(array('action' => 'index'), $message);
    }
}
