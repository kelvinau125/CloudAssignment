@extends('dashboard.parent-dashboard')

@section('student-list-content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">View Student Result</p>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Module ID</th>
                                        <th>Student ID</th>
                                        <th>Score</th>
                                        <th>Max Score</th>
                                        <th>Submission Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results as $result)
                                        <tr>
                                            <td>{{ $result->moduleID }}</td>
                                            <td> {{$result->studentID}}</td>
                                            <td>{{ $result->score }}</td>
                                            <td>{{ $result->maxscore }}</td>
                                            <td>{{ $result->sub_date }}</td>
                                            <td>{{ $result->status }}</td>
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