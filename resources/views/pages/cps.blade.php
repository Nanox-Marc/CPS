@extends('layouts.app')

@section('content')
@include('layouts.header')


<main class="cps-page">
    <div class="container-fluid">
        <div class="cps-container">
            <div class="table-wrapper">
                <p class="displayDateRange">Displaying Transactions from <span id="fileName" class="date-rage">{{$cutOffStart ?? ''}} - {{$cutOffEnd ?? ''}}</span></p>
                <table id="table_id" class="table table-striped custom-table">
                    <thead>
                        <tr class="table-header">
                          <th class="head-canteen">Employee ID</th>
                         
                          <th class="head-amount">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($transactionCPS as $key => $transactionCPS)
                          <tr>
                            <td>{{$key}}</td>
                          
                            <td>{{$transactionCPS}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>
            <div class="summary-wrapper">
                <div class="card-custom">
                    <div class="card-heading">
                    <p class="card-title-text">Options</p>
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </div>
                    <div class="card-details">
                        <div class="option-wrapper">
                            <form method="POST" action="{{ route('dateFillter.store') }}">
                                @csrf
                                <p class="option-title">Date Fillter :</p>
                                <p class="fillter-title">Start Date</p>
                                <input type="text" id="cutOffStart" name="cutOffStart" class="date-fillter" data-input>
        
                                <p class="fillter-title">End Date</p>
                                <input type="text" id="cutOffEnd" name="cutOffEnd" class="date-fillter" data-input>
                                <button type="submit" class="btn btn-outline-primary btn-search">Search</button>
                            </form>
                        </div>
                        <div id="downloadFile"></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready( function () {
        $("#cutOffStart").flatpickr({
        dateFormat: "n/d/Y",
        });

        $("#cutOffEnd").flatpickr({
            dateFormat: "n/d/Y",
        });
    } );
</script>

<script>


    // var startDate = '{{Session::get('cutOffStart')}}';
    // var endDate = '{{Session::get('cutOffEnd')}}';

    // alert(startDate);

    var title = document.getElementById("fileName").innerHTML;

    $(document).ready(function() {
        var table = $('#table_id').DataTable( {
            
        } );

        

        
        var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
            
            {
                extend: 'excel',
                className: 'btn btn-excel',
                title: "CPS Transactions " + title
            }
            ]
        }).container().appendTo($('#downloadFile'));

        $('.btn-excel').html('Download <i class="fa fa-file" aria-hidden="true"></i>');
        
    } );

    
</script>
@endsection