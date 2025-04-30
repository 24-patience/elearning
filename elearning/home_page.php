```php
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Platform</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Header */
        header {
            background-color: black;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 10px 0 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        /* Hero Section */
        .hero {
            background: blue;
            color: black;
            text-align: center;
            padding: 100px 20px;
            font-size: 24px;
        }

        /* Courses Section */
        .courses {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 40px 20px;
            background-color: #fff;
        }

        .course-card {
            background-color: #e0f2f1;
            padding: 20px;
            width: 200px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .course-card:hover {
            transform: scale(1.05);
        }

        /* Footer */
        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>E-Learning Platform</h1>
        <nav>
            <ul>
                <li><a href="LOGINPAGE.php">Login</a></li>
                <li><a href="ADMINPAGE.php">Admin</a></li>
                <li><a href="REGISTERPAGE.php">Register</a></li>
                <li><a href="DASHBOARD.php">Dashboard</a></li>
                <li><a href="COURSESPAGE.php">Courses</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h2>Learn from Anywhere, Anytime!</h2>
        </section>

        <section class="courses">
            <div class="course-card">Course 1</div>
            <div class="course-card">Course 2</div>
            <div class="course-card">Course 3</div>
        </section>
    </main>

    <footer>
        &copy; 2025 E-Learning Platform
    </footer>
</body>
</html>
```