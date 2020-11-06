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
                    <h1 class="m-0 text-dark">Users</h1>
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
                    <table class="table table-hover" id="users">
                        <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Actions</th>
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
        $('#users').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "ajax/users/json",
            "columns": [
                {"data":"name"},
                {"data":"email"},
                {"data":"mobile"},
                ,
            ]
        });
    });
</script>
@endsection
