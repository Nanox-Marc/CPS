@extends('layouts.app')
@section('content')
@includes('layouts.header')

<main class="cps-page">
    <div class="container">
        <h3 class="mb-0">
            <i class="fa fa-plus-circle"></i> Cashier / <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCashierModal">Add Cashier</button></h3>
            <div class="cps-container">
                <div class="table-wrapper">
                    <table id="table_id" class="table table-striped custom-table">
                        <thead>
                            <tr class="table-header">
                                <th>Name</th>
                                <th>Emp ID</th>
                                <th>Role</th>
                                <th>Canteen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $list)
                            <tr>
                                <td>{{$list->name}}</td>
                                <td>{{$list->emp_id}}</td>
                                @if($list->role_id =='1')
                                <td>Supervisor</td>
                                @else
                                <td>Cashier</td>
                                @endif
                                <td>{{$list->canteen->canteen_name}}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
<!-- ADD CASHIER -->
<div class="modal fade" id="addCashierModal" tabindex="-1" role="dialog" aria-labelledby="addCashierModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header-custom">
          <p class="modal-title" id="addCashierModal">Add Cashier</p>
          <button type="button" class="close close-custom" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="reg-form">
                @csrf

                <div class="input-wrapper">
                    <p class="input-label">Name</p>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-wrapper">
                    <p class="input-label">Employee ID</p>
                    <input id="emp_id" type="text" class="form-control @error('name') is-invalid @enderror" name="emp_id" value="{{ old('emp_id') }}">
                    @error('emp_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-wrapper">
                    <p class="input-label">Select Role</p>
                    <select id="role_id" class="form-control" name="role_id">
                        <option data-placeholder="true" value="">Select Role</option>
                        @foreach ('App\Models\Canteen_role'::all() as $role)
                        <option value="{{$role->id}}">{{$role->role}}</option>
                        @endforeach
                    </select>
                    {{-- @error('canteen_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
                </div>

                <div class="input-wrapper">
                    <p class="input-label">Canteen</p>
                    <select id="canteen_id" class="form-control" name="canteen_id">
                        <option data-placeholder="true" value="">Select Canteen</option>
                        @foreach ('App\Models\Canteen'::where('status','1')->get() as $c)
                        <option value="{{$c->id}}">{{$c->canteen_name}}</option>
                        @endforeach
                    </select>
                    {{-- @error('canteen_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
                </div>

                <div class="input-wrapper">
                    <p class="input-label">Password</p>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-wrapper">
                    <p class="input-label">Confirm Password</p>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>

                <div class="input-wrapper input-btn-wrapper">
                    <button type="submit" id="reg-btn" class="btn btn-form">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
</div>
<script>
    
    $(function() {
        $("#reg-form").validate({
                rules: {
                    name: {
                        required: true
                    },
                    emp_id: {
                        required: true
                    },
                    role_id: {
                        required: true
                    },
                   canteen_id: {
                        required: true
                    },
                   password: {
                        required: true
                    },
                    password_confirmation: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Name is required"
                    },
                    emp_id: {
                        required: "Employee ID is required"
                    },
                    role_id: {
                        required: "Role is required"
                    },
                    canteen_id: {
                        required: "Canteen is required"
                    },
                    password: {
                        required: "Password is required"
                    },
                    password_confirmation: {
                        required: "Please confirm password"
                    },
                },

        submitHandler: function(form) {
                    $.ajax({
                        url: '{{url("cps")}}',
                        type: 'POST',
                        data: $("#reg-form").serialize(),
                        success: function(data) {
                            if (data == 'emp_exist') {
                                Swal.fire({
                                    title: 'Attention!',
                                    text: 'Employee Already Exists',
                                    icon: 'warning'
                                });
                                return false;
                            } else if (data == "created") {
                                Swal.fire({
                                    title: 'Account has been Registered',
                                    text: '',
                                    icon: 'success'
                                }).then((result => {
                                    location.reload();
                                }));
                            }
                        }
                    })
                }
    })

});
</script>
<script>
     $('document').ready(function() {
            var divFilter = '';
            $("#table_id").DataTable({
                

            });
        });
    </script>
   
        @endsection