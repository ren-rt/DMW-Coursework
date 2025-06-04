// Search Doctors
function searchDoctors() {
    const specializationId = document.getElementById('specialization').value;
    const dateInput = document.getElementById('appointment-date').value;
    
    // Convert date to YYYY-MM-DD
    const dateParts = dateInput.split('/');
    const formattedDate = `${dateParts[2]}-${dateParts[0]}-${dateParts[1]}`;
    
    fetch(`api/get_doctors.php?date=${formattedDate}&specialization_id=${specializationId}`)
        .then(response => response.json())
        .then(doctors => {
            const container = document.getElementById('available-doctors');
            container.innerHTML = '';
            
            if (doctors.error) {
                container.innerHTML = `<div class="error">${doctors.error}</div>`;
                return;
            }
            
            doctors.forEach(doctor => {
                const card = document.createElement('div');
                card.className = 'doctor-card';
                card.innerHTML = `
                    <h3>${doctor.doctor_name}</h3>
                    <p>${doctor.specialization}</p>
                    <div class="time-slots" id="slots-${doctor.doctor_id}"></div>
                `;
                container.appendChild(card);
                
                // Load time slots
                loadTimeSlots(doctor.doctor_id, formattedDate);
            });
        });
}

// Load Time Slots
function loadTimeSlots(doctorId, date) {
    fetch(`api/get_time_slots.php?doctor_id=${doctorId}&date=${date}`)
        .then(response => response.json())
        .then(slots => {
            const container = document.getElementById(`slots-${doctorId}`);
            container.innerHTML = '';
            
            slots.forEach(slot => {
                const slotElement = document.createElement('div');
                slotElement.className = `time-slot ${slot.status}`;
                slotElement.textContent = formatTime(slot.time);
                
                if (slot.status === 'available') {
                    slotElement.addEventListener('click', () => {
                        document.querySelectorAll('.time-slot').forEach(s => {
                            s.classList.remove('selected');
                        });
                        slotElement.classList.add('selected');
                    });
                }
                
                container.appendChild(slotElement);
            });
        });
}

// Format time (HH:MM to 12-hour format)
function formatTime(time24) {
    const [hours, minutes] = time24.split(':');
    const period = hours >= 12 ? 'PM' : 'AM';
    const hours12 = hours % 12 || 12;
    return `${hours12}:${minutes} ${period}`;
}