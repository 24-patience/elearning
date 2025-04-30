```php
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: LOGINPAGE.php");
    exit();
}
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['user-name'];
    $email = $_POST['user-email'];
    $role = $_POST['user-role'];
    $password = password_hash($_POST['user-password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (full_name, email, role, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$full_name, $email, $role, $password]);
        echo "<p>User added successfully!</p>";
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
  <title>Add User</title>
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
      max-width: 500px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
    }
    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <header>
    <h1>Add User</h1>
  </header>
  <main>
    <form method="POST">
      <label for="user-name">Full Name:</label>
      <input type="text" id="user-name" name="user-name" required>

      <label for="user-email">Email:</label>
      <input type="email" id="user-email" name="user-email" required>

      <label for="user-role">Role:</label>
      <select id="user-role" name="user-role" required>
        <option value="">Select Role</option>
        <option value="student">Student</option>
        <option value="instructor">Instructor</option>
        <option value="admin">Administrator</option>
      </select>

      <label for="user-password">Password:</label>
      <input type="password" id="user-password" name="user-password" required>

      <button type="submit">Add User</button>
    </form>
  </main>
</body>
</html>
```