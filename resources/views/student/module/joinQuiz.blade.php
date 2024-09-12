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
                                    <form action="" method="POST">
                                        @csrf
                                        @foreach($questions as $question)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">{{ $question->question }}</h5>
                                                    <div class="row text-center">
                                                        @foreach($question->shuffledAnswers as $answer)
                                                            <div class="col-md-4">
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" name="question[{{ $question->id }}]" value="{{ $answer['id'] }}" id="answer-{{ $answer['id'] }}-{{ $question->id }}">
                                                                    <label class="form-check-label" for="answer-{{ $answer['id'] }}-{{ $question->id }}">{{ $answer['text'] }}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
</x-app-layout>
