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

       
        <div class="text-content" style="padding: 30px; height:100vh;
    background-image: linear-gradient(to top, #dde2e7, transparent);">
          
        <p>
         <span style="font-weight: 600">Dear : {{$user}},</span><br>   

         <h3 class="my-2">{{$title}} </h3>
         <p>{{$body}} </p>
             <br>

            <span class="text-end">2Where Team</span>
          
            
        </p>
        </div>

    </div>







<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>