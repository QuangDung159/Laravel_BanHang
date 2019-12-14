@extends('layouts.Layout')
@section('content')
    <?php
    if (Session::get('msg_sign_up_success') != null) {
        echo
            '<div class="alert alert-success"><strong>' . Session::get('msg_sign_up_success') . '</strong></div>';
        Session::put('msg_sign_up_success', null);
    }
    ?>
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="signup-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="#">
                            {{csrf_field()}}
                            <input type="text" placeholder="Name"/>
                            <input type="email" placeholder="Email Address"/>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Sign-up!</h2>
                        <form action="{{URL::to('/doSignUp')}}" method="post">
                            {{csrf_field()}}
                            <input type="email" name="email" placeholder="Email Address"/>
                            <input type="password" name="password" placeholder="Password"/>
                            <input type="text" name="full_name" placeholder="Full Name"/>
                            <button type="submit" class="btn btn-default">Sign-up</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
