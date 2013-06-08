SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `pid` int(5) NOT NULL AUTO_INCREMENT,
  `parent_pid` int(5) NOT NULL DEFAULT '0',
  `live` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `fn` varchar(255) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `parent_pid` (`parent_pid`,`live`,`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `page` (`pid`, `parent_pid`, `live`, `deleted`, `title`, `body`, `fn`) VALUES
(1, 0, 1, 0, 'Home', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque mattis est, a consectetur dolor suscipit quis. Vestibulum mi nulla, vestibulum ac vestibulum eget, sollicitudin nec erat. Nunc nec turpis vel turpis dapibus blandit a et nisi. Proin non posuere ligula. Morbi vitae erat eu tellus feugiat dictum non vel dui.\r\nQuisque fringilla molestie justo eget placerat. Etiam tristique, leo in bibendum consequat, nunc arcu lobortis dui, vitae adipiscing justo ipsum ac velit. Etiam non ipsum ipsum, ut varius eros. Duis porta leo vitae eros iaculis condimentum. Integer ut dui id nisi malesuada dignissim.\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut eu sollicitudin nisi. Nulla tortor ipsum, ornare id lobortis sed, vehicula egestas ligula. Vivamus dignissim augue ac ipsum commodo vestibulum. Fusce iaculis risus ut quam adipiscing lobortis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec consectetur, orci quis consequat volutpat, ante nisl hendrerit purus, at hendrerit mi ipsum ut nibh. In pulvinar ullamcorper ligula, non fringilla nulla venenatis eu. Suspendisse mauris ligula, ultrices nec rhoncus sed, commodo ut justo.\r\nDonec tincidunt ornare diam quis vestibulum. Sed sodales volutpat massa, sed ullamcorper est feugiat feugiat. Sed convallis, nisl eget adipiscing iaculis, mauris mi laoreet eros, sed imperdiet sapien felis ut odio. Etiam in tincidunt lectus. Aliquam facilisis interdum tortor, et dictum lacus vestibulum in. Pellentesque rhoncus, justo ac consequat rhoncus, magna tortor hendrerit erat, sed fringilla mi diam ut neque. Donec ultrices sapien in turpis vehicula non fermentum ante adipiscing. Nullam aliquet justo in enim dapibus cursus. Ut arcu metus, varius ac interdum in, adipiscing vel urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec eu mollis urna.\r\nPellentesque lobortis, enim eu adipiscing pulvinar, odio risus lacinia nisi, mollis lacinia metus turpis in arcu. Sed rhoncus venenatis massa. Cras rhoncus justo a libero porttitor quis tincidunt lorem accumsan. Suspendisse quis risus arcu. Proin sagittis dignissim fermentum. Quisque sit amet orci sit amet nisl lobortis varius eu ut nisi. Maecenas ullamcorper libero vitae ante bibendum sit amet scelerisque orci malesuada. Praesent ultrices vulputate leo, at egestas purus vulputate in. ', ''),
(2, 0, 1, 0, 'About', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas scelerisque mattis est, a consectetur dolor suscipit quis. Vestibulum mi nulla, vestibulum ac vestibulum eget, sollicitudin nec erat. Nunc nec turpis vel turpis dapibus blandit a et nisi. Proin non posuere ligula. Morbi vitae erat eu tellus feugiat dictum non vel dui.\r\nQuisque fringilla molestie justo eget placerat. Etiam tristique, leo in bibendum consequat, nunc arcu lobortis dui, vitae adipiscing justo ipsum ac velit. Etiam non ipsum ipsum, ut varius eros. Duis porta leo vitae eros iaculis condimentum. Integer ut dui id nisi malesuada dignissim.', 'about');
SET FOREIGN_KEY_CHECKS=1;
