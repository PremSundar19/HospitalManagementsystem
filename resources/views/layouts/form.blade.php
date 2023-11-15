<!DOCTYPE html>
 <html lang="en">
 <head>
<meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    .admindashboard {
        background-image: url('image/6f6c1538b050072b002dbc06bedaaf90.jpg');
    }

    .hospitaldashboard {
        background-image: url('img/hospital.png');
    }
    .doctordashboard {
        background-image: url('img/doctordashboardbc.png');
    }

    .loginbc {
        background: linear-gradient(to left, #ffcc00, #ff6666, #cc00cc, #3399ff);
    }
    .registerbc{
        background-image: url('image/purple-background-registration.png');
    }
    .anchor {
        color: white;
    }

    .black {
        color: black;
    }
   
    .actualform {
        padding: 0 30px;
    }

    .form {
        box-shadow: 0 4px 8px rgba(250, 250, 250, 0.5);
        border: 1px solid silver;
        border-radius: 25px;
        padding: 15px;
    }
</style>
<script>
      function calculateAge(dobId,ageId,dobErrorId){
          var dob = new Date($(dobId).val());
          var today = new Date();
          var age = today.getFullYear() - dob.getFullYear();
           if((dob.getFullYear() > today.getFullYear())||(dob.getFullYear() === today.getFullYear() && dob.getMonth() > today.getMonth())||(dob.getFullYear() === today.getFullYear() && dob.getMonth() === today.getMonth() && dob.getDate()>today.getDate())){
                 $(dobErrorId).text('please select proper date');
                 $(ageId).val('');
           }else{
            $(dobErrorId).text('');
            if((today.getMonth() < dob.getMonth())||(today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())){
                age--;
           }
            $(ageId).val(age);
           }
      }
</script>
</head>
@yield('content')



</html>