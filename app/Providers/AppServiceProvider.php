<?php

namespace App\Providers;

use App\Department;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
// share
use \App\User;
use \App\Document;
use App\Folder;
use App\Subsidiary;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // requests number
        $numReq = count(User::where('status', false)->get());
        View::share('requests', $numReq);

        $users_count = count(User::all());
        View::share('users_count', $users_count);

        $dept_count = count(Department::all());
        View::share('dept_count', $dept_count);

        $docs_count = count(Document::all());
        View::share('docs_count', $docs_count);

        $folders_count = count(Folder::all());
        View::share('folders_count', $folders_count);

        $subs_count = count(Subsidiary::all());
        View::share('subs_count', $subs_count);

        // trash noti
        $trash = count(Document::where('isExpire', 2)->get());
        View::share('trashfull', $trash);


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
