<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Quiz for Module: ' . $module->title) }}
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
                                <h4 class="card-title text-center">Quiz Questions</h4>

                                @if($questions->isEmpty())
                                    <p class="text-center">No questions available for this module.</p>
                                @else
                                    <form id="quizForm" action="{{ route('quiz.save') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="module_id" value="{{ $module->id }}">
                                        <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">

                                        @foreach($questions as $question)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">{{ $question->question }}</h5>
                                                    <div class="row text-center">
                                                        @foreach($question->shuffledAnswers as $answer)
                                                            <div class="col-md-4">
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" name="question[{{ $question->id }}]" value="{{ $answer['id'] }}" id="answer-{{ $answer['id'] }}-{{ $question->id }}" {{ $answer['id'] == $question->preSelectedAnswer ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="answer-{{ $answer['id'] }}-{{ $question->id }}">{{ $answer['text'] }}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-secondary mr-3" id="cancelButton">Cancel</button>
                                            <button type="button" class="btn btn-warning" id="saveExitButton">Save and Exit</button>
                                            <button type="button" class="btn btn-primary d-none" id="submitButton">Submit</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Function to check if all questions are answered
            function updateButtonStates() {
                let allAnswered = true;

                // Check each question
                document.querySelectorAll('[name^="question["]').forEach(function (input) {
                    let questionId = input.name.match(/\d+/)[0];
                    if (!document.querySelector(`input[name="question[${questionId}]"]:checked`)) {
                        allAnswered = false;
                    }
                });

                // Show the correct button based on the answers
                document.getElementById('submitButton').classList.toggle('d-none', !allAnswered);
                document.getElementById('saveExitButton').classList.toggle('d-none', allAnswered);
            }

            // Initial check
            updateButtonStates();

            // Add event listener for changes in the form
            document.querySelectorAll('[name^="question["]').forEach(function (input) {
                input.addEventListener('change', updateButtonStates);
            });

            // SweetAlert for Cancel
            document.getElementById('cancelButton').addEventListener('click', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will leave this quiz and lose progress!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route('module.index') }}';
                    }
                });
            });

            // SweetAlert for Save and Exit / Submit
            document.getElementById('saveExitButton').addEventListener('click', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Your answers will be saved!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Save and Exit!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('quizForm').submit();
                    }
                });
            });

            // SweetAlert for Submit
            document.getElementById('submitButton').addEventListener('click', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to submit your quiz.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Submit!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('quizForm').submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
