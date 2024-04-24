DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE tweets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    mensaje VARCHAR(255) NOT NULL,
    fecha_hora DATETIME NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
); 

INSERT INTO usuarios (usuario, contrasena, email) VALUES
('malmorox', '$2y$10$0N6oTYCuDQvOhJbqIv0Q1uCLJFBoqTODJXIqaGb4KPv9bHpQEQB1m', 'malmorox@practicando.com');