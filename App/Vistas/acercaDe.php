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
            const originalButton = document.getElementById("originalButton");
            const originalButton2 = document.getElementById("originalButton2");
            const buttons = document.querySelectorAll(".button1, .button2");

            // Toggle display for originalButton and originalButton2
            originalButton.style.display = "none";
            originalButton2.style.display = "block";

            // Show all buttons with classes button1 and button2
            buttons.forEach(button => {
                button.style.display = "block";
            });
        }
        function regreso() {
            const originalButton = document.getElementById("originalButton");
            const originalButton2 = document.getElementById("originalButton2");
            const buttons = document.querySelectorAll(".button1, .button2");

            // Toggle display for originalButton and originalButton2
            originalButton.style.display = "block";
            originalButton2.style.display = "none";

            // Show all buttons with classes button1 and button2
            buttons.forEach(button => {
                button.style.display = "none";
            });
        }
    </script>
</head>

<body>
<?php if ($isAdmin): ?>
        <div>
            <button id="originalButton" onclick="toggleButtons()">Soy chambeador</button>
            <button id="originalButton2" style="display: none;" onclick="regreso()">Ya no soy chambeador</button>
        </div>
        <div>
            <button class="button1" style="display: none;">Chambeador 1</button>
            <button class="button2" style="display: none;">Chambeador 2</button>
            <button class="button1" style="display: none;">Chambeador 3</button>
            <button class="button2" style="display: none;">Chambeador 4</button>
        </div>
    <?php else: ?>
        <p>Buenas tardes</p>
    <?php endif; ?>
</body>

</html>