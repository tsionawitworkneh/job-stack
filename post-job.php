<?php

require_once("config/env.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $token = $env['TELEGRAM_BOT_TOKEN'];
    $chat_id = $env['TELEGRAM_CHAT_ID'];

    $title = $_POST['title'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $type = $_POST['type'];
    $salary = $_POST['salary'];
    $description = $_POST['description'];
    $reqs = $_POST['reqs'];

    $message  = "🚨 NEW JOB REQUEST 🚨\n\n";

    $message .= "🏢 Company: $company\n";
    $message .= "💼 Job Title: $title\n";
    $message .= "📍 Location: $location\n";
    $message .= "⏰ Job Type: $type\n";
    $message .= "💰 Salary: $salary\n";
    $message .= "📧 Contact Email: $email\n\n";

    $message .= "📝 Description:\n";
    $message .= "$description\n\n";

    $message .= "✅ Requirements:\n";
    $message .= "$reqs\n\n";

    $message .= "📢 Please review and publish this job from the admin dashboard.";

    $telegram_api_url = "https://api.telegram.org/bot$token/sendMessage";

    $data = [
        'chat_id' => $chat_id,
        'text' => $message
    ];

    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);

    $result = @file_get_contents($telegram_api_url, false, $context);

    if ($result) {

        header("Location: post-job.php?success=1");

        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job | JobStack</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/post-job.css">
</head>
<body>

    <nav class="header">
        <div class="container header-inner">
            <a href="index.php" class="back-link">
                <i class="fa-solid fa-chevron-left"></i>
                <span>Back to Home</span>
            </a>
            <div class="brand">
                <div class="brand-icon">J</div>
                <span class="brand-name">JobStack</span>
            </div>
        </div>
    </nav>

    <main class="container">
        <header class="page-title-section">
            <h1>Post a New Job</h1>
            <p>Connect with the world's best developers and designers.</p>
        </header>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert-success" id="successAlert">
                <div class="alert-content">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>
                        Job request submitted successfully! Our admins will review it shortly.
                    </span>
                </div>
                
                <button class="close-alert" onclick="closeAlert()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        <?php endif; ?>

        <div class="grid-layout">
            
            <section>
                <form action="" method="POST" class="form-card">
                    <div class="form-row form-row-2">
                        <div class="form-group">
                            <label for="title"><i class="fa-solid fa-briefcase"></i> Job Title</label>
                            <input type="text" id="title" name="title" placeholder="e.g. Lead React Developer" required>
                        </div>
                        <div class="form-group">
                            <label for="company"><i class="fa-solid fa-building"></i> Company</label>
                            <input type="text" id="company" name="company" placeholder="e.g. TechFlow Inc" required>
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                            <input type="email" id="email" name="email" placeholder="e.g. contact@techflow.com" required>
                        </div>
                    </div>

                    <div class="form-row form-row-2">
                        <div class="form-group">
                            <label for="location"><i class="fa-solid fa-location-dot"></i> Location</label>
                            <input type="text" id="location" name="location" placeholder="e.g. Remote / London" required>
                        </div>
                        <div class="form-group">
                            <label for="type"><i class="fa-solid fa-clock"></i> Job Type</label>
                            <select id="type" name="type">
                                <option>Full-time</option>
                                <option>Part-time</option>
                                <option>Contract</option>
                                <option>Internship</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="salary"><i class="fa-solid fa-wallet"></i> Salary Range</label>
                        <input type="text" id="salary" name="salary" placeholder="e.g. $90,000 - $120,000">
                    </div>

                    <div class="form-group">
                        <label for="description"><i class="fa-solid fa-file-lines"></i> Description</label>
                        <textarea id="description" name="description" rows="6" placeholder="Describe the role and responsibilities..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="reqs"><i class="fa-solid fa-list-check"></i> Requirements</label>
                        <textarea id="reqs" name="reqs" rows="4" placeholder="List key skills and experience..." required></textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fa-solid fa-paper-plane"></i> Post Job Now
                    </button>
                </form>
            </section>

            
            <aside>
                <div class="sidebar-card">
                    <img src="assets/images/banner.png" class="sidebar-img" alt="Post a job">
                    <h3 class="sidebar-title">Hiring Guidelines</h3>
                    <ul class="guidelines-list">
                        <li><span class="step-num">1</span> Define clear and achievable goals.</li>
                        <li><span class="step-num">2</span> Be specific about the tech stack.</li>
                        <li><span class="step-num">3</span> Highlight your company culture.</li>
                        <li><span class="step-num">4</span> Include salary for better conversion.</li>
                        <li><span class="step-num">5</span> Fast feedback loops win talent.</li>
                    </ul>
                </div>

                <div class="help-box">
                    <h3 class="help-title">Need Help?</h3>
                    <p class="help-text">Our talent experts can help you optimize your job post to attract better candidates.</p>
                    <a href="index.php#contact" class="contact-btn">Contact Support</a>
                </div>
            </aside>
        </div>
    </main>

    <script>

    
    setTimeout(() => {

        const alertBox = document.getElementById("successAlert");

        if (alertBox) {
            alertBox.style.display = "none";
        }

    }, 5000);


    
    if (window.history.replaceState) {

        const cleanUrl = window.location.protocol + "//" +
                         window.location.host +
                         window.location.pathname;

        window.history.replaceState({}, document.title, cleanUrl);
    }

</script>

</body>
</html>