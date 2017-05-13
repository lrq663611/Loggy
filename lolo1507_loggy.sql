-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2014 at 02:30 PM
-- Server version: 5.5.37-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lolo1507_loggy`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'mechanic', 'Mostly play with service section');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE IF NOT EXISTS `part` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `part_manufacture_id` int(8) DEFAULT NULL,
  `name` varchar(400) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `part_group_id` int(2) DEFAULT NULL,
  `part_type_id` int(4) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by_id` int(11) unsigned DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  `last_edit_by_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_part_manufacture` (`part_manufacture_id`),
  KEY `fk_part_group` (`part_group_id`),
  KEY `fk_part_type` (`part_type_id`),
  KEY `fk_added_by15` (`last_edit_by_id`),
  KEY `fk_added_by3` (`added_by_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `part_group`
--

CREATE TABLE IF NOT EXISTS `part_group` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `description` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `part_group`
--

INSERT INTO `part_group` (`id`, `description`) VALUES
(1, 'Original Certified Part'),
(2, 'Performance Part'),
(3, 'Non-Certified Part');

-- --------------------------------------------------------

--
-- Table structure for table `part_manufacture`
--

CREATE TABLE IF NOT EXISTS `part_manufacture` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by_id` int(11) unsigned DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  `last_edit_by_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_added_by1` (`added_by_id`),
  KEY `fk_added_by13` (`last_edit_by_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `part_manufacture`
--

INSERT INTO `part_manufacture` (`id`, `name`, `added`, `added_by_id`, `last_edit`, `last_edit_by_id`) VALUES
(1, 'BMW M', 1414027154, 2, 1414027154, 2),
(2, 'Ford Performance Parts', 1414027200, 2, 1414027200, 2),
(3, 'NISMO', 1414027225, 2, 1414027225, 2),
(4, 'Toyota Racing Development (TRD)', 1414027273, 2, 1414027273, 2),
(5, 'Pirelli', 1414027377, 2, 1414027377, 2),
(6, 'Pioneer', 1414027410, 2, 1414027410, 2),
(7, 'Honda Type R', 1414027432, 2, 1414027432, 2),
(8, 'HSV', 1414027454, 2, 1414027454, 2),
(9, 'Erebus', 1414027477, 2, 1414027477, 2),
(10, 'BMW', 1414027494, 2, 1414027494, 2),
(11, 'Ford', 1414027507, 2, 1414027507, 2),
(12, 'Mazda', 1414027526, 2, 1414027526, 2),
(13, 'Nissan', 1414027541, 2, 1414027541, 2),
(14, 'Subaru', 1414027562, 2, 1414027562, 2),
(15, 'Subaru Tecnica International (STI)', 1414027910, 2, 1414027910, 2),
(16, 'HKS', 1414028352, 2, 1414028352, 2),
(17, 'Polestar', 1414028456, 2, 1414028456, 2),
(18, 'Holden', 1414028476, 2, 1414028476, 2),
(19, 'Mercedes-Benz', 1414028491, 2, 1414028491, 2),
(20, 'Volvo', 1414028509, 2, 1414028509, 2),
(21, 'Audi', 1414028526, 2, 1414028526, 2),
(22, 'Opel', 1414028542, 2, 1414028542, 2),
(23, 'Opel Performance Center (OPC)', 1414028598, 2, 1414028598, 2),
(24, 'Toyota', 1414028633, 2, 1414028633, 2),
(25, 'Lexus', 1414028650, 2, 1414028650, 2),
(26, 'Kia', 1414028687, 2, 1414028687, 2),
(27, 'Proton', 1414028701, 2, 1414028701, 2),
(28, 'Volkswagen', 1414028724, 2, 1414028724, 2),
(29, 'Jaguar', 1414028739, 2, 1414028739, 2),
(30, 'Ferrari', 1414028806, 2, 1414028806, 2),
(31, 'Lamborghini', 1414028823, 2, 1414028823, 2),
(32, 'Dodge', 1414028844, 2, 1414028844, 2),
(33, 'Sony', 1414028874, 2, 1414028874, 2),
(34, 'Alpine', 1414028889, 2, 1414028889, 2),
(35, 'Bride', 1414028919, 2, 1414028919, 2),
(36, 'Continental', 1414028945, 2, 1414028945, 2),
(37, 'Bridgestone', 1414028963, 2, 1414028963, 2),
(38, 'Alpina', 1414029050, 2, 1414029050, 2),
(39, 'Renault', 1414029102, 2, 1414029102, 2),
(40, 'Citroen', 1414029126, 2, 1414029126, 2),
(41, 'Bosch', 1414066796, 2, 1414066796, 2),
(42, 'Bendix', 1414066888, 2, 1414066888, 2),
(43, 'Skoda', 1414066915, 2, 1414066915, 2),
(44, 'Tata', 1414066927, 2, 1414066927, 2),
(45, 'Abarth', 1414067015, 2, 1414067015, 2),
(46, 'Alfa Romeo', 1414067107, 2, 1414067107, 2),
(47, 'Aston Martin', 1414067127, 2, 1414067127, 2),
(48, 'Bentley', 1414067145, 2, 1414067145, 2),
(49, 'Caterham', 1414067163, 2, 1414067163, 2),
(50, 'Chery', 1414067175, 2, 1414067175, 2),
(51, 'Chevrolet', 1414067185, 2, 1414067185, 2),
(52, 'Chrysler', 1414067194, 2, 1414067194, 2),
(53, 'Foton', 1414067224, 2, 1414067224, 2),
(54, 'Fuso', 1414067242, 2, 1414067242, 2),
(55, 'Infiniti', 1414067317, 2, 1414067317, 2),
(56, 'Honda', 1414067331, 2, 1414067331, 2),
(57, 'Freightliner', 1414067371, 2, 1414067371, 2),
(58, 'Hino', 1414067382, 2, 1414067382, 2),
(59, 'Great Wall Motors', 1414067405, 2, 1414067405, 2),
(60, 'Isuzu', 1414067486, 2, 1414067486, 2),
(61, 'Volvo Trucks', 1414067587, 2, 1414067587, 2),
(62, 'Fiat', 1414067645, 2, 1414067645, 2),
(63, 'Fiat Professional', 1414067660, 2, 1414067660, 2),
(64, 'Hyundai', 1414067679, 2, 1414067679, 2),
(65, 'Iveco', 1414067704, 2, 1414067704, 2),
(66, 'Jeep', 1414067922, 2, 1414067922, 2),
(67, 'Land Rover', 1414068402, 2, 1414068402, 2),
(68, 'Lotus', 1414068419, 2, 1414068419, 2),
(69, 'Mahindra', 1414068435, 2, 1414068435, 2),
(70, 'Maserati', 1414068452, 2, 1414068452, 2),
(71, 'McLaren', 1414068473, 2, 1414068473, 2),
(72, 'Mercedes - Benz Trucks', 1414068505, 2, 1414068505, 2),
(73, 'Mini', 1414068522, 2, 1414068522, 2),
(74, 'Porsche', 1414068538, 2, 1414068538, 2),
(75, 'Peugeot', 1414068556, 2, 1414068556, 2),
(76, 'Ssangyong', 1414068591, 2, 1414068591, 2),
(77, 'Smart', 1414068601, 2, 1414068601, 2),
(78, 'Suzuki', 1414068631, 2, 1414068631, 2),
(79, 'Tesla', 1414068647, 2, 1414068647, 2);

-- --------------------------------------------------------

--
-- Table structure for table `part_type`
--

CREATE TABLE IF NOT EXISTS `part_type` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(4000) DEFAULT NULL,
  `part_type_cat_id` int(2) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by_id` int(11) unsigned DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  `last_edit_by_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_part_type_cat` (`part_type_cat_id`),
  KEY `fk_added_by2` (`added_by_id`),
  KEY `fk_added_by14` (`last_edit_by_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `part_type`
--

INSERT INTO `part_type` (`id`, `name`, `description`, `part_type_cat_id`, `added`, `added_by_id`, `last_edit`, `last_edit_by_id`) VALUES
(1, 'Power steering pump', 'A pump system used to operate the power steering system on vehicles. It circulates the fluid and increases the driveability of a vehicle', 1, 1414068884, 2, 1414068884, 2),
(2, 'Starter Motor', 'A starter is an electric motor, pneumatic motor, hydraulic motor, or other device for rotating an internal-combustion engine so as to initiate the engine''s operation under its own power.', 1, 1414069236, 2, 1414069236, 2),
(3, 'Alternator System', 'Alternators are used in vehicles to charge the battery and to power the electrical system when its engine is running. An alternator is an electrical generator that converts mechanical energy to electrical energy in the form of alternating current. For reasons of cost and simplicity, most alternators use a rotating magnetic field with a stationary armature. The alternator assembly includes: brackets, generator, assembly, voltage regulator, wiring, nuts and clips.', 1, 1414101717, 2, 1415163999, 2),
(4, 'Infotainment Head Unit System', 'Provides the vehicle with some or all of the functions of : Radio, GPS, TV, Cassette, CD, DVD, Bluetooth Streaming, MD player, Voice Recognition, Vehicle data, Vehicle settings, AUX input and RCA/RGB input and provides visual information to the driver and the passengers.The head unit is the centerpiece of the car''s sound system. Typically located in the center of the dashboard, modern head units are densely integrated electronic packages housed in detachable face plates. As high-end head units are common targets for theft, many head units are typically integrated into the vehicle''s alarm system. The system ususally contains : a monitor or LCD display screen, scrrews, brackets, fascias as well as wiring looms. Other parts such as antennas or other auxiliary inputs need to also be included as part of this system.', 2, 1414102114, 2, 1414909218, 2),
(5, 'Battery', 'Provides the vehicle with electricity to power the engine and the associated electrical systems. Automotive SLI batteries are usually lead-acid type, and are made of six galvanic cells in series to provide a 12-volt system. Each cell provides 2.1 volts for a total of 12.6 volts at full charge. Heavy vehicles, such as highway trucks or tractors, often equipped with diesel engines, may have two batteries in series for a 24-volt system or may have parallel strings of batteries. Batteries come in many different shapes, sizes and charges depending on the vehicle needs. This component is usually replaced every few years or so.', 2, 1414102266, 2, 1414908013, 2),
(6, 'Compressor', 'The compressor is used to pump around antifreeze for the Air Conditioner unit, it transfers either fluid or gas around the system and is used either in a standalone use or with other systems simultaneously.', 2, 1414102742, 2, 1414102742, 2),
(7, 'Licence Plate Lighting', 'This component houses the bulbs and the lighting for the licence plate on a vehicle located on the rear of the vehicle. It usually contains : bulbs, housing, wires and socket assembly.', 2, 1414103737, 2, 1414103737, 2),
(8, 'Instrument Cluster', 'This assembly contains instruments and gauges associated with vehicle operation. It usually contains the : Speedomoter, Odometer, Rev Counter and Tachometer, Thermometer, Amp meter, Oil Thermometer and lights and potential auxiliary gauges for Air Intake, Turbo Pressure and Other Thermometers.  ', 2, 1414104756, 2, 1414104756, 2),
(9, 'Head lights', 'The headlamps ususally come in a pair and are used for the driver to see mainly at night time or in poor visibility conditions. It contains the housing, bulbs, brackets, wiring and brackets for the main lights. They also might contain the LED Running lights within the same assembly. The lighting types used in vehicles generally are either halogen or xenon although laser is also been know to be in use. They can come in different : colours/ temperatures, which dictate the brightness and tone of colour used. In Australia, whiteish lights are generally used, although in Europe, yellow lights are not uncommon. ', 2, 1414106345, 2, 1414658504, 2),
(10, 'Tyres', 'Tyres are used for all vehicles and come in many different sized for different purposes. They include : OffRoad, Drift, Mud,Snow/Winter, Slicks, Runflats, High Performance, All season, All Terrain, Space Saver, Heavy Duty and Racing amongst others. Every vehcile should have a minimum of 4 tyres at all times. ', 3, 1414106717, 2, 1414106717, 2),
(11, 'Rearview Mirror', 'A mirror inside the vehicle used to see traffic and other obstacles behind the vehicle. It would conatins provisions for: Alarms, Rear View Cameras, Dimming switch/ mechanism and other potential sensors. They come in various shapes and sizes depending on the vehicle. Replacements can also be issued. Parts include : mirror assembly, covers, nuts/brackets, dimming  switch, buttons and wiring (optional). ', 4, 1414106967, 2, 1415162941, 2),
(12, 'Seat belt', 'Seatbelts are used to keep occupants safe and must be used by Australian Federal Law. They contain the buckles, tongues, belt, bolts, buttons, sensors,  and other restraints. Each vehicle must have a minimum of 1 seatbelt per passenger and may also have speciailsied seat belt mechanisms for animals and for cargo. They must be tested at every inspection and must be in proper working order to be considered road worthy. ', 4, 1414107114, 2, 1416113365, 2),
(13, 'Sun visor', 'Sunvisors are used to block out sun or bright lights. They are located for both the front passengers and often contain a mirror and lights. Visors are also available as an option or standard item from manufacturers with a built in garage door opener.  Aftermarket exterior sun visors are available for trucks as cab visors. The parts usually include : the visor, lights, mirrors, screws, brackets, switches.', 4, 1414107418, 2, 1415163186, 2),
(14, 'Roof racks', 'Roof racks are used to carry many objects on the roof of the vehcile, including carriers, bikes, canoes, row boats, etc... Each roof rack must be custom made to the vehicle and must have existing supports made by the manufacturer and conform to ADR and regulations.', 3, 1414241517, 2, 1414241517, 2),
(15, 'Spoiler', 'A spoiler is used to provide downforce to the reare of the vehicle and to potentially increase aesthetics. It can come in different shapes and sizes with different puposes dependant on the car. It can be considered and original part of the vehicle or can be retrofitted as an aftermarket alternative. ', 3, 1414244757, 2, 1414244757, 2),
(16, 'Bull bar', 'A bullbar is a device fitted to the front of a vehicle to protect its occupants from collisions, whether an accidental collision with a large animal in rural roads, or an intentional collision with another vehicle in police usage. They vary considerably in size and form, and are usually made of welded steel or aluminium tubing, and, more recently, moulded polycarbonate and polyethylene materials. This can be included as an original part or can be specified for aftermarket installation provided the correct provisions for the vehicle and the type of material that is being used correctly.', 3, 1414245145, 2, 1414245145, 2),
(17, 'Front Passenger Seat', 'The front seats usually are for just 2 passengers, although some vehicles have configuations for 3 passengers. The seats themselves are usually upholstered in: cloth, leather, vinyl, cotton and linen. They can also contain components which include : airbags, heating, cooling, massage units and power movement modules.  The seats usually include the following parts: the seat, nuts, bolts, switches, wiring, first aid kit, actuators, coverings,head rest, sliders, foam,  seat upholstery, frame, panels, mats, elastics, springs, supports, rivets, sensors, airbags and wiring harnesses. Each seat must be Australia Design Rules compliant and must be tested to ensure that it is safe. Each seat can be replaced with other aftermarket seats. The type of seat and the level of equipment that it provides, depends on the specifications that are set by the manufacturers. The passenger seat however, generally doesn''t receive any memory functions and might not having cooling or massaging or heating functions or electrical movement or additional supports depending on the configuration.   ', 4, 1414296176, 2, 1415167865, 2),
(18, 'Rear seats', 'The rear seats usually are for just 2 passengers, although some vehicles have configuations for 3 passengers to sit comfortably. The seats themselves are usually upholstered in: cloth, leather, vinyl, cotton and linen. They can also contain components which include : airbags, heating, cooling, massage units and power movement modules.  They can come in different types including: bucket, bench, baby seat, sports and folding. They contain many adjustments for:Backrest angle,Cushion edge,Fore-and-aft position,Headrest angle,Headrest level,Lumbar position,Seat depth,Seat height,The upper section of the seat backrest, may be tilted to the front for optimum, individual shoulder support,Variable head support at the sides,Cushion Tilt and Turning Seat.', 4, 1414296474, 2, 1414296474, 2),
(19, 'Steering Wheel', 'Steering wheels are used in most modern land vehicles, including all mass-production automobiles, as well as buses, light and heavy trucks, and tractors. The steering wheel is the part of the steering system that is manipulated by the driver; the rest of the steering system responds to such driver inputs. This can be through direct mechanical contact as in recirculating ball or rack and pinion steering gears, without or with the assistance of hydraulic power steering, HPS, or as in some modern production cars with the assistance of computer controlled motors, known as Electric Power Steering. It can come in various diameters and can include provisions for audio controls, cruise control, trip computer, heating and cooling and voice recognition functions. It also contains provisions for airbags and horns, lights( head lights, fog lights and high beams), blinkers (turning idicators) and wind screen wiper controls. These are controlled via the stalks attached to the steering wheel.  Some wheels might also contain a column shifter for changing gears. The steering wheel assembly generally includes: The steering wheel, air bag module, buttons, wiring harnesses, bults, nots, switches, leather, vinyl, plastic, badges and decals.  ', 4, 1414327204, 2, 1416113116, 2),
(20, 'First Aid Kit', 'The contents of the Kit includes. First Aid instructions booklet, adhesive bandages, emergency survival blanket, triangular bandage, sterile gauze pads, stretch gauze, bandage dressing, roll gauze, adhesive tape, scissors. This usually is located in the vehicle or in the boot and is needed in the event of an emergency, although is not compulsory for the manufacturer to include in the vehicle.', 4, 1414328564, 2, 1414328564, 2),
(21, 'Keys', 'Car keys can come in various shapes and sizes and usually have buttons on the remote to be able to lock, unlock doors, windows, sun roofs, convertible roofs and trunks. It can also have alarm and remote starting functionalities. Keys can be inserted into the ignition barrel to start ignition or may work wirelessly. Each car usually comes with a set of at least 2 keys, and each key is unique to the car.', 4, 1414328703, 2, 1414328703, 2),
(22, 'Front Axle', 'An axle is a central shaft for a rotating wheel or gear. On wheeled vehicles, the axle may be fixed to the wheels, rotating with them, or fixed to the vehicle, with the wheels rotating around the axle. In the former case, bearings or bushings are provided at the mounting points where the axle is supported. In the latter case, a bearing or bushing sits inside a central hole in the wheel to allow the wheel or gear to rotate around the axle. It contains : spindles, joins, bolts and nuts and the front disc rotors used for the braking system as well. ', 1, 1414331140, 2, 1414331140, 2),
(23, 'Fuel Piping /lines', 'Fuel piping is ued to transport fuel from the tanks through to the engine bay to be consumed, It generally contains: hoses, clamps, insulation and clips. ', 1, 1414331635, 2, 1414331635, 2),
(24, 'Drive Shaft', 'A drive shaft, driveshaft, driving shaft, propeller shaft (prop shaft), or Cardan shaft is a mechanical component for transmitting torque and rotation, usually used to connect other components of a drive train that cannot be connected directly because of distance or the need to allow for relative movement between them. It ususally contains the shaft, bolts and nuts. ', 1, 1414331868, 2, 1414331868, 2),
(25, 'Radiator', 'Radiators are heat exchangers used for cooling internal combustion engines, mainly in automobiles.  Internal combustion engines are often cooled by circulating a liquid called engine coolant through the engine block, where it is heated, then through a radiator where it loses heat to the atmosphere, and then returned to the engine. Engine coolant is usually water-based, but may also be oil. It is common to employ a water pump to force the engine coolant to circulate, and also for an axial fan to force air through the radiator. Radiators usually include : tanks, harnesses, clamps, assemblies, pump, motors, screws,pipes, seals, clips, fans, drains,  rubber bushings and labels.', 1, 1414332323, 2, 1414332323, 2),
(26, 'Horn', 'A horn is used to alert other drivers to your attention and is also used in alarm systems. It is generally activated by pressing a button on the steering wheel or by pressing the steering wheel in. It contains : nuts, screws, 2 pitched horns and bushings.', 2, 1414333043, 2, 1414333043, 2),
(27, 'Pedals', 'Pedals are used to control the: accelerator, brake and the cluch for a manual vehicle. They are generally made out of rubber or metal and can also include a foot rest. A pedal can also be used for a foot operated parking brake. They contain: the pedal assembly, nuts, brackets, arms, bearings, grommets, springs and pads.', 4, 1414333335, 2, 1414333335, 2),
(28, 'Snow Chains', 'Snow chains, or tire chains, are devices fitted to the tires of vehicles to provide maximum traction when driving through snow and ice.  Snow chains attach to the drive wheels of a vehicle. Chains are usually sold in pairs and must be purchased to match a particular tire size (tire diameter and tread width). Driving with chains reduces fuel efficiency, and can reduce the speed of the automobile to approximately 50 km/h (30 mph).', 3, 1414370622, 2, 1414370622, 2),
(29, 'Hardtop Carrier', 'A hard top carrier is mounted via roof racks or rails on cars that have these provisions and allow for extra items to be carried on the roof. These are available only as an accessory / option for vehicles and must be specific to the vehicle using the carrier. ', 3, 1414381155, 2, 1414381155, 2),
(30, 'Floor Mats', 'Car mats, also known as automobile floor mats, are designed to protect for the floor of a vehicle from dirt, wear and salt corrosion.  One major use of a car mat is to keep the car looking clean.Most mats can be easily removed for cleaning and then replaced. Some require fixation points to ensure they remain fixed in position. Car mats are usually made out of rubber or of carpet and are often included as an accessory for new vehicles which are tailor made for the vehicle. However, aftermarket mats can be purchased and used and they have the exact same function.', 4, 1414403194, 2, 1414403194, 2),
(31, 'Gear Stick', 'A gear stick, also known as a gearstick is a metal rod attached to the shift assembly in a manual transmission-equipped automobile and is used to change gear. In an automatic transmission-equipped vehicle, the same device is usually known as a gear selector. A gear stick will normally be used to change gear whilst depressing the clutch pedal with the left foot to disengage the engine from the drivetrain and wheels. They come in 3 generally used configurations : 5 speed manual gearbox, 6 speed manual gearbox and automatic transmissions with P,R,N,D2,L as well.', 4, 1414403359, 2, 1414403359, 2),
(32, 'Hand brake lever', 'In cars, the parking brake, also called hand brake, emergency brake, or e-brake, is a latching brake usually used to keep the vehicle stationary. It is sometimes also used to prevent a vehicle from rolling when the operator needs both feet to operate the clutch and throttle pedals. Automobile hand brakes usually consist of a cable directly connected to the brake mechanism on one end and to a lever or foot pedal at the driver''s position. The mechanism is often a hand-operated lever (hence the hand brake name), on the floor on either side of the driver, or a pull handle located below and near the steering wheel column, or a (foot-operated) pedal located far apart from the other pedals. The sleeve can be made of leather, suede, plastic or vinyl and includes a button to press down onto the cable. The  foot brake contains the pedal, as well as screws and the lever. An automatic parking system usually contains a small switch that is pulled up. Each parking brake must be tested and must be in good working order to ensure that the vehicle remains stationary when needed. ', 4, 1414403794, 2, 1415163706, 2),
(33, 'Mud Flaps', 'A mudflap or mud guard is used in combination with the vehicle fender to protect the vehicle, passengers, other vehicles, and pedestrians from mud and other flying debris thrown into the air by the rotating tire. A mudflap is typically made from a flexible material such as rubber that is not easily damaged by contact with flying debris, the tire, or the road surface.  Mudflaps can be large rectangular sheets suspended behind the tires, or may be small molded lips below the rear of the vehicle''s wheel wells. Mudflaps can be aerodynamically engineered, utilizing shaping, louvers or vents to improve airflow and lower drag. While some flaps are the plain colour of rubber, many contain company logos or other art, or sometimes advertisements.', 3, 1414404026, 2, 1414404026, 2),
(34, 'Clutch', 'A clutch is a mechanical device that engages and disengages the power transmission, especially from driving shaft to driven shaft.In the simplest application, clutches connect and disconnect two rotating shafts (drive shafts or line shafts). In these devices, one shaft is typically attached to a motor or other power unit (the driving member) while the other shaft (the driven member) provides output power for work. While typically the motions involved are rotary, linear clutches are also possible. There may be more than one clutch in use at a time in a vehicle depending on the gearbox configuration and are either operated manually via the pedal in the vehicle or the vehicle will engage the clutch automatically. The parts include : Spring, assembly, plates, bearings and clips.', 1, 1414404928, 2, 1414404928, 2),
(35, 'Spark / glow plug', 'A spark plug (sometimes, in British English, a sparking plug,[1] and, colloquially, a plug) is a device for delivering electric current from an ignition system to the combustion chamber of a spark-ignition engine to ignite the compressed fuel/air mixture by an electric spark, while containing combustion pressure within the engine. A spark plug has a metal threaded shell, electrically isolated from a central electrode by a porcelain insulator. The central electrode, which may contain a resistor, is connected by a heavily insulated wire to the output terminal of an ignition coil or magneto. The spark plug''s metal shell is screwed into the engine''s cylinder head and thus electrically grounded. The central electrode protrudes through the porcelain insulator into the combustion chamber, forming one or more spark gaps between the inner end of the central electrode and usually one or more protuberances or structures attached to the inner end of the threaded shell and designated the side, earth, or ground electrode(s).', 1, 1414408216, 2, 1414408216, 2),
(36, 'Flywheel', 'A flywheel is a rotating mechanical device that is used to store rotational energy. Flywheels are typically made of steel and rotate on conventional bearings; these are generally limited to a revolution rate of several thousand RPM. Some modern flywheels are made of carbon fiber materials and employ magnetic bearings, enabling them to revolve at speeds up to 60,000 RPM. Carbon-composite flywheel batteries have recently been manufactured and are proving to be viable in real-world tests on mainstream cars. Additionally, their disposal is more eco-friendly. Flywheels are often used to provide continuous energy in systems where the energy source is not continuous. In such cases, the flywheel stores energy when torque is applied by the energy source, and it releases stored energy when the energy source is not applying torque to it. For example, a flywheel is used to maintain constant angular velocity of the crankshaft in a reciprocating engine. In this case, the flywheel—which is mounted on the crankshaft—stores energy when torque is exerted on it by a firing piston, and it releases energy to its mechanical loads when no piston is exerting torque on it. Flywheels can be used in a single or in a dual configuration. The parts of a flywheel usually include : dowells, bolts, flywheel assembly, ball bearings and plates. This part needs to be monitored for wear and tear to ensure that the vehicle is operating in an optimum condition.', 1, 1414412411, 2, 1415167004, 2),
(37, 'Engine Block/ Cylinder Block', 'A cylinder block is an integrated structure comprising the cylinder(s) of a reciprocating engine and often some or all of their associated surrounding structures (coolant passages, intake and exhaust passages and ports, and crankcase). The term engine block is often used synonymously with "cylinder block" (although technically distinctions can be made between en bloc cylinders as a discrete unit versus engine block designs with yet more integration that comprise the crankcase as well). The engine block can have various configurations being in : Straight 6, Straight 4, V6, V4,V5, Boxer 4, Boxer 6, W,Rotary, Wankel, 2 Cylinder amongst others. ', 1, 1414464893, 2, 1414464893, 2),
(38, 'Intake Manifold', 'The primary function of the intake manifold is to evenly distribute the combustion mixture (or just air in a direct injection engine) to each intake port in the cylinder head(s). Even distribution is important to optimize the efficiency and performance of the engine. It may also serve as a mount for the carburetor, throttle body, fuel injectors and other components of the engine.  Due to the downward movement of the pistons and the restriction caused by the throttle valve, in a reciprocating spark ignition piston engine, a partial vacuum (lower than atmospheric pressure) exists in the intake manifold. This manifold vacuum can be substantial, and can be used as a source of automobile ancillary power to drive auxiliary systems: power assisted brakes, emission control devices, cruise control, ignition advance, windshield wipers, power windows, ventilation system valves, etc. The manifold includes: sensos, nuts, rings, grommets and screws.', 1, 1414465467, 2, 1414465467, 2),
(39, 'Wheel', 'All vehicles must contain wheels in order to move. Depending on the number of wheels, defines the classification of the vehicle. Motorbikes have 2, tricycles have 3 as well as some unique cars, most cars have four, trucks are known to have more than 6. Each vehicle might also carry around a spare wheel in case of damage. Wheels come in various radius ranging from 16 - 23 inches typically. Different types of widths may also be used for various purposes. Space saver tyres usually have a thinner wheel. Wheels can be made out of steel or alloys and may also include caps. They usually contain nuts and weights and bolts. The sizes of the wheels may be altered to the vehicles specification if approved. All wheels must have tyres and must also be in good condition in order to be considered road worthy.  ', 3, 1414540932, 2, 1414541220, 2),
(40, 'Tail lights', 'Tail lights are used to indicate if a person is : using the brakes, reversing, turning, has their headlights on, or a combination of all three. They are generally made of plastic and contain several: lights, bolts, wiring harnesses, screws, bulb housing and brackets or clips. They can come in different unique shapes and sizes with halogen or LED lighting used and can come with various colours :clear, smoked, black amongst others. Lights need to be visible and in working order to be considered legal on the road. ', 2, 1414541874, 2, 1414541874, 2),
(41, 'Badges', 'Vehicle badging is used to identify : brand model, engine, fuel type, turbo, sports, limited edition or other markings. The brand logo is usually on the front (bonnet) and rear (boot). The rear usually contains more info /badges. It is not uncommon to have badging on the side of a vehicle too. The badging is made out of metal or plastic and is either glued onto the vehicle or is held in place with brackets. They can also be removed if the owner desires.  ', 3, 1414542162, 2, 1414542162, 2),
(42, 'Front Grille', 'A grille covers an opening in the body of a vehicle to allow air to enter. Most vehicles feature a grille at the front of the vehicle to protect the radiator and engine and to assist with cooling the vehicle. A Grille or fasica can come in many different shapes and sizes and is a critical design element for a vehicle and defines the character of a vehicle. Aftermarket grilles can be used but must be compliant to design standards. They can be made out of: plastic, metal, carbon fibre or a combination of materials.  ', 3, 1414657665, 2, 1414657665, 2),
(43, 'Fog Lights', 'Front fog lamps provide a wide, bar-shaped beam of light with a sharp cutoff at the top, and are generally aimed and mounted low. They may produce white or selective yellow light, and are intended for use at low speed to increase the illumination directed towards the road surface and verges in conditions of poor visibility due to rain, fog, dust or snow.  They are sometimes used in place of dipped-beam headlamps, reducing the glare-back from fog or falling snow, although the legality varies by jurisdiction of using front fog lamps without low beam headlamps. They are generally mounted in the front bumper of the vehicle, as well as potentially having one in the brake lights in the rear bumper of the car. Fog lights can be retrofitted to a vehicle or can be fitted as aftermarket parts, providing that they are compliant and that they are designed for the right "left hand or right hand" drive configuration. ', 2, 1414658202, 2, 1414658202, 2),
(44, 'Ignition Barrel', 'An Ignition (or starter) switch is a switch in the control system of an internal combustion engined motor vehicle that activates the main electrical systems for the vehicle. Besides providing power to the starter solenoid and the ignition system components (including the engine control unit and ignition coil) it also usually switches on power to many "accessories" (radio, power windows, etc.). The ignition switch usually requires a key be inserted that works a lock built into the switch mechanism. It is frequently combined with the starter switch which activates the starter motor. Alternate versions of this include a "push start button" system as well as wireless starting systems via a special key, as observed with newer cars. Race cars generally just have a switch, they do not require the provisions for keys.', 2, 1414828130, 2, 1414828130, 2),
(45, 'Electronic Stability Control / Electronic Stability Program / Dynamic Stability Program', 'This system improves a vehicle''s stability by detecting and reducing loss of traction (skidding).When ESC detects loss of steering control, it automatically applies the brakes to help "steer" the vehicle where the driver intends to go. Braking is automatically applied to wheels individually, such as the outer front wheel to counter oversteer or the inner rear wheel to counter understeer. Some ESC systems also reduce engine power until control is regained. ESC does not improve a vehicle''s cornering performance; instead, it helps to minimize the loss of control.   The ESC controller can also receive data from and issue commands to other controllers on the vehicle such as an all wheel drive system or an active suspension system to improve vehicle stability and controllability.  The sensors used for ESC have to send data at all times in order to detect possible defects as soon as possible. They have to be resistant to possible forms of interference (rain, holes in the road, etc.). The most important sensors are: Steering wheel angle sensor: determines the driver''s intended rotation; i.e. where the driver wants to steer.  Yaw rate sensor: measures the rotation rate of the car; i.e. how much the car is actually turning. The data from the yaw sensor is compared with the data from the steering wheel angle sensor to determine regulating action.  Lateral acceleration sensor: often an accelerometer     Wheel speed sensor: measures the wheel speed.  Other sensors can include:      Longitudinal acceleration sensor: similar to the lateral acceleration sensor in design, but can offer additional information about road pitch and also provide another source of vehicle acceleration and speed.     Roll rate sensor: similar to the yaw rate sensor in design but improves the fidelity of the controller''s vehicle model and correct for errors when estimating vehicle behavior from the other sensors alone.  ESC uses a hydraulic modulator to assure that each wheel receives the correct brake force. A similar modulator is used in ABS. ABS needs to reduce pressure during braking, only. ESC additionally needs to increase pressure in certain situations and an active vacuum brake booster unit may be utilized in addition to the hydraulic pump to meet these demanding pressure gradients.  The brain of the ESC system is the electronic control unit (ECU). The various control techniques are embedded in it. Often, the same ECU is used for diverse systems at the same time (ABS, Traction control system, climate control, etc.). The input signals are sent through the input-circuit to the digital controller. The desired vehicle state is determined based upon the steering wheel angle, its gradient and the wheel speed. Simultaneously, the yaw sensor measures the actual state. The controller computes the needed brake or acceleration force for each wheel and directs via the driver circuits the valves of the hydraulic modulator. Via a Controller Area Network interface the ECU is connected with other systems (ABS, etc.) in order to avoid giving contradictory commands.  The parts assoiated with this system usually include : actuators, bolts, bushes, insulator, sensors, ECU, wiring and harnesses, modulators, fuses, and nuts. It is often included as standard on most modern vehicles although can be considered an option under cheaper cars. Each car brand refers to the system under a different name, although they all have the same functionality. ', 2, 1414829249, 2, 1415159823, 2),
(46, 'Fuel Filter/Strainer', 'A fuel filter is a filter in the fuel line that screens out dirt and rust particles from the fuel, normally made into cartridges containing a filter paper. They are found in most internal combustion engines.  Fuel filters serve a vital function in today''s modern, tight-tolerance engine fuel systems. Unfiltered fuel may contain several kinds of contamination, for example paint chips and dirt that has been knocked into the tank while filling, or rust caused by moisture in a steel tank. If these substances are not removed before the fuel enters the system, they will cause rapid wear and failure of the fuel pump and injectors, due to the abrasive action of the particles on the high-precision components used in modern injection systems. Fuel filters also improve performance, as the fewer contaminants present in the fuel, the more efficiently it can be burnt.  Fuel filters need to be maintained at regular intervals. This is usually a case of simply disconnecting the filter from the fuel line and replacing it with a new one, although some specially designed filters can be cleaned and reused many times. If a filter is not replaced regularly it may become clogged with contaminants and cause a restriction in the fuel flow, causing an appreciable drop in engine performance as the engine struggles to draw enough fuel to continue running normally.  Some filters, especially found on diesel engines, are of a bowl-like design which collect water in the bottom (as water is more dense than diesel). The water can then be drained off by opening a valve in the bottom of the bowl and letting it run out, until the bowl contains only diesel. Many fuel filters contain a water sensor to signal to the engine control unit or directly to the driver (lamp on dashboard) if the water reach the warning level. It is especially undesirable for water in fuel to be drawn into a diesel engine fuel system, as the system relies on the diesel for lubrication of the moving parts, and if water gets into a moving part which requires constant lubrication (for example an injector valve), it will quickly cause overheating and unnecessary wear. This type of filter may also include a sensor, which will alert the operator when the filter needs to be drained. In proximity of the diesel fuel filter there might be a fuel heater to avoid the forming of paraffin wax (in case of low temperatures) inside the filtrating element which can stop the fuel flow to the engine. The parts usually contain: Strainers and heaters, fuel filter cartridge, brackets, clips, screws and grommets', 1, 1414903013, 2, 1414903013, 2),
(47, 'Windshield', 'Modern windshields are generally made of laminated safety glass, a type of treated glass, which consists of two (typically) curved sheets of glass with a plastic layer laminated between them for safety, and are bonded into the window frame. Motorbike windshields are often made of high-impact acrylic plastic. Windshields protect the vehicle''s occupants from wind and flying debris such as dust, insects, and rocks, and providing an aerodynamically formed window towards the front. UV coating may be applied to screen out harmful ultraviolet radiation. The glass maya also be heated, cooled, contain antennas or sensors and may be tinted or treated accordingly. They must be fitted to strict vehicle specifications and must be sealed to ensure no contaminates can enter the vehicle''s interior. Widnshields come as one piece and may contain a frame or the seals used to secure the windhisled to the chassis.', 3, 1414903650, 2, 1414903650, 2),
(48, 'Windscreen Wipers', 'A wiper generally consists of an arm, pivoting at one end and with a long rubber blade attached to the other. The blade is swung back and forth over the glass, pushing water from its surface. The speed is normally adjustable, with several continuous speeds and often one or more "intermittent" settings. Most automobiles use two synchronized radial type arms, while many commercial vehicles use one or more pantograph arms.Wipers may be powered by a variety of means, although most in use today are powered by an electric motor through a series of mechanical components, typically two 4-bar linkages in series or parallel.  Vehicles with air operated brakes sometimes use pneumatic wipers, powered by tapping a small amount of pressurized air from the brake system to a small air operated motor mounted on or just above the windscreen. These wipers are activated by opening a valve which allows pressurized air to enter the motor. There are several different configurations that may be observed with windscreen wipers and each have different components in use. The most typical parts of a windscreen wiper consist of the following : motors, arms, blades, brackets, bolts, reservoirs, pumps, pipes, nozzles, cables and sensors.', 2, 1414910024, 2, 1414910024, 2),
(49, 'Steering Column', 'The automotive steering column is a device intended primarily for connecting the steering wheel to the steering mechanism or transferring the driver''s input torque from the steering wheel. A steering column may also perform the following secondary functions: energy dissipation management in the event of a frontal collision; provide mounting for: the multi-function switch, column lock, column wiring, column shroud(s), transmission gear selector, gauges or other instruments as well as the electro motor and gear units found in EPAS and SbW systems;     offer (height and/or length) adjustment to suit driver preference. The sterring column consits of:  bushings, shafts, bolts, levers, springs and locks. The steering shaft is attached to the column as well. ', 1, 1414995503, 2, 1414995503, 2),
(50, 'Fuel Tank', 'For each new vehicle a specific fuel system is developed, to optimize the use of available space. Moreover, for one car model, different fuel system architectures are developed, depending on the type of the car, the type of fuel (gasoline or diesel), nozzle models, and region.  Two technologies are used to make fuel tanks for automobiles: Plastic high-density polyethylene (HDPE) fuel tanks. This technology is increasingly used as it now shows its capacity to obtain very low emissions of fuel. HDPE can also take complex shapes, allowing the tank to be mounted directly over the rear axle, saving space and improving crash safety. Metal (steel or aluminum) fuel tanks welded from stamped sheets. Although this technology is very good in limiting fuel emissions, it tends to be less competitive and thus less on the market.  Modern cars often feature remote opening of the fuel tank fuel filler flap using an electric motor or cable release. For both convenience and security, many modern fuel tanks cannot be opened by hand or otherwise from the outside of the car. The fuel tank assembly is used in tandem with the piping, through to the engine, as well as the fuel filtration system. The fuel tank assembly usually incorporates : fuel tank, grommets, seals, vent pipes, caps, clips,nuts,spacers and plates.', 1, 1415067824, 2, 1415067824, 2),
(51, 'Other Mechanical Items', 'A list of parts that are not included with a vehicle from manufacture, but may be added as aftermarket accessories or options. This can include: nuts, bolts, plug ins, aesthetic additions, accessories, upgrades and supplements. ', 1, 1415071845, 2, 1415071906, 2),
(52, 'Other Electrical Items', 'A list of parts that are not included with a vehicle from manufacture, but may be added as aftermarket accessories or options. This can include: nuts, bolts, plug ins, aesthetic additions, accessories, upgrades and supplements. ', 2, 1415071882, 2, 1415071882, 2),
(53, 'Other Exterior Items', 'A list of parts that are not included with a vehicle from manufacture, but may be added as aftermarket accessories or options. This can include: nuts, bolts, plug ins, aesthetic additions, accessories, upgrades and supplements. ', 3, 1415071982, 2, 1415071982, 2),
(54, 'Other Interior Items', 'A list of parts that are not included with a vehicle from manufacture, but may be added as aftermarket accessories or options. This can include: nuts, bolts, plug ins, aesthetic additions, accessories, upgrades and supplements. ', 4, 1415072019, 2, 1415072019, 2),
(55, 'Exhaust System', 'An exhaust system is usually piping used to guide reaction exhaust gases away from a controlled combustion inside an engine. The entire system conveys burnt gases from the engine and includes one or more exhaust pipes. Depending on the overall system design, the exhaust gas may flow through one or more of: Cylinder head and exhaust manifold, A turbocharger to increase engine power. A catalytic converter to reduce air pollution. A muffler to reduce noise. The parts that are associated include: guide rails, clamps, nuts, mountings, gaskets and sensors, This then follows through to the Muffler. Each car must have an exhaust system that complies with rules and regulations and must be checked regularly to ensure that it complies with emission standards.', 1, 1415075938, 2, 1415075938, 2),
(56, 'Braking System', 'A brake is a mechanical device which inhibits motion, slowing or stopping a moving object or preventing its motion. When the brake pedal of a modern vehicle with hydraulic brakes is pushed, ultimately a piston pushes the brake pad against the brake disc which slows the wheel down. On the brake drum it is similar as the cylinder pushes the brake shoes against the drum which also slows the wheel down.Friction (pad/shoe) brakes are often rotating devices with a stationary pad and a rotating wear surface. Common configurations include shoes that contract to rub on the outside of a rotating drum, such as a band brake; a rotating drum with shoes that expand to rub the inside of a drum, commonly called a "drum brake", although other drum configurations are possible; and pads that pinch a rotating disc, commonly called a "disc brake".Electromagnetic brakes are likewise often used where an electric motor is already part of the machinery. For example, many hybrid gasoline/electric vehicles use the electric motor as a generator to charge electric batteries and also as a regenerative brake. The parts that are associated with the braking system includes : rotors, discs or drums, calipers, caliper housing, pads, sensors, paste, carriers, protection plate, dust caps, bleeder valves, bolts, repair kits, clips, bolts, seals and pistons. Each wheel must have a brake system associated with it. Thus this is replicated 4 times around a stereotypical vehicle. Particular wear in this area needs to be monitored and documented in order for it to comply with Rules and Regulations and safety. The pads and rotors need to be replaced accordingly.', 1, 1415166381, 2, 1415166381, 2);

-- --------------------------------------------------------

--
-- Table structure for table `part_type_cat`
--

CREATE TABLE IF NOT EXISTS `part_type_cat` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `part_type_cat`
--

INSERT INTO `part_type_cat` (`id`, `name`) VALUES
(1, 'Mechanical'),
(2, 'Electrical'),
(3, 'Exterior'),
(4, 'Interior');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(12) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `finish_date` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `description` varchar(400) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by_id` int(11) unsigned DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  `last_edit_by_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vehicle_id` (`vehicle_id`),
  KEY `fk_added_by9` (`added_by_id`),
  KEY `fk_added_by21` (`last_edit_by_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_change_soon`
--

CREATE TABLE IF NOT EXISTS `service_change_soon` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `service_id` int(12) DEFAULT NULL,
  `old_part_id` int(8) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by_id` int(11) unsigned DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  `last_edit_by_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_service_change_soon` (`service_id`,`old_part_id`),
  KEY `fk_part2` (`old_part_id`),
  KEY `fk_added_by10` (`added_by_id`),
  KEY `fk_added_by22` (`last_edit_by_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_entry`
--

CREATE TABLE IF NOT EXISTS `service_entry` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `service_id` int(12) DEFAULT NULL,
  `service_entry_cat_id` int(2) DEFAULT NULL,
  `description` varchar(4000) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by_id` int(11) unsigned DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  `last_edit_by_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_service_id2` (`service_id`),
  KEY `fk_service_entry_cat` (`service_entry_cat_id`),
  KEY `fk_added_by11` (`added_by_id`),
  KEY `fk_added_by23` (`last_edit_by_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `service_entry_cat`
--

CREATE TABLE IF NOT EXISTS `service_entry_cat` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `service_entry_cat`
--

INSERT INTO `service_entry_cat` (`id`, `name`) VALUES
(1, 'Mechanical'),
(2, 'Electrical'),
(3, 'Exterior'),
(4, 'Interior');

-- --------------------------------------------------------

--
-- Table structure for table `service_part_changed`
--

CREATE TABLE IF NOT EXISTS `service_part_changed` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `service_id` int(12) DEFAULT NULL,
  `old_part_id` int(8) DEFAULT NULL,
  `new_part_id` int(8) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by_id` int(11) unsigned DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  `last_edit_by_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_service_part_changed` (`service_id`,`old_part_id`),
  KEY `fk_part3` (`old_part_id`),
  KEY `fk_part4` (`new_part_id`),
  KEY `fk_added_by12` (`added_by_id`),
  KEY `fk_added_by24` (`last_edit_by_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `suburb` varchar(25) DEFAULT NULL,
  `postcode` int(4) unsigned DEFAULT NULL,
  `state` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `address`, `suburb`, `postcode`, `state`) VALUES
(1, '120.150.208.207', 'administrator', '$2y$08$lvuDOM5Zpj3.XO2cgSp3heqUdqxPzcJ1SbUWSpgX6eyenMM81igiC', '', 'andrew@emoceanstudios.com.au', '', NULL, NULL, 'b834de77405037c6e4931967e32d88b92a15e319', 1268889823, 1415166559, 1, 'Andrew', 'Liu', 'Emocean Mechanic Company', '0296309992', '411 Church St', 'Parramatta', 2150, 'NSW'),
(2, '120.150.208.207', 'alex test', '$2y$08$RD62IYWX1S5.BELNQOGxqOgdQCzG.9Il7b2jt6DZkPWZ/ODeu4Jim', NULL, 'alexb92@gmail.com', NULL, NULL, NULL, '272a93397816fa15904b76c3b33cedf0148adb69', 1401347878, 1416888844, 1, 'Alex', 'Test', 'Loggy Australia', '12345678', NULL, NULL, NULL, NULL),
(3, '203.213.224.48', 'andrew liu', '$2y$08$hEljEC3zNBBMa2PIu7mMUu54fxdWZXpBCh/uPWAQbpbYjA4lyKtsm', NULL, 'lrq663611@gmail.com', NULL, NULL, NULL, NULL, 1413978873, 1413978900, 1, 'Andrew', 'Liu', 'Emocean', '1234567890', '11 mary st', 'RHODES', 2138, 'NSW');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 3, 2),
(6, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `rego_num` varchar(10) DEFAULT NULL,
  `vin` varchar(40) DEFAULT NULL,
  `engine_num` varchar(40) DEFAULT NULL,
  `vehicle_model_id` int(8) DEFAULT NULL,
  `body_type` varchar(100) DEFAULT NULL,
  `drive_type` varchar(100) DEFAULT NULL,
  `transmission` varchar(100) DEFAULT NULL,
  `engine` varchar(100) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `owner_id` int(11) unsigned DEFAULT NULL,
  `note` varchar(400) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by_id` int(11) unsigned DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  `last_edit_by_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_owner` (`owner_id`),
  KEY `fk_added_by6` (`added_by_id`),
  KEY `fk_vehicle_model1` (`vehicle_model_id`),
  KEY `fk_added_by18` (`last_edit_by_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_make`
--

CREATE TABLE IF NOT EXISTS `vehicle_make` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by_id` int(11) unsigned DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  `last_edit_by_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_added_by4` (`added_by_id`),
  KEY `fk_added_by16` (`last_edit_by_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `vehicle_make`
--

INSERT INTO `vehicle_make` (`id`, `name`, `added`, `added_by_id`, `last_edit`, `last_edit_by_id`) VALUES
(1, 'BMW', 1414025095, 2, 1414025095, 2),
(2, 'Audi', 1414025107, 2, 1414025107, 2),
(3, 'Toyota', 1414025122, 2, 1414025122, 2),
(4, 'Holden', 1414025136, 2, 1414025136, 2),
(5, 'Ford', 1414025149, 2, 1414025149, 2),
(6, 'Citroen', 1414025163, 2, 1414025163, 2),
(7, 'Suzuki', 1414025176, 2, 1414025176, 2),
(8, 'Mitsubishi', 1414025191, 2, 1414025191, 2),
(9, 'Kia', 1414025208, 2, 1414025208, 2),
(10, 'Jaguar', 1414025227, 2, 1414025227, 2),
(11, 'Skoda', 1414025280, 2, 1414025280, 2),
(12, 'Ferrari', 1414025303, 2, 1414025303, 2),
(13, 'Mercedes-Benz', 1414025329, 2, 1414025329, 2),
(14, 'Proton', 1414025345, 2, 1414025345, 2),
(15, 'Honda', 1414025370, 2, 1414025370, 2),
(16, 'Volvo', 1414025383, 2, 1414025383, 2),
(17, 'Nissan', 1414025400, 2, 1414025400, 2),
(18, 'Volkswagen', 1414025428, 2, 1414025428, 2),
(19, 'Lamborghini', 1414025449, 2, 1414025449, 2),
(20, 'Hyundai', 1414025463, 2, 1414025463, 2),
(21, 'Fiat', 1414025479, 2, 1414025479, 2),
(22, 'Dodge', 1414025500, 2, 1414025500, 2),
(23, 'Mazda', 1414025533, 2, 1414025533, 2),
(24, 'Subaru', 1414025552, 2, 1414025552, 2),
(25, 'Jeep', 1414025573, 2, 1414025573, 2),
(26, 'Great Wall Motors', 1414025597, 2, 1414025597, 2),
(27, 'Tata', 1414025634, 2, 1414025634, 2),
(28, 'Porsche', 1414025656, 2, 1414025656, 2),
(29, 'Renault', 1414025677, 2, 1414025677, 2),
(30, 'Peugeot', 1414025694, 2, 1414025694, 2),
(31, 'Smart', 1414025707, 2, 1414025707, 2),
(32, 'Tesla', 1414025731, 2, 1414025731, 2),
(33, 'Aston Martin', 1414025815, 2, 1414025815, 2),
(34, 'Alfa Romeo', 1414025829, 2, 1414025829, 2),
(35, 'Chrysler', 1414025865, 2, 1414025865, 2),
(36, 'Bentley', 1414025924, 2, 1414025924, 2),
(37, 'Chery', 1414025955, 2, 1414025955, 2),
(38, 'Chevrolet', 1414025971, 2, 1414025971, 2),
(39, 'Ford Performance Vehicles (FPV)', 1414026029, 2, 1414026029, 2),
(40, 'Fuso', 1414026060, 2, 1414026060, 2),
(41, 'Foton', 1414026080, 2, 1414026080, 2),
(42, 'Hino', 1414026116, 2, 1414026116, 2),
(43, 'Holden Special Vehicles (HSV)', 1414026144, 2, 1414026144, 2),
(44, 'Isuzu', 1414026179, 2, 1414026179, 2),
(45, 'Infiniti', 1414026200, 2, 1414026200, 2),
(46, 'Land Rover', 1414026248, 2, 1414026248, 2),
(47, 'Lotus', 1414026264, 2, 1414026264, 2),
(48, 'Lexus', 1414026283, 2, 1414026283, 2),
(49, 'Maserati', 1414026318, 2, 1414026318, 2),
(50, 'Mahindra', 1414026353, 2, 1414026353, 2),
(51, 'McLaren', 1414026374, 2, 1414026374, 2),
(52, 'Caterham', 1414026392, 2, 1414026392, 2),
(53, 'Morgan', 1414026416, 2, 1414026416, 2),
(54, 'Mini', 1414026449, 2, 1414026449, 2),
(55, 'Opel', 1414026466, 2, 1414026466, 2),
(56, 'Rolls-Royce', 1414026515, 2, 1414026515, 2),
(57, 'Ssangyong', 1414026778, 2, 1414026778, 2),
(58, 'Abarth', 1414026889, 2, 1414026889, 2),
(59, 'Iveco', 1414066504, 2, 1414066504, 2),
(60, 'Mercedes - Benz Trucks', 1414066520, 2, 1414066520, 2),
(61, 'Mitsubishi Trucks', 1414066549, 2, 1414066549, 2),
(62, 'MACK', 1414066639, 2, 1414066639, 2),
(63, 'Volvo Trucks', 1414066650, 2, 1414066650, 2),
(64, 'Freightliner', 1414066671, 2, 1414066671, 2);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_model`
--

CREATE TABLE IF NOT EXISTS `vehicle_model` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `vehicle_make_id` int(8) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `name` varchar(400) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by_id` int(11) unsigned DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  `last_edit_by_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vehicle_make` (`vehicle_make_id`),
  KEY `fk_added_by5` (`added_by_id`),
  KEY `fk_added_by17` (`last_edit_by_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vehicle_model`
--

INSERT INTO `vehicle_model` (`id`, `vehicle_make_id`, `year`, `name`, `added`, `added_by_id`, `last_edit`, `last_edit_by_id`) VALUES
(1, 18, 2014, 'Taigun', 1416110984, 2, 1416110995, 2);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_model_part`
--

CREATE TABLE IF NOT EXISTS `vehicle_model_part` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `vehicle_model_id` int(8) DEFAULT NULL,
  `part_id` int(8) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `added_by_id` int(11) unsigned DEFAULT NULL,
  `last_edit` int(11) DEFAULT NULL,
  `last_edit_by_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_vehicle_model_part` (`vehicle_model_id`,`part_id`),
  KEY `fk_added_by7` (`added_by_id`),
  KEY `fk_part1` (`part_id`),
  KEY `fk_added_by19` (`last_edit_by_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vehicle_model_part`
--

INSERT INTO `vehicle_model_part` (`id`, `vehicle_model_id`, `part_id`, `is_default`, `added`, `added_by_id`, `last_edit`, `last_edit_by_id`) VALUES
(1, 1, NULL, 1, 1416110984, 2, 1416110984, 2),
(2, 1, NULL, 1, 1416110996, 2, 1416110996, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `fk_added_by1` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_added_by15` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_part_group` FOREIGN KEY (`part_group_id`) REFERENCES `part_group` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_part_manufacture` FOREIGN KEY (`part_manufacture_id`) REFERENCES `part_manufacture` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_part_type` FOREIGN KEY (`part_type_id`) REFERENCES `part_type` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `part_manufacture`
--
ALTER TABLE `part_manufacture`
  ADD CONSTRAINT `fk_added_by13` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_added_by2` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `part_type`
--
ALTER TABLE `part_type`
  ADD CONSTRAINT `fk_added_by14` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_added_by3` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_part_type_cat` FOREIGN KEY (`part_type_cat_id`) REFERENCES `part_type_cat` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `fk_added_by21` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_added_by9` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `service_change_soon`
--
ALTER TABLE `service_change_soon`
  ADD CONSTRAINT `fk_added_by10` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_added_by22` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_part2` FOREIGN KEY (`old_part_id`) REFERENCES `part` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_service_id1` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_entry`
--
ALTER TABLE `service_entry`
  ADD CONSTRAINT `fk_added_by11` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_added_by23` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_service_entry_cat` FOREIGN KEY (`service_entry_cat_id`) REFERENCES `service_entry_cat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_service_id2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_part_changed`
--
ALTER TABLE `service_part_changed`
  ADD CONSTRAINT `fk_added_by12` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_added_by24` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_part3` FOREIGN KEY (`old_part_id`) REFERENCES `part` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_part4` FOREIGN KEY (`new_part_id`) REFERENCES `part` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_service_id3` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `fk_added_by18` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_added_by6` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_owner` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vehicle_model` FOREIGN KEY (`vehicle_model_id`) REFERENCES `vehicle_model` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `vehicle_make`
--
ALTER TABLE `vehicle_make`
  ADD CONSTRAINT `fk_added_by16` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_added_by4` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `vehicle_model`
--
ALTER TABLE `vehicle_model`
  ADD CONSTRAINT `fk_added_by17` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_added_by5` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vehicle_make` FOREIGN KEY (`vehicle_make_id`) REFERENCES `vehicle_make` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `vehicle_model_part`
--
ALTER TABLE `vehicle_model_part`
  ADD CONSTRAINT `fk_added_by19` FOREIGN KEY (`last_edit_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_added_by7` FOREIGN KEY (`added_by_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_part` FOREIGN KEY (`part_id`) REFERENCES `part` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vehicle_model2` FOREIGN KEY (`vehicle_model_id`) REFERENCES `vehicle_model` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
