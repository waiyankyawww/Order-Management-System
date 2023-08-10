@extends('layout.master')
@section('css')
<link href="{{asset('vendors/select2/select2.css')}}" rel="stylesheet">
@endsection
@section('title','Branch Request')

@section('contents')
<div class="page-container">
                

    <!-- Content Wrapper START -->
    <div class="main-content">
        
        <div class="page-header no-gutters has-tab">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <div class="notification-toast top-right" id="notification-toast"></div>
            <ul class="nav nav-tabs" >
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#pending">Request Branch List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#approved">Confirmed Branch List</a>
                </li>
               
            </ul>
        </div>
        <div class="container-fluid">
            <div class="tab-content m-t-15">
                <div class="tab-pane fade show active" id="pending" >
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-b-30">
                                <div class="col-lg-8">
                                    <div class="d-md-flex">
                                        <div class="m-b-10">
                                            <select class="custom-select" style="min-width: 180px;">
                                                <option selected>Status</option>
                                                <option value="all">All</option>
                                                <option value="approved">Approved</option>
                                                <option value="pending">Pending</option>
                                                <option value="rejected">Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-primary">
                                        <i class="anticon anticon-file-excel m-r-5"></i>
                                        <span>Export</span>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover e-commerce-table" id="data-table-pending">
                                    <thead>
                                        <tr>
                                            
                                            <th>No</th>
                                            <th>Branch Name</th>
                                            <th>Phone Number</th>
                                            <th>Shop Name</th>
                                            <th>Request Date</th>
                                            <th>Address</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            
                                            <td>
                                                {{$id}}
                                            </td>
                                            <td>
                                               
                                                    {{$branch_name}}
                                                    
                                            </td>
                                            <td>{{$phone_number}}</td>
                                            
                                            <td>
                                                {{$shop_name}}
                                            </td>
                                            <td>
                                                
                                                {{$request_date}}
                                            </td>
                                            <td>
                                                
                                                {{$address}}
                                            </td>
                                            <td class="text-right">
                                                <a href="#">
                                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right" style="font-size: 17px; ">
                                                        <i class="anticon anticon-check"  style="color: blue;"></i>
                                                    </button>
                                                </a>
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded delete_manager" data-toggle="modal" data-target="#exampleModal" style="font-size: 17px;">
                                                    <i class="anticon anticon-delete" style="color: red;"></i>
                                                </button>
                                            </td>
        
                                        </tr>
                                        
                                        
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="tab-pane fade" id="cancel" >
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-b-30">
                                <div class="col-lg-8">
                                    <div class="d-md-flex">
                                        <div class="m-b-10">
                                            <select class="custom-select" style="min-width: 180px;">
                                                <option selected>Status</option>
                                                <option value="all">All</option>
                                                <option value="approved">Approved</option>
                                                <option value="pending">Pending</option>
                                                <option value="rejected">Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-primary">
                                        <i class="anticon anticon-file-excel m-r-5"></i>
                                        <span>Export</span>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover e-commerce-table" id="data-table-cancel">
                                    <thead>
                                        <tr>
                                            
                                            <th>No</th>
                                            <th>Shop Name</th>
                                            <th>Address</th>
                                            <th>Package</th>
                                            <th>Remind Days</th>
                                            <th>Devices</th>
                                            <th>Manager</th>
                                            <th>Status</th>
                                            <th>Rated</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>  
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="tab-pane fade" id="approved" >
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-b-30">
                                <div class="col-lg-8">
                                    <div class="d-md-flex">
                                        <div class="m-b-10">
                                            <select class="custom-select" style="min-width: 180px;">
                                                <option selected>Status</option>
                                                <option value="all">All</option>
                                                <option value="approved">Approved</option>
                                                <option value="pending">Pending</option>
                                                <option value="rejected">Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-primary">
                                        <i class="anticon anticon-file-excel m-r-5"></i>
                                        <span>Export</span>
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover e-commerce-table" id="data-table-approved">
                                    <thead>
                                        <tr>
                                            
                                            <th>No</th>
                                            <th>Branch Name</th>
                                            <th>Phone Number</th>
                                            <th>Shop Name</th>
                                            <th>Request Date</th>
                                            <th>Address</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            
                                            <td>
                                                {{$id}}
                                            </td>
                                            <td>
                                               
                                                    {{$branch_name}}
                                                    
                                            </td>
                                            <td>{{$phone_number}}</td>
                                            
                                            <td>
                                                {{$shop_name}}
                                            </td>
                                            <td>
                                                
                                                {{$request_date}}
                                            </td>
                                            <td>
                                                
                                                {{$address}}
                                            </td>
                                            <td class="text-right">                                                
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded delete_manager" data-toggle="modal" data-target="#exampleModal" style="font-size: 17px;">
                                                    <i class="anticon anticon-close" style="color: red;"></i>
                                                </button>
                                            </td>               
                                        
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>            
    </div>



    <!-- Content Wrapper END -->

    <!-- Footer START -->
    <footer class="footer">
        <div class="footer-content">
            <p class="m-b-0">Copyright © 2019 Xsphere. All rights reserved.</p>
            <span>
                <a href="" class="text-gray m-r-15">Term &amp; Conditions</a>
                <a href="" class="text-gray">Privacy &amp; Policy</a>
            </span>
        </div>
    </footer>
    <!-- Footer END -->

</div>
<!-- Modal -->

<!-- Page Container END -->
@endsection
@section('scripts')
<script src="{{asset('js/vendors.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.min.js')}}"></script>
<!-- page js -->
<script src="{{asset('vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/pages/datatables.js')}}"></script>

<!-- Core JS -->
<script src="{{asset('js/app.min.js')}}"></script>
<script>
    $('#data-table-pending').DataTable();
    $('#data-table-cancel').DataTable();
    $('#data-table-approved').DataTable();
    $('.select2').select2();
</script>
<script>
    function approved() {
    var toastHTML = `<div class="toast fade hide" data-delay="3000">
        <div class="toast-header">
            <i class="anticon anticon-info-circle text-primary m-r-5"></i>
            <strong class="mr-auto">Workatmosphere</strong>
            <small>now</small>
            <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Hello, admin! Request is already approved.
        </div>
    </div>`

    $('#notification-toast').append(toastHTML)
    $('#notification-toast .toast').toast('show');
    setTimeout(function(){ 
        $('#notification-toast .toast:first-child').remove();
    }, 3000);
}

function cancel() {
    var toastHTML = `<div class="toast fade hide" data-delay="3000">
        <div class="toast-header">
            <i class="anticon anticon-info-circle text-primary m-r-5">
            </i>
            <strong class="mr-auto">Workatmosphere</strong>
            <small>now</small>
            <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Hello, admin! Request is already canceled.
        </div>
    </div>`

    $('#notification-toast').append(toastHTML)
    $('#notification-toast .toast').toast('show');
    setTimeout(function(){ 
        $('#notification-toast .toast:first-child').remove();
    }, 3000);
}
</script>
<script>
    $('.approve_shop').click(function(){
    //console.log("nyi nyi");
    var id = this.id;

    
      $.ajax({
         url: "{{route('approve-shop')}}",
        method: "get",
            data: {
              id:id
            },
            success: function (data) {
                setTimeout(location.reload.bind(location), 2000);
            },
            error: function (response) {
               alert("Something Wrong") // I'm always get this.
            }
        });
   
    });

    $('.cancel_shop').click(function(){
    //console.log("nyi nyi");
    var id = this.id;

    
      $.ajax({
         url: "{{route('cancel-shop')}}",
        method: "get",
            data: {
              id:id
            },
            success: function (data) {
                setTimeout(location.reload.bind(location), 2000);
            },
            error: function (response) {
               alert("Something Wrong") // I'm always get this.
            }
        });
   
    });
</script>
@endsection