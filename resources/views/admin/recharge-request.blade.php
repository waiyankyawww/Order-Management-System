@extends('layout.master')
@section('css')
    <link href="{{asset('vendors/select2/select2.css')}}" rel="stylesheet">
@endsection
@section('title','Payment Request')

@section('contents')
<!-- Page Container START -->
<div class="page-container">
                
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
                    <a class="nav-link active" data-toggle="tab" href="#list">Request List</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#add">Add New Admin</a>
                </li>
                <li class="nav-item" id="fetchDeleteAdmins">
                    <a class="nav-link" data-toggle="tab" href="#delete">Delete List</a>
                </li> --}}
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
                                {{-- <div class="col-lg-4 text-right">
                                    <button class="btn btn-primary" id="eButton">
                                        <i class="anticon anticon-file-excel m-r-5"></i>
                                        <span >Export</span>
                                    </button>
                                </div> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover e-commerce-table" id="data-table-list">
                                    <thead>
                                        <tr>
                                            
                                            <th>No</th>
                                            <th>Owner Name</th>
                                            <th>Shop Name</th>
                                            <th>Address</th>
                                            <th>Requested Amount</th>
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
                                               
                                                {{ $i }}
                                               
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <h6 class="m-b-0"><a href='{{url("admin/profile-detail/$owner->id")}}'>
                                                        {{$owner->name}}
                                                    </h6>
                                                </div>
                                            </td>
                                            
                                            <td>{{$owner->org_name}}</td>
                                            <td>
                                                {{$owner->address}}
                                            </td> 
                                            <td>
                                                {{$owner->req_amount}}
                                            </td>   
                                            <td class="text-right">
                                                <a href="{{ url("admin/recharge-confirm/$owner->id") }}">
                                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" style="font-size: 17px;">
                                                        <i class="anticon anticon-check-circle fa-lg" style="color: blue;"></i>                                                    </button>
                                                </a>
                                                <a href="{{url("admins/$owner->id/edit")}}">
                                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" style="font-size: 17px;">
                                                        <i class="anticon anticon-close-circle fa-lg" style="color: red;"></i>                                                    </button>
                                                </a>
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

@endsection