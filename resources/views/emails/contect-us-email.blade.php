<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <title>User Detail</title>
</head>
<body>

<div class="container mt-5">
    <h1>User Detail</h1>
    <table class="table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Company Name</th>
                <th>Designation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$f_name ?? ''}}</td>
                <td>{{$l_name ?? ''}}</td>
                <td>{{$email ?? ''}}</td>
                <td>{{$company_name ?? ''}}</td>
                <td>{{$designation ?? ''}}</td>
            </tr>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
