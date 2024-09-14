<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Quiz Result') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            @include('.student.module.studentSideBar')

            <div class="col-md-9">
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Quiz Result</h4>

                        @forelse($answer as $questionId => $details)
                            <div class="mb-3 p-3 border rounded shadow-sm text-center">
                                <h5 class="font-weight-bold mb-2 ">
                                    Question {{ $loop->iteration }}:<span class="ml-2">{{ $details['title'] }}</span>
                                </h5>

                                <p class="mb-1"><strong>Your Answer:</strong>
                                    <span class="{{ $details['answer'] == $details['correct_answer'] ? 'text-success font-weight-bold' : 'text-danger font-weight-bold' }}">
                                        {{ $details['answer'] }}
                                    </span>
                                </p>

                                <p class="mb-1"><strong>Correct Answer:</strong> 
                                    {{ $details['correct_answer'] }}
                                </p>

                                <span class="badge {{ $details['answer'] == $details['correct_answer'] ? 'badge-success' : 'badge-danger' }} mt-2">
                                    {{ $details['answer'] == $details['correct_answer'] ? 'Correct' : 'Incorrect' }}
                                </span>
                            </div>
                        @empty
                            <p class="text-center">No questions available.</p>
                        @endforelse

                        <div class="text-center mt-4">
                            <a href="{{ route('review.index') }}" class="btn btn-primary">Return to Module Review</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
