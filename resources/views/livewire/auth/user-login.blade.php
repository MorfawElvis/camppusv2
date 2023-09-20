<div>
    <div class="container">
        <div class="row d-flex justify-content-center min-vh-100 align-items-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center mb-5">
                        <img src="{{ asset('images/sabibi.JPG') }}" class="rounded-circle" alt="Camppus Logo" style="width: 60%;">
                    </div>
                    <h3 class="text-center mb-4">Have an account?</h3>
                    <div class="text-center">
                        @if ($errors->any())
                            <div class="alert alert-danger text-danger h6">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <form wire:submit.prevent="login">
                        <div class="form-floating mb-4">
                            <input type="text" wire:model="form.user_code" class="form-control" id="user-code" placeholder="userCode"
                                   name="user_code" autofocus>
                            <label for="user-code">{{ __('User code') }}</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input id="password-field" wire:model="form.password" type="password" class="form-control" id="password" placeholder="Password"
                                   name="password"  autofocus>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            <label for="password">{{ __('Password') }}</label>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">Remember Me
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none"  href="{{route('password.request')}}">Forgot Password</a>
                                @endif
                            </div>
                        </div>
                        <button type="submit" value="login"  class="btn btn-primary btn-block rounded fw-bold fs-5 mb-4">
                            <div wire:loading.delay wire:target="login" class="spinner-border spinner-border-sm text-white mr-1"></div>
                            Log In
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
