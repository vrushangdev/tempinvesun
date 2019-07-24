Click here to reset your password: <a href="{{ $link =Route('retailer.auth.password.reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
