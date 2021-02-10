@extends('layouts.backend')

@section('title')
    User | Details
@endsection

@section('content')
    <section class="content">
        <div class="panel">
            <div class="panel-body">
                @if (isset($user))
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <caption><h3>User Details <a href="{{ route('admin.users.index') }}" class="btn btn-info pull-right"><i class="fa fa-angle-double-up"></i> Back </a></h3></caption>
                            <tbody>
                            <tr>
                                <th style="width:120px;">Full Name</th>
                                <th style="width:10px;">:</th>
                                <td>
                                    {{ $user->fullName ?? 'N/A'}}
                                </td>
                            </tr>
                            <tr>
                                <th style="width:120px;">User Name</th>
                                <th style="width:10px;">:</th>
                                <td>{{ $user->username ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th style="width:120px;">Email</th>
                                <th style="width:10px;">:</th>
                                <td>{{ $user->email  ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th style="width:120px;">Phone</th>
                                <th style="width:10px;">:</th>
                                <td>{{ $user->phone  ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th style="width:120px;">Department</th>
                                <th style="width:10px;">:</th>
                                <td>{{ $user->departments->dept_name  ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th style="width:120px;">Status</th>
                                <th style="width:10px;">:</th>
                                <td>{{ $user->status  ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th style="width:120px;">Type</th>
                                <th style="width:10px;">:</th>
                                <td>{{ $user->type  ?? 'N/A'}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
