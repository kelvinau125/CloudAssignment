@extends('dashboard.parent-dashboard')

@section('student-list-content')
<main class="container w-full max-w-892px m-auto pt-6 pb-12">
    <span class="flex justify-center uppercase font-bold text-3xl pb-2">Contents</span>
    <div class="flex flex-wrap justify-center gap-2 w-full">
        @foreach ($results as $result)
        <div class="card border-2 border-gray-200 rounded-lg overflow-hidden shadow-sm transition duration-300 hover:shadow-lg hover:scale-105" style="width: 300px;">
            <img class="w-full h-48 object-cover" src="{{ $result->content_path }}" alt="contentImage">
            <div class="p-4">
                <span class="text-xs font-bold text-red-600 uppercase">Photos</span>
                <div class="text-lg font-bold mt-2">
                    <span>{{ $result->title }}</span>
                </div>
                <div class="text-sm text-gray-600 mt-1">
                    <span>{{ $result->description }}</span>
                </div>
                <div class="text-xs text-gray-400 mt-2">
                    <span>{{ $result->created_at }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</main>

<!-- <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Content ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Content Type</th>
                                        <th>Path</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results as $result)
                                        <tr>
                                            <td>{{ $result->id }}</td>
                                            <td> {{$result->title}}</td>
                                            <td>{{ $result->description }}</td>
                                            <td>{{ $result->content_type}}</td>
                                            <td>{{ $result->content_path }}</td>
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
</div> -->


@endsection