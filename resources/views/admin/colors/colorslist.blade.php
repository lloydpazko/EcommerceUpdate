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
                    <small>Product List AdminPanel-Version 2.1</small>
                </h1>
                </div>
                    <div class="col-sm-12" style="text-align:right;">
                        <ol class="breadcrumb">
                            <li><a href="{{ url('admin-adminv2/colors/create') }}" class="btn btn-primary"> <span><i class="fa fa-list-alt"></i></span>   create colors</a></li>
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
                <h3 class="box-title">Color Product List</h3>
              </div><!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Color Code</th>
                    <th>Created by.</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>action</th>
                  </tr>
                <thead>
                    <tbody>
                        @foreach($getrecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->code }}</td>
                            <td>{{ $value->created_by_name }}</td>
                            <td>{{ ($value->status == 0) ? 'Active' : 'InActive' }}</td>
                            <td>{{ date('d-m-y', strtotime($value->created_at)) }}</td>
                            <td>
                            <a href="{{ url('admin-adminv2/colors/colors-edit/' .$value->id) }}" class="btn btn-primary"> edit</a>
                            <a href="{{ url('admin-adminv2/colors/delete-brand/' .$value->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Color?')"> delete</a>
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
