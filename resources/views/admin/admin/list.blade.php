{{-- <!-- EXTRACT DASHBOARD -->
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
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin-adminv2/create-admin') }}" class="btn btn-primary"><i class="fa fa-dashboard"></i> New Admin-Account</a></li>
                          </ol>
                    </div>
            </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

        <!-- import responce messages -->
        @include('admin.layouts._messages')
        <!-- end responce messages -->

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Active Account List</h3>
              </div><!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tr>
                    <th>#</th>
                    <th>Store Name</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>action</th>
                  </tr>
                  <tr>
                    @foreach($getrecord as $value)
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->storename }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ ($value->status == 0) ? 'Active' : 'InActive' }}</td>
                    <td>
                        <a href="{{ url('admin-adminv2/edit-admin/'. $value->id) }}" class="btn btn-primary"> edit</a>
                        <a href="{{ url('admin-adminv2/delete-admin/'. $value->id) }}" class="btn btn-danger"> delete</a>
                    </td>
                  </tr>
                  @endforeach
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- END EXTRACT -->
@endsection
@section('script')
<script src="{{ asset('assets/dist/js/demo.js') }}" type="text/javascript"></script>
@endsection --}}

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
                    <small>Category Items AdminPanel-Version 2.1</small>
                </h1>
                </div>
                    <div class="col-sm-12" style="text-align:right;">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin-adminv2/create-admin') }}" class="btn btn-primary"><i class="fa fa-dashboard"></i> New Admin-Account</a></li>
                          </ol>
                    </div>
            </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">

        <!-- import responce messages -->
        @include('admin.layouts._messages')
        <!-- end responce messages -->

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Active Account List</h3>
              </div><!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tr>
                    <th>#</th>
                    {{-- <th>Store Name</th> --}}
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>action</th>
                  </tr>
                <thead>
                    <tbody>
                        @foreach($getrecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            {{-- <td>{{ $value->storename }}</td> --}}
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ ($value->status == 0) ? 'Active' : 'InActive' }}</td>
                            <td>
                                <a href="{{ url('admin-adminv2/edit-admin/'. $value->id) }}" class="btn btn-primary"> edit</a>
                                <a href="{{ url('admin-adminv2/delete-admin/'. $value->id) }}" onclick="return confirm('Are you sure you want to delete this Account?')" class="btn btn-danger"> delete</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <div style="padding:10px; float: right;">
                    {!! $getrecord->appends(Illuminate\Support\Facades\Request::Except('page'))->Links() !!}
                </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- END EXTRACT -->
@endsection
@section('script')
<script src="{{ url('assets/dist/js/demo.js') }}" type="text/javascript"></script>
@endsection



