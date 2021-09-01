<?php

namespace App\Providers;

use App\Services\User\UserFile;
use App\Services\User\UserRepository;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;

class FilesystemProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepository::class, UserFile::class);

        $this->app->when( UserFile::class)
            ->needs(Filesystem::class)
            ->give( function () {
               return Storage::disk('local');
            });
    }
}
