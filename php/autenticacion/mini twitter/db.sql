DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    biografia VARCHAR(100),
    contrasena VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    foto_perfil VARCHAR(255)
);

CREATE TABLE tweets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    mensaje VARCHAR(255) NOT NULL,
    fecha_hora DATETIME NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE tokens (
    token VARCHAR(255) PRIMARY KEY,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

INSERT INTO usuarios (usuario, contrasena, email, foto_perfil) VALUES
('malmorox', '$2y$10$0N6oTYCuDQvOhJbqIv0Q1uCLJFBoqTODJXIqaGb4KPv9bHpQEQB1m', 'malmoroxcabrera@educa.madrid.org', 'media/fotos_perfil/foto_perfil2.jpeg');