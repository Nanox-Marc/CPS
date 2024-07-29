@extends('layouts.app')

@section('content')
@include('layouts.header')
<main class="logs-page">
<div class="container"> <br><br>
    <table id="table_logs" class="table table-bordered">
      <thead>
        <tr>
            <th>No</th>
            <th>Date/Time</th>
            <th>User ID</th>
            <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @if($logs->count())
            @foreach($logs as $key => $log)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $log->time }}</td>
                    <td>{{ $log->user_id }}</td>
                    <td>{{ $log->subject }}</td>
                </tr>
            @endforeach
        @endif
      </tbody>
        
       
    </table>
    <br><br>
</div>
    
</main>

<script>
   

    $(document).ready(function() {
        $('#table_logs').DataTable( {
            "lengthMenu": [[10, 20, 50], [10, 20, 50]]
        } );
    } );
</script>

@endsection