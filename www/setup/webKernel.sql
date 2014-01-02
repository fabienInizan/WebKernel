-- phpMyAdmin SQL Dump
-- version 4.1.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 02 Janvier 2014 à 11:46
-- Version du serveur :  5.5.34-MariaDB-log
-- Version de PHP :  5.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `webKernel`
--

-- --------------------------------------------------------

--
-- Structure de la table `accessLevel`
--

CREATE TABLE IF NOT EXISTS `accessLevel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` tinyint(3) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `accessLevel`
--

INSERT INTO `accessLevel` (`id`, `level`, `name`) VALUES
(1, 255, 'Master administrator'),
(2, 0, 'Anonymous visitor');

-- --------------------------------------------------------

--
-- Structure de la table `actionRestriction`
--

CREATE TABLE IF NOT EXISTS `actionRestriction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` varchar(511) DEFAULT NULL,
  `accessLevel` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `actionRestriction`
--

INSERT INTO `actionRestriction` (`id`, `module`, `action`, `description`, `accessLevel`) VALUES
(1, 'plugin', 'add', 'Install a new plugin', 255),
(2, 'plugin', 'delete', 'Uninstall a plugin', 255),
(3, 'plugin', 'display', 'Display detailed information about a plugin', 255),
(4, 'plugin', 'displayAddForm', 'Display the installation form for a new plugin', 255),
(5, 'plugin', 'displayDeleteForm', 'Display the delete form of a plugin', 255),
(6, 'plugin', 'displayPurgeForm', 'Display the purge (data reset) form of a plugin', 255),
(7, 'plugin', 'index', 'Display a list of the installed plugin', 255),
(8, 'plugin', 'purge', 'Reset all the data associated to a plugin', 255),
(9, 'accessLevel', 'add', 'Create a new access level', 255),
(10, 'accessLevel', 'delete', 'Delete an access level', 255),
(11, 'accessLevel', 'displayAddForm', 'Display the access level creation form', 255),
(12, 'accessLevel', 'displayDeleteForm', 'Display the delete form of an access level', 255),
(13, 'accessLevel', 'displayEditForm', 'Display the edition form of an access level', 255),
(14, 'accessLevel', 'edit', 'Apply modifications to an access level', 255),
(15, 'accessLevel', 'index', 'Display a list of the access levels', 255),
(16, 'user', 'add', 'Create a new user', 255),
(17, 'user', 'delete', 'Delete an user', 255),
(18, 'user', 'displayAddForm', 'Display the user creation form', 255),
(19, 'user', 'displayDeleteForm', 'Display the delete form of an user', 255),
(20, 'user', 'displayEditForm', 'Display the edition form of an user', 255),
(21, 'user', 'edit', 'Apply modifications to an user', 255),
(22, 'user', 'index', 'Display a list of the users', 255),
(23, 'actionRestriction', 'displayEditForm', 'Display the edition form of an action restriction', 255),
(24, 'actionRestriction', 'edit', 'Apply modifications on an action restriction', 255),
(25, 'actionRestriction', 'index', 'Diplay a list of the action restrictions', 255),
(26, 'admin', 'index', 'Show the main page of the administration section', 255),
(28, 'admin', 'logout', 'Show the logout page of the administration section', 255),
(29, 'admin', 'phpinfo', 'Show the detailed configuration of PHP on the server (output of the phpinfo() function)', 255),
(30, 'actionRestriction', 'displayExceptions', 'Display the exceptions associated to this module and action couple', 255),
(31, 'actionRestriction', 'displayAddExceptionForm', 'Display the action restriction exception creation form', 255),
(32, 'actionRestriction', 'displayEditExceptionForm', 'Display the action restriction exception edition form', 255),
(33, 'actionRestriction', 'displayDeleteExceptionForm', 'Display the action restriction exception delete form', 255),
(34, 'actionRestriction', 'addException', 'Add a new action restriction exception', 255),
(35, 'actionRestriction', 'editException', 'Edit an action restriction exception', 255),
(36, 'actionRestriction', 'deleteException', 'Delete an action restriction exception', 255),
(37, 'admin', 'setMaintenanceMode', 'Switch to maintenance mode', 255),
(38, 'admin', 'resetMaintenanceMode', 'Resume to normal mode from maintenance mode', 255);

-- --------------------------------------------------------

--
-- Structure de la table `actionRestrictionException`
--

CREATE TABLE IF NOT EXISTS `actionRestrictionException` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `exceptionString` varchar(2047) NOT NULL,
  `accessLevel` int(10) unsigned NOT NULL DEFAULT '255',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `plugin`
--

CREATE TABLE IF NOT EXISTS `plugin` (
  `id` varchar(127) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `version` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accessLevel` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'From 0 (anonymous visitor) to 255 (master admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
