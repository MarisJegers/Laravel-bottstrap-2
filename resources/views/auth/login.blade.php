@extends('layouts.layout')

@section('content')

<div class="video-wrapper">
  <video playsinline autoplay muted loop poster="cake.jpg">
    <!--<source src="https://cdn.videvo.net/videvo_files/video/free/2019-07/small_watermarked/Raw_Vegan_Blueberry_Cake_Cut_Birthday_Cooking_preview.webm" type="video/webm"> -->
    <source src="image/ocean12.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  


<div class="d-flex align-items-center">
    <div class="col"> <br> </div> <!-- sviestains veids, kā login lapu padarīt nedaudz glītāku-->
</div>

    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="card">
                <div class="card-header"><h4>{{ __('Pieteikties sistēmā') }}</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating mb-3">
                                <input 
                                id="email" 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                
                                autofocus
                                placeholder="name@example.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="floatingInput">E-pasta adrese</label>
                            </div>
                        

                        <div class="form-floating mb-3">
                                <input 
                                id="password" 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password" 
                                required 
                                
                                placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <label for="floatingInput">Parole</label>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Atcerēties') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Pieteikties') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Aizmirsi paroli?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
