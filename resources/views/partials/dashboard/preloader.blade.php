
    <style>
        /* Global Styles */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden; /* Hide scroll during preloading */
        }

        /* Preloader Styles */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            z-index: 9999; /* Ensure it is above all other content */
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease-out;
        }

        #preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .preloader-content {
            text-align: center;
        }

        .preloader-logo {
            width: 150px; /* Adjust size as needed */
            height: auto;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Main Content Styles */
        .content {
            display: none; /* Initially hide the main content */
            padding: 20px;
            text-align: center;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <img src="logo.png" alt="Loading..." class="preloader-logo">
        </div>
    </div>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <h1>Welcome to Arajeez</h1>
        <p>Your journey starts here...</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum.</p>
        <p><a href="#">Explore more</a></p>
    </div>

    <!-- JavaScript to manage preloader -->
    <script>
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            const mainContent = document.getElementById('main-content');

            // Add fade-out effect and display main content
            preloader.classList.add('fade-out');
            mainContent.style.display = 'block'; // Show main content after loading

            // Remove preloader from the DOM after fade out
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500); // Match this duration with the CSS transition time
        });
    </script>

