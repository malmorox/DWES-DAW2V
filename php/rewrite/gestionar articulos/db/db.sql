DROP TABLE IF EXISTS articulos;

CREATE TABLE articulos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    fecha_publicacion DATE NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO ARTICULOS (TITULO, CONTENIDO, FECHA, slug) VALUES ('cajita', 'lapices', '2023-12-12', 'cajita');
