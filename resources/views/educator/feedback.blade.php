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
                <div class="container">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4 class="card-title">Module: {{ $submission->module->title }}</h4>
                            <p>Student Score: {{ $submission->score }}/{{ $submission->maxscore }}</p>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Student's Answer</th>
                                        <th>Correct Answer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                        @php
                                            $studentAnswer = collect($answers)->firstWhere('questionId', $question->id);
                                            $studentAnswerId = $studentAnswer ? $studentAnswer['answerId'] : 'N/A';
                                        @endphp
                                        <tr>
                                            <td>{{ $question->question }}</td>
                                            <td>{{ $studentAnswerId }}</td>
                                            <td>{{ $question->cors_ans }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if ($submission->feedback)
                                {{-- If feedback exists, show it initially with Edit/Delete buttons --}}
                                <div class="alert alert-info mt-3">
                                    <strong>Feedback:</strong> {{ $submission->feedback }}
                                </div>

                                {{-- Edit and Delete Buttons --}}
                                <button id="editFeedbackBtn" class="btn btn-warning mt-2">Edit Feedback</button>

                                <form action="{{ route('feedback.delete', $submission->id) }}" method="POST"
                                    class="mt-2 d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-2"
                                        onclick="return confirm('Are you sure you want to delete this feedback?');">Delete
                                        Feedback</button>
                                </form>

                                {{-- Edit Feedback Form (Initially hidden) --}}
                                <form id="editFeedbackForm" action="{{ route('feedback.update', $submission->id) }}"
                                    method="POST" class="mt-3" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="feedback">Edit Feedback</label>
                                        <textarea name="feedback" id="feedback" rows="5" class="form-control" required>{{ old('feedback', $submission->feedback) }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Update Feedback</button>
                                    <button type="button" id="cancelEditBtn"
                                        class="btn btn-secondary mt-2">Cancel</button>
                                </form>
                            @else
                                {{-- If no feedback, show the feedback submission form --}}
                                <form action="{{ route('feedback.submit', $submission->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="feedback">Feedback</label>
                                        <textarea name="feedback" id="feedback" rows="5" class="form-control" required>{{ old('feedback') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Submit Feedback</button>
                                </form>
                            @endif

                            {{-- Success message --}}
                            @if (session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle Edit Feedback Form
            document.getElementById('editFeedbackBtn').addEventListener('click', function() {
                document.getElementById('editFeedbackForm').style.display = 'block'; // Show the edit form
                this.style.display = 'none'; // Hide the edit button
            });

            // Cancel Edit Feedback
            document.getElementById('cancelEditBtn').addEventListener('click', function() {
                document.getElementById('editFeedbackForm').style.display = 'none'; // Hide the edit form
                document.getElementById('editFeedbackBtn').style.display =
                'inline-block'; // Show the edit button
            });
        });
    </script>
</x-app-layout>
