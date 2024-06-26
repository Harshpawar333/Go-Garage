
document.addEventListener('DOMContentLoaded', function() {

            
            
            


    document.getElementById('servicelistbtn').addEventListener('click', function() {
        document.getElementById('serviceList').style.display = 'block';
        document.getElementById('carList').style.display = 'none';
        document.getElementById('createCarForm').style.display = 'none';
        document.getElementById('createServiceForm').style.display = 'none';

    })
    document.getElementById('caraddbtn').addEventListener('click', function() {
        document.getElementById('createCarForm').style.display = 'block';
        document.getElementById('carList').style.display = 'none';
        document.getElementById('serviceList').style.display = 'none';
        document.getElementById('createServiceForm').style.display = 'none';

    })
    document.getElementById('addservicebtn').addEventListener('click', function() {
        document.getElementById('createServiceForm').style.display = 'block';
        document.getElementById('carList').style.display = 'none';
        document.getElementById('serviceList').style.display = 'none';
        document.getElementById('createCarForm').style.display = 'none';

    })
    document.getElementById('carlistbtn').addEventListener('click', function() {
        document.getElementById('carList').style.display = 'block';
        document.getElementById('serviceList').style.display = 'none';
        document.getElementById('createCarForm').style.display = 'none';
        document.getElementById('createServiceForm').style.display = 'none';
    });
    document.getElementById('showCreateUserForm').addEventListener('click', function() {
        document.getElementById('userList').style.display = 'none';
        document.getElementById('createUserForm').style.display = 'block';


    });


    document.getElementById('cancelCreateUserForm').addEventListener('click', function() {
        document.getElementById('userList').style.display = 'block';
        document.getElementById('createUserForm').style.display = 'none';


    });

    document.getElementById('userForm').addEventListener('submit', async function(event) {
        event.preventDefault();
        const phone = parseInt(document.getElementById('phone').value);
        const userdata = await axios.get("https://apicars.prisms.in//user/getall");
        document.getElementById('authuser').style.display = 'none ';

        const userauth1 = userdata.data.Users.find(
            user => user.phone_no === phone)
        console.log(userauth1)
        if (!userauth1) {
            document.getElementById('authuser').style.display = 'block ';
            document.getElementById('userForm').reset();
            return;
        } else {
            const formData = {
                name: document.getElementById('name').value,
                phone_no: document.getElementById('phone').value
            };

            axios.post('https://apicars.prisms.in/user/create', formData)
                .then(response => {
                    console.log('User created successfully:', response.data);
                    document.getElementById('successMessage').style.display = 'block';
                    setTimeout(function() {
                        document.getElementById('successMessage').style.display =
                            'none';
                        document.getElementById('userList').style.display = 'block';
                        document.getElementById('createUserForm').style.display =
                            'none';


                    }, 3000);


                })
                .catch(error => {
                    console.error('Error creating user:', error);
                });
        }
    });

    document.getElementById('carForm').addEventListener('submit', async function(event) {
        event.preventDefault();
        const UserId = parseInt(document.getElementById('carid').value);
        const userdata = await axios.get("https://apicars.prisms.in//user/getall");
        const userauth = userdata.data.Users.find(
            user => user.id === UserId)
        console.log(userdata);
        if (!userauth) {
            document.getElementById('auth').style.display = 'block ';
            return;
        } else {
            console.log(document.getElementById('carid').value)
            const formData = {
                ownerid: document.getElementById('carid').value,
                model: document.getElementById('model').value,
                color: document.getElementById('color').value,
                purchase_date: document.getElementById('date').value
            };

            axios.post('https://apicars.prisms.in/car/create', formData)
                .then(response => {
                    console.log('car added successfully:', response.data);

                    document.getElementById('successMessagecar').style.display = 'block ';


                    setTimeout(function() {
                        document.getElementById('successMessagecar').style.display =
                            'none';
                        document.getElementById('carList').style.display = 'block';
                        document.getElementById('createCarForm').style.display =
                            'none';


                    }, 3000);
                })
                .catch(error => {
                    console.error('Error creating user:', error);
                });
        }

    });
    document.getElementById('ServiceForm').addEventListener('submit', function(event) {
        event.preventDefault();
        console.log(document.getElementById('serviceid').value)
        const formData = {
            id: document.getElementById('serviceid').value,
            status: document.getElementById('status').value,
            servicing_date: document.getElementById('date').value
        };
        axios.post('https://apicars.prisms.in/servicing/create', formData)
            .then(response => {
                console.log('service added successfully:', response.data);

                document.getElementById('successMessageservice').style.display = 'block ';


                setTimeout(function() {
                    document.getElementById('successMessageservice').style.display =
                        'none';
                    fetchServiceData()
                    document.getElementById('serviceList').style.display = 'block';
                    document.getElementById('createServiceForm').style.display = 'none';

                }, 3000);
            })
            .catch(error => {
                console.error('Error creating user:', error);
            });


    });


    document.getElementById('carList-tab').addEventListener('click', function() {
        document.getElementById('userList').style.display = 'none';
        document.getElementById('userList-tab').classList.remove('active');
        document.getElementById('carManagement').classList.add('show', 'active');
        document.getElementById('carList-tab').classList.add('active');
        document.getElementById('createUserForm').style.display = 'none';
        document.getElementById('serviceList').style.display = 'none';
        document.getElementById('createCarForm').style.display = 'none';
        document.getElementById('createServiceForm').style.display = 'none';
        document.getElementById('authuser').style.display = 'none';


    });

    document.getElementById('userList-tab').addEventListener('click', function() {
        document.getElementById('userList').style.display = 'block';
        document.getElementById('userList-tab').classList.add('active');
        document.getElementById('carManagement').classList.remove('show', 'active');
        document.getElementById('carList-tab').classList.remove('active');
        document.getElementById('createServicerForm').style.display = 'none';
        document.getElementById('createUserForm').style.display = 'none';
        document.getElementById('createCarForm').style.display = 'none';


    });

});

