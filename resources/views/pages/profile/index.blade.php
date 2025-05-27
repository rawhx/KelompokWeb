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
        @include('components.header')
        <section class="d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="font-semibold heading-underline">Profile</h4>
                <button class="btn btn-outline-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#editProfile">Edit Profile</button>
            </div>
            <div class="d-flex flex-column gap-3 justify-content-center align-items-center">
                <div class="d-inline-block bg-primary position-relative overflow-hidden rounded-circle" style="width: 200px; height: 200px;">
                    <img src="{{ auth()->user()->foto_profil 
                                ? asset('storage/profile_pictures/' . auth()->user()->foto_profil) 
                                : 'https://sussexunipharmacy.co.uk/wp-content/uploads/2024/02/no-profile-img.jpg' }}" 
                        class="w-100 h-100 position-absolute top-0 start-0" 
                        style="object-fit: cover; object-position: center;" 
                        alt="Profil">  
                </div>
                <div class="d-flex flex-column align-items-center">
                    <h3 class="fw-bold">{{auth()->user()->username}}</h3>
                    <h5 class="fw-semibold">{{auth()->user()->email}}</h5>
                </div>  
                <div class="d-flex gap-2">
                    <button class="px-5 btn btn-outline-danger" onclick="logout()">Logout</button>
                    <button class="px-5 btn btn-danger" onclick="deleteAkun()">Hapus Akun</button>
                </div>
            </div>
        </section>
        <div class="modal fade" id="editProfile" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editProfileLabel">Edit Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('updateProfil')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="visually">Email</label>
                                    <input type="text" readonly class="form-control" value="{{auth()->user()->email}}">
                                </div>
                                <div class="col-12">
                                    <label class="visually">Username</label>
                                    <input type="text" name="username" class="form-control" value="{{auth()->user()->username}}">
                                </div>
                                <div class="col-12">
                                    <label for="foto_profil" class="form-label">Profile</label>
                                    <input class="form-control" type="file" name="foto_profil" id="foto_profil" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('components.footer')
    </body>
    <script>
        function logout() { 
            window.location.href = "/logout";
        }

        function deleteAkun() { 
            Swal.fire({
                title: "Hapus Akun",
                text: "Apakah Anda yakin ingin menghapus akun ini?",
                icon: "danger",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "/profil",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        success: function (response) {
                            window.location.href = "/login";
                        },
                        error: function (xhr, status, error) {
                            alert("Gagal menghapus akun.");
                        }
                    });
                }
            });
        }

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