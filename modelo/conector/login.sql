CREATE TABLE `usuario`(
`idusuario` bigint(20) NOT NULL,
`usnombre` varchar (50) character set utf8 collate utf8_unicode_ci NOT NULL,
`uspass` varchar (50) NOT NUll,
`usmail` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
`usdeshabilitado` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`idusuario`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`)
VALUES ('1', 'nombreadmin', '827ccb0eea8a706c4c34a16891f84e7b', 'admin@gmail.com', NULL);

INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`)
VALUES ('2', 'nombreEditor', 'c5fe25896e49ddfe996db7508cf00534', 'editor@gmail.com', NULL);


CREATE TABLE `rol`(
`idrol` bigint(20) NOT NULL,
`rodescript` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
PRIMARY KEY (`idrol`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `rol` (`idrol`, `rodescript`) VALUES ('1', 'administrador');

INSERT INTO `rol` (`idrol`, `rodescript`) VALUES ('2', 'editor');


CREATE TABLE `usuariorol`(
`idusuario` bigint(20) NOT NULL,
`idrol` bigint(20) NOT NULL,
FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuariorol` (`idusuario`, `idrol`) VALUES ('1', '1');
INSERT INTO `usuariorol` (`idusuario`, `idrol`) VALUES ('2', '2');

/* usuario: nombreEditor , pass:12345
   usuario: nombreadmin , pass:55555 */