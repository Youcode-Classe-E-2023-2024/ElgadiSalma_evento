<div>

    <p>Hello {{ $user->name }}</p>

    <a href="{{ url('reset-password/'.$user->remember_token) }}"><button>Reset Your Password</button></a>

</div>
