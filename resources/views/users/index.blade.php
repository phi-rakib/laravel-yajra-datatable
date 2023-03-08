@extends('layout.default')

@section('content')
    <div class="row mt-5">
        <div class="col-12 justify-content-center">
            <div class="float-right my-4">
                <a href="javascript:void(0)" class="btn btn-success" id="createNewUser">Add New User</a>
            </div>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody></tbody>
            </table>
        </div>
    </div>

    @include('users.modal')

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('users.index') }}",
                columns: [
                    {data:'id', name:'id'},
                    {data:'name', name:'name'},
                    {data:'email', name:'email'},
                    {data:'action', name:'action', orderable:false, searchable:false},
                ]
            });

            $('body').on('click', '.show-user', function() {
                var id = $(this).data('id');

                var url = '{{ route("users.show", ":id") }}';
                url = url.replace(':id', id);
                
                window.location.href = url;
            });

            $('body').on('click', '.delete-user', function() {
                var id = $(this).data('id');

                var url = '{{ route("users.delete", ":id") }}';
                url = url.replace(':id', id);

                confirm('Are you sure want to delete this user');

                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log("Error " + data);
                    }
                })
            });

            $('body').on('click', '.edit-user', function() {
                var id = $(this).data('id');

                var url = '{{ route("users.edit", ":id")}}';
                url = url.replace(':id', id);

                $.get(url, function(data) {
                    $('#modalHeading').html('Edit User');
                    $('#userModal').modal('show');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                })
            });


            $('#createNewUser').click(function() {
                $('#id').val('');
                $('#userForm').trigger('reset');
                $('#modalHeading').html('Create New User');
                $('#userModal').modal('show');
            });

            $('#saveData').click(function(e) {
                e.preventDefault();

                $(this).html('Saving...');

                var id = $('#id').val();
                var url = '{{ route("users.store") }}';
                var type = 'POST';

                if(id) {
                    url = '{{ route("users.update", ":id") }}';
                    url = url.replace(':id', id);
                    type = 'PUT';
                }

                $.ajax({
                    data: $('#userForm').serialize(),
                    url: url,
                    type: type,
                    dataType: 'json',
                    success: function(data) {
                        $('#userForm').trigger('reset');
                        $('#userModal').modal('hide');
                        $('#saveData').html('Save');
                        table.draw();
                    },
                    error: function(data) {
                        console.log(data);
                        $('#saveData').html('Save');
                    }
                })
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#userForm').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                // excluded: ':disabled', 
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'The name is required'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'The email is required'
                            }
                        }
                    }
                }
            });
        });
    </script>

    <style>
        .has-error .help-block {
            color: red;
        }
    </style>
@endsection