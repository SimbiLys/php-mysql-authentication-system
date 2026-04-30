<?php
include 'connection.php';

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert safely
    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $hashed_password);

    if($stmt->execute()){
        header("Location: login.php");
        exit();
    } else {
        $error = "Something went wrong.";
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
    <title>SYNQ-Sign Up</title>
    <style>
        /* This resets all default browser spacing and makes
        box sizes include padding in their width */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* The full page background - pure black and centered */
        body {
            min-height: 100vh;
            background-color: #000000;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        /* The glowing background blobs behind the card */
        body::before {
            content: '';
            position: fixed;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.07) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        /* The glass card */
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

        /* The brand name at the top */
        .brand {
            font-size: 18px;
            font-weight: 800;
            color: white;
            letter-spacing: 2px;
            margin-bottom: 32px;
        }

        /* The welcome text */
        .welcome h2 {
            color: white;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .welcome p {
            color: rgba(255, 255, 255, 0.45);
            font-size: 13px;
            margin-bottom: 28px;
        }

        /* Each input group - label + input stacked */
        .input-group {
            margin-bottom: 16px;
        }

        .input-group label {
            display: block;
            color: rgba(255, 255, 255, 0.5);
            font-size: 12px;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }

        /* The pill shaped inputs */
        .input-group input {
            width: 100%;
            padding: 14px 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            color: white;
            font-size: 14px;
            outline: none;
            transition: border 0.3s ease;
        }

        /* Input glows slightly when you click on it */
        .input-group input:focus {
            border-color: rgba(255, 255, 255, 0.4);
        }

        /* Placeholder text color */
        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        /* Gender radio buttons row */
        .gender-group {
            margin-bottom: 16px;
        }

        .gender-group label.title {
            display: block;
            color: rgba(255, 255, 255, 0.5);
            font-size: 12px;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .gender-options {
            display: flex;
            gap: 16px;
        }

        .gender-options label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        /* The sign up button */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            color: white;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1.5px;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.3s ease;
        }

        /* Button gets slightly brighter on hover */
        .btn-submit:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        /* The login link at the bottom */
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.4);
            font-size: 13px;
        }

        .login-link a {
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
            <h2>Create account,</h2>
            <p>please enter your details.</p>
        </div>

        <form action="create.php" method="POST">

            <div class="input-group">
                <label>First Name</label>
                <input type="text" name="fname" placeholder="first name">
            </div>

            <div class="input-group">
                <label>Last Name</label>
                <input type="text" name="lname" placeholder="last name">
            </div>

            <div class="input-group">
                <label>Email ID</label>
                <input type="email" name="email" placeholder="you@example.com">
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••">
            </div>

            <div class="gender-group">
                <label class="title">Gender</label>
                <div class="gender-options">
                    <label>
                        <input type="radio" name="gender" value="Male"> Male
                    </label>
                    <label>
                        <input type="radio" name="gender" value="Female"> Female
                    </label>
                </div>
            </div>

            <button type="submit" name="submit" class="btn-submit">SIGN UP</button>

        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Sign in</a>
        </div>
    </div>

</body>

</html>
