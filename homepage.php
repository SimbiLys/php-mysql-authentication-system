<?php
session_start();

// Protect this page — redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?error=Please log in to access this page.');
    exit();
}

$user_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Home</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg: #0d0d0d;
      --card: #161616;
      --border: #2a2a2a;
      --accent: #c8f135;
      --accent-dim: rgba(200,241,53,0.12);
      --text: #f0f0f0;
      --muted: #888;
    }

    body {
      background: var(--bg);
      min-height: 100vh;
      font-family: 'DM Sans', sans-serif;
      color: var(--text);
    }

    body::before {
      content: '';
      position: fixed;
      top: -150px; left: -150px;
      width: 500px; height: 500px;
      background: radial-gradient(circle, rgba(200,241,53,0.07) 0%, transparent 70%);
      pointer-events: none;
    }

    nav {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1.2rem 2.5rem;
      border-bottom: 1px solid var(--border);
      background: rgba(22,22,22,0.8);
      backdrop-filter: blur(10px);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .logo {
      font-family: 'Syne', sans-serif;
      font-size: 1.2rem;
      font-weight: 800;
      color: var(--accent);
      letter-spacing: -0.02em;
    }

    .nav-right {
      display: flex;
      align-items: center;
      gap: 1.2rem;
    }

    .nav-greeting {
      font-size: 0.85rem;
      color: var(--muted);
    }

    .nav-greeting span {
      color: var(--text);
      font-weight: 500;
    }

    .logout-btn {
      background: transparent;
      border: 1px solid var(--border);
      color: var(--muted);
      padding: 0.45rem 1rem;
      border-radius: 8px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.85rem;
      cursor: pointer;
      text-decoration: none;
      transition: border-color 0.2s, color 0.2s;
    }

    .logout-btn:hover {
      border-color: #ff5f5f;
      color: #ff5f5f;
    }

    .hero {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 6rem 2rem;
      animation: fadeUp 0.6s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .badge {
      display: inline-block;
      background: var(--accent-dim);
      color: var(--accent);
      font-family: 'Syne', sans-serif;
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      padding: 0.3rem 0.9rem;
      border-radius: 100px;
      margin-bottom: 1.5rem;
    }

    h1 {
      font-family: 'Syne', sans-serif;
      font-size: clamp(2.5rem, 6vw, 4rem);
      font-weight: 800;
      line-height: 1.05;
      margin-bottom: 1rem;
    }

    h1 span { color: var(--accent); }

    .sub {
      color: var(--muted);
      font-size: 1.1rem;
      max-width: 480px;
      line-height: 1.6;
    }
  </style>
</head>
<body>

  <nav>
    <div class="logo">MyApp</div>
    <div class="nav-right">
      <p class="nav-greeting">Hello, <span><?php echo htmlspecialchars($user_name); ?></span></p>
      <a href="logout.php" class="logout-btn">Log out</a>
    </div>
  </nav>

  <section class="hero">
    <div class="badge">You're in</div>
    <h1>Welcome back,<br/><span><?php echo htmlspecialchars($user_name); ?></span></h1>
    <p class="sub">You're successfully logged in. This is your homepage — we'll build it out together soon.</p>
  </section>

</body>
</html>
