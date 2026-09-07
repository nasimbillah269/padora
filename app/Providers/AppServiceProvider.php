<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        // general() queries the `generals` table. Service providers boot on
        // every request/command — including `php artisan migrate` on a brand
        // new database, before that table exists (or before it's been
        // seeded) — so guard against both cases.
        try {
            if (!Schema::hasTable('generals') || !general()) {
                return;
            }
        } catch (\Throwable $e) {
            return;
        }

        \Config::set("services.facebook.client_id", general()->fb_app_id);
        \Config::set("services.facebook.client_secret", general()->fb_app_secret);
        \Config::set("services.facebook.redirect", general()->fb_app_secret);

        \Config::set("services.google.client_id", general()->google_client_id);
        \Config::set("services.google.client_secret", general()->google_client_secret);
        \Config::set("services.google.redirect", general()->google_client_redirect_url);
        
        \Config::set("mail.mailers.smtp.transport", general()->mail_driver);
        \Config::set("mail.mailers.smtp.host", general()->mail_host);
        \Config::set("mail.mailers.smtp.port", general()->mail_port);
        \Config::set("mail.mailers.smtp.encryption", general()->mail_encryption);
        \Config::set("mail.mailers.smtp.username", general()->mail_username);
        \Config::set("mail.mailers.smtp.password", general()->mail_password);
    }
}
