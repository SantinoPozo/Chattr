<?php
require_once __DIR__ . '/../../config/bootstrap.php';

// Paso clave #1: Validar tipo de solicitud ----------------------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {  // Si la solicitud no es POST, volves al register
  header('Location: /src/views/auth/register.php');
  exit;
}

$data = [
  'email'           => trim($_POST['email'] ?? ''), // trim(str) saca los espacios al inicio y al final
  'password'        => $_POST['password'] ?? ''
];

try {
  // Validamos que el usuario no exista
  // ...


  // Hasheamos la contraseña, nunca se guarda en texto plano
  $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

  // Insertamos en DB
  $stmt = $pdo->prepare("SELECT password FROM users WHERE email=:email");
  $resultado = $stmt->execute([
    'email'    => $data['email'],
  ]);
  while($row = $resultado->fetch()) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['firstname'] . "</td>";
      echo "<td>" . $row['lastname'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
    unset($result);
  // Cargamos $_SESSION['user'], para poder pasar al index
  $_SESSION['user'] = [
    'id'    => $pdo->lastInsertId(),
    'name'  => $data['name'],
    'email' => $data['email'],
  ];
try {

  // Process the result set
  if ($result->rowCount() > 0) {
    echo "<table><tr><th>ID</th><th>Firstname</th><th>Lastname</th></tr>";
    // Output data of each row
    while($row = $result->fetch()) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['firstname'] . "</td>";
      echo "<td>" . $row['lastname'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
    unset($result);
  } else {
    echo "No records found.";
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
  // Pateado para el index
  header('Location: /src/views/index.php');
  exit;
} catch (PDOException $e) {
  exit;
}