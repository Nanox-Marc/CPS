@extends('layouts.app')

@section('content')

<main class="terminal1">
    <div class="container terminal-container">
        <div class="terminal-holder">
            @foreach($employeeInfo as $employeeInfo) 
                <div class="user-details">
                    <div class="image-holder">
                        <img src="/images/{{$employeeInfo->employee_id}}.jpg" class="img-fluid"/>
                    </div>
                    <div class="details-holder">
                        <p class="user-name" id="customerName">{{$employeeInfo->first_name}} {{$employeeInfo->last_name}}</p>
                        <p class="user-id" id="customerId">{{$employeeInfo->employee_id}}</p>
                    </div>
                </div>
            @endforeach

            
            <div class="transaction-details">
              <form class="transaction-holder" autocomplete="off" id="transaction-form" method="post" action="{{ route('transaction.store') }}">
                @csrf

                <div class="input-holder hide">
                  <p>Cashier ID</p>
                  <input type="text" name="cashierId" class="form-control" id="cashierId" value="{{Auth::user()->employee_id}}" required>
                </div>
                
                <div class="input-holder hide">
                  <p>Canteen Name</p>
                  <input type="text" name="canteen_id" class="form-control" id="canteen_id" value="@foreach($canteen as $canteen) {{$canteen->canteen_id}} @endforeach" required>
                </div>
                
                <div class="input-holder hide">
                  <p>Customer ID</p>
                  <input type="text" name="employeeId" class="form-control input-customer" placeholder="Employee ID" id="employeeId" value="" required>
                </div>

                <div class="input-holder hide">
                  <p>Customer Name</p>
                  <input type="text" name="employeeName" class="form-control input-customer" placeholder="Name" id="employeeName" value=""  required>
                </div>
               

                <div class="input-holder hide">
                  <p>Date</p>
                  <input type="text" name="date" class="form-control" id="date" required>
                </div>

                <script>
                  // var d = new Date();
                  // var n = d.toLocaleDateString();
                  // document.getElementById("date").value = n;

                  var d = new Date();
                  var n = d.getMonth();
                  var m = n+1;
                  var dd = d.getDate();
                  var y = d.getFullYear();
                  var ddd = 0;
                  if(dd<10){
                    ddd = "0"+dd;
                  }else {
                    ddd = dd;
                  }
  
 
                  document.getElementById("date").value = m+"/"+ddd+"/"+y;
                </script>

                <div class="input-holder hide">
                  <p>Time</p>
                  <input type="text" name="time" class="form-control" id="time" required>
                </div>

                <script>
                  // function startTime() {
                    var today = new Date();
                    var h = today.getHours();
                    var m = today.getMinutes();
                    var s = today.getSeconds();
                    m = checkTime(m);
                    s = checkTime(s);
                    document.getElementById('time').value =
                    h + ":" + m;
                    var t = setTimeout(startTime, 500);
                  // }
                  function checkTime(i) {
                    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
                    return i;
                  }
                </script>

                <div class="input-holder hide">
                  <input type="text" name="rfidFirst" class="form-control" id="rfidFirst" value="{{$rfidNo}}" required>
                </div>

                <div class="input-holder">
                  <p class="input-label">Total Amount</p>
                  <input type="number" name="amount" class="form-control input-amount" id="amount" placeholder="0.00" autocomplete="off" autofocus required>
                </div>

                <div class="button-transaction hide">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">Enter</button>
                  <button class="btn btn-secondary" onclick="cancelTransaction()">Cancel</button>
                </div>


                <div class="modal fade confirm-modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      
                      <div class="modal-body second-rfid">
                        <div class="top-div">
                          <button type="button" class="btn close-btn" data-dismiss="modal">
                            <i class="fa fa-times" aria-hidden="true"></i>
                          </button>
                          <img src="{{URL::asset('resources/assets/credit-card.png')}}" class="rfid-icon img-fluid"/>
                          {{-- <i class="fa fa-credit-card" aria-hidden="true"></i> --}}
                          <input type="text" class="rfidSecondScan" name="rfidConfirmation" id="rfidConfirmation" autofocus required>
                        </div>
                        <div class="bottom-div">
                          <div class="confirmation-text">
                            <p class="confirm-title">Confirmation</p>
                            <p class="confirm-text">Tap your RFID to confirm your transaction.</p>
                          </div>
                          
                        </div>
                        
                      </div>
                      
                    </div>
                  </div>
                </div>
                
              </form>
            </div>
        </div>
    </div>
</main>





<div class="modal fade cancel-modal" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exitModalLabel" aria-hidden="true">
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
            <p class="exit-title">Cancel Transaction</p>
            <p class="exit-text">Are you sure you want to cancel this transaction?</p>
          </div>
        </div>
        <div class="exit-modal-buttons">


        <button type="button" class="btn btn-logout" id="cancelTransac" onclick="cancelTransaction()">Yes</button>

        <button type="button" class="btn btn-cancel" data-dismiss="modal">No</button>

        </div>
        <p class="btn-footer"></p>
      </div>
      
    </div>
  </div>
</div>


<script>
    document.onkeydown = function(evt) {
      evt = evt || window.event;
      if (evt.keyCode == 27) {
          $(document).ready(function(){
            jQuery.noConflict();
            $('#cancelModal').modal('toggle');
          });
      }
    };

    $('#cancelModal').on('shown.bs.modal', function () {    
      setTimeout(function (){
          $('#cancelTransac').focus();
      });
    });



    function cancelTransaction() {
      // window.location.href = "http://www.w3schools.com";
      window.location='{{ url("scan") }}'; 
      // alert("Heloo");
    }

    

    var customerName = document.getElementById("customerName").innerHTML;
    document.getElementById("employeeName").value = customerName;

    var customerId = document.getElementById("customerId").innerHTML;
    document.getElementById("employeeId").value = customerId;


    $('#confirmModal').on('shown.bs.modal', function () {    
      setTimeout(function (){
          $('#rfidConfirmation').focus();
      });
    });

    $('#cancelModal').on('shown.bs.modal', function () {
      
      setTimeout(function (){
          $('#cancelkeyBtn').focus();
      });

    })
</script>
   
@endsection