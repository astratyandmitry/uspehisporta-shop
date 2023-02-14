<?php

namespace Domain\Shop\Controllers\Auth;

use Domain\Shop\Models\VerificationType;
use Domain\Shop\Repositories\VerificationRepository;
use Domain\Shop\Requests\Auth\PasswordRecoveryRequest;
use Domain\Shop\Repositories\UsersRepository;
use Domain\Shop\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Domain\Shop\Models\Page;
use Illuminate\View\View;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class PasswordRecoveryController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function form(): View
    {
        $this->setup(PAGE_AUTH_PASSWORD_RECOVERY)
            ->hideBreadcrumbs()
            ->hideTitle();

        return $this->view('auth.password-recovery');
    }

    /**
     * @param \Domain\Shop\Requests\Auth\PasswordRecoveryRequest $request
     * @param \Domain\Shop\Repositories\UsersRepository $usersRepository
     * @param \Domain\Shop\Repositories\VerificationRepository $verificationRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(
        PasswordRecoveryRequest $request,
        UsersRepository $usersRepository,
        VerificationRepository $verificationRepository
    ): RedirectResponse {
        /** @var \Domain\Shop\Models\User $user */
        if ($user = $usersRepository->findByEmail($request->email)) {
            $user->sendVerification(
                $verificationRepository->generate($user, VerificationType::PASSWORD_RECOVERY)
            );
        }

        return redirect()->back()
            ->with('message', 'Усли указанный e-mail зарегистрирован, то на него было выслано письмо с кодом подтверждения');
    }
}
