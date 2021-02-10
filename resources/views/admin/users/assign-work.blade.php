@extends('layouts.backend')
@section('title')
    Assign | Work
@endsection
@section('content')
    <section class="content">
        <form method="POST" action="{{ route('admin.users.assign-work') }}" accept-charset="UTF-8" id="create-edit-form" data-toggle="validator" novalidate="true">
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <div class="row">
                <div class="col-md-3 col-lg-3"></div>
                <div class="col-md-6 col-lg-6">
                    <h3 class="box-title">Assign Work
                        <a href="{{ route('admin.users.index') }}" class="btn btn-info pull-right"><i class="fa fa-angle-double-up"></i> Back to List</a>
                    </h3>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @error('work_list') has-error @enderror">
                                        <label for="work_list" class="with-help">Work</label>
                                        <select class="form-control select2" id="work_list" name="work_list[]" v-model="work.work_list" multiple v-select2 required>
                                            @foreach($works as $work)
                                                <option value="{{$work->id}}" {{old('work_list') && in_array($work->id, old('work_list')) ? 'selected' : ''}}>{{$work->work_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('worker_id')
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
                    work_list: {!! old('work_list') ? json_encode(old('work_list')) : $work->work_list ?? '\'\'' !!},
                }
            },
            mounted() {
                if (!this.work.work_list) {
                    this.work.work_list = [];
                }
                this.initLibs();
            },
            methods: {
                initLibs: function () {
                    setTimeout(function () {
                        $('.select2').select2({
                            width: '100%',
                            placeholder: 'Select',
                            tags: true
                        });
                    }, 10);
                },
            }
        })
    </script>
@endpush
