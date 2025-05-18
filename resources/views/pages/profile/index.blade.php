<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <style>
        .tab-button.active {
            font-weight: bold;
            color: #000;
        }
    </style>
    
    <body>
        @include('components.notif')
        <section class="d-flex">
            @include('components.sidebar')
            <div class="vw-100">
                <div class="shadow-sm pb-3 px-3 position-sticky bg-white top-0" style="padding-top: 2.3em">
                    <div class="px-3 d-flex justify-content-end gap-3">
                        <a href="{{route('profil')}}" class="bg-info position-relative overflow-hidden" style="border-radius: 50%; width: 50px; height: 50px; aspect-ratio: 1/1;">
                            <img src="{{ auth()->user()->foto_profil ? asset('storage/profile_pictures/' . auth()->user()->foto_profil) : 'https://via.placeholder.com/150' }}" class="w-100 h-100 position-absolute top-0 start-0" 
                            style="object-fit: cover; object-position: center;" 
                            alt="profil">
                        </a>
                    </div>
                </div>
        
                <div class="pb-3 pt-4 px-5 d-flex gap-5 align-items-start">
                    <div class="d-flex gap-3 align-items-center position-sticky" style="top: 8em;">
                        <div class="bg-info position-relative overflow-hidden" style="border-radius: 50%; width: 8em; height: 8em; aspect-ratio: 1/1;">
                            <img src="{{ auth()->user()->foto_profil ? asset('storage/profile_pictures/' . auth()->user()->foto_profil) : 'https://via.placeholder.com/150' }}" class="w-100 h-100 position-absolute top-0 start-0" 
                            style="object-fit: cover; object-position: center;" 
                            alt="profil">
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <h1 class="m-0 fw-bold text-capitalize">{{auth()->user()->username}} </h1>
                            <p class="m-0">{{auth()->user()->email}}</p>
                        </div>
                        <a href="{{route('editProfil')}}" class="text-dark">
                            <i class="bi bi-pencil-square fs-2"></i>
                        </a>
                    </div>
                    <div class="w-100">
                        <div class="d-flex justify-content-center align-items-center gap-5 mb-4">
                            <p class="fs-5 tab-button active" data-target="gambar" style="cursor: pointer;">Gambar</p>
                            <p class="fs-5 tab-button" data-target="saved" style="cursor: pointer;">Simpan</p>
                            <p class="fs-5 tab-button" data-target="liked" style="cursor: pointer;">Disukai</p>
                        </div>                        
                        
                        <div id="gambar" class="tab-section">
                            <div class="row g-3">
                                @foreach ($images as $image)
                                    <div class="col-4">
                                        <div class="card shadow border-0 p-3" style="max-width: 300px; overflow: hidden;">
                                            <div class="card-body d-flex flex-column gap-3 p-0 h-100">
                                                <div class="flex-shrink-0" style="height: 150px; overflow: hidden;">
                                                    <img src="{{ asset('storage/images/' . $image->path) }}" 
                                                        class="w-100 h-100 rounded" 
                                                        style="object-fit: contain;">
                                                </div>
                                                <form method="POST" action="{{ route('toggleLike', $image->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm {{ $image->isLikedBy(auth()->user()) ? 'btn-danger' : 'btn-outline-danger' }}">
                                                        ❤️
                                                        {{ $image->likes->count() }}
                                                    </button>
                                                </form>
                                                <!-- <button data-id="{{ $image->id }}" class="like-button btn btn-sm {{ $image->isLikedBy(auth()->user()) ? 'btn-danger' : 'btn-outline-danger' }}">
                                                    ❤️
                                                    {{ $image->likes->count() }}
                                                </button> -->
                                                <div class="px-2">
                                                    <p class="m-0 mb-2 fs-5 fw-bold">{{ $image->judul }}</p>
                                                    <p class="m-0 text-truncate text-truncate d-block">{{ $image->deskripsi }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                @endforeach
                            </div>
                        </div>
                        
                        <div id="saved" class="tab-section" style="display: none;">
                            <div class="bg-danger w-100" style="height: 200px;">
                                <p class="text-white text-center pt-5">Konten Simpan</p>
                            </div>
                        </div>
                        
                        <div id="liked" class="tab-section" style="display: none;">
                            <div class="row g-3">
                                @forelse ($likedImages as $image) 
                                <div class="col-4">
                                    <div class="card shadow border-0 p-3" style="max-width: 300px; overflow: hidden;">
                                        <div class="card-body d-flex flex-column gap-3 p-0 h-100">
                                            <div class="flex-shrink-0" style="height: 150px; overflow: hidden;">
                                                <img src="{{ asset('storage/images/' . $image->path) }}"
                                                    class="w-100 h-100 rounded"
                                                    style="object-fit: contain;" alt="gambar disukai">
                                            </div>
                                            <div class="px-2">
                                                <p class="m-0 mb-2 fs-5 fw-bold">{{ $image->judul }}</p>
                                                <p class="m-0 text-truncate text-truncate d-block">{{ $image->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <p class="text-center text-muted">Belum ada gambar yang disukai.</p>
                                @endforelse
                            </div>
                        </div>
                        

                        {{-- <div class="d-flex justify-content-center align-items-center gap-5">
                            <p class="fs-5">Gambar</p>
                            <p class="fs-5">Simpan</p>
                            <p class="fs-5">Disukai</p>
                        </div>
                        <div id="gambar">
                            <div class="row g-3">
                                @foreach ($images as $image)
                                    <div class="col-4">
                                        <div class="card shadow border-0 p-3" style="max-width: 300px; overflow: hidden;">
                                            <div class="card-body d-flex flex-column gap-3 p-0 h-100">
                                                <div class="flex-shrink-0" style="height: 150px; overflow: hidden;">
                                                    <img src="{{ asset('storage/images/' . $image->path) }}" 
                                                        class="w-100 h-100 rounded" 
                                                        style="object-fit: contain;">
                                                </div>
                                                <div class="px-2">
                                                    <p class="m-0 mb-2 fs-5 fw-bold">{{ $image->judul }}</p>
                                                    <p class="m-0 text-truncate">{{ $image->deskripsi }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                @endforeach
                            </div>
                        </div>
                        <div id="save" class="bg-danger w-100" style="height: 200px; display: none">

                        </div>
                        <div id="save" class="bg-info w-100" style="height: 200px; display: none">

                        </div> --}}
                        {{-- <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 200px;">Judul</th>
                                        <th style="width: 300px;">Deskripsi</th>
                                        <th style="width: 150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($images as $image)
                                    <tr>
                                        <td style="width: 200px; word-break: break-word;">
                                           {{ $image->judul }} 
                                        </td>
                                        <td style="width: 300px; word-break: break-word;">
                                            {{ $image->deskripsi }}
                                        </td>
                                        <td style="width: 150px;">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('ShowImage', $image->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('DestroyImage', $image->id) }}" method="POST" onsubmit="return confirm('Hapus gambar?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </body>
    <script>
        const tabs = document.querySelectorAll('.tab-button');
        const sections = document.querySelectorAll('.tab-section');
    
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetId = tab.getAttribute('data-target');
    
                // Reset semua section
                sections.forEach(section => section.style.display = 'none');
    
                // Tampilkan yang dipilih
                document.getElementById(targetId).style.display = 'block';
    
                // Update active tab
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
            });
        });
    </script>    
    
</html>