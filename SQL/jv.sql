
CREATE TABLE `console` (
  `id` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `model` varchar(32) NOT NULL,
  `constructeur` varchar(32) NOT NULL,
  `annee` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `Image` varchar(256) NOT NULL,
  `games` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `jeu` (
  `id` int(11) NOT NULL,
  `id_console` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `genre` varchar(64) NOT NULL,
  `developpeur` varchar(128) NOT NULL,
  `editeur` varchar(128) NOT NULL,
  `annee` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `Image` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user_console` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_console` int(11) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user_jeu` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(64) NOT NULL,
  `mdp` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `droit` int(11) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `private` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `console`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `jeu`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_console`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_jeu`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `console`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

ALTER TABLE `jeu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `user_console`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `user_jeu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

