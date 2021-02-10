@extends('layouts.backend')
@section('title')
    @if(isset($work)) Work | Edit  @else Work | Create  @endif
@endsection
@section('content')

    <section class="content">
        <form method="POST" action="{{ isset($work) ? route('admin.works.update', $work->id) : route('admin.works.store') }}" accept-charset="UTF-8" id="create-edit-form" data-toggle="validator" enctype="multipart/form-data" novalidate="true">
            @csrf
            {!! (isset($work))?'<input name="_method" type="hidden" value="PUT">':'' !!}
            <div class="row">
                <div class="col-md-3 col-lg-3"></div>
                <div class="col-md-6 col-lg-6">
                    <h3 class="box-title">@if(isset($work)) Edit @else Add @endif Work
                        <a href="{{ route('admin.works.index') }}" class="btn btn-info pull-right"><i class="fa fa-angle-double-up"></i> Back to List</a>
                    </h3>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @error('work_name') has-error @enderror">
                                        <label for="work_name">Work Name<span class="text-danger">*</span></label>
                                        <input class="form-control" placeholder="Work name" name="work_name" value="{{ old('work_name', isset($work) ? $work->work_name : '') }}" type="text" id="work_name" required>
                                        @error('work_name')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('dept_id') has-error @enderror">
                                        <label for="dept_id" class="with-help">Department<span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="dept_id" name="dept_id"  v-model="work.dept_id" v-select2 required>
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}" {{ old('dept_id') == $department->id ? 'selected' : '' }}>{{$department->dept_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('dept_id')
                                        <span class="help-block">
                            <strong>{{ $message }}</strong>
                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group @error('user_list') has-error @enderror">
                                        <label for="user_list" class="with-help">User<span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="user_list" name="user_list[]" v-model="work.user_list" multiple v-select2 required>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" {{old('user_list') && in_array($user->id, old('user_list')) ? 'selected' : ''}}>{{$user->fullName}}</option>
                                            @endforeach
                                        </select>
                                        @error('user_list')
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
@push('scripts')
    <script>
        new Vue({
            el: '#app',
            data: {
                isEdit: false,
                work: {
                    work_name: '{{ old('work_name', $work->work_name ?? '') }}',
                    dept_id: '{{ old('dept_id', $work->dept_id ?? '') }}',
                    user_list: {!! old('user_list') ? json_encode(old('user_list')) : $work->user_list ?? '\'\'' !!},
                }
            },
            mounted() {
                if (!this.work.user_list) {
                    this.work.user_list = [];
                }
                this.initLibs();
            },
            methods: {
                initLibs: function () {
                    setTimeout(function () {
                        $('.select2').select2({
                            width: '100%',
                            placeholder: 'Select'
                        });
                    }, 10);
                },
            }
        })
    </script>
@endpush
