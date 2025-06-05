document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("details");

  if (form) {
    form.addEventListener("submit", function (event) {
      // Get all required inputs inside the form
      const requiredInputs = form.querySelectorAll("[required]");
      let isValid = true;

      // Check each required field
      requiredInputs.forEach(input => {
        if (!input.value.trim()) {
          alert("Please fill in all required fields.");
          input.focus();
          isValid = false;
          // Prevent further checks if one is invalid
          event.preventDefault();
        }
      });

      // If any field is empty, stop form submission
      if (!isValid) {
        event.preventDefault();
      }
    });
  }
});
