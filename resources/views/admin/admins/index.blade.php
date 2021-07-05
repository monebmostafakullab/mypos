@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.admins')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.admins')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.admins')</h3>
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>@lang('site.search')</button>
                                <a href="{{route('admin.admins.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    @if($admins->count() > 0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>@lang('site.first_name')</th>
                                <th>@lang('site.last_name')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.control')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $index => $admin)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$admin->first_name}}</td>
                                    <td>{{$admin->last_name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{route('admin.admins.edit',$admin->id)}}">@lang('site.edit')</a>
                                        <form action="{{route('admin.admins.destroy',$admin->id)}}" method="post" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">@lang('site.delete')</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h2>@lang('site.no_data_found')</h2>
                    @endif
                </div>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
@push('scripts')

    <script>

    </script>
