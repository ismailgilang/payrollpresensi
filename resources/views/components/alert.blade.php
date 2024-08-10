<div>
    @if (session('success'))
        <div class="alert alert-success">
            <h5 class="text-capitalize">{{ session('success') }}</h5>
        </div>
    @endif
    @if (session('fail'))
        <div class="alert alert-danger">
            <h5 class="text-capitalize">{{ session('fail') }}</h5>
        </div>
    @endif
</div>