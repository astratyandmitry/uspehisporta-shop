<?php

namespace App;

class Application extends \Illuminate\Foundation\Application
{
    /**
     * @inheritdoc
     */
    public function path($path = ''): string
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'src/App'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

