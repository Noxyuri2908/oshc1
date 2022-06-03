<?php

namespace App\Providers;

use App\Admin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        //STAFF


        Gate::after(function (Admin $user, $ability) {
            return $user->getAllPermissions()->where('name',$ability)->count() > 0;
        });
//        Gate::define('view-staff', function ($user) {
//            return in_array('28', $user->authorization) || $user->role == 1 || in_array('0', $user->authorization);
//        });
//        Gate::define('edit-staff', function ($user) {
//            return in_array('26', $user->authorization) || $user->role == 1 || in_array('0', $user->authorization);
//        });
//        Gate::define('create-staff', function ($user) {
//            return in_array('25', $user->authorization) || $user->role == 1 || in_array('0', $user->authorization);
//        });
//
//        //AGENT
//        Gate::define('view-agent', function ($user) {
//            return in_array('4', $user->authorization) || $user->role == 1 || in_array('0', $user->authorization);
//        });
//        Gate::define('edit-agent', function ($user) {
//            return (in_array('2', $user->authorization) &&
//                        in_array('4', $user->authorization) &&
//                        in_array('1', $user->authorization) &&
//                        ($user->id == $post->staff_id || in_array($user->id, $posr->array_shares))
//                    ) ||
//                    $user->role == 1 ||
//                    in_array('0', $user->authorization);
//        });
//        Gate::define('create-agent', function ($user) {
//            return in_array('1', $user->authorization) || $user->role == 1 || in_array('0', $user->authorization);
//        });
//        Gate::define('assign-agent', function ($user) {
//            return in_array('29', $user->authorization) || $user->role == 1 || in_array('0', $user->authorization);
//        });
//        Gate::define('share-agent', function ($user, $post) {
//            return (in_array('2', $user->authorization) && in_array('4', $user->authorization) && in_array('1', $user->authorization) && $user->id == $post->staff_id) || $user->role == 1 || in_array('0', $user->authorization);
//        });
    }
}
