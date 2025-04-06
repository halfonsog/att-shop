DROP TABLE IF EXISTS paymethods;
DROP TABLE IF EXISTS commissions;
DROP TABLE IF EXISTS cart_items;
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS warehouse_products;
DROP TABLE IF EXISTS product_types;
DROP TABLE IF EXISTS prod_food;
DROP TABLE IF EXISTS prod_beverages;
DROP TABLE IF EXISTS prod_appliances;
DROP TABLE IF EXISTS prod_generators;
DROP TABLE IF EXISTS prod_computers;
DROP TABLE IF EXISTS price_history;
DROP TABLE IF EXISTS stock_history;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS department_categories;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS departments;
DROP TABLE IF EXISTS collection_points;
DROP TABLE IF EXISTS warehouses;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS suppliers;
DROP TABLE IF EXISTS transporters;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS recipients;
DROP TABLE IF EXISTS municipalities;
DROP TABLE IF EXISTS provinces;
DROP TABLE IF EXISTS countries;
DROP VIEW IF EXISTS department_categories_view;
DROP VIEW IF EXISTS category_products_view;

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
    usr VARCHAR(50) PRIMARY KEY,
    psw VARCHAR(255) NOT NULL,
    ent_id INT,
    role ENUM('customer','supplier','transporter','admin') DEFAULT 'customer',
    is_active BOOLEAN DEFAULT FALSE,
    rep ENUM('cfo','cco') DEFAULT NULL,
    psw_hint VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150),
    permissions JSON DEFAULT NULL COMMENT 'Admin permissions',
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150),
    brand_name VARCHAR(50),
    cco_name VARCHAR(150),
    cco_phone VARCHAR(20),
    cfo_name VARCHAR(150),
    cfo_phone VARCHAR(20),
    municipality INT,
    is_approved BOOLEAN DEFAULT FALSE,
    since TIMESTAMP,
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

CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    icon VARCHAR(50),
    description VARCHAR(255)
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_id INT NULL,
    title VARCHAR(50),
    description VARCHAR(255)
);

CREATE TABLE department_categories (
    department_id INT,
    category_id INT,
    icon VARCHAR(50),
    PRIMARY KEY (department_id, category_id)
);


CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    type ENUM('generic','food','beverages','computers','appliances','generators'),
    title VARCHAR(100),
    condition_pack ENUM('open','sealed', 'fragile'),
    source ENUM('local','import'),
    description TEXT,
    base_price DECIMAL(10,2),
    price DECIMAL(10,2),
    min_order INT DEFAULT 1,
    clicks INT DEFAULT 0,
    images INT DEFAULT 1,
    gross_volume INT,
    gross_weight INT,
    is_promoted BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT FALSE,
    active_at TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE prod_appliances (
    product_id INT PRIMARY KEY,
    voltage ENUM('110V','220V','Dual'),
    power DECIMAL(10,2),
    is_rechargeable BOOLEAN DEFAULT FALSE
 );

CREATE TABLE prod_computers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    ram INT,
    storage INT,
    display INT,
    camera INT DEFAULT 0,
    device ENUM('server','desktop', 'laptop', 'tablet', 'phone'),
    tech_base ENUM('windows','Apple', 'Linux', 'Android')
);

CREATE TABLE prod_food (
    product_id INT PRIMARY KEY,
    content_value DECIMAL(10,2),
    content_unit ENUM('g', 'oz', 'lb', 'kg'),
    condition_cool ENUM('fresh', 'cool', 'frozen')
);

CREATE TABLE prod_beverages (
    product_id INT PRIMARY KEY,
    content_value DECIMAL(10,2),
    content_unit ENUM('ml', 'fl-oz', 'l', 'gallon'),
    condition_cool ENUM('fresh', 'cool')
);

CREATE TABLE prod_generators (
    product_id INT PRIMARY KEY,
    fuel ENUM('sun','air','diesel', 'petrol', 'gas', 'petrol-gas'),
    power_out INT,
    power_pick INT,
    voltage ENUM('110V','220V 2-phase','220V','220V 3-phase','380V 3-phase')
);

CREATE TABLE product_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product VARCHAR(50),
    categories VARCHAR(255)
);

CREATE TABLE price_history (
    id INT PRIMARY KEY,
    product_id INT,
    old_price DECIMAL(10,2),
    new_price DECIMAL(10,2),
    changed_by VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE stock_history (
    id INT PRIMARY KEY,
    warehouse_id INT,
    product_id INT,
    old_stock INT,
    new_stock INT,
    change_reason ENUM('restock', 'adjustment', 'expiration'),
    changed_by VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE warehouses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT,
    title VARCHAR(100),
    municipality INT,
    addr1 VARCHAR (100),
    addr2 VARCHAR (100)
);

CREATE TABLE collection_points (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT,
    title VARCHAR(100),
    municipality INT,
    addr1 VARCHAR (100),
    addr2 VARCHAR (100)
);

CREATE TABLE warehouse_products (
    warehouse_id INT,
    product_id INT,
    stock INT,
    PRIMARY KEY (warehouse_id, product_id)
);

CREATE TABLE Transporters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT,
    title VARCHAR(100),
    phone INT,
    municipality INT,
    fresh_volume INT,
    fresh_weight INT,
    fresh_rate DECIMAL(10,2),
    cool_volume INT,
    cool_weight INT,
    cool_rate DECIMAL(10,2),
    frozen_volume INT,
    frozen_weight INT,
    frozen_rate DECIMAL(10,2),
    fresh_municipalities VARCHAR(100),
    cool_municipalities VARCHAR(100),
    frozen_municipalities VARCHAR(100)
 );

CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(255) NOT NULL,
    product_id INT,
    quantity INT DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100),
    customer_email VARCHAR(100),
    total DECIMAL(10,2),
    commission DECIMAL(10,2) DEFAULT 0,
    supplier_payment DECIMAL(10,2) DEFAULT 0,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10,2)
);

CREATE TABLE commissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    supplier_id INT,
    amount DECIMAL(10,2),
    status ENUM('pending','paid') DEFAULT 'pending',
    payment_date TIMESTAMP NULL
);

CREATE TABLE paymethods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mode ENUM('card','platform') DEFAULT 'card',
    name VARCHAR(100),
    commission DECIMAL(10,2),
    logo VARCHAR(255)
);

CREATE VIEW department_categories_view AS 
SELECT 
    d.id AS department_id,
    d.title AS department_title,
    d.icon AS department_icon,
    c.id AS category_id,
    c.title AS category_title,
    c.description AS category_description,
    dc.icon AS category_icon_in_department
FROM 
    departments d
JOIN 
    department_categories dc ON d.id = dc.department_id
JOIN 
    categories c ON dc.category_id = c.id
ORDER BY 
    d.title, c.title;

CREATE VIEW category_products_view AS
SELECT 
    c.id AS category_id,
    c.title AS category_title,
    p.id AS product_id,
    p.title AS product_title,
    p.description AS product_description,
    p.base_price,
    p.price,
    p.condition_pack,
    p.clicks,
    p.images,
    p.is_promoted,
    p.is_active,
    pa.voltage,
    pa.power,
    pa.is_rechargeable
FROM 
    categories c
JOIN 
    products p ON c.id = p.category_id
LEFT JOIN 
    prod_appliances pa ON p.id = pa.product_id;


INSERT INTO admins (id,name,permissions,phone) VALUES
(1, 'Administrador general', '{"*": true}', '59874218');
INSERT INTO users (usr, psw, ent_id, role, is_active, psw_hint) VALUES 
('halfonsog@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1,'admin', 1, 'Just password as always!');

INSERT INTO departments (id,title,icon,description) VALUES
(1, 'Alimentos', 'dep_food', 'Alimentos frescos y procesados'),
(2, 'Electrónica', 'dep_elctronic', 'Equipos eléctricos, informáticos, telecomunicaciones y electrodomésticos'),
(3, 'Ferretería', 'dep_hardware', 'Materiales, herramientas y equipos para todo tipo de reparaciones o construcciones'),
(4, 'Moda', 'dep_hardware', 'Materiales, herramientas y equipos para todo tipo de reparaciones o construcciones'),
(5, 'Parafarmacia', 'dep_parapharmacy', 'Productos de higiene personal, cosmética y perfumería'),
(6, 'Hogar', 'dep_home', 'Limpieza e higiene del hogar, jardinería, muebles, electrodomésticos, decoración...');

INSERT INTO categories (id,parent_id,title,description) VALUES
(1,  null, 'Cárnicos','Carnes y productos cárnicos, así como frutos del mar'),
(2,  null, 'Bebidas','Bebidas naturales e industriales'),
(3,  null, 'Salsas','Salsas para cocinar y para llevar directamente a la mesa'),
(4,  null, 'Frescos del campo','Productos agícolas recien traidos del campo'),
(5,  null, 'De la granja','Productos láteos y huevos'),
(6,  null, 'Panadería','Productos horneados tanto salados como dulses'),
(7,  null, 'Pre/elaborados', 'Productos agícolas pre-elaborados y elaborados'),
(8,  null, 'Electrodomésticos','decripcion'),
(9,  null, 'Informática','Computadoras profesionales y para la casa, equipos de comunicaciones móviles e Internet'),
(10, null, 'Generadores','Sistemas de degeneración eléctrica. Uso residencial y profesional'),
(11, null, 'Aridos','Materiales para la construcción y el paisajismo'),
(12, null, 'Cementos','Cementos y morteros'),
(13, null, 'Herramientas','Todo tipo de herramientas de trabajo. Uso residencial y profesional');

INSERT INTO department_categories (department_id,category_id,icon) VALUES 
(1, 1, 'cat_meats'),
(1, 2, 'cat_beverages'),
(1, 3, 'cat_sauces'),
(1, 4, 'cat_fresh'),
(1, 5, 'cat_farm'),
(1, 6, 'cat_bakery'),
(1, 7, 'cat_processed'),
(2, 8, 'cat_appliances_general'),
(2, 9, 'cat_it_business'),
(2, 10, 'cat_power_business'),
(3, 10, 'cat_power_business'),
(3, 11, 'cat_aggregates'),
(3, 12, 'cat_cements'),
(6, 8, 'cat_appliances_home'),
(6, 9, 'cat_it_home'),
(6, 10, 'cat_power_home');

INSERT INTO product_types (id, product,categories) VALUES 
(0, 'generic','');
INSERT INTO product_types (product,categories) VALUES 
('food','1,3,4,5,6,7'),
('beverages','2'),
('computers','9'),
('appliances','8'),
('generators','10');


INSERT INTO paymethods (id,mode,name,commission,logo) VALUES
(1, 'card', 'Visa', 2.99, 'images/paylogos/visa.png'),
(2, 'card', 'MaterCard', 2.99, 'images/paylogos/mastercard.png'),
(3, 'card', 'DinersClub', 3.99, 'images/paylogos/dinersclub.png'),
(4, 'platform', 'TropiPay', 1.18, 'images/paylogos/tropipay.png');


INSERT INTO countries (id,name) VALUES
(1, 'Estados Unidos'),
(2, 'Canada'),
(3, 'Mexico'),
(4, 'Panama'),
(5, 'España'),
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


