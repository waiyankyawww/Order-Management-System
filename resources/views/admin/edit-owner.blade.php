@extends('layout.master')
@section('css')
<link href="{{asset('vendors/select2/select2.css')}}" rel="stylesheet">
@endsection
@section('title','Owner')

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
            <h4>Edit Owner</h4>
            
        </div>
        <div class="container-fluid">
            <form method="POST" action="{{route('Owner-update')}}" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') --}}
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Owner Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Admin Name" name="name" required value="{{$owner->name}}">
                        <input type="hidden" name="id" value="{{ $owner->id }}"> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number" required value="{{$owner->phone_number}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-1">
                        <label for="nrc_no">No</label>
                        <div class="m-b-15">
                            <select class="select2" name="nrc_no" id="nrc_no" required>
                                @for ($i = 1; $i <= 14; $i++)
                                @if ($owner->nrc_no == $i)
                                    <option value="{{$i}}" selected>{{$i}} /</option>
                                @else 
                                    <option value="{{$i}}">{{$i}} /</option>    
                                @endif
                                 
                                @endfor
                            </select>
                        </div>    
                    </div>
                    <div class="form-group col-md-1">
                        <label for="nrc_location">Location</label>
                        <div class="m-b-15">
                            <select class="select2" name="nrc_location" id="nrc_location" required>
                                @foreach ($nrc_numbers as $nrc_number)
                                    @if ($owner->nrc_location == $nrc_number->prefix_en)
                                        <option value="{{$nrc_number->prefix_en}}" selected>{{$nrc_number->prefix_en}}</option>
                                    @else 
                                        <option value="{{$nrc_number->prefix_en}}">{{$nrc_number->prefix_en}}</option>
                                    @endif
                                @endforeach
                                <option value=""></option>
                            </select>
                        </div>    
                    </div>
                    <div class="form-group col-md-1">
                        @php
                            $nrc_types = ['N','E','P','A','F','TH','G'];
                        @endphp
                        <label for="inputState">Type</label>
                        <select id="inputState" class="form-control" name="nrc_type" required>   
                            @foreach ($nrc_types as $nrc_type)
                                @if ($nrc_type == $owner->nrc_type)
                                    <option value="({{$nrc_type}})" selected>({{$nrc_type}})</option>
                                @else
                                    <option value="({{$nrc_type}})">({{$nrc_type}})</option>
                                @endif
                             @endforeach
                        </select>>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nrc_number">Number</label>
                        <input type="number" class="form-control" id="nrc_number" placeholder="NRC Number" name="nrc_number" required value="{{$owner->nrc_number}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required value="{{$owner->email}}">
                    </div>
                </div>
                {{-- <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required>
                    </div>
                </div> --}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Apartment, studio, or floor" name="address" required value="{{$owner->address}}">
                    </div>
                    <div class="col-md-3">
                        <label for="city">City</label>
                        <div class="m-b-15">
                            <select class="select2" name="city" id="city" required>
                                <option value="AP">Apples</option>
                                <option value="NL">Nails</option>
                                <option value="BN">Bananas</option>
                                <option value="HL">Helicopters</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="state">State</label>
                        <div class="m-b-15">
                            <select class="select2" name="state" id="state" required>
                                <option value="AP">Apples</option>
                                <option value="NL">Nails</option>
                                <option value="BN">Bananas</option>
                                <option value="HL">Helicopters</option>
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
                        <input type="text" class="form-control" id="org_name" placeholder="Organization Name" name="org_name" value="{{$owner->org_name}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="industry">Industry</label>
                        <select id="industry" class="form-control" name="industry">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="main_address">Main Address</label>
                        <input type="text" class="form-control" id="main_address" placeholder="Apartment, studio, or floor" name="main_address" value="{{ $owner->main_address }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        {{-- <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="logo">
                            <label class="custom-file-label" for="customFile">Logo Upload</label>
                        </div> --}}
                        <strong>Image:</strong>
                        <input type="file" name="logo" class="form-control" placeholder="image" id="logo">
                        <img src="/public/profiles/owners/{{ $owner->logo }}" width="300px">
                    </div>
                   
                </div>
                <button class="btn btn-primary" type="submit">
                    Update
                </button>
                <button class="btn btn-danger btn-tone m-r-5" type="reset">Clear</button>
            </div>
            <!-- Button trigger modal -->

        </form>
        </div>            
    </div>

<!-- Modal -->

    <!-- Content Wrapper END -->

    <!-- Footer START -->
    <footer class="footer">
        <div class="footer-content">
            <p class="m-b-0">Copyright © 2021 Xsphere. All rights reserved.</p>
            <span>
                <a href="" class="text-gray m-r-15">Term &amp; Conditions</a>
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
<script src="{{asset('vendors/select2/select2.min.js')}}"></script> --}}
<!-- page js -->
<script src="{{asset('vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/pages/datatables.js')}}"></script> --}}

<!-- Core JS -->
<script src="{{asset('js/app.min.js')}}"></script>
<script>
    $('#data-table-add').DataTable();
    $('#data-table-list').DataTable();
    $('#data-table-delete').DataTable();
    $('.select2').select2();
</script>

@endsection