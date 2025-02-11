<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\TourGuide;
use App\Models\Blog;
use App\Models\Comment;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin',function(User $user){
                return $user->role==='admin';
        });
        Gate::define('isUser',function(User $user){
                return $user->role==='user';
        });
        Gate::define('isOwner',function(User $user){
                return $user->role==='owner';
        });
        Gate::define('policesAccepted',function(User $user){
                return  $user->accept_policies;
        });
        Gate::define('isTourGuide',function(User $user){
                return  $user->role === 'tourGuide' ;
        });
        Gate::define('TourGuideAccepted',function(User $user ,TourGuide $tourGuide){
                return  $tourGuide->accepted  ;
        });

        Gate::define('OwnBlog',function (User $user, Blog $blog) {
                return $user->tourGuide->id === $blog->tour_guide_id;
            });
        Gate::define('OwnComment',function (User $user, Comment $comment) {
                return $user->id === $comment->user_id;
            });
    }
}
