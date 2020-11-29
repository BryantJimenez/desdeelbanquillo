@extends('layouts.auth')

@section('title', 'Restaurar Contraseña')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="form-container outer bg-primary">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="">Restaurar Contraseña</h1>

                    @include('admin.partials.errors')

                    <form class="text-left" action="{{ route('reset.custom') }}" method="POST" id="formReset">
                        {{ csrf_field() }}
                        <input type="hidden" name="slug" value="{{ $slug }}">

                        <div class="col-12">
                            @include('admin.partials.errors')

                            @if(session('error.reset'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <ul>
                                    <li>{{ session('error.reset') }}</li>
                                </ul>
                            </div>
                            @endif

                            @if(session('success.reset'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <ul>
                                    <li>{{ session('success.reset') }}</li>
                                </ul>
                            </div>
                            @endif
                        </div>
                        
                        <div class="form">
                            <div id="password-field" class="field-wrapper input mb-2">
                                <div class="d-flex justify-content-between">
                                    <label for="password">NUEVA CONTRASEÑA</label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" type="password" class="form-control  @error('password') is-invalid @enderror" placeholder="********" autocomplete="new-password">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </div>

                            <div class="field-wrapper input mb-2">
                                <div class="d-flex justify-content-between">
                                    <label for="password_confirm">CONFIRMAR CONTRASEÑA</label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="********" autocomplete="new-password">
                            </div>

                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" action="reset">Enviar</button>
                                </div>
                            </div>

                            <div class="d-sm-flex justify-content-center mt-3">
                                <div class="field-wrapper">
                                    <p class="text-center"><a href="{{ route('home') }}" class="text-primary m-l-5"><b>Volver a la Página</b></a></p>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>                    
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection