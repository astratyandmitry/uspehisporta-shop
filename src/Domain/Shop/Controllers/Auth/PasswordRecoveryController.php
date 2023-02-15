<?php

namespace Domain\Shop\Controllers\Auth;

use Domain\Shop\Repositories\VerificationRepository;
use Domain\Shop\Requests\Auth\PasswordRecoveryRequest;
use Domain\Shop\Repositories\UsersRepository;
use Domain\Shop\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PasswordRecoveryController extends Controller
{
    public function form(): View
    {
        $this->setup(PAGE_AUTH_PASSWORD_RECOVERY)
            ->hideBreadcrumbs()
            ->hideTitle();

        return $this->view('auth.password-recovery');
    }

    public function process(
        PasswordRecoveryRequest $request,
        UsersRepository $usersRepository,
        VerificationRepository $verificationRepository
    ): RedirectResponse {
        /** @var \Domain\Shop\Models\User $user */
        if ($user = $usersRepository->findByEmail($request->email)) {
            $user->sendVerification(
                $verificationRepository->generate($user, VERIFICATION_PASSWORD_RECOVERY)
            );
        }

        return redirect()->back()
            ->with('message', 'Усли указанный e-mail зарегистрирован, то на него было выслано письмо с кодом подтверждения');
    }
}
