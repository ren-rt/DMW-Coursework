document.addEventListener('DOMContentLoaded', function() {
    // For Patients: Handle prescription viewing
    const viewButton = document.getElementById('viewButton');
    if (viewButton) {
        viewButton.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default form submission

            const patientName = document.querySelector('input[name="name"]').value.trim();

            if (!patientName) {
                alert('Please enter a patient name');
                return;
            }

            // Show loading state
            const container = document.querySelector('.container');
            container.innerHTML = '<div class="loading">Loading prescriptions...</div>';

            // Fetch prescriptions from backend and display as a table
            fetch('view.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `name=${encodeURIComponent(patientName)}`
            })
            .then(response => response.text())
            .then(html => {
                container.innerHTML = html;
            })
            .catch(error => {
                console.error('Error:', error);
                container.innerHTML = '<div class="error">Error loading data</div>';
            });
        });
    }

    // For Doctors: Handle form validation
    const recordForm = document.getElementById('record');
    if (recordForm) {
        recordForm.addEventListener('submit', function(e) {
            const inputs = this.querySelectorAll('[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    alert(`Please fill in ${input.placeholder}`);
                    isValid = false;
                }
            });

            if (!isValid) e.preventDefault();
        });
    }
});
