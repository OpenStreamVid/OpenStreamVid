-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 23 Janvier 2015 à 17:49
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `vidstream`
--

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `ContentId` varchar(255) COLLATE utf8_bin NOT NULL,
  `ContentTitle` varchar(50) COLLATE utf8_bin NOT NULL,
  `ContentDescription` text COLLATE utf8_bin NOT NULL,
  `ContentViews` int(11) NOT NULL DEFAULT '0',
  `ContentDateUpload` date NOT NULL,
  `ContentUser` int(255) NOT NULL,
  `ContentLicenceId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `content`
--

INSERT INTO `content` (`ContentId`, `ContentTitle`, `ContentDescription`, `ContentViews`, `ContentDateUpload`, `ContentUser`, `ContentLicenceId`) VALUES
('QW50aWxsZWN0dWFsIC0gTm8gSHVtYW4gSXMgSWxsZWdhbA==', 'Antillectual - No Human Is Illegal', 'Extract from Silencing Civilization', 6, '2014-12-31', 1, 1),
('U3RyZWV0bGlnaHQgTWFuaWZlc3Rv', 'Streetlight Manifesto', 'Live at Glaz''art', 4, '2014-12-31', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contenttag`
--

CREATE TABLE IF NOT EXISTS `contenttag` (
  `ContentId` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tagid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenttag`
--

INSERT INTO `contenttag` (`ContentId`, `tagid`) VALUES
('QW50aWxsZWN0dWFsIC0gTm8gSHVtYW4gSXMgSWxsZWdhbA==', 1),
('U3RyZWV0bGlnaHQgTWFuaWZlc3Rv', 1);

-- --------------------------------------------------------

--
-- Structure de la table `dislikes`
--

CREATE TABLE IF NOT EXISTS `dislikes` (
`DislikeId` int(250) NOT NULL,
  `ContentDislikeId` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `UserDislikeId` int(255) DEFAULT NULL,
  `DateDislike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `licence`
--

CREATE TABLE IF NOT EXISTS `licence` (
`LicenceId` int(11) NOT NULL,
  `LicenceName` varchar(100) NOT NULL,
  `LicenceAlias` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `licence`
--

INSERT INTO `licence` (`LicenceId`, `LicenceName`, `LicenceAlias`) VALUES
(1, 'Attribution', 'CC BY'),
(2, 'Attribution-ShareAlike ', 'CC BY-SA'),
(3, 'Attribution-NoDerivs ', 'CC BY-ND'),
(4, 'Attribution-NonCommercial', 'CC BY-NC'),
(5, 'Attribution-NonCommercial-ShareAlike ', 'CC BY-NC-SA'),
(6, 'Attribution-NonCommercial-NoDerivs', 'CC BY-NC-ND'),
(7, 'Copyright', 'C'),
(8, 'Public Domain', 'CC0');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
`LikeId` int(250) NOT NULL,
  `ContentLikeId` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `UserLikeId` int(255) DEFAULT '0',
  `DateLike` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `likes`
--

INSERT INTO `likes` (`LikeId`, `ContentLikeId`, `UserLikeId`, `DateLike`) VALUES
(6, 'U3RyZWV0bGlnaHQgTWFuaWZlc3Rv', NULL, '2015-01-13'),
(7, 'U3RyZWV0bGlnaHQgTWFuaWZlc3Rv', 1, '2015-01-13'),
(12, 'QW50aWxsZWN0dWFsIC0gTm8gSHVtYW4gSXMgSWxsZWdhbA==', 1, '2015-01-22');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `ReceiverId` int(11) NOT NULL,
`MessageId` int(250) NOT NULL,
  `SenderId` int(11) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `MessageBody` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
`TagId` int(11) NOT NULL,
  `TagName` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`TagId`, `TagName`) VALUES
(1, 'Music'),
(2, 'Science'),
(3, 'Education'),
(4, 'News'),
(5, 'Entertainment');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`UserID` int(255) NOT NULL,
  `UserNickname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `UserEmail` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `UserPasswd` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`UserID`, `UserNickname`, `UserEmail`, `UserPasswd`) VALUES
(1, 'MovieUn-Free', 'test@test.test', 'fb15a1bc444e13e2c58a0a502c74a54106b5a0dc'),
(2, 'test', 'a@test.test', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441'),
(3, 'Dylan', 'dp295@uni.brighton.ac.uk', '41b722365ce82e48e59ea762fd9a7158ca27b6b6');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `content`
--
ALTER TABLE `content`
 ADD PRIMARY KEY (`ContentId`), ADD KEY `ContentLicenceId` (`ContentLicenceId`), ADD KEY `ContentUser` (`ContentUser`), ADD FULLTEXT KEY `FullText` (`ContentTitle`);

--
-- Index pour la table `contenttag`
--
ALTER TABLE `contenttag`
 ADD PRIMARY KEY (`ContentId`), ADD KEY `tagid` (`tagid`);

--
-- Index pour la table `dislikes`
--
ALTER TABLE `dislikes`
 ADD PRIMARY KEY (`DislikeId`), ADD KEY `dislikes_ibfk_1` (`ContentDislikeId`), ADD KEY `dislikes_ibfk_2` (`UserDislikeId`);

--
-- Index pour la table `licence`
--
ALTER TABLE `licence`
 ADD PRIMARY KEY (`LicenceId`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
 ADD PRIMARY KEY (`LikeId`), ADD KEY `likes_ibfk_1` (`ContentLikeId`), ADD KEY `likes_ibfk_2` (`UserLikeId`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`MessageId`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
 ADD PRIMARY KEY (`TagId`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `dislikes`
--
ALTER TABLE `dislikes`
MODIFY `DislikeId` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `licence`
--
ALTER TABLE `licence`
MODIFY `LicenceId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
MODIFY `LikeId` int(250) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
MODIFY `MessageId` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
MODIFY `TagId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `UserID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `content`
--
ALTER TABLE `content`
ADD CONSTRAINT `Content_LicenceId` FOREIGN KEY (`ContentLicenceId`) REFERENCES `licence` (`LicenceId`),
ADD CONSTRAINT `Content_UserId` FOREIGN KEY (`ContentUser`) REFERENCES `user` (`UserID`);

--
-- Contraintes pour la table `contenttag`
--
ALTER TABLE `contenttag`
ADD CONSTRAINT `TagContent_ContentId` FOREIGN KEY (`ContentId`) REFERENCES `content` (`ContentId`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `TagContent_TagId` FOREIGN KEY (`tagid`) REFERENCES `tag` (`TagId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `dislikes`
--
ALTER TABLE `dislikes`
ADD CONSTRAINT `dislikes_ibfk_1` FOREIGN KEY (`ContentDislikeId`) REFERENCES `content` (`ContentId`) ON DELETE SET NULL ON UPDATE SET NULL,
ADD CONSTRAINT `dislikes_ibfk_2` FOREIGN KEY (`UserDislikeId`) REFERENCES `user` (`UserID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`ContentLikeId`) REFERENCES `content` (`ContentId`) ON DELETE SET NULL ON UPDATE SET NULL,
ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`UserLikeId`) REFERENCES `user` (`UserID`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
