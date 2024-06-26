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
        <table class="table custom-table" >
            <thead>
                <tr>
                    <th>User-Name</th>
                    <th>Phone-No</th>
                    <th>Cars</th>
                </tr>
            </thead>
            <tbody id="userListTableBody">
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function fetchUser() {
                const path = window.location.pathname;
        const segments = path.split('/'); 
        const id = segments[segments.length - 1]; 

        console.log("User ID from URL Path:", id);
        axios.get(`https://apicars.prisms.in/user/get/${id}`)
            .then(response => {
                const user = response.data.User; 
                const userListTableBody = document.getElementById('userListTableBody');

               
                const carRows = user.Cars.map(car => `
                    <tr><td>${car.model}</td></tr>
                `).join('');

                
                const row = `
                    <tr>
                        <td>${user.name}</td>
                        <td>${user.phone_no}</td>
                        <td style="overflow-y: auto;">
                            <table style="height=50vh">
                                <tbody>${carRows}</tbody>
                            </table>
                        </td>
                    </tr>
                `;
                userListTableBody.innerHTML = row;
            })
            .catch(error => console.error('Error fetching user data:', error));
    }

    fetchUser();
        });
    </script>

</body>

</html>
