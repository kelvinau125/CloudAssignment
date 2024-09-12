@extends('dashboard.admin-dashboard')

@section('admin-list-content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Content</h4>

                    <form action="{{ route('content.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content_type">Content Type</label>
                            <select name="content_type" class="form-control" id="content_type">
                                <option value="image" {{ old('content_type') == 'image' ? 'selected' : '' }}>Image</option>
                                <option value="video" {{ old('content_type') == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                            @error('content_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content_path">Content Path (Optional)</label>
                            <input type="text" name="content_path" value="{{ old('content_path') }}" class="form-control" id="content_path">
                            @error('content_path')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Content</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
