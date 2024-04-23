DROP TABLE IF EXISTS usuarios;

CREATE TABLE acciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    lugar VARCHAR(255) NOT NULL,
    nombre VARCHAR(255),
    descripcion TEXT,
    foto VARCHAR(255) NOT NULL
);