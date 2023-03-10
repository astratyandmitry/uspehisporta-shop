<?php

namespace Domain\Shop\Controllers\Auth;

use Domain\Shop\Models\VerificationType;
use Domain\Shop\Repositories\VerificationRepository;
use Domain\Shop\Requests\Auth\RegisterRequest;
use Domain\Shop\Repositories\UsersRepository;
use Domain\Shop\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Domain\Shop\Models\Page;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function form(): View
    {
        $this->setup(PAGE_AUTH_REGISTER)
            ->hideBreadcrumbs()
            ->hideTitle();

        return $this->view('auth.register');
    }

    public function process(
        RegisterRequest $request,
        UsersRepository $usersRepository,
        VerificationRepository $verificationRepository
    ): RedirectResponse {
        $user = $usersRepository->register($request);

        $user->sendVerification(
            $verificationRepository->generate($user, VERIFICATION_ACTIVATION)
        );

        return $this->redirect('auth.login')
            ->with('message', 'На указанный e-mail было выслано письмо с кодом подтверждения');
    }
}
