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
                            <h4 class="card-title mb-0">Ajout, Modification & SUpression</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>

                                            <a href="{{route('weapons.create')}}" class="btn btn-success add-btn" ><i class="ri-add-line align-bottom me-1"></i> Ajouter Arme</a>
                                        </div>
                                    </div>
                                    <div class="search-box ms-2">
                                        <form action="{{ route('weapons.search') }}" method="GET">
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
                                            <th class="sort" data-sort="customer_name">Nom</th>
                                            <th class="sort" data-sort="email">Type</th>
                                            <th class="sort" data-sort="phone">Numéro Série</th>
                                            <th class="sort" data-sort="phone">Date d'acquisition</th>
                                            <th class="sort" data-sort="phone">Etat</th>
                                            <th class="sort" data-sort="phone">Nom du garde possednt arme</th>
                                            <th class="sort" data-sort="action">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @foreach($armes as $arme)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                <td class="customer_name">{{ $arme->name }}</td>
                                                <td class="email">{{ $arme->type }}</td>
                                                <td class="phone">{{ $arme->serie_number }}</td>
                                                <td class="phone">{{ $arme->acquisition_date }}</td>
                                                <td class="phone">
                                                    @if($arme->guard_id)
                                                        En possession
                                                    @else
                                                        Non possession
                                                    @endif
                                                </td>

                                                <td class="customer_name">{{ optional($arme->garde)->name }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <a href="{{ route('weapons.edit', ['weapon' => $arme->id]) }}" class="btn btn-sm btn-success edit-item-btn">Editer</a>
                                                        </div>
                                                        @if($arme->guard_id)
                                                            <form action="{{ route('weapons.disarm', ['weapon' => $arme->id]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-sm btn-danger">Désarmer</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('weapons.arm', ['weapon' => $arme->id]) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-sm btn-primary">Armer</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        {{ $armes->links('pagination.bootstrap') }}
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
