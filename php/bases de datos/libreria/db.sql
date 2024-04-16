DROP TABLE IF EXISTS libros;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS prestamos;

CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    ano_publicacion INT NOT NULL
);

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    telefono INT NOT NULL
);

CREATE TABLE prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_libro INT,
    id_cliente INT,
    fecha_prestamo DATE,
    FOREIGN KEY (id_libro) REFERENCES libros(id),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id)
);

INSERT INTO libros (titulo, autor, ano_publicacion) VALUES
('Cien años de soledad', 'Gabriel García Márquez', 1967),
('1984', 'George Orwell', 1949),
('Orgullo y prejuicio', 'Jane Austen', 1813),
('El código Da Vinci', 'Dan Brown', 2003),
('Harry Potter y la piedra filosofal', 'J.K. Rowling', 1997),
('El alquimista', 'Paulo Coelho', 1988),
('El principito', 'Antoine de Saint-Exupéry', 1943),
('El señor de los anillos', 'J.R.R. Tolkien', 1954),
('Don Quijote de la Mancha', 'Miguel de Cervantes', 1605),
('La sombra del viento', 'Carlos Ruiz Zafón', 2001),
('El perfume', 'Patrick Süskind', 1985),
('La ladrona de libros', 'Markus Zusak', 2005),
('Los pilares de la tierra', 'Ken Follett', 1989),
('El nombre del viento', 'Patrick Rothfuss', 2007),
('La catedral del mar', 'Ildefonso Falcones', 2006),
('La hoguera de las vanidades', 'Tom Wolfe', 1987),
('El juego de Ender', 'Orson Scott Card', 1985),
('La chica del tren', 'Paula Hawkins', 2015),
('La inmortalidad', 'Milan Kundera', 1990),
('La ciudad y los perros', 'Mario Vargas Llosa', 1963),
('La tregua', 'Mario Benedetti', 1960),
('La muerte de Artemio Cruz', 'Carlos Fuentes', 1962),
('La fiesta del chivo', 'Mario Vargas Llosa', 2000),
('La regenta', 'Leopoldo Alas Clarín', 1884),
('Crepúsculo', 'Stephenie Meyer', 2005),
('Juego de tronos', 'George R.R. Martin', 1996);

INSERT INTO clientes (nombre, telefono) VALUES
('Juan Perez', 123456890),
('Maria Rodriguez', 987654321),
('Carlos Martinez', 5555555555),
('Ana Lopez', 777777777),
('Pedro Gomez', 999999999),
('Laura Torres', 123456789),
('Diego Fernandez', 987654321),
('Sara Navarro', 555555555),
('Pablo Ruiz', 777777777),
('Elena Sánchez', 999999999);
