<?php

namespace Domain\CMS\Controllers\Auth;

use Domain\CMS\Controllers\Controller;
use Domain\CMS\Models\Manager;
use Domain\CMS\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function form(): View
    {
        return view('cms::auth.login', $this->getData());
    }

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
