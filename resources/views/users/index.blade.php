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

                                            <a href="{{route('users.create')}}" class="btn btn-success add-btn" ><i class="ri-add-line align-bottom me-1"></i> Ajouter Utilisateur</a>
                                        </div>


                                    </div>
                                    <div class="search-box ms-2">
                                        <form action="{{ route('users.search') }}" method="GET">
                                            <div class="input-group">
                                                <input  type="text" class="form-control search" name="query" placeholder="Rechercher...">
                                                <button type="submit" class="btn btn-primary">Rechercher</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                                <div  class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                        <tr>
                                            <th scope="col" style="width: 50px;">
                                                <div class="form-check">
                                                    <label for="checkAll"></label><input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                </div>
                                            </th>
                                            <th class="sort" data-sort="customer_name">Avatar</th>
                                            <th class="sort" data-sort="customer_name">Nom Complet</th>
                                            <th class="sort" data-sort="customer_phone">Téléphone</th>
                                            <th class="sort" data-sort="customer_name">Adresse</th>
                                            <th class="sort" data-sort="email">Email</th>
                                            <th class="sort" data-sort="phone">Genre</th>
                                            <th class="sort" data-sort="date">Role</th>
                                            <th class="sort" data-sort="date">Categorie</th>
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
                                            <td>
                                                <div class="avatar-group">
                                                    @if ($user->avatar)
                                                        <a href="javascript: void(0);" class="avatar-group-item" data-img="avatar-3.jpg" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Username">
                                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="" class="rounded-circle avatar-xxs">
                                                        </a>
                                                    @else
                                                        <a href="javascript: void(0);" class="avatar-group-item" data-img="userProfil.jpg" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Username">
                                                            <img src="{{ asset('userProfil.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="customer_name">{{ $user->name }}</td>
                                            <td class="customer_name">{{ $user->phone }}</td>
                                            <td class="customer_name">{{ $user->address }}</td>
                                            <td class="email">{{ $user->email }}</td>
                                            <td class="phone">{{ $user->gender === 'F' ? 'Femme' : 'Homme' }}</td>
                                            <td class="date">{{ $user->role->name }}</td>
                                            <td class="date">{{ $user->categorie->name }}</td>
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
                                            <td >
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-success edit-item-btn" >Editer</a>
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
