function goBack() {
    window.history.back();
}

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