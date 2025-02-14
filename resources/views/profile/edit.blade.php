@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
{{-- <div class="container py-5"> --}}
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color: #16404D;">Edit Profil Anda</h1>
            <p class="text-muted">Perbarui informasi Anda untuk pengalaman yang lebih baik.</p>
        </div>
    
        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0" style="background-color: #FBF5DD;">
                    <div class="card-body text-center">
                        <!-- Foto Profil -->
                        <div class="mb-3">
                            @if($user->foto_users)
                                <img src="{{ asset('storage/foto_users/' . $user->foto_users) }}" 
                                     alt="Foto Profil" 
                                     class="img-fluid rounded-circle border border-3 shadow-sm hover-zoom" 
                                     style="width: 150px; height: 150px; object-fit: cover; border-color: #DDA853; transition: transform 0.3s ease;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-secondary text-white rounded-circle" 
                                     style="width: 150px; height: 150px;">
                                    <span style="font-size: 2rem;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <h4 class="fw-bold" style="color: #16404D;">{{ $user->name }}</h4>
                        <p class="text-muted mb-3">{{ $user->email }}</p>
                        <p class="text-muted mb-3">{{ $user->phone }}</p>
                       
                    </div>
                </div>
            </div>
    
            <!-- Main Content -->
            <div class="col-md-8">
                <div class="card shadow-sm border-0" style="background-color: #FBF5DD;">
                    <div class="card-body p-4">
                        <h4 class="mb-4 fw-bold" style="color: #16404D;">Edit Profil</h4>
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
    
                            <!-- Nama -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold" style="color: #16404D;">Nama</label>
                                <input type="text" class="form-control shadow-sm" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                <hr class="mt-3" style="border-top: 1px solid #DDA853; opacity: 0.5;">
                            </div>
    
                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold" style="color: #16404D;">Email</label>
                                <input type="email" class="form-control shadow-sm" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                <hr class="mt-3" style="border-top: 1px solid #DDA853; opacity: 0.5;">
                            </div>
    
                            <!-- Alamat -->
                            <div class="mb-4">
                                <label for="address" class="form-label fw-bold" style="color: #16404D;">Alamat</label>
                                <textarea class="form-control shadow-sm" id="address" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                                <hr class="mt-3" style="border-top: 1px solid #DDA853; opacity: 0.5;">
                            </div>

                               <!-- Alamat -->
                               <div class="mb-4">
                                <label for="phone" class="form-label fw-bold" style="color: #16404D;">phone</label>
                                <input type="number" class="form-control shadow-sm" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                                {{-- <textarea class="form-control shadow-sm" id="phone" name="phone" rows="3">{{ old('phone', $user->phone) }}</textarea> --}}
                                <hr class="mt-3" style="border-top: 1px solid #DDA853; opacity: 0.5;">
                            </div>
    
                            <!-- Tombol -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-success shadow-sm" style="background-color: #A6CDC6; color: #16404D; border-radius: 8px; padding: 10px 25px; font-weight: bold; transition: all 0.3s;">
                                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('profile.show') }}" class="btn btn-secondary shadow-sm ms-2" style="border-radius: 8px; padding: 10px 25px; font-weight: bold; color: #DDA853; border: 2px solid #DDA853; transition: all 0.3s;">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
{{-- </div> --}}
@endsection
