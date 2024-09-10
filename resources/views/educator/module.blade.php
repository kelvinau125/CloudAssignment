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
                                <a class="btn btn-primary float-right" href="{{ route('addQuestion') }}">Add</a>
                                <h4 class="card-title">Quizs</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="studenttable">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Quiz ID
                                                </th>
                                                <th>
                                                    Quiz Title
                                                </th>
                                                <th>
                                                    Total Question
                                                </th>
                                                <th>
                                                    Created By
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td class="py-1">
                                                    1
                                                </td>
                                                <td>
                                                    QUESTION NAME
                                                </td>
                                                <td>
                                                    2
                                                </td>
                                                <td>
                                                    USERNAME
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <!-- Triple-dot icon -->
                                                            ...
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <!-- Edit option -->
                                                            <a class="dropdown-item"
                                                                href="edit_question.php?id=">Edit</a>
                                                            <!-- Delete option -->
                                                            <a class="dropdown-item delete" data-arg= "">Delete</a>
                                                            <a class="dropdown-item" href="">Generate
                                                                QR</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
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
