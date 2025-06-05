document.addEventListener("DOMContentLoaded", function () {
    const userRole = document.getElementById("userRole");
    const insertFormDiv = document.getElementById("insertForm");
    const searchForm = document.getElementById("search");
    const recordDisplay = document.getElementById("recordDisplay");

    // Show and hide insert form
    userRole.addEventListener("change", function () {
        if (userRole.value === "doctor") {
            insertFormDiv.style.display = "block";
        } else {
            insertFormDiv.style.display = "none";
        }
        // Clear results when user role changes
    recordDisplay.innerHTML = "";
    // search input clear
    document.getElementById("searchInput").value = "";
    });

    
    searchForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent default form submission

        const patientID = document.getElementById("searchInput").value;
        const role = userRole.value;

        console.log("Searching for:", { patientID, role });

        fetch("Search.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `patientID=${encodeURIComponent(patientID)}&role=${encodeURIComponent(role)}`
        })
         .then(response => response.json())
        .then(data => {
            console.log("Search results:", data); 

            if (data.error) {
                recordDisplay.innerHTML = `<p style="color: red;">${data.error}</p>`;
                return;
            }

            if (data.length === 0) {
                recordDisplay.innerHTML = "<p>No records found.</p>";
                return;
            }

            // results table 
            let table = "<table border='1'><tr><th>Record ID</th><th>Patient ID</th><th>Name</th><th>Diagnosis</th><th>Treatment</th><th>Date</th><th>Doctor</th></tr>";
            data.forEach(record => {
                table += `<tr>
                    <td>${record.recordID}</td>
                    <td>${record.patientID}</td>
                    <td>${record.name}</td>
                    <td>${record.diagnosis}</td>
                    <td>${record.treatment}</td>
                    <td>${record.date}</td>
                    <td>${record.doctor}</td>
                </tr>`;
            });
            table += "</table>";
            recordDisplay.innerHTML = table;
        })
        .catch(error => {
            console.error("Error fetching data:", error);
            recordDisplay.innerHTML = "<p>Error fetching records. See console for details.</p>";
        });
    });
});