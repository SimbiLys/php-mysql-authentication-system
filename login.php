<?php
session_start();
include 'connection.php';

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepared statement (SAFE)
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();

        // Verify hashed password
        if(password_verify($password, $user['password'])){
            $_SESSION['email'] = $email;
            header("Location: homepage.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYNQ. — Sign In</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background-color: #000000;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        body::before {
            content: '';
            position: fixed;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.07) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 24px;
            padding: 40px 36px;
            width: 100%;
            max-width: 420px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .brand {
            font-size: 18px;
            font-weight: 800;
            color: white;
            letter-spacing: 2px;
            margin-bottom: 32px;
        }

        .welcome h2 {
            color: white;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .welcome p {
            color: rgba(255,255,255,0.45);
            font-size: 13px;
            margin-bottom: 28px;
        }

        .input-group {
            margin-bottom: 16px;
        }

        .input-group label {
            display: block;
            color: rgba(255,255,255,0.5);
            font-size: 12px;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 50px;
            color: white;
            font-size: 14px;
            outline: none;
            transition: border 0.3s ease;
        }

        .input-group input:focus {
            border-color: rgba(255,255,255,0.4);
        }

        .input-group input::placeholder {
            color: rgba(255,255,255,0.3);
        }

        .extras {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .extras label {
            color: rgba(255,255,255,0.5);
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .extras a {
            color: rgba(255,255,255,0.5);
            font-size: 13px;
            text-decoration: none;
        }

        .extras a:hover {
            color: white;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50px;
            color: white;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1.5px;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.3s ease;
        }

        .btn-submit:hover {
            background: rgba(255,255,255,0.25);
        }

        .error-msg {
            color: rgba(255, 100, 100, 0.9);
            font-size: 13px;
            text-align: center;
            margin-bottom: 16px;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
            color: rgba(255,255,255,0.4);
            font-size: 13px;
        }

        .signup-link a {
            color: white;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="brand">SYNQ.</div>

        <div class="welcome">
            <h2>Welcome back,</h2>
            <p>please enter your details.</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">

            <div class="input-group">
                <label>Email ID</label>
                <input type="email" name="email" placeholder="john@example.com">
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••">
            </div>

            <div class="extras">
                <label>
                    <input type="checkbox"> Remember Me
                </label>
                <a href="#">Forgot Password?</a>
            </div>

            <button type="submit" name="submit" class="btn-submit">SIGN IN</button>

        </form>

        <div class="signup-link">
            Don't have an account? <a href="signup.html">Sign up</a>
        </div>
    </div>

</body>
</html>
