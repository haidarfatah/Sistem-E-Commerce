@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <!-- Main Profile Section -->
        <div class="col-lg-8">
            <div class="card shadow-lg border-0" 
                 style="background: linear-gradient(135deg, #FBF5DD, #A6CDC6); border-radius: 20px; overflow: hidden;">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <!-- Profile Picture -->
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            @if($user->foto_users)
                                <img src="{{ asset('storage/foto_users/' . $user->foto_users) }}" 
                                     alt="Foto Profil" 
                                     class="img-fluid rounded-circle border border-4 shadow-sm" 
                                     style="width: 150px; height: 150px; object-fit: cover; border-color: #d68706; animation: fadeIn 1s;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-secondary text-white rounded-circle mx-auto shadow-sm" 
                                     style="width: 150px; height: 150px; animation: fadeIn 1s;">
                                    <span style="font-size: 2.5rem; font-weight: bold;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Profile Details -->
                        <div class="col-md-8">
                            <h2 class="fw-bold mb-3" style="color: #16404D; font-size: 1.8rem;">{{ $user->name }}</h2>
                            <ul class="list-unstyled mb-4" style="font-size: 1.1rem; color: #16404D;">
                                <li class="mb-2">
                                    <i class="fas fa-envelope me-2" style="color: #DDA853;"></i> 
                                    <span class="fw-bold">{{ $user->email }}</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-map-marker-alt me-2" style="color: #DDA853;"></i> 
                                    <span class="fw-bold">{{ $user->address ?? 'Belum diisi' }}</span>
                                </li>
                                <li>
                                    <i class="fas fa-phone me-2" style="color: #DDA853;"></i> 
                                    <span class="fw-bold">{{ $user->phone ?? 'Belum diisi' }}</span>
                                </li>
                            </ul>

                   <!-- Action Buttons -->
<div class="d-flex justify-content-start">
    <!-- Edit Profile Button -->
    <a href="{{ route('profile.edit') }}" 
       class="btn btn-warning me-2 shadow-sm d-flex align-items-center justify-content-center" 
       style="background-color: #DDA853; color: #16404D; border-radius: 8px; padding: 8px 20px; font-weight: bold; font-size: 0.9rem; transition: all 0.3s;">
       <i class="fas fa-edit me-2"></i>Edit Profil
    </a>

    <!-- Logout Button -->
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" 
                class="btn btn-outline-danger shadow-sm d-flex align-items-center justify-content-center" 
                style="border-radius: 8px; padding: 8px 20px; font-weight: bold; font-size: 0.9rem; border: 2px solid #DDA853; color: #DDA853; transition: all 0.3s;">
            <i class="fas fa-sign-out-alt me-2"></i>Logout
        </button>
    </form>
</div>



                        </div>
                    </div>
                </div>
            </div>
        </div>

      
    </div>
</div>

<!-- Custom CSS -->
<style>
    /* Animation for Profile Picture */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Hover Effects for Buttons */
    .btn-warning:hover {
        background-color: #FBF5DD;
        color: #16404D;
        transform: scale(1.05);
    }

    .btn-outline-danger:hover {
        background-color: #DDA853;
        color: #FBF5DD;
        transform: scale(1.05);
    }

    /* button  */
    <!-- Custom CSS -->

    /* Hover Effect for Buttons */
    .btn-warning:hover {
        background-color: #FBF5DD;
        color: #16404D;
        transform: scale(1.05);
    }

    .btn-outline-danger:hover {
        background-color: #9d2f0d;
        color: #FBF5DD;
        transform: scale(1.05);
    }

    /* Icon Adjustment */
    .btn i {
        font-size: 1rem;
    }

</style>
@endsection
