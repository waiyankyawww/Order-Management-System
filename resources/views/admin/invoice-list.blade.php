@extends('layout.master')
@section('css')
{{--  <link href="{{asset('vendors/select2/select2.css')}}" rel="stylesheet">  --}}
@endsection
@section('title','Invoice List')

@section('contents')
   <!-- Page Container START -->
   <div class="page-container">
                

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header no-gutters has-tab">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#list">Invoice List</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#add">Add New Admin</a>
                </li>
                <li class="nav-item">
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
                                <table class="table table-hover e-commerce-table" id="data-table-list">
                                    <thead>
                                        <tr>
                                            
                                            <th>No</th>
                                            <th>Owner Name</th>
                                            <th>Phone Number</th>
                                            <th>Organization Name</th>
                                            <th>Create Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Invoice</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                        @php
                                            $owner = \App\Models\Owner::find($invoice->owner_id);
                                        @endphp
                                        <tr>
                                            {{-- <td>
                                                <div class="checkbox">
                                                    <input id="check-item-1" type="checkbox">
                                                    <label for="check-item-1" class="m-b-0"></label>
                                                </div>
                                            </td> --}}
                                            <td>
                                                {{$invoice->id}}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    
                                                    <h6 class="m-b-0">{{optional($owner)->name}}</h6>
                                                </div>
                                            </td>
                                            <td>{{optional($owner)->phone_number}}</td>
                                            <td>{{optional($owner)->org_name}}</td>
                                            <td>
                                                @if ($owner)
                                                    {{optional($owner)->created_at->todateString()}}
                                                @else
                                                    -
                                                @endif
                                                
                                            </td>
                                            <td>
                                                {{optional($invoice)->amount}}
                                            </td>
                                           
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="badge badge-success badge-dot m-r-10"></div>
                                                    <div>{{optional($owner)->status}}</div>
                                                </div>
                                             </td>
                                             <td>
                                             <a href='{{url("admin/invoice/$invoice->id")}}' target="_blank">Invoice</a>
                                             </td>
                                            <td class="text-right">
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                                    <i class="anticon anticon-edit"></i>
                                                </button>
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                                    <i class="anticon anticon-stop"></i>
                                                </button>
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded delete_owner" data-toggle="modal" data-target="#exampleModal" id="">
                                                    <i class="anticon anticon-delete"></i>
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
                
                
            </div>
        </div>            
    </div>

<!-- Modal -->


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

<!-- Page Container END -->
@endsection
@section('scripts')
<!-- Core Vendors JS -->
<script src="{{asset('js/vendors.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.min.js')}}"></script>
<!-- page js -->
<script src="{{asset('vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/pages/datatables.js')}}"></script>

<!-- Core JS -->
<script src="{{asset('js/app.min.js')}}"></script>
<script>
    $('#data-table-list').DataTable();
</script>
@endsection