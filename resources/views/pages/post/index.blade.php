<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.head')
<body>
    @include('components.notif')
    @include('components.header')

    <section class="d-flex flex-column gap-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="font-semibold heading-underline">Postingan</h4>
        </div>

        <div class="d-flex justify-content-center">
            <div class="pb-3 gap-3 px-3 position-sticky row justify-content-center top-0" style="padding-top: 2.3em; width: 50%">
                
                <div class="d-flex gap-2 align-items-center">
                    <div class="d-inline-block bg-primary position-relative overflow-hidden rounded-circle" 
                        style="width: 40px; height: 40px;">
                        <img src="{{ asset('storage/profile_pictures/' . $image->user->foto_profil) }}" 
                        class="w-100 h-100 position-absolute top-0 start-0" 
                        style="object-fit: cover; object-position: center;" 
                        alt="Profil">  
                    </div>
                    <strong>{{ $image->user->username }}</strong>
                    <div class="ms-auto d-flex gap-2">
                        <a href="{{ route('editImage', $image->id) }}" class="btn btn-sm bg-transparent border-0 text-primary" style="outline: none;">Edit</a>
                        <form action="{{ route('DestroyImage', $image->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"class="btn btn-sm btn-danger border-0" style="outline: none;">Hapus</button>
                        </form>
                    </div>
                </div>

                {{-- Main Image --}}
                <div class="col-12 position-relative overflow-hidden d-block" style="border-radius: 20px; width: max-content; height: auto;">
                    <img src="{{ asset('storage/images/' . $image->path) }}" 
                         class="w-100"
                         style="height: auto; object-fit: contain; border-radius: 20px; max-height: 500px;"
                         alt="{{ $image->judul }}">
                </div>

                {{-- Judul dan Deskripsi --}}
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h2 class="mb-0">{{ $image->judul }}</h2>

                        <!-- Bagian action bar bawah gambar -->
                         <div class="d-flex gap-3 justify-self-end">
                            {{-- COMMENT BUTTON --}}
                            <button class="btn p-0 border-0 bg-transparent comment-btn" style="outline: none;" onclick="focusComment()">
                                <i class="bi bi-chat"></i>
                            </button>
                            
                            {{-- LIKE BUTTON --}}
                            <form method="POST" action="{{ route('toggleLike', $image->id) }}">
                                @csrf
                                <button type="submit" class="btn p-0 border-0 bg-transparent like-btn" style="outline: none;">
                                    <i class="bi {{ $image->isLikedBy(auth()->user()) ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
                                    <span class="ms-1">{{ $image->likes->count() }}</span>
                                </button>
                            </form>
                        </div>
                        
                    </div>
                    <p class="text-wrap" style="word-break: break-word;">{{ $image->deskripsi }}</p>
                </div>
                        
                <!-- line break -->
                <div class="col-12">
                    <hr>
                </div>

                {{-- Komentar --}}
                <div class="col-12 mt-4">
                    <h5 class="mb-3">Komentar:</h5>

                    {{-- Komentar yang ada --}}
                    @forelse ($image->comments as $comment)
                        @if($comment->user_id === auth()->id())
                            <div class="d-flex gap-2 w-full justify-content-end">
                                <button class="btn text-secondary p-0 text-decoration-none" style="cursor: pointer;" onclick="toggleEdit({{ $comment->id }}, true)">Edit</button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('destroyComment', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn text-danger p-0 text-decoration-none">Hapus</button>
                                </form>
                            </div>
                        @endif

                        <div class="border rounded p-2 mb-3 position-relative">

                            <!-- Profile User -->
                            <div class="d-flex gap-2 align-items-center">
                                {{-- Profile Picture --}}
                                <div class="d-inline-block bg-primary position-relative overflow-hidden rounded-circle" 
                                    style="width: 40px; height: 40px;">
                                    <img src="{{ asset('storage/profile_pictures/' . $comment->user->foto_profil) }}" 
                                    class="w-100 h-100 position-absolute top-0 start-0" 
                                    style="object-fit: cover; object-position: center;" 
                                    alt="Profil">  
                                </div>
                                <strong>{{ $comment->user->username }}</strong>
                                <div id="comment-text-{{ $comment->id }}">
                                    <p class="mb-0">{{ $comment->content }}</p>
                                </div>
                            </div>

                            {{-- Form Edit (hidden by default) --}}
                            <form id="edit-form-{{ $comment->id }}" class="d-none mt-2" action="{{ route('updateComment', $comment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <textarea name="content" class="form-control mb-2" rows="2">{{ $comment->content }}</textarea>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="toggleEdit({{ $comment->id }}, false)">Batal</button>
                                </div>
                            </form>
                        </div>
                    @empty
                        <p>Belum ada komentar.</p>
                    @endforelse

                    {{-- Form Tambah Komentar --}}
                    <form action="{{ route('storeComment', $image->id) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <textarea id="commentArea" name="content" class="form-control" rows="10" placeholder="Komentar"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary py-2" style="padding-inline: 2.5rem;">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    function toggleEdit(commentId, show) {
        const text = document.getElementById(`comment-text-${commentId}`);
        const form = document.getElementById(`edit-form-${commentId}`);
        if (show) {
            text.classList.add('d-none');
            form.classList.remove('d-none');
        } else {
            text.classList.remove('d-none');
            form.classList.add('d-none');
        }
    }

    function focusComment() {
        const textarea = document.getElementById("commentArea");
        if (textarea) {
            textarea.scrollIntoView({ behavior: 'smooth', block: 'center' });
            textarea.focus();
        }
    }
</script>    
</html>