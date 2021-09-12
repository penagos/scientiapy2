<div class="row justify-content-center">
    <div class="col-lg-8 p-4">
      <form wire:submit.prevent="register">
        <h1 class="h3 mb-3 font-weight-normal text-center">Create an Account</h1>
        @error('status') <span class="text-danger error">{{ $message }}</span>@enderror

        <div class="mb-3">
          <label for="inputEmail" class="sr-only">Email</label>
          <input type="text" id="inputEmail" class="form-control" placeholder="Email address" wire:model.defer="email" required autofocus>
          @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
          <label for="inputEmail" class="sr-only">Username</label>
          <input type="text" id="inputUsername" class="form-control" placeholder="Username" wire:model.defer="username" required autofocus>
          @error('username') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" wire:model.defer="password" placeholder="Password" required>
          @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
          <label for="inputPassword2" class="sr-only">Confirm Password</label>
          <input type="password" id="inputPassword2" class="form-control" wire:model.defer="password_confirmation" placeholder="Password" required>
          @error('password_confirmation') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
          <a href="#" onclick="Livewire.emit('openModal', 'login'); return false">Already have an account?</a>
        </div>
        <div class="text-center">
          <input type="submit" value="Create Account" class="btn btn-lg btn-primary btn-block">
        </div>
      </form>
    </div>
</div>
