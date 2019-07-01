Click here to reset your password: <a href="{{ $link =Route('lead_assistant.auth.password.reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
