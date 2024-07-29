@extends('layouts.app')

@section('content')
@include('layouts.header')


<main class="cps-page">
    <div class="container">
        <br>
        <h3 class="mb-0">
            <i class="fa fa-plus-circle"></i> Canteen / <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCanteenModal">Add Canteen</button> </h3>
        <div class="cps-container">
            
            <div class="table-wrapper">
                <table id="table_id" class="table table-bordered">
                    <thead>
                        <tr class="table-header">
                          <th class="head-date">Canteen</th>
                          <th class="head-date">Status</th>
                          <th class="head-time">Action</th>
                          {{-- <th class="head-canteen">Name</th>
                          <th class="head-amount">Amount</th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($name as $key => $n)
                        @if($key > 0) 
                          <tr>
                            <td>{{$n->canteen_name}}</td>
                                    @if($n->status =='1')
                            
                                    <td>Active</td>
                                    @else
                                    <td>Inactive</td>
                                
                                    @endif
                                    {{-- <button class="btn btn-danger btn-flat btn-sm remove-user" data-id="{{ $n->id }}" data-action="{{ route('Canteen.destroy',$n->id) }}" onclick="deleteConfirmation({{$n->id}})"><i
                                        class="fa fa-trash text-white"></i></button> --}}
                                    {{-- <form action="{{ route('Canteen.destroy',$n->id) }}" method="POST">
                                        @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger"  type="submit"><i
                                        class="fa fa-trash text-white"></i></button>
                                    </form> --}}
                                </td>
                                <td><a id="editFormBtn" class="text-primary" data-toggle="modal"data-target="#edit{{$n->id}}"><i class="fa fa-edit text-primary"></i></button></a>
                          </tr>

                           <!-- UPDATE STATUS -->
                        <div class="modal fade" id="edit{{$n->id}}" tabindex="-1" role="dialog" aria-labelledby="editStatLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header-custom">
                                <p class="modal-title" id="addUserRoleLabel">Update Status</p>
                                <button type="button" class="close close-custom" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('Canteen.update',$n->id) }}">
                                        @method('PATCH')
                                        @csrf

                                        <div class="input-wrapper">
                                           
                                            <select id="status" class="form-control" name="status">
                                                <option data-placeholder="true" value="">Select Status</option>
                                                @foreach ('App\Models\canteen_stat'::all() as $stat)
                                                <option value="{{$stat->id}}">{{$stat->status}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="input-wrapper input-btn-wrapper">
                                            <button type="submit"  class="btn btn-form">
                                                {{ __('Update') }}
                                            </button>
                                        </div>

                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                        @endif
                        @endforeach
                      </tbody>

                      <!--Add Canteen Modal -->
                    <div class="modal fade" id="addCanteenModal" tabindex="-1" role="dialog" aria-labelledby="addCanteenModalLabel" aria-hidden="true">
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
                                    <div class="input-wrapper">
                                        {{-- <p class="input-label">Canteen Name</p> --}}
                                        <input id="status"  type="hidden" value="1" class="form-control" name="status">
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
                </table>
            </div>
           
        </div>
    </div>
</main>

<script>
    $(document).ready( function () {
        $("#basicDate").flatpickr({
        dateFormat: "F, d Y "
        });

        $("#basicDates").flatpickr({
        dateFormat: "F, d Y "
        });
    } );




    var updated = '{{Session::has('canteenupdated')}}';
    if(updated){
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Updated Successfully',
            timer: 2000
        })
    }

</script>

<script>
    $(document).ready(function() {
        var table = $('#table_id').DataTable( {
            
        } );

        

        
        var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
            
            {
                extend: 'excel',
                className: 'btn btn-excel',
            }
            ]
        }).container().appendTo($('#downloadFile'));

        $('.btn-excel').html('Download <i class="fa fa-file" aria-hidden="true"></i>');
        
    } );
    
</script>
@endsection