<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Garage</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>

<body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
    <div class="container mt-5 ">
        <h2>Go Garage</h2>

        <ul class="nav nav-tabs text-primary" id="myTab">
            <li class="nav-item">
                <a class="nav-link active" id="userList-tab" data-toggle="tab" href="/">User Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#" id="carList-tab">Car Management</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active overflow-scroll" style="height: 80vh; overflow-y: auto;"
                id="userList">
                <h3>User List</h3>
                <button id="showCreateUserForm" class="btn mb-3">Create New User</button>
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="clickable-row" data-href="{{ route('user.info', ['id' => $user['id']]) }}">
                                <td>{{ $user['id'] }}</td>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['phone_no'] }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div id="createUserForm" style="display: none;">
                <h3>Create New User</h3>
                <form id="userForm" action="#">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone no.</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Enter phone number"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add User</button>
                    <button id="cancelCreateUserForm" type="button" class="btn btn-secondary">Cancel</button>

                </form>

            </div>
            <div id="successMessage" class="alert alert-success" style="display: none; margin-top: 10px;">
                User created successfully!
            </div>
            <div id="authuser" class="alert alert-danger" style="display: none; margin-top: 10px;">
                User Already Exists
            </div>
            <div class="tab-pane fade" id="carManagement">
                <div class="container mt-5">
                    <button class="btn mb-3" id="carlistbtn">Car List</button>
                    <button class="btn mb-3" id="servicelistbtn">Servicing List</button>
                    <button class="btn mb-3" id="caraddbtn">Add New Car</button>
                    <button class="btn mb-3" id="addservicebtn">Add Servicing Record</button>
                </div>
                <div class="tab-pane fade show active"style="height: 60vh; overflow-y: auto;" id="carList">
                    <h3>Car List</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Model</th>
                                <th>Purchase Date</th>
                                <th>Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $car)
                                <tr>
                                    <td>{{ $car['id'] }}</td>
                                    <td>{{ $car['model'] }}</td>
                                    <td>{{ $car['purchaseDate'] }}</td>
                                    <td>{{ $car['color'] ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade show" style="height: 60vh; overflow-y: auto;"id="serviceList">
                    <h3>Servicing List</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Model</th>
                                <th>Purchase Date</th>
                                <th>Servicing</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ser as $service)
                                <tr>
                                    <td>{{ $service['id'] ?? 'N/A' }}</td>
                                    <td>{{ $service['model'] ?? 'N/A' }}</td>
                                    <td>{{ $service['purchaseDate'] ?? 'N/A' }}</td>
                                    <td>
                                        <table>
                                            <tbody>
                                                @foreach ($service['Servicing'] as $record)
                                                    <tr>
                                                        <td>{{ $record['servicing_date'] ?? 'N/A' }}</td>
                                                        <td>{{ $record['status'] ?? 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="createCarForm">
                    <h3>Add New Car</h3>
                    <form id="carForm" action="#">
                        <div class="form-group">
                            <label for="id">Id</label>
                            <input type="number" class="form-control" id="carid" placeholder="Enter Id" required>
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" placeholder="Enter Model"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="text" class="form-control" id="color" placeholder="Enter Color"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control date" id="date" required>
                        </div>
                        <button type="submit" class="btn ">Add User</button>
                        <button id="cancelCreateUserForm" type="button" class="btn btn-secondary">Cancel</button>
                    </form>
                    <div id="successMessagecar" class="alert alert-success" style="display: none; margin-top: 10px;">
                        Car added successfully!
                    </div>
                    <div id="auth" class="alert alert-danger" style="display: none; margin-top: 10px;">
                        Add User First
                    </div>
                </div>

                <div id="createServiceForm">
                    <h3>Create Service</h3>
                    <form id="ServiceForm" action="#">
                        <div class="form-group">
                            <label for="id">Id</label>
                            <input type="number" class="form-control" id="serviceid" placeholder="Enter Id"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" required>
                                <option value="">Select Status</option>
                                <option value="finished">Finished</option>
                                <option value="unfinished">Unfinished</option>
                                <option value="scheduled">scheduled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control date" id="date" required>
                        </div>
                        <button type="submit" class="btn ">Add Servicing</button>
                        <button id="cancelCreateUserForm" type="button" class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
                <div id="successMessageservice" class="alert alert-success" style="display: none; margin-top: 10px;">
                    servicing added successfully!
                </div>
            </div>


        </div>

    </div>

</body>

</html>
