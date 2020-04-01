CREATE DATABASE  IF NOT EXISTS `4g` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `4g`;
-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: 4g
-- ------------------------------------------------------
-- Server version	5.7.27-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adm_menus`
--

DROP TABLE IF EXISTS `adm_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adm_menus` (
  `adm_sistema` int(1) NOT NULL,
  `adm_programa` int(11) NOT NULL,
  `adm_tipo` varchar(1) DEFAULT NULL,
  `adm_padre` int(11) DEFAULT NULL,
  PRIMARY KEY (`adm_sistema`,`adm_programa`),
  KEY `adm_programa` (`adm_programa`),
  CONSTRAINT `adm_menus_ibfk_1` FOREIGN KEY (`adm_sistema`) REFERENCES `adm_sistemas` (`sis_id`),
  CONSTRAINT `adm_menus_ibfk_2` FOREIGN KEY (`adm_programa`) REFERENCES `adm_programas` (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_menus`
--

LOCK TABLES `adm_menus` WRITE;
/*!40000 ALTER TABLE `adm_menus` DISABLE KEYS */;
INSERT INTO `adm_menus` VALUES (1,5,'P',5),(1,7,'P',7),(1,100,'H',7),(1,101,'H',7),(1,102,'H',1),(1,201,'H',5);
/*!40000 ALTER TABLE `adm_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_parametros`
--

DROP TABLE IF EXISTS `adm_parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adm_parametros` (
  `par_nombreLargo` varchar(60) DEFAULT NULL,
  `par_nombreCorto` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_parametros`
--

LOCK TABLES `adm_parametros` WRITE;
/*!40000 ALTER TABLE `adm_parametros` DISABLE KEYS */;
INSERT INTO `adm_parametros` VALUES ('SISTEMA INFORMATICA DE GESTION ACADEMICA','SIGA');
/*!40000 ALTER TABLE `adm_parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_permisos`
--

DROP TABLE IF EXISTS `adm_permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adm_permisos` (
  `per_rol` int(11) NOT NULL,
  `per_programa` int(11) NOT NULL,
  `per_ejecutar` varchar(1) DEFAULT NULL,
  `per_agregar` varchar(1) DEFAULT NULL,
  `per_consultar` varchar(1) DEFAULT NULL,
  `per_modificar` varchar(1) DEFAULT NULL,
  `per_eliminar` varchar(1) DEFAULT NULL,
  `per_imprimir` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`per_rol`,`per_programa`),
  KEY `per_programa` (`per_programa`),
  CONSTRAINT `adm_permisos_ibfk_1` FOREIGN KEY (`per_programa`) REFERENCES `adm_programas` (`pro_id`),
  CONSTRAINT `adm_permisos_ibfk_2` FOREIGN KEY (`per_rol`) REFERENCES `adm_roles` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_permisos`
--

LOCK TABLES `adm_permisos` WRITE;
/*!40000 ALTER TABLE `adm_permisos` DISABLE KEYS */;
INSERT INTO `adm_permisos` VALUES (1,100,'S','S','S','S','S','S'),(1,101,'S','S','S','S','S','S'),(1,200,'S','S','S','S','S','S'),(1,201,'S','S','S','S','S','S'),(2,201,'S','S','S','S','S','S');
/*!40000 ALTER TABLE `adm_permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_programas`
--

DROP TABLE IF EXISTS `adm_programas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adm_programas` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_descripcion` varchar(60) DEFAULT NULL,
  `pro_sistema` int(11) DEFAULT NULL,
  `pro_ruta` varchar(100) DEFAULT NULL,
  `pro_target` varchar(1) DEFAULT NULL,
  `pro_icono` varchar(60) DEFAULT NULL,
  `pro_estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `pro_sistema` (`pro_sistema`),
  CONSTRAINT `adm_programas_ibfk_1` FOREIGN KEY (`pro_sistema`) REFERENCES `adm_sistemas` (`sis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_programas`
--

LOCK TABLES `adm_programas` WRITE;
/*!40000 ALTER TABLE `adm_programas` DISABLE KEYS */;
INSERT INTO `adm_programas` VALUES (1,'Mantenimiento',1,'#',NULL,NULL,'A'),(2,'Matriculación',1,'#',NULL,NULL,'A'),(3,'Cobros',1,'#',NULL,NULL,'A'),(4,'Inventarios',1,'#',NULL,NULL,'A'),(5,'Classroom',1,'#',NULL,NULL,'A'),(6,'Reportes',1,'#',NULL,NULL,'A'),(7,'Configuraciones',1,'#',NULL,NULL,'A'),(100,'Usuarios',1,'./usuarios/index.php',NULL,NULL,'A'),(101,'Personas',1,'./personas/index.php',NULL,NULL,'A'),(102,'Materias',1,'./materias/index.php',NULL,NULL,'A'),(200,'Reporte de Alumnos',1,'reportealumnos.php',NULL,NULL,'A'),(201,'Aula Escolar',1,'./classRoom/index.php',NULL,NULL,'A');
/*!40000 ALTER TABLE `adm_programas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_roles`
--

DROP TABLE IF EXISTS `adm_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adm_roles` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_descripcion` varchar(60) DEFAULT NULL,
  `rol_estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_roles`
--

LOCK TABLES `adm_roles` WRITE;
/*!40000 ALTER TABLE `adm_roles` DISABLE KEYS */;
INSERT INTO `adm_roles` VALUES (1,'ADMINISTRADOR','A'),(2,'DOCENTE','A'),(3,'INSPECTOR','A'),(4,'REPRESENTANTE','A'),(5,'ALUMNO','A');
/*!40000 ALTER TABLE `adm_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_sistemas`
--

DROP TABLE IF EXISTS `adm_sistemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adm_sistemas` (
  `sis_id` int(11) NOT NULL AUTO_INCREMENT,
  `sis_descripcion` varchar(60) DEFAULT NULL,
  `sis_estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`sis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_sistemas`
--

LOCK TABLES `adm_sistemas` WRITE;
/*!40000 ALTER TABLE `adm_sistemas` DISABLE KEYS */;
INSERT INTO `adm_sistemas` VALUES (1,'Sistema Academico','A'),(2,'Configuraciones','A'),(3,'Mantenimiento','A'),(4,'Cobros','A'),(5,'Inventario','A'),(6,'Sistema Evaluacion','A'),(7,'Reportes','A'),(8,'Materias','A'),(9,'Gestion de Tareas','A');
/*!40000 ALTER TABLE `adm_sistemas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adm_usuarios`
--

DROP TABLE IF EXISTS `adm_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adm_usuarios` (
  `usu_id` varchar(50) NOT NULL,
  `usu_nombre` varchar(60) DEFAULT NULL,
  `usu_password` varchar(60) DEFAULT NULL,
  `usu_rol` int(11) DEFAULT NULL,
  `usu_estado` varchar(1) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`usu_id`),
  KEY `usu_rol` (`usu_rol`),
  CONSTRAINT `adm_usuarios_ibfk_1` FOREIGN KEY (`usu_rol`) REFERENCES `adm_roles` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_usuarios`
--

LOCK TABLES `adm_usuarios` WRITE;
/*!40000 ALTER TABLE `adm_usuarios` DISABLE KEYS */;
INSERT INTO `adm_usuarios` VALUES (' manu345','Manuel fonseca','556498',5,'I',NULL),('admin','Administrador','admin',1,'A',NULL),('asdasd','sadasd','dsadas',5,'A','61582205_301521877403174_2604861505694334976_n.jpg'),('dasd','asasd','asdasd',5,'A','61582205_301521877403174_2604861505694334976_n.jpg'),('DenisitaxD','denise ardila macias','1344668954',5,'A',NULL),('jlindao','Juan Lindao','jlindao',2,'A',NULL),('lucy2432','Lucia Rivera','779986',5,'A',NULL),('luis1232','luis ardila macias','1234',2,'A',NULL),('luis1234','luis eduardo ardila macias','1234',1,'I',NULL),('Luis_223','Luis Eduardo Macias','131313264',2,'A',NULL),('luis_ardila98','Luis Eduardo Ardila Macias','123456789',2,'A',NULL),('luna','lucia ','12345',5,'A',NULL),('mareio334','Mario Peralta ','13564987',5,'A',NULL),('mari2365','Mariela BajaÃ±a','46464623',2,'A',NULL),('Maria123','Maria Rivadeneira ','123456',5,'A',NULL),('mario5675','Mariano Aguilera','1346985',5,'A',NULL),('Mateo Hidalgo','Mateo Hidalgo','556498',5,'A',NULL),('nelio2120','Nelio Ciguencia','44696',5,'A',NULL),('Sarita','Sara Salcedo Flores','556487',5,'A',NULL);
/*!40000 ALTER TABLE `adm_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `alu_cedula` varchar(10) NOT NULL,
  `alu_nombres` varchar(60) DEFAULT NULL,
  `alu_apellidos` varchar(60) DEFAULT NULL,
  `alu_representante` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`alu_cedula`),
  KEY `fk_alumno_representante` (`alu_representante`),
  CONSTRAINT `fk_alumno_representante` FOREIGN KEY (`alu_representante`) REFERENCES `representantes` (`rep_cedula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciclos`
--

DROP TABLE IF EXISTS `ciclos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciclos` (
  `cic_id` int(11) NOT NULL AUTO_INCREMENT,
  `cic_descripcion` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`cic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciclos`
--

LOCK TABLES `ciclos` WRITE;
/*!40000 ALTER TABLE `ciclos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ciclos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cls_cab_tareas`
--

DROP TABLE IF EXISTS `cls_cab_tareas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cls_cab_tareas` (
  `idcls_cab_tareas` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pub` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `descripcion` text,
  `titulo` varchar(100) DEFAULT NULL,
  `recurso` varchar(200) DEFAULT NULL,
  `classroom` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idcls_cab_tareas`),
  KEY `fk_tarea_classroom_idx` (`classroom`),
  KEY `fk_usuario_id_idx` (`usuario`),
  CONSTRAINT `fk_tarea_classroom` FOREIGN KEY (`classroom`) REFERENCES `cls_classroom` (`id_classroom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario`) REFERENCES `adm_usuarios` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cls_cab_tareas`
--

LOCK TABLES `cls_cab_tareas` WRITE;
/*!40000 ALTER TABLE `cls_cab_tareas` DISABLE KEYS */;
INSERT INTO `cls_cab_tareas` VALUES (1,'2020-02-02','2020-02-02','hola','nignuno','ninnugo',32,'admin'),(10,'2020-03-30','2020-12-05','sdasdasdasdasdasd','adadasd','Titulo 2 001.jpg',32,'admin'),(11,'2020-03-30','2020-12-05','sdasdasdasdasdasd','adadasd','Titulo 2 001.jpg',32,'admin');
/*!40000 ALTER TABLE `cls_cab_tareas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cls_classroom`
--

DROP TABLE IF EXISTS `cls_classroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cls_classroom` (
  `id_classroom` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `autor` varchar(45) NOT NULL,
  `estado` varchar(15) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_classroom`),
  KEY `fk_usuario_idx` (`autor`),
  CONSTRAINT `fk_usuario_cls` FOREIGN KEY (`autor`) REFERENCES `adm_usuarios` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cls_classroom`
--

LOCK TABLES `cls_classroom` WRITE;
/*!40000 ALTER TABLE `cls_classroom` DISABLE KEYS */;
INSERT INTO `cls_classroom` VALUES (31,'Matematicas','En esta aula aprenderan todo lo bÃ¡sico eh incluso un poco mas allÃ¡ sobre matemÃ¡ticas de manera divertida. Yujuu!!!','2020-03-19','admin','A','2.jpg'),(32,'Lenguaje y comunicacion','En esta seccion aprenderas todo sobre lenguaje y a comunicarte correctamente','2020-03-19','admin','A',NULL),(53,'Dibujo','Esta es la descripcion','2020-03-26','admin','A','3.jpg'),(54,'Sociales','Ninguno','2020-03-28','admin','A','fondo_clase.jpg');
/*!40000 ALTER TABLE `cls_classroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cls_detalle_classroom`
--

DROP TABLE IF EXISTS `cls_detalle_classroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cls_detalle_classroom` (
  `idcls_detalle_classroom` int(11) NOT NULL AUTO_INCREMENT,
  `id_cab_classroom` int(11) NOT NULL,
  `usuarios` varchar(45) NOT NULL,
  PRIMARY KEY (`idcls_detalle_classroom`),
  KEY `fk_cab_class_idx` (`id_cab_classroom`),
  KEY `fk_usuario_class_idx` (`usuarios`),
  CONSTRAINT `fk_cab_class` FOREIGN KEY (`id_cab_classroom`) REFERENCES `cls_classroom` (`id_classroom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_class` FOREIGN KEY (`usuarios`) REFERENCES `adm_usuarios` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cls_detalle_classroom`
--

LOCK TABLES `cls_detalle_classroom` WRITE;
/*!40000 ALTER TABLE `cls_detalle_classroom` DISABLE KEYS */;
INSERT INTO `cls_detalle_classroom` VALUES (3,31,'Maria123'),(4,31,'mario5675'),(5,31,'nelio2120');
/*!40000 ALTER TABLE `cls_detalle_classroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cls_post_comentarios`
--

DROP TABLE IF EXISTS `cls_post_comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cls_post_comentarios` (
  `idcls_detalle_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `fecha_pub` datetime DEFAULT NULL,
  PRIMARY KEY (`idcls_detalle_post`),
  KEY `fk_cab_post_idx` (`id_post`),
  KEY `fk_usuario_c_idx` (`usuario`),
  CONSTRAINT `fk_cab_post` FOREIGN KEY (`id_post`) REFERENCES `cls_posts_classroom` (`id_cls_posts_classroom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_c` FOREIGN KEY (`usuario`) REFERENCES `adm_usuarios` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cls_post_comentarios`
--

LOCK TABLES `cls_post_comentarios` WRITE;
/*!40000 ALTER TABLE `cls_post_comentarios` DISABLE KEYS */;
INSERT INTO `cls_post_comentarios` VALUES (1,2,'Nolose compañera xD preguntele al profesor','mareio334','2020-12-12 05:05:05'),(2,2,'Deberias consultar con la mas vieja de tu casa','admin','2020-12-12 05:05:05'),(3,2,'yo pienso q esta bien ','admin','2020-03-29 00:00:00'),(4,2,'claro como quieras xD','admin','2020-03-29 00:00:00'),(5,2,'bien','admin','2020-03-29 00:00:00'),(6,69,'bien','admin','2020-03-30 00:00:00'),(7,69,'hola xD ','admin','2020-03-30 00:00:00'),(8,69,'Bien','admin','2020-03-30 00:00:00'),(9,70,'hola','admin','2020-03-30 00:00:00');
/*!40000 ALTER TABLE `cls_post_comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cls_post_detalle_classroom`
--

DROP TABLE IF EXISTS `cls_post_detalle_classroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cls_post_detalle_classroom` (
  `idcls_post_detalle_classroom` int(11) NOT NULL AUTO_INCREMENT,
  `post_clasroom` int(11) DEFAULT NULL,
  `recurso` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idcls_post_detalle_classroom`),
  KEY `post_detalle_fk_idx` (`post_clasroom`),
  CONSTRAINT `post_detalle_fk` FOREIGN KEY (`post_clasroom`) REFERENCES `cls_posts_classroom` (`id_cls_posts_classroom`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cls_post_detalle_classroom`
--

LOCK TABLES `cls_post_detalle_classroom` WRITE;
/*!40000 ALTER TABLE `cls_post_detalle_classroom` DISABLE KEYS */;
/*!40000 ALTER TABLE `cls_post_detalle_classroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cls_posts_classroom`
--

DROP TABLE IF EXISTS `cls_posts_classroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cls_posts_classroom` (
  `id_cls_posts_classroom` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) NOT NULL,
  `classroom` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_cls_posts_classroom`),
  KEY `fk_usuario_post_idx` (`usuario`),
  KEY `fk_class_id_idx` (`classroom`),
  CONSTRAINT `fk_class_id` FOREIGN KEY (`classroom`) REFERENCES `cls_classroom` (`id_classroom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_post` FOREIGN KEY (`usuario`) REFERENCES `adm_usuarios` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cls_posts_classroom`
--

LOCK TABLES `cls_posts_classroom` WRITE;
/*!40000 ALTER TABLE `cls_posts_classroom` DISABLE KEYS */;
INSERT INTO `cls_posts_classroom` VALUES (2,'DenisitaxD',31,'2020-03-22','Buenas tardes, alguien podria decirme a que hora es la leccion'),(69,'admin',32,'2020-03-30','Hola'),(70,'admin',32,'2020-03-30','hola');
/*!40000 ALTER TABLE `cls_posts_classroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cls_usuario_tareas`
--

DROP TABLE IF EXISTS `cls_usuario_tareas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cls_usuario_tareas` (
  `id_usuario_tareas` int(11) NOT NULL AUTO_INCREMENT,
  `recurso` varchar(150) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `id_tarea` int(11) DEFAULT NULL,
  `descripcion` text,
  `observacion` varchar(500) DEFAULT 'Sin observaciones',
  `calificacion` int(11) DEFAULT '0',
  `estado` varchar(45) DEFAULT 'No revisado',
  `fecha_pub` date DEFAULT NULL,
  PRIMARY KEY (`id_usuario_tareas`),
  KEY `fk_id_usuario_idx` (`usuario`),
  KEY `fk_id_tarea_idx` (`id_tarea`),
  CONSTRAINT `fk_id_tarea` FOREIGN KEY (`id_tarea`) REFERENCES `cls_cab_tareas` (`idcls_cab_tareas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_usuario` FOREIGN KEY (`usuario`) REFERENCES `adm_usuarios` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cls_usuario_tareas`
--

LOCK TABLES `cls_usuario_tareas` WRITE;
/*!40000 ALTER TABLE `cls_usuario_tareas` DISABLE KEYS */;
INSERT INTO `cls_usuario_tareas` VALUES (1,'Calculo_deber','admin',1,'sadasd','Tienes menos ahora por que no tienes los anexos adecuados.',8,'Revisado','2020-03-04');
/*!40000 ALTER TABLE `cls_usuario_tareas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cursos` (
  `cur_id` int(11) NOT NULL AUTO_INCREMENT,
  `cur_ciclo` int(11) DEFAULT NULL,
  `cur_nivel` int(11) DEFAULT NULL,
  `cur_paralelo` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`cur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_alumno`
--

DROP TABLE IF EXISTS `detalle_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_alumno` (
  `id_detalle_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `id_alumno` varchar(25) NOT NULL,
  `id_curso` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle_alumno`),
  KEY `fk_alumno_id` (`id_alumno`),
  KEY `fk_curso_id` (`id_curso`),
  CONSTRAINT `fk_alumno_id` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`alu_cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_curso_id` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`cur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_alumno`
--

LOCK TABLES `detalle_alumno` WRITE;
/*!40000 ALTER TABLE `detalle_alumno` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_profesor`
--

DROP TABLE IF EXISTS `detalle_profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_profesor` (
  `id_detalle_profesor` int(11) NOT NULL AUTO_INCREMENT,
  `cedula_profesor` varchar(15) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_materia` varchar(11) NOT NULL,
  PRIMARY KEY (`id_detalle_profesor`),
  KEY `fk_profesor` (`cedula_profesor`),
  KEY `fk_detalle_curso` (`id_curso`),
  KEY `fk_materias_id` (`id_materia`),
  CONSTRAINT `fk_detalle_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`cur_id`),
  CONSTRAINT `fk_materias_id` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`mat_codigo`),
  CONSTRAINT `fk_profesor` FOREIGN KEY (`cedula_profesor`) REFERENCES `profesor` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_profesor`
--

LOCK TABLES `detalle_profesor` WRITE;
/*!40000 ALTER TABLE `detalle_profesor` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_usuario`
--

DROP TABLE IF EXISTS `detalle_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_usuario` (
  `iddetalle_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `clasroom` int(11) DEFAULT NULL,
  `id_usuario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddetalle_usuario`),
  KEY `fk_usuario_clasroom_idx` (`id_usuario`),
  KEY `fk_classroom_idx` (`clasroom`),
  CONSTRAINT `fk_classroom` FOREIGN KEY (`clasroom`) REFERENCES `cls_classroom` (`id_classroom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_clasroom` FOREIGN KEY (`id_usuario`) REFERENCES `adm_usuarios` (`usu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_usuario`
--

LOCK TABLES `detalle_usuario` WRITE;
/*!40000 ALTER TABLE `detalle_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facturas` (
  `fac_numero` int(11) NOT NULL AUTO_INCREMENT,
  `fac_matricula` int(11) DEFAULT NULL,
  `fac_letra` int(11) DEFAULT NULL,
  `fac_valor` decimal(6,2) DEFAULT NULL,
  `fac_saldo` decimal(6,2) DEFAULT NULL,
  `fac_fechatrx` datetime DEFAULT NULL,
  PRIMARY KEY (`fac_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias` (
  `mat_codigo` varchar(10) NOT NULL,
  `mat_nivel` int(11) DEFAULT NULL,
  `mat_descripcion` varchar(60) DEFAULT NULL,
  `mat_estado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`mat_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias`
--

LOCK TABLES `materias` WRITE;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matriculas`
--

DROP TABLE IF EXISTS `matriculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matriculas` (
  `mat_numero` int(11) NOT NULL AUTO_INCREMENT,
  `mat_alumno` varchar(10) DEFAULT NULL,
  `mat_curso` int(11) DEFAULT NULL,
  PRIMARY KEY (`mat_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matriculas`
--

LOCK TABLES `matriculas` WRITE;
/*!40000 ALTER TABLE `matriculas` DISABLE KEYS */;
/*!40000 ALTER TABLE `matriculas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveles`
--

DROP TABLE IF EXISTS `niveles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `niveles` (
  `niv_id` int(11) NOT NULL AUTO_INCREMENT,
  `niv_valorMatricula` decimal(6,2) DEFAULT NULL,
  `niv_valorPension` decimal(6,2) DEFAULT NULL,
  `niv_meses` int(11) DEFAULT NULL,
  PRIMARY KEY (`niv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveles`
--

LOCK TABLES `niveles` WRITE;
/*!40000 ALTER TABLE `niveles` DISABLE KEYS */;
/*!40000 ALTER TABLE `niveles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagos` (
  `pag_numero` int(11) NOT NULL AUTO_INCREMENT,
  `pag_factura` int(11) DEFAULT NULL,
  `pag_fecha` date DEFAULT NULL,
  `pag_Valor` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`pag_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `estado_civil` varchar(10) NOT NULL,
  `hijos` varchar(5) NOT NULL,
  `intereses` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (1,'luis','luis@gmail.com','0979382621','Casado','0','Ninguna'),(2,'Eduardo','eduardo@gmail.com','0963772798','SOLTERO','0','Libros Musica'),(3,'LUIS','luis@gmaiul.com','0979382621','SOLTERO','0','Musica');
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesor` (
  `cedula` varchar(12) NOT NULL,
  `profesor_nombre` varchar(50) NOT NULL,
  `profesor_apellido` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT 'Activo',
  PRIMARY KEY (`cedula`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `fk_usuario_profesor` (`usuario`),
  CONSTRAINT `fk_usuario_profesor` FOREIGN KEY (`usuario`) REFERENCES `adm_usuarios` (`usu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `representantes`
--

DROP TABLE IF EXISTS `representantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `representantes` (
  `rep_cedula` varchar(10) NOT NULL,
  `rep_nombres` varchar(60) DEFAULT NULL,
  `rep_apellidos` varchar(60) DEFAULT NULL,
  `rep_telefono` varchar(20) DEFAULT NULL,
  `rep_direccion` varchar(60) DEFAULT NULL,
  `rep_correo` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`rep_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `representantes`
--

LOCK TABLES `representantes` WRITE;
/*!40000 ALTER TABLE `representantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `representantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database '4g'
--

--
-- Dumping routines for database '4g'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-01 10:40:55
