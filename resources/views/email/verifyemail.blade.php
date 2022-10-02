<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 text-center my-2">
        <h4>Welcome {{ $user->lname }}</h4>
        <p>Clcik <a href="{{ route('verify.mail', $user->verifyuser->token) }}" style="text-decoration:none">here</a>
            or copy the link below to
            your browser to verify your email</p>
        <br>
        <a style="text-decoration:none"
            href="{{ route('verify.mail', $user->verifyuser->token) }}">{{ route('verify.mail', $user->verifyuser->token) }}</a>
        <div class="col-sm-4"></div>
    </div>
</div>
