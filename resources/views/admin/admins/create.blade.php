@extends('layouts.admin.app')
@section('title')
    @lang('site.add_admin')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.admins')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{route('admin.admins.index')}}">@lang('site.admins')</a></li>
                <li class="active">@lang('site.add_admin')</li>
            </ol>
        </section>
        <section class="content">

            <div class="box-header">
                <h3 class="box-title">@lang('site.add_admin')</h3>
            </div>
            <div class="box-body">
                <form action="{{route('admin.admins.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="first_name">@lang('site.first_name')</label>
                        <input type="text" id="first_name" class="form-control" name="first_name" value="{{old('first_name')}}">
                    </div>
                    @error('first_name')
                        <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                        </div>
                    @enderror

                    <div class="form-group">
                        <label for="last_name">@lang('site.last_name')</label>
                        <input type="text" id="last_name" class="form-control" name="last_name" value="{{old('last_name')}}">
                    </div>
                    @error('last_name')
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    <div class="form-group">
                        <label for="email">@lang('site.email')</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{old('email')}}">
                    </div>
                    @error('email')
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    <div class="form-group">
                        <label for="image">@lang('site.image')</label>
                        <input type="file" id="image" class="form-control image" name="image" >
                    </div>
                    @error('image')
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    <div class="form-group">
                        <img src="{{asset('uploads/admin_images/default.png')}}" style="width:100px;height:100px;border-radius:50%" class="img-thumbnail image-preview">
                    </div>

                    <div class="form-group">
                        <label for="mobile">@lang('site.mobile')</label>
                        <input type="text" id="mobile" class="form-control" name="mobile" value="{{old('mobile')}}">
                    </div>
                    @error('mobile')
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    <div class="form-group">
                        <label for="password">@lang('site.password')</label>
                        <input type="password" id="password" class="form-control" name="password" ">
                    </div>
                    @error('password')
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    <div class="form-group">
                        <label for="password_confirmation">@lang('site.password_confirmation')</label>
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" ">
                    </div>
                    @error('password_confirmation')
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror


                    <div class="form-group">
                        <label>@lang('site.permissions')</label>
                        <div class="nav-tabs-custom">

                            @php
                                $models = ['admins','categories','products','clients','orders'];
                                $maps = ['read','create', 'update', 'delete'];
                            @endphp

                            <ul class="nav nav-tabs">
                                @foreach ($models as $index=>$model)
                                    <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a></li>
                                @endforeach
                            </ul>

                            <div class="tab-content">

                                @foreach ($models as $index=>$model)

                                    <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                        @foreach ($maps as $map)
                                            <label><input type="checkbox" name="permissions[]" value="{{ $model . '-' . $map }}"> @lang('site.' . $map)</label>
                                        @endforeach

                                    </div>

                                @endforeach

                            </div><!-- end of tab content -->

                        </div><!-- end of nav tabs -->

                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>
                </form>
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
