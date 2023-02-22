<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View {
        $this->setup(PAGE_HOME);

        $this->layout->setTitle()->hideTitle()->hideBreadcrumbs();

        return $this->view('home.index', [
            'testimonials' => Testimonial::query()->inRandomOrder()->limit(8)->get(),
        ]);
    }
}
