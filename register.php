<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

<section class="signup-section">

    <div class="signup-card">

        
        <a href="index.html" class="back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Home
        </a>

        
        <div class="signup-header">

            <h2>Create Account</h2>

            <p>
                Join 10,000+ developers finding their dream roles
            </p>

        </div>

        
        <form class="signup-form">

            <div class="input-group">
                <label>Full Name</label>
                <input type="text" placeholder="John Doe" required>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" placeholder="name@example.com" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" placeholder="••••••••" required>
                <small>Must be at least 8 characters long</small>
            </div>

            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="signup-btn">
                Create Account
            </button>

        </form>

        
        <div class="signup-footer">
            <p>
                Already have an account?
                <a href="login.php">Sign In</a>
            </p>
        </div>

    </div>

</section>

</body>
</html>