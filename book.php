<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multhospital - Book Appointment</title>
    <link rel="stylesheet" href="book.css">
</head>
<body>

    <header>
        <div class="logo">
            <span class="mult">Mult</span><span class="hospital">hospital</span>
        </div>
    </header>

    <nav class="sidebar">
        <a href="index.php">Home</a>
        <a href="facilities.html">Our Facilities</a>
        <a href="doctors.html">Our Doctors</a>
        <a href="departments.html">Our Department</a>
        <a href="book.php">Book Appointment</a>
    </nav>

    <div class="main-content">
        <div class="container">
            <h2>Book an Appointment</h2>
            
            <div class="booking-info">
                <p><strong>Working Hours:</strong> Monday to Saturday, 9:00 AM - 5:00 PM</p>
                <p><strong>Note:</strong> We are closed on Sundays. Please select a valid date.</p>
            </div>
            
            <form action="book_appointment.php" method="POST">
                <div class="form-group">
                    <label>Patient Name:</label>
                    <input type="text" name="patient_name" required>
                </div>
                
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="patient_email" required>
                </div>

                <div class="form-group">
                    <label>Select Doctor:</label>
                    <select name="doctor_name" required>
                        <option value="">-- Choose Doctor --</option>
                        <option value="Dr. Angelina louis(Cardiology)">Dr. Angelina louis(Cardiology)</option>
                        <option value="Dr. Iqra Khan(Neurology)">Dr. Iqra Khan(Neurology)</option>
                        <option value="Dr. Shashwati Kathale(Pediatrics)">Dr. Shashwati Kathale(Pediatrics)</option>
                        <option value="Dr. Mayank(Orthopedics)">Dr. Mayank(Orthopedics)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Appointment Date:</label>
                    <input type="date" id="appt_date" name="appointment_date" required>
                    <span id="date_error" class="error"></span>
                </div>

                <div class="form-group">
                    <label>Time Slot:</label>
                    <select name="appointment_time" required>
                        <option value="09:00">09:00 AM</option>
                        <option value="10:00">10:00 AM</option>
                        <option value="11:00">11:00 AM</option>
                        <option value="14:00">02:00 PM</option>
                        <option value="15:00">03:00 PM</option>
                    </select>
                </div>

                <button type="submit">Book Appointment</button>
            </form>
        </div>
    </div>

    <script>
        
        const dateInput = document.getElementById('appt_date');
        const errorMsg = document.getElementById('date_error');

        dateInput.addEventListener('change', function() {
            const date = new Date(this.value);
            if (date.getDay() === 0) {
                this.value = '';
                errorMsg.textContent = "We are closed on Sundays. Please select another day.";
            } else {
                errorMsg.textContent = "";
            }
        });
    </script>

</body>
</html>