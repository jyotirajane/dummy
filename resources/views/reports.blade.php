@extends('layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="{{ url('/plugins/daterangepicker/daterangepicker.js') }}"></script>

@endsection
@section('content')
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Reports</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
<section class="content" >
     @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
        @endif
    <div class="row">
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-body" >
                    <div class="form-group">
                        <label>Report Date Range</label>
                        <div class="input-group date">
                            <input type="text" class="form-control pull-right" id="report_date">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- <div class="col-md-4">
            <form method="POST" action="{{ url('/reports') }}">
            @csrf
            <input type="hidden" name="start" id="start" value="" required>
            <input type="hidden" name="end" id="end" value="" required>
            <div class="form-group">
                <label>Export Data With Date Range?</label>
                <select class="form-control" name="export_with_date">
                    <option value="yes">With Date Range</option>
                    <option value="no">Without Date Range</option>
                </select>
            </div>
            <button type="Reset" class="btn btn-warning">Reset</button>
            <button type="Submit" class="btn btn-warning">Submit</button>
            </form>
        </div> -->
        <div class="col-md-4">
            <form method="POST" action="{{ url('/reports/summary_download') }}">
            @csrf
            <input type="hidden" name="report_start_date" id="report_start_date" value="" required>
            <input type="hidden" name="report_end_date" id="report_end_date" value="" required>
            <!-- <a class="btn btn-warning" href="{{ url('/reports/summary_download') }}">Export Order Summary</a> -->
            <button type="Submit" class="btn btn-warning">Export Summary</button>
        </form>
        </div>
    </div>
    <br/>
    
    <div class="row" id="resultDiv" style="display:none">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="reports" >
                        <thead>
                            <tr>
                                <th>Building Name</th>
                                <th>Order Count</th>
                                <th>Action</th>
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
</div>
@endsection
@section('scripts')
<script src="{{ url('/plugins/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('#reports').DataTable( {
            "processing": true,
            "serverSide": true,
            "pageLength": 50,
            "ajax": "ajax/reports/json",
            "buttons": [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "columns": [
                {"data":"Building_Name"},
                {"data":"no_of_orders"},
                {"data": "action", "orderable": false, "searchable": false},
            ]
        });
    });

    $('#report_date').val('');
        $('#report_date').daterangepicker({
            opens: 'center',
            locale: {
                format: 'DD/MM/YYYY'
            },
        }, function(start, end, label) {
            $('#resultDiv').show();
            // $('#start').val(start.format('YYYY-MM-DD'));
            // $('#end').val(end.format('YYYY-MM-DD'));
            $('#report_start_date').val(start.format('YYYY-MM-DD'));
            $('#report_end_date').val(end.format('YYYY-MM-DD'));
            $('#reports').DataTable({
                "destroy":true,
                "pageLength": 50,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "ajax/reports/json",
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
                    {"data":"no_of_orders"},
                    {"data": "action", "orderable": false, "searchable": false},
                ]
            });
        });

</script>
@endsection