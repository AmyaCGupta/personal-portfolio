<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        $success = true;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Me</title>
<link rel="stylesheet" href="css/style.css">
<style>
    .contact-box {
        max-width: 700px;
        margin: 40px auto;
        background-color: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .contact-box form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-row label {
        flex: 1;
        margin-right: 10px;
        text-align: right;
    }

    .form-row input, 
    .form-row textarea {
        flex: 2;
        padding: 8px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .form-row textarea {
        resize: vertical;
        height: 100px;
    }

    .form-row button {
        margin: 0 auto;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        background-color: #2c3e50;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }

    .form-row button:hover {
        background-color: #34495e;
    }
</style>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Me</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="contact-box">
        <?php if ($success): ?>
            <h2 style="text-align:center; color:green;">Message sent successfully!</h2>
            <p style="text-align:center;">Thank you, <?php echo htmlspecialchars($name); ?>. I will get back to you soon.</p>
        <?php else: ?>
            <h2 style="text-align:center;">Contact Me</h2>
            <form action="contact.php" method="POST">
                <div class="form-row">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-row">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-row">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <div class="form-row">
                    <button type="submit">Send</button>
                </div>
            </form>
        <?php endif; ?>
    </section>
</main>

<footer>
    &copy; <?php echo date("Y"); ?> Amya Casu Gupta
</footer>
</body>
</html>
