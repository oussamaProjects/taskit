<?php

namespace App\Providers;

use App\Category;
use App\Client;
use App\Department;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
// share
use \App\User;
use \App\Document;
use App\Folder;
use App\Group;
use App\Project;
use App\Subsidiary;
use App\Task;
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

        // \Validator::extend('email_domain', function ($attribute, $value, $parameters, $validator) {
        //     $allowedEmailDomains = ['tawzerholding.com', 'geniworks.com', 'vandyser.com', 'vigi-protect.com', 'vigipros.com', 'technicordes.com','geniloyds.com','clickclack360.com','alwassite.com'];
        //     return in_array(explode('@', $parameters[0])[1], $allowedEmailDomains);
        // });

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

        $Clients_count = count(Client::all());
        View::share('Clients_count', $Clients_count);

        $projects_count = count(Project::all());
        View::share('projects_count', $projects_count);

        $groups_count = count(Group::all());
        View::share('groups_count', $groups_count);

        $tasks_count = count(Task::all());
        View::share('tasks_count', $tasks_count);
       
        $category_count=count( Category::all());
        View::share('category_count', $category_count);

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
