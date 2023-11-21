@extends('layouts.main')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Création Arme</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Armes</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('weapons.index')}}">Liste
                                        Armes</a></li>
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
                                <form class="row g-3" method="POST" action="{{ route('weapons.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom d'arme</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type d'arme</label>
                                        <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type') }}" required>
                                        @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="serie_number" class="form-label">Numéro Série</label>
                                        <input type="text" class="form-control @error('serie_number') is-invalid @enderror" id="serie_number" name="serie_number" value="{{ old('serie_number') }}" required>
                                        @error('serie_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="acquisition_date" class="form-label js-example-basic-single">Date d'acquisition</label>
                                        <input type="date" class="form-control @error('acquisition_date') is-invalid @enderror" id="acquisition_date" name="acquisition_date" value="{{ old('acquisition_date') }}" required>
                                        @error('acquisition_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="guard_id" class="form-label">Garde</label>
                                        <input list="ice-cream-flavors" id="ice-cream-choice" name="guard_id" />
                                        <datalist id="ice-cream-flavors">
                                            @foreach($gardes as $garde)
                                                <option value="{{ $garde->id }}">{{ $garde->name }}</option>
                                            @endforeach
                                        </datalist>
                                    </div>

{{--                                    <div class="mb-3">--}}
{{--                                        <label for="guard_id" class="form-label">Garde</label>--}}
{{--                                        <input list="ice-cream-flavors" id="ice-cream-choice" name="guard_id" />--}}
{{--                                        <datalist class="form-select" id="guard_id" name="guard_id">--}}
{{--                                            <option selected disabled value="">Choisir...</option>--}}
{{--                                            @foreach($gardes as $garde)--}}
{{--                                                <option value="{{ $garde->id }}">{{ $garde->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </datalist>--}}
{{--                                    </div>--}}

                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Ajouter</button>
                                    </div>
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
