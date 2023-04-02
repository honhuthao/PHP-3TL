@extends('layout.dashboard')

@section('title', 'User')

@section('content')
    <section class="mb-4">
        {{-- add button on the right --}}

        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#addModal">
                Add
            </button>
        </div>

        <div class="card mt-3">
            <div class="card-header py-3">
                <h5 class="mb-0 text-center"><strong>User</strong></h5>

            </div>

            <div class="card-body p-0">
                <table class="table align-middle mb-0 bg-white table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr data-id="{{ $user->id }}">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button onclick="editUser({{ $user->id }})" type="button"
                                        class="btn btn-link btn-sm btn-rounded">
                                        Edit
                                    </button>
                                </td>
                                <td>
                                    {{-- hide this element --}}
                                    <span id="user-{{ $user->id }}" class="d-none">{{ $user->is_active }}</span>
                                    {{-- active or inactive user --}}
                                    @if ($user->is_active == 1)
                                        <button onclick="inactiveUser({{ $user->id }})" type="button"
                                            class="btn btn-link btn-sm btn-rounded text-success">
                                            Active
                                        </button>
                                    @else
                                        <button onclick="activeUser({{ $user->id }})" type="button"
                                            class="btn btn-link btn-sm btn-rounded text-danger">
                                            Inactive
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
@section('modal')
    <!-- Edit Modal -->
    {{-- TODO: edit still not working --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="editName" type="text" class="form-control" id="name"
                            aria-describedby="emailHelp" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input id="editEmail" type="text" class="form-control" id="email"
                            aria-describedby="emailHelp" name="email">
                    </div>
                </div>
                {{-- <div class="modal-body">
                </div> --}}
                <div class="modal-body">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Password</label>
                        <input id="editPass" type="password" class="form-control" id="password"
                            aria-describedby="emailHelp" name="password">
                    </div>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Confirm Password</label>
                        <input id="edit_password_confirmation" type="password" class="form-control"
                            aria-describedby="emailHelp" name="password_confirmation">
                    </div>
                </div>
                <div class="modal-body d-none">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Status</label>
                        <input id="editStatus" type="number" class="form-control" aria-describedby="emailHelp"
                            name="editStatus" name="is_active">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="addName" type="text" class="form-control" id="name"
                            aria-describedby="emailHelp" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input id="addEmail" type="email" class="form-control" id="email"
                            aria-describedby="emailHelp" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Password</label>
                        <input id="addPassword" type="password" class="form-control" id="password"
                            aria-describedby="emailHelp" name="password">
                    </div>
                    {{-- confirm password input --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Confirm Password</label>
                        <input id="create_password_confirmation" type="password" class="form-control"
                            aria-describedby="emailHelp" name="create_password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="create()">Create</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function editUser(id) {
            $.ajax({
                url: '/dashboard/user/' + id,
                type: 'GET',
                success: function(data) {
                    $('#editName').val(data.name);
                    $('#editEmail').val(data.email);
                    $('#editId').val(data.id);
                    $('#editStatus').val(data.is_active);
                    $('#editModal').modal('show');

                },
                error: function(error) {
                    alert(error.responseJSON.message);
                }
            });
        }

        function saveChanges() {
            $.ajax({
                url: '/dashboard/user/' + $('#editId').val(),
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#editName').val(),
                    email: $('#editEmail').val(),
                    // password: $('#editPass').val(),
                    // password_confirmation: $('#edit_password_confirmation').val(),
                    is_active: $('#editStatus').val(),
                },
                success: function(data) {
                    // update html
                    console.log(data);
                    $('tr[data-id=' + data.user.id + '] td:nth-child(2)').text(data.user.name);
                    $('tr[data-id=' + data.user.id + '] td:nth-child(3)').text(data.user.email);
                    $('#editModal').modal('hide');
                },
                error: function(error) {
                    alert(error.responseJSON.message);
                }
            });
        }

        function create() {
            $.ajax({
                url: '/dashboard/user',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#addName').val(),
                    email: $('#addEmail').val(),
                    password: $('#addPassword').val(),
                    password_confirmation: $('#create_password_confirmation').val(),
                },
                success: function(data) {
                    // add html
                    $('tbody').append(`
                        <tr data-id="${data.id}">
                            <td>${data.user.id}</td>
                            <td>${data.user.name}</td>
                            <td>${data.user.email}</td>
                            <td>
                                <button onclick="editCategory(${data.user.id})" type="button"
                                    class="btn btn-link btn-sm btn-rounded">
                                    Edit
                                </button>
                            </td>
                            <td>
                                <button onclick="inactiveUser(${data.user.id})" type="button"
                                        class="btn btn-link btn-sm btn-rounded text-success">
                                        Active
                                </button>
                            </td>
                        </tr>
                    `);
                    $('#addModal').modal('hide');
                },
                error: function(error) {
                    console.log(error);
                    alert(error.responseJSON.message);
                }
            });

        }


        function activeUser(id) {
            $.ajax({
                url: '/dashboard/user/active/' + id,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    is_active: 1,
                },
                success: function(data) {
                    // update button to inactive
                    $('tr[data-id=' + data.user.id + '] td:nth-child(5)').html(`
                        <button onclick="inactiveUser(${data.user.id})" type="button"
                                class="btn btn-link btn-sm btn-rounded text-success">
                                Active
                        </button>
                        `);
                },
                error: function(error) {
                    alert(error.responseJSON.message);
                }
            });
        }

        function inactiveUser(id) {
            $.ajax({
                url: '/dashboard/user/active/' + id,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    is_active: 0,
                },
                success: function(data) {
                    // update button to inactive
                    console.log(data);
                    $('tr[data-id=' + data.user.id + '] td:nth-child(5)').html(`
                        <button onclick="activeUser(${data.user.id})" type="button"
                            class="btn btn-link btn-sm btn-rounded text-danger">
                            Inactive
                        </button>
                    `);
                },
                error: function(error) {
                    alert(error.responseJSON.message);
                }
            });
        }
    </script>
@endsection
