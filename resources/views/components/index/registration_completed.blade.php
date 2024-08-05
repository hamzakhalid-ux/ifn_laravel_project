<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Basic Plan - Registration Completed</title>

    <!---Style Sheet-->
    <link rel="stylesheet" href="{{asset('css/indexcss/screens.css')}}" type="text/css" media="all">
    

</head>
<body>

    <header>
        <div class="logo">
          <a href="{{url('/')}}"  rel="noopener noreferrer">
            <img src="{{asset('assets/images/IFN-logo.svg')}}">
          </a>
        </div>


      </header>


    <main>
        <section class="signupbasicplanregistrationcompleted">
          <h3>{{$data['header_message'] ?? ''}}</h3>

        <div class="container">
            <div class="column">

              <div class="price">
                <img src="{{asset('img/Group 1000004411.png')}}">
                <H2>{{$data['logo_message'] ?? ''}}</H2>
                <H5>{{$data['message'] ?? ''}}</H5>

               </div>



               @if ((!empty($data['package_details']->package_id) && ($data['package_details']->package_id == 1)))
               <div class="field-group" style="margin-top: 20px;">
                <div class="column">
                  <a href="{{url('/login')}}">
                    <button style="width: 49%"> Continue</button>
                   
                  </a>
                  <a href="{{url('/signup')}}">
                    <button class="label-title" style="color: #FFF; background-color:#800000;width: 50%"> UPGRADE TO PREMIUM PLAN</button>
                  </a>
                </div>
              </div>
               @else
               <div class="field-group" style="margin-top: 20px;">
                <div class="column">
                  <a href="{{url('/login')}}">
                    <button class="label-title" style="color: #FFF; background-color:#800000;width: 100%"> Continue</button>
                  </a>
                </div>
              </div>
               @endif
                
            </div>
          </div>

        </section>
    </main>
    <footer>

    </footer>




    <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>

    <script src="{{asset('js/indexscript.js')}}"></script>
</body>
</html>
