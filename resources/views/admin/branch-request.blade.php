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
                    <a class="nav-link active" data-toggle="tab" href="#pending">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#cancel">Cancel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#approved">Approved</a>
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
                                <table class="table table-hover e-commerce-table horizontal-scrollable" id="data-table-pending" style="max-width: 500px">
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
                                        @foreach ($pending_shops as $pending_shop)
                                        <tr>
                                            {{-- <td>
                                                <div class="checkbox">
                                                    <input id="check-item-1" type="checkbox">
                                                    <label for="check-item-1" class="m-b-0"></label>
                                                </div>
                                            </td> --}}
                                            <td>

                                                {{$pending_shop->id}}

                                            </td>
                                            <td>

                                                {{$pending_shop->name}}

                                            </td>
                                            <td>

                                                {{$pending_shop->address}}
                                                
                                            </td>
                                            <td>
                                                @if($pending_shop->option1 == "on")
                                                    Package 1
                                                @elseif($pending_shop->option2 == "on")
                                                    Package 2
                                                @elseif($pending_shop->option3 == "on")
                                                    Package 3
                                                @else
                                                    No Package
                                                @endif
                                            </td>
                                            <td>

                                                {{-- cant delete this element --}}

                                            </td>
                                            <td>
                                                {{($pending_shop->new_device) + 3}}
                                            </td>
                                            <td>
                                                @php
                                                    $manager = App\Models\Manager::find($pending_shop->manager_id);
                                                @endphp
                                                {{$manager->name}}
                                            </td>
                                            <td>
                                                <div class="badge badge-success badge-dot m-r-10"></div>
                                                {{$pending_shop->status}}
                                            </td>
                                            <td>
                                                
                                                
                                            </td>
                                           
                                            <td class="d-flex align-items-center text-right">

                                                {{-- <button class="btn btn-icon btn-hover btn-sm btn-rounded cancel_shop" style="color: red" type="button" onclick="cancel()" id="{{$pending_shop->id}}">
                                                    <i class="anticon anticon-close"></i>
                                                   
                                                </button>
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded approve_shop" style="color: #00c9a7;" type="button" onclick="approved()" id="{{$pending_shop->id}}">
                                                    <i class="anticon anticon-check"></i>
                                                    
                                                </button> --}}


                                                <div class="dropdown dropdown-animated scale-left">
                                                    <a class="text-gray font-size-18" href="javascript:void(0);" data-toggle="dropdown" aria-expanded="true">
                                                        <i class="anticon anticon-ellipsis"></i>
                                                    </a>
                                                    
                                                    <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-152px, -68px, 0px);">
                                                        <button class="dropdown-item cancel_shop" type="button" onclick="cancel()" id="{{$pending_shop->id}}">
                                                            <i class="anticon anticon-eye"></i>
                                                            <span class="m-l-10">Cancel</span>
                                                        </button>
                                                        <button class="dropdown-item approve_shop" type="button" onclick="approved()" id="{{$pending_shop->id}}">
                                                            <i class="anticon anticon-edit"></i>
                                                            <span class="m-l-10">Approve</span>
                                                        </button>  
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                        @endforeach 
                                            
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
                                        @foreach ($cancel_shops as $cancel_shop)
                                        <tr>
                                            {{-- <td>
                                                <div class="checkbox">
                                                    <input id="check-item-1" type="checkbox">
                                                    <label for="check-item-1" class="m-b-0"></label>
                                                </div>
                                            </td> --}}
                                            <td>
                                                {{$cancel_shop->id}}
                                            </td>
                                            <td>
                                               
                                                    {{$cancel_shop->name}}
                                                    
                                            </td>
                                            <td>{{$cancel_shop->address}}</td>
                                            <td>
                                                @if($cancel_shop->option1 == "on")
                                                    Package 1
                                                @elseif($cancel_shop->option2 == "on")
                                                    Package 2
                                                @elseif($cancel_shop->option3 == "on")
                                                    Package 3
                                                @else
                                                    No Package
                                                @endif
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                {{($cancel_shop->new_device) + 3}}
                                            </td>
                                            <td>
                                                @php
                                                    $manager = App\Models\Manager::find($cancel_shop->manager_id);
                                                @endphp
                                                {{$manager->name}}
                                            </td>
                                            <td>
                                                {{$cancel_shop->status}}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="badge badge-success badge-dot m-r-10"></div>
                                                    <div></div>
                                                </div>
                                             </td>
                                            
                                            <td class="text-right">
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded cancel_shop" style="color: red" type="button" onclick="cancel()" id="{{$cancel_shop->id}}">
                                                    <i class="anticon anticon-close"></i>
                                                    {{-- <span class="m-l-10">Cancel</span> --}}
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
                                        @foreach ($approved_shops as $approved_shop)
                                        <tr>
                                            {{-- <td>
                                                <div class="checkbox">
                                                    <input id="check-item-1" type="checkbox">
                                                    <label for="check-item-1" class="m-b-0"></label>
                                                </div>
                                            </td> --}}
                                            <td>
                                                {{$approved_shop->id}}
                                            </td>
                                            <td>
                                               
                                                    {{$approved_shop->name}}
                                                    
                                            </td>
                                            <td>{{$approved_shop->address}}</td>
                                            <td>
                                                @if($approved_shop->option1 == "on")
                                                    Package 1
                                                @elseif($approved_shop->option2 == "on")
                                                    Package 2
                                                @elseif($approved_shop->option3 == "on")
                                                    Package 3
                                                @else
                                                    No Package
                                                @endif
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                {{($approved_shop->new_device) + 3}}
                                            </td>
                                            <td>
                                                @php
                                                    $manager = App\Models\Manager::find($approved_shop->manager_id);
                                                @endphp
                                                {{$manager->name}}
                                            </td>
                                            <td>
                                                {{$approved_shop->status}}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="badge badge-success badge-dot m-r-10"></div>
                                                    <div></div>
                                                </div>
                                             </td>
                                            
                                            <td class="text-right">
                                                    <div class="dropdown dropdown-animated scale-left">
                                                        <a class="text-gray font-size-18" href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="anticon anticon-ellipsis"></i>
                                                        </a>
                                                        <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-152px, -68px, 0px);">
                                                            <button class="dropdown-item" type="button">
                                                                <i class="anticon anticon-eye"></i>
                                                                <span class="m-l-10">View</span>
                                                            </button>
                                                            <button class="dropdown-item" type="button">
                                                                <i class="anticon anticon-edit"></i>
                                                                <span class="m-l-10">Edit</span>
                                                            </button>
                                                            <button class="dropdown-item" type="button">
                                                                <i class="anticon anticon-delete"></i>
                                                                <span class="m-l-10">Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>
                                        @endforeach
                                        
                                       
                                        
                                        
                                            
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