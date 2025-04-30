```php
<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full-name'];
    $email = $_POST['email'];
    $password = crypt($_POST['password'], '$2y$10$' . substr(sha1(mt_rand()), 0, 22)); // Fallback hashing
    $role = 'student';

    try {
        $stmt = $pdo->prepare("INSERT INTO users (full_name, email, role, password) VALUES (?, ?, ?, ?)");
        $stmt->execute(array($full_name, $email, $role, $password));
        echo "<p>Registration successful! <a href='LOGINPAGE.php'>Login</a></p>";
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
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
    .login-link {
      text-align: center;
      margin-top: 10px;
    }
    .login-link a {
      color: #0074cc;
      text-decoration: none;
    }
    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <header>
    <h1>Register</h1>
  </header>
  <main>
    <form method="POST">
      <label for="full-name">Full Name:</label>
      <input type="text" id="full-name" name="full-name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Register</button>
    </form>
    <div class="login-link">
      <p>Already have an account? <a href="LOGINPAGE.php">Login</a></p>
    </div>
  </main>
</body>
</html>
```