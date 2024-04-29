DROP TABLE IF EXISTS acciones;

CREATE TABLE acciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    lugar VARCHAR(255) NOT NULL,
    nombre VARCHAR(255),
    descripcion TEXT,
    foto VARCHAR(255) NOT NULL
);

INSERT INTO acciones (fecha, lugar, nombre, descripcion, foto) VALUES 
('2024-04-01', 'Ciudad A', 'Evento 1', 'Descripción del evento 1', 'foto1.jpg'),
('2024-04-02', 'Ciudad B', 'Evento 2', 'Descripción del evento 2', 'foto2.jpg'),
('2024-04-03', 'Ciudad C', 'Evento 3', 'Descripción del evento 3', 'foto3.jpg'),
('2024-04-04', 'Ciudad D', 'Evento 4', 'Descripción del evento 4', 'foto4.jpg'),
('2024-04-05', 'Ciudad E', 'Evento 5', 'Descripción del evento 5', 'foto5.jpg'),
('2024-04-06', 'Ciudad F', 'Evento 6', 'Descripción del evento 6', 'foto6.jpg'),
('2024-04-07', 'Ciudad G', 'Evento 7', 'Descripción del evento 7', 'foto7.jpg'),
('2024-04-08', 'Ciudad H', 'Evento 8', 'Descripción del evento 8', 'foto8.jpg');