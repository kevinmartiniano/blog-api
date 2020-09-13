<?php

namespace App\Providers;

use App\Model\Comment;
use App\Model\Contact;
use App\Model\Like;
use App\Model\Post;
use App\Model\User;

use App\Policies\CommentPolicy;
use App\Policies\ContactPolicy;
use App\Policies\LikePolicy;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;

use Laravel\Passport\Passport;
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
        'App\Model' => 'App\Policies\ModelPolicy',
        Comment::class => CommentPolicy::class,
        Contact::class => ContactPolicy::class,
        Like::class => LikePolicy::class,
        Post::class => PostPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
