@extends('dashboard.parent-dashboard')

@section('student-list-content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Quiz Results for Module</p>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Score</th>
                                        <th>Max Score</th>
                                        <th>Review</th>
                                        <th>Feedback</th>
                                        <th>Status</th>
                                        <th>Submission Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($results as $result)
                                        <tr>
                                            <td>{{ $result->studentID }}</td>
                                            <td>{{ $result->student_name }}</td>
                                            <td>{{ $result->score }}</td>
                                            <td>{{ $result->maxscore }}</td>
                                            <td>{{ $result->review }}</td>
                                            <td>{{ $result->feedback }}</td>
                                            <td>{{ $result->status }}</td>
                                            <td>{{ $result->sub_date }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No student has attempted this quiz yet.</td>
                                        </tr>
                                    @endforelse
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