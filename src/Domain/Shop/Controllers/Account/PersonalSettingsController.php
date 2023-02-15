<?php

namespace Domain\Shop\Controllers\Account;

use Domain\Shop\Controllers\Controller;
use Domain\Shop\Models\Page;
use Domain\Shop\Repositories\UsersRepository;
use Domain\Shop\Requests\Account\PersonalSettingsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PersonalSettingsController extends Controller
{
    public function form(): View
    {
        $this->layout->addBreadcrumb('Личный кабинет', route('shop::account.redirect'));
        $this->setup(PAGE_ACCOUNT_SETTINGS_PERSONAL);

        return $this->view('account.settings.personal', [
            'entity' => auth(SHOP_GUARD)->user(),
        ]);
    }

    public function process(PersonalSettingsRequest $request, UsersRepository $repository): RedirectResponse
    {
        /** @var \Domain\Shop\Models\User $user */
        $user = auth(SHOP_GUARD)->user();

        $repository->updatePersonalInformation($user, $request);

        return $this->redirect('account.settings.personal')
            ->with('message', 'Настройки аккаунта были успешно сохранены');
    }
}
