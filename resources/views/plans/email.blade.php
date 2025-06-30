<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registered Users</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2 style="color: #333;">Registered Users Report</h2>

    <table border="1" cellspacing="0" cellpadding="8" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Paid</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->user->name }}</td>
                <td>{{ $user->user->email }}</td>
                <td>{{ $user->paid ? 'Yes' : 'No'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
