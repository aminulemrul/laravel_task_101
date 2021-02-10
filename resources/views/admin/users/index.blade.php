@extends('layouts.backend')
@section('title')
    User
@endsection
@section('content')

    <section class="content">
        <div class="panel">
            <div class="box-header with-border">
                <h3 class="box-title">Users</h3>
                <div class="box-tools pull-right">
                    @can('user-create')
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"> Add User</a>
                    @endcan
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Full name</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Roles</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($users))
                        @foreach($users as $user)
                            <tr>
                                <td> {{ $user->username }}</strong> </td>
                                <td>{{ $user->email  }}</td>
                                <td>{{ $user->fullName  }}</td>
                                <td>{{ $user->phone  }}</td>
                                <td>{{ $user->departments->dept_name }}</td>
                                @if(auth()->user()->type == 'Main Admin')
                                    <td>
                                        <select class="form-control btn btn-primary" style="width: 85%" name="status" onchange="changeStatus({{$user->id}}, this)">
                                            @php ($status = old('status', isset($user) ? $user->status : ''))
                                            @foreach(['Active', 'Inactive'] as $sts)
                                                <option value="{{ $sts }}" {{ ($sts==$status)?'selected':''}}>{{ $sts }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                @else
                                    <td>{{ $user->status  }}</td>
                                @endif
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action<span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu">
                                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" accept-charset="UTF-8" class="data-form">
                                                @csrf
                                                <li><a href="{{ route('admin.users.assign-work-form', $user->id) }}" class="btn">Assign Work</a></li>

                                                @can('user-list')
                                                    <li><a href="{{route('admin.users.show', $user->id)}}" class="btn">Show</a></li>
                                                @endcan
                                                @can('user-edit')
                                                    <li><a href="{{route('admin.users.edit', $user->id)}}" class="btn">Edit</a></li>
                                                @endcan

                                                @method('delete')
                                                @can('user-delete')
                                                    <li><a href="javascript:void(0)" @click="destroy" class="btn">Delete</a></li>
                                                @endcan
                                            </form>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                @if($users->total())
                    <div class="row">
                        <div class="col-sm-5">
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="sortable_paginate">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div> <!-- /.box-body -->
        </div> <!-- /.box -->
    </section>
@endsection
@push('scripts')
    <script>
        new Vue({
            el: '#app',
            data: {
                id: ''
            },
            methods: {
                destroy: function () {
                    const $this = $(event.target);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            $this.closest('form').submit();
                        }
                    });
                },
            }
        })

        function changeStatus(id, ths) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                }
            });
            let data = {
                id: id,
                status: ths.value,
            };
            $.ajax({
                method: "POST",
                url: "{{ route('admin.users.status-change') }}",
                data: data,
                success: function (res) {
                    if (res.status) {
                        Swal.fire({
                            title: 'Success!',
                            text: res.message,
                            type: 'success',
                            confirmButtonText: 'Ok'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: res.message,
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            });
        }
    </script>
@endpush

