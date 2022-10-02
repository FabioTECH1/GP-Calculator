<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4 text-center my-2">
        <h4>Hi {{ $user->lname }}</h4>
        <p>Clcik <a href="{{ route('reset.link', $user->passwordreset->token) }}"
                style="text-decoration:none">here</a>
            or copy the link below to
            your browser to reset your password</p>
        <br>
        <a style="text-decoration:none"
            href="{{ route('reset.link', $user->passwordreset->token) }}">{{ route('reset.link', $user->passwordreset->token) }}</a>
        <div class="col-sm-4"></div>
        <br><br>
        <strong>NB: Ignore this email if you did not initiate a passord reset</strong>
    </div>
</div>
