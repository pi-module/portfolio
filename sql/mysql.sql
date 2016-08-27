CREATE TABLE `{project}` (
  `id`              INT(10) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `title`           VARCHAR(255)        NOT NULL,
  `slug`            VARCHAR(255)        NOT NULL,
  `service`         VARCHAR(255)        NOT NULL,
  `technology`      VARCHAR(255)        NOT NULL,
  `website`         VARCHAR(64)         NOT NULL,
  `website_view`    TINYINT(1) UNSIGNED NOT NULL,
  `information`     TEXT                NOT NULL,
  `seo_title`       VARCHAR(255)        NOT NULL,
  `seo_keywords`    VARCHAR(255)        NOT NULL,
  `seo_description` VARCHAR(255)        NOT NULL,
  `time_create`     INT(10) UNSIGNED    NOT NULL,
  `time_update`     INT(10) UNSIGNED    NOT NULL,
  `uid`             INT(10) UNSIGNED    NOT NULL,
  `hits`            INT(10) UNSIGNED    NOT NULL,
  `image`           VARCHAR(255)        NOT NULL,
  `path`            VARCHAR(16)         NOT NULL,
  `status`          TINYINT(1) UNSIGNED NOT NULL,
  `point`           INT(10)             NOT NULL,
  `count`           INT(10) UNSIGNED    NOT NULL,
  `favourite`       INT(10) UNSIGNED    NOT NULL,
  `commentby`       VARCHAR(255)        NOT NULL,
  `comment`         TEXT                NOT NULL,
  `customer`        VARCHAR(255)        NOT NULL,
  `version`         VARCHAR(64)         NOT NULL,
  `size`            VARCHAR(64)         NOT NULL,
  `link_1`          VARCHAR(64)         NOT NULL,
  `link_2`          VARCHAR(64)         NOT NULL,
  `link_3`          VARCHAR(64)         NOT NULL,
  `link_4`          VARCHAR(64)         NOT NULL,
  `link_5`          VARCHAR(64)         NOT NULL,
  `image_1`         VARCHAR(255)        NOT NULL,
  `image_2`         VARCHAR(255)        NOT NULL,
  `image_3`         VARCHAR(255)        NOT NULL,
  `image_4`         VARCHAR(255)        NOT NULL,
  `image_5`         VARCHAR(255)        NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `title` (`title`),
  KEY `time_create` (`time_create`),
  KEY `status` (`status`),
  KEY `project_order` (`id`, `time_create`)
);