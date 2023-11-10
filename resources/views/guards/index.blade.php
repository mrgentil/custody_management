@extends('layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Gardes</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Liste</a></li>
                                <li class="breadcrumb-item active">Gardes</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

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

                                            <a href="{{route('guards.create')}}" class="btn btn-success add-btn" ><i class="ri-add-line align-bottom me-1"></i> Ajouter Garde</a>
                                        </div>
                                    </div>
                                    <div class="search-box ms-2">
                                        <form action="{{ route('guard.search') }}" method="GET">
                                            <div class="input-group">
                                                <input  type="text" class="form-control search" name="query" placeholder="Rechercher...">
                                                <button type="submit" class="btn btn-primary">Rechercher</button>
                                            </div>
                                        </form>
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
                                            <th class="sort" data-sort="customer_name">Avatar</th>
                                            <th class="sort" data-sort="customer_name">Ajouté par</th>
                                            <th class="sort" data-sort="customer_name">Nom</th>
                                            <th class="sort" data-sort="email">PostNom</th>
                                            <th class="sort" data-sort="phone">Prénom</th>
                                            <th class="sort" data-sort="phone">Fonction</th>
                                            <th class="sort" data-sort="phone">Grade</th>
                                            <th class="sort" data-sort="phone">Service</th>
                                            <th class="sort" data-sort="phone">Unité</th>
                                            <th class="sort" data-sort="phone">Date de naissance</th>
                                            <th class="sort" data-sort="phone">Adresse</th>
                                            <th class="sort" data-sort="phone">Téléphone</th>
                                            <th class="sort" data-sort="phone">Date d'embauche</th>
                                            <th class="sort" data-sort="date">Role</th>
                                            <th class="sort" data-sort="action">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @foreach($guards as $garde)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                <td>
                                                    <div class="avatar-group">
                                                        @if ($garde->avatar)
                                                            <a href="javascript: void(0);" class="avatar-group-item" data-img="avatar-3.jpg" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Username">
                                                                <img src="{{ asset('storage/' . $garde->avatar) }}" alt="" class="rounded-circle avatar-xxs">
                                                            </a>
                                                        @else
                                                            <a href="javascript: void(0);" class="avatar-group-item" data-img="userProfil.jpg" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Username">
                                                                <img src="{{ asset('userProfil.jpg') }}" alt="" class="rounded-circle avatar-xxs">
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="customer_name">{{ optional($garde->user)->name }}</td>
                                                <td class="customer_name">{{ $garde->name }}</td>
                                                <td class="email">{{ $garde->last_name }}</td>
                                                <td class="phone">{{ $garde->first_name }}</td>
                                                <td class="phone">{{ $garde->function }}</td>
                                                <td class="phone">{{ $garde->degree }}</td>
                                                <td class="phone">{{ $garde->service }}</td>
                                                <td class="phone">{{ $garde->unite }}</td>
                                                <td class="phone">{{ $garde->birth_date }}</td>
                                                <td class="phone">{{ $garde->adresse }}</td>
                                                <td class="phone">{{ $garde->phone }}</td>
                                                <td class="phone">{{ $garde->hire_date }}</td>
                                                <td class="date">{{ $garde->role->name }}</td>
                                                <td >
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <a href="{{ route('guards.edit', ['guard' => $garde->id]) }}" class="btn btn-sm btn-success edit-item-btn" >Editer</a>
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
                                        {{ $guards->links('pagination.bootstrap') }}
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
