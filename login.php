<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Job Stack- Signin</title>
</head>
<body>
    <section class="signin-section">

    <div class="signin-card">

        
        <a href="index.php" class="back-home">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Home
        </a>

        

        
        <div class="signin-header">

            <h2>Welcome Back</h2>

            <p>
                Enter your credentials to access your account
            </p>

        </div>

        
        <form class="signin-form" action="actions/login_action.php" method="POST">

            <div class="input-group">

                <label>Email Address</label>

                <input 
                    type="email"
                    name="email"
                    placeholder="name@example.com"
                    required
                >

            </div>

            <div class="input-group">

                <div class="password-label">

                    <label>Password</label>

                    

                </div>

                <input 
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                >

            </div>

            <button type="submit" class="signin-btn">
                Sign In
            </button>

        </form>

        
        <div class="signin-footer">

            <p>
                Don't have an account?
                <a href="register.php">Create account</a>
            </p>

        </div>

    </div>

</section>
</body>
</html>