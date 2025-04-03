<div class="bg-white shadow-sm vh-100 px-3 py-4 position-sticky top-0" style="width: fit-content;">
    <a href="{{route('home')}}" class="d-flex justify-content-center mb-5">
        <i class="bi bi-emoji-smile-fill text-secondary" style="font-size: 3em;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Home"></i>
    </a>
    <div id="menu" class="d-flex flex-column gap-5">
        <a href="{{ route('home') }}" class="d-flex justify-content-center">
            @if (request()->routeIs('home'))
                <i class="bi bi-house-door-fill text-dark" style="font-size: 1.5em" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Home"></i>
            @else
                <i class="bi bi-house-door text-secondary" style="font-size: 1.5em" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Home"></i>
            @endif
        </a>
    
        <a href="{{ route('create') }}" class="d-flex justify-content-center">
            @if (request()->routeIs('create'))
                <i class="bi bi-plus-square-fill text-dark" style="font-size: 1.5em" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Create"></i>
            @else
                <i class="bi bi-plus-square text-secondary" style="font-size: 1.5em" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Create"></i>
            @endif
        </a>
    </div>    
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>