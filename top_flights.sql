CREATE TABLE IF NOT EXISTS `top_flights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pilot_id` int(4) NOT NULL,
  `flights` int(4) NOT NULL,
  `hours` int(4) NOT NULL,
  `miles` int(6) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;