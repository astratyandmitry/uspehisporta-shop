<?php

namespace Domain\CMS\Controllers\Auth;

use Domain\CMS\Controllers\Controller;
use Domain\CMS\Models\Manager;
use Domain\CMS\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        return view('cms::auth.login', $this->getData());
    }

    /**
     * @param \Domain\CMS\Requests\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(LoginRequest $request): RedirectResponse
    {
        /** @var \Domain\CMS\Models\Manager $manager */
        if ($manager = Manager::query()->where('email', $request->get('email'))->first()) {
            if (Hash::check($request->get('password'), $manager->password)) {
                Auth::guard('cms')->attempt($request->only(['email', 'password']), $request->boolean('remember'));
            }
        }

        return redirect()->back()
            ->withInput($request->only(['email']))
            ->withErrors(['email' => 'Вы указали неверное сочитание e-mail и пароля']);
    }
}
