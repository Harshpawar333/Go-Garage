<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>

<body>
    <h2>User</h2>
    <div class="tab-pane fade show active userview " style="height: 80vh;" id="userList">
        <table class="table custom-table">
            <thead>
                <tr>
                    <th>User-Name</th>
                    <th>Phone-No</th>
                    <th>Cars</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['phone_no'] }}</td>
                    <td>
                        <table class="table">
                            <tbody>
                                @foreach ($user['Cars'] as $car)
                                    <tr>
                                        <td>{{ $car['model'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>
