<?php
$usuarios = [
    ['usuario' => 'marcos', 'contrasena' => '1234'],
    ['usuario' => 'jorge', 'contrasena' => '5678'],
];

$sqlInserts = '';

foreach ($usuarios as $usuario) {
    $usuarioNombre = $usuario['usuario'];
    $contrasenaHash = password_hash($usuario['contrasena'], PASSWORD_DEFAULT);
    $sqlInserts .= "INSERT INTO usuarios (usuario, contrasena) VALUES ('$usuarioNombre', '$contrasenaHash');\n";
}

$file = 'db.sql';
file_put_contents($file, $sqlInserts);

echo "Inserts generados y guardados en $file";
?>