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

                    <!-- Button to Add Quiz -->
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary w-36" id="addQuiz">Add Quiz</button>
                    </div>

                    <!-- Form for Quiz Details -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">New Quiz</h4>
                            <p class="card-description">Add new quiz</p>
                            <form id="quizForm">
                                <div class="form-group">
                                    <label for="quiz-title">Title</label>
                                    <input type="text" class="form-control" id="quiz-title" name="title" placeholder="Quiz title">
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Button to Add Questions -->
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary mt-5 w-36" id="addQuestion">Add Question</button>
                    </div>

                    <div id="questionForm">
                        <div class="card mt-2">
                            <div class="card-body">
                                <h4 class="card-title">Questions</h4>
                                <form>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="4" placeholder="Type your question here..."></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>Option 1</label>
                                            <input type="text" class="form-control" placeholder="Option 1">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Option 2</label>
                                            <input type="text" class="form-control" placeholder="Option 2">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Correct answer</label>
                                            <input type="text" class="form-control" placeholder="Correct answer">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Section for Questions -->
                    <div id="questionForm">
                        <!-- Initial Question Card (optional to prepopulate) -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let questionCount = 0; // Counter for questions

            // Add Question Button Click Handler
            document.getElementById('addQuestion').addEventListener('click', function() {
                questionCount++;

                // Create a new question div
                const newQuestionDiv = document.createElement('div');
                newQuestionDiv.className = 'card mt-4';
                newQuestionDiv.id = 'questionCard-' + questionCount;

                // Question HTML structure
                newQuestionDiv.innerHTML = `
                    <div class="card-body">
                        <input type="hidden" name="questions[` + questionCount + `][id]" value="` + questionCount + `">
                        <h4 class="card-title">Question ` + questionCount + `</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <textarea class="form-control" name="questions[` + questionCount + `][question]" rows="4" placeholder="Type your question here..."></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Option 1</label>
                                    <input type="text" class="form-control" name="questions[` + questionCount + `][option1]" placeholder="Option 1">
                                </div>
                                <div class="form-group col-4">
                                    <label>Option 2</label>
                                    <input type="text" class="form-control" name="questions[` + questionCount + `][option2]" placeholder="Option 2">
                                </div>
                                <div class="form-group col-4">
                                    <label>Correct answer</label>
                                    <input type="text" class="form-control" name="questions[` + questionCount + `][answer]" placeholder="Correct answer">
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeQuestion(` + questionCount + `)">Remove Question</button>
                        </form>
                    </div>
                `;

                // Append the new question div to the questionForm
                document.getElementById('questionForm').appendChild(newQuestionDiv);
            });

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
