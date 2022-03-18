<?php

namespace App\Providers;

use App\Document;
use App\Folder;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // view()->composer('*', function ($view) {

        //     $favorites_docs = null;
        //     $favorites_folders = null;
        //     $favorites_docs_count = null;
        //     $favorites_folders_count = null;
        //     if (auth()->check()) {

        //         $user = auth()->user();
        //         $favorites_docs = $user->getFavoriteItems(Document::class)->get();
        //         $favorites_folders = $user->getFavoriteItems(Folder::class)->get();
        //         $favorites_docs_count = $user->favorites()->withType(Document::class)->count();
        //         $favorites_folders_count = $user->favorites()->withType(Folder::class)->count();
        //     }
        //     $view->with('favorites_docs', $favorites_docs);
        //     $view->with('favorites_docs_count', $favorites_docs_count);
        //     $view->with('favorites_docs', $favorites_docs);
        //     $view->with('favorites_folders_count', $favorites_folders_count);
        //     $view->with('favorites_folders', $favorites_folders);
        // });
    }
}
