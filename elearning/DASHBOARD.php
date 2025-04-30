```php
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: LOGINPAGE.php");
    exit();
}
require 'db_connect.php';

// Fetch enrolled courses (assuming an enrollments table exists)
$stmt = $pdo->prepare("SELECT c.* FROM courses c JOIN enrollments e ON c.id = e.course_id WHERE e.user_id = ?");
$stmt->execute(array($_SESSION['user_id']));
$enrolled_courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>eLearning Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    nav {
      background-color: #007bff;
      color: white;
      padding: 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    nav .logo {
      font-size: 1.2rem;
      font-weight: bold;
    }

    nav .nav-links a {
      color: white;
      margin-left: 1rem;
      text-decoration: none;
      font-size: 1rem;
    }

    nav .nav-links a:hover {
      text-decoration: underline;
    }

    .sidebar {
      position: fixed;
      top: 60px;
      left: 0;
      width: 220px;
      height: calc(100% - 60px);
      background-color: #2c3e50;
      color: #fff;
      padding-top: 20px;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar a {
      display: block;
      color: #fff;
      padding: 12px 20px;
      text-decoration: none;
    }

    .sidebar a:hover {
      background-color: #34495e;
    }

    .main {
      margin-left: 220px;
      margin-top: 60px;
      padding: 20px;
    }

    h1 {
      margin-bottom: 30px;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .card {
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .card h3 {
      margin-top: 0;
    }

    .card p {
      color: #555;
    }
  </style>
</head>
<body>
  <nav>
    <div class="logo">eLearning Platform</div>
    <div class="nav-links">
      <a href="HOMEPAGE.php">Home</a>
      <a href="ADMINPAGE.php">Admin</a>
      <a href="LOGINPAGE.php">Login</a>
      <a href="REGISTERPAGE.php">Register</a>
      <a href="COURSESPAGE.php">Courses</a>
      <a href="logout.php">Logout</a>
    </div>
  </nav>

  <div class="sidebar">
    <h2>eLearning</h2>
    <a href="DASHBOARD.php">Dashboard</a>
    <a href="COURSESPAGE.php">My Courses</a>
    <a href="#">Assignments</a>
    <a href="#">Grades</a>
    <a href="#">Messages</a>
    <a href="#">Settings</a>
    <a href="logout.php">Logout</a>
  </div>

  <div class="main">
    <h1>Welcome Back, <?php echo htmlspecialchars($_SESSION['role']); ?>!</h1>
    <div class="grid">
      <div class="card">
        <h3>Current Courses</h3>
        <p>
          <?php if ($enrolled_courses): ?>
            <ul>
              <?php foreach ($enrolled_courses as $course): ?>
                <li><?php echo htmlspecialchars($course['name']); ?></li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            You are not enrolled in any courses.
          <?php endif; ?>
        </p>
      </div>
      <div class="card">
        <h3>Upcoming Assignments</h3>
        <p>Stay ahead by checking what's due soon.</p>
      </div>
      <div class="card">
        <h3>Messages</h3>
        <p>Communicate with instructors and classmates.</p>
      </div>
      <div class="card">
        <h3>Grades Overview</h3>
        <p>Track your performance across all courses.</p>
      </div>
    </div>
  </div>
</body>
</html>
```