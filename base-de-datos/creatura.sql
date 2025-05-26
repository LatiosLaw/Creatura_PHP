-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2025 a las 03:30:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `creatura`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creatura`
--

CREATE TABLE `creatura` (
  `id_creatura` int(10) NOT NULL,
  `nombre_creatura` varchar(30) NOT NULL,
  `id_tipo1` int(5) NOT NULL,
  `id_tipo2` int(5) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `hp` int(3) NOT NULL,
  `atk` int(3) NOT NULL,
  `def` int(3) NOT NULL,
  `spa` int(3) NOT NULL,
  `sdef` int(3) NOT NULL,
  `spe` int(3) NOT NULL,
  `creador` varchar(30) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `publico` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `creatura`
--

INSERT INTO `creatura` (`id_creatura`, `nombre_creatura`, `id_tipo1`, `id_tipo2`, `descripcion`, `hp`, `atk`, `def`, `spa`, `sdef`, `spe`, `creador`, `imagen`, `publico`) VALUES
(0, 'Porro', 1, 2, 'Snoop Dogg', 100, 100, 100, 100, 100, 100, 'Mr.Dr.Admin', '', 1),
(1, 'Chijajua', 2, 0, 'No puede respirar, su fuego interno se apagara pronto.', 90, 50, 30, 50, 30, 10, 'Mr.Dr.Admin', '', 0),
(2, 'RadiaDoor', 4, 0, 'La puerta hacia la destrucción molecular.', 50, 30, 20, 140, 100, 100, 'Mr.Dr.Admin', '', 1),
(3, 'Dragon de nube ', 2, 3, 'Directamente sacado de la ciudad de dragones.', 130, 100, 40, 100, 50, 90, 'Mr.Dr.Admin', '', 1),
(4, 'GorillaGorillaGorilla', 1, 0, '', 150, 150, 90, 10, 10, 50, 'Juansito', '', 0),
(5, 'Walter Grey', 3, 0, '', 50, 50, 50, 200, 130, 50, 'Juansito', '', 0),
(10, 'Elemental-Fogo', 2, 0, 'Bicho básico de un elemento.\r\n', 90, 90, 90, 90, 90, 90, 'Mr.Dr.Admin', '', 1),
(11, 'Elemental-Walter', 3, 0, 'Bicho basico de un elemento', 90, 90, 90, 90, 90, 90, 'Mr.Dr.Admin', '', 1),
(13, 'Elemental-Weed', 1, 0, 'Elemental basico de un elemento', 90, 90, 90, 90, 90, 90, 'Mr.Dr.Admin', 'GdrMNInXoAAfXfa.jpg', 1),
(20, 'CHivito', 5, 2, 'Calientemente hediendo a chivo', 100, 45, 23, 150, 34, 60, 'Juansito', '', 0),
(21, 'PuraRaza', 5, 0, 'Un chivo puro', 90, 90, 90, 90, 90, 90, 'Juansito', '', 0),
(100, 'Portónus', 6, 11, 'Guardia dimensional con bisagras místicas.', 90, 70, 100, 60, 95, 40, 'WeirdAniki7963', 'portonus.png', 1),
(101, 'Flamememe', 7, 2, 'Un meme tan caliente que puede derretir cerebros.', 60, 85, 40, 95, 35, 90, 'PepeQuantum', 'flamememe.png', 1),
(102, 'Tostarex', 14, 21, 'Monstruo de pan frito con garras crujientes.', 95, 110, 85, 40, 80, 45, 'LordOfBread', 'tostarex.png', 1),
(103, 'Kawazoid', 10, 13, 'Mecha kawaii que irradia energía incómoda.', 75, 65, 60, 110, 70, 95, 'UwUDestructor', 'kawazoid.png', 1),
(104, 'Gremlash', 9, 14, 'Criatura malvada que vive en las frituras viejas.', 50, 90, 70, 50, 40, 100, 'KeyboardGremlin', 'gremlash.png', 1),
(105, 'Shreknator', 11, 20, 'Habitante del pantano que brota fuerza bruta.', 110, 120, 100, 45, 60, 40, 'GigaShrek420', 'shreknator.png', 1),
(106, 'Breadgeist', 8, 15, 'Pan espectral que aparece en cocinas encantadas.', 65, 55, 70, 80, 95, 60, 'LordOfBread', 'breadgeist.png', 1),
(107, 'Cringardian', 13, 6, 'Protege la entrada a los templos del bochorno.', 85, 50, 100, 65, 100, 35, 'AnimeTank47', 'cringardian.png', 1),
(108, 'Senpunch', 18, 17, 'Guerrero waifu con golpes emocionales.', 70, 95, 65, 90, 70, 75, 'AnimeTank47', 'senpunch.png', 1),
(109, 'Fritoon', 14, 23, 'Dibujo animado hecho de grasa digital.', 50, 70, 55, 100, 45, 105, 'xX_DoritoLord_Xx', 'fritoon.png', 1),
(110, 'Neobread', 15, 8, 'Molde ancestral digitalizado en forma de pan.', 80, 70, 80, 85, 90, 50, 'Ghost_Memez', 'neobread.png', 1),
(111, 'Pantanico', 11, 3, 'Criatura viscosa que ama lo húmedo y huele a moho.', 100, 60, 85, 50, 65, 35, 'GigaShrek420', 'pantanico.png', 1),
(112, 'Waifumancer', 18, 12, 'Hechicero del universo kawaii alterno.', 70, 50, 65, 120, 80, 75, 'AnimeTank47', 'waifumancer.png', 1),
(113, 'Crustark', 21, 14, 'Bestia de pan tostado con caparazón blindado.', 95, 85, 105, 30, 70, 40, 'LordOfBread', 'crustark.png', 1),
(114, 'UwUlker', 10, 16, 'Ataca con mimos y pisotones con estilo.', 60, 90, 50, 80, 60, 100, 'UwUDestructor', 'uwulker.png', 1),
(115, 'Pantuflazo', 24, 22, 'Rana vieja con pantuflas mágicas.', 85, 55, 80, 60, 75, 50, 'MrBeefyToes', 'pantuflazo.png', 1),
(116, 'Ranator', 22, 20, 'Batalla con lengua y raíces ancestrales.', 100, 90, 80, 70, 80, 65, 'PepeQuantum', 'ranator.png', 1),
(117, 'Toestro', 16, 21, 'Camina con pasos que hacen temblar la tierra.', 110, 100, 90, 30, 85, 25, 'MrBeefyToes', 'toestro.png', 1),
(118, 'Neondor', 23, 6, 'Guardián de portales brillantes con estilo retro.', 70, 65, 55, 95, 85, 100, 'Ghost_Memez', 'neondor.png', 1),
(119, 'Quantumick', 12, 15, 'Entidad memética que viaja entre realidades.', 60, 45, 60, 105, 100, 90, 'PepeQuantum', 'quantumick.png', 1),
(120, 'Desukiba', 17, 18, 'Zorro rosado con gritos de anime.', 75, 80, 65, 95, 70, 90, 'UwUDestructor', 'desukiba.png', 1),
(121, 'Cringochu', 13, 1, 'Ratón eléctrico que da vergüenza ajena.', 60, 55, 50, 90, 45, 105, 'AnimeTank47', 'cringochu.png', 1),
(122, 'Breadzilla', 8, 21, 'Gigante de harina que arrasa ciudades.', 130, 110, 100, 40, 60, 30, 'LordOfBread', 'breadzilla.png', 1),
(123, 'Pantafume', 11, 24, 'Hongo del pantano con olor a nostalgia.', 70, 40, 65, 80, 90, 60, 'GigaShrek420', 'pantafume.png', 1),
(124, 'Fritobite', 14, 19, 'Pícaro digital con garras grasosas.', 80, 90, 70, 50, 55, 80, 'xX_DoritoLord_Xx', 'fritobite.png', 1),
(125, 'Neodoor', 23, 6, 'Puerta que brilla en la oscuridad y canta eurobeat.', 60, 40, 85, 100, 75, 105, 'Ghost_Memez', 'neodoor.png', 1),
(126, 'Gremlumin', 9, 15, 'Gremlin que absorbe luz y memes.', 55, 60, 50, 90, 40, 110, 'KeyboardGremlin', 'gremlumin.png', 1),
(127, 'Desuslam', 17, 14, 'Fritura kawaii con ataques pegajosos.', 65, 70, 50, 75, 60, 95, 'UwUDestructor', 'desuslam.png', 1),
(128, 'Ranakami', 22, 18, 'Diosa rana de las waifus.', 75, 60, 65, 100, 70, 75, 'PepeQuantum', 'ranakami.png', 1),
(129, 'Tostaniki', 14, 25, 'Entidad crujiente del linaje aniki.', 85, 85, 75, 70, 60, 55, 'WeirdAniki7963', 'tostaniki.png', 1),
(130, 'Quantumesa', 12, 10, 'Mujer digital de poder kawaii cuántico.', 70, 50, 65, 120, 80, 75, 'PepeQuantum', 'quantumesa.png', 1),
(131, 'Anikiporte', 6, 25, 'Puerta ancestral que juzga tu cringe.', 100, 70, 90, 65, 90, 40, 'WeirdAniki7963', 'anikiporte.png', 1),
(132, 'Dorikami', 7, 25, 'Dios del picante digital.', 60, 110, 50, 80, 40, 90, 'xX_DoritoLord_Xx', 'dorikami.png', 1),
(133, 'Toevador', 16, 6, 'Caballero errante con armadura de dedos.', 100, 85, 85, 40, 80, 35, 'MrBeefyToes', 'toevador.png', 1),
(134, 'Porthulu', 6, 15, 'Deidad puerta atrapada entre memes.', 120, 70, 100, 90, 100, 30, 'WeirdAniki7963', 'porthulu.png', 1),
(135, 'Panorama', 19, 23, 'Espía pantalla que observa desde las sombras.', 70, 60, 70, 90, 75, 100, 'KeyboardGremlin', 'panorama.png', 1),
(136, 'Uwukiller', 10, 7, 'Asesino adorable que quema con ternura.', 65, 105, 50, 70, 50, 90, 'UwUDestructor', 'uwukiller.png', 1),
(137, 'Desustal', 17, 8, 'Cristal viviente con sentimientos tsundere.', 75, 55, 80, 85, 80, 70, 'UwUDestructor', 'desustal.png', 1),
(138, 'Cringeflare', 13, 7, 'Explosión bochornosa de humor radiactivo.', 50, 70, 55, 100, 45, 95, 'AnimeTank47', 'cringeflare.png', 1),
(139, 'Ran4n4', 22, 19, 'Versión digitalizada de una rana que hackea.', 65, 75, 60, 85, 50, 100, 'PepeQuantum', 'ran4n4.png', 1),
(140, 'Toegolem', 16, 6, 'Golem de madera vieja y sandalias.', 110, 100, 120, 30, 90, 20, 'MrBeefyToes', 'toegolem.png', 1),
(141, 'Waifutrón', 18, 9, 'Robot adorable con complejos.', 80, 65, 70, 95, 85, 85, 'AnimeTank47', 'waifutron.png', 1),
(142, 'Neotoaster', 23, 14, 'Tostadora futurista de combate.', 75, 95, 60, 70, 60, 100, 'xX_DoritoLord_Xx', 'neotoaster.png', 1),
(143, 'Brotalord', 20, 25, 'Maestro vegetal de tiempos remotos.', 95, 75, 80, 90, 100, 55, 'WeirdAniki7963', 'bortalord.png', 1),
(144, 'Crustpunk', 21, 15, 'Pan con actitud rebelde y espinas pixeladas.', 85, 100, 65, 70, 65, 90, 'LordOfBread', 'crustpunk.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `efectividades`
--

CREATE TABLE `efectividades` (
  `id_efectividad` int(5) NOT NULL,
  `atacante` int(5) NOT NULL,
  `defensor` int(5) NOT NULL,
  `multiplicador` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `efectividades`
--

INSERT INTO `efectividades` (`id_efectividad`, `atacante`, `defensor`, `multiplicador`) VALUES
(1, 1, 2, 0.5),
(2, 2, 1, 2),
(3, 3, 1, 0.5),
(4, 3, 2, 2),
(5, 2, 3, 0.5),
(6, 4, 1, 2),
(7, 4, 2, 2),
(8, 4, 3, 2),
(9, 4, 4, 0.5),
(10, 9, 18, 0.5),
(11, 9, 24, 1),
(12, 9, 12, 2),
(13, 10, 6, 2),
(14, 10, 13, 0.5),
(15, 10, 17, 1),
(16, 11, 8, 2),
(17, 11, 23, 0.5),
(18, 11, 21, 1),
(19, 12, 25, 2),
(20, 5, 4, 4),
(21, 12, 18, 1),
(22, 13, 10, 2),
(23, 13, 8, 0.5),
(24, 13, 6, 1),
(25, 14, 22, 2),
(26, 14, 23, 0.5),
(27, 14, 25, 1),
(28, 15, 9, 2),
(29, 15, 6, 1),
(30, 15, 13, 0.5),
(31, 16, 8, 2),
(32, 16, 21, 1),
(33, 16, 10, 0.5),
(34, 17, 7, 0.5),
(35, 17, 9, 1),
(36, 17, 23, 2),
(37, 18, 13, 2),
(38, 18, 6, 1),
(39, 18, 17, 0.5),
(40, 19, 7, 1),
(41, 19, 23, 2),
(42, 19, 11, 0.5),
(43, 20, 9, 1),
(44, 20, 14, 2),
(45, 20, 6, 1),
(46, 21, 16, 2),
(47, 21, 19, 1),
(48, 21, 10, 0.5),
(49, 22, 14, 2),
(50, 22, 11, 1),
(51, 22, 18, 2),
(52, 23, 9, 1),
(53, 23, 19, 2),
(54, 23, 24, 0.5),
(55, 24, 8, 0.5),
(56, 24, 13, 1),
(57, 24, 10, 2),
(58, 25, 20, 2),
(59, 25, 7, 2),
(60, 25, 16, 0.5),
(61, 17, 18, 0),
(62, 24, 18, 0.5),
(63, 13, 18, 2),
(64, 10, 18, 0.5),
(65, 19, 12, 0.5),
(66, 15, 12, 0.5),
(67, 23, 12, 0.5),
(68, 25, 12, 2),
(69, 25, 18, 2),
(70, 19, 18, 0.5),
(71, 11, 18, 2),
(11111, 6, 14, 0.5),
(21111, 6, 17, 1),
(31111, 6, 11, 1),
(51111, 7, 24, 0.5),
(61111, 7, 8, 1),
(71111, 8, 10, 0.5),
(81111, 8, 11, 0.5),
(91111, 8, 23, 2),
(201111, 12, 6, 1),
(411111, 7, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidad`
--

CREATE TABLE `habilidad` (
  `id_habilidad` int(5) NOT NULL,
  `nombre_habilidad` varchar(25) NOT NULL,
  `id_tipo_habilidad` int(5) NOT NULL COMMENT 'A que tipo pertenece esta habilidad',
  `descripcion` varchar(80) NOT NULL,
  `categoria_habilidad` varchar(10) NOT NULL COMMENT 'Ataque físico, ataque especial o habilidad de estado',
  `potencia` int(5) NOT NULL,
  `creador` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habilidad`
--

INSERT INTO `habilidad` (`id_habilidad`, `nombre_habilidad`, `id_tipo_habilidad`, `descripcion`, `categoria_habilidad`, `potencia`, `creador`) VALUES
(1, 'Destructor Sub-Atomico', 4, 'Te destruye sub-atomicamente, duh.\r\nImpide regeneracion.', 'esp', 100, 'Mr.Dr.Admin'),
(2, 'Coca Punch', 1, 'Coca Punch!', 'fis', 35, 'Mr.Dr.Admin'),
(3, 'heal', 1, 'Se cura un 50% del hp actual.', 'sts', 0, 'Mr.Dr.Admin'),
(4, 'respirar', 2, 'Respirar fuego goes brrr', 'sts', 0, 'Mr.Dr.Admin'),
(5, 'Chorro do fogo', 2, 'CHorro do fogo', 'esp', 100, 'Mr.Dr.Admin'),
(6, 'Wlater Punch', 3, 'We need to cook punh!', 'fis', 35, 'Juansito'),
(7, 'healra', 3, 'Con el poder de aguas calentitas cura a todo el equipo.', 'sts', 0, 'Juansito'),
(13, 'JajajTrece', 4, 'JAJAJAJ trece', 'sts', 0, 'Juansito'),
(20, 'Chivosidad', 5, 'DESPRENDE un hedor horrible.', 'esp', 90, 'Juansito'),
(21, 'ChivoSucc', 5, 'Se succiona el olor a chivo y recupera un 30 % de hp.', 'sts', 0, 'Juansito'),
(26, 'Superposición Mental', 12, 'Una técnica especial que actúa antes de ser observado y traspasa defensas.', 'esp', 113, 'weirdaniki7963'),
(27, 'Pisotón Suave Estratégico', 24, 'Una táctica de estado que parece cómodo pero duele.', 'sts', 0, 'weirdaniki7963'),
(28, 'Croac Explosivo Impacto', 22, 'Un ataque físico que onda sonora saltarina.', 'fis', 61, 'weirdaniki7963'),
(29, 'Miasma Impacto', 11, 'Un ataque físico que asfixia con vapores densos.', 'fis', 110, 'weirdaniki7963'),
(30, 'Chispa Viral Estratégico', 7, 'Una táctica de estado que quema con ironía inflamable.', 'sts', 0, 'weirdaniki7963'),
(31, 'Travesura Mental', 9, 'Una técnica especial que sabotea con caos electrónico y traspasa defensas.', 'esp', 70, 'weirdaniki7963'),
(32, 'Estética Impacto', 15, 'Un ataque físico que envuelve con un beat nostálgico.', 'fis', 110, 'weirdaniki7963'),
(33, 'Curación Total Estratégic', 8, 'Una táctica de estado que restaura todo, incluso la dignidad.', 'sts', 0, 'weirdaniki7963'),
(34, 'Invocación Impacto', 25, 'Un ataque físico que trae fuerza de tiempos olvidados.', 'fis', 116, 'weirdaniki7963'),
(35, 'Rugido Kawaii Mental', 10, 'Una técnica especial que derrite corazones antes de aplastar y traspasa defensas', 'esp', 50, 'weirdaniki7963'),
(36, 'Fluorescencia Impacto', 23, 'Un ataque físico que destellos que distraen al enemigo.', 'fis', 56, 'weirdaniki7963'),
(37, 'Bisagra Impacto', 6, 'Un ataque físico que abre dimensiones con un portazo ruidoso.', 'fis', 50, 'weirdaniki7963'),
(38, 'Invocación Estratégico', 25, 'Una táctica de estado que trae fuerza de tiempos olvidados.', 'sts', 0, 'weirdaniki7963'),
(39, 'Croac Explosivo Estratégi', 22, 'Una táctica de estado que onda sonora saltarina.', 'sts', 0, 'weirdaniki7963'),
(40, 'Travesura Impacto', 9, 'Un ataque físico que sabotea con caos electrónico.', 'fis', 65, 'weirdaniki7963'),
(41, 'Pantallazo Mental', 19, 'Una técnica especial que ciega con luz azul inesperada y traspasa defensas.', 'esp', 106, 'weirdaniki7963'),
(42, 'Miasma Estratégico', 11, 'Una táctica de estado que asfixia con vapores densos.', 'sts', 0, 'weirdaniki7963'),
(43, 'Pantallazo Impacto', 19, 'Un ataque físico que ciega con luz azul inesperada.', 'fis', 52, 'weirdaniki7963'),
(44, 'Rebrote Mental', 20, 'Una técnica especial que crece otra vez, más fuerte que nunca y traspasa defensa', 'esp', 91, 'weirdaniki7963'),
(45, 'Pisotón Suave Impacto', 24, 'Un ataque físico que parece cómodo pero duele.', 'fis', 51, 'weirdaniki7963'),
(46, 'Crujido Impacto', 14, 'Un ataque físico que hace crujir los oídos con aceite ardiente.', 'fis', 80, 'weirdaniki7963'),
(47, 'Invocación Estratégico', 25, 'Una táctica de estado que trae fuerza de tiempos olvidados.', 'sts', 0, 'weirdaniki7963'),
(48, 'Superposición Estratégico', 12, 'Una táctica de estado que actúa antes de ser observado.', 'sts', 0, 'weirdaniki7963'),
(49, 'Golpe Moe Mental', 17, 'Una técnica especial que es tan lindo que confunde y traspasa defensas.', 'esp', 57, 'weirdaniki7963'),
(50, 'Crocante Estratégico', 21, 'Una táctica de estado que una onda caliente que lastima.', 'sts', 0, 'weirdaniki7963'),
(51, 'Bochorno Mental', 13, 'Una técnica especial que provoca vergüenza que daña el alma y traspasa defensas.', 'esp', 115, 'weirdaniki7963'),
(52, 'Bochorno Impacto', 13, 'Un ataque físico que provoca vergüenza que daña el alma.', 'fis', 92, 'weirdaniki7963'),
(53, 'Crujido Mental', 14, 'Una técnica especial que hace crujir los oídos con aceite ardiente y traspasa de', 'esp', 112, 'weirdaniki7963'),
(54, 'Golpe Moe Mental', 17, 'Una técnica especial que es tan lindo que confunde y traspasa defensas.', 'esp', 77, 'weirdaniki7963'),
(55, 'Pisotón Impacto', 16, 'Un ataque físico que aplastamiento con gran dureza y dolor.', 'fis', 100, 'weirdaniki7963'),
(56, 'Bochorno Impacto', 13, 'Un ataque físico que provoca vergüenza que daña el alma.', 'fis', 103, 'weirdaniki7963'),
(57, 'Chispa Viral Estratégico', 7, 'Una táctica de estado que quema con ironía inflamable.', 'sts', 0, 'weirdaniki7963'),
(58, 'Pantallazo Estratégico', 19, 'Una táctica de estado que ciega con luz azul inesperada.', 'sts', 0, 'weirdaniki7963'),
(59, 'Bochorno Estratégico', 13, 'Una táctica de estado que provoca vergüenza que daña el alma.', 'sts', 0, 'weirdaniki7963'),
(60, 'Invocación Mental', 25, 'Una técnica especial que trae fuerza de tiempos olvidados y traspasa defensas.', 'esp', 100, 'weirdaniki7963'),
(61, 'Bisagra Estratégico', 6, 'Una táctica de estado que abre dimensiones con un portazo ruidoso.', 'sts', 0, 'weirdaniki7963'),
(62, 'Pisotón Suave Impacto', 24, 'Un ataque físico que parece cómodo pero duele.', 'fis', 53, 'weirdaniki7963'),
(63, 'Pantallazo Estratégico', 19, 'Una táctica de estado que ciega con luz azul inesperada.', 'sts', 0, 'weirdaniki7963'),
(64, 'Rugido Kawaii Estratégico', 10, 'Una táctica de estado que derrite corazones antes de aplastar.', 'sts', 0, 'weirdaniki7963'),
(65, 'Crujido Mental', 14, 'Una técnica especial que hace crujir los oídos con aceite ardiente y traspasa de', 'esp', 71, 'weirdaniki7963'),
(66, 'Croac Explosivo Estratégi', 22, 'Una táctica de estado que onda sonora saltarina.', 'sts', 0, 'weirdaniki7963'),
(67, 'Bisagra Impacto', 6, 'Un ataque físico que abre dimensiones con un portazo ruidoso.', 'fis', 88, 'weirdaniki7963'),
(68, 'Mirada Tierna Mental', 18, 'Una técnica especial que hipnotiza con afecto digital y traspasa defensas.', 'esp', 111, 'weirdaniki7963'),
(69, 'Pisotón Impacto', 16, 'Un ataque físico que aplastamiento con gran dureza y dolor.', 'fis', 104, 'weirdaniki7963'),
(70, 'Travesura Estratégico', 9, 'Una táctica de estado que sabotea con caos electrónico.', 'sts', 0, 'weirdaniki7963'),
(71, 'Estética Impacto', 15, 'Un ataque físico que envuelve con un beat nostálgico.', 'fis', 60, 'weirdaniki7963'),
(72, 'Rugido Kawaii Estratégico', 10, 'Una táctica de estado que derrite corazones antes de aplastar.', 'sts', 0, 'weirdaniki7963'),
(73, 'Bochorno Estratégico', 13, 'Una táctica de estado que provoca vergüenza que daña el alma.', 'sts', 0, 'weirdaniki7963'),
(74, 'Crujido Estratégico', 14, 'Una táctica de estado que hace crujir los oídos con aceite ardiente.', 'sts', 0, 'weirdaniki7963'),
(75, 'Chispa Viral Impacto', 7, 'Un ataque físico que quema con ironía inflamable.', 'fis', 57, 'weirdaniki7963'),
(76, 'Curación Total Mental', 8, 'Una técnica especial que restaura todo, incluso la dignidad y traspasa defensas.', 'esp', 48, 'weirdaniki7963'),
(77, 'Rugido Kawaii Impacto', 10, 'Un ataque físico que derrite corazones antes de aplastar.', 'fis', 75, 'weirdaniki7963'),
(78, 'Chispa Viral Estratégico', 7, 'Una táctica de estado que quema con ironía inflamable.', 'sts', 0, 'weirdaniki7963'),
(79, 'Bisagra Impacto', 6, 'Un ataque físico que abre dimensiones con un portazo ruidoso.', 'fis', 78, 'weirdaniki7963'),
(80, 'Crujido Mental', 14, 'Una técnica especial que hace crujir los oídos con aceite ardiente y traspasa de', 'esp', 60, 'weirdaniki7963'),
(81, 'Fluorescencia Mental', 23, 'Una técnica especial que destellos que distraen al enemigo y traspasa defensas.', 'esp', 113, 'weirdaniki7963'),
(82, 'Superposición Mental', 12, 'Una técnica especial que actúa antes de ser observado y traspasa defensas.', 'esp', 84, 'weirdaniki7963'),
(83, 'Invocación Mental', 25, 'Una técnica especial que trae fuerza de tiempos olvidados y traspasa defensas.', 'esp', 91, 'weirdaniki7963'),
(84, 'Pantallazo Estratégico', 19, 'Una táctica de estado que ciega con luz azul inesperada.', 'sts', 0, 'weirdaniki7963'),
(85, 'Crocante Impacto', 21, 'Un ataque físico que una onda caliente que lastima.', 'fis', 60, 'weirdaniki7963'),
(86, 'Curación Total Impacto', 8, 'Un ataque físico que restaura todo, incluso la dignidad.', 'fis', 66, 'weirdaniki7963'),
(87, 'Golpe Moe Estratégico', 17, 'Una táctica de estado que es tan lindo que confunde.', 'sts', 0, 'weirdaniki7963'),
(88, 'Pantallazo Mental', 19, 'Una técnica especial que ciega con luz azul inesperada y traspasa defensas.', 'esp', 95, 'weirdaniki7963'),
(89, 'Pisotón Suave Mental', 24, 'Una técnica especial que parece cómodo pero duele y traspasa defensas.', 'esp', 119, 'weirdaniki7963'),
(90, 'Chispa Viral Impacto', 7, 'Un ataque físico que quema con ironía inflamable.', 'fis', 63, 'weirdaniki7963'),
(91, 'Travesura Impacto', 9, 'Un ataque físico que sabotea con caos electrónico.', 'fis', 85, 'weirdaniki7963'),
(92, 'Miasma Impacto', 11, 'Un ataque físico que asfixia con vapores densos.', 'fis', 111, 'weirdaniki7963'),
(93, 'Rugido Kawaii Estratégico', 10, 'Una táctica de estado que derrite corazones antes de aplastar.', 'sts', 0, 'weirdaniki7963'),
(94, 'Bisagra Mental', 6, 'Una técnica especial que abre dimensiones con un portazo ruidoso y traspasa defe', 'esp', 84, 'weirdaniki7963'),
(95, 'Croac Explosivo Estratégi', 22, 'Una táctica de estado que onda sonora saltarina.', 'sts', 0, 'weirdaniki7963'),
(96, 'Pisotón Suave Estratégico', 24, 'Una táctica de estado que parece cómodo pero duele.', 'sts', 0, 'weirdaniki7963'),
(97, 'Croac Explosivo Mental', 22, 'Una técnica especial que onda sonora saltarina y traspasa defensas.', 'esp', 118, 'weirdaniki7963'),
(98, 'Pantallazo Impacto', 19, 'Un ataque físico que ciega con luz azul inesperada.', 'fis', 56, 'weirdaniki7963'),
(99, 'Pisotón Suave Impacto', 24, 'Un ataque físico que parece cómodo pero duele.', 'fis', 52, 'weirdaniki7963'),
(100, 'Pantallazo Estratégico', 19, 'Una táctica de estado que ciega con luz azul inesperada.', 'sts', 0, 'weirdaniki7963'),
(1111, 'Invocación Mental', 25, 'Una técnica especial que trae fuerza de tiempos olvidados y traspasa defensas.', 'esp', 86, 'weirdaniki7963'),
(2111, 'Curación Total Impacto', 8, 'Un ataque físico que restaura todo, incluso la dignidad.', 'fis', 49, 'weirdaniki7963'),
(3111, 'Rebrote Impacto', 20, 'Un ataque físico que crece otra vez, más fuerte que nunca.', 'fis', 78, 'weirdaniki7963'),
(4111, 'Miasma Mental', 11, 'Una técnica especial que asfixia con vapores densos y traspasa defensas.', 'esp', 93, 'weirdaniki7963'),
(5111, 'Invocación Estratégico', 25, 'Una táctica de estado que trae fuerza de tiempos olvidados.', 'sts', 0, 'weirdaniki7963'),
(6111, 'Chispa Viral Impacto', 7, 'Un ataque físico que quema con ironía inflamable.', 'fis', 83, 'weirdaniki7963'),
(7111, 'Mirada Tierna Impacto', 18, 'Un ataque físico que hipnotiza con afecto digital.', 'fis', 66, 'weirdaniki7963'),
(8111, 'Golpe Moe Estratégico', 17, 'Una táctica de estado que es tan lindo que confunde.', 'sts', 0, 'weirdaniki7963'),
(9111, 'Invocación Impacto', 25, 'Un ataque físico que trae fuerza de tiempos olvidados.', 'fis', 59, 'weirdaniki7963'),
(11110, 'Bochorno Mental', 13, 'Una técnica especial que provoca vergüenza que daña el alma y traspasa defensas.', 'esp', 68, 'weirdaniki7963'),
(11111, 'Invocación Mental', 25, 'Una técnica especial que trae fuerza de tiempos olvidados y traspasa defensas.', 'esp', 47, 'weirdaniki7963'),
(11112, 'Crocante Estratégico', 21, 'Una táctica de estado que una onda caliente que lastima.', 'sts', 0, 'weirdaniki7963'),
(11113, 'Curación Total Impacto', 8, 'Un ataque físico que restaura todo, incluso la dignidad.', 'fis', 86, 'weirdaniki7963'),
(11114, 'Superposición Estratégico', 12, 'Una táctica de estado que actúa antes de ser observado.', 'sts', 0, 'weirdaniki7963'),
(11115, 'Golpe Moe Impacto', 17, 'Un ataque físico que es tan lindo que confunde.', 'fis', 73, 'weirdaniki7963'),
(11116, 'Fluorescencia Impacto', 23, 'Un ataque físico que destellos que distraen al enemigo.', 'fis', 70, 'weirdaniki7963'),
(11117, 'Golpe Moe Mental', 17, 'Una técnica especial que es tan lindo que confunde y traspasa defensas.', 'esp', 80, 'weirdaniki7963'),
(11118, 'Rebrote Impacto', 20, 'Un ataque físico que crece otra vez, más fuerte que nunca.', 'fis', 98, 'weirdaniki7963'),
(11119, 'Croac Explosivo Impacto', 22, 'Un ataque físico que onda sonora saltarina.', 'fis', 62, 'weirdaniki7963'),
(21110, 'Invocación Estratégico', 25, 'Una táctica de estado que trae fuerza de tiempos olvidados.', 'sts', 0, 'weirdaniki7963'),
(21111, 'Curación Total Impacto', 8, 'Un ataque físico que restaura todo, incluso la dignidad.', 'fis', 105, 'weirdaniki7963'),
(21112, 'Rebrote Estratégico', 20, 'Una táctica de estado que crece otra vez, más fuerte que nunca.', 'sts', 0, 'weirdaniki7963'),
(21113, 'Curación Total Impacto', 8, 'Un ataque físico que restaura todo, incluso la dignidad.', 'fis', 91, 'weirdaniki7963'),
(21114, 'Miasma Impacto', 11, 'Un ataque físico que asfixia con vapores densos.', 'fis', 69, 'weirdaniki7963'),
(21115, 'Superposición Mental', 12, 'Una técnica especial que actúa antes de ser observado y traspasa defensas.', 'esp', 115, 'weirdaniki7963');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moveset`
--

CREATE TABLE `moveset` (
  `id_moveset` int(5) NOT NULL,
  `id_creatura` int(10) NOT NULL,
  `id_habilidad` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `moveset`
--

INSERT INTO `moveset` (`id_moveset`, `id_creatura`, `id_habilidad`) VALUES
(1, 108, 81),
(2, 121, 80),
(3, 140, 43),
(4, 116, 18),
(5, 121, 28),
(6, 124, 86),
(7, 112, 91),
(8, 139, 65),
(9, 143, 66),
(10, 113, 3),
(11, 108, 51),
(12, 120, 22),
(13, 116, 36),
(14, 107, 14),
(15, 131, 93),
(16, 112, 16),
(17, 117, 61),
(18, 141, 53),
(19, 102, 40),
(20, 119, 93),
(21, 104, 79),
(22, 135, 56),
(23, 135, 43),
(24, 106, 58),
(25, 122, 86),
(26, 110, 60),
(27, 108, 19),
(28, 110, 70),
(29, 124, 64),
(30, 137, 80),
(31, 133, 67),
(32, 142, 61),
(33, 122, 59),
(34, 110, 58),
(35, 107, 8),
(36, 125, 22),
(37, 138, 76),
(38, 124, 32),
(39, 102, 14),
(40, 110, 38),
(41, 114, 33),
(42, 104, 26),
(43, 103, 57),
(44, 123, 70),
(45, 104, 32),
(46, 121, 44),
(47, 115, 41),
(48, 129, 13),
(49, 116, 59),
(50, 114, 55),
(51, 143, 1),
(52, 133, 86),
(53, 116, 47),
(54, 140, 55),
(55, 116, 31),
(56, 125, 96),
(57, 107, 37),
(58, 133, 56),
(59, 142, 22),
(60, 142, 87),
(61, 113, 43),
(62, 134, 59),
(63, 129, 11),
(64, 116, 79),
(65, 106, 78),
(66, 114, 84),
(67, 111, 45),
(68, 141, 62),
(69, 104, 8),
(70, 119, 33),
(71, 121, 66),
(72, 114, 73),
(73, 140, 16),
(74, 114, 75),
(75, 113, 100),
(76, 144, 70),
(77, 105, 52),
(78, 144, 75),
(79, 123, 27),
(80, 130, 1),
(81, 136, 41),
(82, 124, 1),
(83, 119, 85),
(84, 131, 51),
(85, 127, 27),
(86, 133, 79),
(87, 111, 39),
(88, 102, 64),
(89, 128, 5),
(90, 129, 8),
(91, 124, 5),
(92, 141, 63),
(93, 140, 34),
(94, 129, 92),
(95, 137, 59),
(96, 137, 69),
(97, 123, 91),
(98, 119, 48),
(99, 119, 69),
(100, 119, 63),
(101, 126, 18),
(102, 143, 91),
(103, 129, 3),
(104, 122, 67),
(105, 143, 70),
(106, 104, 45),
(107, 135, 52),
(108, 119, 88),
(109, 134, 16),
(110, 113, 38),
(111, 102, 11),
(112, 121, 14),
(113, 105, 42),
(114, 112, 21),
(115, 115, 7),
(116, 130, 2),
(117, 104, 67),
(118, 112, 4),
(119, 144, 8),
(120, 109, 4),
(121, 109, 98),
(122, 106, 52),
(123, 132, 66),
(124, 129, 65),
(125, 131, 59),
(126, 108, 58),
(127, 132, 27),
(128, 112, 83),
(129, 114, 5),
(130, 136, 12),
(131, 127, 34),
(132, 107, 38),
(133, 127, 25),
(134, 107, 66),
(135, 100, 22),
(136, 114, 37),
(137, 129, 14),
(138, 133, 25),
(139, 121, 5),
(140, 112, 51),
(141, 110, 99),
(142, 121, 43),
(143, 105, 96),
(144, 136, 37),
(145, 119, 47),
(146, 130, 79),
(147, 102, 24),
(148, 134, 10),
(149, 140, 20),
(150, 131, 18),
(151, 109, 88),
(152, 115, 90),
(153, 105, 84),
(154, 120, 79),
(155, 103, 45),
(156, 130, 85),
(157, 126, 38),
(158, 100, 97),
(159, 110, 17),
(160, 110, 13),
(161, 107, 49),
(162, 113, 66),
(163, 127, 82),
(164, 134, 39),
(165, 128, 18),
(166, 124, 25),
(167, 100, 16),
(168, 123, 37),
(169, 139, 95),
(170, 122, 22),
(171, 115, 36),
(172, 103, 84),
(173, 130, 71),
(174, 101, 46),
(175, 122, 91),
(176, 128, 41),
(177, 144, 30),
(178, 139, 62),
(179, 111, 7),
(180, 105, 39),
(181, 110, 97),
(182, 116, 84),
(183, 122, 31),
(184, 142, 12),
(185, 137, 78),
(186, 142, 86),
(187, 143, 38),
(188, 103, 96),
(189, 132, 4),
(190, 126, 58),
(191, 130, 65),
(192, 141, 86),
(193, 100, 64),
(194, 115, 80),
(195, 115, 4),
(196, 105, 36),
(197, 105, 1),
(198, 105, 49),
(199, 113, 59),
(200, 116, 49);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(5) NOT NULL,
  `nickname_usuario` varchar(30) NOT NULL,
  `id_creatura` int(10) NOT NULL,
  `estrellas` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rating`
--

INSERT INTO `rating` (`id_rating`, `nickname_usuario`, `id_creatura`, `estrellas`) VALUES
(1, 'Juansito', 10, 5),
(2, 'Juansito', 0, 5),
(3, 'Mr.Dr.Admin', 0, 2),
(4, 'Mr.Dr.Admin', 5, 1),
(5, 'xX_DoritoLord_Xx', 125, 1),
(6, 'PepeQuantum', 124, 2),
(7, 'PepeQuantum', 135, 4),
(8, 'PepeQuantum', 106, 5),
(9, 'PepeQuantum', 110, 2),
(10, 'PepeQuantum', 118, 1),
(11, '420BlazeIt69', 101, 3),
(12, '420BlazeIt69', 132, 4),
(13, '420BlazeIt69', 133, 3),
(14, '420BlazeIt69', 115, 5),
(15, '420BlazeIt69', 117, 1),
(16, 'UwUDestructor', 105, 5),
(17, 'UwUDestructor', 138, 4),
(18, 'UwUDestructor', 128, 3),
(19, 'UwUDestructor', 126, 1),
(20, 'UwUDestructor', 108, 3),
(21, 'MrBeefyToes', 136, 5),
(22, 'MrBeefyToes', 119, 2),
(23, 'MrBeefyToes', 143, 3),
(24, 'MrBeefyToes', 122, 4),
(25, 'MrBeefyToes', 116, 1),
(26, 'GigaShrek420', 130, 3),
(27, 'GigaShrek420', 109, 4),
(28, 'GigaShrek420', 103, 5),
(29, 'GigaShrek420', 123, 2),
(30, 'GigaShrek420', 120, 1),
(31, 'KeyboardGremlin', 139, 4),
(32, 'KeyboardGremlin', 141, 3),
(33, 'KeyboardGremlin', 121, 2),
(34, 'KeyboardGremlin', 112, 5),
(35, 'KeyboardGremlin', 134, 1),
(36, 'AnimeTank47', 102, 4),
(37, 'AnimeTank47', 127, 3),
(38, 'AnimeTank47', 111, 2),
(39, 'AnimeTank47', 142, 5),
(40, 'AnimeTank47', 114, 1),
(41, 'LordOfBread', 131, 4),
(42, 'LordOfBread', 104, 5),
(43, 'LordOfBread', 107, 2),
(44, 'LordOfBread', 144, 3),
(45, 'LordOfBread', 100, 1),
(46, 'Ghost_Memez', 142, 5),
(47, 'Ghost_Memez', 145, 3),
(48, 'Ghost_Memez', 138, 2),
(49, 'Ghost_Memez', 114, 4),
(50, 'Ghost_Memez', 109, 1),
(2222, 'xX_DoritoLord_Xx', 129, 4),
(3222, 'xX_DoritoLord_Xx', 137, 2),
(4222, 'xX_DoritoLord_Xx', 113, 4),
(5222, 'xX_DoritoLord_Xx', 125, 1),
(11111, 'xX_DoritoLord_Xx', 140, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo` int(5) NOT NULL,
  `nombre_tipo` varchar(15) NOT NULL,
  `color` varchar(6) NOT NULL,
  `icono` varchar(100) NOT NULL,
  `creador` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `nombre_tipo`, `color`, `icono`, `creador`) VALUES
(1, 'Planta', '23ed1a', '', 'Mr.Dr.Admin'),
(2, 'Fuego', 'ed1a1a', '', 'Mr.Dr.Admin'),
(3, 'Agua', '1a84ed', '', 'Mr.Dr.Admin'),
(4, 'Radiacion', '1bff00', '', 'Mr.Dr.Admin'),
(5, 'Juanchivo', 'c6d206', '', 'Juansito'),
(6, 'Puerta', '5a4e3c', '', 'WeirdAniki7963'),
(7, 'Memefuego', 'ff5722', '', 'PepeQuantum'),
(8, 'Panaceo', 'e3c281', '', 'LordOfBread'),
(9, 'Gremlin', '6f42c1', '', 'KeyboardGremlin'),
(10, 'Kawaiizilla', 'ff99cc', '', 'UwUDestructor'),
(11, 'Pantano', '556b2f', '', 'GigaShrek420'),
(12, 'Quantum', '00bcd4', '', 'PepeQuantum'),
(13, 'Cringe', 'b39ddb', '', 'AnimeTank47'),
(14, 'Fritura', 'ff9800', '', 'xX_DoritoLord_Xx'),
(15, 'Vaporwave', 'ff80ab', '', 'Ghost_Memez'),
(16, 'Toe', 'a1887f', '', 'MrBeefyToes'),
(17, 'Desu', 'f06292', '', 'UwUDestructor'),
(18, 'Waifu', 'ff4081', '', 'AnimeTank47'),
(19, 'Pantalla', '607d8b', '', 'KeyboardGremlin'),
(20, 'Brote', '8bc34a', '', 'WeirdAniki7963'),
(21, 'Tostado', '795548', '', 'LordOfBread'),
(22, 'Rana', '7cb342', '', 'PepeQuantum'),
(23, 'Neón', '00e5ff', '', 'Ghost_Memez'),
(24, 'Pantufla', 'aeea00', '', 'MrBeefyToes'),
(25, 'Ancestral', 'd4af37', '', 'WeirdAniki7963');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nickname` varchar(30) NOT NULL,
  `correo` varchar(35) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `biografia` varchar(200) NOT NULL,
  `contraseña` varchar(30) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nickname`, `correo`, `foto`, `biografia`, `contraseña`, `tipo`) VALUES
('420BlazeIt69', 'blaze@weedmail.com', 'blaze.png', 'Solo lucho en modo ultra instinto.', 'blzpwnd', 'basico'),
('AnimeTank47', 'tank@waifu.jp', 'tank.png', 'Mi waifu me da poder.', 'senpai47', 'basico'),
('Ghost_Memez', 'memez@void.lol', 'ghost.png', 'Estoy en todos lados y en ninguno.', 'memegeist', 'basico'),
('GigaShrek420', 'shrek@swamp.com', 'shrek.png', 'El pantano es mi dojo.', 'fion4ever', 'basico'),
('Juansito', 'perepupengue@gmail.com', '', 'Juansito el devorador de mundos.', '1234', 'Basico'),
('KeyboardGremlin', 'gremlin@chaos.net', 'gremlin.png', 'Te hackeo mientras duermes.', 'pwd1234', 'basico'),
('LordOfBread', 'bread@yeast.net', 'bread.png', 'Poder del pan ancestral.', 'crustylord', 'basico'),
('Mr.Dr.Admin', 'perepupengue@gmail.com', '', 'Ayuda', '1234', 'Admin'),
('MrBeefyToes', 'beef@meatmail.com', 'beef.png', 'El futuro es de los pies poderosos.', 'toepocalypse', 'basico'),
('PepeQuantum', 'pepe@frog.net', 'pepe.png', 'Vengo del multiverso de los memes.', 'rarep3p3', 'basico'),
('UwUDestructor', 'uwu@kawaii.org', 'uwu.png', 'No te dejes engañar por mi carita kawaii.', 'softb0y', 'basico'),
('WeirdAniki7963', 'the.aniki.way@gmail.com', 'aniki.png', 'Un viajero solitario que busca el equilibrio entre fuerza y sabiduría.', 'theonlyway', 'básico'),
('xX_DoritoLord_Xx', 'dorito@snack.net', 'dorito.png', 'Me alimento solo de fuego y memes.', 'nacho420', 'basico');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `creatura`
--
ALTER TABLE `creatura`
  ADD PRIMARY KEY (`id_creatura`);

--
-- Indices de la tabla `efectividades`
--
ALTER TABLE `efectividades`
  ADD PRIMARY KEY (`id_efectividad`);

--
-- Indices de la tabla `habilidad`
--
ALTER TABLE `habilidad`
  ADD PRIMARY KEY (`id_habilidad`);

--
-- Indices de la tabla `moveset`
--
ALTER TABLE `moveset`
  ADD PRIMARY KEY (`id_moveset`);

--
-- Indices de la tabla `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nickname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
