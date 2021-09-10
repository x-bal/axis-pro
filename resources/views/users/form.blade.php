<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input name="nama_lengkap" id="nama_lengkap" type="text" value="{{ $user->nama_lengkap ?? '' }}" class="form-control @error('nama_lengkap') is-invalid @enderror">
            @error('nama_lengkap')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" id="email" type="text" value="{{ $user->email ?? '' }}" class="form-control @error('email') is-invalid @enderror">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="no_telepon">Phone</label>
            <input name="no_telepon" id="no_telepon" type="text" value="{{ $user->no_telepon ?? '' }}" class="form-control @error('no_telepon') is-invalid @enderror">
            @error('no_telepon')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" id="password" type="text" value="" class="form-control @error('password') is-invalid @enderror">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="role">Role</label>
            <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required style="width: 100%; height:36px;">
                @foreach($roles as $id => $roles)
                <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                @endforeach
            </select>

            @error('role')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>