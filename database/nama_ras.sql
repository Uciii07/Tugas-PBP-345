CREATE DATABASE kucing_db;

USE kucing_db;

CREATE TABLE ras_kucing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_ras VARCHAR(100),
    asal_negara VARCHAR(100)
);

INSERT INTO ras_kucing (nama_ras, asal_negara) VALUES
('Persia', 'Iran'),
('Anggora', 'Turki'),
('Ragdoll', 'Amerika'),
('Himalaya', 'Amerika'),
('Siam', 'Thailand'),
('American Shorthair', 'Amerika');