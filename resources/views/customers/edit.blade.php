@extends('layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edition Client</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Clients</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('customers.index')}}">Liste
                                        Clients</a></li>
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
                        <!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('customers.update', ['customer' => $customer->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">Post Nom</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $customer->first_name }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $customer->last_name }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="function" class="form-label">Fonction</label>
                                        <input type="text" class="form-control" id="function" name="function" value="{{ $customer->function }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="adresse" class="form-label">Adresse</label>
                                        <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $customer->adresse }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Genre</label>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="M" @if($customer->gender === 'M') selected @endif>Homme</option>
                                            <option value="F" @if($customer->gender === 'F') selected @endif>Femme</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Categorie</label>
                                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                            <option selected disabled value="">Choisir...</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if($customer->category_id === $category->id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="avatar" class="form-label">Avatar</label>
                                        <input type="file" class="form-control" id="avatar" name="avatar">
                                        @if ($customer->avatar)
                                            <img src="{{ asset('storage/' . $customer->avatar) }}" alt="Avatar de l'utilisateur" class="img-thumbnail" width="100" height="100">
                                        @else
                                            <img src="{{ asset('userProfil.jpg') }}" alt="Avatar de l'utilisateur">
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
@endsection
