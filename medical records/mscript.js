document.addEventListener("DOMContentLoaded", function () {
    const searchForm = document.getElementById("search");
    const recordDisplay = document.getElementById("recordDisplay");
    

    if (searchForm) {
        searchForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const patientName = document.getElementById("searchInput").value;
            console.log("Searching for:", patientName);
            fetch("Search.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `patientName=${encodeURIComponent(patientName)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    recordDisplay.innerHTML = `<p class="alert alert-danger">${data.error}</p>`;
                    return;
                }
                if (data.length === 0) {
                    recordDisplay.innerHTML = "<p class='alert alert-info'>No records found.</p>";
                    return;
                }
                let table = `<table class="table table-striped"><tr><th>Patient ID</th><th>Name</th><th>Diagnosis</th><th>Treatment</th><th>Date</th><th>Doctor</th></tr>`;
                data.forEach(record => {
                    table += `<tr>
                        <td>${record.patientID}</td>
                        <td>${record.patientName}</td>
                        <td>${record.Diagnosis}</td>
                        <td>${record.Treatment}</td>
                        <td>${record.Date}</td>
                        <td>${record.DoctorName}</td>
                    </tr>`;
                });
                table += "</table>";
                recordDisplay.innerHTML = table;
            })
            .catch(error => {
                console.error("Error fetching data:", error);
                recordDisplay.innerHTML = "<p class='alert alert-danger'>Error fetching records. See console for details.</p>";
            });
        });
    }
});
