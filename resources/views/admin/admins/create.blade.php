@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.admins')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{route('admin.admins.index')}}">@lang('site.admins')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div>
            <div class="box-body">
                @include('partials._errors')
                <form action="{{route('admin.admins.store')}}" method="post">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="first_name">@lang('site.first_name')</label>
                        <input type="text" id="first_name" class="form-control" name="first_name" value="{{old('first_name')}}">
                    </div>

                    <div class="form-group">
                        <label for="last_name">@lang('site.last_name')</label>
                        <input type="text" id="last_name" class="form-control" name="last_name" value="{{old('last_name')}}">
                    </div>

                    <div class="form-group">
                        <label for="email">@lang('site.email')</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="password">@lang('site.password')</label>
                        <input type="password" id="password" class="form-control" name="password" ">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">@lang('site.password_confirmation')</label>
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" ">
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</button>
                    </div>
                </form>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
