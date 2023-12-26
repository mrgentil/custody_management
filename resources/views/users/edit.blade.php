@extends('layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edition Utilisateur</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Utilisateurs</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('users.index')}}">Liste
                                        Utilisateurs</a></li>
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
                                <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom Complet</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Adresse</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Genre</label>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="M" @if($user->gender === 'M') selected @endif>Homme</option>
                                            <option value="F" @if($user->gender === 'F') selected @endif>Femme</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="role_id" class="form-label">Rôle</label>
                                        <select class="form-select" id="role_id" name="role_id">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" @if($user->role_id === $role->id) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="avatar" class="form-label">Avatar</label>
                                        <input type="file" class="form-control" id="avatar" name="avatar">
                                        @if ($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar de l'utilisateur" class="img-thumbnail" width="100" height="100">
                                        @else
                                            <img src="{{ asset('userProfil.jpg') }}" alt="Avatar de l'utilisateur">
                                        @endif
                                    </div>
                                    <!-- Champs de mot de passe -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Nouveau Mot de passe (laissez vide pour ne pas le changer)</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirmer le Mot de passe</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
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
