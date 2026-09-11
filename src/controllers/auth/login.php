<?php
require_once __DIR__ . '/../../config/bootstrap.php';

// Paso clave #1: Validar tipo de solicitud ----------------------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {  // Si la solicitud no es POST, volves al register
  header('Location: /src/views/auth/login.php');
  exit;
}

$data = [
  'email'           => trim($_POST['email'] ?? ''), // trim(str) saca los espacios al inicio y al final
  'password'        => $_POST['password'] ?? ''
];
try {
  // Validamos que el usuario no exista
  // ...

  /* Sacamos un registro del DB. */
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
  
  $stmt->execute([
    'email'    => $data['email']
  ]);
  
  if ($row = $stmt->fetchColumn()){
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  var_dump($row);
  $pass_igual = password_verify($data['password'], $row['password']);
  echo $data['password'];
  echo $pass_igual;
  if($pass_igual){
    $_SESSION['user'] = [
      'id'    => $row['id'],
      'name'  => $row['name'],
      'email' => $data['email'],
    ];
    echo "test";
    /*header('Location: /src/views/index.php');
    exit;
  } else {
    header('Location: /src/views/auth/login.php');
    exit;*/
  }
  // Cargamos $_SESSION['user'], para poder pasar al index
} catch (PDOException $e) {
  exit;
}