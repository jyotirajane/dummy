@extends('layouts.master')
@section('css')
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" type="text/css" href="{{ url('/plugins/datatables/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/plugins/daterangepicker/daterangepicker.css') }}" />
<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
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
<section class="content" style="padding-left: 20px">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        <label>Order Date Range</label>
                        <div class="input-group date">
                            <input type="text" class="form-control pull-right" id="order_date">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ url('/orders/download') }}">
            @csrf
            <input type="hidden" name="start" id="start" value="">
            <input type="hidden" name="end" id="end" value="">
            <div class="form-group">
                <label>Export Data With Date Range?</label>
                <select class="form-control" name="export_with_date">
                    <option value="yes">With Date Range</option>
                    <option value="no">Without Date Range</option>
                </select>
            </div>
            <button type="Submit" class="btn btn-warning">Export Orders</button>
            </form>
        </div>
    </div>
    <br/>
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
<script src="{{ url('/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#orders').DataTable({
            "destroy":true,
            "processing": true,
            "serverSide": true,
            "ajax": "ajax/orders/json",
            "buttons": [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "columns": [
                {"data":"Building_Name"},
                {"data":"Order_Number"},
                {"data":"Order_Status"},
                {"data":"Customer_Note"},
                {"data":"First_Name_Billing"},
                {"data":"Last_Name_Billing"},
                {"data":"Company_Billing"},
            ]
        });
        $('#order_date').val('');
        $('#order_date').daterangepicker({
            opens: 'center',
            locale: {
                format: 'DD/MM/YYYY'
            },
        }, function(start, end, label) {
            $('#start').val(start.format('YYYY-MM-DD'));
            $('#end').val(end.format('YYYY-MM-DD'));
            $('#orders').DataTable({
                "destroy":true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "ajax/orders/json",
                    "data": {
                        "start_date": start.format('YYYY-MM-DD'),
                        "end_date": end.format('YYYY-MM-DD')
                    },
                },
                "buttons": [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "columns": [
                    {"data":"Building_Name"},
                    {"data":"Order_Number"},
                    {"data":"Order_Status"},
                    {"data":"Customer_Note"},
                    {"data":"First_Name_Billing"},
                    {"data":"Last_Name_Billing"},
                    {"data":"Company_Billing"},
                ]
            });
        });
    });
</script>
@endsection