```php
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: LOGINPAGE.php");
    exit();
}
require 'db_connect.php';

$user = null;
if (isset($_GET['user-id'])) {
    $user_id = $_GET['user-id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user-id'];
    $new_name = $_POST['new-user-name'];
    $new_email = $_POST['new-email'];
    $new_role = $_POST['new-role'];

    try {
        $stmt = $pdo->prepare("UPDATE users SET full_name = ?, email = ?, role = ? WHERE id = ?");
        $stmt->execute([$new_name, $new_email, $new_role, $user_id]);
        echo "<p>User updated successfully!</p>";
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
  <title>Edit User</title>
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
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 500px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      padding: 10px 15px;
      background-color: #0074cc;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.2s;
    }
    button:hover {
      background-color: #00509e;
      transform: translateY(-2px);
    }
    button:active {
      background-color: #003366;
      transform: translateY(0);
    }
  </style>
</head>
<body>
  <header>
    <h1>Edit User</h1>
  </header>
  <main>
    <form method="POST">
      <label for="user-id">User ID:</label>
      <input type="text" id="user-id" name="user-id" placeholder="Enter User ID" required>

      <label for="new-user-name">New Username:</label>
      <input type="text" id="new-user-name" name="new-user-name" value="<?php echo $user ? htmlspecialchars($user['full_name']) : ''; ?>" placeholder="Enter new username">

      <label for="new-email">New Email:</label>
      <input type="email" id="new-email" name="new-email" value="<?php echo $user ? htmlspecialchars($user['email']) : ''; ?>" placeholder="Enter new email">

      <label for="new-role">New Role:</label>
      <input type="text" id="new-role" name="new-role" value="<?php echo $user ? htmlspecialchars($user['role']) : ''; ?>" placeholder="e.g., student, instructor, admin">

      <button type="submit">Update User</button>
    </form>
  </main>
</body>
</html>
```