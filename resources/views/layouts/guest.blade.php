<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Your CSS / Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #E63946;
            --primary-hover: #D62828;
            --bg-dark: #0F172A;
            --surface-dark: #1E293B;
            --text-main: #F8FAFC;
            --text-muted: #94A3B8;
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.05);
            --shadow-lg: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        }

        [data-theme="light"] {
            --bg-dark: #F1F5F9;
            --surface-dark: #FFFFFF;
            --text-main: #0F172A;
            --text-muted: #64748B;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-dark);
            background-image:
                radial-gradient(circle at 15% 50%, rgba(230, 57, 70, 0.15), transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(230, 57, 70, 0.1), transparent 25%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .login-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 40px;
            border-radius: 24px;
            width: 400px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--glass-border);
            position: relative;
            z-index: 10;
            transition: background 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), #FCA5A5);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            font-size: 32px;
            color: white;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(230, 57, 70, 0.4);
        }

        .form-control {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--text-main);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 16px;
            transition: background 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        .form-control:focus {
            background: var(--surface-dark);
            border-color: var(--primary-color);
            color: var(--text-main);
            box-shadow: 0 0 0 4px rgba(230, 57, 70, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .btn-main {
            background: var(--primary-color);
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(230, 57, 70, 0.3);
        }

        .btn-main:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(230, 57, 70, 0.4);
            color: white;
        }

        h2 {
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-main) !important;
        }

        a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        a:hover {
            color: var(--primary-color);
        }

        .auth-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .theme-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: var(--text-main);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 100;
        }

        .theme-toggle:hover {
            background: var(--primary-color);
            color: white;
        }
    </style>

    <script>
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme) {
            document.documentElement.setAttribute('data-theme', currentTheme);
        }
    </script>

</head>

<body>

    <button class="theme-toggle" onclick="toggleTheme()">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon-stars-fill"
            viewBox="0 0 16 16">
            <path
                d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path
                d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </svg>
    </button>

    <div class="container mt-5" style="max-width: 500px;">
        @yield('content')
    </div>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }
    </script>

</body>

</html>