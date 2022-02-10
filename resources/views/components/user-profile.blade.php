<div class="card">
    <img class="card-img-top p-5" src="{{ asset('img/avatar-placeholder.svg') }}" alt="Profile picture">
    <div class="card-body">
        <h5 class="fw-light">{{ $user->username }} <span class="badge badge-success fw-light small p-1">{{ $user->reputation }}</span></h5>
        <p class="small">
            Joined @datetime($user->created_at)
        </p>
    </div>
</div>