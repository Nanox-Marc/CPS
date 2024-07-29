@extends('layouts.app')

@section('content')

<main class="terminal-page">
  <div class="scan-first-main rfidHolder">
    <div class="container">
      <div class="card-rfid">
          <div class="top-card">
            <div class="icon-wrapper">
              <img src="{{URL::asset('resources/assets/loop1.gif')}}" class="rfid-icon img-fluid"/>
            </div>
          </div>
          <div class="bottom-card">
            <p class="rfid-title">TAP RFID FOR NEXT TRANSACTION</p>
          {{-- <p class="">{{$rfidNo ?? ''}}</p> --}}
            
            <form class="rfid-search-form" autocomplete="off" method="post" action="{{ route('Rfid.store') }}"> 
              @csrf

              <div class="form-group">
                <input type="text" name="rfdiSearch" class="rfdiSearch-input" id="rfdiSearch" required autofocus>
              </div>
            </form>
          </div>
      </div>
      <div class="credit-holder">
        <p class="credit-text">Copyright © 2020 Nanox Philippines, Inc.</p>
        <p class="credit-text">Information Technology Department || All Rights reserved</p>
        <p class="credit-text esc-info">PRESS ESC TO LOGOUT</p>
      </div>
    </div>
  </div>
</main>

<div class="modal fade exit-modal" id="exitModal" tabindex="-1" role="dialog" aria-labelledby="exitModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <div class="exit-modal-display">
          <div class="exit-modal-icon">
            <div class="icon-border">
              <i class="fa fa-exclamation-triangle logout-icon" aria-hidden="true"></i>
              {{-- <img class="img-fluid logout-icon" src="{{URL::asset('resources/assets/logout.png')}}"/> --}}
            </div>
          </div>
          <div class="exit-modal-text">
            <p class="exit-title">Confirm Logout</p>
            <p class="exit-text">Are you sure you want to logout?</p>
          </div>
        </div>
        <div class="exit-modal-buttons">

          <a class="btn btn-logout" id="closeCPS" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>

        </div>
        <p class="btn-footer">Press Enter Key continue . . .</p>
      </div>
      
    </div>
  </div>
</div>

<script>

    

  document.onkeydown = function(evt) {
      evt = evt || window.event;
      if (evt.keyCode == 27) {
          // alert('Esc key pressed.');
          $(document).ready(function(){
            jQuery.noConflict();
            $('#exitModal').modal('toggle');
          });
      }

      // if (evt.keyCode == 13) {
      //     alert('Enter key pressed.');
      //     // $(document).ready(function(){
      //     //   jQuery.noConflict();
      //     //   $('#exitModal').modal('toggle');
      //     // });
      // }
  };

  $('#exitModal').on('shown.bs.modal', function () {
      
      setTimeout(function (){
          $('#closeCPS').focus();
      });

    })
  
  $(document).ready(function(){

    //click anywhere
    $(".rfidHolder").click(function(){
      document.getElementById("rfdiSearch").focus();
    });

  });

  var failed = '{{Session::has('transactionFailed')}}';
  var success = '{{Session::has('transactionSuccess')}}';
  var rfidX = '{{Session::has('rfidError')}}';

  if(failed){
        Swal.fire({
            icon: 'warning',
            title: 'Transaction Failed',
            text: 'Please Try Again',
            showConfirmButton: false,
            timer: 2500
        })
  }

  if(success){
      Swal.fire({
          icon: 'success',
          title: 'Done',
          text: 'Transaction has been saved!',
          showConfirmButton: false,
          timer: 2500
      })
  }

  if(rfidX){
      Swal.fire({
          icon: 'warning',
          title: 'Unidentified RFID',
          text: 'Please register your RFID and try again.',  
          timer: 2500
      })
  }

  

//   var input = document.getElementById("rfdiSearch");
//   var inputValue = document.getElementById("rfdiSearch").value;

// input.addEventListener("keypress", function() {
//   inputValue = document.getElementById("rfdiSearch").value;
//   if(inputValue.length >= 10){
//     alert("hello world");
//   }
  
// });
</script>

@endsection
