<?php

namespace Domain\Shop\Controllers\Auth;

use Domain\Shop\Repositories\BasketRepository;
use Domain\Shop\Repositories\UsersRepository;
use Domain\Shop\Requests\Auth\LoginRequest;
use Domain\Shop\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Domain\Shop\Models\Page;
use Illuminate\View\View;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class LoginController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function form(): View
    {
        $this->setup(PAGE_AUTH_LOGIN)
            ->hideBreadcrumbs()
            ->hideTitle();

        return $this->view('auth.login');
    }

    /**
     * @param \Domain\Shop\Requests\Auth\LoginRequest $request
     * @param \Domain\Shop\Repositories\UsersRepository $usersRepository
     * @param \Domain\Shop\Repositories\BasketRepository $basketRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(
        LoginRequest $request,
        UsersRepository $usersRepository,
        BasketRepository $basketRepository
    ): RedirectResponse {
        /** @var \Domain\Shop\Models\User $user */
        if ($user = $usersRepository->findByEmail($request->email)) {
            if ($user->activated() && Hash::check($request->password, $user->password)) {
                if (Auth::guard(SHOP_GUARD)->attempt($request->validated())) {
                    $basketRepository->migrateFromGuest($user->id);

                    $redirect = session()->has('auth.redirect')
                        ? redirect()->to(session()->get('auth.redirect'))
                        : $this->redirect('account.redirect');

                    session()->forget('auth.redirect');

                    return $redirect;
                }
            }
        }

        return redirect()->back()->withErrors([
            'email' => 'Вы указали неверное сочитаение e-mail и пароля',
        ])->withInput(['email' => $request->email]);
    }
}
