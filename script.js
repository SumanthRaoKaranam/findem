// JavaScript for displaying logo letter by letter
const logoText = "Find'Em";
const logoElement = document.getElementById("logo");
let index = 0;

// Function to display each letter
function displayLetterByLetter() {
    // Get the current letter and check its position to alternate colors
    let currentLetter = logoText[index];
    let spanElement = document.createElement("span");

    // Set color of letter (alternating orange and blue)
    if (index % 2 === 0) {
        spanElement.classList.add("letter-blue");
    } else {
        spanElement.classList.add("letter-orange");
    }

    // Add letter to span
    spanElement.textContent = currentLetter;

    // Append span to logo element
    logoElement.appendChild(spanElement);

    // Move to the next letter
    index++;

    // Reset the logo animation after the whole word is displayed
    if (index === logoText.length) {
        setTimeout(() => {
            logoElement.textContent = ""; // Clear the text
            index = 0; // Reset the index
        }, 1000); // Pause before restarting the animation
    }
}

// Set interval to display letters at regular time intervals
setInterval(displayLetterByLetter, 400); // Adjust speed here
