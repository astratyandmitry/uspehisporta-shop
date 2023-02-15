<?php

namespace Domain\Shop\Controllers\Account;

use Domain\Shop\Controllers\Controller;
use Domain\Shop\Models\Page;
use Domain\Shop\Repositories\UsersRepository;
use Domain\Shop\Requests\Account\SecuritySettingsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SecuritySettingsController extends Controller
{
    public function form(): View
    {
        $this->layout->addBreadcrumb('Личный кабинет', route('shop::account.redirect'));
        $this->setup(PAGE_ACCOUNT_SETTINGS_SECURITY);

        return $this->view('account.settings.security');
    }

    public function process(SecuritySettingsRequest $request, UsersRepository $repository): RedirectResponse
    {
        /** @var \Domain\Shop\Models\User $user */
        $user = auth(SHOP_GUARD)->user();

        $repository->updatePassword($user, $request->get('password'));

        return $this->redirect('account.settings.security')
            ->with('message', 'Ваш пароль был успешно изменен');
    }
}
