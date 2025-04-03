@if (session('success'))
<div class="alert alert-success alert-dismissible fade show position-absolute" style="top: 20px;right: 30px;z-index: 10;" role="alert">
    <strong>Success!</strong>  {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show position-absolute" style="top: 20px;right: 30px;z-index: 10;" role="alert">
    <strong>Error!</strong>  {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif