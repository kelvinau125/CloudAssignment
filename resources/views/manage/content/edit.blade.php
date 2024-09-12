@extends('dashboard.admin-dashboard')

@section('admin-list-content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Content</h4>

                    <form action="{{ route('content.update', $content->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title', $content->title) }}" class="form-control" id="title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description">{{ old('description', $content->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content_type">Content Type</label>
                            <select name="content_type" class="form-control" id="content_type">
                                <option value="image" {{ $content->content_type == 'image' ? 'selected' : '' }}>Image</option>
                                <option value="video" {{ $content->content_type == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                            @error('content_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content_path">Content Path</label>
                            <input type="text" name="content_path" value="{{ old('content_path', $content->content_path) }}" class="form-control" id="content_path">
                            @error('content_path')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Content</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
