<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Job Stack- Admin Signin</title>   
</head>
<body>
    <section class="signin-section">

    <div class="signin-card">

        
        
        <div class="signin-header">

            <h2>Admin Portal</h2>

            <p>
                Enter your credentials to access your account
            </p>

        </div>

        
        <form class="signin-form" action="../actions/admin_login_action.php" method="POST">

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

    

    </div>

</section>
</body>
</html>