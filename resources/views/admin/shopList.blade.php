@extends('layout.master')
@section('css')
   
@endsection
@section('title','Shop List')

@section('contents')

<!-- Page Container START -->
<div class="page-container">
                

    <!-- Content Wrapper START -->
    <div class="main-content">
        
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div id="invoice" class="p-h-30">
                        <div class="m-t-15 lh-2">
                            <div class="inline-block">
                                <img class="img-fluid" src="{{asset('images/logo/logo-invoice.png')}}" alt="">
                                <address class="p-l-10">
                                    <span class="font-weight-semibold text-dark">Sale Person - Min Paing Soe(Department - Sale)</span><br>
                                    <span>Due Date - within 3 days</span><br>
                                    <span>FPayment term - VIA Bank Transfer</span><br>
                                    <span>Currency - MMK</span>
                                    {{-- <span>(123) 456-7890</span> --}}
                                </address>
                            </div>
                            <div class="float-right">
                                <h2>SHOP LIST</h2>
                            </div>
                        </div>
                        <div class="row m-t-20 lh-2">
                            <div class="col-sm-9">
                                <h3 class="p-l-10 m-t-10">Invoice To:</h3>
                                <address class="p-l-10 m-t-10">
                                    <span class="font-weight-semibold text-dark">{{$owner->name}}</span><br>
                                    <span>{{$owner->org_name}}</span><br>
                                    <span>{{$owner->email}}</span><br>
                                    <span>{{$owner->phone_number}}</span><br>
                                    <span>{{$owner->address}}</span>
                                </address>
                            </div>
                            <div class="col-sm-3">
                                <div class="m-t-80">
                                    <div class="text-dark text-uppercase d-inline-block">
                                        <span class="font-weight-semibold text-dark">Invoice No :</span></div>
                                    <div class="float-right">{{$invoice->id}}</div>
                                </div>
                                <div class="text-dark text-uppercase d-inline-block">
                                    <span class="font-weight-semibold text-dark">Date :</span>
                                </div>
                                <div class="float-right">{{$owner->created_at->toDateString()}}</div>
                            </div>
                        </div>
                        <div class="m-t-20">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Items</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>1</th>
                                            <td>Asus Zenfone 3 Zoom ZE553KL Dual Sim (4GB, 64GB)</td>
                                            <td>2</td>
                                            <td>$450.00</td>
                                            <td>$900.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row m-t-30 lh-1-8">
                                <div class="col-sm-12">
                                    <div class="float-right text-right">
                                        <p>Sub - Total amount: {{$owner->amount}} MMK</p>
                                        <p>Tax (5%) : {{$owner->tax}} MMK</p>
                                        <hr>
                                        <h3><span class="font-weight-semibold text-dark">Total :</span>{{$owner->total_amount}} MMK</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30 lh-2">
                                <div class="col-sm-12">
                                    <div class="border-bottom p-v-20">
                                        <p class="text-opacity" style="text-align: center"><strong>BILLING ADDRESS - 196, THIRI 8TH STREET, 2 QUARTER, HLAING TOWNSHIP, YANGON,

                                            MYANMAR</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-v-20">
                                <div class="col-sm-6">
                                    <img class="img-fluid text-opacity m-t-5" width="100" src="assets/images/logo/logo.png" alt="">
                                </div>
                                <div class="col-sm-6 text-right">
                                    <small><span class="font-weight-semibold text-dark">Phone:</span> (123) 456-7890</small>
                                    <br>
                                    <small>support@themenate.com</small>
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
    {{-- <!-- Core Vendors JS -->
    <script src="{{asset('js/vendors.min.js')}}"></script>
    <script src="{{asset('vendors/select2/select2.min.js')}}"></script> --}}
    <!-- page js -->
    <script src="{{asset('vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/pages/datatables.js')}}"></script>
    <script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>


    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

   
    <!-- Core JS -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <script>
        $('#data-table-add').DataTable();
        $('#data-table-list').DataTable();
        $('#data-table-delete').DataTable();
        $('.select2').select2();
    </script> 
@endsection