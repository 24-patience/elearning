```php
<?php
session_start();
require 'db_connect.php';

$stmt = $pdo->query("SELECT * FROM courses");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Courses - E-Learning Website</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f8;
    }

    header {
      background-color: #003366;
      color: white;
      padding: 15px;
      text-align: center;
    }

    nav {
      background-color: #00509e;
      padding: 10px;
      text-align: center;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      padding: 8px 15px;
      background-color: #0074cc;
      border-radius: 5px;
    }

    nav a:hover {
      background-color: #003366;
    }

    main {
      padding: 20px;
    }

    section h2 {
      text-align: center;
      margin-bottom: 10px;
    }

    section p {
      text-align: center;
      margin-bottom: 30px;
    }

    .course-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .course {
      background-color: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      width: 300px;
      text-align: center;
    }

    .course img {
      width: 100%;
      border-radius: 5px;
    }

    .course h3 {
      font-size: 1.2rem;
      margin: 10px 0;
    }

    .course p {
      font-size: 0.9rem;
      color: #555;
    }

    .course button {
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      background-color: #4CAF50;
      color: white;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.2s;
    }

    .course button:hover {
      background-color: #45a049;
      transform: translateY(-2px);
    }

    footer {
      background-color: #003366;
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Our Courses</h1>
  </header>
  <nav>
    <a href="HOMEPAGE.php">Home</a>
    <a href="LOGINPAGE.php">Login</a>
    <a href="ADMINPAGE.php">Admin</a>
    <a href="REGISTERPAGE.php">Register</a>
    <a href="DASHBOARD.php">Dashboard</a>
    <a href="logout.php">Logout</a>
  </nav>
  <main>
    <section>
      <h2>Explore Our Courses</h2>
      <p>Find the perfect course to boost your knowledge and skills.</p>
    </section>
    <div class="course-container">
      <?php foreach ($courses as $course): ?>
        <div class="course">
          <img src="images/course-placeholder.jpg" alt="<?php echo htmlspecialchars($course['name']); ?>">
          <h3><?php echo htmlspecialchars($course['name']); ?></h3>
          <p><?php echo htmlspecialchars($course['description']); ?></p>
          <button>Enroll Now</button>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
  <footer>
    <p>&copy; 2025 E-Learning Website. All Rights Reserved.</p>
  </footer>
</body>
</html>
```