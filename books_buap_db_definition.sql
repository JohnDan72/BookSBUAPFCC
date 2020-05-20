-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.34-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para books_buap
CREATE DATABASE IF NOT EXISTS `books_buap` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `books_buap`;

-- Volcando estructura para tabla books_buap.faq
CREATE TABLE IF NOT EXISTS `faq` (
  `Id` int(2) NOT NULL AUTO_INCREMENT,
  `Pregunta` varchar(250) NOT NULL,
  `Respuesta` varchar(250) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla books_buap.faq: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;

-- Volcando estructura para tabla books_buap.historial
CREATE TABLE IF NOT EXISTS `historial` (
  `Id_Libro` int(11) NOT NULL,
  `Id_Vendedor` int(11) NOT NULL,
  `Id_Cliente` int(11) NOT NULL,
  `Fecha_Hora` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Libro`,`Id_Vendedor`,`Id_Cliente`),
  KEY `Id_Vendedor` (`Id_Vendedor`),
  KEY `Id_Cliente` (`Id_Cliente`),
  CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`Id_Libro`) REFERENCES `libro` (`Id`),
  CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`Id_Vendedor`) REFERENCES `usuario` (`Id`),
  CONSTRAINT `historial_ibfk_3` FOREIGN KEY (`Id_Cliente`) REFERENCES `usuario` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla books_buap.historial: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` (`Id_Libro`, `Id_Vendedor`, `Id_Cliente`, `Fecha_Hora`) VALUES
	(10, 6, 10, '2020-05-19 21:31:35'),
	(13, 6, 3, '2020-05-19 23:28:30'),
	(19, 7, 10, '2020-05-19 21:31:41'),
	(22, 3, 10, '2020-05-19 21:31:30'),
	(26, 6, 8, '2020-05-19 21:31:06'),
	(27, 8, 1, '2020-05-19 19:43:11'),
	(33, 3, 8, '2020-05-19 21:31:01'),
	(34, 3, 1, '2020-05-19 19:44:19'),
	(37, 3, 8, '2020-05-19 21:30:56');
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;

-- Volcando estructura para tabla books_buap.libro
CREATE TABLE IF NOT EXISTS `libro` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(200) NOT NULL,
  `Area` varchar(150) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Precio` int(6) DEFAULT NULL,
  `Imagen` varchar(200) DEFAULT NULL,
  `Edo_Libro` varchar(50) DEFAULT NULL,
  `Vendido` bit(1) DEFAULT b'0',
  `Id_Vendedor` int(11) DEFAULT NULL,
  `Fecha_Subido` datetime DEFAULT '2020-05-17 14:35:20',
  PRIMARY KEY (`Id`),
  KEY `Id_Vendedor` (`Id_Vendedor`),
  CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`Id_Vendedor`) REFERENCES `usuario` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla books_buap.libro: ~32 rows (aproximadamente)
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` (`Id`, `Titulo`, `Area`, `Descripcion`, `Precio`, `Imagen`, `Edo_Libro`, `Vendido`, `Id_Vendedor`, `Fecha_Subido`) VALUES
	(7, 'Matemáticas 1', 'Matemáticas', 'Libro en buenas condiciones', 540, 'img8.jpg', 'Regular', b'0', 6, '2020-05-17 14:35:20'),
	(8, 'Libro de las Matemáticas', 'Matemáticas', 'Sirve para toda la rama de mates', 1020, 'img10.jpg', 'Maltratado', b'0', 6, '2020-05-17 14:35:20'),
	(9, 'Física 1', 'Física', 'Sirve para la carrera de aplicada y pura', 850, 'img24.jpg', 'Regular', b'0', 6, '2020-05-17 14:35:20'),
	(10, 'Don quijote de la mancha', 'Otros', 'buen libro para pasar el rato', 215, 'img30.jpg', 'Maltratado', b'1', 6, '2020-05-17 14:35:20'),
	(11, 'Introducción a la Computación', 'Computación', 'buen libro de progra', 169, 'img21.jpg', 'Maltratado', b'0', 6, '2020-05-17 14:35:20'),
	(12, 'Introducción a la Computación', 'Computación', 'Excelente libro para iniciar en este mundo', 400, 'img23.jpg', 'Maltratado', b'0', 6, '2020-05-17 14:35:20'),
	(13, 'Grimorio 13', 'Otros', 'libro muy sencillo pero con gran contenido', 186, 'img4.jpg', 'Maltratado', b'1', 6, '2020-05-17 14:35:20'),
	(14, 'Matemáticas por competencias 2', 'Matemáticas', 'es un libro que vale mucho la pena', 580, 'img7.jpg', 'Regular', b'0', 8, '2020-05-17 14:35:20'),
	(15, 'Amor y Matemáticas', 'Matemáticas', '', 890, 'img6.jpg', 'Impecable', b'0', 8, '2020-05-17 14:35:20'),
	(16, 'Monsters who stare', 'Otros', 'libro un poco maltratado pero muy bueno', 89, 'img3.jpg', 'Maltratado', b'0', 8, '2020-05-17 14:35:20'),
	(17, 'Crea tu portada de libro', 'Otros', 'una joya de libro', 2300, 'img2.jpg', 'Impecable', b'0', 7, '2020-05-17 14:35:20'),
	(18, 'Principios del Hardware', 'Hardware', 'excelente libro para el área de Hardware', 860, 'img16.jpg', 'Regular', b'0', 7, '2020-05-17 14:35:20'),
	(19, 'Diseño de circuitos Eléctricos 3', 'Hardware', 'para diseño digital', 450, 'img20.jpg', 'Regular', b'1', 7, '2020-05-17 14:35:20'),
	(20, 'Hardware y componentes', 'Hardware', '', 950, 'img15.jpg', 'Impecable', b'0', 7, '2020-05-17 14:35:20'),
	(21, 'Cálculo Diferencial', 'Matemáticas', 'buen libro, lo recomiendo mucho', 400, 'img12.jpg', 'Regular', b'0', 3, '2020-05-17 14:35:20'),
	(22, 'Cálculo Integral', 'Matemáticas', 'excelente joya de libro', 894, 'img14.jpg', 'Impecable', b'1', 3, '2020-05-17 14:35:20'),
	(23, 'Cálcula Diferencial', 'Matemáticas', 'tambien siver para integral como introduccion', 700, 'img13.jpg', 'Impecable', b'0', 3, '2020-05-17 14:35:20'),
	(24, 'Matemáticas 3', 'Matemáticas', 'Curso avanzado, solo para pros en Cálculo', 1750, 'img11.jpg', 'Impecable', b'0', 6, '2020-05-17 14:35:20'),
	(25, 'Computación, principios y fundamentos', 'Computación', 'Introductorio para el área de la informática', 410, 'img22.jpg', 'Regular', b'0', 6, '2020-05-17 14:35:20'),
	(26, 'Circuitos eléctricos para Ingeniería', 'Hardware', 'Para toda la rama de Hardware', 460, 'img17.jpg', 'Regular', b'1', 6, '2020-05-17 14:35:20'),
	(27, 'Hardware y Componentes', 'Hardware', 'sin descripción', 410, 'img15_1.jpg', 'Maltratado', b'1', 8, '2020-05-17 14:35:20'),
	(28, 'Física lll', 'Física', 'Libro para excelentes maestros en la Física', 1368, 'img27.jpg', 'Impecable', b'0', 8, '2020-05-17 14:35:20'),
	(29, 'Ejercicios de Física', 'Física', 'precio a tratar por mensaje', 750, 'img26.jpg', 'Regular', b'0', 8, '2020-05-17 14:35:20'),
	(30, 'Principios de Circuitos eléctricos', 'Hardware', 'Toda una joya de libro para el área de hardware', 2150, 'img19.jpg', 'Impecable', b'0', 3, '2020-05-17 14:35:20'),
	(31, 'Física l', 'Física', 'Para primerizos en esta área', 128, 'img28.jpg', 'Maltratado', b'0', 3, '2020-05-17 14:35:20'),
	(32, 'El libro de la Física', 'Física', 'Ejercicios para mejorar la habilidad matemática', 320, 'img29.jpg', 'Maltratado', b'0', 3, '2020-05-17 14:35:20'),
	(33, 'Autoestima venza a su peor enemigo', 'Otros', 'Libro de autoayuda', 1750, 'img5.jpg', 'Impecable', b'1', 3, '2020-05-17 14:35:20'),
	(34, 'Matemáticas', 'Matemáticas', 'Introductorio al mundo de las matemáticas', 430, 'img9.jpg', 'Maltratado', b'1', 3, '2020-05-17 14:35:20'),
	(35, 'Programación Orientada a Objetos', 'Computación', 'Buen libro para POO', 730, 'img31.jpg', 'Impecable', b'0', 3, '2020-05-17 14:35:20'),
	(36, 'Java 2 curso de programación', 'Computación', 'Libro complementario para java', 310, 'img32.jpg', 'Regular', b'0', 3, '2020-05-17 14:35:20'),
	(37, 'Algoritmos y pseudocódigo', 'Computación', 'Sirve para análisis y diseño de algoritmos', 2100, 'img33.jpg', 'Impecable', b'1', 3, '2020-05-17 14:35:20'),
	(38, 'Python 3', 'Computación', 'Libro para amantes de Python, poco maltratado', 145, 'img34.jpg', 'Maltratado', b'0', 3, '2020-05-17 14:35:20');
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;

-- Volcando estructura para tabla books_buap.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(80) NOT NULL,
  `Ap_Paterno` varchar(80) NOT NULL,
  `Ap_Materno` varchar(80) NOT NULL,
  `Matricula` int(11) DEFAULT NULL,
  `Carrera` varchar(100) DEFAULT NULL,
  `Correo` varchar(150) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Passwd` varchar(300) NOT NULL,
  `Tipo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Matricula` (`Matricula`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla books_buap.usuario: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`Id`, `Nombre`, `Ap_Paterno`, `Ap_Materno`, `Matricula`, `Carrera`, `Correo`, `Telefono`, `Passwd`, `Tipo`) VALUES
	(1, 'Juan', 'García', 'López', 201504691, 'Ing Ciencias de la Computación', 'mr._dany@hotmail.com', '2221063405', 'áz‰‘1¾ŒvYÁ9·Ë', b'0'),
	(2, 'Juan', 'Gomez', 'Gutierrez', 201521021, 'Lic Ciencias de la Computación', 'juan.garcialo@alumno.buap.mx', '2221063405', 'áz‰‘1¾ŒvYÁ9·Ë', b'0'),
	(3, 'Roberto', 'García', 'López', 100447774, 'Docencia', 'robert123@gmail.com', '2225658547', 'áz‰‘1¾ŒvYÁ9·Ë', b'1'),
	(5, 'Albert', 'Ramirez', 'PerezP', 201503698, 'Ing Ciencias de la Computación', 'albert123@gmail.com', '2223432321', 'áz‰‘1¾ŒvYÁ9·Ë', b'0'),
	(6, 'Carlos', 'Perez', 'Ramos', 100447777, 'Docencia', 'calrs@gmail.com', '2225847454', 'pµÉ²æBÄõ%½‹Óü', b'1'),
	(7, 'Fernando', 'Salaz', 'Rockefeller', 201502210, 'Lic Ciencias de la Computación', 'rockstar@gmail.com', '2225658595', 'pµÉ²æBÄõ%½‹Óü', b'1'),
	(8, 'ElMan', 'Chido', 'Gomez', 201542154, 'Otros', 'man@gmail.com', '4545456815', 'pµÉ²æBÄõ%½‹Óü', b'1'),
	(9, 'Daniel', 'Gomez', 'Sanchez', 201103369, 'Ing TIC\'s', 'dan@gmail.com', '2225487854', 'áz‰‘1¾ŒvYÁ9·Ë', b'0'),
	(10, 'JoseAlfredo', 'Jimenez', 'Perez', 201502123, 'Ing Ciencias de la Computación', 'jose@gmail.com', '5554126532', 'pµÉ²æBÄõ%½‹Óü', b'1');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
