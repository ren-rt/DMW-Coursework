<!DOCTYPE html>
<head>
    <title>Hospital Appointment System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard">
    <header>
        <img src="logo.png" alt="Hospital Logo">
        <h1>Make an Appointment</h1>
     </header>

     <div class="patient-details"
     <h2><b>Patient Details</b></h2><br><br>
     </div>

     <div class="patient-container">
        <form action="index.php" method="post"></form>
           Name:<input type="text" class="search-box" placeholder="Enter name" id="name">
           Age:<input type="text" class="search-box" placeholder="Enter age" id="age">
           Phone Number:<input type="text" class="search-box"  placeholder="Enter phone number" id="Number">
           Email:<input type="text" class="search-box"  placeholder="Enter email" id="Email"><br><br>
     </div>
    
     <div class="search-container">
        <input type="text" class="search-box" placeholder="Search Doctor Name" id="doctorsearch">
        <select class="search-box" id="specializationFilter">
            <option value="">Select Specialization</option>
            <option>Cardiologist</option>
            <option>Neurologist</option>
            <option>Dermatologist</option>
        </select>
        <input type="date" class="search-box" id="dateFilter">
        <button class="btn" onclick="filterDoctors()">Search</button>
     </div>

     <div class="available-time">
        <div class="time-picker">
            <label for="timeFiller">Select Time</label>
            <input type="time" class="time-input" id="timeFiller">
        </div>
        
        <table class="time-slots-table">
        <thead>
       <tr>
        <th>Time Slot</th>
        <th>Status</th>
       </tr>
       </thead>
       <tbody>
       <tr>
        <td>9:00 AM</td>
        <td><span class="status booked">Booked</span></td>
       </tr>
       <tr>
        <td>9:30 AM</td>
        <td><span class="status available">Available</span></td>
       </tr>
       <tr>
        <td>10:00 AM</td>
        <td><span class="status available">Available</span></td>
       </tr>
       <tr>
        <td>10:30 AM</td>
        <td><span class="status booked">Booked</span></td>
       </tr>
       </tbody>
       </table>
    </div>
     <div class="action-btns">
         <button type="submit" class="btn">Confirm</button>
         <button type="button" class="btn" style="background: #f44336;" onclick="close()">Cancel</button>
    </div>
</body>
</html>