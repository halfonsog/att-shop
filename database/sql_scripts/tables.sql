DROP TABLE IF EXISTS paymethods;
DROP TABLE IF EXISTS commissions;
DROP TABLE IF EXISTS cart_items;
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS suppliers;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS suppliers;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS recipients;
DROP TABLE IF EXISTS municipalities;
DROP TABLE IF EXISTS provinces;
DROP TABLE IF EXISTS countries;

CREATE TABLE countries (
    id INT PRIMARY KEY,
    name VARCHAR(100)
);

CREATE TABLE provinces (
    id INT PRIMARY KEY,
    name VARCHAR(100)
);

CREATE TABLE municipalities (
    id INT PRIMARY KEY,
    prov_id INT,
    name VARCHAR(100)
);

CREATE TABLE users (
    usr_id VARCHAR(100) PRIMARY KEY,
    usr_pwd VARCHAR(255) NOT NULL,
    usr_type ENUM('customer','supplier','admin') DEFAULT 'customer',
    ent_id INT,
    rep ENUM('cfo','cco'),
    psw_hint VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150),
    role ENUM('commercial','it','business'),
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150),
    cco_name VARCHAR(150),
    cco_phone VARCHAR(20),
    cfo_name VARCHAR(150),
    cfo_phone VARCHAR(20),
    municipality INT,
    since INT,
    web VARCHAR(250),
    contract VARCHAR(20),
    wallet DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150),
    phone VARCHAR(20),
    country INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE recipients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    name VARCHAR(150),
    phone CHAR(8),    
    address1 VARCHAR(100),
    address2 VARCHAR(100),
    municipality INT,
    wallet DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
);

CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(255) NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    commission DECIMAL(10,2) DEFAULT 0,
    supplier_payment DECIMAL(10,2) DEFAULT 0,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE commissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    supplier_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending','paid') DEFAULT 'pending',
    payment_date TIMESTAMP NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
);

CREATE TABLE paymethods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mode ENUM('card','platform') DEFAULT 'card',
    name VARCHAR(100),
    commission DECIMAL(10,2),
    logo VARCHAR(255)
);

INSERT INTO paymethods (id,mode,name,commission,logo) VALUES
(1, 'card', 'Visa', 2.99, 'images/paylogos/visa.png'),
(2, 'card', 'MaterCard', 2.99, 'images/paylogos/mastercard.png'),
(3, 'card', 'DinersClub', 3.99, 'images/paylogos/dinersclub.png'),
(4, 'platform', 'TropiPay', 1.18, 'images/paylogos/tropipay.png');


INSERT INTO countries (id,name) VALUES
(1, 'Estados Unidos'),
(2, 'Canadad'),
(3, 'Mexico'),
(4, 'Panama'),
(5, 'Espana'),
(6, 'Italia'),
(7, 'Suiza');


INSERT INTO provinces (id, name) VALUES
(1, 'Pinar del Río'),
(2, 'Artemisa'),
(3, 'La Habana'),
(4, 'Mayabeque'),
(5, 'Matanzas'),
(6, 'Cienfuegos'),
(7, 'Villa Clara'),
(8, 'Sancti Spíritus'),
(9, 'Ciego de Ávila'),
(10, 'Camagüey'),
(11, 'Las Tunas'),
(12, 'Holguín'),
(13, 'Granma'),
(14, 'Santiago de Cuba'),
(15, 'Guantánamo'),
(16, 'Isla de la Juventud');


INSERT INTO municipalities (id, prov_id, name) VALUES

(1, 1, 'Consolación del Sur'),
(2, 1, 'Guane'),
(3, 1, 'La Palma'),
(4, 1, 'Los Palacios'),
(5, 1, 'Mantua'),
(6, 1, 'Minas de Matahambre'),
(7, 1, 'Pinar del Río'),
(8, 1, 'San Juan y Martínez'),
(9, 1, 'San Luis'),
(10, 1, 'Sandino'),
(11, 1, 'Viñales'),

(12, 2, 'Alquízar'),
(13, 2, 'Artemisa'),
(14, 2, 'Bahía Honda'),
(15, 2, 'Bauta'),
(16, 2, 'Caimito'),
(17, 2, 'Guanajay'),
(18, 2, 'Güira de Melena'),
(19, 2, 'Mariel'),
(20, 2, 'San Antonio de los Baños'),
(21, 2, 'San Cristóbal'),

(22, 3, 'Arroyo Naranjo'),
(23, 3, 'Boyeros'),
(24, 3, 'Centro Habana'),
(25, 3, 'Cerro'),
(26, 3, 'Cotorro'),
(27, 3, 'Diez de Octubre'),
(28, 3, 'Guanabacoa'),
(29, 3, 'La Habana del Este'),
(30, 3, 'La Habana Vieja'),
(31, 3, 'La Lisa'),
(32, 3, 'Marianao'),
(33, 3, 'Playa'),
(34, 3, 'Plaza de la Revolución'),
(35, 3, 'Regla'),
(36, 3, 'San Miguel del Padrón'),

(37, 4, 'Batabanó'),
(38, 4, 'Bejucal'),
(39, 4, 'Güines'),
(40, 4, 'Jaruco'),
(41, 4, 'Madruga'),
(42, 4, 'Melena del Sur'),
(43, 4, 'Nueva Paz'),
(44, 4, 'Quivicán'),
(45, 4, 'San José de las Lajas'),
(46, 4, 'San Nicolás'),
(47, 4, 'Santa Cruz del Norte'),

(48, 5, 'Calimete'),
(49, 5, 'Cárdenas'),
(50, 5, 'Ciudad de Matanzas'),
(51, 5, 'Colón'),
(52, 5, 'Jagüey Grande'),
(53, 5, 'Jovellanos'),
(54, 5, 'Limonar'),
(55, 5, 'Los Arabos'),
(56, 5, 'Martí'),
(57, 5, 'Pedro Betancourt'),
(58, 5, 'Perico'),
(59, 5, 'Unión de Reyes'),

(60, 6, 'Aguada de Pasajeros'),
(61, 6, 'Cienfuegos'),
(62, 6, 'Cruces'),
(63, 6, 'Cumanayagua'),
(64, 6, 'Lajas'),
(65, 6, 'Palmira'),
(66, 6, 'Rodas'),
(67, 6, 'Santa Isabel de las Lajas'),

(68, 7, 'Caibarién'),
(69, 7, 'Camajuaní'),
(70, 7, 'Cifuentes'),
(71, 7, 'Corralillo'),
(72, 7, 'Encrucijada'),
(73, 7, 'Manicaragua'),
(74, 7, 'Placetas'),
(75, 7, 'Quemado de Güines'),
(76, 7, 'Ranchuelo'),
(77, 7, 'Remedios'),
(78, 7, 'Sagua la Grande'),
(79, 7, 'Santa Clara'),
(80, 7, 'Santo Domingo'),

(81, 8, 'Cabaiguán'),
(82, 8, 'Fomento'),
(83, 8, 'Jatibonico'),
(84, 8, 'La Sierpe'),
(85, 8, 'Sancti Spíritus'),
(86, 8, 'Taguasco'),
(87, 8, 'Trinidad'),
(88, 8, 'Yaguajay'),

(89, 9, 'Baraguá'),
(90, 9, 'Bolivia'),
(91, 9, 'Chambas'),
(92, 9, 'Ciego de Ávila'),
(93, 9, 'Ciro Redondo'),
(94, 9, 'Florencia'),
(95, 9, 'Majagua'),
(96, 9, 'Morón'),
(97, 9, 'Primero de Enero'),
(98, 9, 'Venezuela'),

(99, 10, 'Camagüey'),
(100, 10, 'Carlos M. de Céspedes'),
(101, 10, 'Esmeralda'),
(102, 10, 'Florida'),
(103, 10, 'Guáimaro'),
(104, 10, 'Jimaguayú'),
(105, 10, 'Minas'),
(106, 10, 'Najasa'),
(107, 10, 'Nuevitas'),
(108, 10, 'Santa Cruz del Sur'),
(109, 10, 'Sibanicú'),
(110, 10, 'Sierra de Cubitas'),
(111, 10, 'Vertientes'),

(112, 11, 'Amancio'),
(113, 11, 'Colombia'),
(114, 11, 'Jesús Menéndez'),
(115, 11, 'Jobabo'),
(116, 11, 'Las Tunas'),
(117, 11, 'Majibacoa'),
(118, 11, 'Manatí'),
(119, 11, 'Puerto Padre'),

(120, 12, 'Antilla'),
(121, 12, 'Báguanos'),
(122, 12, 'Banes'),
(123, 12, 'Cacocum'),
(124, 12, 'Calixto García'),
(125, 12, 'Cueto'),
(126, 12, 'Frank País'),
(127, 12, 'Gibara'),
(128, 12, 'Holguín'),
(129, 12, 'Mayarí'),
(130, 12, 'Moa'),
(131, 12, 'Rafael Freyre'),
(132, 12, 'Sagua de Tánamo'),
(133, 12, 'Urbano Noris'),

(134, 13, 'Bartolomé Masó'),
(135, 13, 'Bayamo'),
(136, 13, 'Buey Arriba'),
(137, 13, 'Campechuela'),
(138, 13, 'Cauto Cristo'),
(139, 13, 'Guisa'),
(140, 13, 'Jiguaní'),
(141, 13, 'Manzanillo'),
(142, 13, 'Media Luna'),
(143, 13, 'Niquero'),
(144, 13, 'Pilón'),
(145, 13, 'Río Cauto'),
(146, 13, 'Yara'),

(147, 14, 'Contramaestre'),
(148, 14, 'Guamá'),
(149, 14, 'Mella'),
(150, 14, 'Palma Soriano'),
(151, 14, 'San Luis'),
(152, 14, 'Santiago de Cuba'),
(153, 14, 'Segundo Frente'),
(154, 14, 'Songo-La Maya'),
(155, 14, 'Tercer Frente'),

(156, 15, 'Baracoa'),
(157, 15, 'Caimanera'),
(158, 15, 'El Salvador'),
(159, 15, 'Guantánamo'),
(160, 15, 'Imías'),
(161, 15, 'Maisí'),
(162, 15, 'Manuel Tames'),
(163, 15, 'Niceto Pérez'),
(164, 15, 'San Antonio del Sur'),
(165, 15, 'Yateras'),

-- Isla de la Juventud (16)
(168, 16, 'Isla de la Juventud');


