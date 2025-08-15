<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        .error-container { max-width: 600px; margin: 0 auto; }
        h1 { color: #dc2626; font-size: 72px; margin: 0; }
        h2 { color: #374151; margin: 20px 0; }
        p { color: #6b7280; margin: 20px 0; }
        .btn { 
            display: inline-block; 
            padding: 12px 24px; 
            background: #3b82f6; 
            color: white; 
            text-decoration: none; 
            border-radius: 6px; 
            margin: 10px;
        }
        .btn:hover { background: #2563eb; }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>Sorry, the page you are looking for doesn't exist.</p>
        <a href="{{ route('home') }}" class="btn">Go Home</a>
    </div>
</body>
</html>
