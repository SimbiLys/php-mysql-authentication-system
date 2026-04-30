<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYNQ. — Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background-color: #000000;
            font-family: 'Segoe UI', sans-serif;
            color: white;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: sticky;
            top: 0;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            z-index: 100;
        }

        .brand {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 3px;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-size: 13px;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: white;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-email {
            color: rgba(255, 255, 255, 0.35);
            font-size: 12px;
        }

        .btn-logout {
            padding: 8px 20px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 12px;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        /* HERO VERSE SECTION */
        .hero {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 80px 40px;
            position: relative;
            overflow: hidden;
        }

        /* The glow behind the verse */
        .hero::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.04) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .cross {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.2);
            letter-spacing: 4px;
            margin-bottom: 32px;
        }

        .verse-card {
            max-width: 680px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 48px 52px;
            backdrop-filter: blur(10px);
            position: relative;
        }

        .verse-label {
            font-size: 11px;
            letter-spacing: 3px;
            color: rgba(255, 255, 255, 0.3);
            margin-bottom: 24px;
            text-transform: uppercase;
        }

        .verse-text {
            font-size: 22px;
            font-weight: 300;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.9);
            font-style: italic;
            margin-bottom: 24px;
        }

        .verse-ref {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.35);
            letter-spacing: 2px;
            font-weight: 600;
        }

        /* DIVIDER */
        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0 40px;
            margin-bottom: 32px;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.06);
        }

        .divider-text {
            font-size: 11px;
            letter-spacing: 3px;
            color: rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
        }

        /* USERS TABLE SECTION */
        .table-section {
            padding: 0 40px 60px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 13px;
            letter-spacing: 3px;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
        }

        .btn-add {
            padding: 8px 20px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50px;
            color: white;
            font-size: 12px;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* TABLE */
        .table-wrapper {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        thead tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        thead th {
            padding: 16px 20px;
            text-align: left;
            color: rgba(255, 255, 255, 0.3);
            font-weight: 600;
            letter-spacing: 2px;
            font-size: 11px;
            text-transform: uppercase;
        }

        tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            transition: background 0.2s ease;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        tbody td {
            padding: 16px 20px;
            color: rgba(255, 255, 255, 0.7);
        }

        /* ACTION BUTTONS */
        .btn-edit {
            padding: 6px 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50px;
            color: white;
            font-size: 11px;
            letter-spacing: 1px;
            text-decoration: none;
            margin-right: 8px;
            transition: all 0.3s ease;
        }

        .btn-edit:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .btn-delete {
            padding: 6px 16px;
            background: rgba(255, 60, 60, 0.1);
            border: 1px solid rgba(255, 60, 60, 0.2);
            border-radius: 50px;
            color: rgba(255, 100, 100, 0.9);
            font-size: 11px;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: rgba(255, 60, 60, 0.2);
        }

        .no-users {
            text-align: center;
            padding: 40px;
            color: rgba(255, 255, 255, 0.2);
            font-size: 13px;
            letter-spacing: 2px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="brand">SYNQ.</div>
        <div class="nav-links">
            <a href="homepage.php">HOME</a>
            <a href="read.php">USERS</a>
        </div>
        <div class="nav-right">
            <span class="user-email"><?php echo $_SESSION['email']; ?></span>
            <a href="logout.php" class="btn-logout">LOGOUT</a>
        </div>
    </nav>

    <!-- VERSE SECTION -->
    <section class="hero">
        <div class="cross">✝</div>
        <div class="verse-card">
            <div class="verse-label">Verse of the Day</div>
            <div class="verse-text">
                "For I know the plans I have for you, declares the Lord,
                plans to prosper you and not to harm you,
                plans to give you hope and a future."
            </div>
            <div class="verse-ref">JEREMIAH 29:11</div>
        </div>
    </section>

    <!-- DIVIDER -->
    <div class="divider">
        <div class="divider-line"></div>
        <div class="divider-text">Community</div>
        <div class="divider-line"></div>
    </div>

    <!-- USERS TABLE -->
    <section class="table-section">
        <div class="section-header">
            <span class="section-title">Registered Users</span>
            <a href="signup.html" class="btn-add">+ ADD USER</a>
        </div>

        <div class="table-wrapper">
            <?php
            include 'connection.php';
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['lname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td>
                                    <a href="update.php?id=<?php echo $row['id']; ?>" class="btn-edit">EDIT</a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn-delete">DELETE</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-users">NO USERS FOUND</div>
            <?php endif; ?>
        </div>
    </section>

</body>

</html>
