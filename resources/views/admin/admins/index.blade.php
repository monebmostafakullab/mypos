@extends('layouts.admin.app')
@section('title')
    @lang('site.admins')
@endsection
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
                    <h3 class="box-title" style="margin-bottom: 10px">@lang('site.admins') <small class="label label-primary" style="font-size: 0.5em">{{$admins->total()}}</small></h3>
                    <form action="{{route('admin.admins.index')}}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->search}}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('admins-create'))
                                <a href="{{route('admin.admins.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>@lang('site.add')</a>
                                @endif
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
                                <th>@lang('site.image')</th>
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
                                    <td><img src="{{$admin->image_path}}" style="width:100px;height:100px;border-radius:50%" class="img-thumbnail"></td>
                                    <td>
                                        @if (auth()->user()->hasPermission('admins-update'))
                                        <a class="btn btn-success btn-sm" href="{{route('admin.admins.edit',$admin->id)}}"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                        <a class="btn btn-success btn-sm disabled" href="#">@lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('admins-delete'))
                                            <form action="{{route('admin.admins.destroy',$admin->id)}}" method="post" style="display: inline-block">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form>
                                        @else
                                        <button class="btn btn-danger btn-sm disabled">@lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$admins->appends(request()->query())->links()}}
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
