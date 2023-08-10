@extends('layout.master')
@section('css')
<link href="{{asset('vendors/select2/select2.css')}}" rel="stylesheet">
@endsection
@section('title','Profile')

@section('contents')

<!-- Page Container START -->
<div class="page-container">
                
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="header-title">Profile</h1>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <div class="d-md-flex align-items-center">
                                <div class="text-center text-sm-left ">
                                    <div class="avatar avatar-image" style="width: 150px; height:150px">
                                        <img src="{{ asset('profiles/owners/'.$owner->logo) }}" alt="me" style="object-fit: cover;">
                                    </div>
                                </div>
                                <div class="text-center text-sm-left m-v-15 p-l-30">
                                    <h2 class="m-b-5">{{ $owner->name }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="{{url("owners/$owner->id/edit")}}">
                                <button class="btn btn-default btn-lg btn-success">
                                    Edit
                                </button>
                            </a>
                            <button class="btn btn-default btn-lg btn-danger delete_admin" data-toggle="modal" data-target="#exampleModal" id="{{$owner->id}}">
                                Delete
                            </button>


                        </div> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Details</h5>
                            
                            <div class="row">
                                <div class="col">
                                    <ul class="list-unstyled m-t-10">
                                        <li class="row">
                                            <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                                <span>Email: </span> 
                                            </p>
                                            <p class="col font-weight-semibold"> {{ $owner->email }}</p>
                                        </li>
                                        <li class="row">
                                            <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                                <span>Phone: </span> 
                                            </p>
                                            <p class="col font-weight-semibold"> {{ $owner->phone_number }}</p>
                                        </li>
                                        <li class="row">
                                            <p class="col-sm-4 col-5 font-weight-semibold text-dark m-b-5">
                                                <i class="m-r-10 text-primary anticon anticon-idcard"></i>
                                                <span>NRC: </span> 
                                            </p>
                                            <p class="col font-weight-semibold">{{ $owner->nrc_no }} / {{ $owner->nrc_type }} / {{ $owner->nrc_number }}</p>
                                        </li>
                                        <li class="row">
                                            <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                <i class="m-r-10 text-primary anticon anticon-environment"></i>
                                                <span>Address: </span> 
                                            </p>
                                            <p class="col font-weight-semibold"> {{ $owner->address }}</p>
                                            <li class="row">
                                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                    <i class="m-r-10 text-primary anticon anticon-environment"></i>
                                                    <span>City: </span> 
                                                </p>
                                                <p class="col font-weight-semibold"> {{ $owner->city }}</p>
                                                <li class="row">
                                                    <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                        <i class="m-r-10 text-primary anticon anticon-environment"></i>
                                                        <span>State: </span> 
                                                    </p>
                                                    <p class="col font-weight-semibold"> {{ $owner->state }}</p>
                                                    <li class="row">
                                                        <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                            <i class="m-r-10 text-primary anticon anticon-global"></i>
                                                            <span>Organization: </span> 
                                                        </p>
                                                        <p class="col font-weight-semibold"> {{ $owner->org_name }}</p>
                                                        <li class="row">
                                                            <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                                <i class="m-r-10 text-primary anticon anticon-reconciliation"></i></i>
                                                                <span>Industry: </span> 
                                                            </p>
                                                            <p class="col font-weight-semibold"> {{ $owner->industry }}</p>
                                                            <li class="row">
                                                                <p class="col-sm-4 col-4 font-weight-semibold text-dark m-b-5">
                                                                    <i class="m-r-10 text-primary anticon anticon-home"></i>
                                                                    <span>Main Address: </span> 
                                                                </p>
                                                                <p class="col font-weight-semibold"> {{ $owner->main_address }}</p>
                                                            </li>
                                                        </li>
                                                    </li>
                                                </li>
                                            </li>
                                        </li>
                                    </ul>
                                    
                                </div>
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
                Are you sure to delete this owner?
                <input type="text" name="delete_id" id="delete_id">
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

<!-- Core JS -->
<script src="{{asset('js/app.min.js')}}"></script>

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
        var token = $("meta[name='csrf-token']").attr("content");
        $("#exampleModal").modal('hide');
        
            $.ajax({
                url: "{{url('/owners')}}/"+id,
                type: "DELETE",
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function (data) {
                    $('#hidearea_'+id).remove();
                    window.location.replace("/owners");
                },
                error: function (response) {
                    alert("Something Wrong") // I'm always get this.
                }
            });
    
    });
    
</script>

@endsection