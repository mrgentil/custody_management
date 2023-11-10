<div>
    <form wire:submit.prevent="store">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nom Complet</label>
            <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Téléphone</label>
            <input type="text" wire:model="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required>
            @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" wire:model="address" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>
            @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="inputGroupPrepend2" required>
            </div>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">Rôles</label>
            <select class="form-select @error('role_id') is-invalid @enderror" wire:model="role_id" id="role_id" name="role_id" required>
                <option selected disabled value="">Choisir...</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
            <select class="form-select @error('category_id') is-invalid @enderror" wire:model="category_id" id="category_id" name="category_id" required>
                <option selected disabled value="">Choisir...</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Genre</label>
            <select class="form-select @error('gender') is-invalid @enderror" wire:model="gender" id="gender" name="gender" required>
                <option selected disabled value="">Choisir...</option>
                <option value="M" {{ old('gender') === 'M' ? 'selected' : '' }}>Homme</option>
                <option value="F" {{ old('gender') === 'F' ? 'selected' : '' }}>Femme</option>
            </select>
            @error('gender')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" wire:model="avatar" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" value="{{ old('avatar') }}" aria-describedby="inputGroupPrepend2" required>
            @error('avatar')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" wire:model="password" class="form-control" id="password" name="password" required>
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmez le mot de passe</label>
            <input type="password" wire:model="password_confirmation" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button class="btn btn-primary" type="submit">Ajouter</button>
    </form>

</div>
