Click here to reset your password: <a href="{{ $link =Route('tech_partner.auth.password.reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
