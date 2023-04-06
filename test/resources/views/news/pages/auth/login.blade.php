
@extends('news.auth')
@section('content')
<div class="row justify-content-md-center h-100">
    <div class="card-wrapper">
        <div class="brand">
            <img src="{{asset('auth/img/logo.png')}}">
        </div>
        <div class="card fat">
            <div class="card-body">
                <h4 class="card-title">Login</h4>
                @include('news.elements.notify',['content'=>'my_notify'])
                <form action="{{route("$controllerName/postLogin")}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">E-Mail Address</label>

                        <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password
                            <a href="forgot.html" class="float-right">
                                Forgot Password?
                            </a>
                        </label>
                        <input id="password" type="password" class="form-control" name="password" required data-eye>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>

                    <div class="form-group no-margin">
                        <button type="submit" class="btn btn-primary btn-block">
                            Login
                        </button>
                    </div>
                    <div class="margin-top20 text-center">
                        Don't have an account? <a href="register.html">Create One</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">
            Copyright &copy; Your Company 2017
        </div>
    </div>
</div>
@endsection