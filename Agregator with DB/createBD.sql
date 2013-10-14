CREATE TABLE ProviderInfo
(
	  `id_provider` INT(3) UNSIGNED  NOT NULL AUTO_INCREMENT COMMENT 'id провайдера',
	  `provider_name` VARCHAR(50) NOT NULL COMMENT 'имя провайдера',
	  `provider_url` VARCHAR(255) NOT NULL COMMENT 'ссылка',
	  `count_news` INT(3) UNSIGNED) NOT NULL COMMENT 'количество',
		CONSTRAINT ixId PRIMARY KEY (id_provider)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


CREATE TABLE ProviderNews
(
	  `id_provider` INT(3) UNSIGNED  NOT NULL AUTO_INCREMENT COMMENT 'id провайдера',
	  `provider_name` VARCHAR(50) NOT NULL COMMENT 'имя провайдера',
	  `provider_title` VARCHAR(255) NOT NULL COMMENT 'заголовок',
	  `provider_url` VARCHAR(255) NOT NULL COMMENT 'ссылка',
	  `provider_description` TEXT NOT NULL COMMENT 'описание',
		CONSTRAINT ixIdPro PRIMARY KEY (id_provider)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
