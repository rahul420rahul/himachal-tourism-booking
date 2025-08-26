<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Test</title>
</head>
<body>
    <button id="menuBtn" style="padding: 10px; background: blue; color: white;">
        Toggle Menu
    </button>
    <div id="menu" style="display: none; padding: 20px; background: gray;">
        Menu Content Here
    </div>
    
    <script>
        document.getElementById('menuBtn').onclick = function() {
            var menu = document.getElementById('menu');
            menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>
