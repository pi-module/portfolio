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

        // Set item model
        $projectModel = Pi::model('project', $this->module);
        $projectTable = $projectModel->getTable();
        $projectAdapter = $projectModel->getAdapter();

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

            // Alter table : ADD display_order
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
        
        return true;
    }
}