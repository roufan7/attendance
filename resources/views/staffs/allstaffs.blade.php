@extends('layouts.master')

@section('title')
    All Staffs
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">All Staffs</span>
                    <div class="card-toolbar">
                        <button class="btn btn-primary" data-bs-target="#addstaff" data-bs-toggle="modal">Add Staff</button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="users" class="table table-striped border rounded gy-5 gs-7">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 px-7">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffs as $staff)
                                <tr>
                                    <td>{{ $staff->name }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href={{ route('deleteStaff', $staff->id) }} class="btn btn-icon btn-danger"><i
                                                    class="las la-trash fs-2 me-2"></i>
                                            </a>
                                            <button class="btn btn-icon btn-primary"
                                                data-bs-target="#editstaff{{ $staff->id }}" data-bs-toggle="modal"><i
                                                    class="las la-edit fs-2 me-2"></i> </button>
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
    <div class="modal fade" tabindex="-1" id="addstaff">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Staff</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{ route('addStaff') }}" method="POST" enctype="multipart/form-data" id="myForm">
                    @csrf
                    <div class="modal-body ">
                        <div class='form-group row mb-4 align-middle'>
                            <label class=" col-lg-3 required form-label">Staff Name</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-solid" placeholder="Staff Name"
                                    name='name' required />
                            </div>
                        </div>
                        <div class='form-group row mb-4'>
                            <label class=" col-lg-3 required form-label">Email</label>
                            <div class="col-lg-9">
                                <input type="email" class="form-control form-control-solid"
                                    placeholder="staff@example.com" name="email" required />
                            </div>
                        </div>



                        <div class='form-group row mb-4'>
                            <label class=" col-lg-3 required form-label">Password</label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control form-control-solid" minlength='8'
                                    placeholder="Password" name='password' required />


                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($staffs as $staff)
        <div class="modal fade" tabindex="-1" id="editstaff{{ $staff->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Staff</h5>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>
                    <form action="{{ route('editStaff') }}" method="POST" enctype="multipart/form-data" id="myForm">
                        @csrf
                        <div class="modal-body ">
                            <input type="hidden" value="{{ $staff->id }}" name="id">
                            <div class='form-group row mb-4 align-middle'>
                                <label class=" col-lg-3 required form-label">Staff Name</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control form-control-solid"
                                        value="{{ $staff->name }}" placeholder="Staff Name" name='name' required />
                                </div>
                            </div>
                            <div class='form-group row mb-4'>
                                <label class=" col-lg-3 required form-label">Email</label>
                                <div class="col-lg-9">
                                    <input type="email" class="form-control form-control-solid"
                                        placeholder="staff@example.com" name="email" value="{{ $staff->email }}"
                                        required />
                                </div>
                            </div>



                            <div class='form-group row mb-4'>
                                <label class=" col-lg-3 required form-label">Password</label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control form-control-solid" minlength='8'
                                        placeholder="Password" name='password' />


                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        $(document).ready(function() {
            var datatable = $('#users').DataTable({
                processing: true,
                serverSide: false,
                stateSave: true,
                responsive: true,
                // select: true,
                filter: true,
                dom: "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start search 'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +
                    "<'table-responsive'tr>" +
                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
                order: [
                    [0, "desc"]
                ],

            });
            var search = document.querySelector('.search');
            html = search.innerHTML
            search.innerHTML = '<span class="fw-3 px-2">Show</span>' + html +
                '<span class="fw-3 px-2">Entries</span>'
        });
    </script>
@endsection
