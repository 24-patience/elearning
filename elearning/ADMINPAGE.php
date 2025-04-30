```php
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: LOGINPAGE.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f4f8;
    }

    header {
      background-color: #003366;
      color: white;
      padding: 15px;
      text-align: center;
    }

    nav {
      background-color: #00509e;
      text-align: center;
      padding: 10px;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin: 0 10px;
      padding: 10px 15px;
      background-color: #0074cc;
      border-radius: 5px;
      font-weight: bold;
      display: inline-block;
    }

    nav a:hover {
      background-color: #003366;
    }

    main {
      padding: 20px;
    }

    .section {
      margin: 20px auto;
      padding: 20px;
      max-width: 800px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .section h2 {
      margin-top: 0;
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    ul li {
      margin: 10px 0;
    }

    a button {
      padding: 10px 20px;
      background-color: #4CAF50;
      border: none;
      color: white;
      font-size: 1rem;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.2s;
    }

    a button:hover {
      background-color: #45a049;
      transform: translateY(-2px);
    }

    footer {
      text-align: center;
      padding: 15px;
      background-color: #003366;
      color: white;
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Admin Dashboard</h1>
  </header>

  <nav>
    <a href="HOMEPAGE.php">Home</a>
    <a href="LOGINPAGE.php">Login</a>
    <a href="DASHBOARD.php">Dashboard</a>
    <a href="COURSESPAGE.php">Courses</a>
    <a href="REGISTERPAGE.php">Register</a>
    <a href="logout.php">Logout</a>
  </nav>

  <main>
    <section class="section">
      <h2>Manage Courses</h2>
      <ul>
        <li><a href="Add_course.php"><button>Add Course</button></a></li>
        <li><a href="Edit_course.php"><button>Edit Course</button></a></li>
        <li><a href="Delete_course.php"><button>Delete Course</button></a></li>
      </ul>
    </section>

    <section class="section">
      <h2>Manage Users</h2>
      <ul>
        <li><a href="Add_user.php"><button>Add User</button></a></li>
        <li><a href="Edit_user.php"><button>Edit User</button></a></li>
        <li><a href="Delete_user.php"><button>Delete User</button></a></li>
      </ul>
    </section>

    <section class="section">
      <h2>View Statistics</h2>
      <ul>
        <li><a href="view_statistics.php"><button>Generate Report</button></a></li>
      </ul>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 E-Learning Dashboard</p>
  </footer>
</body>
</html>
```