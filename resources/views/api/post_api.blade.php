@extends('layouts.main')
@section('content')
<a href="{{route('api.view')}}" class="btn btn-dark m-2">Back</a>
<h2 class="text-center m-3">Post Api</h2>
      <!-- Feedback message -->
      <div style="height: 20px" class="m-2">
        <p id="copyMessage" class="text-success " style="display: none;">Link copied to clipboard!</p>

      </div>

<table class="table table-striped">
    <thead class="thead-dark ">
      <tr>
        
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">requirments</th>
        <th scope="col">return</th>
        <th scope="col">copy</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">/login</th>

        <td>Login for users</td>

        <td>email , password</td>

        <td>
            token , user
        </td>


        <td> <input type="text" value="{{ url('/api/login') }}" id="link1" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(1)">copy</button></td>
      </tr>

      <tr>
        <th scope="row">/register</th>

        <td>registration for users</td>

        <td>name ,email , password, password_confirmation , birthDate</td>

        <td>
            message , user
        </td>


        <td> <input type="text" value="{{ url('/api/register') }}" id="link2" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(2)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">/subsecripe</th>

        <td>subsecripe for emails</td>

        <td>email </td>

        <td>
            message
        </td>


        <td> <input type="text" value="{{ url('/api/subsecripe') }}" id="link3" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(3)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">/request-rest</th>

        <td>users request for a restaruants</td>

        <td>  title,  ,rate , categories , price , address , hours ,postPhoto(input) <br> ,menu[array of images] , images[array of images] ,proofs[]</td>

        <td>
           rest , message
        </td>


        <td> <input type="text" value="{{ url('/api/request-rest') }}" id="link4" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(4)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">/request-hotel</th>

        <td>users request for a Hotels</td>

        <td>  title,  ,rate , features , price , address , link ,postPhoto(photo) <br>  , images[array of photos] , proofs []</td>

        <td>
           hotel , message
        </td>


        <td> <input type="text" value="{{ url('/api/request-hotel') }}" id="link5" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(5)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">/logout</th>

        <td>delete the current token</td>

        <td>Authentication header + token </td>

        <td>
          message
        </td>


        <td> <input type="text" value="{{ url('/api/logout') }}" id="link6" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(6)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">/accept-policies</th>

        <td>accept policies</td>

        <td>Authentication header + token </td>

        <td>
          message
        </td>


        <td> <input type="text" value="{{ url('/api/accept-policies') }}" id="link7" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(7)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">/contact-us</th>

        <td>contact us </td>

        <td>name , email , text , phone </td>

        <td>
          message
        </td>


        <td> <input type="text" value="{{ url('/api/contact-us') }}" id="link8" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(8)">copy</button></td>
      </tr>
      
      <tr class="table-primary">
        <th scope="row" >/tourGide-request</th>

        <td>request to be tour-guide</td>

        <td>user_id , about , areas , languagues , experience , licence (input file) </td>

        <td>
          message
        </td>


        <td> <input type="text" value="{{ url('/api/tourGide-request') }}" id="link9" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(9)">copy</button></td>
      </tr>
      <tr class="table-primary">
        <th scope="row">/addprofilePic</th>

        <td>Add or update profile picture for user</td>

        <td> image (input file) ,token </td>

        <td>
          message
        </td>


        <td> <input type="text" value="{{ url('/api/addprofilePic') }}" id="link10" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(10)">copy</button></td>
      </tr>
      <tr class="table-primary">
        <th scope="row">/deleteprofilePic</th>

        <td>delete profile picture for user</td>

        <td> token </td>

        <td>
          message
        </td>


        <td> <input type="text" value="{{ url('/api/deleteprofilePic') }}" id="link11" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(11)">copy</button></td>
      </tr>
      <tr class="table-primary">
        <th scope="row">/addAlbum</th>

        <td>add album of photos</td>

        <td> title , images[] </td>

        <td>
          message
        </td>


        <td> <input type="text" value="{{ url('/api/addAlbum') }}" id="link12" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(12)">copy</button></td>
      </tr>
      <tr class="table-primary">
        <th scope="row">/addPhoto</th>

        <td>add photos for album</td>

        <td> album_id , images[] </td>

        <td>
          message
        </td>


        <td> <input type="text" value="{{ url('/api/addPhoto') }}" id="link13" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(13)">copy</button></td>
      </tr class="table-primary">
      <tr class="table-primary">
        <th scope="row">/deletePhoto</th>

        <td>delete photo for album</td>

        <td> photo_id , token </td>

        <td>
          message
        </td>


        <td> <input type="text" value="{{ url('/api/deletePhoto') }}" id="link14" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(14)">copy</button></td>
      </tr>
      <tr class="table-primary">
        <th scope="row">/deleteAlbum</th>

        <td>delete album</td>

        <td> album_id , token </td>

        <td>
          message
        </td>


        <td> <input type="text" value="{{ url('/api/deleteAlbum') }}" id="link15" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(15)">copy</button></td>
      </tr>
      <tr class="table-warning">
        <th scope="row">/addBlog</th>

        <td>create blogs </td>

        <td>  token , description(op) ,images[] (op) ,</td>

        <td>
          message ,blog
        </td>


        <td> <input type="text" value="{{ url('/api/addBlog') }}" id="link16" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(16)">copy</button></td>
      </tr>
      <tr class="table-warning">
        <th scope="row">/editBlog</th>

        <td>edit blog </td>

        <td>  token ,blog_id , description(op) ,images[] (op) ,</td>

        <td>
          message ,blog
        </td>


        <td> <input type="text" value="{{ url('/api/editBlog') }}" id="link17" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(17)">copy</button></td>
      </tr>
      <tr class="table-warning">
        <th scope="row">/delBlog/{id}</th>

        <td>delete blog with id</td>

        <td>  token , id of the blog (in the url)</td>

        <td>
          message 
        </td>


        <td> <input type="text" value="{{ url('/api/delBlog/{id}') }}" id="link18" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(18)">copy</button></td>
      </tr>
      <tr class="table-warning">
        <th scope="row">/delBlogPhoto</th>

        <td>delete photo in a blog</td>

        <td>  token , photo_id</td>

        <td>
          message 
        </td>


        <td> <input type="text" value="{{ url('/api/delBlogPhoto') }}" id="link19" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(19)">copy</button></td>
      </tr>
      <tr class="table-success">
        <th scope="row">/like</th>

        <td>like a blog</td>

        <td>  token , blog_id</td>

        <td>
          message 
        </td>


        <td> <input type="text" value="{{ url('/api/like') }}" id="link20" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(20)">copy</button></td>
      </tr>
      <tr class="table-success">
        <th scope="row">/comment</th>

        <td>comment a blog</td>

        <td>  token , blog_id ,comment</td>

        <td>
          message 
        </td>


        <td> <input type="text" value="{{ url('/api/comment') }}" id="link21" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(21)">copy</button></td>
      </tr>
      <tr class="table-success">
        <th scope="row">/delComment</th>

        <td>delete a comment </td>

        <td>  token , comment_id </td>

        <td>
          message 
        </td>


        <td> <input type="text" value="{{ url('/api/delComment') }}" id="link22" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(22)">copy</button></td>
      </tr>
      
     
     
     
    </tbody>
  </table>
  
 
  
    
    

  









<script>
    function copyLink(id) {
        // Get the hidden input field element
        var copyText = document.getElementById(`link${id}`);

        // Make the input field temporarily visible
        copyText.style.display = "block";
        
        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        document.execCommand("copy");

        // Hide the input field again
        copyText.style.display = "none";

        // Show a message that the link has been copied
        var copyMessage = document.getElementById("copyMessage");
        copyMessage.style.display = "block";
        
        // Hide the message after 2 seconds
        setTimeout(function() {
            copyMessage.style.display = "none";
        }, 2000);
    }
</script>
@endsection