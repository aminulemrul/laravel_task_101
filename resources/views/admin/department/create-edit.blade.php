@extends('layouts.backend')
@section('title')
    @if(isset($department)) Department | Edit  @else Department | Create  @endif
@endsection
@section('content')

    <section class="content">
        <form method="POST" action="{{ isset($department) ? route('admin.departments.update', $department->id) : route('admin.departments.store') }}" accept-charset="UTF-8" id="create-edit-form" data-toggle="validator" enctype="multipart/form-data" novalidate="true">
            @csrf
            {!! (isset($department))?'<input name="_method" type="hidden" value="PUT">':'' !!}
            <div class="row">
                <div class="col-md-3 col-lg-3"></div>
                <div class="col-md-6 col-lg-6">
                    <h3 class="box-title">@if(isset($department)) Edit @else Add @endif Department
                        <a href="{{ route('admin.departments.index') }}" class="btn btn-info pull-right"><i class="fa fa-angle-double-up"></i> Back to List</a>
                    </h3>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @error('dept_name') has-error @enderror">
                                        <label for="dept_name" class="with-help">Department Name</label>
                                        <input class="form-control" placeholder="Department name" name="dept_name" value="{{ old('dept_name', isset($department) ? $department->dept_name : '') }}" type="text" id="dept_name" required>
                                        @error('dept_name')
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
                        <button class="button save" type="submit">Save</button>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3"></div>
            </div>
        </form>
    </section>
@endsection

