@extends('layouts.app')

@section('content')

<div class="custom-navbar">
    <div class="nav-partition nav-links-wrapper">
        <div class="nav-holder logo-holder">
            <img src="{{URL::asset('resources/assets/logo.png')}}" class="nav-logo"/>
            <p class="nav-title">CPS</p>
        </div>

        
    </div>
    <div class="nav-partition ">
        <div class="user-dropdown">
            <div class="nav-holder" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-details">
                    <p class="nav-details">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
                    <p class="nav-details">{{Auth::user()->employee_id}}</p>
                </div>
                <div class="user-img">
                    <img class="img-fluid user-photo" src="{{URL::asset('resources/assets/user-placeholder.png')}}"/>
                </div>
                
            </div>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }} <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
            </div>
        </div>
    </div>
</div>

<main class="canteen-sv">
   <div class="container">
        <div class="card">
            <h5 class="card-header">Transaction Summary</h5>
            <div class="card-body">
                <div class="info-holder">
                    <div class="box-info">
                       
                        <p class="box-value">{{$total}}</p>
                        <p class="box-title">Total Transactions</p>
                    </div>
                    <div class="box-info">
                        <p class="box-value">@foreach($transaction as $c) @if($loop->last){{$c->canteen->canteen_name}}  @endif @endforeach</p>
                        <p class="box-title">Canteen</p>
                    </div>
                    <div class="box-info">
                        <p class="box-value">{{$cutOffTotal}}</p>
                        <p class="box-title">Cut Off Total Amout</p>
                    </div>
                    <div class="box-info">
                        <p class="box-value">{{$cutOffToday}}</p>
                        <p class="box-title">Today's Total Amount</p>
                    </div>
               
                </div>
            </div>
        </div>
        <table id="tableSV" class="table table-striped sv-table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Cashier ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction as $t)
                <tr>
                    <td>{{$t->id}}</td>
                    <td>{{$t->cashierId}}</td>
                    <td>{{$t->date}}</td>
                    <td>{{$t->time}}</td>
                    <td>{{$t->amount}}</td>
                    
                    @endforeach
                </tr>
            </tbody>
        </table>   
   </div>
</main>

<script>
    $(document).ready( function () {
        $('#tableSV').DataTable();
    } );
</script>

@endsection