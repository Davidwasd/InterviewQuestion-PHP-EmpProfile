<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<h1 style="text-align: center; margin: 20px 0;">Employee List</h1>
<div style="text-align: center; margin-bottom: 20px;">
    <a href="{{ url('/api/createEmployee') }}" class="btn btn-primary" style="margin-bottom: 20px; float: right; margin-right: 220px;">Add New Employee</a>
</div>
<div style="clear: both;">
    <table class="table table-striped" style="width: 80%; margin: 20px auto;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Marital Status</th>
                <th>Phone No.</th>
                <th>Email</th>
                <th>Address</th>
                <th>Date of Birth</th>
                <th>Nationality</th>
                <th>Hire Date</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee['name'] }}</td>
                    <td>{{ $employee['gender'] }}</td>
                    <td>{{ $employee['marital_status'] }}</td>
                    <td>{{ $employee['phone'] }}</td>
                    <td>{{ $employee['email'] }}</td>
                    <td>{{ $employee['address'] }}</td>
                    <td>{{ $employee['dob'] }}</td>
                    <td>{{ $employee['nationality'] }}</td>
                    <td>{{ $employee['hire_date'] }}</td>
                    <td>{{ $employee['department'] }}</td>
                </tr>
            @endforeach    
        </tbody>
    </table>
</div>
</body>
</html>