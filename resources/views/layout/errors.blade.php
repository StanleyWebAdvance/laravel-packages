@if ($errors->any())
    <div class="form-group">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-bordered">
        <span class="text-semibold">
                {{ $error }}
    </span>
            </div>
        @endforeach
    </div>
@endif