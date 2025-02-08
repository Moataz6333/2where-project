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
        @if ($photo != "")
        <div class="d-flex justify-content-center" style="position: relative">
            <img src="{{$photo}}" class="img-fluid mt-2"  style="border-radius: 20px 20px 0px 0px;">
            <div class="cover"></div>
        </div>
            
        @endif
        <div class="text-content" style="padding: 30px;
    background-image: linear-gradient(to top, #dde2e7, transparent);">
            <h1 style="font-size: 1.5rem;"> {{$title}}  <span class="badge bg-secondary" style="color: white">New</span></h1>
        <p>
         <span style="font-weight: 600">Dear : {{$user}},</span><br>   

            I hope this email finds you well. <br>
            {{$body}}
            
          
            
        </p>
        <a href="" class="btn btn-info">Check it out</a>
        </div>

    </div>







<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>