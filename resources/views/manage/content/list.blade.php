@extends('dashboard.admin-dashboard')

@section('admin-list-content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Content List</p>

                    <!-- Search form -->
                    <form method="GET" action="{{ route('content.list') }}">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Search content..." value="{{ request()->input('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>

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
                                            <th>Actions</th> <!-- Add Actions column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contents as $content)
                                            <tr>
                                                <td>{{ $content->id }}</td>
                                                <td>{{ $content->title }}</td>
                                                <td>{{ Str::limit($content->description, 50) }}</td>
                                                <td>{{ $content->content_type }}</td>
                                                <td>{{ $content->content_path }}</td>
                                                <td>
                                                    <!-- Edit button -->
                                                    <a href="{{ route('content.edit', $content->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                                    <!-- Delete button (form with method DELETE) -->
                                                    <form action="{{ route('content.delete', $content->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this content?');">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination links -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="ml-3">
                                        {{ $contents->appends(['search' => request()->input('search')])->links() }} <!-- Keep the search query in pagination -->
                                    </div>
                                </div>

                                <!-- Create New Content Button under the table -->
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('content.create') }}" class="btn btn-primary">Create New Content</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
