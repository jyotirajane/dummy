@extends('layouts.master')
@section('content')
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Orders Upload</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Input File</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <!-- <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="orders" name="orders">
                        </div> -->
                        <div class="form-group" style="width: 50%">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="orders" name="orders">
                            <label class="custom-file-label" for="orders">Choose file</label>
                          </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</div>
@endsection