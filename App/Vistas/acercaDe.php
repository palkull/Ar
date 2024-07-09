<?php
session_start();
$isAdmin = isset($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de</title>
    <script>
        function toggleButtons() {
            const originalButton = document.getElementById('originalButton');
            const button1 = document.getElementById('button1');
            const button2 = document.getElementById('button2');

            if (originalButton.style.display === 'none') {
                originalButton.style.display = 'block';
                button1.style.display = 'none';
                button2.style.display = 'none';
            } else {
                originalButton.style.display = 'none';
                button1.style.display = 'block';
                button2.style.display = 'block';
            }
            document.addEventListener('click', (event) => {
                if (!event.target.closest('#originalButton')) {
                    originalButton.style.display = 'block';
                    button1.style.display = 'none';
                    button2.style.display = 'none';
                }
            });
        }
    </script>
</head>

<body>
    <?php if ($isAdmin): ?>
        <button id="originalButton" onclick="toggleButtons()">Soy chambeador</button>
        <button id="button1" style="display: none;">Chambeador 1</button>
        <button id="button2" style="display: none;">Chambeador 2</button>
    <?php else: ?>
        <p>Buenas tardes</p>
    <?php endif; ?>
</body>

</html>