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
use Pi\Filter;
use Pi\Mvc\Controller\ActionController;
use Module\Portfolio\Form\TypeForm;
use Module\Portfolio\Form\TypeFilter;

class TypeController extends ActionController
{
    public function indexAction()
    {
        // Get info
        $list   = [];
        $order  = ['view_order DESC', 'id DESC'];
        $select = $this->getModel('type')->select()->order($order);
        $rowset = $this->getModel('type')->selectWith($select);

        // Make list
        foreach ($rowset as $row) {
            $list[$row->id] = $row->toArray();
        }

        // Set view
        $this->view()->setTemplate('type-index');
        $this->view()->assign('list', $list);
    }

    public function updateAction()
    {
        // Get id
        $id = $this->params('id');

        // Set option
        $option = [
            'id' => $id
        ];

        // Set form
        $form = new TypeForm('type', $option);
        $form->setAttribute('enctype', 'multipart/form-data');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();

            // Set slug
            $slug         = ($data['slug']) ? $data['slug'] : $data['title'];
            $filter       = new Filter\Slug;
            $data['slug'] = $filter($slug);

            // Form filter
            $form->setInputFilter(new TypeFilter($option));
            $form->setData($data);
            if ($form->isValid()) {
                $values = $form->getData();

                // Save values
                if (!empty($id)) {
                    $row = $this->getModel('type')->find($id);
                } else {
                    $row = $this->getModel('type')->createRow();
                }
                $row->assign($values);
                $row->save();

                // Clear registry
                Pi::registry('typeRoute', 'portfolio')->clear();

                // Jump
                $message = __('Project type data saved successfully.');
                $this->jump(['action' => 'index'], $message);
            }
        } else {
            if ($id) {
                $type = $this->getModel('type')->find($id)->toArray();
                $form->setData($type);
            }
        }

        // Set view
        $this->view()->setTemplate('type-update');
        $this->view()->assign('form', $form);
        $this->view()->assign('title', __('Manage type'));
    }
}
