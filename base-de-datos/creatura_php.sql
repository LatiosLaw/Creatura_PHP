-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2025 a las 05:46:09
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
-- Base de datos: `creatura_php`
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
(1, 'Snorlax', 1, 0, 'Gigante dormilón con gran resistencia', 160, 110, 65, 65, 110, 30, 'SYSTEM', '', 1),
(2, 'Charizard', 2, 10, 'Dragón ígneo con alas imponentes', 78, 84, 78, 109, 85, 100, 'SYSTEM', '', 1),
(3, 'Blastoise', 3, 0, 'Tortuga con cañones de agua', 79, 83, 100, 85, 105, 78, 'SYSTEM', '', 1),
(4, 'Pikachu', 4, 0, 'Ratón eléctrico popular', 35, 55, 40, 50, 50, 90, 'SYSTEM', '', 1),
(5, 'Venusaur', 5, 8, 'Planta venenosa con flor dorsal', 80, 82, 83, 100, 100, 80, 'SYSTEM', '', 1),
(6, 'Glaceon', 6, 0, 'Evolución de Eevee tipo hielo', 65, 60, 110, 130, 95, 65, 'SYSTEM', '', 1),
(7, 'Machamp', 7, 0, 'Luchador musculoso con cuatro brazos', 90, 130, 80, 65, 85, 55, 'SYSTEM', '', 1),
(8, 'Nidoking', 8, 9, 'Rey venenoso con fuerza de tierra', 81, 102, 77, 85, 75, 85, 'SYSTEM', '', 1),
(9, 'Garchomp', 9, 15, 'Dragón de tierra letal', 108, 130, 95, 80, 85, 102, 'SYSTEM', '', 1),
(10, 'Togekiss', 10, 18, 'Ave hada que irradia paz', 85, 50, 95, 120, 115, 80, 'SYSTEM', '', 1),
(11, 'Alakazam', 11, 0, 'Psíquico brillante y veloz', 55, 50, 45, 135, 95, 120, 'SYSTEM', '', 1),
(12, 'Scyther', 12, 10, 'Insecto cortante con alas', 70, 110, 80, 55, 80, 105, 'SYSTEM', '', 1),
(13, 'Tyranitar', 13, 16, 'Bestia rocosa y oscura', 100, 134, 110, 95, 100, 61, 'SYSTEM', '', 1),
(14, 'Gengar', 14, 8, 'Fantasma juguetón y astuto', 60, 65, 60, 130, 75, 110, 'SYSTEM', '', 1),
(15, 'Dragonite', 15, 10, 'Dragón amable con gran poder', 91, 134, 95, 100, 100, 80, 'SYSTEM', '', 1),
(16, 'Umbreon', 16, 0, 'Eevee evolución sombría', 95, 65, 110, 60, 130, 65, 'SYSTEM', '', 1),
(17, 'Metagross', 17, 11, 'Supercomputadora metálica', 80, 135, 130, 95, 90, 70, 'SYSTEM', '', 1),
(18, 'Sylveon', 18, 0, 'Hada elegante con lazos', 95, 65, 65, 110, 130, 60, 'SYSTEM', '', 1),
(19, 'Infernape', 2, 7, 'Mono ardiente maestro del combate', 76, 104, 71, 104, 71, 108, 'SYSTEM', '', 1),
(20, 'Lucario', 7, 17, 'Aura metálica con estilo', 70, 110, 70, 115, 70, 90, 'SYSTEM', '', 1),
(21, 'Greninja', 3, 16, 'Ninja veloz tipo agua/siniestro', 72, 95, 67, 103, 71, 122, 'SYSTEM', '', 1),
(22, 'Decidueye', 5, 14, 'Arquero espectral planta/fantasma', 78, 107, 75, 100, 100, 70, 'SYSTEM', '', 1),
(23, 'Corviknight', 17, 10, 'Ave metálica caballeresca', 98, 87, 105, 53, 85, 67, 'SYSTEM', '', 1),
(24, 'Dragapult', 15, 14, 'Dragón fantasma ultra rápido', 88, 120, 75, 100, 75, 142, 'SYSTEM', '', 1),
(25, 'Toxtricity', 8, 4, 'Eléctrico punk tóxico', 75, 98, 70, 114, 70, 75, 'SYSTEM', '', 1),
(26, 'Gardevoir', 11, 18, 'Dama psíquica/fada elegante', 68, 65, 65, 125, 115, 80, 'SYSTEM', '', 1),
(27, 'Mamoswine', 9, 6, 'Mamífero glacial con colmillos', 110, 130, 80, 70, 60, 80, 'SYSTEM', '', 1),
(28, 'Hawlucha', 7, 10, 'Luchador volador acrobático', 78, 92, 75, 74, 63, 118, 'SYSTEM', '', 1),
(29, 'Aegislash', 17, 14, 'Espada fantasma que cambia forma', 60, 50, 150, 50, 150, 60, 'SYSTEM', '', 1),
(30, 'Roserade', 5, 8, 'Rosa venenosa encantadora', 60, 70, 65, 125, 105, 90, 'SYSTEM', '', 1),
(31, 'Waifumancer', 21, 11, 'Hechicero otaku de una realidad alternativa', 70, 50, 80, 130, 80, 69, 'WeirdAniki', 'waifumancer.png', 1),
(32, 'Ninomae Inanis', 20, 21, 'Sacerdotisa recipiente del poder de los antiguos', 60, 70, 60, 155, 150, 30, 'LatiosLaw', 'ina.png', 1),
(33, 'A. Watson', 21, 24, 'Protectora de las lineas temporales', 90, 100, 75, 110, 90, 105, 'Amee', 'watson.png', 1),
(34, 'El Portadoor', 7, 22, 'El macho mas macho de los machos', 90, 130, 100, 40, 100, 60, 'WeirdAniki', 'portadoor.png', 1),
(35, 'Lagarto de Magma', 23, 2, 'Criatura infernal capaz de generar charcos de lava y disparar roca volcanica', 110, 90, 140, 100, 70, 60, 'The Silent One', 'magmamonster.png', 1),
(36, 'Acido Viviente', 23, 8, 'Monstruo de slime acidico', 120, 40, 40, 80, 170, 20, 'The Silent One', 'slime.png', 1),
(37, 'Nanashi Mumei', 21, 23, 'Representante de la humanidad... Con todo lo que conlleva.', 70, 130, 60, 130, 70, 90, 'Amee', 'mumei.png', 1);
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
(1, 1, 13, 0.5),
(2, 1, 14, 0.0),
(3, 1, 17, 0.5),
(4, 2, 5, 2),
(5, 2, 6, 2),
(6, 2, 12, 2),
(7, 2, 17, 2),
(8, 2, 2, 0.5),
(9, 2, 3, 0.5),
(10, 2, 13, 0.5),
(11, 2, 15, 0.5),
(12, 3, 2, 2),
(13, 3, 13, 2),
(14, 3, 9, 2),
(15, 3, 3, 0.5),
(16, 3, 5, 0.5),
(17, 3, 15, 0.5),
(18, 4, 3, 2),
(19, 4, 10, 2),
(20, 4, 4, 0.5),
(21, 4, 5, 0.5),
(22, 4, 15, 0.5),
(23, 4, 9, 0.0),
(24, 5, 3, 2),
(25, 5, 9, 2),
(26, 5, 13, 2),
(27, 5, 2, 0.5),
(28, 5, 5, 0.5),
(29, 5, 12, 0.5),
(30, 5, 10, 0.5),
(31, 5, 8, 0.5),
(32, 5, 17, 0.5),
(33, 5, 15, 0.5),
(34, 6, 5, 2),
(35, 6, 9, 2),
(36, 6, 10, 2),
(37, 6, 15, 2),
(38, 6, 2, 0.5),
(39, 6, 3, 0.5),
(40, 6, 6, 0.5),
(41, 6, 17, 0.5),
(42, 7, 1, 2),
(43, 7, 6, 2),
(44, 7, 13, 2),
(45, 7, 16, 2),
(46, 7, 17, 2),
(47, 7, 8, 0.5),
(48, 7, 10, 0.5),
(49, 7, 11, 0.5),
(50, 7, 12, 0.5),
(51, 7, 14, 0.0),
(52, 7, 18, 0.5),
(53, 8, 5, 2),
(54, 8, 18, 2),
(55, 8, 8, 0.5),
(56, 8, 9, 0.5),
(57, 8, 13, 0.5),
(58, 8, 14, 0.5),
(59, 8, 17, 0.0),
(60, 9, 2, 2),
(61, 9, 4, 2),
(62, 9, 8, 2),
(63, 9, 13, 2),
(64, 9, 17, 2),
(65, 9, 5, 0.5),
(66, 9, 12, 0.5),
(67, 9, 10, 0.0),
(68, 10, 5, 2),
(69, 10, 7, 2),
(70, 10, 12, 2),
(71, 10, 4, 0.5),
(72, 10, 13, 0.5),
(73, 10, 17, 0.5),
(74, 11, 7, 2),
(75, 11, 8, 2),
(76, 11, 11, 0.5),
(77, 11, 17, 0.5),
(78, 11, 16, 0.0),
(79, 12, 5, 2),
(80, 12, 11, 2),
(81, 12, 16, 2),
(82, 12, 2, 0.5),
(83, 12, 7, 0.5),
(84, 12, 8, 0.5),
(85, 12, 10, 0.5),
(86, 12, 14, 0.5),
(87, 12, 17, 0.5),
(88, 12, 18, 0.5),
(89, 13, 2, 2),
(90, 13, 6, 2),
(91, 13, 10, 2),
(92, 13, 12, 2),
(93, 13, 7, 0.5),
(94, 13, 9, 0.5),
(95, 13, 17, 0.5),
(96, 14, 14, 2),
(97, 14, 11, 2),
(98, 14, 16, 0.5),
(99, 14, 1, 0.0),
(100, 15, 15, 2),
(101, 15, 17, 0.5),
(102, 15, 18, 0.0),
(103, 16, 11, 2),
(104, 16, 14, 2),
(105, 16, 7, 0.5),
(106, 16, 16, 0.5),
(107, 16, 18, 0.5),
(108, 17, 6, 2),
(109, 17, 13, 2),
(110, 17, 18, 2),
(111, 17, 2, 0.5),
(112, 17, 3, 0.5),
(113, 17, 4, 0.5),
(114, 17, 17, 0.5),
(115, 18, 7, 2),
(116, 18, 15, 2),
(117, 18, 16, 2),
(118, 18, 2, 0.5),
(119, 18, 8, 0.5),
(120, 18, 17, 0.5),
(121, 1, 20, 0),
(122, 2, 20, 0.5),
(123, 3, 20, 0.5),
(124, 7, 20, 0.5),
(125, 11, 20, 0.5),
(126, 21, 20, 2),
(127, 20, 20, 2),
(128, 12, 21, 2),
(129, 13, 21, 2),
(130, 23, 21, 2),
(131, 18, 21, 0.5),
(132, 12, 22, 0.5),
(133, 13, 22, 0.5),
(134, 15, 22, 2),
(135, 7, 22, 2),
(136, 6, 22, 0.5),
(137, 11, 22, 0.5),
(138, 1, 22, 0.5),
(139, 16, 22, 2),
(140, 7, 23, 2),
(141, 23, 23, 2),
(142, 17, 23, 2),
(143, 8, 23, 0.5),
(144, 2, 23, 0.5),
(145, 6, 23, 0.5),
(146, 15, 23, 0.5),
(147, 11, 23, 2),
(148, 11, 24, 2),
(149, 20, 24, 0.5),
(150, 1, 24, 0),
(151, 7, 24, 0),
(152, 24, 24, 0),
(153, 2, 24, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidad`
--

CREATE TABLE `habilidad` (
  `id_habilidad` int(5) NOT NULL,
  `nombre_habilidad` varchar(30) NOT NULL,
  `id_tipo_habilidad` int(5) NOT NULL COMMENT 'A que tipo pertenece esta habilidad',
  `descripcion` varchar(200) NOT NULL,
  `categoria_habilidad` varchar(10) NOT NULL COMMENT 'Ataque físico, ataque especial o habilidad de estado',
  `potencia` int(5) NOT NULL,
  `creador` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habilidad`
--

INSERT INTO `habilidad` (`id_habilidad`, `nombre_habilidad`, `id_tipo_habilidad`, `descripcion`, `categoria_habilidad`, `potencia`, `creador`) VALUES
-- Tipo Normal (1)
(69, 'Puño Cometa', 1, 'Pega de dos a cinco veces seguidas.', 'FISICO', 18, 'SYSTEM'),
(70, 'Guillotina', 1, 'Ataque cortante con grandes pinzas que fulmina al objetivo de un solo golpe si acierta.', 'FISICO', 0, 'SYSTEM'),
(71, 'Danza Espada', 1, 'Este frenético baile de combate eleva el espíritu y aumenta mucho el Ataque.', 'ESTADO', 0, 'SYSTEM'),
(72, 'Triataque', 1, 'Ataque con tres rayos de luz que puede paralizar, quemar o congelar al objetivo.', 'ESPECIAL', 80, 'SYSTEM'),

-- Tipo Fuego (2)
(1, 'Lanzallamas', 2, 'Lanza llamas que puede quemar al objetivo.', 'ESPECIAL', 90, 'SYSTEM'),
(2, 'Envite Ígneo', 2, 'Se envuelve en fuego y carga contra el rival, recibiendo retroceso.', 'FISICO', 120, 'SYSTEM'),
(3, 'Sobrecalentamiento', 2, 'Potente ataque especial que reduce el Ataque Especial del usuario.', 'ESPECIAL', 130, 'SYSTEM'),
(4, 'Onda Ígnea', 2, 'Genera una ola de calor que puede quemar al rival.', 'ESPECIAL', 95, 'SYSTEM'),

-- Tipo Agua (3)
(9, 'Surf', 3, 'Crea una gran ola que golpea a todos en campo.', 'ESPECIAL', 90, 'SYSTEM'),
(10, 'Hidrobomba', 3, 'Poderoso chorro de agua.', 'ESPECIAL', 110, 'SYSTEM'),
(11, 'Cola de Agua', 3, 'Azote con la cola que puede causar daño.', 'FISICO', 90, 'SYSTEM'),
(12, 'Escaldar', 3, 'Agua hirviendo que puede quemar.', 'ESPECIAL', 80, 'SYSTEM'),

-- Tipo Eléctrico (4)
(5, 'Rayo', 4, 'Un potente rayo que puede paralizar al objetivo.', 'ESPECIAL', 90, 'SYSTEM'),
(6, 'Trueno', 4, 'Un rayo muy fuerte que paraliza, pero es impreciso.', 'ESPECIAL', 110, 'SYSTEM'),
(7, 'Placaje Eléctrico', 4, 'Se envuelve en electricidad y embiste con retroceso.', 'FISICO', 120, 'SYSTEM'),
(8, 'Onda Trueno', 4, 'Rayo de voltaje que puede paralizar, sin daño directo fuerte.', 'ESTADO', 0, 'SYSTEM'),

-- Tipo Planta (5)
(13, 'Hoja Afilada', 5, 'Hoja afilada con alta probabilidad de crítico.', 'FISICO', 90, 'SYSTEM'),
(14, 'Rayo Solar', 5, 'Ataque que requiere esperar un turno y concentra energía solar.', 'ESPECIAL', 120, 'SYSTEM'),
(15, 'Gigadrenadoras', 5, 'Extrae energía, curando al usuario.', 'ESPECIAL', 75, 'SYSTEM'),
(16, 'Drenadoras', 5, 'Siembra semillas que drenan vida cada turno.', 'ESTADO', 0, 'SYSTEM'),

-- Tipo Hielo (6)
(17, 'Rayo Hielo', 6, 'Rayo congelante que puede congelar al objetivo', 'ESPECIAL', 90, 'SYSTEM'),
(18, 'Ventisca', 6, 'Tormenta de hielo que puede congelar a todos', 'ESPECIAL', 110, 'SYSTEM'),
(19, 'Bola Hielo', 6, 'El atacante rueda contra el objetivo durante cinco turnos, cada vez con mayor fuerza.', 'FISICO', 30, 'SYSTEM'),
(20, 'Esquirla Helada', 6, 'Crea esquirlas de hielo y las lanza a gran velocidad. Este movimiento tiene prioridad alta.', 'FISICO', 40, 'SYSTEM'),

-- Tipo Lucha (7)
(21, 'Espada Santa', 7, 'El usuario ataca con una espada, ignorando cualquier cambio en las características del objetivo.', 'FISICO', 90, 'SYSTEM'),
(22, 'Puño Dinámico', 7, 'Puñetazo que confunde si golpea', 'FISICO', 100, 'SYSTEM'),
(23, 'A Bocajarro', 7, 'Ataque contundente que disminuye las defensas del usuario', 'FISICO', 120, 'SYSTEM'),
(24, 'Onda Certera', 7, 'Agudiza la concentración mental y libera su poder. Puede reducir la Defensa Especial del objetivo.', 'ESPECIAL', 120, 'SYSTEM'),

-- Tipo Veneno (8)
(25, 'Bomba Lodo', 8, 'Lanza lodo tóxico al objetivo. Puede envenenar.', 'ESPECIAL', 90, 'SYSTEM'),
(26, 'Puya Nociva', 8, 'Ataca con un pincho venenoso. Puede envenenar al objetivo.', 'FISICO', 80, 'SYSTEM'),
(27, 'Tóxico', 8, 'Envenena gravemente al objetivo. El daño aumenta cada turno.', 'ESTADO', 0, 'SYSTEM'),
(28, 'Ácido', 8, 'Rocía con un líquido corrosivo. Puede reducir la Defensa Especial.', 'ESPECIAL', 40, 'SYSTEM'),

-- Tipo Tierra (9)
(29, 'Terremoto', 9, 'Un potente temblor que afecta a todos los Pokémon alrededor.', 'FISICO', 100, 'SYSTEM'),
(30, 'Tierra Viva', 9, 'Lanza una onda de poder terrestre que puede bajar la Defensa Especial.', 'ESPECIAL', 90, 'SYSTEM'),
(31, 'Excavar', 9, 'Un ataque de dos turnos: el primero cava un túnel, el segundo ataca.', 'FISICO', 80, 'SYSTEM'),
(32, 'Fuerza Telúrica', 9, 'Sacude el suelo bajo el rival con un ataque especial.', 'ESPECIAL', 90, 'SYSTEM'),

-- Tipo Volador (10)
(33, 'Ataque Ala', 10, 'El enemigo recibe un golpe con unas alas afiladas.', 'FISICO', 60, 'SYSTEM'),
(34, 'Pico Taladro', 10, 'Ataca al objetivo girando como un taladro. Nunca falla.', 'FISICO', 80, 'SYSTEM'),
(35, 'Golpe Aéreo', 10, 'Ataca con un golpe que no puede fallar.', 'FISICO', 60, 'SYSTEM'),
(36, 'Vendaval', 10, 'Crea un vendaval que puede confundir al objetivo.', 'ESPECIAL', 110, 'SYSTEM'),

-- Tipo Psíquico (11)
(37, 'Psíquico', 11, 'Lanza energía psíquica que puede bajar la Defensa Esp.', 'ESPECIAL', 90, 'SYSTEM'),
(38, 'Psicoataque', 11, 'Un ataque mental que también daña físicamente.', 'FISICO', 100, 'SYSTEM'),
(39, 'Confusión', 11, 'Un ataque psíquico que puede confundir al rival.', 'ESPECIAL', 50, 'SYSTEM'),
(40, 'Premonición', 11, 'Un ataque que golpea dos turnos después de usarse.', 'ESPECIAL', 120, 'SYSTEM'),

-- Tipo Bicho (12)
(41, 'Picadura', 12, 'Pica con una aguja. Si roba una baya, la usa.', 'FISICO', 60, 'SYSTEM'),
(42, 'Danza Aleteo', 12, 'Incrementa Velocidad, Defensa y Ataque Especial.', 'ESTADO', 0, 'SYSTEM'),
(43, 'Tijera X', 12, 'Ataca con unas afiladas guadañas en cruz.', 'FISICO', 80, 'SYSTEM'),
(44, 'Zumbido', 12, 'Emite un zumbido que puede bajar la Defensa Esp.', 'ESPECIAL', 90, 'SYSTEM'),

-- Tipo Roca (13)
(45, 'Lanzarrocas', 13, 'Lanza pequeñas piedras para dañar.', 'FISICO', 50, 'SYSTEM'),
(46, 'Avalancha', 13, 'Derrumba rocas sobre el enemigo. Puede hacerlo retroceder.', 'FISICO', 75, 'SYSTEM'),
(47, 'Roca Afilada', 13, 'Lanza rocas con alta probabilidad de golpe crítico.', 'FISICO', 100, 'SYSTEM'),
(48, 'Poder Pasado', 13, 'Un ataque que puede subir todas las estadísticas.', 'ESPECIAL', 60, 'SYSTEM'),

-- Tipo Fantasma (14)
(49, 'Bola Sombra', 14, 'Lanza una bola de energía que puede bajar la Defensa Esp.', 'ESPECIAL', 80, 'SYSTEM'),
(50, 'Garra Umbría', 14, 'Ataca con una garra oscura. Alta probabilidad de crítico.', 'FISICO', 70, 'SYSTEM'),
(51, 'Tinieblas', 14, 'Causa daño igual al nivel del usuario.', 'ESPECIAL', 0, 'SYSTEM'),
(52, 'Sombra Vil', 14, 'Ataca primero si el objetivo no está usando prioridad.', 'FISICO', 40, 'SYSTEM'),

-- Tipo Dragón (15)
(53, 'Garra Dragón', 15, 'Ataca con garras afiladas.', 'FISICO', 80, 'SYSTEM'),
(54, 'Pulso Dragón', 15, 'Lanza un pulso de energía dracónica.', 'ESPECIAL', 85, 'SYSTEM'),
(55, 'Cometa Draco', 15, 'Ataque muy potente que baja el At. Esp. tras usarlo.', 'ESPECIAL', 130, 'SYSTEM'),
(56, 'Dragoaliento', 15, 'Aliento de dragón que puede paralizar.', 'ESPECIAL', 60, 'SYSTEM'),

-- Tipo Siniestro (16)
(57, 'Pulso Umbrío', 16, 'Un pulso oscuro que puede hacer retroceder.', 'ESPECIAL', 80, 'SYSTEM'),
(58, 'Triturar', 16, 'Muerde con fuerza. Puede bajar la Defensa.', 'FISICO', 80, 'SYSTEM'),
(59, 'Mordisco', 16, 'Muerde al objetivo. Puede hacerlo retroceder.', 'FISICO', 60, 'SYSTEM'),
(60, 'Juego Sucio', 16, 'Usa el Ataque del enemigo para calcular el daño.', 'FISICO', 95, 'SYSTEM'),

-- Tipo Acero (17)
(61, 'Cabeza de Hierro', 17, 'Un cabezazo que puede hacer retroceder.', 'FISICO', 80, 'SYSTEM'),
(62, 'Cañón Destello', 17, 'Dispara un rayo de metal. Puede bajar la Def. Esp.', 'ESPECIAL', 80, 'SYSTEM'),
(63, 'Puño Bala', 17, 'Un ataque muy rápido. Siempre ataca primero.', 'FISICO', 40, 'SYSTEM'),
(64, 'Giro Bola', 17, 'Más lento es el usuario, más fuerte será el ataque.', 'FISICO', 0, 'SYSTEM'),

-- Tipo Hada (18)
(65, 'Fuerza Lunar', 18, 'Luz lunar que puede bajar la Defensa Esp.', 'ESPECIAL', 95, 'SYSTEM'),
(66, 'Destello Mágico', 18, 'Brilla intensamente para dañar al rival.', 'ESPECIAL', 80, 'SYSTEM'),
(67, 'Carantoña', 18, 'Ataca dulcemente al rival. Puede bajar el Ataque.', 'FISICO', 90, 'SYSTEM'),
(68, 'Voz Cautivadora', 18, 'Un canto encantador que nunca falla.', 'ESPECIAL', 40, 'SYSTEM'),

-- Tipo Inanis (20)
(73, 'Ráfaga Eldritch', 20, 'El usuario libera de golpe el poder de los antiguos, causando mucho daño y reduciendo la precision del rival. Este ataque no puede ser usado 2 turnos consecutivos.', 'ESPECIAL', 180, 'LatiosLaw'),
(74, 'Wah Wah Wah!', 20, 'El usuario recita repetidamente una frase ancestral, recuperando 35% de su HP y curando 20% de la HP de todos sus compañeros de equipo.', 'ESTADO', 0, 'LatiosLaw'),
(75, 'Raging Tako Punch', 20, 'Ataca al rival con un puñetazo de magia ancestral, causando ternura y confundiendo al rival.', 'FISICO', 30, 'LatiosLaw'),
(76, 'Bonk', 20, 'Golpea la cabeza del rival con una palanca de metal. Ignora Proteccion.', 'FISICO', 100, 'LatiosLaw'),

-- Tipo Waifu (21)
(77, 'Caricias', 21, 'Acaricia con cariño al rival, enamorandolo en caso de que el rival pertenezca al género masculino.', 'ESTADO', 0, 'Amee'),
(78, 'Kira Kira Beam!', 21, 'Dispara un rayo de luz hacia el rival, causando daño y generando una cantidad desproporcionada de particulas brillantes.', 'ESPECIAL', 100, 'Amee'),
(79, 'Waifu Slap', 21, 'Golpea al rival con un fuerte cachetazo, contando con un 50% de hacerlo retroceder.', 'FISICO', 60, 'Amee'),
(80, 'Happy Ending', 21, 'El usuario se casa con el rival, duplicando todas sus estadisticas pero impidiendo que el mismo escape del campo de batalla hasta que su pareja se retire.', 'ESTADO', 0, 'Amee'),

-- Tipo Puerta (22)
(81, 'Bajo Candado', 22, 'El usuario bloquea el camino, impidiendo a todo oponente salir del campo hasta que el se retire.', 'ESTADO', 0, 'WeirdAniki'),
(82, 'Puerta al Pasado', 22, 'El usuario abre una puerta en la cabeza del rival, haciendolo viajar por su pasado, causando daño emocional.', 'ESPECIAL', 80, 'WeirdAniki'),
(83, 'Bisagras Pedorras', 22, 'El usuario chirria como esas bisagras que están hechas percha, despertando a todo pokemon en el campo de batalla.', 'ESTADO', 0, 'WeirdAniki'),
(84, 'Santo Portazo', 22, 'El usuario golpea al rival con todo su cuerpo, haciendolo retroceder. Este ataque ataca primero y solo puede ser usado el primer turno.', 'FISICO', 120, 'WeirdAniki'),

-- Tipo Monstruo (23)
(85, 'Masacre', 23, 'Destroza violentamente al rival, causando mucho daño.', 'FISICO', 130, 'The Silent One'),
(86, 'Rugido Bestial', 23, 'El usuario ruge, intimidando profundamente a todo rival en el campo y reduciendo su Ataque Fisico y Especial.', 'ESTADO', 0, 'The Silent One'),
(87, 'Laceraalmas', 23, 'El usuario hace contacto con el alma del rival y la lacera, causando daño especial.', 'FISICO', 90, 'The Silent One'),
(88, 'Adrenalina Vasta', 23, 'El usuario entra en un estado de furia, perdiendo 75% de su HP, pero incrementando su Velocidad y maximizando su Ataque Fisico.', 'ESTADO', 0, 'The Silent One'),

-- Tipo Tiempo (24)
(89, 'Time Travel', 24, 'Regresa en el tiempo, regresando al mismo estado que hace 5 turnos. Este ataque solo puede ser usado una vez por combate.', 'ESTADO', 0, 'Amee'),
(90, 'Bucle Temporal', 24, 'Golpea al rival y lo mete en un bucle temporal, obligandolo a usar el mismo ataque que el turno anterior.', 'FISICO', 65, 'Amee'),
(91, 'Fisura Relativa', 24, 'El usuario golpea al rival, aislandolo de la linea de tiempo, impidiendo que ataque durante los proximos 2 turnos.', 'FISICO', 90, 'Amee'),
(92, 'Minutos Contados', 24, 'El usuario empieza una cuenta regresiva de 3 turnosm al finalizar, aquel afectado se debilita. El pokemon mas lento en el campo no podrá cambiar.', 'ESTADO', 0, 'Amee');
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
-- Volcado de datos para la tabla `habilidad`
--

INSERT INTO `moveset` (`id_moveset`, `id_creatura`, `id_habilidad`) VALUES
-- Snorlax (Normal)
(1, 1, 69), (2, 1, 70), (3, 1, 72),
-- Charizard (Fuego/Volador)
(4, 2, 1), (5, 2, 2), (6, 2, 36),
-- Blastoise (Agua)
(7, 3, 9), (8, 3, 10), (9, 3, 11),
-- Pikachu (Eléctrico)
(10, 4, 5), (11, 4, 6), (12, 4, 7),
-- Venusaur (Planta/Veneno)
(13, 5, 13), (14, 5, 14), (15, 5, 27),
-- Glaceon (Hielo)
(16, 6, 17), (17, 6, 18), (18, 6, 20),
-- Machamp (Lucha)
(19, 7, 21), (20, 7, 22), (21, 7, 23),
-- Nidoking (Veneno/Tierra)
(22, 8, 25), (23, 8, 29), (24, 8, 31),
-- Garchomp (Dragón/Tierra)
(25, 9, 53), (26, 9, 54), (27, 9, 29),
-- Togekiss (Volador/Hada)
(28, 10, 36), (29, 10, 65), (30, 10, 66),
-- Alakazam (Psíquico)
(31, 11, 37), (32, 11, 38), (33, 11, 40),
-- Scyther (Bicho/Volador)
(34, 12, 41), (35, 12, 43), (36, 12, 33),
-- Tyranitar (Roca/Siniestro)
(37, 13, 45), (38, 13, 47), (39, 13, 57),
-- Gengar (Fantasma/Veneno)
(40, 14, 49), (41, 14, 50), (42, 14, 25),
-- Dragonite (Dragón/Volador)
(43, 15, 53), (44, 15, 54), (45, 15, 36),
-- Umbreon (Siniestro)
(46, 16, 57), (47, 16, 58), (48, 16, 59),
-- Metagross (Acero/Psíquico)
(49, 17, 61), (50, 17, 62), (51, 17, 37),
-- Sylveon (Hada)
(52, 18, 65), (53, 18, 66), (54, 18, 67),
-- Infernape (Fuego/Lucha)
(55, 19, 1), (56, 19, 21), (57, 19, 24),
-- Lucario (Lucha/Acero)
(58, 20, 21), (59, 20, 61), (60, 20, 24),
-- Greninja (Agua/Siniestro)
(61, 21, 9), (62, 21, 57), (63, 21, 58),
-- Decidueye (Planta/Fantasma)
(64, 22, 13), (65, 22, 49), (66, 22, 50),
-- Corviknight (Acero/Volador)
(67, 23, 61), (68, 23, 33), (69, 23, 34),
-- Dragapult (Dragón/Fantasma)
(70, 24, 53), (71, 24, 49), (72, 24, 55),
-- Toxtricity (Eléctrico/Veneno)
(73, 25, 5), (74, 25, 25), (75, 25, 27),
-- Gardevoir (Psíquico/Hada)
(76, 26, 37), (77, 26, 65), (78, 26, 66),
-- Mamoswine (Hielo/Tierra)
(79, 27, 17), (80, 27, 29), (81, 27, 19),
-- Hawlucha (Lucha/Volador)
(82, 28, 21), (83, 28, 33), (84, 28, 34),
-- Aegislash (Acero/Fantasma)
(85, 29, 61), (86, 29, 49), (87, 29, 50),
-- Roserade (Planta/Veneno)
(88, 30, 13), (89, 30, 25), (90, 30, 27),

-- Waifumancer (Waifu/Psiquico)
(91, 31, 37), (92, 31, 65), (93, 31, 66), (117, 31, 78), (118, 31, 72),

-- Ninomae Inanis (Inanis/Waifu)
(94, 32, 40), (95, 32, 73), (96, 32, 77), (112, 32, 74), (113, 32, 75), (114, 32, 76),

-- A. Watson (Tiempo/Waifu)
(97, 33, 89), (98, 33, 92), (99, 33, 40),

-- Portadoor (Lucha/Puerta)
(100, 34, 23), (101, 34, 81), (102, 34, 84),

-- Lagarto Magma (Monstruo/Fuego)
(103, 35, 1), (104, 35, 3), (105, 35, 47), (115, 35, 53), (116, 35, 86),

-- Slime (Monstruo/Agua)
(106, 36, 12), (107, 36, 28), (108, 36, 87),

-- Mumei (Monstruo/Waifu)
(109, 37, 79), (110, 37, 88), (111, 37, 52), (119, 37, 70), (120, 37, 85);

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
-- The Silent One's ratings
(1, 'The Silent One', 1, 4.0),
(2, 'The Silent One', 2, 4.5),
(3, 'The Silent One', 3, 3.5),
(4, 'The Silent One', 4, 5.0),
(5, 'The Silent One', 5, 3.0),
(6, 'The Silent One', 6, 4.0),
(7, 'The Silent One', 7, 4.5),
(8, 'The Silent One', 8, 3.5),
(9, 'The Silent One', 9, 5.0),
(10, 'The Silent One', 10, 4.0),
(11, 'The Silent One', 11, 4.5),
(12, 'The Silent One', 12, 3.0),
(13, 'The Silent One', 13, 5.0),
(14, 'The Silent One', 14, 4.5),
(15, 'The Silent One', 15, 4.0),
(16, 'The Silent One', 16, 3.5),
(17, 'The Silent One', 17, 5.0),
(18, 'The Silent One', 18, 4.0),
(19, 'The Silent One', 19, 4.5),
(20, 'The Silent One', 20, 3.5),
(21, 'The Silent One', 21, 5.0),
(22, 'The Silent One', 22, 4.0),
(23, 'The Silent One', 23, 3.0),
(24, 'The Silent One', 24, 5.0),
(25, 'The Silent One', 25, 4.5),
(26, 'The Silent One', 26, 4.0),
(27, 'The Silent One', 27, 3.5),
(28, 'The Silent One', 28, 5.0),
(29, 'The Silent One', 29, 4.0),
(30, 'The Silent One', 30, 4.5),

-- Amee's ratings
(31, 'Amee', 1, 3.5),
(32, 'Amee', 2, 5.0),
(33, 'Amee', 3, 4.0),
(34, 'Amee', 4, 4.5),
(35, 'Amee', 5, 3.0),
(36, 'Amee', 6, 5.0),
(37, 'Amee', 7, 4.0),
(38, 'Amee', 8, 3.5),
(39, 'Amee', 9, 4.5),
(40, 'Amee', 10, 5.0),
(41, 'Amee', 11, 4.0),
(42, 'Amee', 12, 3.5),
(43, 'Amee', 13, 4.5),
(44, 'Amee', 14, 5.0),
(45, 'Amee', 15, 4.0),
(46, 'Amee', 16, 3.5),
(47, 'Amee', 17, 5.0),
(48, 'Amee', 18, 4.5),
(49, 'Amee', 19, 4.0),
(50, 'Amee', 20, 3.5),
(51, 'Amee', 21, 5.0),
(52, 'Amee', 22, 4.0),
(53, 'Amee', 23, 3.0),
(54, 'Amee', 24, 5.0),
(55, 'Amee', 25, 4.5),
(56, 'Amee', 26, 4.0),
(57, 'Amee', 27, 3.5),
(58, 'Amee', 28, 5.0),
(59, 'Amee', 29, 4.0),
(60, 'Amee', 30, 4.5),

-- WeirdAniki's ratings
(61, 'WeirdAniki', 1, 5.0),
(62, 'WeirdAniki', 2, 4.0),
(63, 'WeirdAniki', 3, 5.0),
(64, 'WeirdAniki', 4, 3.5),
(65, 'WeirdAniki', 5, 4.5),
(66, 'WeirdAniki', 6, 3.0),
(67, 'WeirdAniki', 7, 5.0),
(68, 'WeirdAniki', 8, 4.0),
(69, 'WeirdAniki', 9, 4.5),
(70, 'WeirdAniki', 10, 3.5),
(71, 'WeirdAniki', 11, 5.0),
(72, 'WeirdAniki', 12, 4.0),
(73, 'WeirdAniki', 13, 4.5),
(74, 'WeirdAniki', 14, 5.0),
(75, 'WeirdAniki', 15, 3.5),
(76, 'WeirdAniki', 16, 4.0),
(77, 'WeirdAniki', 17, 5.0),
(78, 'WeirdAniki', 18, 4.5),
(79, 'WeirdAniki', 19, 4.0),
(80, 'WeirdAniki', 20, 3.5),
(81, 'WeirdAniki', 21, 5.0),
(82, 'WeirdAniki', 22, 4.0),
(83, 'WeirdAniki', 23, 3.0),
(84, 'WeirdAniki', 24, 5.0),
(85, 'WeirdAniki', 25, 4.5),
(86, 'WeirdAniki', 26, 4.0),
(87, 'WeirdAniki', 27, 3.5),
(88, 'WeirdAniki', 28, 5.0),
(89, 'WeirdAniki', 29, 4.0),
(90, 'WeirdAniki', 30, 4.5),

(91, 'LatiosLaw', 31, 4),
(92, 'LatiosLaw', 37, 4),
(93, 'LatiosLaw', 33, 4.5),
(94, 'LatiosLaw', 34, 5),
(95, 'LatiosLaw', 35, 3),
(96, 'LatiosLaw', 36, 1.5),
(97, 'Amee', 32, 5),
(98, 'Amee', 35, 4),
(99, 'Amee', 36, 3),
(100, 'Amee', 34, 4.5);

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
(1, 'Normal','A8A878', 'normal.png', 'SYSTEM'),
(2, 'Fuego','F08030', 'fuego.png', 'SYSTEM'),
(3, 'Agua', '6890F0', 'agua.png', 'SYSTEM'),
(4, 'Eléctrico',  'F8D030', 'electrico.png', 'SYSTEM'),
(5, 'Planta','78C850', 'planta.png', 'SYSTEM'),
(6, 'Hielo','98D8D8', 'hielo.png', 'SYSTEM'),
(7, 'Lucha','C03028', 'lucha.png', 'SYSTEM'),
(8, 'Veneno','A040A0', 'veneno.png', 'SYSTEM'),
(9, 'Tierra','E0C068', 'tierra.png', 'SYSTEM'),
(10, 'Volador',   'A890F0', 'volador.png', 'SYSTEM'),
(11, 'Psíquico',  'F85888', 'psiquico.png', 'SYSTEM'),
(12, 'Bicho','A8B820', 'bicho.png', 'SYSTEM'),
(13, 'Roca','B8A038', 'roca.png', 'SYSTEM'),
(14, 'Fantasma',  '705898', 'fantasma.png', 'SYSTEM'),
(15, 'Dragón',    '7038F8', 'dragon.png', 'SYSTEM'),
(16, 'Siniestro', '705848', 'siniestro.png', 'SYSTEM'),
(17, 'Acero','B8B8D0', 'acero.png', 'SYSTEM'),
(18, 'Hada','EE99AC', 'hada.png', 'SYSTEM'),
(19, 'Terrastal','68A090', 'stellar.png', 'SYSTEM'),
(20, 'Inanis','7C6699', 'takotipo.png', 'LatiosLaw'),
(21, 'Waifu','CF43D1', 'waifu.png', 'Amee'),
(22, 'Puerta','7C4224', 'puerta.png', 'WeirdAniki'),
(23, 'Monstruo','A61313', 'monstruo.png', 'The Silent One'),
(24, 'Tiempo','3D7AEC', 'tiempo.png', 'Amee');

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
('SYSTEM', 'creatura@gmail.com', 'creatura_dev.png', 'Creatura Dev Team.', 'creaturadevacc', 'admin'),
('Perepupengue', 'perepupengue@gmail.com', 'PayasoChu.jpg', 'Pere el que te pupengue.', '1234', 'usuario'),
('LatiosLaw', 'latios.law@gmail.com', 'SillyModernia.jpg', 'Mi yo de 10 años se encuentra feliz.', 'SakuraBestoWaifu', 'usuario'),
('The Silent One', 'void@gmail.com', 'Monster.png', '...', 'secondtonone', 'usuario'),
('Amee', 'the.ame.way@gmail.com', 'funny_smolame.png', 'The Sanest fan of the Number One Detective!', 'n1Detective', 'usuario'),
('WeirdAniki', 'straw.hat.franky@gmail.com', 'Aniki.png', 'The SUPERRRRRRR Aniki everyone NEEDS.', 'eithercolaornothing', 'usuario');

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

-- AUTO_INCREMENT para la tabla `creatura`
ALTER TABLE `creatura`
  MODIFY `id_creatura` INT(10) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT para la tabla `efectividades`
ALTER TABLE `efectividades`
  MODIFY `id_efectividad` INT(5) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT para la tabla `habilidad`
ALTER TABLE `habilidad`
  MODIFY `id_habilidad` INT(5) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT para la tabla `moveset`
ALTER TABLE `moveset`
  MODIFY `id_moveset` INT(5) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT para la tabla `rating`
ALTER TABLE `rating`
  MODIFY `id_rating` INT(5) NOT NULL AUTO_INCREMENT;

-- AUTO_INCREMENT para la tabla `tipo`
ALTER TABLE `tipo`
  MODIFY `id_tipo` INT(5) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
