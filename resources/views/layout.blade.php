<!DOCTYPE html>
<html>
<head>
    <title>CampusConnect</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #000000 0%, #1a0000 50%, #000000 100%);
            background-attachment: fixed;
            min-height: 100vh;
            color: #ffffff;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(220, 20, 60, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(220, 20, 60, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(220, 20, 60, 0.06) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        
        .container {
            position: relative;
            z-index: 1;
        }
        
        .btn-red {
            background-color: #dc143c;
            border-color: #dc143c;
            color: #ffffff;
        }
        
        .btn-red:hover {
            background-color: #b01030;
            border-color: #b01030;
            color: #ffffff;
        }
        
        .btn-outline-red {
            border-color: #dc143c;
            color: #dc143c;
        }
        
        .btn-outline-red:hover {
            background-color: #dc143c;
            border-color: #dc143c;
            color: #ffffff;
        }
        
        .text-red-custom {
            color: #dc143c !important;
        }
        
        .card {
            background-color: rgba(20, 20, 20, 0.9);
            border: 1px solid rgba(220, 20, 60, 0.3);
            color: #ffffff;
        }
        
        .text-muted {
            color: #aaaaaa !important;
        }
    </style>

</head>
<body>

    @include('components.navbar')

    <div class="container mt-4 mb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
