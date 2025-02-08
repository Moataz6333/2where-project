<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('./css/style.css')}}">
</head>
<body>
    <!-- landing div -->
    <div class="landing">
        <!-- logo div -->
         <div class="navBar row" >
            <div class="d-flex align-items-center col-7">
                <div class="logo">
                    <h1 class="logoText"> ESC. </h1>
                   </div>
                   <h2 class="ml-2">{{$test->name}}</h2>
            </div>

            <div class="d-flex align-items-center  col-5 timeAndLoad">
               <div class="d-flex pr-2 align-items-center">
                <p class="grade"><span class="total">{{count($test->questions)}} </span>/ <span class="current">1</span> </p>
                <div class="box">
                    <div id="load"></div>
                </div>
               </div>
            <p class="timeLeft ">Time Left <span id="time" style="visibility: hidden;">{{$test->period}} </span> <span class="TimeLeft"></span></p>
            {{-- <p class="timeLeft ">Time Left <span id="time" style="visibility: hidden;">1 </span> <span class="TimeLeft"></span></p> --}}
          

            </div>

           
         </div>

         <!-- Questions -->
          <div class="questions container mt-4">
            <form action="{{route('results.store',$res->id)}}" method="POST" id="testForm">
                @csrf
                <input type="hidden" id="endTime" value="{{$endDate}}">
                <input type="hidden" name="time_taken" id="timeTaken">
                @foreach ($test->questions as $ques)
                    
               

            <div class="ques ques-{{$i}}">
                <div class="row">
                    <div class="col-7">
                                    <h2 class="title ">{!! $ques->head !!} </h2>
        
                    </div>
                    <div class="QuesImage col-5">
                    @if ($ques->headPhoto != null)
                         <img src="{{$ques->headPhoto}}" alt="">
                    @endif   
                    </div>
                    
                </div>
                <!-- answaers -->
               <div class="answers d-flex justify-content-space-between mt-5">
                <!-- ans -->
                <div class="ans d-flex  flex-column">
                    <div class="ans-image">
                        <img src="{{$ques->op1_photo}}" alt="">

                    </div>
                    <div>
                        <input  type="radio" name="ansForQues-{{$i}}"  value="1" style="width: 33px;">
                        <label class="form-check-label radioLable" for="ansForQues-{{$i}}" > {{$ques->op1}} </label>
                          
                    </div>
                  
                             
                    
                </div>
                <!-- ans -->
                <div class="ans d-flex  flex-column">
                    <div class="ans-image">
                        <img src="{{$ques->op2_photo}}" alt="">

                    </div>
                    <div>
                        <input  type="radio" name="ansForQues-{{$i}}"  value="2" style="width: 33px;">
                        <label class="form-check-label radioLable" for="ansForQues-{{$i}}" > {{$ques->op2}} </label>
                          
                    </div>
                  
                             
                    
                </div>
                <!-- ans -->
                <div class="ans d-flex  flex-column">
                    <div class="ans-image">
                        <img src="{{$ques->op3_photo}}" alt="">

                    </div>
                    <div>
                        <input  type="radio" name="ansForQues-{{$i}}"  value="3" style="width: 33px;">
                        <label class="form-check-label radioLable" for="ansForQues-{{$i}}" > {{$ques->op3}} </label>
                          
                    </div>
                  
                             
                    
                </div>
                <!-- ans -->
                <div class="ans d-flex  flex-column">
                    <div class="ans-image">
                        <img src="{{$ques->op4_photo}}" alt="">

                    </div>
                    <div>
                        <input  type="radio" name="ansForQues-{{$i}}"  value="4" style="width: 33px;">
                        <label class="form-check-label radioLable" for="ansForQues-{{$i++}}" > {{$ques->op4}} </label>
                          
                    </div>
                  
                             
                    
                </div>

               </div>
                  
    
                </div>
                @endforeach


                <div class="d-flex subBtn">
                    <button id="prev" type="button" style="visibility: hidden;">prev</button>
                    <button id="next" type="button">Next</button>

                </div>
               
            </form>

            </div>

          </div>
        



        </div>






        <footer>
            <div class="row p-3" style="margin: 0;">
                <div class="col-lg-4 col-md-5 col-sm-11 contactUs ">
                    <img src="{{asset('./images/logo.png')}}" alt="">
                    <div class="contact">
                        <h2>Contact us : 
                            <a href="https://www.linkedin.com/company/ebc-engineering-bridge-competition/" target="_blank">
                                <i class="fab fa-linkedin"></i>
                            </a>
                             <a href="https://www.facebook.com/cwtebc?mibextid=ZbWKwL" target="_blank">
                            <i class=" first fab fa-facebook"></i>
                        </a>
                        
                        <a href="https://youtube.com/@engineeringbridgecompetiti7508?si=XPLHEI0YBz7TFkAk" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                        
                      </h2>
                      <p>
                        The official website for ESC competition introduced by EBC team from faculty of engineering, Alexandria university.
                      </p>
                    </div>
        
                </div>
                <hr>
                <div class="col-lg-4 col-md-5 col-sm-11 contactUs d-flex justify-content-center">
                    <div class="contact">
                        <h2 class="text-center">Academin supervisors
                      </h2>
                      <p class="text-center" >
                        Eng. Mohamed Saad , Eng. Mohamed Galal
                      </p>
                    </div>
        
                </div>
                <hr>
        
                <div class="col-lg-4 col-md-5 col-sm-11 contactUs d-flex justify-content-center">
                  
                    <div class="contact">
                        <h2 class="text-center">Our Sponsor
                      </h2>
                      <div class="d-flex justify-content-center" style="gap: 16px; flex-wrap: wrap;">
                        <img src="{{asset('./images/s1.png')}}" alt="" style="width: 61.15px; height: 45px;">
                        <img src="{{asset('./images/s2.png')}}" alt="" style="width: 61.15px; height: 45px;">
                        <img src="{{asset('./images/s3.png')}}" alt="" style="width: 45px; height: 45px;">
                      </div>
                    </div>
        
                </div>
        
            </div>
        
            
        </footer>
        
        
        
        
        
        
        
        
        
        
        
        
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <!-- Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="{{asset('./js/ques.js')}}"></script>
        </body>
        </html>