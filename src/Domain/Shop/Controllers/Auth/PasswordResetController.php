<?php

namespace Domain\Shop\Controllers\Auth;

use Domain\Shop\Repositories\UsersRepository;
use Domain\Shop\Repositories\VerificationRepository;
use Domain\Shop\Requests\Auth\PasswordResetRequest;
use Domain\Shop\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Domain\Shop\Models\Page;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
    public function form(string $code, VerificationRepository $repository): View
    {
        abort_if($repository->findPasswordRecoveryByCode($code) === null, 403);

        $this->setup(PAGE_AUTH_PASSWORD_RESET)
            ->hideBreadcrumbs()
            ->hideTitle();

        return $this->view('auth.password-reset', [
            'email' => request()->query('email'),
        ]);
    }

    public function process(
        string $code,
        PasswordResetRequest $request,
        VerificationRepository $verificationRepository,
        UsersRepository $usersRepository
    ): RedirectResponse {
        $verification = $verificationRepository->findPasswordRecoveryByCode($code);

        abort_if($verification === null, 403);
        abort_if($verification->user->email !== $request->email, 403);

        if ($usersRepository->updatePassword($verification->user, $request->password)) {
            $verification->handle();
        }

        return $this->redirect('auth.login')
            ->with('message', 'Ваш пароль был успешно изменен');
    }
}
