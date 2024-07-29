<div class="custom-navbar">
    <div class="nav-partition nav-links-wrapper">
        <div class="nav-holder logo-holder">
            <img src="{{URL::asset('resources/assets/logo.png')}}" class="nav-logo"/>
            <p class="nav-title">CPS</p>
        </div>

        @if($userID == '1')
        {{-- <div class="nav-links">
            <p class="link-text">User</p>
        </div> --}}
        @elseif($userID == '2')
            <a class="nav-links" href="{{ url('user') }}">
                <p class="link-text">User</p>
            </a>
            <a class="nav-links" href="{{ url('cps') }}">
                <p class="link-text">CPS Transactions</p>
            </a>
        @elseif($userID == '3')
            <a class="nav-links" href="{{ url('user') }}">
                <p class="link-text">User</p>
            </a>
            <a class="nav-links" href="{{ url('cps') }}">
                <p class="link-text">CPS Transactions</p>
            </a>
            <a class="nav-links" href="{{ url('canteen') }}">
                <p class="link-text">Canteen</p>
            </a>
            {{-- <a class="nav-links" href="{{ url('cashier') }}">
                <p class="link-text">Cashier</p>
            </a> --}}
            {{-- <a class="nav-links" href="{{ url('roles') }}">
                <p class="link-text">Roles</p>
            </a> --}}
            <a class="nav-links" href="{{ url('logs') }}">
                <p class="link-text">Logs</p>
            </a>
            <div class="nav-links">
                <p class="link-text" type="button" id="settingsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</p>
                <div class="dropdown-menu" aria-labelledby="settingsDropdown">
                    {{-- <a class="dropdown-item" data-toggle="modal" data-target="#addCanteenModal"><i class="dropdown-fa fa fa-cutlery" aria-hidden="true"></i>Add Canteen</a> --}}
                    {{-- <a class="dropdown-item" data-toggle="modal" data-target="#addCashierModal"><i class="dropdown-fa fa fa-user-circle-o" aria-hidden="true"></i>Add Cashier</a> --}}
                    <a class="dropdown-item" data-toggle="modal" data-target="#addUserRole"><i class="dropdown-fa fa fa-users" aria-hidden="true"></i>Set Roles</a>
                    <a class="dropdown-item" href="{{ url('roles') }}"><i class="dropdown-fa fa fa-list"></i>User List</a>
                </div>
            </div>  
        @endif
    </div>
    <div class="nav-partition ">
        <div class="user-dropdown">
            <div class="nav-holder" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-details">
                    <p class="nav-details">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
                    <p class="nav-details">{{Auth::user()->employee_id}}</p>
                </div>
                <div class="user-img">
                    <img class="img-fluid user-photo" src="/images/{{Auth::user()->employee_id}}.jpg"/>
                </div>
                
            </div>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }} <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
            </div>
        </div>
    </div>
</div>

<!-- ADD CANTEEN -->
{{-- <div class="modal fade" id="addCanteenModal" tabindex="-1" role="dialog" aria-labelledby="addCanteenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header-custom">
        <p class="modal-title" id="addCanteenModalLabel">Add Canteen</p>
        <button type="button" class="close close-custom" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('Canteen.store') }}">
                @csrf

                <div class="input-wrapper">
                    <p class="input-label">Canteen Name</p>
                    <input id="canteen_name" type="text" class="form-control" name="canteen_name" required>
                </div>

                <div class="input-wrapper input-btn-wrapper">
                    <button type="submit"  class="btn btn-form">
                        {{ __('ADD') }}
                    </button>
                </div>

                
            </form>
        </div>
        
    </div>
    </div>
</div> --}}

<!-- ADD CASHIER -->
{{-- <div class="modal fade" id="addCashierModal" tabindex="-1" role="dialog" aria-labelledby="addCashierModal" aria-hidden="true">
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
                   
                </div>

                <div class="input-wrapper">
                    <p class="input-label">Canteen</p>
                    <select id="canteen_id" class="form-control" name="canteen_id">
                        <option data-placeholder="true" value="">Select Canteen</option>
                        @foreach ('App\Models\Canteen'::where('status','1')->get() as $c)
                        <option value="{{$c->id}}">{{$c->canteen_name}}</option>
                        @endforeach
                    </select>
                   
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
</div> --}}

<!-- <script>
    function choice1(select) {
        
        var role = select.options[select.selectedIndex].text;
        if (role == "Cashier" || role == "Canteen SV") {
            // alert(role);
            $("#hiddenCanteen").removeClass("hide");
        }
        else {
            $("#hiddenCanteen").addClass("hide");
            var e = document.getElementById("canteen");
            e.options[e.selectedIndex].value = "";
        }
        
    }
</script> -->

<!-- ADD ROLE -->
<div class="modal fade" id="addUserRole" tabindex="-1" role="dialog" aria-labelledby="addUserRoleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header-custom">
        <p class="modal-title" id="addUserRoleLabel">Add Role</p>
        <button type="button" class="close close-custom" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('userRole.store') }}">
                @csrf

                <div class="input-wrapper">
                    <p class="input-label">Employee ID</p>
                    <input id="user_id" type="number" class="form-control special-input" name="user_id">
                </div>

                <!-- <div class="input-wrapper">
                    <p class="input-label">Set Role</p>
                    <select class="form-control" id="role_id" name="role_id" onchange="choice1(this)">
                        <option data-placeholder="true" value="">--Select Role--</option>
                        @foreach ('App\Models\roles'::all() as $role)
                        <option value="{{$role->id}}">{{$role->role}}</option>
                        @endforeach
                    </select>
                </div> -->

                <div class="input-wrapper">
                    <p class="input-label">Set Role</p>
                    <select class="form-control" id="role_id" name="role_id" onchange="choice1(this)">
                        <option data-placeholder="true" value="">--Select Role--</option>
                        <option value="2">Payroll</option>
                        <option value="3">Admin</option>
                        <option value="4">Cashier</option>
                        <option value="5">Canteen SV</option>
                    </select>
                </div>

                <div id="hiddenCanteen" class="input-wrapper">
                    <p class="input-label">Canteen</p>
                    <select class="form-control" id="canteen_id" name="canteen_id">
                        
                        
                        @foreach ('App\Models\Canteen'::where('status','1')->get() as $c)
                            <option value="{{$c->id}}">{{$c->canteen_name}}</option>
                        @endforeach
                    </select>

                    
                </div>

                <div class="input-wrapper input-btn-wrapper">
                    <button type="submit"  class="btn btn-form">
                        {{ __('ADD') }}
                    </button>
                </div>

                
            </form>
        </div>
        
    </div>
    </div>
</div>

<script>



    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('addedRole')}}';
    var existX = '{{Session::has('addedRoleX')}}';
    var existY = '{{Session::has('addedRoleY')}}';
    var canteen = '{{Session::has('addedcanteen')}}';
    var canteenX = '{{Session::has('canteen_exist')}}';
    if(exist){
        Swal.fire({
            icon: 'success',
            title: 'Done',
            text: 'A new user role has been added!',
            timer: 2000
        })
    }

    if(existX){
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'The user ID already existed',
            timer: 2500
        })
    }

    if(existY){
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Invalid User ID',
            timer: 2500
        })
    }

    if(canteen){
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Canteen has been Successfully Added!',
            timer: 2500
        })
    }

    if(canteenX){
        Swal.fire({
            icon: 'warning',
            title: 'Attention',
            text: 'Canteen Already Exists!',
            timer: 2500
        })
    }

    // $(function() {
    //     $("#reg-form").validate({
    //             rules: {
    //                 name: {
    //                     required: true
    //                 },
    //                 emp_id: {
    //                     required: true
    //                 },
    //                canteen_id: {
    //                     required: true
    //                 },
    //                password: {
    //                     required: true
    //                 },
    //                 password_confirmation: {
    //                     required: true
    //                 }
    //             },
    //             messages: {
    //                 name: {
    //                     required: "Name is required"
    //                 },
    //                 emp_id: {
    //                     required: "Employee ID is required"
    //                 },
    //                 canteen_id: {
    //                     required: "Canteen is required"
    //                 },
    //                 password: {
    //                     required: "Password is required"
    //                 },
    //                 password_confirmation: {
    //                     required: "Please confirm password"
    //                 },
    //             },

    //     submitHandler: function(form) {
    //                 $.ajax({
    //                     url: '{{url("cps")}}',
    //                     type: 'POST',
    //                     data: $("#reg-form").serialize(),
    //                     success: function(data) {
    //                         if (data == 'emp_exist') {
    //                             Swal.fire({
    //                                 title: 'Attention!',
    //                                 text: 'Employee Already Exists',
    //                                 icon: 'warning'
    //                             });
    //                             return false;
    //                         } else if (data == "created") {
    //                             Swal.fire({
    //                                 title: 'Account has been Registered',
    //                                 text: '',
    //                                 icon: 'success'
    //                             }).then((result => {
    //                                 location.reload();
    //                             }));
    //                         }
    //                     }
    //                 })
    //             }
    // })

    

    //     submitHandler: function(form) {
    //                 $.ajax({
    //                     url: '{{url("cps")}}',
    //                     type: 'POST',
    //                     data: $("#reg-form").serialize(),
    //                     success: function(data) {
    //                         if (data == 'emp_exist') {
    //                             Swal.fire({
    //                                 title: 'Attention!',
    //                                 text: 'Employee Already Exists',
    //                                 icon: 'warning'
    //                             });
    //                             return false;
    //                         } else if (data == "created") {
    //                             Swal.fire({
    //                                 title: 'Account has been Registered',
    //                                 text: '',
    //                                 icon: 'success'
    //                             }).then((result => {
    //                                 location.reload();
    //                             }));
    //                         }
    //                     }
    //                 })
    //             }
    // })


</script>