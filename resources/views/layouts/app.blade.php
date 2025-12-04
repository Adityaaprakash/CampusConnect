<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusConnect</title>

    <!-- BOOTSTRAP CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #E63946;
            /* Crimson */
            --primary-hover: #D62828;
            --bg-dark: #0F172A;
            /* Slate 900 */
            --surface-dark: #1E293B;
            /* Slate 800 */
            --surface-light: rgba(30, 41, 59, 0.7);
            --text-main: #F8FAFC;
            /* Slate 50 */
            --text-muted: #CBD5E1;
            /* Slate 300 - Lighter for better contrast */
            --border-color: rgba(255, 255, 255, 0.1);
            --glass-bg: rgba(15, 23, 42, 0.6);
            --glass-border: rgba(255, 255, 255, 0.05);
            --shadow-lg: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        }

        [data-theme="light"] {
            --bg-dark: #F1F5F9;
            /* Slate 100 */
            --surface-dark: #FFFFFF;
            /* White */
            --surface-light: rgba(255, 255, 255, 0.7);
            --text-main: #0F172A;
            /* Slate 900 */
            --text-muted: #64748B;
            /* Slate 500 */
            --border-color: rgba(0, 0, 0, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(0, 0, 0, 0.05);
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
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--surface-dark);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Typography */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        /* Utilities */
        .text-muted {
            color: var(--text-muted) !important;
        }

        .text-gradient {
            background: linear-gradient(135deg, #F8FAFC 0%, #94A3B8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        [data-theme="light"] .text-gradient {
            background: linear-gradient(135deg, #0F172A 0%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .text-primary-gradient {
            background: linear-gradient(135deg, #E63946 0%, #FCA5A5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .glass-card {
            background: var(--surface-light);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            transition: background 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Buttons */
        .btn-primary-custom {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(230, 57, 70, 0.3);
        }

        .btn-primary-custom:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(230, 57, 70, 0.4);
            color: white;
        }

        .btn-outline-custom {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 57, 70, 0.2);
        }

        /* Form Controls Override */
        .form-control {
            background: var(--surface-light);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            border-radius: 10px;
            padding: 12px 16px;
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

        /* Navbar Override */
        .navbar-custom {
            background: var(--surface-light);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            transition: background 0.3s ease, border-color 0.3s ease;
        }

        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color) !important;
        }

        /* Restored Card & List Group Styles */
        .card {
            background: var(--surface-light);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            border-radius: 16px;
            transition: background 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        .list-group-item {
            background: transparent;
            border-color: var(--border-color);
            color: var(--text-main);
            transition: background 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        .text-red-custom {
            color: var(--primary-color) !important;
        }

        .bg-red-custom {
            background-color: var(--primary-color) !important;
        }

        .btn-red {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            border-radius: 12px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-red:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 57, 70, 0.3);
        }

        .btn-outline-red {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 12px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-red:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 57, 70, 0.2);
        }
    </style>

    <script>
        // Check local storage for theme preference
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme) {
            document.documentElement.setAttribute('data-theme', currentTheme);
        }
    </script>

</head>

<body>

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- MAIN CONTENT --}}
    <div class="container mt-4 mb-5">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }
    </script>

    @stack('scripts')

</body>

</html>