<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container mt-5">
        <h1>Add New Employee</h1>

        <div id="error-box" style="color: red
        "></div>

        <form id="employeeForm" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="marital_status" class="form-label">Marital Status</label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="">Select Marital Status</option>
                    <option value="single">Single</option>          
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                    <option value="separated">Separated</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone No.</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="mb-3">
                <label for="nationality" class="form-label">Nationality</label>
                <input type="text" class="form-control" id="nationality" name="nationality" required>
            </div>
            <div class="mb-3">
                <label for="hire_date" class="form-label">Hire Date</label>
                <input type="date" class="form-control" id="hire_date" name="hire_date" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>

            <div class="mb-3" style="float: right">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='/api/employee';">Cancel</button>
            </div>
        </form>
    </div>
<script>
    document.querySelector("[name='phone']").addEventListener("input", function(e) {
        this.value = this.value.replace(/\D/g, '');
    });

    document.getElementById("dob").addEventListener("change", function() {

        let dob = new Date(this.value);
        let today = new Date();

        let age = today.getFullYear() - dob.getFullYear();
        let m = today.getMonth() - dob.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        if (age < 18) {
            alert("Employee must be at least 18 years old.");
            this.value = "";
        }

    });

    document.getElementById('employeeForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        const errorBox = document.getElementById('error-box');
        errorBox.classList.add('d-none');
        errorBox.innerHTML = '';

        try {
            const response = await fetch('/api/employees', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (!response.ok) {

                // Validation errors
                if (result.errors) {
                    let errors = Object.values(result.errors).flat();

                    errorBox.innerHTML = errors.join('<br>');
                    errorBox.classList.remove('d-none');
                }
                else if (result.message) {
                    errorBox.innerHTML = result.message;
                    errorBox.classList.remove('d-none');
                }

                return;
            }

            // Success
            alert('Employee created successfully!');
            window.location.href = '/api/employee';

        } catch (err) {
            errorBox.innerHTML = 'Server error. Please try again.';
            errorBox.classList.remove('d-none');
        }
    });
</script>

</body>
</html>