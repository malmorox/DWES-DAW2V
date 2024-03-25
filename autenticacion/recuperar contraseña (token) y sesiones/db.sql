CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    email VARCHAR(50) NOT NULL
);

CREATE TABLE tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email_usuario VARCHAR(50) NOT NULL,
    token VARCHAR(255) NOT NULL,
    fecha_expiracion DATETIME NOT NULL,
    FOREIGN KEY (email_usuario) REFERENCES usuarios(email)
);

INSERT INTO usuarios (usuario, contrasena) VALUES ('marcos', '$2y$10$qWZYHIPeJW8E7Jo9crlncej/Rjl7nRG5WnrjFnlASC5.agcdlRVa6', 'marcos@gmail.com');
INSERT INTO usuarios (usuario, contrasena) VALUES ('jorge', '$2y$10$sfc3d8u4/d1V9dbzUTaCzeC36bLUj9cZjaAvF4wpFtmWpmDaz5r.S', 'jorge@hotmail.com');