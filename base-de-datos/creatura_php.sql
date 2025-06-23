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
-- Indices de la tabla `creatura`
--
ALTER TABLE `creatura`
  ADD PRIMARY KEY (`id_creatura`);

-- AUTO_INCREMENT para la tabla `creatura`
ALTER TABLE `creatura`
  MODIFY `id_creatura` INT(10) NOT NULL AUTO_INCREMENT;

--
-- Volcado de datos para la tabla `creatura`
--

INSERT INTO `creatura` (`nombre_creatura`, `id_tipo1`, `id_tipo2`, `descripcion`, `hp`, `atk`, `def`, `spa`, `sdef`, `spe`, `creador`, `imagen`, `publico`) VALUES
('Snorlax', 1, 0, 'Gigante dormilón con gran resistencia', 160, 110, 65, 65, 110, 30, 'SYSTEM', 'snorlax.png', 1),
('Charizard', 2, 10, 'Dragón ígneo con alas imponentes', 78, 84, 78, 109, 85, 100, 'SYSTEM', 'charizard.png', 1),
('Blastoise', 3, 0, 'Tortuga con cañones de agua', 79, 83, 100, 85, 105, 78, 'SYSTEM', 'blastoise.png', 1),
('Pikachu', 4, 0, 'Ratón eléctrico popular', 35, 55, 40, 50, 50, 90, 'SYSTEM', 'pikachu.png', 1),
('Venusaur', 5, 8, 'Planta venenosa con flor dorsal', 80, 82, 83, 100, 100, 80, 'SYSTEM', 'venusaur.png', 1),
('Glaceon', 6, 0, 'Evolución de Eevee tipo hielo', 65, 60, 110, 130, 95, 65, 'SYSTEM', 'glaceon.png', 1),
('Machamp', 7, 0, 'Luchador musculoso con cuatro brazos', 90, 130, 80, 65, 85, 55, 'SYSTEM', 'machamp.png', 1),
('Nidoking', 8, 9, 'Rey venenoso con fuerza de tierra', 81, 102, 77, 85, 75, 85, 'SYSTEM', 'nidoking.png', 1),
('Garchomp', 9, 15, 'Dragón de tierra letal', 108, 130, 95, 80, 85, 102, 'SYSTEM', 'garchomp.png', 1),
('Togekiss', 10, 18, 'Ave hada que irradia paz', 85, 50, 95, 120, 115, 80, 'SYSTEM', 'togekiss.png', 1),
('Alakazam', 11, 0, 'Psíquico brillante y veloz', 55, 50, 45, 135, 95, 120, 'SYSTEM', 'alakazam.png', 1),
('Scyther', 12, 10, 'Insecto cortante con alas', 70, 110, 80, 55, 80, 105, 'SYSTEM', 'scyther.png', 1),
('Tyranitar', 13, 16, 'Bestia rocosa y oscura', 100, 134, 110, 95, 100, 61, 'SYSTEM', 'tyranitar.png', 1),
('Gengar', 14, 8, 'Fantasma juguetón y astuto', 60, 65, 60, 130, 75, 110, 'SYSTEM', 'gengar.png', 1),
('Dragonite', 15, 10, 'Dragón amable con gran poder', 91, 134, 95, 100, 100, 80, 'SYSTEM', 'dragonite.png', 1),
('Umbreon', 16, 0, 'Eevee evolución sombría', 95, 65, 110, 60, 130, 65, 'SYSTEM', 'umbreon.png', 1),
('Metagross', 17, 11, 'Supercomputadora metálica', 80, 135, 130, 95, 90, 70, 'SYSTEM', 'metagross.png', 1),
('Sylveon', 18, 0, 'Hada elegante con lazos', 95, 65, 65, 110, 130, 60, 'SYSTEM', 'sylveon.png', 1),
('Infernape', 2, 7, 'Mono ardiente maestro del combate', 76, 104, 71, 104, 71, 108, 'SYSTEM', 'infernape.png', 1),
('Lucario', 7, 17, 'Aura metálica con estilo', 70, 110, 70, 115, 70, 90, 'SYSTEM', 'lucario.png', 1),
('Greninja', 3, 16, 'Ninja veloz tipo agua/siniestro', 72, 95, 67, 103, 71, 122, 'SYSTEM', 'greninja.png', 1),
('Decidueye', 5, 14, 'Arquero espectral planta/fantasma', 78, 107, 75, 100, 100, 70, 'SYSTEM', 'decidueye.png', 1),
('Corviknight', 17, 10, 'Ave metálica caballeresca', 98, 87, 105, 53, 85, 67, 'SYSTEM', 'corviknight.png', 1),
('Dragapult', 15, 14, 'Dragón fantasma ultra rápido', 88, 120, 75, 100, 75, 142, 'SYSTEM', 'dragapult.png', 1),
('Toxtricity', 8, 4, 'Eléctrico punk tóxico', 75, 98, 70, 114, 70, 75, 'SYSTEM', 'toxtricity.png', 1),
('Gardevoir', 11, 18, 'Dama psíquica/fada elegante', 68, 65, 65, 125, 115, 80, 'SYSTEM', 'gardevoir.png', 1),
('Mamoswine', 9, 6, 'Mamífero glacial con colmillos', 110, 130, 80, 70, 60, 80, 'SYSTEM', 'mamoswine.png', 1),
('Hawlucha', 7, 10, 'Luchador volador acrobático', 78, 92, 75, 74, 63, 118, 'SYSTEM', 'hawlucha.png', 1),
('Aegislash', 17, 14, 'Espada fantasma que cambia forma', 60, 50, 150, 50, 150, 60, 'SYSTEM', 'aegislash.png', 1),
('Roserade', 5, 8, 'Rosa venenosa encantadora', 60, 70, 65, 125, 105, 90, 'SYSTEM', 'roserade.png', 1),
('Waifumancer', 21, 11, 'Hechicero otaku de una realidad alternativa', 70, 50, 80, 130, 80, 69, 'WeirdAniki', 'waifumancer.png', 1),
('Ninomae Inanis', 20, 21, 'Sacerdotisa recipiente del poder de los antiguos', 60, 70, 60, 155, 150, 30, 'LatiosLaw', 'ina.png', 1),
('A. Watson', 21, 24, 'Protectora de las lineas temporales', 90, 100, 75, 110, 90, 105, 'Amee', 'watson.png', 1),
('El Portadoor', 7, 22, 'El macho mas macho de los machos', 90, 130, 100, 40, 100, 60, 'WeirdAniki', 'portadoor.png', 1),
('Lagarto de Magma', 23, 2, 'Criatura infernal capaz de generar charcos de lava y disparar roca volcanica', 110, 90, 140, 100, 70, 60, 'The Silent One', 'magmamonster.png', 1),
('Acido Viviente', 23, 8, 'Monstruo de slime acidico', 120, 40, 40, 80, 170, 20, 'The Silent One', 'slime.png', 1),
('Nanashi Mumei', 21, 23, 'Representante de la humanidad... Con todo lo que conlleva.', 70, 130, 60, 130, 70, 90, 'Amee', 'mumei.png', 1),
('Takodachi', 20, 1, 'Wah Wah Wah', 60, 25, 85, 90, 110, 20, 'LatiosLaw', 'wah.png', 0),
('Bad Ending Ina', 20, 26, 'El fin es inevitable', 150, 60, 75, 215, 145, 80, 'LatiosLaw', 'bad_ending_ina.png', 0);
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
-- Indices de la tabla `efectividades`
--
ALTER TABLE `efectividades`
  ADD PRIMARY KEY (`id_efectividad`);

-- AUTO_INCREMENT para la tabla `efectividades`
ALTER TABLE `efectividades`
  MODIFY `id_efectividad` INT(5) NOT NULL AUTO_INCREMENT;

--
-- Volcado de datos para la tabla `efectividades`
--
INSERT INTO `efectividades` (`atacante`, `defensor`, `multiplicador`) VALUES
(1, 13, 0.5),
(1, 14, 0.0),
(1, 17, 0.5),
(2, 5, 2),
(2, 6, 2),
(2, 12, 2),
(2, 17, 2),
(2, 2, 0.5),
(2, 3, 0.5),
(2, 13, 0.5),
(2, 15, 0.5),
(3, 2, 2),
(3, 13, 2),
(3, 9, 2),
(3, 3, 0.5),
(3, 5, 0.5),
(3, 15, 0.5),
(4, 3, 2),
(4, 10, 2),
(4, 4, 0.5),
(4, 5, 0.5),
(4, 15, 0.5),
(4, 9, 0.0),
(5, 3, 2),
(5, 9, 2),
(5, 13, 2),
(5, 2, 0.5),
(5, 5, 0.5),
(5, 12, 0.5),
(5, 10, 0.5),
(5, 8, 0.5),
(5, 17, 0.5),
(5, 15, 0.5),
(6, 5, 2),
(6, 9, 2),
(6, 10, 2),
(6, 15, 2),
(6, 2, 0.5),
(6, 3, 0.5),
(6, 6, 0.5),
(6, 17, 0.5),
(7, 1, 2),
(7, 6, 2),
(7, 13, 2),
(7, 16, 2),
(7, 17, 2),
(7, 8, 0.5),
(7, 10, 0.5),
(7, 11, 0.5),
(7, 12, 0.5),
(7, 14, 0.0),
(7, 18, 0.5),
(8, 5, 2),
(8, 18, 2),
(8, 8, 0.5),
(8, 9, 0.5),
(8, 13, 0.5),
(8, 14, 0.5),
(8, 17, 0.0),
(9, 2, 2),
(9, 4, 2),
(9, 8, 2),
(9, 13, 2),
(9, 17, 2),
(9, 5, 0.5),
(9, 12, 0.5),
(9, 10, 0.0),
(10, 5, 2),
(10, 7, 2),
(10, 12, 2),
(10, 4, 0.5),
(10, 13, 0.5),
(10, 17, 0.5),
(11, 7, 2),
(11, 8, 2),
(11, 11, 0.5),
(11, 17, 0.5),
(11, 16, 0.0),
(12, 5, 2),
(12, 11, 2),
(12, 16, 2),
(12, 2, 0.5),
(12, 7, 0.5),
(12, 8, 0.5),
(12, 10, 0.5),
(12, 14, 0.5),
(12, 17, 0.5),
(12, 18, 0.5),
(13, 2, 2),
(13, 6, 2),
(13, 10, 2),
(13, 12, 2),
(13, 7, 0.5),
(13, 9, 0.5),
(13, 17, 0.5),
(14, 14, 2),
(14, 11, 2),
(14, 16, 0.5),
(14, 1, 0.0),
(15, 15, 2),
(15, 17, 0.5),
(15, 18, 0.0),
(16, 11, 2),
(16, 14, 2),
(16, 7, 0.5),
(16, 16, 0.5),
(16, 18, 0.5),
(17, 6, 2),
(17, 13, 2),
(17, 18, 2),
(17, 2, 0.5),
(17, 3, 0.5),
(17, 4, 0.5),
(17, 17, 0.5),
(18, 7, 2),
(18, 15, 2),
(18, 16, 2),
(18, 2, 0.5),
(18, 8, 0.5),
(18, 17, 0.5),
(1, 20, 2),
(7, 20, 0.5),
(11, 20, 0.5),
(21, 20, 2),
(24, 20, 0.5),
(25, 20, 0),
(12, 21, 2),
(13, 21, 2),
(23, 21, 2),
(18, 21, 0.5),
(12, 22, 0.5),
(13, 22, 0.5),
(15, 22, 2),
(7, 22, 2),
(6, 22, 0.5),
(11, 22, 0.5),
(1, 22, 0.5),
(16, 22, 2),
(7, 23, 2),
(23, 23, 2),
(17, 23, 2),
(8, 23, 0.5),
(2, 23, 0.5),
(6, 23, 0.5),
(15, 23, 0.5),
(11, 23, 2),
(11, 24, 2),
(20, 24, 0.5),
(1, 24, 0),
(7, 24, 0),
(24, 24, 0),
(2, 24, 2);

INSERT INTO `efectividades` (`atacante`, `defensor`, `multiplicador`) VALUES
(1, 25, 2),
(3, 25, 2),
(5, 25, 2),
(7, 25, 0),
(12, 25, 0.5),
(14, 25, 0.5),
(15, 25, 0.5),
(21, 25, 2),
(22, 25, 2),
(23, 25, 0.5),
(24, 25, 0),
(25, 25, 2);

INSERT INTO `efectividades` (`atacante`, `defensor`, `multiplicador`) VALUES
(1, 26, 0),
(7, 26, 0),
(12, 26, 0.5),
(14, 26, 0.5),
(15, 26, 0.5),
(18, 26, 0.5),
(21, 26, 2),
(23, 26, 0.5),
(24, 26, 0),
(25, 26, 2),
(26, 26, 0.5);
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
-- Indices de la tabla `habilidad`
--
ALTER TABLE `habilidad`
ADD PRIMARY KEY (`id_habilidad`);

-- AUTO_INCREMENT para la tabla `habilidad`
ALTER TABLE `habilidad`
MODIFY `id_habilidad` INT(5) NOT NULL AUTO_INCREMENT;

--
-- Volcado de datos para la tabla `habilidad`
--

INSERT INTO `habilidad` (`nombre_habilidad`, `id_tipo_habilidad`, `descripcion`, `categoria_habilidad`, `potencia`, `creador`) VALUES

-- Tipo Fuego (2)
('Lanzallamas', 2, 'Lanza llamas que puede quemar al objetivo.', 'ESPECIAL', 90, 'SYSTEM'),
('Envite Ígneo', 2, 'Se envuelve en fuego y carga contra el rival, recibiendo retroceso.', 'FISICO', 120, 'SYSTEM'),
('Sobrecalentamiento', 2, 'Potente ataque especial que reduce el Ataque Especial del usuario.', 'ESPECIAL', 130, 'SYSTEM'),
('Onda Ígnea', 2, 'Genera una ola de calor que puede quemar al rival.', 'ESPECIAL', 95, 'SYSTEM'),

-- Tipo Eléctrico (4)
('Rayo', 4, 'Un potente rayo que puede paralizar al objetivo.', 'ESPECIAL', 90, 'SYSTEM'),
('Trueno', 4, 'Un rayo muy fuerte que paraliza, pero es impreciso.', 'ESPECIAL', 110, 'SYSTEM'),
('Placaje Eléctrico', 4, 'Se envuelve en electricidad y embiste con retroceso.', 'FISICO', 120, 'SYSTEM'),
('Onda Trueno', 4, 'Rayo de voltaje que puede paralizar, sin daño directo fuerte.', 'ESTADO', 0, 'SYSTEM'),

-- Tipo Agua (3)
('Surf', 3, 'Crea una gran ola que golpea a todos en campo.', 'ESPECIAL', 90, 'SYSTEM'),
('Hidrobomba', 3, 'Poderoso chorro de agua.', 'ESPECIAL', 110, 'SYSTEM'),
('Cola de Agua', 3, 'Azote con la cola que puede causar daño.', 'FISICO', 90, 'SYSTEM'),
('Escaldar', 3, 'Agua hirviendo que puede quemar.', 'ESPECIAL', 80, 'SYSTEM'),

-- Tipo Planta (5)
('Hoja Afilada', 5, 'Hoja afilada con alta probabilidad de crítico.', 'FISICO', 90, 'SYSTEM'),
('Rayo Solar', 5, 'Ataque que requiere esperar un turno y concentra energía solar.', 'ESPECIAL', 120, 'SYSTEM'),
('Gigadrenadoras', 5, 'Extrae energía, curando al usuario.', 'ESPECIAL', 75, 'SYSTEM'),
('Drenadoras', 5, 'Siembra semillas que drenan vida cada turno.', 'ESTADO', 0, 'SYSTEM'),

-- Tipo Hielo (6)
('Rayo Hielo', 6, 'Rayo congelante que puede congelar al objetivo', 'ESPECIAL', 90, 'SYSTEM'),
('Ventisca', 6, 'Tormenta de hielo que puede congelar a todos', 'ESPECIAL', 110, 'SYSTEM'),
('Bola Hielo', 6, 'El atacante rueda contra el objetivo durante cinco turnos, cada vez con mayor fuerza.', 'FISICO', 30, 'SYSTEM'),
('Esquirla Helada', 6, 'Crea esquirlas de hielo y las lanza a gran velocidad. Este movimiento tiene prioridad alta.', 'FISICO', 40, 'SYSTEM'),

-- Tipo Lucha (7)
('Espada Santa', 7, 'El usuario ataca con una espada, ignorando cualquier cambio en las características del objetivo.', 'FISICO', 90, 'SYSTEM'),
('Puño Dinámico', 7, 'Puñetazo que confunde si golpea', 'FISICO', 100, 'SYSTEM'),
('A Bocajarro', 7, 'Ataque contundente que disminuye las defensas del usuario', 'FISICO', 120, 'SYSTEM'),
('Onda Certera', 7, 'Agudiza la concentración mental y libera su poder. Puede reducir la Defensa Especial del objetivo.', 'ESPECIAL', 120, 'SYSTEM'),

-- Tipo Veneno (8)
('Bomba Lodo', 8, 'Lanza lodo tóxico al objetivo. Puede envenenar.', 'ESPECIAL', 90, 'SYSTEM'),
('Puya Nociva', 8, 'Ataca con un pincho venenoso. Puede envenenar al objetivo.', 'FISICO', 80, 'SYSTEM'),
('Tóxico', 8, 'Envenena gravemente al objetivo. El daño aumenta cada turno.', 'ESTADO', 0, 'SYSTEM'),
('Ácido', 8, 'Rocía con un líquido corrosivo. Puede reducir la Defensa Especial.', 'ESPECIAL', 40, 'SYSTEM'),

-- Tipo Tierra (9)
('Terremoto', 9, 'Un potente temblor que afecta a todos los Pokémon alrededor.', 'FISICO', 100, 'SYSTEM'),
('Tierra Viva', 9, 'Lanza una onda de poder terrestre que puede bajar la Defensa Especial.', 'ESPECIAL', 90, 'SYSTEM'),
('Excavar', 9, 'Un ataque de dos turnos: el primero cava un túnel, el segundo ataca.', 'FISICO', 80, 'SYSTEM'),
('Fuerza Telúrica', 9, 'Sacude el suelo bajo el rival con un ataque especial.', 'ESPECIAL', 90, 'SYSTEM'),

-- Tipo Volador (10)
('Ataque Ala', 10, 'El enemigo recibe un golpe con unas alas afiladas.', 'FISICO', 60, 'SYSTEM'),
('Pico Taladro', 10, 'Ataca al objetivo girando como un taladro. Nunca falla.', 'FISICO', 80, 'SYSTEM'),
('Golpe Aéreo', 10, 'Ataca con un golpe que no puede fallar.', 'FISICO', 60, 'SYSTEM'),
('Vendaval', 10, 'Crea un vendaval que puede confundir al objetivo.', 'ESPECIAL', 110, 'SYSTEM'),

-- Tipo Psíquico (11)
('Psíquico', 11, 'Lanza energía psíquica que puede bajar la Defensa Esp.', 'ESPECIAL', 90, 'SYSTEM'),
('Psicoataque', 11, 'Un ataque mental que también daña físicamente.', 'FISICO', 100, 'SYSTEM'),
('Confusión', 11, 'Un ataque psíquico que puede confundir al rival.', 'ESPECIAL', 50, 'SYSTEM'),
('Premonición', 11, 'Un ataque que golpea dos turnos después de usarse.', 'ESPECIAL', 120, 'SYSTEM'),

-- Tipo Bicho (12)
('Picadura', 12, 'Pica con una aguja. Si roba una baya, la usa.', 'FISICO', 60, 'SYSTEM'),
('Danza Aleteo', 12, 'Incrementa Velocidad, Defensa y Ataque Especial.', 'ESTADO', 0, 'SYSTEM'),
('Tijera X', 12, 'Ataca con unas afiladas guadañas en cruz.', 'FISICO', 80, 'SYSTEM'),
('Zumbido', 12, 'Emite un zumbido que puede bajar la Defensa Esp.', 'ESPECIAL', 90, 'SYSTEM'),

-- Tipo Roca (13)
('Lanzarrocas', 13, 'Lanza pequeñas piedras para dañar.', 'FISICO', 50, 'SYSTEM'),
('Avalancha', 13, 'Derrumba rocas sobre el enemigo. Puede hacerlo retroceder.', 'FISICO', 75, 'SYSTEM'),
('Roca Afilada', 13, 'Lanza rocas con alta probabilidad de golpe crítico.', 'FISICO', 100, 'SYSTEM'),
('Poder Pasado', 13, 'Un ataque que puede subir todas las estadísticas.', 'ESPECIAL', 60, 'SYSTEM'),

-- Tipo Fantasma (14)
('Bola Sombra', 14, 'Lanza una bola de energía que puede bajar la Defensa Esp.', 'ESPECIAL', 80, 'SYSTEM'),
('Garra Umbría', 14, 'Ataca con una garra oscura. Alta probabilidad de crítico.', 'FISICO', 70, 'SYSTEM'),
('Tinieblas', 14, 'Causa daño igual al nivel del usuario.', 'ESPECIAL', 0, 'SYSTEM'),
('Sombra Vil', 14, 'Ataca primero si el objetivo no está usando prioridad.', 'FISICO', 40, 'SYSTEM'),

-- Tipo Dragón (15)
('Garra Dragón', 15, 'Ataca con garras afiladas.', 'FISICO', 80, 'SYSTEM'),
('Pulso Dragón', 15, 'Lanza un pulso de energía dracónica.', 'ESPECIAL', 85, 'SYSTEM'),
('Cometa Draco', 15, 'Ataque muy potente que baja el At. Esp. tras usarlo.', 'ESPECIAL', 130, 'SYSTEM'),
('Dragoaliento', 15, 'Aliento de dragón que puede paralizar.', 'ESPECIAL', 60, 'SYSTEM'),

-- Tipo Siniestro (16)
('Pulso Umbrío', 16, 'Un pulso oscuro que puede hacer retroceder.', 'ESPECIAL', 80, 'SYSTEM'),
('Triturar', 16, 'Muerde con fuerza. Puede bajar la Defensa.', 'FISICO', 80, 'SYSTEM'),
('Mordisco', 16, 'Muerde al objetivo. Puede hacerlo retroceder.', 'FISICO', 60, 'SYSTEM'),
('Juego Sucio', 16, 'Usa el Ataque del enemigo para calcular el daño.', 'FISICO', 95, 'SYSTEM'),

-- Tipo Acero (17)
('Cabeza de Hierro', 17, 'Un cabezazo que puede hacer retroceder.', 'FISICO', 80, 'SYSTEM'),
('Cañón Destello', 17, 'Dispara un rayo de metal. Puede bajar la Def. Esp.', 'ESPECIAL', 80, 'SYSTEM'),
('Puño Bala', 17, 'Un ataque muy rápido. Siempre ataca primero.', 'FISICO', 40, 'SYSTEM'),
('Giro Bola', 17, 'Más lento es el usuario, más fuerte será el ataque.', 'FISICO', 0, 'SYSTEM'),

-- Tipo Hada (18)
('Fuerza Lunar', 18, 'Luz lunar que puede bajar la Defensa Esp.', 'ESPECIAL', 95, 'SYSTEM'),
('Destello Mágico', 18, 'Brilla intensamente para dañar al rival.', 'ESPECIAL', 80, 'SYSTEM'),
('Carantoña', 18, 'Ataca dulcemente al rival. Puede bajar el Ataque.', 'FISICO', 90, 'SYSTEM'),
('Voz Cautivadora', 18, 'Un canto encantador que nunca falla.', 'ESPECIAL', 40, 'SYSTEM'),

-- Tipo Normal (1)
('Puño Cometa', 1, 'Pega de dos a cinco veces seguidas.', 'FISICO', 18, 'SYSTEM'),
('Guillotina', 1, 'Ataque cortante con grandes pinzas que fulmina al objetivo de un solo golpe si acierta.', 'FISICO', 0, 'SYSTEM'),
('Danza Espada', 1, 'Este frenético baile de combate eleva el espíritu y aumenta mucho el Ataque.', 'ESTADO', 0, 'SYSTEM'),
('Triataque', 1, 'Ataque con tres rayos de luz que puede paralizar, quemar o congelar al objetivo.', 'ESPECIAL', 80, 'SYSTEM'),

-- Tipo Inanis (20)
('Ráfaga Eldritch', 20, 'El usuario libera de golpe el poder de los antiguos, causando mucho daño y reduciendo la precision del rival. Este ataque no puede ser usado 2 turnos consecutivos.', 'ESPECIAL', 180, 'LatiosLaw'),
('Wah Wah Wah!', 20, 'El usuario recita repetidamente una frase ancestral, recuperando 35% de su HP y curando 20% de la HP de todos sus compañeros de equipo.', 'ESTADO', 0, 'LatiosLaw'),
('Raging Tako Punch', 20, 'Ataca al rival con un puñetazo de magia ancestral, causando ternura y confundiendo al rival.', 'FISICO', 30, 'LatiosLaw'),
('Bonk', 20, 'Golpea la cabeza del rival con una palanca de metal. Ignora Proteccion.', 'FISICO', 100, 'LatiosLaw'),

-- Tipo Waifu (21)
('Caricias', 21, 'Acaricia con cariño al rival, enamorandolo en caso de que el rival pertenezca al género masculino.', 'ESTADO', 0, 'Amee'),
('Kira Kira Beam!', 21, 'Dispara un rayo de luz hacia el rival, causando daño y generando una cantidad desproporcionada de particulas brillantes.', 'ESPECIAL', 100, 'Amee'),
('Waifu Slap', 21, 'Golpea al rival con un fuerte cachetazo, contando con un 50% de hacerlo retroceder.', 'FISICO', 60, 'Amee'),
('Happy Ending', 21, 'El usuario se casa con el rival, duplicando todas sus estadisticas pero impidiendo que el mismo escape del campo de batalla hasta que su pareja se retire.', 'ESTADO', 0, 'Amee'),

-- Tipo Puerta (22)
('Bajo Candado', 22, 'El usuario bloquea el camino, impidiendo a todo oponente salir del campo hasta que el se retire.', 'ESTADO', 0, 'WeirdAniki'),
('Puerta al Pasado', 22, 'El usuario abre una puerta en la cabeza del rival, haciendolo viajar por su pasado, causando daño emocional.', 'ESPECIAL', 80, 'WeirdAniki'),
('Bisagras Pedorras', 22, 'El usuario chirria como esas bisagras que están hechas percha, despertando a todo pokemon en el campo de batalla.', 'ESTADO', 0, 'WeirdAniki'),
('Santo Portazo', 22, 'El usuario golpea al rival con todo su cuerpo, haciendolo retroceder. Este ataque ataca primero y solo puede ser usado el primer turno.', 'FISICO', 120, 'WeirdAniki'),

-- Tipo Monstruo (23)
('Masacre', 23, 'Destroza violentamente al rival, causando mucho daño.', 'FISICO', 130, 'The Silent One'),
('Rugido Bestial', 23, 'El usuario ruge, intimidando profundamente a todo rival en el campo y reduciendo su Ataque Fisico y Especial.', 'ESTADO', 0, 'The Silent One'),
('Laceraalmas', 23, 'El usuario hace contacto con el alma del rival y la lacera, causando daño especial.', 'FISICO', 90, 'The Silent One'),
('Adrenalina Vasta', 23, 'El usuario entra en un estado de furia, perdiendo 75% de su HP, pero incrementando su Velocidad y maximizando su Ataque Fisico.', 'ESTADO', 0, 'The Silent One'),

-- Tipo Tiempo (24)
('Time Travel', 24, 'Regresa en el tiempo, regresando al mismo estado que hace 5 turnos. Este ataque solo puede ser usado una vez por combate.', 'ESTADO', 0, 'Amee'),
('Bucle Temporal', 24, 'Golpea al rival y lo mete en un bucle temporal, obligandolo a usar el mismo ataque que el turno anterior.', 'FISICO', 65, 'Amee'),
('Fisura Relativa', 24, 'El usuario golpea al rival, aislandolo de la linea de tiempo, impidiendo que ataque durante los proximos 2 turnos.', 'FISICO', 90, 'Amee'),
('Minutos Contados', 24, 'El usuario empieza una cuenta regresiva de 3 turnosm al finalizar, aquel afectado se debilita. El pokemon mas lento en el campo no podrá cambiar.', 'ESTADO', 0, 'Amee');
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
-- Indices de la tabla `moveset`
--
ALTER TABLE `moveset`
  ADD PRIMARY KEY (`id_moveset`);

-- AUTO_INCREMENT para la tabla `moveset`
ALTER TABLE `moveset`
  MODIFY `id_moveset` INT(5) NOT NULL AUTO_INCREMENT;

--
-- Volcado de datos para la tabla `habilidad`
--

INSERT INTO `moveset` (`id_creatura`, `id_habilidad`) VALUES
-- Snorlax (Normal)
(1, 69), (1, 70), (1, 72),
-- Charizard (Fuego/Volador)
(2, 1), (2, 2), (2, 36),
-- Blastoise (Agua)
(3, 9), (3, 10), (3, 11),
-- Pikachu (Eléctrico)
(4, 5), (4, 6), (4, 7),
-- Venusaur (Planta/Veneno)
(5, 13), (5, 14), (5, 27),
-- Glaceon (Hielo)
(6, 17), (6, 18), (6, 20),
-- Machamp (Lucha)
(7, 21), (7, 22), (7, 23),
-- Nidoking (Veneno/Tierra)
(8, 25), (8, 29), (8, 31),
-- Garchomp (Dragón/Tierra)
(9, 53), (9, 54), (9, 29),
-- Togekiss (Volador/Hada)
(10, 36), (10, 65), (10, 66),
-- Alakazam (Psíquico)
(11, 37), (11, 38), (11, 40),
-- Scyther (Bicho/Volador)
(12, 41), (12, 43), (12, 33),
-- Tyranitar (Roca/Siniestro)
(13, 45), (13, 47), (13, 57),
-- Gengar (Fantasma/Veneno)
(14, 49), (14, 50), (14, 25),
-- Dragonite (Dragón/Volador)
(15, 53), (15, 54), (15, 36),
-- Umbreon (Siniestro)
(16, 57), (16, 58), (16, 59),
-- Metagross (Acero/Psíquico)
(17, 61), (17, 62), (17, 37),
-- Sylveon (Hada)
(18, 65), (18, 66), (18, 67),
-- Infernape (Fuego/Lucha)
(19, 1), (19, 21), (19, 24),
-- Lucario (Lucha/Acero)
(20, 21), (20, 61), (20, 24),
-- Greninja (Agua/Siniestro)
(21, 9), (21, 57), (21, 58),
-- Decidueye (Planta/Fantasma)
(22, 13), (22, 49), (22, 50),
-- Corviknight (Acero/Volador)
(23, 61), (23, 33), (23, 34),
-- Dragapult (Dragón/Fantasma)
(24, 53), (24, 49), (24, 55),
-- Toxtricity (Eléctrico/Veneno)
(25, 5), (25, 25), (25, 27),
-- Gardevoir (Psíquico/Hada)
(26, 37), (26, 65), (26, 66),
-- Mamoswine (Hielo/Tierra)
(27, 17), (27, 29), (27, 19),
-- Hawlucha (Lucha/Volador)
(28, 21), (28, 33), (28, 34),
-- Aegislash (Acero/Fantasma)
(29, 61), (29, 49), (29, 50),
-- Roserade (Planta/Veneno)
(30, 13), (30, 25), (30, 27),

-- Waifumancer (Waifu/Psíquico)
(31, 37), (31, 65), (31, 66), (31, 78), (31, 72),

-- Ninomae Inanis (Inanis/Waifu)
(32, 40), (32, 73), (32, 77), (32, 74), (32, 75), (32, 76),

-- A. Watson (Tiempo/Waifu)
(33, 89), (33, 92), (33, 40),

-- Portadoor (Lucha/Puerta)
(34, 23), (34, 81), (34, 84),

-- Lagarto Magma (Monstruo/Fuego)
(35, 1), (35, 3), (35, 47), (35, 53), (35, 86),

-- Slime (Monstruo/Agua)
(36, 12), (36, 28), (36, 87),

-- Mumei (Monstruo/Waifu)
(37, 79), (37, 88), (37, 52), (37, 70), (37, 85),

-- Takodachi (Inanis/Normal)
(38, 74),

-- Bad Ending Ina (Inanis/Ancestral)
(39, 73), (39, 57), (39, 49), (39, 92);

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
-- Indices de la tabla `rating`
--
ALTER TABLE `rating`
ADD PRIMARY KEY (`id_rating`);

-- AUTO_INCREMENT para la tabla `rating`
ALTER TABLE `rating`
MODIFY `id_rating` INT(5) NOT NULL AUTO_INCREMENT;

ALTER TABLE rating ADD UNIQUE KEY unique_usuario_creatura (nickname_usuario, id_creatura);

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
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`);


-- AUTO_INCREMENT para la tabla `tipo`
ALTER TABLE `tipo`
  MODIFY `id_tipo` INT(5) NOT NULL AUTO_INCREMENT;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`nombre_tipo`, `color`, `icono`, `creador`) VALUES
('Normal','A8A878', 'normal.png', 'SYSTEM'),
('Fuego','F08030', 'fuego.png', 'SYSTEM'),
('Agua', '6890F0', 'agua.png', 'SYSTEM'),
('Eléctrico',  'F8D030', 'electrico.png', 'SYSTEM'),
('Planta','78C850', 'planta.png', 'SYSTEM'),
('Hielo','98D8D8', 'hielo.png', 'SYSTEM'),
('Lucha','C03028', 'lucha.png', 'SYSTEM'),
('Veneno','A040A0', 'veneno.png', 'SYSTEM'),
('Tierra','E0C068', 'tierra.png', 'SYSTEM'),
('Volador',   'A890F0', 'volador.png', 'SYSTEM'),
('Psíquico',  'F85888', 'psiquico.png', 'SYSTEM'),
('Bicho','A8B820', 'bicho.png', 'SYSTEM'),
('Roca','B8A038', 'roca.png', 'SYSTEM'),
('Fantasma',  '705898', 'fantasma.png', 'SYSTEM'),
('Dragón',    '7038F8', 'dragon.png', 'SYSTEM'),
('Siniestro', '705848', 'siniestro.png', 'SYSTEM'),
('Acero','B8B8D0', 'acero.png', 'SYSTEM'),
('Hada','EE99AC', 'hada.png', 'SYSTEM'),
('Terrastal','68A090', 'stellar.png', 'SYSTEM'),
('Inanis','7C6699', 'takotipo.png', 'LatiosLaw'),
('Waifu','CF43D1', 'waifu.png', 'Amee'),
('Puerta','7C4224', 'puerta.png', 'WeirdAniki'),
('Monstruo','A61313', 'monstruo.png', 'The Silent One'),
('Tiempo','3D7AEC', 'tiempo.png', 'Amee');

INSERT INTO `tipo` (`nombre_tipo`, `color`, `icono`, `creador`) VALUES
('Gamer', '94b4ff', 'gamer.png', 'T.R.O.N.N.Y.');

INSERT INTO `tipo` (`nombre_tipo`, `color`, `icono`, `creador`) VALUES
('Ancestral', '3D3D43', 'ancestral.png', 'LatiosLaw');

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
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nickname`);
COMMIT;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nickname`, `correo`, `foto`, `biografia`, `contraseña`, `tipo`) VALUES
('SYSTEM', 'creatura@gmail.com', 'creatura_dev.png', 'Creatura Dev Team.', 'creaturadevacc', 'admin'),
('Perepupengue', 'perepupengue@gmail.com', 'PayasoChu.jpg', 'Pere el que te pupengue.', '1234', 'usuario'),
('LatiosLaw', 'latios.law@gmail.com', 'SillyModernia.jpg', 'Mi yo de 10 años se encuentra feliz.', 'SakuraBestoWaifu', 'usuario'),
('The Silent One', 'void@gmail.com', 'Monster.png', '...', 'secondtonone', 'usuario'),
('Amee', 'the.ame.way@gmail.com', 'funny_smolame.png', 'The Sanest fan of the Number One Detective!', 'n1Detective', 'usuario'),
('WeirdAniki', 'straw.hat.franky@gmail.com', 'Aniki.png', 'The SUPERRRRRRR Aniki everyone NEEDS.', 'eithercolaornothing', 'usuario'),
('T.R.O.N.N.Y.', 'darkhero.returns@gmail.com', 'tronni.png', 'Just me. On my room. As always.', 'eleggIsBest', 'usuario');

--
-- Índices para tablas volcadas
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
