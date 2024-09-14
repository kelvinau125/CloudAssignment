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

                                <div class="card mt-4" id="questionCard-1">
                                    <div class="card-body">
                                        <h4 class="card-title">Module Review</h4>
                                        @if(!is_null($submission->review) && $submission->review !== '')
                                            <!-- Display existing review -->
                                            <div class="form-group">
                                                <textarea class="form-control" rows="4" readonly>{{ $submission->review }}</textarea>
                                            </div>
                                            <p class="text-success mt-2">Review already provided. You can edit it below.</p>
                                        @endif
                                        <!-- Form to add or update review -->
                                        <form action="{{ route('review.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="submission_id" value="{{ $submission->id }}">
                                            <div class="form-group">
                                                <textarea class="form-control" name="review" rows="4" placeholder="Give your review here" required>{{ $submission->review ?? '' }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-primary">{{ !is_null($submission->review) ? 'Update Review' : 'Add Review' }}</button>
                                            
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
