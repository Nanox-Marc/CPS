@extends('layouts.app')

@section('content')
@include('layouts.header')
<main class="user-page">
    <div class="container-fluid">
        <div class="user-container">
            <div class="table-wrapper">
                <table id="table_id" class="table table-striped custom-table">
                    <thead>
                        <tr class="table-header">
                          <th class="head-date">Date</th>
                          <th class="head-time">Time</th>
                          <th class="head-canteen">Canteen</th>
                          <th class="head-amount">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($transaction as $transaction)
                          <tr>
                            <td>{{$transaction->date}}</th>
                            <td>{{$transaction->time}}</td>
                            <td>{{$transaction->canteen->canteen_name}}</td>
                            <td>{{$transaction->amount}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>
            <div class="summary-wrapper">
                <div class="card-custom">
                    <div class="card-heading">
                        <p class="card-title-text">Summary</p>
                       
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </div>
                    <div class="card-details">
                        <div class="inner-cards">
                            <div class="inner-head">
                                <p class="inner-title">Account Balance :</p>
                            </div>
                            <div class="inner-body">
                                <p class="card-details-text"><span class="peso-text">PHP</span>{{$totalAmount}}</p> 
                            </div>
                        </div>

                        <div class="inner-cards">
                            <div class="inner-head">
                                <p class="inner-title">Total Transaction :</p>
                            </div>
                            <div class="inner-body">
                                <p class="card-details-text">{{$totalCount}}</p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>

$(document).ready( function () {
    $('#table_id').DataTable();
} );
    // $('document').ready(function() {
    //     var divFilter = '';
    //     $("#table_id").DataTable({
    //         language: { search: "" },
    //         searchPanes:true,
    //         dom: '<"headfilter"Bf>t<"footfilter"ip>',
    //         "order": [],
    //         // dom: 'Bftip',
    //         buttons: [
    //             {
    //                 extend: 'searchPanes',
    //                 className: 'btn btn-search',
    //             },
    //             {
    //                 extend: 'csv',
    //                 className: 'btn btn-csv',
    //             }
    //         ],
    //         columnDefs:[
    //             {
    //                 searchPanes:{
    //                     show: true,
    //                 },
    //                 targets: [0, 1, 2],
    //             },
    //         ],

    //     });

    //     $('.btn-search').html('Filter <i class="fa fa-filter" aria-hidden="true"></i>');
    //     $('.btn-csv').html('Download <i class="fa fa-file" aria-hidden="true"></i>');
    //     $('input[type="search"]').attr('placeholder', 'SEARCH');

    
  
    // });
</script>
@endsection