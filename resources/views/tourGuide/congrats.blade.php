<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> 2Where </title>
      <!-- Bootstrap CSS -->
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      <style>
        .cover{
            width: 100%;
            height: 50%;
          position: absolute;
          background-image: linear-gradient(to top, #68b3ff, transparent);
            bottom: 0;
        }
      </style>
</head>
<body class="bg-light">
    <div class="container">

        <div class="w-100 mb-3" style="height: 50vh;">
          <img src="{{url(asset('images/screens/congrats.jpg'))}}" alt="Congrats!" class="w-100 h-100">
        </div>
       
        <div class="text-content" style="padding: 30px; height:100vh;
    background-image: linear-gradient(to top, #dde2e7, transparent);">
            <h1 style="font-size: 2rem;"> Congratilations!  </h1>
        <p>
         <span style="font-weight: 600">Dear : {{$user}},</span><br>   

            I hope this email finds you well. <br>
            We're excited to tell you that , you were accpeted to be a verified Tour-Guide in 
            our Website! , You can share your own tours and interacts with visitors . 
            Hope you enjoy it . <br>

            <span class="text-end">2Where Team</span>
          
            
        </p>
        </div>

    </div>







<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>