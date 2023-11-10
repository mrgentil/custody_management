@extends('layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edition Garde</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Gardes</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('users.index')}}">Liste
                                        Gardiens</a></li>
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
                                <form action="{{ route('guards.update', ['guard' => $guard->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $guard->name }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Post Nom</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ $guard->last_name }}" required>
                                        @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">Prénom</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ $guard->first_name }}" required>
                                        @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="function" class="form-label">Fonction</label>
                                        <input type="text" class="form-control @error('function') is-invalid @enderror" id="function" name="function" value="{{ $guard->function }}" required>
                                        @error('function')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="degree" class="form-label">Grade</label>
                                        <input type="text" class="form-control @error('degree') is-invalid @enderror" id="degree" name="degree" value="{{ $guard->degree }}" required>
                                        @error('degree')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="service" class="form-label">Service</label>
                                        <input type="text" class="form-control @error('service') is-invalid @enderror" id="service" name="service" value="{{ $guard->service }}" required>
                                        @error('service')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="unite" class="form-label">Unité</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('unite') is-invalid @enderror" id="unite" name="unite" value="{{ $guard->unite }}" aria-describedby="inputGroupPrepend2" required>
                                        </div>
                                        @error('unite')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="birth_date" class="form-label">Date de naissance</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ $guard->birth_date }}" aria-describedby="inputGroupPrepend2" required>
                                        </div>
                                        @error('birth_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="adresse" class="form-label">Adresse</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{ $guard->adresse }}" aria-describedby="inputGroupPrepend2" required>
                                        </div>
                                        @error('adresse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Téléphone</label>
                                        <div class="input-group">
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $guard->phone }}" aria-describedby="inputGroupPrepend2" required>
                                        </div>
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="hire_date" class="form-label">Date d'embauche </label>
                                        <div class="input-group">
                                            <input type="date" class="form-control @error('hire_date') is-invalid @enderror" id="hire_date" name="hire_date" value="{{ $guard->hire_date }}" aria-describedby="inputGroupPrepend2" required>
                                        </div>
                                        @error('hire_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="avatar" class="form-label">Avatar</label>
                                        <input type="file" class="form-control" id="avatar" name="avatar">
                                        @if ($guard->avatar)
                                            <img src="{{ asset('storage/' . $guard->avatar) }}" alt="Avatar de l'utilisateur" class="img-thumbnail" width="100" height="100">
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
