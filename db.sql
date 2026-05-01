CREATE TABLE tipe_kamar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_tipe VARCHAR(50) NOT NULL,
    harga INT NOT NULL,
    fasilitas TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kamar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_kamar VARCHAR(10) NOT NULL,
    lantai TINYINT NOT NULL,
    id_tipe_kamar INT NOT NULL,
    status ENUM('tersedia','terisi') DEFAULT 'tersedia',
    foto VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tipe_kamar) REFERENCES tipe_kamar(id)
);

CREATE TABLE penghuni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nik VARCHAR(16) NOT NULL,
    no_hp VARCHAR(15),
    alamat_asal TEXT,
    tanggal_masuk DATE NOT NULL,
    id_kamar INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kamar) REFERENCES kamar(id)
);

CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_penghuni INT NOT NULL,
    bulan TINYINT NOT NULL,
    tahun YEAR NOT NULL,
    jumlah_bayar INT NOT NULL,
    status ENUM('lunas','belum') DEFAULT 'belum',
    tanggal_bayar DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_penghuni) REFERENCES penghuni(id)
);

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Data dummy tipe kamar
INSERT INTO tipe_kamar (nama_tipe, harga, fasilitas) VALUES
('Standard', 500000, 'Kasur, Lemari, Kipas Angin'),
('Deluxe', 800000, 'Kasur, Lemari, AC, Kamar Mandi Dalam'),
('VIP', 1200000, 'Kasur, Lemari, AC, Kamar Mandi Dalam, TV, WiFi');

-- Data dummy kamar
INSERT INTO kamar (nomor_kamar, lantai, id_tipe_kamar, status) VALUES
('A01', 1, 1, 'tersedia'),
('A02', 1, 1, 'tersedia'),
('B01', 1, 2, 'tersedia'),
('B02', 1, 2, 'tersedia'),
('C01', 2, 3, 'tersedia'),
('C02', 2, 3, 'tersedia');

-- User pengelola (password: admin123)
INSERT INTO user (nama, username, password) VALUES
('Pengelola Kos', 'admin', '$2y$10$INbwUsZduoNj4eZxWAU6/ufzHYk/NgE3JWKgDQLyu01ieA.L/1XWS');
