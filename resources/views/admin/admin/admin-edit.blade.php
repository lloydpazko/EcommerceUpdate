<!-- EXTRACT DASHBOARD -->
@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                <h1>
                    <small>Account Information AdminPanel-Version 2.1</small>
                </h1>
                </div>
                    <div class="col-sm-12" style="text-align:right;">
                        {{-- <ol class="breadcrumb">
                            <li><a href="{{ url('admin-adminv2/create-admin') }}" class="btn btn-primary"><i class="fa fa-dashboard"></i> New Admin-Account</a></li>
                          </ol> --}}
                    </div>
            </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-11">
                <!-- general form elements -->
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Update Admin-Account Profile</h3>
                  </div><!-- /.box-header -->
                  <!-- form start -->
                  <form action="" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">

                        {{-- <div class="form-group">
                            <label >Store Name</label>
                            <input type="text" class="form-control" value="{{ old('storename', $getRecord->storename) }}" name="storename" placeholder="Enter Your Store Name" required>
                            <div style="color:red;">{{ $errors->first('email') }}</div>
                          </div> --}}

                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{ old('name', $getRecord->name) }}" name="name" placeholder="Name" required>
                            {{-- <div style="color:red;">{{ $errors->first('email') }}</div> --}}
                          </div>
                      <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" value="{{ old('email', $getRecord->email) }}" name="email" placeholder="Enter email" required>
                        <div style="color:red;">{{ $errors->first('email') }}</div>
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" value="" name="password" placeholder="If you want to add Password or Update">
                      </div>
                      <div class="form-group">
                        <label>status</label>
                        <select class="form-control" name="status" required>
                            <option {{ ($getRecord->status == 0) ? '' : '' }}value="0">
                                active
                            </option>
                            <option {{ ($getRecord->status == 1) ? '' : '' }}value="1">
                                In-active
                            </option>
                        </select>
                      </div>
                      {{-- <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Example block-level help text here.</p>
                      </div> --}}
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div><!-- /.box -->
        </div><!-- /.row -->
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- END EXTRACT -->
@endsection
@section('script')
<script src="{{ url('assets/dist/js/demo.js') }}" type="text/javascript"></script>
@endsection
