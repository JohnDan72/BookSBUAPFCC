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

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla books_buap.libro
CREATE TABLE IF NOT EXISTS `libro` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(200) NOT NULL,
  `Autor` varchar(200) NOT NULL,
  `Area` varchar(150) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Precio` int(6) DEFAULT NULL,
  `Imagen` varchar(200) DEFAULT NULL,
  `Edo_Libro` varchar(50) DEFAULT NULL,
  `Vendido` bit(1) DEFAULT NULL,
  `Id_Vendedor` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Id_Vendedor` (`Id_Vendedor`),
  CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`Id_Vendedor`) REFERENCES `usuario` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla books_buap.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(80) NOT NULL,
  `Ap_Paterno` varchar(80) NOT NULL,
  `Ap_Materno` varchar(80) NOT NULL,
  `Correo` varchar(150) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Passwd` varchar(300) NOT NULL,
  `Tipo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
