@extends('layout.master')
@section('css')
    <link href="{{asset('vendors/select2/select2.css')}}" rel="stylesheet">
@endsection
@section('title','Admin')

@section('contents')
   <!-- Page Container START -->
   <div class="page-container">
                
    {{-- @php dd($nrc_numbers); @endphp --}}
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header no-gutters has-tab">
            
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <ul class="nav nav-tabs" >
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#list">Admin List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#add">Add New Admin</a>
                </li>
                <li class="nav-item" id="fetchDeleteAdmins">
                    <a class="nav-link" data-toggle="tab" href="#delete">Delete List</a>
                </li>
            </ul>
        </div>
        <div class="container-fluid">
            <div class="tab-content m-t-15">
                <div class="tab-pane fade show active" id="list" >
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-b-30">
                                <div class="col-lg-8">
                                    {{-- <div class="d-md-flex">
                                        <div class="m-b-10">
                                            <select class="custom-select" style="min-width: 180px;">
                                                <option selected>Status</option>
                                                <option value="all">All</option>
                                                <option value="approved">Approved</option>
                                                <option value="pending">Pending</option>
                                                <option value="rejected">Rejected</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-primary" id="eButton">
                                        <i class="anticon anticon-file-excel m-r-5"></i>
                                        <span >Export</span>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover e-commerce-table" id="data-table-list">
                                    <thead>
                                        <tr>
                                            
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Org Name</th>
                                            <th>Create Date</th>
                                            <th>Address</th>
                                          
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($owners as $owner)
                                        @php
                                            ++$i;
                                        @endphp
                                        <tr id="hidearea_{{$owner->id}}">
                                            {{-- <td>
                                                <div class="checkbox">
                                                    <input id="check-item-1" type="checkbox">
                                                    <label for="check-item-1" class="m-b-0"></label>
                                                </div>
                                            </td> --}}
                                            <td>
                                                {{-- {{$owner->id}} --}}
                                                {{ $i }}
                                               
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <h6 class="m-b-0"><a href='{{url("admin/profile-detail/$owner->id")}}'>
                                                        {{$owner->name}}
                                                    </h6>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{$owner->phone_number}}</td>
                                            <td>{{$owner->org_name}}</td>
                                            <td>
                                                {{$owner->created_at->toDateString()}}
                                            </td>
                                            <td>
                                                {{$owner->address}}
                                            </td>    
                                            <td class="text-right">
                                                <a href="{{url("admins/$owner->id/edit")}}">
                                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" style="font-size: 17px;">
                                                        <i class="anticon anticon-edit"  style="color: blue;"></i>
                                                    </button>
                                                </a>
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded delete_admin" data-toggle="modal" data-target="#exampleModal" id="{{$owner->id}}" style="font-size: 17px;">
                                                    <i class="anticon anticon-delete" style="color: red;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                                             
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="tab-pane fade" id="add" >
                    <div class="card">
                        <div class="card-body">
                            
                            <form method="POST" action="{{route('admins.store')}}" enctype='multipart/form-data' id="form-validation" autocomplete="off">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Admin Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Admin Name" name="name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="number" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                        <label for="nrc_no">No</label>
                                        <div class="m-b-15">
                                            <select class="select2" name="nrc_no" id="nrc_no" required>
                                                @for ($i = 1; $i <= 14; $i++)
                                                    <option value="{{$i}}">{{$i}} /</option>
                                                @endfor
                                            </select>
                                        </div>    
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="nrc_location">Location</label>
                                        <div class="m-b-15">
                                            <select class="select2" name="nrc_location" id="nrc_location" required>
                                                @foreach ($nrc_numbers as $nrc_number)
                                                    <option value="{{$nrc_number->prefix_en}}">{{$nrc_number->prefix_en}}</option>
                                                @endforeach
                                                {{-- <option value=""></option> --}}
                                            </select>
                                        </div>    
                                    </div>
                                    <div class="form-group col-md-1">
                                        @php
                                            $nrc_types = ['N','E','P','A','F','TH','G'];
                                        @endphp
                                        <label for="inputState">Type</label>
                                        <select id="inputState" class="select2" name="nrc_type">   
                                            @foreach ($nrc_types as $nrc_type)  
                                                <option value="({{$nrc_type}})">({{$nrc_type}})</option>    
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="nrc_number">Number</label>
                                        <input type="number" class="form-control" id="nrc_number" placeholder="NRC Number" name="nrc_number" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" placeholder="Apartment, studio, or floor" name="address" required>
                                    </div>
                                    
                                    <div class="form-group col-md-3">
                                        <label for="state">State</label>
                                        <div class="m-b-15">
                                            <select class="select2" name="state" id="state" required>
                                                    <option value=""></option>
                                                @foreach ($states as $state)
                                                    <option value="{{$state->code}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                    </div>
                                    <div class="col-md-3">
                                        <label for="city">City/Township</label>
                                        <div class="m-b-15">
                                            <select class="select2" name="city" id="city" required>
                                            </select>                                           
                                        </div>
                                    </div>                                 
                                </div>
                                <div class="form-group">
                                    <h5>Organization Information</h5>
                                </div>   
                               
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="org_name">Organization Name</label>
                                        <input type="text" class="form-control" id="org_name" placeholder="Organization Name" name="org_name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="industry">Industry</label>
                                        <select id="industry" class="select2" name="industry">
                                            @foreach ($industries as $industry)
                                                    <option value="{{$industry->industry}}">{{$industry->industry}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="main_address">Main Address</label>
                                        <input type="text" class="form-control" id="main_address" placeholder="Apartment, studio, or floor" name="main_address" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{-- <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="logo" name="logo">
                                            <label class="custom-file-label" for="customFile">Logo Upload</label>
                                        </div> --}}
                                        <strong>Image:</strong>
                                        <input type="file" name="logo" class="form-control" placeholder="image" id="logo" required>
                                    </div>
                                   
                                </div>
                                <button class="btn btn-primary add_admin" type="submit">
                                    Confirm
                                </button>
                                <button class="btn btn-danger btn-tone m-r-5" type="reset">Clear</button>
                            </div>
                            <!-- Button trigger modal -->

                        </form>
                    </div>
                    
                    
                </div>
                <div class="tab-pane fade" id="delete" >
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-b-30">
                                <div class="col-lg-8">
                                    
                                </div>
                                
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover e-commerce-table" id="data-table-delete">
                                    <thead>
                                        <tr>
                                            
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Organization Name</th>                                         
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="show_delete_admins">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>            
    </div>

<!-- Modal -->

    <!-- Content Wrapper END -->

    <!-- Footer START -->
    <footer class="footer">
        <div class="footer-content">
            <p class="m-b-0">Copyright © 2021 Xsphere. All rights reserved.</p>
            <span>
                <a href="" class="text-gray m-r-15">Terms &amp; Conditions</a>
                <a href="" class="text-gray">Privacy &amp; Policy</a>
            </span>
        </div>
    </footer>
    <!-- Footer END -->

</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Your Action</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to delete this admin?
                <input type="hidden" name="delete_id" id="delete_id">
                <meta name="csrf-token" content="{{ csrf_token() }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger confirm_delete" id="confirm_delete">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Page Container END -->
@endsection
@section('scripts')
<!-- Core Vendors JS -->
{{-- <script src="{{asset('js/vendors.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.min.js')}}"></script>  --}}
<!-- page js -->
<script src="{{asset('vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/pages/datatables.js')}}"></script>
<script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<!-- page js -->



<!-- Core JS -->
<script src="{{asset('js/app.min.js')}}"></script>
<script>
    $('#data-table-add').DataTable();
    $('#data-table-list').DataTable();
    $('#data-table-delete').DataTable();
    $('.select2').select2();
</script>


<script>
    // var password = document.getElementById("password")
    //   , confirm_password = document.getElementById("confirm_password");

    // function validatePassword(){
    //   if(password.value != confirm_password.value) {
    //     confirm_password.setCustomValidity("Passwords Don't Match");
    //   } else {
    //     confirm_password.setCustomValidity('');
    //   }
    // }

    // password.onchange = validatePassword;
    // confirm_password.onkeyup = validatePassword;

    $( "#form-validation" ).validate({
    ignore: ':hidden:not(:checkbox)',
    errorElement: 'label',
    errorClass: 'is-invalid',
    validClass: 'is-valid',
    rules: {
        name: {
            required: true
        },
        phone_number: {
            required: true,
        },
        nrc_number: {
            required: true,
            minlength: 6
            maxlength: 6
        }, 
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 6
        },
        confirm_password: {
            required: true,
            equalTo: '#password'
        },
        address: {
            required: true,
        },
        org_name: {
            required: true,
        },
        main_address: {
            required: true,
            
        }
    }
});
  </script>
  
    <script>
        $('.delete_admin').click(function(){
        var delete_id = this.id;
        
        //console.log(product_id);
        $("#delete_id").val(delete_id);
        
    });
    </script>

    <script>
    $('#confirm_delete').click(function(){
        //console.log("nyi nyi");
        var id = $('[name="delete_id"]').val();
        console.log(id);
        var token = $("meta[name='csrf-token']").attr("content");
        $("#exampleModal").modal('hide');
        
            $.ajax({
                url: "{{url('/admins')}}/"+id,
                type: "DELETE",
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function (data) {
                    $('#hidearea_'+id).remove();
                    //window.location.reload();
                },
                error: function (response) {
                    alert("Something Wrong")
                }
            });
    
    });

    $('#fetchDeleteAdmins').click(function(){
        $.ajax({
            url: "{{route('getDeleteAdmin')}}",
            type: "GET",
            success: function (data) {
                //console.log(data);
                var table = $("#data-table-delete").DataTable();
                table.clear();
                $.each(data, function(i, item) {
                    
                    openPage = function(id) {
                        location.href ="{{ url('admins') }}/"+id+"/restore";
                    }
                    var restore = '<a href="javascript:openPage(' + data[i].id + ')"><button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" style="font-size: 19px;"><i class="anticon anticon-redo"  style="color: green; size:""></i></button></a>';
                    table.row.add([ data[i].id, data[i].name, data[i].phone_number, data[i].org_name, restore]);
                    table.draw();
                    });
            },
            error: function (response) {
                alert("Something Wrong")
            }
        });
    });

    function html_table_to_excel(type)
    {
        var data = document.getElementById('data-table-list');
        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
        XLSX.writeFile(file, 'file.' + type);
    }

    const eButton = document.getElementById('eButton');
    eButton.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });
    </script>

    <script>                                    // accessing townships and cities js
        $('#state').on('change', function() {
            // console.log(this.value);
            var state_id = this.value;
            $.ajax({
                url: "{{route('getTownship')}}",
                type: "GET",
                data: {
                    "state_id" : state_id,
                },
                cache: false,

                success: function(result){
                    if(result){
                        $("#city").empty();
                        $.each(result, function(key, value) {
                            $("#city").append('<option value="' + key + '">' + value.name +
                                '</option>');
                             console.log(key,value);
                        });
                    }else{
                        $("#city").empty();
                    }
                }
            });
        });
    </script>
@endsection