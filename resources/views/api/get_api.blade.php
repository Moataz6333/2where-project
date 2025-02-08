@extends('layouts.main')
@section('content')
<a href="{{route('api.view')}}" class="btn btn-dark m-2">Back</a>
<h2 class="text-center m-3">Api of the content of the site</h2>
      <!-- Feedback message -->
      <div style="height: 20px" class="m-2">
        <p id="copyMessage" class="text-success " style="display: none;">Link copied to clipboard!</p>

      </div>

<table class="table table-striped">
    <thead class="thead-dark ">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">view</th>
        <th scope="col">copy</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>/cities</td>
        <td>returns all cities</td>
        <td><a href="{{ url('/api/cities') }}" target="_blank" class="btn btn-primary">view</a></td>

        <td> <input type="text" value="{{ url('/api/cities') }}" id="link1" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(1)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>/cities/1</td>
        <td>returns alexandria</td>
        <td><a href="{{ url('/api/cities/1') }}" target="_blank" class="btn btn-primary">view</a></td>

        <td> <input type="text" value="{{ url('/api/cities/1') }}" id="link2" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(2)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>/safty/1</td>
        <td>safty of alexandria</td>
        <td><a href="{{ url('/api/safty/1') }}" target="_blank" class="btn btn-primary">view</a></td>

        <td> <input type="text" value="{{ url('/api/safty/1') }}" id="link3" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(3)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">4</th>
        <td>/places/1</td>
        <td>places of alexandria</td>
        <td><a href="{{ url('/api/places/1') }}" target="_blank" class="btn btn-primary">view</a></td>

        <td> <input type="text" value="{{ url('/api/places/1') }}" id="link4" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(4)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">5</th>
        <td>/places/posts</td>
        <td>places as posts</td>
        <td><a href="{{ url('/api/places/posts') }}" target="_blank" class="btn btn-primary">view</a></td>

        <td> <input type="text" value="{{ url('/api/places/posts') }}" id="link5" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(5)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">6</th>
        <td>/rests</td>
        <td>all restaraunts</td>
        <td><a href="{{ url('/api/rests') }}" target="_blank" class="btn btn-primary">view</a></td>

        <td> <input type="text" value="{{ url('/api/rests') }}" id="link6" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(6)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">7</th>
        <td>/hotels</td>
        <td>all hotels</td>
        <td><a href="{{ url('/api/hotels') }}" target="_blank" class="btn btn-primary">view</a></td>

        <td> <input type="text" value="{{ url('/api/hotels') }}" id="link7" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(7)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">8</th>
        <td>/plans</td>
        <td>all plans</td>
        <td><a href="{{ url('/api/plans') }}" target="_blank" class="btn btn-primary">view</a></td>

        <td> <input type="text" value="{{ url('/api/plans') }}" id="link8" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(8)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">9</th>
        <td>/place/{id}</td>
        <td>one place</td>
        <td><a href="{{ url('/api/place/1') }}" target="_blank" class="btn btn-primary">view</a></td>

        <td> <input type="text" value="{{ url('/api/place/1') }}" id="link9" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(9)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">10</th>
        <td>/rest/{id}</td>
        <td>one restaraunt</td>
        <td><a href="{{ url('/api/rest/1') }}" target="_blank" class="btn btn-primary">view</a></td>

        <td> <input type="text" value="{{ url('/api/rest/1') }}" id="link10" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(10)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">11</th>
        <td>/hotel/{id}</td>
        <td>one hotels</td>
        <td><a href="{{ url('/api/hotel/1') }}" target="_blank" class="btn btn-primary">view</a></td>

        <td> <input type="text" value="{{ url('/api/hotel/1') }}" id="link11" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(11)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">12</th>

        <td >/user-requests/{user_id}</td>

        <td>users restaruants or hotels</td>

        <td><a href="{{ url('/api/user-requests/1') }}" target="_blank" class="btn btn-primary">view</a></td>


       


        <td> <input type="text" value="{{ url('/api/user-requests/1') }}" id="link12" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(12)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">13</th>

        <td >/me</td>

        <td>user or message</td>

        <td><a href="{{ url('/api/me') }}" target="_blank" class="btn btn-primary">view</a></td>


       


        <td> <input type="text" value="{{ url('/api/me') }}" id="link13" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(13)">copy</button></td>
      </tr>
      <tr>
        <th scope="row">14</th>

        <td >/about</td>

        <td>array of objects</td>

        <td><a href="{{ url('/api/about') }}" target="_blank" class="btn btn-primary">view</a></td>


       


        <td> <input type="text" value="{{ url('/api/about') }}" id="link14" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(14)">copy</button></td>
      </tr>
      <tr class="table-primary">
        <th scope="row">15</th>

        <td >/tourGuides</td>

        <td>array of all TourGuides</td>

        <td><a href="{{ url('/api/tourGuides') }}" target="_blank" class="btn btn-primary">view</a></td>


       


        <td> <input type="text" value="{{ url('/api/tourGuides') }}" id="link15" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(15)">copy</button></td>
      </tr>
      <tr class="table-primary">
        <th scope="row">16</th>

        <td >/tourGuide/{id}</td>

        <td>tourGuide with id</td>

        <td><a href="{{ url('/api/tourGuide/1') }}" target="_blank" class="btn btn-primary">view</a></td>


       


        <td> <input type="text" value="{{ url('/api/tourGuide/1') }}" id="link16" class="form-control mb-3" style="display: none">
            <button class="btn btn-danger" onclick="copyLink(16)">copy</button></td>
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