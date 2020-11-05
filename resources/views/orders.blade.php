@extends('layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Orders</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="orders">
                        <thead>
                            <tr>
                                <th>Building Name</th>
                                <th>Order Number</th>
                                <th>Order Status</th>
                                <th>Order Date</th>
                                <th>Customer Note</th>
                                <th>First Name Billing</th>
                                <th>Last Name Billing</th>
                                <th>Company Billing</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ url('/plugins/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#orders').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "ajax/orders/json",
            "columns": [
                {"data":"Building_Name"},
                {"data":"Order_Number"},
                {"data":"Order_Status"},
                {"data":"Order_Date"},
                {"data":"Customer_Note"},
                {"data":"First_Name_Billing"},
                {"data":"Last_Name_Billing"},
                {"data":"Company_Billing"},
            ]
        });
    });
</script>
@endsection