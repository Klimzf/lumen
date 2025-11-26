<?php

namespace App\Providers;

use App\Domains\Note\Interfaces\NoteRepositoryInterface;
use App\Domains\Note\Repositories\EloquentNoteRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            NoteRepositoryInterface::class,
            EloquentNoteRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
