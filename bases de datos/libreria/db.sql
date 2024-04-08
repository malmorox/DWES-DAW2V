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
('Harry Potter y la piedra filosofal', 'J.K. Rowling', 1997);

INSERT INTO clientes (nombre, telefono) VALUES
('Juan Perez', 123456890),
('Maria Rodriguez', 987654321),
('Carlos Martinez', 5555555555),
('Ana Lopez', 777777777),
('Pedro Gomez', 999999999);
