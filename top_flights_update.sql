ALTER TABLE `phpvms_top_flights`
ADD `awards` SMALLINT(7) NOT NULL AFTER `miles`,
ADD `landing` SMALLINT(7) NOT NULL AFTER `awards`,
ADD `tours` SMALLINT(7) NOT NULL AFTER `landing`;