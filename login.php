<!DOCTYPE html>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body>
    <div class="register-container">
        <h2>ĐĂNG NHẬP</h2>
        <form action="login.php" method="post">
            <div class="input-group">
                <input type="text" name="username" placeholder="Nhập tên" required>
                <input type="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <button type="submit" class="btn-register">LOGIN</button>
        </form>
        <p>Chưa có tài khoản? <a href="register.php">Đăng kí ngay</a></p>
    </div>
    <?php
$host = "localhost";
$user = "hado";
$pass = "hado167";
$db = "WEBSQL";

// Kết nối database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem username và password có tồn tại không
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Truy vấn database
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            session_start();
            $_SESSION['user'] = $username;
            header("Location: index.php"); // Chuyển hướng đến trang index
            exit();
        } else {
            echo "<p class='error'>Sai username hoặc password!</p>";
        }
    } else {
        echo "<p class='error'>Vui lòng nhập đầy đủ thông tin!</p>";
    }
}
$conn->close();
?>

</body>
</html>
