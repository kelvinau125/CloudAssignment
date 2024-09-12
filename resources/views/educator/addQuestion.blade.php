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

                    <!-- Form for Module and Questions -->
                    <form id="quizForm" 
                          action="{{ isset($module) ? route('modules.update', $module->id) : route('addquestion.store') }}" 
                          method="POST">
                        @csrf
                        @if (isset($module))
                            @method('PUT')
                        @endif

                        <!-- Button to Upload Module -->
                        <div class="d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-primary w-40">
                                {{ isset($module) ? 'Update Module' : 'Upload Module' }}
                            </button>
                        </div>

                        <!-- Module Title -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ isset($module) ? 'Edit Module' : 'New Module' }}</h4>
                                <p class="card-description">{{ isset($module) ? 'Edit existing module' : 'Add new module' }}</p>
                                <div class="form-group">
                                    <label for="quiz-title">Title</label>
                                    <input type="text" class="form-control rounded-sm" id="quiz-title" name="title"
                                        placeholder="Module title" 
                                        value="{{ isset($module) ? $module->title : old('title') }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Button to Add Questions -->
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-primary mt-5 w-40" id="addQuestion">Add Question</button>
                        </div>

                        <!-- Section for Questions -->
                        <div id="questionForm">
                            <!-- If editing, populate existing questions -->
                            @if (isset($module) && $module->questions)
                                @foreach ($module->questions as $index => $question)
                                    <div class="card mt-4" id="questionCard-{{ $index + 1 }}">
                                        <div class="card-body">
                                            <h4 class="card-title">Question {{ $index + 1 }}</h4>
                                            <div class="form-group">
                                                <textarea class="form-control" name="questions[{{ $index + 1 }}][question]" rows="4" required>{{ $question->question }}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label>Option 1</label>
                                                    <input type="text" class="form-control" name="questions[{{ $index + 1 }}][option1]" value="{{ $question->ans1 }}" required>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label>Option 2</label>
                                                    <input type="text" class="form-control" name="questions[{{ $index + 1 }}][option2]" value="{{ $question->ans2 }}" required>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label>Correct answer</label>
                                                    <input type="text" class="form-control" name="questions[{{ $index + 1 }}][answer]" value="{{ $question->cors_ans }}" required>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="removeQuestion({{ $index + 1 }})">Remove Question</button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Create and display the first question for new module -->
                                <div class="card mt-4" id="questionCard-1">
                                    <div class="card-body">
                                        <h4 class="card-title">Question 1</h4>
                                        <div class="form-group">
                                            <textarea class="form-control" name="questions[1][question]" rows="4" placeholder="Type your question here..." required></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label>Option 1</label>
                                                <input type="text" class="form-control" name="questions[1][option1]" placeholder="Option 1" required>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Option 2</label>
                                                <input type="text" class="form-control" name="questions[1][option2]" placeholder="Option 2" required>
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Correct answer</label>
                                                <input type="text" class="form-control" name="questions[1][answer]" placeholder="Correct answer" required>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeQuestion(1)">Remove Question</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form> <!-- End of the form -->

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let questionCount = {{ isset($module) ? $module->questions->count() : 1 }};

            // Add Question Button Click Handler for adding more questions
            document.getElementById('addQuestion').addEventListener('click', function() {
                questionCount++;
                addQuestion(questionCount);
            });

            // Function to dynamically add a new question
            function addQuestion(questionCount) {
                const newQuestionDiv = document.createElement('div');
                newQuestionDiv.className = 'card mt-4';
                newQuestionDiv.id = 'questionCard-' + questionCount;

                newQuestionDiv.innerHTML = `
                    <div class="card-body">
                        <h4 class="card-title">Question ` + questionCount + `</h4>
                        <div class="form-group">
                            <textarea class="form-control" name="questions[` + questionCount + `][question]" rows="4" placeholder="Type your question here..." required></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Option 1</label>
                                <input type="text" class="form-control" name="questions[` + questionCount + `][option1]" placeholder="Option 1" required>
                            </div>
                            <div class="form-group col-4">
                                <label>Option 2</label>
                                <input type="text" class="form-control" name="questions[` + questionCount + `][option2]" placeholder="Option 2" required>
                            </div>
                            <div class="form-group col-4">
                                <label>Correct answer</label>
                                <input type="text" class="form-control" name="questions[` + questionCount + `][answer]" placeholder="Correct answer" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeQuestion(` + questionCount + `)">Remove Question</button>
                    </div>
                `;
                document.getElementById('questionForm').appendChild(newQuestionDiv);
            }

            // Function to remove a question
            window.removeQuestion = function(id) {
                const questionDiv = document.getElementById('questionCard-' + id);
                if (questionDiv) {
                    questionDiv.remove();
                }
            }
        });
    </script>
</x-app-layout>
