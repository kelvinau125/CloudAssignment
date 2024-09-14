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
                                                    <td>
                                                        <span class="feedback-text" 
                                                            data-feedback="{{ $submission->feedback ?: 'No feedback available' }}">
                                                            {{ Str::limit($submission->feedback ?: '-', 20, '...') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="review-text" 
                                                            data-review="{{ $submission->review ?: 'No review available' }}">
                                                            {{ Str::limit($submission->review ?: '-', 20, '...') }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $submission->status }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton">
                                                                @if(is_null($submission->review))
                                                                    <a class="dropdown-item" href="{{ route('review.create', ['submission' => $submission->id]) }}">Add Review</a>
                                                                @else
                                                                    <a class="dropdown-item" href="{{ route('review.create', ['submission' => $submission->id]) }}">Edit Review</a>
                                                                @endif
                                                                <a class="dropdown-item" href="{{ route('viewResult.index', ['submission' => $submission->id]) }}">View Result</a>
                                                                <!-- Add additional dropdown items here as needed -->
                                                            </div>
                                                        </div>
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

    <!-- Modal -->
    <div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contentModalLabel">Details</h5> 
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> Correct close button -->
                </div>
                <div class="modal-body" id="modalContent" style="word-wrap: break-word;">
                    <!-- Content will be inserted here dynamically -->
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" type="button" class="btn btn-secondary">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <!-- Bootstrap JavaScript and Popper.js -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> Ensure Bootstrap bundle is loaded -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener for feedback text click
            document.querySelectorAll('.feedback-text').forEach(function(feedbackElement) {
                feedbackElement.addEventListener('click', function() {
                    var feedbackContent = this.getAttribute('data-feedback');
                    document.getElementById('modalContent').innerText = feedbackContent;
                    $('#contentModal').modal('show');  // Show the modal using jQuery
                });
            });

            // Event listener for review text click
            document.querySelectorAll('.review-text').forEach(function(reviewElement) {
                reviewElement.addEventListener('click', function() {
                    var reviewContent = this.getAttribute('data-review');
                    document.getElementById('modalContent').innerText = reviewContent;
                    $('#contentModal').modal('show');  // Show the modal using jQuery
                });
            });
        });

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
