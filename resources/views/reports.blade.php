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
                    <h1 class="m-0 text-dark">Reports</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="content" style="padding-left: 150px">
    <div class="row"><a class="btn btn-warning" href="{{ url('/reports/summary_download') }}">Export Order Summary</a></div><br />
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="reports">
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
@endsection
@section('scripts')
<script src="{{ url('/plugins/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('#reports').DataTable( {
            "processing": true,
            "serverSide": true,
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

</script>
@endsection