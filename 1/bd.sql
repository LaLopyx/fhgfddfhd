CREATE TABLE CarBrands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE CarModels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    brand_id INT,
    FOREIGN KEY (brand_id) REFERENCES CarBrands(id)
);

-- Пример данных
INSERT INTO CarBrands (name) VALUES ('Toyota'), ('Ford'), ('BMW');
INSERT INTO CarModels (name, brand_id) VALUES 
('Camry', 1), ('Corolla', 1), 
('Mustang', 2), ('Fiesta', 2), 
('X5', 3), ('3 Series', 3);
