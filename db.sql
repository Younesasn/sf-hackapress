-- Adminer 5.3.0 MySQL 9.3.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `civility`;
CREATE TABLE `civility` (
  `id` int NOT NULL AUTO_INCREMENT,
  `wording` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `civility` (`id`, `wording`) VALUES
(1,	'Madame'),
(2,	'Monsieur'),
(3,	'Autres');

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240918231745',	'2025-07-18 14:41:01',	245);

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5D9F75A112469DE2` (`category_id`),
  CONSTRAINT `FK_5D9F75A112469DE2` FOREIGN KEY (`category_id`) REFERENCES `service_category` (`id`),
  CONSTRAINT `FK_5D9F75A1BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `command_id` int NOT NULL,
  `product_id` int NOT NULL,
  `matter_id` int NOT NULL,
  `status_id` int NOT NULL,
  `service_id` int NOT NULL,
  `employee_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1F1B251E33E1689A` (`command_id`),
  KEY `IDX_1F1B251E4584665A` (`product_id`),
  KEY `IDX_1F1B251ED614E59F` (`matter_id`),
  KEY `IDX_1F1B251E6BF700BD` (`status_id`),
  KEY `IDX_1F1B251EED5CA9E6` (`service_id`),
  KEY `IDX_1F1B251E8C03F15C` (`employee_id`),
  CONSTRAINT `FK_1F1B251E33E1689A` FOREIGN KEY (`command_id`) REFERENCES `order` (`id`),
  CONSTRAINT `FK_1F1B251E4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_1F1B251E6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `FK_1F1B251E8C03F15C` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  CONSTRAINT `FK_1F1B251ED614E59F` FOREIGN KEY (`matter_id`) REFERENCES `matter` (`id`),
  CONSTRAINT `FK_1F1B251EED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `matter`;
CREATE TABLE `matter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coeff` decimal(3,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `matter` (`id`, `name`, `coeff`) VALUES
(1,	'Coton',	1.00),
(2,	'Daim',	1.20),
(3,	'Velours',	2.00),
(4,	'Cuir',	2.00),
(5,	'Soie',	3.00),
(6,	'Laine',	1.50),
(7,	'Lin',	1.10),
(8,	'Polyester',	0.90),
(9,	'Nylon',	1.00),
(10,	'Viscose',	1.30),
(11,	'Cachemire',	2.50),
(12,	'Acrylique',	1.00),
(13,	'Jeans (Denim)',	1.10),
(14,	'Tweed',	1.80),
(15,	'Microfibre',	1.40);

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `date` datetime NOT NULL,
  `total_price` double NOT NULL,
  `deposit` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F52993989395C3F3` (`customer_id`),
  KEY `IDX_F52993984C3A3BB` (`payment_id`),
  CONSTRAINT `FK_F52993984C3A3BB` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`),
  CONSTRAINT `FK_F52993989395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `payment` (`id`, `name`, `icon`) VALUES
(1,	'Carte bancaire',	'fa-brands fa-cc-visa'),
(2,	'Paypal',	'fa-brands fa-paypal'),
(3,	'Apple Pay',	'fa-brands fa-apple-pay');

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`),
  CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product` (`id`, `category_id`, `name`, `description`) VALUES
(1,	1,	'Chemise',	'Chemise élégante et parfaitement repassée, idéale pour le bureau ou les occasions spéciales. Confort et style garantis.'),
(2,	2,	'Pantalon',	'Pantalon repassé avec soin, offrant une allure impeccable pour vos journées de travail ou vos sorties décontractées.'),
(3,	6,	'Chaussure',	'Chaussures nettoyées et entretenues pour un éclat durable, prêtes à accompagner tous vos déplacements avec élégance.'),
(4,	1,	'Veste',	'Veste repassée et nettoyée en profondeur pour une présentation impeccable, que ce soit pour le travail ou des occasions spéciales.'),
(5,	3,	'Robe',	'Robe soigneusement nettoyée et repassée, prête à vous faire briller lors de soirées ou événements formels.'),
(6,	1,	'Blouson',	'Blouson nettoyé avec des techniques adaptées pour préserver la qualité du tissu tout en offrant une protection optimale.'),
(7,	4,	'Cravate',	'Cravate nettoyée et repassée, idéale pour une présentation professionnelle soignée.'),
(8,	1,	'Manteau',	'Manteau soigneusement nettoyé pour enlever toutes les taches et garantir une fraîcheur durable, parfait pour l’hiver.'),
(9,	5,	'Couette',	'Couette nettoyée en profondeur, assurant une hygiène irréprochable pour un sommeil confortable et sain.'),
(10,	5,	'Oreiller',	'Oreiller nettoyé et désinfecté, idéal pour un sommeil réparateur.'),
(11,	5,	'Tapis',	'Tapis nettoyé à sec ou en profondeur, préservant la qualité et la couleur tout en éliminant la saleté et les taches.'),
(12,	1,	'Costume',	'Costume nettoyé et repassé avec soin, parfait pour une allure professionnelle ou pour des occasions spéciales.'),
(13,	2,	'Jupe',	'Jupe repassée et nettoyée, idéale pour des sorties élégantes ou professionnelles.'),
(14,	5,	'Serviette',	'Serviette nettoyée et assouplie, offrant douceur et propreté pour chaque utilisation.');

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CDFC7356727ACA70` (`parent_id`),
  CONSTRAINT `FK_CDFC7356727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `product_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product_category` (`id`, `parent_id`, `name`) VALUES
(1,	NULL,	'Hauts'),
(2,	NULL,	'Bas'),
(3,	NULL,	'Robes'),
(4,	NULL,	'Accessoires'),
(5,	NULL,	'Linge de maison'),
(6,	NULL,	'Divers');

DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E19D9AD212469DE2` (`category_id`),
  CONSTRAINT `FK_E19D9AD212469DE2` FOREIGN KEY (`category_id`) REFERENCES `service_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `service` (`id`, `category_id`, `name`, `description`, `picture`, `price`) VALUES
(1,	1,	'Repassage Simple',	'Un service de repassage rapide et soigné pour vos vêtements du quotidien, avec une attention particulière aux détails.',	'repassage-simple.webp',	9.99),
(2,	1,	'Repassage Complet',	'Un service de repassage complet qui garantit des vêtements impeccables, y compris les pièces les plus délicates.',	'repassage-complet.webp',	14.99),
(3,	2,	'Nettoyage Simple',	'Nettoyage basique de vos vêtements avec des produits de qualité, idéal pour l’entretien régulier de votre garde-robe.',	'nettoyage-simple.webp',	11.99),
(4,	2,	'Nettoyage Complet',	'Un nettoyage en profondeur pour éliminer les taches tenaces et rafraîchir vos vêtements, tout en respectant les textiles délicats.',	'nettoyage-complet.webp',	16.99),
(5,	3,	'Retouche Simple',	'Ajustements mineurs de vos vêtements pour un meilleur ajustement, comme des ourlets ou des reprises de coutures.',	'retouche-simple.webp',	14.99),
(6,	3,	'Retouche Complète',	'Service de retouche complet pour des modifications plus importantes, comme le réajustement de la taille ou la refonte de pièces spécifiques.',	'retouche-complet.webp',	18.99);

DROP TABLE IF EXISTS `service_category`;
CREATE TABLE `service_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_price` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `service_category` (`id`, `name`, `description`, `start_price`) VALUES
(1,	'Repassage',	'Nous offrons un service de repassage professionnel, avec une attention particulière aux détails pour garantir des vêtements impeccablement repassés et prêts à porter.',	9.99),
(2,	'Nettoyage',	'Notre service de nettoyage professionnel prend soin de vos vêtements en profondeur, en utilisant des produits de qualité pour un résultat frais et propre.',	11.99),
(3,	'Retouche',	'Confiez-nous vos vêtements pour des retouches précises et sur mesure, assurant un ajustement parfait à chaque fois.',	14.99);

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `status` (`id`, `name`) VALUES
(1,	'En attente de validation'),
(2,	'En cours'),
(3,	'Terminé');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `civility_id` int NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_USERNAME` (`username`),
  KEY `IDX_8D93D64923D6A298` (`civility_id`),
  CONSTRAINT `FK_8D93D64923D6A298` FOREIGN KEY (`civility_id`) REFERENCES `civility` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2025-07-18 15:15:32 UTC