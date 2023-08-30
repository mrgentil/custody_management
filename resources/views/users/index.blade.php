@extends('layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Utilisateurs</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Liste</a></li>
                                <li class="breadcrumb-item active">Utilisateurs</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Ajout, Modification & Suspension</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button>
                                            <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <label>
                                                    <input type="text" class="form-control search" placeholder="Search...">
                                                </label>
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                        <tr>
                                            <th scope="col" style="width: 50px;">
                                                <div class="form-check">
                                                    <label for="checkAll"></label><input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                </div>
                                            </th>
                                            <th class="sort" data-sort="customer_name">Nom</th>
                                            <th class="sort" data-sort="email">Email</th>
                                            <th class="sort" data-sort="phone">Genre</th>
                                            <th class="sort" data-sort="date">Role</th>
                                            <th class="sort" data-sort="status">Etat</th>
                                            <th class="sort" data-sort="action">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @foreach($users as $user)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                </div>
                                            </th>
                                            <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                            <td class="customer_name">{{ $user->name }}</td>
                                            <td class="email">{{ $user->email }}</td>
                                            <td class="phone">{{ $user->gender === 'F' ? 'Femme' : 'Homme' }}</td>
                                            <td class="date">{{ $user->role->name }}</td>
{{--                                            <td class="status"><span class="badge bg-success-subtle text-success text-uppercase">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>--}}
{{--                                            --}}
{{--                                            </td>--}}
                                            <td class="status">
                                                @if ($user->is_active == 1)
                                                    <span class="badge bg-success-subtle text-success text-uppercase">Actif</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger text-uppercase">Inactif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Editer</button>
                                                    </div>
                                                    <div class="remove">
                                                        <form action="{{ route('users.suspend', ['user' => $user->id]) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            @if ($user->is_active)
                                                                <button class="btn btn-sm btn-danger" type="submit">Suspendre</button>
                                                            @endif
                                                        </form>
                                                    </div>
                                                    <div class="remove">
                                                        <form action="{{ route('users.activate', ['user' => $user->id]) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            @if (!$user->is_active)
                                                                <button class="btn btn-sm btn-success" type="submit">Activer</button>
                                                            @endif
                                                        </form>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        {{ $users->links('pagination.bootstrap') }}
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
@endsection
