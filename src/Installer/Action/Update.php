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
namespace Module\Portfolio\Installer\Action;

use Pi;
use Pi\Application\Installer\Action\Update as BasicUpdate;
use Pi\Application\Installer\SqlSchema;
use Zend\EventManager\Event;

class Update extends BasicUpdate
{
    /**
     * {@inheritDoc}
     */
    protected function attachDefaultListeners()
    {
        $events = $this->events;
        $events->attach('update.pre', array($this, 'updateSchema'));
        parent::attachDefaultListeners();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function updateSchema(Event $e)
    {
        $moduleVersion = $e->getParam('version');

        // Set project model
        $projectModel = Pi::model('project', $this->module);
        $projectTable = $projectModel->getTable();
        $projectAdapter = $projectModel->getAdapter();

        // Set type model
        $typeModel = Pi::model('type', $this->module);
        $typeTable = $typeModel->getTable();
        $typeAdapter = $typeModel->getAdapter();

        // Update to version 1.1.0
        if (version_compare($moduleVersion, '1.1.0', '<')) {

            // Alter table : ADD type
            $sql = sprintf("ALTER TABLE %s ADD `type` INT(10) UNSIGNED NOT NULL DEFAULT '0', ADD INDEX (`type`) ", $projectTable);
            try {
                $projectAdapter->query($sql, 'execute');
            } catch (\Exception $exception) {
                $this->setResult('db', array(
                    'status' => false,
                    'message' => 'Table alter query failed: '
                        . $exception->getMessage(),
                ));
                return false;
            }

            // Alter table : ADD recommended
            $sql = sprintf("ALTER TABLE %s ADD `recommended` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0', ADD INDEX (`recommended`) ", $projectTable);
            try {
                $projectAdapter->query($sql, 'execute');
            } catch (\Exception $exception) {
                $this->setResult('db', array(
                    'status' => false,
                    'message' => 'Table alter query failed: '
                        . $exception->getMessage(),
                ));
                return false;
            }

            // Alter table add index
            $sql = sprintf("ALTER TABLE %s ADD INDEX `project_order_recommended` (`recommended`, `time_create`, `id`)", $projectTable);
            try {
                $projectAdapter->query($sql, 'execute');
            } catch (\Exception $exception) {
                $this->setResult('db', array(
                    'status' => false,
                    'message' => 'Table alter query failed: '
                        . $exception->getMessage(),
                ));
                return false;
            }

            // Add table : type
            $sql = <<<'EOD'
CREATE TABLE `{type}` (
  `id`     INT(10) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `title`  VARCHAR(255)        NOT NULL DEFAULT '',
  `slug`   VARCHAR(255)        NOT NULL DEFAULT '',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `status` (`status`)
);
EOD;
            SqlSchema::setType($this->module);
            $sqlHandler = new SqlSchema;
            try {
                $sqlHandler->queryContent($sql);
            } catch (\Exception $exception) {
                $this->setResult('db', array(
                    'status' => false,
                    'message' => 'SQL schema query for author table failed: '
                        . $exception->getMessage(),
                ));

                return false;
            }
            
        }

        // Update to version 1.2.3
        if (version_compare($moduleVersion, '1.2.3', '<')) {
            // Alter table : ADD phone
            $sql = sprintf("ALTER TABLE %s ADD `phone` VARCHAR(16) NOT NULL  DEFAULT ''", $projectTable);
            try {
                $projectAdapter->query($sql, 'execute');
            } catch (\Exception $exception) {
                $this->setResult('db', array(
                    'status' => false,
                    'message' => 'Table alter query failed: '
                        . $exception->getMessage(),
                ));
                return false;
            }

            // Alter table : ADD phone_view
            $sql = sprintf("ALTER TABLE %s ADD `phone_view` TINYINT(1) UNSIGNED NOT NULL  DEFAULT '0'", $projectTable);
            try {
                $projectAdapter->query($sql, 'execute');
            } catch (\Exception $exception) {
                $this->setResult('db', array(
                    'status' => false,
                    'message' => 'Table alter query failed: '
                        . $exception->getMessage(),
                ));
                return false;
            }
        }

        // Update to version 1.2.7
        if (version_compare($moduleVersion, '1.2.7', '<')) {
            // Alter table : ADD main_image
            $sql = sprintf("ALTER TABLE %s ADD `main_image` INT(10) UNSIGNED NOT NULL DEFAULT '0'", $projectTable);
            try {
                $projectAdapter->query($sql, 'execute');
            } catch (\Exception $exception) {
                $this->setResult('db', array(
                    'status' => false,
                    'message' => 'Table alter query failed: '
                        . $exception->getMessage(),
                ));
                return false;
            }

            // Alter table : ADD additional_images
            $sql = sprintf("ALTER TABLE %s ADD `additional_images` TEXT", $projectTable);
            try {
                $projectAdapter->query($sql, 'execute');
            } catch (\Exception $exception) {
                $this->setResult('db', array(
                    'status' => false,
                    'message' => 'Table alter query failed: '
                        . $exception->getMessage(),
                ));
                return false;
            }
        }

        // Update to version 1.2.8
        if (version_compare($moduleVersion, '1.2.8', '<')) {
            // Alter table : ADD main_image
            $sql = sprintf("ALTER TABLE %s ADD `text_description` TEXT", $typeTable);
            try {
                $typeAdapter->query($sql, 'execute');
            } catch (\Exception $exception) {
                $this->setResult('db', array(
                    'status' => false,
                    'message' => 'Table alter query failed: '
                        . $exception->getMessage(),
                ));
                return false;
            }
        }

        // Update to version 1.3.0
        if (version_compare($moduleVersion, '1.3.0', '<')) {
            // Alter table : ADD main_image
            $sql = sprintf("ALTER TABLE %s CHANGE `information` `text_description` TEXT", $projectTable);
            try {
                $projectAdapter->query($sql, 'execute');
            } catch (\Exception $exception) {
                $this->setResult('db', array(
                    'status' => false,
                    'message' => 'Table alter query failed: '
                        . $exception->getMessage(),
                ));
                return false;
            }
        }

        return true;
    }
}