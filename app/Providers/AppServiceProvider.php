<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Support\Facades\View::composer('pages.dashboard.navbar', function ($view) {
            if (\Illuminate\Support\Facades\Auth::check()) {
                $user = \Illuminate\Support\Facades\Auth::user();
                $notifications = collect();

                if ($user->is_admin || $user->is_dekan || $user->is_wakil_dekan_I) {
                    // For management: show incoming letters that need action
                    $notifications = \App\Models\Surat::with('user')
                        ->whereIn('status', ['proses', 'validasi'])
                        ->orderBy('updated_at', 'desc')
                        ->take(5)
                        ->get();
                } else {
                    // For students: show their letters matching specific status updates
                    $notifications = \App\Models\Surat::with('user')
                        ->where('user_id', $user->id)
                        ->whereIn('status', ['validasi', 'disetujui', 'ditolak'])
                        ->orderBy('updated_at', 'desc')
                        ->take(5)
                        ->get();
                }

                $view->with('navbarNotifications', $notifications);
                $view->with('unreadCount', $notifications->count());
            }
        });
    }
}
