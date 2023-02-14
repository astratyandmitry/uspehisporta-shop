<?php

namespace Domain\Shop\Controllers\Auth;

use Domain\Shop\Repositories\UsersRepository;
use Domain\Shop\Repositories\VerificationRepository;
use Domain\Shop\Requests\Auth\PasswordResetRequest;
use Domain\Shop\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Domain\Shop\Models\Page;
use Illuminate\View\View;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class PasswordResetController extends Controller
{
    /**
     * @param string $code
     * @param \Domain\Shop\Repositories\VerificationRepository $repository
     * @return \Illuminate\View\View
     */
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

    /**
     * @param string $code
     * @param \Domain\Shop\Requests\Auth\PasswordResetRequest $request
     * @param \Domain\Shop\Repositories\VerificationRepository $verificationRepository
     * @param \Domain\Shop\Repositories\UsersRepository $usersRepository
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
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
