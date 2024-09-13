@extends('dashboard.parent-dashboard')

@section('student-list-content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Modules List</p>

                <!-- Search form -->
                <!-- <form method="GET" action="{{ route('student.list') }}">
                    <div class="input-group mb-3 border-2 border-red-500">
                        <input type="text" name="search" class="form-control" placeholder="Search users..."
                            value="{{ request()->input('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form> -->

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Educator ID</th>
                                        <!-- <th>Create At</th>
                                        <th>Updated At</th> -->
                                        <th>Action</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    @foreach ($modules as $module)
                                        <tr>
                                            <td>{{ $module->id }}</td>
                                            <td>{{ $module->title }}</td>
                                            <td>{{ $module->educatorID }}</td>
                                            <!-- <td>{{ $module->created_at }}</td>
                                            <td>{{ $module->updated_at }}</td> -->
                                            <td>
                                                <a href="{{ route('studentResult.list', $module->id) }}"
                                                    class="btn btn-sm btn-primary">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection