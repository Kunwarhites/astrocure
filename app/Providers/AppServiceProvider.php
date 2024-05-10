<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Feedback;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $feedbackData = Feedback::latest()->take(4)->get();
            $totalFeedbackCount = $feedbackData->count();
            $view->with('totalFeedbackCount', $totalFeedbackCount);
            $view->with('feedbackData', $feedbackData);

            if (session()->has('loggedInUser')) {
                // Session variable 'loggedInUser' exists
                $userinfo = DB::table('users')
                    ->where('id', session('loggedInUser'))
                    ->first();
                $view->with('userinfo', $userinfo);

                // You might want to do something with the $userinfo variable here
            }
            // Add an else block if needed
        });
    }

}
