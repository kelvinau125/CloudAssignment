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
                                                <button type="submit" class="btn btn-primary">Join</button>
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

<!-- <script>
    $(document).ready(function() {
        $('#studenttable').DataTable({});
    });

    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Ok'
            });
        @endif
    });

    // Handle delete button clicks
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const form = event.target;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(form.action, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({})
                    }).then(response => {
                        if (response.ok) {
                            Swal.fire(
                                'Deleted!',
                                'The module has been deleted.',
                                'success'
                            ).then(() => {
                                // Reload the page or remove the row from the table
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Failed!',
                                'The module could not be deleted.',
                                'error'
                            );
                        }
                    }).catch(error => {
                        Swal.fire(
                            'Error!',
                            'An error occurred while trying to delete the module.',
                            'error'
                        );
                    });
                }
            });
        });
    });
</script> -->
