@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row"> -->
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-8 col-md-offset-2">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-8 col-md-offset-2">
                                <input type="password" class="form-control" name="password" placeholder="Senha">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-btn fa-sign-in"></i>Logar
                                </button>
                            </div>
                        </div>

                        <!--<div class="form-group">
                            <div class="col-md-6">
                                <a class="btn btn-link" href="{{ url('/register') }}">Registrar</a>
                                 <span> ou </span>
                                <a class="btn btn-link" href="{ url('/password/reset') }">Esqueci minha senha</a>
                            </div>

                        </div>-->
                    </form>
                </div>
            </div>
        </div>
    <!-- </div> -->
</div>
@endsection
