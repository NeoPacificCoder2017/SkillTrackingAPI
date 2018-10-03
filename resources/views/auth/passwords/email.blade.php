@extends('layouts.app_reset_password')

@section('content')
<div class="back">
</div>
<div class="element col-lg-12 col-sm-12 ">
</div>
<div class="container-fluid col-lg-12 col-sm-12" id="page-login-full" style="width: 500px;">
    <div class="div_logo">
        <img class="logo" src="{{asset('images/logo-blanc.png') }}" alt="Logo">
    </div>
    <h2 class="skill-title">SKILL TRACKING</h2>
    <div class="cadre-login row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body block_blanc">
                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf
                        <h2 class="text-center grey">Mot de passe oublié?</h2>
                        <div class="form-group ">

                            <input  id="exampleInputEmail1" type="email" class="form-in form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Entrez votre Email" name="email" value="{{ old('email') }}"  required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <div  class="invalid-feedback">
                                <div>
                                    Email requis
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <button type="submit"  class="btn btn-block purple">
                                {{ __('Envoyer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
