<div class="row justify-content-center">
    <div class="col-lg-8 p-4">
      <form wire:submit.prevent="authenticate">
        <h1 class="h3 mb-3 font-weight-normal text-center">Login</h1>
        @error('status') <span class="text-danger error">{{ $message }}</span>@enderror

        <div class="mb-3">
          <label for="inputEmail" class="sr-only">Username / Email</label>
          <input type="text" id="inputEmail" class="form-control" placeholder="Email address / username" wire:model.defer="username" required autofocus>
          @error('username') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" wire:model.defer="password" placeholder="Password" required>
          @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label><br>
          <a href="#" onclick="Livewire.emit('openModal', 'register'); return false">Don't have an account?</a>
        </div>
        <div class="text-center">
          <input type="submit" value="Login" class="btn btn-lg btn-primary btn-block">
        </div>
      </form>
    </div>
</div>
