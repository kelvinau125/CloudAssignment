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
                                <div class="flex flex-row items-center justify-between">
                                    <h4 class="card-title">Modules</h4>
                                </div>

                                <div class="list-group">
                                    @foreach($modules as $module)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-column">
                                                <h5 class="mb-1">{{ $module->title }}</h5>
                                            </div>
                                            <form action="{{ route('modules.join', $module->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">
                                                    {{ $module->hasPartialAnswers ? 'Resume' : 'Join' }}
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('message'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('message') }}',
                confirmButtonText: 'Ok'
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonText: 'Ok'
            });
        @endif
    });
</script>