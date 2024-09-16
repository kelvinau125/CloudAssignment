@extends('dashboard.admin-dashboard')

@section('admin-list-content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Content</h4>

                    <form action="{{ route('content.update', $content->id) }}" method="POST" enctype="multipart/form-data">
                        <!-- Include enctype for file upload -->
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->

                        <!-- Title Field -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title', $content->title) }}"
                                class="form-control" id="title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description">{{ old('description', $content->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content Type Field -->
                        <div class="form-group">
                            <label for="content_type">Content Type</label>
                            <select name="content_type" class="form-control" id="content_type">
                                <option value="image" {{ $content->content_type == 'image' ? 'selected' : '' }}>Image
                                </option>
                                {{-- <option value="video" {{ $content->content_type == 'video' ? 'selected' : '' }}>Video</option> --}}
                            </select>
                            @error('content_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Existing Image Preview -->
                        @if ($content->content_type == 'image' && $content->content_path)
                            <div class="form-group">
                                <label for="existing_image">Current Image</label><br>
                                {{-- <img src="{{ asset('storage/' . $content->content_path) }}" alt="{{ $content->title }}" style="width: 100px; height: auto;"> --}}
                                @if ($content->content_type === 'image' && $content->content_path)
                                    <img src="{{ $content->content_path }}" alt="{{ $content->title }}"
                                        style="width: 100px; height: auto;">
                                @else
                                    {{ $content->content_path }}
                                @endif
                            </div>
                        @endif

                        <!-- Image Upload -->
                        <div class="form-group">
                            <label for="content_image">Upload New Image (Optional)</label>
                            <input type="file" name="content_image" class="form-control" id="content_image">
                            @error('content_image')
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
