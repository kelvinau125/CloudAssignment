@extends('dashboard.parent-dashboard')

@section('student-list-content')
<main class="container w-full max-w-892px m-auto pt-6 pb-12  ">
    <span class="flex justify-center uppercase font-bold text-3xl pb-2">Contents</span>
    <div class="flex flex-wrap justify-center gap-2 gap-y-8 w-full ">
        @foreach ($results as $result)
            <div class="border-2 bored-red-500 flex flex-col justify-center items-center">
                <div class=" w-[300px]">
                    <img class="w-full h-full rounded-lg" src="http://127.0.0.1:8000/assets/images/dashboard/people.svg"
                        alt="contentImage">

                </div>
                <div class=" w-full flex  bottom-[50px] items-center p-1 pb-2">
                    <div class="flex flex-col pl-1 items-start z-10 w-52">
                        <div class="text-start  font-normal text-sm  w-210-px ">
                            <span> {{$result->title}}</span>
                        </div>
                        <div class="text-start  font-normal text-sm  w-210-px ">
                            <span> {{$result->description}}</span>
                        </div>

                        <div class="text-xs  font-bold opacity-60 text-start ">
                            <span> {{$result->created_at}}</span>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</main>
<div class="row">
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
</div>


@endsection