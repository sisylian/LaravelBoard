@if (session('alert-success'))
    <div class="alert alert-success mt-3">
        {{ session('alert-success') }}
    </div>
@elseif (session('alert-danger'))
    <div class="alert alert-danger mt-3">
        {{ session('alert-danger') }}
    </div>
@endif