<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            @include('educator.educatorSideBar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="flex flex-row items-center justify-between">
                                    <h4 class="card-title">Student Progress</h4>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped" id="studenttable">
                                        <thead>
                                            <tr>
                                                <th>Submission ID</th>
                                                <th>Module Title</th>
                                                <th>Score</th>
                                                <th>Status</th>
                                                <th>Student Review</th>
                                                <th>Submission Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($submissions as $submission)
                                                <tr>
                                                    <td class="py-1">{{ $submission->id }}</td>
                                                    <td>{{ $submission->module->title ?? 'N/A' }}</td>
                                                    <td>{{ $submission->score }}/{{ $submission->maxscore }}</td>
                                                    <td>
                                                        <label class="badge badge-success">{{ $submission->status }}</label>
                                                    </td>
                                                    <td>{{ $submission->review }}</td>
                                                    <td>{{ $submission->sub_date }}</td>
                                                    <td>
                                                        <a href="{{ route('feedback.form', $submission->id) }}">
                                                            <label class="badge badge-info cursor-pointer">Feedback</label>
                                                        </a>                                                    </td>
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
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#studenttable').DataTable({});
    });
</script>
