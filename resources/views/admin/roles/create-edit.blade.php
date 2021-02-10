@extends('layouts.backend')
@section('title')
    @if(isset($role)) Department | Edit  @else Department | Create  @endif
@endsection
@section('content')

    <section class="content">
        <form method="POST" action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}" accept-charset="UTF-8" id="create-edit-form" data-toggle="validator" enctype="multipart/form-data" novalidate="true">
            @csrf
            {!! (isset($role))?'<input name="_method" type="hidden" value="PUT">':'' !!}
            <div class="row">
                <div class="col-md-3 col-lg-3"></div>
                <div class="col-md-6 col-lg-6">
                    <h3 class="box-title">@if(isset($role)) Edit @else Add @endif Role
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-info pull-right"><i class="fa fa-angle-double-up"></i> Back to List</a>
                    </h3>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @error('name') has-error @enderror">
                                        <label for="name" class="with-help">Name</label>
                                        <input class="form-control" placeholder="Role name" name="name" value="{{ old('name', isset($role) ? $role->name : '') }}" type="text" id="name" required>
                                        @error('name')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group @error('name') has-error @enderror">
                                        <label for="name" class="with-help">Permission</label><br>
                                        @foreach($permission as $value)
                                            @if(!isset($role))
                                                <label> <input type="checkbox" name="permission[]" value="{{ $value->id }}">{{ $value->name }}</label>
                                            @endif
                                            @if(isset($role))
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                    {{ $value->name }}</label>
                                            @endif
                                            <br/>
                                        @endforeach
                                        @error('name')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right form-footer">
                        <button class="button delete" type="reset">Clear</button>
                        <button class="button save" type="submit">@if(isset($role)) Update @else Create @endif</button>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3"></div>
            </div>
        </form>
    </section>
@endsection
