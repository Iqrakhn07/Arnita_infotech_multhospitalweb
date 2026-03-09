<?php
session_start();
include 'config.php';


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin'] = $username;
    } else {
        $error = "Invalid credentials";
    }
}


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
}


if (isset($_POST['confirm'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "UPDATE appointments SET status='confirmed' WHERE id=$id");
}
if (isset($_POST['reject'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "UPDATE appointments SET status='rejected' WHERE id=$id");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Multhospital</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f4f8f8; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #51879e; color: white; }
        .status-pending { color: orange; font-weight: bold; }
        .status-confirmed { color: green; font-weight: bold; }
        .status-rejected { color: red; font-weight: bold; }
        .btn-confirm { background-color: green; color: white; border: none; padding: 5px 10px; cursor: pointer; }
        .btn-reject { background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer; }
        .login-box { max-width: 400px; margin: 50px auto; padding: 20px; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .login-box input { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .login-box button { width: 100%; padding: 10px; background-color: #51879e; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <?php if (!isset($_SESSION['admin'])): ?>
        <div class="login-box">
            <h2 style="color: #124c66;">Admin Login</h2>
            <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    <?php else: ?>
        <div style="max-width: 1200px; margin: 0 auto;">
            <h2 style="color: #124c66;">Doctor Dashboard (Admin)</h2>
            <p>Welcome, <?php echo $_SESSION['admin']; ?>. <a href="?logout=1" style="color: #51879e;">Logout</a></p>
            
            <h3 style="color: #124c66;">Appointment Requests</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $query = "SELECT * FROM appointments ORDER BY id DESC";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $statusClass = "status-" . $row['status'];
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['patient_name'] . "<br><small>" . $row['patient_email'] . "</small></td>";
                    echo "<td>" . $row['doctor_name'] . "</td>";
                    echo "<td>" . $row['appointment_date'] . "</td>";
                    echo "<td>" . $row['appointment_time'] . "</td>";
                    echo "<td class='$statusClass'>" . strtoupper($row['status']) . "</td>";
                    echo "<td>";
                    if ($row['status'] == 'pending') {
                        echo "<form method='POST' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' name='confirm' class='btn-confirm'>Confirm</button>";
                        echo "<button type='submit' name='reject' class='btn-reject'>Reject</button>";
                        echo "</form>";
                    } else {
                        echo "No Action";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    <?php endif; ?>

</body>
</html>