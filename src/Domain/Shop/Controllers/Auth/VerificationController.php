<?php

namespace Domain\Shop\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Domain\Shop\Controllers\Controller;
use Domain\Shop\Repositories\VerificationRepository;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class VerificationController extends Controller
{
    /**
     * @param string $email
     * @param string $code
     * @param \Domain\Shop\Repositories\VerificationRepository $repository
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function __invoke(string $email, string $code, VerificationRepository $repository): RedirectResponse
    {
        if ($verification = $repository->findByCode($code)) {
            if ($verification->user->email === $email) {
                if (! $verification->custom()) {
                    $verification->handle();
                }

                return $verification->redirect();
            }
        }

        return $this->view('home');
    }
}
