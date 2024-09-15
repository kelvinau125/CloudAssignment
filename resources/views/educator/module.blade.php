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
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card mt-2">
                            <div class="card-body">

                                <div class="flex flex-row items-center justify-between">
                                    <h4 class="card-title">Module</h4>
                                    <a class="btn btn-primary w-28 mb-3" href="{{ route('addQuestion') }}">Add</a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped" id="studenttable">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Module ID
                                                </th>
                                                <th>
                                                    Module Title
                                                </th>
                                                <th>
                                                    Total Question
                                                </th>
                                                <th>
                                                    Created By
                                                </th>
                                                <th>
                                                    Created Date
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($modules as $module)
                                                <tr>
                                                    <td class="py-1">{{ $module->id }}</td>
                                                    <td>{{ $module->title }}</td>
                                                    <td>{{ $module->questions_count }}</td>
                                                    <td>{{ $module->educator->name ?? 'N/A' }}</td>
                                                    <td>{{ $module->created_at->format('Y-m-d H:i:s') }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                ...
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton">
                                                                @if (!in_array($module->id, $disabledModuleIds))
                                                                    <a class="dropdown-item" href="{{ route('modules.edit', $module->id) }}">Edit</a>
                                                                    <form action="{{ route('module.destroy', $module->id) }}" method="POST" class="delete-form">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                                    </form>
                                                                @else
                                                                <form action="#" method="POST" class="delete-form">
                                                                    <button type="submit" class="dropdown-item" disabled>Edit</button>
                                                                </form>
                                                                    <form action="#" method="POST" class="delete-form">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="dropdown-item" disabled>Delete</button>
                                                                    </form>
                                                                @endif
                                                                <a class="dropdown-item" href="http://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(url('student/modules/' . $module->id . '/join')) }}/&size=300x300" target="_blank">Generate QR</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
</script>
