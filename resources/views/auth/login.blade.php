@extends('layouts.app')

@section('content')


<main class="landing">
    <div class="container">
       <div class="card-wrapper">
           <div class="rfid-card">
               <div class="upper-card">
                   <img src="{{URL::asset('resources/assets/app-logo.png')}}" class="img-fluid img-logo"/>
                   <p class="card-login" data-toggle="modal" data-target="#loginModal">LOGIN</p>
               </div>
               <div class="lower-card">
                   <p class="card-project">
                    <span>C</span><span>ashless</span>
                    <span>P</span><span>ayment</span>
                    <span>S</span><span>ystem</span>
                   </p>
               </div>
           </div>
           <p class="credit-text">Copyright © 2020 Nanox Philippines, Inc.</p>
           <p class="credit-text">All Rights reserved</p>
       </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="login-container">
                <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times" aria-hidden="true"></i></button>
                <p class="login-label">Member Login</p>
                
                
                <form method="POST" id="login-form">
                    @csrf
                    <div class="input-wrapper">
                        
                        <input id="username" class="form-control login-textbox" type="text" placeholder="User Name" name="username" required autofocus>
                        <input class="form-control login-textbox @error('password') is-invalid @enderror" id="password" type="password" placeholder="Password" name="password" required autocomplete="current-password">
                    </div>
                    <button type="button" id="sign-in-btn" class="btn btn-primary mb-2 login-btn">
                        {{ __('LOGIN') }}
                    </button>
                </form>


            </div>
          </div>
        </div>
    </div>
</main>

<script>
    // document.onkeydown = function(evt) {
    //   evt = evt || window.event;
    //   if (evt.keyCode == 13) {
    //       alert(Hello World);
    //     // event.preventDefault();
    //     // document.getElementById("myBtn").click();
    //     //   $(document).ready(function(){
    //     //     jQuery.noConflict();
    //     //     $('#cancelModal').modal('toggle');
    //     //   });
    //   }
    // };

    var inputpass = document.getElementById("password");
    inputpass.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        // alert("Hello");
    event.preventDefault();
    document.getElementById("sign-in-btn").click();
    }
    });


    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';

    
    if(exist){
        Swal.fire(
        'Access Denied',
        'The account that you are trying to access is either Disabled or Deactivated, Contact the admin immediately for further details. Thank you!',
        'error'
        )    
    } 



    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#sign-in-btn").on('click', function() {
            $.ajax({
                url:'{{url("login")}}',
                type: 'POST',
                data: $("#login-form").serialize(),
                success: function(login)
    
                {
    
                    login = JSON.parse(login);
                    if (!login.is_granted) {
                        Swal.fire({
                            title: 'Invalid!',
                            text: 'Username or password is incorrect',
                            icon: 'warning'
                        });
                       
                    } else {
                        location.href = "home";
                    }
                    
                    
    
                }
            })
    
        })
    })

</script>
@endsection
