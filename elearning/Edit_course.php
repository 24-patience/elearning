```php
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: LOGINPAGE.php");
    exit();
}
require 'db_connect.php';

$course = null;
if (isset($_GET['course-id'])) {
    $course_id = $_GET['course-id'];
    $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
    $stmt->execute([$course_id]);
    $course = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course-id'];
    $new_name = $_POST['course-name'];
    $new_description = $_POST['course-description'];

    try {
        $stmt = $pdo->prepare("UPDATE courses SET name = ?, description = ? WHERE id = ?");
        $stmt->execute([$new_name, $new_description, $course_id]);
        echo "<p>Course updated successfully!</p>";
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
  <title>Edit Course</title>
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
    input, textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      background-color: #0074cc;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
    }
    button:hover {
      background-color: #00509e;
    }
  </style>
</head>
<body>
  <header>
    <h1>Edit Course</h1>
  </header>
  <main>
    <form method="POST">
      <label for="course-id">Course ID:</label>
      <input type="text" id="course-id" name="course-id" placeholder="Enter Course ID" required>

      <label for="course-name">New Course Name:</label>
      <input type="text" id="course-name" name="course-name" value="<?php echo $course ? htmlspecialchars($course['name']) : ''; ?>">

      <label for="course-description">New Description:</label>
      <textarea id="course-description" name="course-description"><?php echo $course ? htmlspecialchars($course['description']) : ''; ?></textarea>

      <button type="submit">Update</button>
    </form>
  </main>
</body>
</html>
```