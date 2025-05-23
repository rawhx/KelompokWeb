@if (session('success'))
<div id="success-alert" class="alert alert-success alert-dismissible fade show position-absolute" style="z-index:5;top: 20px;right: 30px;" role="alert">
    <strong>Success!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div id="error-alert" class="alert alert-danger alert-dismissible fade show position-absolute" style="z-index:5;top: 20px;right: 30px;" role="alert">
    <strong>Error!</strong> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<script>
    setTimeout(() => {
        const success = document.getElementById('success-alert');
        const error = document.getElementById('error-alert');

        if (success) {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(success);
            bsAlert.close();
        }

        if (error) {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(error);
            bsAlert.close();
        }
    }, 5000);
</script>
