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
                    <form id="quizForm" action="{{ route('addquestion.store') }}" method="POST">
                        @csrf

                        <!-- Button to Upload Module -->
                        <div class="d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-primary w-40">Upload Module</button>
                        </div>

                        <!-- Module Title -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">New Module</h4>
                                <p class="card-description">Add new module</p>
                                <div class="form-group">
                                    <label for="quiz-title">Title</label>
                                    <input type="text" class="form-control rounded-sm" id="quiz-title" name="title"
                                        placeholder="Module title" required>
                                </div>
                            </div>
                        </div>

                        <!-- Button to Add Questions -->
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-primary mt-5 w-40" id="addQuestion">Add
                                Question</button>
                        </div>

                        <!-- Section for Questions -->
                        <div id="questionForm">
                            <!-- Question Cards will be added dynamically here -->
                        </div>

                    </form> <!-- End of the form -->

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let questionCount = 1; // Counter for questions

            // Create and display the first question on page load
            function addQuestion(questionCount) {
                const newQuestionDiv = document.createElement('div');
                newQuestionDiv.className = 'card mt-4';
                newQuestionDiv.id = 'questionCard-' + questionCount;

                newQuestionDiv.innerHTML = `
            <div class="card-body">
                <input type="hidden" name="questions[` + questionCount + `][id]" value="` + questionCount + `">
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

            // Add the first question on page load
            addQuestion(questionCount);

            // Add Question Button Click Handler for adding more questions
            document.getElementById('addQuestion').addEventListener('click', function() {
                questionCount++;
                addQuestion(questionCount);
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
