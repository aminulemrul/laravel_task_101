@extends('layouts.backend')
@section('title')
    Role
@endsection
@section('content')

    <section class="content">
        <div class="panel">
            <div class="box-header with-border">
                <h3 class="box-title">Role</h3>
                <div class="box-tools pull-right">
                    @can('role-create')
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"> Add Role</a>
                    @endcan
                </div>
            </div> <!-- /.box-header -->
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($roles))
                        @foreach($roles as $role)
                            <tr>
                                <td> {{ $role->name }}</strong> </td>
                                <td>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu">
                                            <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}" accept-charset="UTF-8" class="data-form">
                                                @csrf
                                                @can('role-show')
                                                    <li><a href="{{ route('admin.roles.show', $role->id) }}" class="btn">Show</a></li>
                                                @endcan
                                                @can('role-edit')
                                                    <li><a href="{{ route('admin.roles.edit', $role->id) }}" class="btn">Edit</a></li>
                                                @endcan

                                                @method('delete')
                                                @can('role-delete')
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
                @if($roles->total())
                    <div class="row">
                        <div class="col-sm-5">
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="sortable_paginate">
                                {{ $roles->links() }}
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
    </script>
@endpush

