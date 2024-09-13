<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            @include('.student.module.studentSideBar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card mt-2">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped" id="studenttable">
                                        <thead>
                                            <tr>
                                                <th>Module ID</th>
                                                <th>Module Title</th>
                                                <th>Total Questions</th>
                                                <th>Score</th>
                                                <th>Max Score</th>
                                                <th>Submission Date</th>
                                                <th>Feedback</th>
                                                <th>Review</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($submissions as $submission)
                                                <tr>
                                                    <td>{{ $submission->module_id }}</td>
                                                    <td>{{ $submission->module_title }}</td>
                                                    <td>{{ $submission->module->questions->count() ?? 'N/A' }}</td>
                                                    <td>{{ $submission->score }}</td>
                                                    <td>{{ $submission->maxscore }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($submission->sub_date)->format('Y-m-d') }}</td>
                                                    <td>{{ $submission->feedback ?: 'Feedback not given' }}</td>
                                                    <td>{{ $submission->review ?: 'Review not given' }}</td>
                                                    <td>{{ $submission->status }}</td>
                                                    <td>
                                                        @if(is_null($submission->review))
                                                            <a href="{{ route('review.create', ['submission' => $submission->id]) }}" 
                                                               class="btn btn-primary">
                                                                Add Review
                                                            </a>
                                                        @else
                                                            <a href="{{ route('review.create', ['submission' => $submission->id]) }}" 
                                                               class="btn btn-primary">
                                                                Edit Review
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="text-center">No submissions found.</td>
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
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Check if there is a success message in the session
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
</x-app-layout>
