@extends('dashboard.admin-dashboard')

@section('admin-list-content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Content List</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="display expandable-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Content Type</th>
                                            <th>Content Path</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contents as $content)
                                            <tr>
                                                <td>{{ $content->id }}</td>
                                                <td>{{ $content->title }}</td>
                                                <td>{{ Str::limit($content->description, 50) }}</td> <!-- Truncated description -->
                                                <td>{{ $content->content_type }}</td>
                                                <td>{{ $content->content_path }}</td>
                                                <td>{{ $content->created_at }}</td>
                                                <td>{{ $content->updated_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination links -->
                                <div class="d-flex justify-content-end"> <!-- Changed to justify-content-end for right alignment -->
                                    {{ $contents->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
