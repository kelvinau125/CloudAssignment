@extends('dashboard.parent-dashboard')

@section('student-list-content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Overall Reporting</p>
                <p class="card-title">Total Submissions: {{$totalSubmissions}}</p>
                <p class="card-title">Average Score per Module</p>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Module ID</th>
                                        <th>Average Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($averageScoresPerModule as $moduleID => $averageScore)
                                        <tr>
                                            <td>{{ $moduleID }}</td>
                                            <td>{{ number_format($averageScore, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <p class="card-title">Completion Rate per Module</p>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Module ID</th>
                                        <th>Completion Rate (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($completionRatePerModule as $moduleID => $completionRate)
                                        <tr>
                                            <td>{{ $moduleID }}</td>
                                            <td>{{ number_format($completionRate, 2) }}%</td>
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