@extends('layouts.backend')
@section('title')
    @if(isset($user)) User | Edit  @else User | Create  @endif
@endsection
@section('content')

    <section class="content">
        <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" accept-charset="UTF-8" id="create-edit-form" data-toggle="validator" novalidate="true">
            @csrf
            {!! (isset($user))?'<input name="_method" type="hidden" value="PUT">':'' !!}
            <div class="row">
                <div class="col-md-3 col-lg-3"></div>
                <div class="col-md-6 col-lg-6">
                    <h3 class="box-title">@if(isset($user)) Edit @else Add @endif User
                        <a href="{{ route('admin.users.index') }}" class="btn btn-info pull-right"><i class="fa fa-angle-double-up"></i> Back to List</a>
                    </h3>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @error('username') has-error @enderror">
                                        <label for="username">User Name</label>
                                        <input class="form-control" placeholder="User name" name="username" value="{{old('username')}}" v-model="user.username" type="text" id="username">

                                        @error('username')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group @error('email') has-error @enderror">
                                        <label for="email">Email<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Email" id="email" value="{{ old('email') }}" v-model="user.email" required>

                                        @error('email')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    @if(!isset($user))
                                        <div class="form-group @error('password') has-error @enderror">
                                            <label for="password">Password<span class="text-danger">*</span></label>
                                            <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>

                                            @error('password')
                                            <span class="help-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('password_confirmation') has-error @enderror">
                                            <label for="password_confirmation">Confirm Password<span class="text-danger">*</span></label>
                                            <input id="password_confirmation" type="password" placeholder="Confirm password" data-match="#password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}" required>

                                            @error('password_confirmation')
                                            <span class="help-block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    @endif
                                    <div class="form-group @error('fullName') has-error @enderror">
                                        <label for="fullName" class="with-help">Full Name<span class="text-danger">*</span></label>
                                        <input class="form-control" placeholder="Full name" name="fullName" value="{{old('fullName')}}" v-model="user.fullName" type="text" id="fullName" required>

                                        @error('fullName')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('phone') has-error @enderror">
                                        <label for="phone">Phone<span class="text-danger">*</span></label>
                                        <input class="form-control" placeholder="Phone" name="phone" value="{{old('phone')}}" v-model="user.phone" type="text" id="phone" pattern="[0-9]{11}" title="11 Digit mobile number without country code" required>

                                        @error('phone')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group @error('dept_id') has-error @enderror">
                                        <label for="dept_id">Department<span class="text-danger">*</span></label>
                                        <select class="form-control" id="dept_id" name="dept_id" v-model="user.dept_id" required>
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
                                    <div class="form-group @error('roles') has-error @enderror">
                                        <label for="roles">Role<span class="text-danger">*</span></label>
                                        <select class="form-control" id="roles" name="roles" v-model="user.roles" required>
                                            <option value="">Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role}}" {{ old('roles') == $role ? 'selected' : '' }}>{{$role}}</option>
                                            @endforeach
                                        </select>

                                        @error('roles')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group @error('status') has-error @enderror">
                                        <label for="status">Status<span class="text-danger">*</span></label>
                                        <select class="form-control" name="status" id="status" v-model="user.status" required>
                                            <option value="">Select Status</option>
                                            @foreach(['Active', 'Inactive'] as $sts)
                                                <option value="{{ $sts }}" {{ (old('status')==$sts)?'selected':''}}>{{ $sts }}</option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group @error('type') has-error @enderror">
                                        <label>Type<span class="text-danger">*</span></label>
                                        <select class="form-control" name="type" v-model="user.type" required>
                                            <option value="">Select Type</option>
                                            @foreach(['Main Admin', 'Department Admin', 'Worker'] as $typ)
                                                <option value="{{ $typ }}" {{ (old('type')==$typ)?'selected':''}}>{{ $typ }}</option>
                                            @endforeach
                                        </select>

                                        @error('type')
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
                user: {
                    username: '{{ old('username', $user->username ?? '') }}',
                    email: '{{ old('email', $user->email ?? '') }}',
                    fullName: '{{ old('fullName', $user->fullName ?? '') }}',
                    phone: '{{ old('phone', $user->phone ?? '') }}',
                    dept_id: '{{ old('dept_id', $user->dept_id ?? '') }}',
                    status: '{{ old('status', $user->status ?? '') }}',
                    type: '{{ old('type', $user->type ?? '') }}',
                    roles: '{{ old('roles', $userRole ?? '') }}',
                }
            }
        })
    </script>
@endpush
