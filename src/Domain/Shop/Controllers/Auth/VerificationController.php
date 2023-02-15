<?php

namespace Domain\Shop\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Domain\Shop\Controllers\Controller;
use Domain\Shop\Repositories\VerificationRepository;

class VerificationController extends Controller
{
    public function __invoke(string $email, string $code, VerificationRepository $repository): RedirectResponse
    {
        if ($verification = $repository->findByCode($code)) {
            if ($verification->user->email === $email) {
                if (! $verification->custom()) {
                    $verification->handle();
                }

                return $verification->redirect();
            }
        }

        return $this->redirect('home');
    }
}
