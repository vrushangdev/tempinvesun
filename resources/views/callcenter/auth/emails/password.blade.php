Click here to reset your password: <a href="{{ $link =Route('callcenter.auth.password.reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
