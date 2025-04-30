```php
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: LOGINPAGE.php");
    exit();
}
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user-id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        echo "<p>User deleted successfully!</p>";
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
  <title>Delete User</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f8;
      margin: 0;
    }
    header {
      background-color: #a30000;
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
      background-color: #d32f2f;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
    }
    button:hover {
      background-color: #b71c1c;
    }
  </style>
</head>
<body>
  <header>
    <h1>Delete User</h1>
  </header>
  <main>
    <form method="POST">
      <label for="user-id">User ID:</label>
      <input type="text" id="user-id" name="user-id" placeholder="Enter User ID to delete" required>

      <button type="submit">Delete</button>
    </form>
  </main>
</body>
</html>
```