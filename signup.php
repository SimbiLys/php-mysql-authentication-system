<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up</title>
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
      --error: #ff5f5f;
    }

    body {
      background: var(--bg);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'DM Sans', sans-serif;
      color: var(--text);
      padding: 2rem;
    }

    body::before {
      content: '';
      position: fixed;
      top: -200px; left: -200px;
      width: 600px; height: 600px;
      background: radial-gradient(circle, rgba(200,241,53,0.07) 0%, transparent 70%);
      pointer-events: none;
    }

    .card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 20px;
      padding: 3rem 2.5rem;
      width: 100%;
      max-width: 440px;
      position: relative;
      animation: fadeUp 0.5s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0; left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--accent), transparent);
    }

    .tag {
      display: inline-block;
      background: var(--accent-dim);
      color: var(--accent);
      font-family: 'Syne', sans-serif;
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      padding: 0.3rem 0.8rem;
      border-radius: 100px;
      margin-bottom: 1.2rem;
    }

    h1 {
      font-family: 'Syne', sans-serif;
      font-size: 2rem;
      font-weight: 800;
      line-height: 1.1;
      margin-bottom: 0.4rem;
    }

    h1 span { color: var(--accent); }

    .subtitle {
      color: var(--muted);
      font-size: 0.9rem;
      margin-bottom: 2rem;
    }

    .form-group {
      margin-bottom: 1.2rem;
    }

    label {
      display: block;
      font-size: 0.82rem;
      font-weight: 500;
      color: var(--muted);
      margin-bottom: 0.45rem;
      letter-spacing: 0.03em;
    }

    input {
      width: 100%;
      background: #1e1e1e;
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 0.8rem 1rem;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      transition: border-color 0.2s, box-shadow 0.2s;
      outline: none;
    }

    input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(200,241,53,0.1);
    }

    input::placeholder { color: #444; }

    .hint {
      font-size: 0.75rem;
      color: var(--muted);
      margin-top: 0.3rem;
    }

    .error-msg {
      display: none;
      font-size: 0.75rem;
      color: var(--error);
      margin-top: 0.3rem;
    }

    .btn {
      width: 100%;
      background: var(--accent);
      color: #0d0d0d;
      border: none;
      border-radius: 10px;
      padding: 0.9rem;
      font-family: 'Syne', sans-serif;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      margin-top: 0.8rem;
      transition: opacity 0.2s, transform 0.15s;
      letter-spacing: 0.03em;
    }

    .btn:hover { opacity: 0.88; transform: translateY(-1px); }
    .btn:active { transform: translateY(0); }

    .footer {
      text-align: center;
      margin-top: 1.5rem;
      font-size: 0.85rem;
      color: var(--muted);
    }

    .footer a {
      color: var(--accent);
      text-decoration: none;
      font-weight: 500;
    }

    .footer a:hover { text-decoration: underline; }

    /* PHP error/success message styles */
    .alert {
      padding: 0.8rem 1rem;
      border-radius: 10px;
      margin-bottom: 1.2rem;
      font-size: 0.88rem;
    }
    .alert-error { background: rgba(255,95,95,0.12); color: var(--error); border: 1px solid rgba(255,95,95,0.3); }
    .alert-success { background: var(--accent-dim); color: var(--accent); border: 1px solid rgba(200,241,53,0.3); }
  </style>
</head>
<body>
  <div class="card">
    <div class="tag">Create Account</div>
    <h1>Join <span>us</span> today</h1>
    <p class="subtitle">Fill in your details to get started.</p>

    <?php
    // Show PHP messages if redirected back with a message
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-error">' . htmlspecialchars($_GET['error']) . '</div>';
    }
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success']) . '</div>';
    }
    ?>

    <form action="create.php" method="POST" id="signupForm">
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" placeholder="e.g. Jane Doe" required />
      </div>

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" required />
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Min. 6 characters" required />
        <p class="hint">At least 6 characters.</p>
      </div>

      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat your password" required />
        <p class="error-msg" id="matchError">Passwords do not match.</p>
      </div>

      <button type="submit" class="btn">Create Account</button>
    </form>

    <div class="footer">
      Already have an account? <a href="login.php">Log in</a>
    </div>
  </div>

  <script>
    const form = document.getElementById('signupForm');
    const pw = document.getElementById('password');
    const cpw = document.getElementById('confirm_password');
    const matchErr = document.getElementById('matchError');

    form.addEventListener('submit', function(e) {
      if (pw.value !== cpw.value) {
        e.preventDefault();
        matchErr.style.display = 'block';
        cpw.focus();
      } else {
        matchErr.style.display = 'none';
      }
    });

    cpw.addEventListener('input', function() {
      if (pw.value === cpw.value) {
        matchErr.style.display = 'none';
      }
    });
  </script>
</body>
</html>
