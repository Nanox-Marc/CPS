@extends('layouts.app')
@section('content')
@include('layouts.header')

<main class="cps-page">
    <div class="container">
        <div class="cps-container">
            <div class="table-wrapper">
                <table id="table_id" class="table table-stripped custom-table">
                    <thead>
                        <tr class="table-header">
                            <th>Emp ID</th>
                            <th>Role</th>
                            <th>Canteen</th>
                        </tr>
                    </thead>
                    <tbody>
                @foreach($list as $list)
                <tr>
                    <td>{{$list->user_id}}</td>
                    <td>{{$list->roles->role}}</td>
                    <td>{{$list->canteen->canteen_name}}</td>
                    @endforeach
                </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
    <script>
        $('document').ready(function() {
            var divFilter = '';
            $("#table_id").DataTable({

            });
        });
        </script>
@endsection