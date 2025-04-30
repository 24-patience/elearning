```php
<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute(array($email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['password'] === crypt($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: DASHBOARD.php");
        exit();
    } else {
        echo "<p>Invalid email or password!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f8;
      margin: 0;
    }
    header {
      background-color: #003366;
      color: white;
      padding: 15px;
      text-align: center;
    }
    main {
      padding: 20px;
      display: flex;
      justify-content: center;
    }
    form {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }
    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #45a049;
    }
    .register-link {
      text-align: center;
      margin-top: 10px;
    }
    .register-link a {
      color: #0074cc;
      text-decoration: none;
    }
    .register-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <header>
    <h1>Login</h1>
  </header>
  <main>
    <form method="POST">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>
    </form>
    <div class="register-link">
      <p>Don't have an account? <a href="REGISTERPAGE.php">Register</a></p>
    </div>
  </main>
</body>
</html>
```