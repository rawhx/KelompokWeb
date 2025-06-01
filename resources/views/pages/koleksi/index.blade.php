<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <style>
    </style>
    <body>
        @include('components.notif')
        @include('components.header')
        <section class="d-flex flex-column gap-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="font-semibold heading-underline">Koleksi</h4>
                <a href="{{ route('koleksiAddPage') }}" class="btn btn-outline-dark fw-semibold">Tambah Koleksi</a>
            </div>
            <div>
                @foreach ($koleksis as $koleksi)
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <h5>{{ $koleksi->koleksi_nama }}</h5>

                        <div class="d-flex gap-2 w-full justify-content-end">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('koleksiEdit', $koleksi->id) }}" class="btn text-secondary p-0 text-decoration-none">Edit</a>

                            {{-- Tombol Hapus --}}
                            <button onclick="deleteKoleksi({{ $koleksi->id }})" class="btn text-danger p-0 text-decoration-none">
                                Hapus
                            </button>
                        </div>
                    </div>

                    <div class="bento-grid">
                        @foreach ($koleksi->data as $data)
                            @if ($data->image)
                                <div class="bento-item">
                                    <a href="{{ route('detailPost', $data->image->id) }}">
                                        <img src="{{ asset('storage/images/' . $data->image->path) }}" alt="Foto {{ $data->image->judul }}">

                                        <div class="overlay">
                                            <span class="image-title">{{ $data->image->judul }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach

            </div>
        </section>

        <script>
            function deleteKoleksi(id) {
                Swal.fire({
                    title: "Hapus koleksi",
                    text: "Apakah Anda yakin ingin menghapus koleksi ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/koleksi/delete`,
                            type: "POST",
                            data: {
                                id: id,
                                _method: "DELETE",
                                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            success: function(response) {
                                Swal.fire("Berhasil!", "Koleksi telah dihapus.", "success").then(() => {
                                    window.location.reload(); 
                                });
                            },
                            error: function(xhr) {
                                Swal.fire("Gagal", "Gagal menghapus koleksi.", "error");
                            }
                        });
                    }
                });
            }
        </script>
    </body>
</html>