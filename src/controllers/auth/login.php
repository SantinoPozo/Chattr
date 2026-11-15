<?php
require_once __DIR__ . '/../../config/bootstrap.php';

// Paso clave #1: Validar tipo de solicitud ----------------------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {  // Si la solicitud no es POST, volves al register
  header('Location: /src/views/auth/login.php');
  exit;
}
if(isset($_POST['email']) && $_POST['password']){
  $data = [
    'email'           => trim($_POST['email'] ?? ''), // trim(str) saca los espacios al inicio y al final
    'password'        => $_POST['password'] ?? ''
  ];
  $_SESSION['error'] = "";
  try {
    // Validamos que el usuario no exista
    // ...
  
    /* Sacamos un registro del DB. */
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    
    $stmt->execute([
      'email'    => $data['email']
    ]);
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row || !password_verify($data['password'], $row['password'])){
      $_SESSION['error'] = $_session['error'] . "<p>El email o contraseña son incorrectas.</p>";
    }
    
    if($_SESSION['error']){
      header('Location: /src/views/auth/login.php');
      exit;
    } else {
      $_SESSION['user'] = [
        'id'    => $row['id'],
        'name'  => $row['name'],
        'email' => $data['email'],
        'pfp' => $row['profile_picture']
      ];
      echo "test";
      header('Location: /src/views/posts/index.php');
      exit;
    }
    // Cargamos $_SESSION['user'], para poder pasar al index
  } catch (PDOException $e) {
    exit;
  }  
}
include('Location: /src/views/auth/login.php');
