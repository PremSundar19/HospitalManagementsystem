<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style>
        .dashboard {
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: absolute;
            margin: 0;
            height: 100%;
            color: white;
        }

        .red {
            color: red;
        }

        .green {
            color: green;
        }

        .admindashboard {
            background-image: url('image/6f6c1538b050072b002dbc06bedaaf90.jpg');
        }

        .hospitaldashboard {
            background-image: url('image/hospitaldbfinal.jpeg');
        }

        .doctordashboard {
            background-image: url('img/doctordashboardbc.png');
        }

        .loginbc {
            background: linear-gradient(to left, #ffcc00, #ff6666, #cc00cc, #3399ff);
        }

        .registerbc {
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .anchor {
            color: white;
        }

        .black {
            color: black;
        }

        a {
            text-decoration: none;
        }

        .actualform {
            padding: 0 30px;
        }

        .appointmentform {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(55, 75, 85, 0.5);
        }

        .Appointmenttitle {
            color: #007bff;
        }

        .form {
            box-shadow: 0 4px 8px rgba(250, 250, 250, 0.8);
            border: 1px solid silver;
            border-radius: 25px;
            padding: 15px;
            background-color: rgba(50, 50, 50, 0.9);
            backface-visibility: visible;
        }

        .graph-container {
            width: 80%;
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .graph-bar {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 10px;
            margin-bottom: 10px;
        }

        .bar {
            display: inline-block;
            height: 150px;
            width: 50px;
            margin-right: 10px;
            background-color: #2ecc71;
        }

        .bar:nth-child(even) {
            background-color: #e74c3c;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
    <script>
        function calculateAge(dobId, ageId, dobErrorId) {
            var dob = new Date($(dobId).val());
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            if ((dob.getFullYear() > today.getFullYear()) || (dob.getFullYear() === today.getFullYear() && dob.getMonth() > today.getMonth()) || (dob.getFullYear() === today.getFullYear() && dob.getMonth() === today.getMonth() && dob.getDate() > today.getDate())) {
                $(dobErrorId).text('please select proper date');
                $(ageId).val('');
            } else {
                $(dobErrorId).text('');
                if ((today.getMonth() < dob.getMonth()) || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                    age--;
                }
                $(ageId).val(age);
            }
        }
    </script>
</head>
@yield('content')
</html>