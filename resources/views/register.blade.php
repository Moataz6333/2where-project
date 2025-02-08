<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h4>Register</h4>
                </div>
                @if ($errors->any())
    <div class="alert alert-danger mt-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                @if(session('success'))
                <div class ="alert alert-success">
                      {{ session('success') }}
                         </div>

              @endif
                <div class="card-body">
                    <form method="POST" action="{{route('users.store')}}">
                        @csrf
                        <!-- Name Input -->
                      
                            <div class="row">
                              <div class="col">
                                <input type="text" class="form-control" placeholder="First name" name="f-name">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Last name" name="l-name">
                              </div>
                            </div>
                         

                        <!-- Email Input -->
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <!-- Password Input -->
                        <div class="form-group">
                            <label for="password">Password Confirm</label>
                            <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Password-confirmation" required>
                        </div>

                      
                        <div class="form-group">
                            <label for="birthdate">Birth date</label>
                            <input type="date" name="birthdate" id="birthdate">
                        </div>
                       

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
