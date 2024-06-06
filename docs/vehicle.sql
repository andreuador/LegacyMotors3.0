-- Agregar nuevas marcas con ID asignado
INSERT INTO `brand` (`id`, `name`) VALUES
                                       (1, 'Toyota'),
                                       (2, 'Ford'),
                                       (3, 'Honda'),
                                       (4, 'BMW'),
                                       (5, 'Mercedes-Benz'),
                                       (6, 'Volkswagen'),
                                       (7, 'Tesla'),
                                       (8, 'Nissan'),
                                       (9, 'Audi'),
                                       (10, 'Hyundai'),
                                       (11, 'Kia'),
                                       (12, 'Subaru'),
                                       (13, 'Mazda'),
                                       (14, 'Lexus'),
                                       (15, 'Ferrari'),
                                       (16, 'Porsche'),
                                       (17, 'Jaguar'),
                                       (18, 'Land Rover'),
                                       (19, 'Maserati'),
                                       (20, 'Bentley'),
                                       (21, 'Aston Martin'),
                                       (22, 'McLaren'),
                                       (23, 'Bugatti'),
                                       (24, 'Rolls-Royce'),
                                       (25, 'Lamborghini'),
                                       (26, 'Alfa Romeo'),
                                       (27, 'Lotus'),
                                       (28, 'Cadillac'),
                                       (29, 'Chevrolet');

-- Insertar nuevos modelos con las marcas actualizadas
INSERT INTO `model` (`name`, `year`, `brand_id`) VALUES
-- Toyota
('Supra', 2020, 1),
('Corolla', 2021, 1),
('2000GT', 1967, 1),
('Celica', 2000, 1),
-- Ford
('Mustang', 2020, 2),
('GT40', 1966, 2),
('Fiesta', 2021, 2),
-- Honda
('Civic Type R', 2021, 3),
('NSX', 2020, 3),
-- BMW
('507', 1956, 4),
('M1', 1981, 4),
('M3 E30', 1990, 4),
-- Mercedes-Benz
('Clase G', 2020, 5),
('300SL', 1954, 5),
('SLS AMG', 2010, 5),
-- Volkswagen
('Golf I GTI', 1976, 6),
('Golf IV R32', 2002, 6),
-- Tesla
('Roadster', 2022, 7),
('Cybertruck', 2023, 7),
-- Nissan
('Skyline GT-R (R34)', 1999, 8),
-- Audi
('R8', 2021, 9),
('Quattro', 1980, 9),
-- Hyundai
('IONIQ 5', 2021, 10),
-- Kia
('Stinger', 2021, 11),
-- Subaru
('WRX STI (Impreza)', 2021, 12),
-- Mazda
('Cosmo', 1967, 13),
('RX-7', 1993, 13),
('MX-5', 2019, 13),
-- Lexus
('RC F Track Edition', 2020, 14),
-- Ferrari
('250 GT California', 1957, 15),
('288 GTO', 1984, 15),
('F40', 1987, 15),
('Enzo', 2002, 15),
('Testarossa', 1984, 15),
-- Porsche
('924 Carrera GT', 1981, 16),
('911 GT3 RS', 2021, 16),
('959', 1986, 16),
-- Jaguar
('E-Type', 1961, 17),
('XJ220', 1992, 17),
-- Land Rover
('Range Rover Evoque', 2021, 18),
('Range Rover Velar', 2021, 18),
-- Maserati
('Ghibli', 2021, 19),
('Khamsin', 1974, 19),
-- Bentley
('EXP 10 Speed 6 Concept', 2015, 20),
-- Aston Martin
('DB5', 1964, 21),
('DBR1', 1959, 21),
('Victor', 2020, 21),
-- McLaren
('P1', 2013, 22),
('765LT', 2021, 22),
('Senna', 2018, 22),
-- Bugatti
('Veyron Super Sport', 2010, 23),
('Chiron Sport', 2018, 23),
-- Rolls-Royce
('Phantom III', 1936, 24),
-- Lamborghini
('Countach', 1985, 25),
('Aventador', 2021, 25),
('Huracan', 2021, 25),
('Urus', 2021, 25),
-- Alfa Romeo
('33 Stradale', 1967, 26),
-- Lotus
('Evora', 2021, 27),
('Elise', 2021, 27),
-- Cadillac
('CT5-V Blackwing', 2022, 28),
('DeVille Coupe', 1959, 28),
-- Chevrolet
('Corvette C6 ZR1', 2009, 29),
('Camaro Yenko', 2020, 29);

-- Insertar vehículos
INSERT INTO `vehicle` (`plate`, `fuel`, `color`, `engine`, `power`, `consumption`, `acceleration`, `description`, `is_deleted`, `provider_id`, `brand_id`, `price_per_day`, `transmission`, `model_id`) VALUES
-- Toyota
('ABC1234', 'Gasolina', 'Rojo', 'I4', '200HP', '8L/100km', '5.0s', 'Toyota Supra 2020', 0, 1, 1, 450, 'Manual', 41),
('DEF4567', 'Híbrido', 'Azul', 'I4', '140HP', '4L/100km', '8.0s', 'Toyota Corolla 2021', 0, 1, 1, 560, 'Automático', 42),
('GHI7899', 'Gasolina', 'Blanco', 'I6', '150HP', '9L/100km', '7.0s', 'Toyota 2000GT 1967', 0, 1, 1, 900, 'Manual', 43),
('JKL0127', 'Gasolina', 'Negro', 'I4', '140HP', '10L/100km', '8.5s', 'Toyota Celica 2000', 0, 1, 1, 600, 'Manual', 44),
-- Ford
('MNO3465', 'Gasolina', 'Rojo', 'V8', '450HP', '12L/100km', '4.2s', 'Ford Mustang 2020', 0, 2, 2, 720, 'Manual', 45),
('PQR6786', 'Gasolina', 'Azul', 'V8', '500HP', '15L/100km', '3.5s', 'Ford GT40 1966', 0, 2, 2, 600, 'Manual', 46),
('STU9015', 'Gasolina', 'Blanco', 'I3', '100HP', '6L/100km', '9.5s', 'Ford Fiesta 2021', 0, 2, 2, 550, 'Automático', 47),
-- Honda
('VWX2342', 'Gasolina', 'Rojo', 'I4', '320HP', '7L/100km', '5.7s', 'Honda Civic Type R 2021', 0, 3, 3, 400, 'Manual', 48),
('YZA5671', 'Gasolina', 'Negro', 'V6', '573HP', '11L/100km', '3.0s', 'Honda NSX 2020', 0, 3, 3, 850, 'Automático', 49),
-- BMW
('BCD8901', 'Gasolina', 'Azul', 'I6', '150HP', '12L/100km', '6.5s', 'BMW 507 1956', 0, 4, 4, 570, 'Manual', 50),
('EFG1232', 'Gasolina', 'Blanco', 'I6', '277HP', '11L/100km', '5.6s', 'BMW M1 1981', 0, 4, 4, 890, 'Manual', 51),
('HIJ4563', 'Gasolina', 'Negro', 'I4', '192HP', '9L/100km', '6.7s', 'BMW M3 E30 1990', 0, 4, 4, 965, 'Manual', 52),
-- Mercedes-Benz
('KLM7894', 'Gasolina', 'Negro', 'V8', '416HP', '12L/100km', '4.4s', 'Mercedes-Benz Clase G 2020', 0, 5, 5, 499, 'Automático', 53),
('NOP0125', 'Gasolina', 'Plata', 'I6', '215HP', '10L/100km', '7.4s', 'Mercedes-Benz 300SL 1954', 0, 5, 5, 670, 'Manual', 54),
('QRS3456', 'Gasolina', 'Rojo', 'V8', '563HP', '14L/100km', '3.7s', 'Mercedes-Benz SLS AMG 2010', 0, 5, 5, 870, 'Automático', 55),
-- Volkswagen
('TUV6787', 'Gasolina', 'Blanco', 'I4', '110HP', '8L/100km', '9.0s', 'Volkswagen Golf I GTI 1976', 0, 6, 6, 550, 'Manual', 56),
('WXY9018', 'Gasolina', 'Rojo', 'V6', '240HP', '10L/100km', '6.2s', 'Volkswagen Golf IV R32 2002', 0, 6, 6, 600, 'Manual', 57),
-- Tesla
('ZAB2349', 'Eléctrico', 'Negro', 'Eléctrico', '1020HP', '0 kWh/100km', '2.1s', 'Tesla Roadster 2022', 0, 7, 7, 800, 'Automático', 58),
('CDE5670', 'Eléctrico', 'Plata', 'Eléctrico', '800HP', '0 kWh/100km', '2.9s', 'Tesla Cybertruck 2023', 0, 7, 7, 850, 'Automático', 59),
-- Nissan
('FGH8901', 'Gasolina', 'Blanco', 'I6', '276HP', '10L/100km', '5.2s', 'Nissan Skyline GT-R (R34) 1999', 0, 8, 8, 540, 'Manual', 60),
-- Audi
('IJK1232', 'Gasolina', 'Rojo', 'V10', '602HP', '12L/100km', '3.2s', 'Audi R8 2021', 0, 9, 9, 680, 'Automático', 61),
('LMN4563', 'Gasolina', 'Blanco', 'I5', '197HP', '10L/100km', '7.1s', 'Audi Quattro 1980', 0, 9, 9, 660, 'Manual', 62),
-- Hyundai
('OPQ7894', 'Eléctrico', 'Plata', 'Eléctrico', '168HP', '0 kWh/100km', '7.4s', 'Hyundai IONIQ 5 2021', 0, 10, 10, 490, 'Automático', 63),
-- Kia
('RST0125', 'Gasolina', 'Rojo', 'V6', '365HP', '10L/100km', '4.9s', 'Kia Stinger 2021', 0, 11, 11, 650, 'Automático', 64),
-- Subaru
('UVW3455', 'Gasolina', 'Azul', 'Bóxer', '310HP', '10L/100km', '5.1s', 'Subaru WRX STI (Impreza) 2021', 0, 12, 12, 600, 'Manual', 65),
-- Mazda
('XYZ6786', 'Gasolina', 'Blanco', 'I4', '128HP', '8L/100km', '8.3s', 'Mazda Cosmo 1967', 0, 13, 13, 740, 'Manual', 66),
('ABC9017', 'Gasolina', 'Rojo', 'Wankel', '276HP', '12L/100km', '5.0s', 'Mazda RX-7 1993', 0, 13, 13, 630, 'Manual', 67),
('DEF2348', 'Gasolina', 'Negro', 'I4', '181HP', '7L/100km', '6.0s', 'Mazda MX-5 2019', 0, 13, 13, 700, 'Manual', 68),
-- Lexus
('GHI5679', 'Gasolina', 'Negro', 'V8', '472HP', '11L/100km', '4.2s', 'Lexus RC F Track Edition 2020', 0, 14, 14, 740, 'Automático', 69),
-- Ferrari
('JKL8900', 'Gasolina', 'Rojo', 'V12', '240HP', '15L/100km', '8.0s', 'Ferrari 250 GT California 1957', 0, 15, 15, 999, 'Manual', 70),
('MNO1230', 'Gasolina', 'Rojo', 'V8', '400HP', '13L/100km', '4.9s', 'Ferrari 288 GTO 1984', 0, 15, 15, 800, 'Manual', 71),
('PQR4567', 'Gasolina', 'Rojo', 'V8', '478HP', '15L/100km', '4.1s', 'Ferrari F40 1987', 0, 15, 15, 900, 'Manual', 72),
('STU7897', 'Gasolina', 'Rojo', 'V12', '660HP', '17L/100km', '3.4s', 'Ferrari Enzo 2002', 0, 15, 15, 999, 'Automático', 73),
('VWX0126', 'Gasolina', 'Rojo', 'V12', '390HP', '14L/100km', '5.2s', 'Ferrari Testarossa 1984', 0, 15, 15, 700, 'Manual', 74),
-- Porsche
('YZA3456', 'Gasolina', 'Rojo', 'I4', '210HP', '10L/100km', '6.0s', 'Porsche 924 Carrera GT 1981', 0, 1, 16, 590, 'Manual', 75),
('BCD6784', 'Gasolina', 'Blanco', 'H6', '520HP', '13L/100km', '3.2s', 'Porsche 911 GT3 RS 2021', 0, 1, 16, 710, 'Automático', 76),
('EFG9013', 'Gasolina', 'Gris', 'H6', '450HP', '12L/100km', '3.7s', 'Porsche 959 1986', 0, 1, 16, 600, 'Manual', 77),
-- Jaguar
('HIJ2342', 'Gasolina', 'Verde', 'I6', '265HP', '11L/100km', '7.0s', 'Jaguar E-Type 1961', 0, 2, 17, 710, 'Manual', 78),
('KLM5672', 'Gasolina', 'Plata', 'V6', '542HP', '12L/100km', '3.6s', 'Jaguar XJ220 1992', 0, 2, 17, 600, 'Manual', 79),
-- Land Rover
('NOP8901', 'Diésel', 'Negro', 'I4', '245HP', '8L/100km', '7.5s', 'Land Rover Range Rover Evoque 2021', 0, 3, 18, 630, 'Automático', 80),
('QRS1231', 'Diésel', 'Blanco', 'I4', '247HP', '8L/100km', '7.3s', 'Land Rover Range Rover Velar 2021', 0, 3, 18, 630, 'Automático', 81),
-- Maserati
('TUV4565', 'Gasolina', 'Azul', 'V6', '345HP', '10L/100km', '5.5s', 'Maserati Ghibli 2021', 0, 4, 19, 460, 'Automático', 82),
('WXY7896', 'Gasolina', 'Gris', 'V8', '320HP', '15L/100km', '6.2s', 'Maserati Khamsin 1974', 0, 4, 19, 710, 'Manual', 83),
-- Bentley
('ZAB0129', 'Gasolina', 'Verde', 'W12', '600HP', '14L/100km', '4.0s', 'Bentley EXP 10 Speed 6 Concept 2015', 0, 5, 20, 500, 'Automático', 84),
-- Aston Martin
('CDE3450', 'Gasolina', 'Plata', 'I6', '282HP', '12L/100km', '7.1s', 'Aston Martin DB5 1964', 0, 6, 21, 600, 'Manual', 85),
('FGH6780', 'Gasolina', 'Verde', 'I6', '268HP', '10L/100km', '6.5s', 'Aston Martin DBR1 1959', 0, 6, 21, 700, 'Manual', 86),
('IJK9015', 'Gasolina', 'Rojo', 'V12', '848HP', '18L/100km', '3.5s', 'Aston Martin Victor 2020', 0, 6, 21, 999, 'Manual', 87),
-- McLaren
('LMN2348', 'Gasolina', 'Naranja', 'V8', '727HP', '14L/100km', '2.8s', 'McLaren P1 2013', 0, 7, 22, 999, 'Automático', 88),
('OPQ5679', 'Gasolina', 'Azul', 'V8', '755HP', '13L/100km', '2.7s', 'McLaren 765LT 2021', 0, 7, 22, 999, 'Automático', 89),
('RST8906', 'Gasolina', 'Negro', 'V8', '800HP', '13L/100km', '2.7s', 'McLaren Senna 2018', 0, 7, 22, 999, 'Automático', 90),
-- Bugatti
('UVW1234', 'Gasolina', 'Azul', 'W16', '1200HP', '22L/100km', '2.5s', 'Bugatti Veyron Super Sport 2010', 0, 8, 23, 999, 'Automático', 91),
('XYZ4564', 'Gasolina', 'Negro', 'W16', '1500HP', '20L/100km', '2.4s', 'Bugatti Chiron Sport 2018', 0, 8, 23, 999, 'Automático', 92),
-- Rolls-Royce
('ABC7895', 'Gasolina', 'Negro', 'V12', '165HP', '20L/100km', '10.0s', 'Rolls-Royce Phantom III 1936', 0, 9, 24, 999, 'Manual', 93),
-- Lamborghini
('DEF0126', 'Gasolina', 'Blanco', 'V12', '375HP', '17L/100km', '4.5s', 'Lamborghini Countach 1985', 0, 10, 25, 900, 'Manual', 94),
('GHI3457', 'Gasolina', 'Amarillo', 'V12', '730HP', '18L/100km', '2.9s', 'Lamborghini Aventador 2021', 0, 10, 25, 999, 'Automático', 95),
('JKL6787', 'Gasolina', 'Verde', 'V10', '640HP', '15L/100km', '2.9s', 'Lamborghini Huracan 2021', 0, 10, 25, 999, 'Automático', 96),
('MNO9018', 'Gasolina', 'Negro', 'V8', '641HP', '12L/100km', '3.6s', 'Lamborghini Urus 2021', 0, 10, 25, 999, 'Automático', 97),
-- Alfa Romeo
('PQR2340', 'Gasolina', 'Rojo', 'V8', '230HP', '10L/100km', '5.5s', 'Alfa Romeo 33 Stradale 1967', 0, 11, 26, 800, 'Manual', 98),
-- Lotus
('STU5678', 'Gasolina', 'Azul', 'V6', '416HP', '10L/100km', '4.3s', 'Lotus Evora 2021', 0, 12, 27, 600, 'Manual', 99),
('VWX8908', 'Gasolina', 'Verde', 'I4', '220HP', '7L/100km', '4.6s', 'Lotus Elise 2021', 0, 12, 27, 580, 'Manual', 100),
-- Cadillac
('YZA1232', 'Gasolina', 'Negro', 'V8', '668HP', '15L/100km', '3.4s', 'Cadillac CT5-V Blackwing 2022', 0, 13, 28, 690, 'Manual', 101),
('BCD4561', 'Gasolina', 'Rojo', 'V8', '345HP', '20L/100km', '8.0s', 'Cadillac DeVille Coupé 1959', 0, 13, 28, 800, 'Manual', 102),
-- Chevrolet
('EFG7891', 'Gasolina', 'Amarillo', 'V8', '638HP', '14L/100km', '3.4s', 'Chevrolet Corvette C6 ZR1 2011', 0, 14, 29, 710, 'Manual', 103),
('HIJ0122', 'Gasolina', 'Naranja', 'V8', '450HP', '18L/100km', '4.1s', 'Chevrolet Camaro Yenko 1969', 0, 14, 29, 710, 'Manual', 104);

