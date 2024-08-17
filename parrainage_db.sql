-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2022 at 01:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parrainage`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `title` varchar(85) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(20) NOT NULL,
  `added_date` datetime NOT NULL,
  `attachment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `title`, `description`, `author`, `added_date`, `attachment`) VALUES
(1, 'test', 'test', 'Idrissi Mohammed', '2022-05-31 02:05:49', '../uploads/new2.png'),
(2, 'titre', 'teste', 'Idrissi Mohammed', '2022-06-11 11:06:10', '../uploads/ofppt-logo-ACD755B3D2-seeklogo.com.png');

-- --------------------------------------------------------

--
-- Table structure for table `cad`
--

CREATE TABLE `cad` (
  `id` int(1) NOT NULL,
  `stagiaire_mat` varchar(20) NOT NULL,
  `fonction` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cad`
--

INSERT INTO `cad` (`id`, `stagiaire_mat`, `fonction`) VALUES
(6, '2002082700277', 'Externe'),
(7, '2002090201623', 'Interne');

-- --------------------------------------------------------

--
-- Table structure for table `employés`
--

CREATE TABLE `employés` (
  `cin` varchar(60) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `fonction` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employés`
--

INSERT INTO `employés` (`cin`, `nom`, `prenom`, `fonction`, `password`) VALUES
('admin2', 'Said', 'Mohamed', 'Directeur', 'aa'),
('z663404', 'Mohammed', 'Raghib', 'Conseilleur', 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `engagements`
--

CREATE TABLE `engagements` (
  `eng_id` int(11) NOT NULL,
  `stagiaire_mat` varchar(20) NOT NULL,
  `groupe_id` varchar(20) NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `engagements`
--

INSERT INTO `engagements` (`eng_id`, `stagiaire_mat`, `groupe_id`, `date_creation`) VALUES
(1, '1999041511018', '1', '2022-05-31'),
(2, '2002043000256', '1', '2022-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `entretiens`
--

CREATE TABLE `entretiens` (
  `entretien_id` int(11) NOT NULL,
  `stagiaire_mat` varchar(20) NOT NULL,
  `formateur_mat` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `outil` varchar(50) NOT NULL,
  `date_entretien` varchar(50) NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `subject` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entretiens`
--

INSERT INTO `entretiens` (`entretien_id`, `stagiaire_mat`, `formateur_mat`, `type`, `outil`, `date_entretien`, `heure_debut`, `heure_fin`, `subject`, `description`) VALUES
(2, '2002082700154', '19640215358', 'À Distance', 'Microsoft Teams', '2022-05-31', '14:05:00', '16:10:00', 'L&apos;adaptation avec la classe', 'Une discussion sur les problémes qui a affronté le stagiaire avec l&apos;integration.');

-- --------------------------------------------------------

--
-- Table structure for table `formateurs`
--

CREATE TABLE `formateurs` (
  `matricule` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `formation_year` varchar(50) NOT NULL,
  `groupe_id` int(11) DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `formateurs`
--

INSERT INTO `formateurs` (`matricule`, `nom`, `prenom`, `module`, `formation_year`, `groupe_id`, `password`) VALUES
('19640215358', 'Ayoub', 'Mahi', 'ASP.NET', '2022', 1, 'aa'),
('19791102302', 'Mortada', 'karib', 'Communication', '2022', 2, 'eerer');

-- --------------------------------------------------------

--
-- Table structure for table `groupes`
--

CREATE TABLE `groupes` (
  `groupe_id` int(11) NOT NULL,
  `groupe_nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupes`
--

INSERT INTO `groupes` (`groupe_id`, `groupe_nom`) VALUES
(1, 'TDI201'),
(2, 'TRI201');

-- --------------------------------------------------------

--
-- Table structure for table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `inscription_id` int(11) NOT NULL,
  `stagiaire_mat` varchar(20) NOT NULL,
  `groupe_id` varchar(20) NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inscriptions`
--

INSERT INTO `inscriptions` (`inscription_id`, `stagiaire_mat`, `groupe_id`, `date_creation`) VALUES
(1, '1999041511018', '1', '2022-05-31'),
(2, '2002043000256', '1', '2022-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `date_sent` datetime NOT NULL,
  `sender_id` varchar(20) NOT NULL,
  `receiver_id` varchar(20) NOT NULL,
  `isRead` bit(1) NOT NULL,
  `isDeleted` bit(1) NOT NULL,
  `isStared` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `subject`, `content`, `date_sent`, `sender_id`, `receiver_id`, `isRead`, `isDeleted`, `isStared`) VALUES
(1, 'J&apos;ai un problème avec mon compte!', '&lt;p&gt;&lt;em&gt;Bonjour Monsieur,&lt;/em&gt;&lt;/p&gt;&lt;p&gt;j&apos;ai un probléme avec mon compte, j&apos;ai pas l&apos;access de réclamer&lt;/p&gt;', '2022-05-31 01:57:46', '2002082700154', '19640215358', b'1', b'0', 0),
(2, 'Quand nous avons notre dernier examen?', '&lt;p&gt;&lt;em&gt;Bonjour Monsieur,&lt;/em&gt;&lt;/p&gt;&lt;p&gt;Est-il possible de m&apos;informer de la date du dernier examen ?&lt;/p&gt;', '2022-05-31 02:00:06', '2001111000896', '19640215358', b'1', b'0', 0),
(3, 'test', '&lt;p&gt;test&lt;/p&gt;', '2022-05-31 02:25:35', '2002082700154', '19640215358', b'1', b'0', 0),
(4, 'test', '&lt;p&gt;test&lt;/p&gt;', '2022-05-31 02:26:26', '19640215358', '2002082700154', b'1', b'0', 0),
(5, 'mon permier', '&lt;p&gt;tset&lt;/p&gt;', '2022-06-11 11:14:20', '2002082700154', '19640215358', b'1', b'0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `receiver_id` varchar(50) NOT NULL,
  `action` text NOT NULL,
  `sender_id` varchar(50) NOT NULL,
  `isRead` int(2) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `receiver_id`, `action`, `sender_id`, `isRead`, `date`) VALUES
(1, '19640215358', 'a envoyé un message', '2002082700154', 1, '2022-05-31 01:05:46'),
(2, '19640215358', 'a envoyé un message', '2001111000896', 1, '2022-05-31 02:05:06'),
(3, '19640215358', 'a envoyé un message', '2002082700154', 1, '2022-05-31 02:05:35'),
(4, '2002082700154', 'a envoyé un message', '19640215358', 1, '2022-05-31 02:05:26'),
(5, '19640215358', 'a envoyé un message', '2002082700154', 1, '2022-06-11 11:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `problemes`
--

CREATE TABLE `problemes` (
  `problem_id` int(11) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `date_reclamation` datetime NOT NULL,
  `statut` varchar(10) NOT NULL,
  `stagiaire_mat` varchar(20) NOT NULL,
  `type` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `problemes`
--

INSERT INTO `problemes` (`problem_id`, `titre`, `content`, `date_reclamation`, `statut`, `stagiaire_mat`, `type`) VALUES
(1, 'J&apos;ai un probléme avec mon compte', 'test', '2022-05-31 02:21:14', 'Annulé', '2001111000896', 'Technique'),
(2, 'test', 'test', '2022-06-11 11:14:46', 'Résolu', '2002082700154', 'Administratif');

-- --------------------------------------------------------

--
-- Table structure for table `problemes_replies`
--

CREATE TABLE `problemes_replies` (
  `problem_reply_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `problem_reply` text NOT NULL,
  `sender_id` varchar(20) NOT NULL,
  `reply_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `problemes_replies`
--

INSERT INTO `problemes_replies` (`problem_reply_id`, `problem_id`, `problem_reply`, `sender_id`, `reply_date`) VALUES
(1, 2, 'test', '2002082700154', '2022-06-11 11:15:06'),
(2, 2, 'test', '19640215358', '2022-06-11 11:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `reply_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `sender_id` varchar(20) NOT NULL,
  `reply` text NOT NULL,
  `reply_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`reply_id`, `message_id`, `sender_id`, `reply`, `reply_date`) VALUES
(1, 2, '19640215358', 'Bonjour,\nLe jeudi prochain sera l&apos;examen', '2022-05-31 02:01:36'),
(2, 1, '19640215358', 'Bounjour,\nSi il&apos;est possible de me donne moi plus d&apos;informations.', '2022-05-31 02:02:22'),
(3, 4, '2002082700154', 'ets', '2022-05-31 02:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `stagiaires`
--

CREATE TABLE `stagiaires` (
  `matricule` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `formation_year` varchar(50) NOT NULL,
  `niveau` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `groupe_id` int(11) DEFAULT NULL,
  `filiere` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stagiaires`
--

INSERT INTO `stagiaires` (`matricule`, `nom`, `prenom`, `formation_year`, `niveau`, `password`, `groupe_id`, `filiere`) VALUES
('1988042411018', 'Semni', 'Rahim', '2eme année', 'Technicien spécialisé', '12345', 1, 'Techniques de Réseaux Informatique\r\n'),
('2009111000896', 'Korazon', 'Darif', '2eme année', 'Technicien spécialisé', '12345', 1, 'Techniques de Développement Informatique\r\n'),
('2004033000256', 'bader', 'Tarik', '2eme année', 'Technicien spécialisé', '12345', 1, 'Techniques de Réseaux Informatique\r\n'),
('2003021400198', 'Bennani', 'Kobar', '2eme année', 'Technicien spécialisé', '12345', 1, 'Techniques de Développement Informatique\r\n'),
('2000012700154', 'Jelloul', 'Loraf', '2eme année', 'Technicien spécialisé', '12345', 1, 'Techniques de Développement Informatique\r\n\r\n'),
('2001052700277', 'Tber', 'Nasser', '2eme année', 'Technicien spécialisé', '12345', 1, 'Techniques de Développement Informatique\r\n'),
('2005060201623', 'Armaoui', 'Ayoujil', '2eme année', 'Technicien spécialisé', '12345', 2, 'Techniques de Réseaux Informatique\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE `tutorials` (
  `tuto_id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `youtube` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`tuto_id`, `title`, `youtube`, `description`) VALUES
(2, 'Activation de la carte SIM', 'https://www.example.com', 'Un petite tutoriel d&apos;activation cotre carte SIM .');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `cad`
--
ALTER TABLE `cad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employés`
--
ALTER TABLE `employés`
  ADD PRIMARY KEY (`cin`);

--
-- Indexes for table `engagements`
--
ALTER TABLE `engagements`
  ADD PRIMARY KEY (`eng_id`);

--
-- Indexes for table `entretiens`
--
ALTER TABLE `entretiens`
  ADD PRIMARY KEY (`entretien_id`);

--
-- Indexes for table `formateurs`
--
ALTER TABLE `formateurs`
  ADD PRIMARY KEY (`matricule`);

--
-- Indexes for table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`groupe_id`);

--
-- Indexes for table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`inscription_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problemes`
--
ALTER TABLE `problemes`
  ADD PRIMARY KEY (`problem_id`);

--
-- Indexes for table `problemes_replies`
--
ALTER TABLE `problemes_replies`
  ADD PRIMARY KEY (`problem_reply_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `stagiaires`
--
ALTER TABLE `stagiaires`
  ADD PRIMARY KEY (`matricule`);

--
-- Indexes for table `tutorials`
--
ALTER TABLE `tutorials`
  ADD PRIMARY KEY (`tuto_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cad`
--
ALTER TABLE `cad`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `engagements`
--
ALTER TABLE `engagements`
  MODIFY `eng_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `entretiens`
--
ALTER TABLE `entretiens`
  MODIFY `entretien_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `groupe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inscriptions`
--
ALTER TABLE `inscriptions`
  MODIFY `inscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `problemes`
--
ALTER TABLE `problemes`
  MODIFY `problem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `problemes_replies`
--
ALTER TABLE `problemes_replies`
  MODIFY `problem_reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `tuto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
