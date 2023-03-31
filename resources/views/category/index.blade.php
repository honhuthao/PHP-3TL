@extends('layout.dashboard')

@section('title', 'Category')

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
                <h5 class="mb-0 text-center"><strong>Category</strong></h5>

            </div>

            <div class="card-body p-0">
                <table class="table align-middle mb-0 bg-white table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr data-id="{{ $category->id }}">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <button onclick="editCategory({{ $category->id }})" type="button"
                                        class="btn btn-link btn-sm btn-rounded">
                                        Edit
                                    </button>
                                    <button onclick="deleteCategory({{ $category->id }})" type="button"
                                        class="btn btn-link btn-sm btn-rounded text-danger">
                                        Delete
                                    </button>
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
    <!-- Modal -->
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="addName" type="text" class="form-control" id="name"
                            aria-describedby="emailHelp" name="name">
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
        function editCategory(id) {
            $.ajax({
                url: '/dashboard/category/' + id,
                type: 'GET',
                success: function(data) {
                    $('#editName').val(data.name);
                    $('#editId').val(data.id);
                    $('#editModal').modal('show');
                },
                error: function(error) {
                    alert(error.responseJSON.message);
                }
            });
        }

        function saveChanges() {
            $.ajax({
                url: '/dashboard/category/' + $('#editId').val(),
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#editName').val()
                },
                success: function(data) {
                    // update html
                    $('tr[data-id=' + data.category.id + ']').find('td:nth-child(2)').text(data.category.name);
                    $('#editModal').modal('hide');
                },
                error: function(error) {
                    alert(error.responseJSON.message);
                }
            });
        }

        function deleteCategory(id) {
            //ask for confirmation
            if (!confirm('Are you sure?')) {
                return;
            }
            $.ajax({
                url: '/dashboard/category/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    //update html
                    $('tr[data-id=' + id + ']').remove();
                },
                error: function(error) {
                    alert(error.responseJSON.message);
                }
            });
        }

        function create() {
            $.ajax({
                url: '/dashboard/category',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#addName').val()
                },
                success: function(data) {
                    // add html
                    $('tbody').append(`
                        <tr data-id="${data.category.id}">
                            <td>${data.category.id}</td>
                            <td>${data.category.name}</td>
                            <td>
                                <button onclick="editCategory(${data.category.id})" type="button"
                                    class="btn btn-link btn-sm btn-rounded">
                                    Edit
                                </button>
                                <button onclick="deleteCategory(${data.category.id})" type="button"
                                    class="btn btn-link btn-sm btn-rounded text-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    `);
                    $('#addModal').modal('hide');

                },
                error: function(error) {
                    alert(error.responseJSON.message);
                }
            });

        }
    </script>
@endsection
