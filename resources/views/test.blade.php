<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alpine Test</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body>
    <div x-data="{ open: false }">
        <button @click="open = !open" style="padding: 10px; background: blue; color: white;">
            Toggle Menu
        </button>
        <div x-show="open" style="padding: 20px; background: gray; color: white;">
            Menu is Open!
        </div>
    </div>
</body>
</html>
