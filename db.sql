CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    saldo BIGINT NOT NULL DEFAULT 0
);

INSERT INTO users (username, password, saldo) VALUES
('admin', 'admin123', 1000000000),
('obietama', 'qwerty123', 5000000),
('pabloescobar', 'pablo123', 30000);