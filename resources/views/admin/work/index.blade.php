@extends('layouts.backend')
@section('title')
    Work
@endsection
@section('content')

    <section class="content">
        <div class="panel">
            <div class="box-header with-border">
                <h3 class="box-title">Work</h3>
                <div class="box-tools pull-right">
                    @can('work-create')
                        <a href="{{ route('admin.works.create') }}" class="btn btn-primary"> Add Work</a>
                    @endcan
                </div>
            </div> <!-- /.box-header -->
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Work Name</th>
                        <th>Department Name</th>
                        @if(auth()->user()->type == 'Main Admin' || auth()->user()->type == 'Department Admin')
                        <th>Worker Name</th>
                        @endif
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($works))
                        @foreach($works as $work)
                            <tr>
                                <td> {{ $work->work_name }} </td>
                                <td> {{ $work->department->dept_name }} </td>
                                @if(auth()->user()->type == 'Main Admin' || auth()->user()->type == 'Department Admin')
                                <td> @foreach($work->users as $worker)<label class="badge badge-success">{{ $worker->fullName }}</label> @endforeach </td>
                                @endif
                                <td>
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu">
                                            <form method="POST" action="{{ route('admin.works.destroy', $work->id) }}" accept-charset="UTF-8" class="data-form">
                                                @csrf
                                            @can('work-edit')
                                            <li><a href="{{route('admin.works.edit', $work->id) }}" class="btn">Edit</a></li>
                                            @endcan

                                                @method('delete')
                                                @can('work-delete')
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
                @if($works->total())
                    <div class="row">
                        <div class="col-sm-5">
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="sortable_paginate">
                                {{ $works->appends(Request::except('page'))->links() }}
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

