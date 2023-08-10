@extends('layout.master')
@section('css')
<link href="{{asset('vendors/select2/select2.css')}}" rel="stylesheet">
@endsection
@section('title',' My Profile')
@section('contents')
    <!-- Page Container START -->
    <div class="page-container">


        <!-- Content Wrapper START -->
        <div class="main-content">
            <div class="page-header no-gutters has-tab">
                <h2 class="font-weight-normal">Profile Setting</h2>
                {{-- <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-account">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-network">Network</a>
                    </li>
                </ul> --}}
            </div>
            <div class="container">
                <div class="tab-content m-t-15">
                    <div class="tab-pane fade show active" id="tab-account" >
                        <div class="card">
                            <div class="alert alert-success alert-dismissible fade show" style="display: none;" id="showSuccess">
                                <strong>Success!</strong> You already changed new password.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="avatar avatar-image  m-h-10 m-r-15" style="height: 90px; width: 90px;">
                                        <img src="{{ asset('profiles/admins/'.Auth::user()->logo) }}" alt="">
                                    </div>
                                    <div class="m-l-20 m-r-20">
                                        <h5 class="m-b-5 font-size-18">{{ Auth::user()->name }}</h5>
                                        <p class="opacity-07 font-size-13 m-b-0">
                                            Recommended Dimensions: <br>
                                            120x120 Max fil size: 5MB
                                        </p>
                                    </div>
                                    <div>
                                        <button  class="mx-2 mt-0 btn btn-tone btn-primary" onclick="change()"  id="photo-Status">Change Profile</button>
                                        <form action="{{route('uploadPhoto')}}" method="post" enctype="multipart/form-data" id="photo-Form" style="display: none">
                                            {{-- <button class="btn btn-tone btn-primary">Upload</button> --}}
                                            {{-- <label for="logo"></label>
                                            <button type="button" name="logo" id="logoUpload" class="btn btn-primary">Upload</button>
                                            <input type="file" name="logo" id="logo" style="display: none;"> --}}
                                            <input id="logo-file" type="file"  name="logo" onchange="loadFile(event)" />
                                            <img id="output" class=" cursor-pointer" onclick="changePhoto()" onmouseover="this.style.cursor ='pointer' " />
                                            <button type="submit" class="mx-2 mt-0 btn btn-tone btn-primary ">Upload</button>
                                        </form>
                                    </div>
                                </div>
                                <hr class="m-v-25">

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="oldPassword">Old Password:</label>
                                        <input type="password" class="form-control" id="oldPassword" placeholder="Old Password" name="oldPassword">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="newPassword">New Password:</label>
                                        <input type="password" class="form-control" id="newPassword" placeholder="New Password" name="newPassword">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="confirmPassword">Confirm Password:</label>
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" name="confirmPassword">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary m-t-30" type="button" id="changePassword">Change</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic Information</h4>
                            </div>
                            <div class="card-body">

                                <form method="POST" action="{{route('updateProfile')}}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-semibold" for="userName">User Name:</label>
                                            <input name="name" type="text" class="form-control" id="userName" placeholder="User Name" value="{{optional($owner)->name}}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-semibold" for="email">Email:</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="email" value="{{optional($owner)->email}}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-1">
                                            <label for="nrc_no">No</label>
                                            <div class="m-b-15">
                                                <select class="select2" name="nrc_no" id="nrc_no" required>
                                                    @for ($i = 1; $i <= 14; $i++)
                                                    @if (optional($owner)->nrc_no == $i)
                                                        <option value="{{$i}}" selected>{{$i}} /</option>
                                                    @else
                                                        <option value="{{$i}}">{{$i}} /</option>
                                                    @endif

                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="nrc_location">Location</label>
                                            <div class="m-b-15">
                                                <select class="select2" name="nrc_location" id="nrc_location" required>
                                                    @foreach ($nrc_numbers as $nrc_number)
                                                    @if ($nrc_number->prefix_en == optional($owner)->nrc_location)
                                                        <option value="{{$nrc_number->prefix_en}}" selected>{{$nrc_number->prefix_en}}</option>
                                                    @else
                                                        <option value="{{$nrc_number->prefix_en}}">{{$nrc_number->prefix_en}}</option>
                                                    @endif
                                                    @endforeach
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
                                                    @if ($nrc_type == optional($owner)->nrc_type)
                                                        <option value="({{$nrc_type}})" selected>({{$nrc_type}})</option>
                                                    @else
                                                        <option value="({{$nrc_type}})">({{$nrc_type}})</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="nrc_number">Number</label>
                                            <input type="number" class="form-control" id="nrc_number" placeholder="NRC Number" name="nrc_number" required value="{{optional($owner)->nrc_number}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-semibold" for="phoneNumber">Phone Number:</label>
                                            <input type="number" name="phone_number" class="form-control" id="phoneNumber" placeholder="Phone Number" value="{{optional($owner)->phone_number}}">
                                        </div>
                                    </div>
                                    <hr class="m-v-25">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="font-weight-semibold" for="fullAddress">Address:</label>
                                            <input type="text"  name="address" class="form-control" id="address" value="{{ optional($owner)->address }}">
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
                                    <hr class="m-v-25">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="org_name">Organization Name</label>
                                            <input type="text" class="form-control" id="org_name" placeholder="Organization Name" name="org_name" value="{{ optional($owner)->org_name }}">
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
                                            <input type="text" class="form-control" id="main_address" placeholder="Apartment, studio, or floor" name="main_address" value="{{ optional($owner)->main_address }}">
                                        </div>

                                    </div>

                                    <button class="btn btn-primary formSubmit" type="submit" onclick="formSubmit()">
                                        Confirm
                                    </button>
                                </form>

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
                <p class="m-b-0">Copyright © 2021 Xsphere. All rights reserved.</p>
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
{{-- <script src="{{asset('js/vendors.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.min.js')}}"></script> --}}
<!-- page js -->
<script src="{{asset('vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/pages/datatables.js')}}"></script> --}}

<!-- Core JS -->
<script src="{{asset('js/app.min.js')}}"></script>

<script>
    var output = document.getElementById('output');
    var loadFile = function(event) {
      var reader = new FileReader();
      reader.onload = function(){
        document.getElementById('logo-file').setAttribute("style","display:none")
        output.src = reader.result;
        output.setAttribute("style", "width:100px; height:100px");
      };
      reader.readAsDataURL(event.target.files[0]);
    };
    var change = function(){
        document.getElementById('photo-Status').setAttribute("style","display:none")
        document.getElementById('photo-Form').setAttribute("style","display:block")
    }
    var changePhoto =function(){
        document.getElementById('logo-file').click()
    }
</script>

<script> //form js
    $('#data-table-add').DataTable();
    $('#data-table-list').DataTable();
    $('#data-table-delete').DataTable();
    $('.select2').select2();
</script>

<script>
    $('#logoUpload').click(function(){

        $('#logo').trigger('click');
    });
</script>

    <script>
        $('#changePassword').click(function(){
            password = $("input[name=newPassword]").val();
            password_confirm = $("input[name=confirmPassword]").val();
            password_old = $("input[name=oldPassword]").val();
            //console.log(password);
            if(password === password_confirm){
                $.ajax({
                    url: "{{route('updatePassword')}}",
                    method: 'post',
                    data: {
                        password:password,password_old:password_old
                    },
                    success: function (data) {
                        //console.log(data);
                        // window.location.reload();
                        $('#showSuccess').css('display','block');
                    },
                    error: function (response) {
                        alert("Old Password Wrong");
                    }
                })
            }
            else{
                alert("Password and Confirm Password don't match");
            }

        })
    </script>

@endsection

