<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" id="name" type="text" value="{{ $permission->name ?? '' }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>