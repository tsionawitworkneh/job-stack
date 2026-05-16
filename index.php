<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Stack</title>
    <link rel="stylesheet" href="landing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            Job<span> Stack</span>
        </div>

        <div class="menu-toggle" id="mobile-menu">
            <i class="fa-solid fa-bars"></i>
        </div>

        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#contact">Contact</a></li>

        </ul>


        <div class="cta-btns">
            <a href="register.php" class="btn btn-primary">Get Started</a>
            <a href="login.php" class="btn btn-secondary">Sign In</a>
        </div>
    </nav>

    <section class="container hero" id="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Build your dream <span class="highlight">Job Stack </span>with ease</h1>
                <p>The ultimate platform for developers to showcase their technical expertise and find the perfect role.
                    Connect with top-tier
                    companies and take your career to the next level.
                </p>

                <div class="hero-btns">
                    <a href="register.php" class="btn btn-primary"><i class="fa-solid fa-location-arrow"></i> Get
                        Started</a>
                    <a href="#about" class="btn btn-secondary"><i class="fa-solid fa-circle-info"></i> Learn More</a>
                </div>

                <div class="social-proof">
                    <div class="avatars">
                        <img src="images/man-1.jfif" alt="User Avatar" class="avatar">
                        <img src="images/man-2.jfif" alt="User Avatar" class="avatar">
                        <img src="images/woman-1.jfif" alt="User Avatar" class="avatar">
                        <img src="images/woman-2.jfif" alt="User Avatar" class="avatar">
                        <div class="more">+12k</div>
                    </div>
                    <p class="text">Joined by 12,000+ developers</p>
                </div>
            </div>

            <div class="hero-image">
                <img src="images/hero.png" alt="Hero Image">
            </div>
        </div>

    </section>


    <section class="container about" id="about">
        <div class="about-header">
            <h2>About Us</h2>

            <h1>
                More than just a job board
            </h1>

            <p>
                JobStack was built by developers, for developers.
                We understand the nuances of technical hiring
                and aim to make it as transparent and efficient
                as possible.
            </p>

            <p>
                Our platform allows you to create a dynamic profile
                that highlights your skills, projects, and experience.
                Employers can easily find and connect with you based on
                your unique job stack.
            </p>
        </div>


        <div class="about-grid">

            <div class="about-card">
                <div class="icon-box">
                    <i class="fa-solid fa-bullseye"></i>
                </div>

                <div class="card-content">
                    <h3>Our Mission</h3>

                    <p>
                        To empower developers by providing a platform
                        that truly understands technical excellence.
                    </p>
                </div>
            </div>

            <div class="about-card">
                <div class="icon-box">
                    <i class="fa-solid fa-users"></i>
                </div>

                <div class="card-content">
                    <h3>Our Community</h3>

                    <p>
                        A global network of developers and innovative
                        companies working together.
                    </p>
                </div>
            </div>

            <div class="about-card">
                <div class="icon-box">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <div class="card-content">
                    <h3>Trust & Safety</h3>

                    <p>
                        Verified profiles and secure communication
                        channels for professional growth.
                    </p>
                </div>
            </div>
        </div>

    </section>

    <section class="container how-it-works">
        <div class="process-header">
            <h2>process</h2>
            <h1>How it works</h1>
            <p>Get started with JobStack in three simple steps and accelerate your career growth.</p>
        </div>


        <div class="step-grid">
            <div class="step-card">
                <div class="step-icon blue">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <h3>Create Profile</h3>
                <p>Sign up and build your personalized career account.</p>
                <div class="step-number"><i class="fa-regular fa-circle-check"></i> Step 1</div>
            </div>

            <div class="step-card">
                <div class="step-icon purple">
                    <i class="fas fa-file-upload"></i>
                </div>
                <h3>Upload Resume</h3>
                <p>Upload your CV and let AI analyze your skills instantly.</p>
                <div class="step-number"><i class="fa-regular fa-circle-check"></i> Step 2</div>
            </div>


            <div class="step-card">
                <div class="step-icon orange">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3>Get Matched & Apply</h3>
                <p>Discover matching opportunities and apply with confidence</p>
                <div class="step-number"><i class="fa-regular fa-circle-check"></i> Step 3</div>
            </div>
        </div>
    </section>

    <section class="container job-categories">
        <div class="job-categories-header">
            <h2>Explore</h2>
            <h1>Job Categories</h1>
            <p>Explore the most in-demand technology roles
                and find the perfect path for your career growth.our skills and interests.
            </p>
        </div>

        <div class="categories-grid">
            <div class="category-card">
                <div class="category-icon">
                    <i class="fa-solid fa-code"></i>
                </div>

                <h3>Software Engineering</h3>
            </div>

            <div class="category-card">
                <div class="category-icon">
                    <i class="fa-solid fa-database"></i>
                </div>

                <h3>Data Science & AI</h3>
            </div>

            <div class="category-card">
                <div class="category-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <h3>Cybersecurity</h3>
            </div>

            <div class="category-card">
                <div class="category-icon">
                    <i class="fa-solid fa-pen-ruler"></i>
                </div>

                <h3>UI/UX Design</h3>
            </div>

            <div class="category-card">
                <div class="category-icon">
                    <i class="fa-solid fa-mobile-screen"></i>
                </div>

                <h3>Mobile Development</h3>
            </div>

            <div class="category-card">
                <div class="category-icon">
                    <i class="fa-solid fa-cloud"></i>
                </div>

                <h3>Cloud Computing</h3>
            </div>


        </div>
    </section>



    <script src="script.js"></script>
</body>

</html>