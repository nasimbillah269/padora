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
        
        // The admin "Mail Setting" screen stores values loosely (e.g. driver
        // "SMTP", encryption "SSL"). Laravel 10 needs them normalised or the
        // transport factory throws "Unsupported mail transport [SMTP]" and the
        // exception is swallowed by sendMail() — mail silently never goes out.
        $mailDriver     = strtolower(trim(general()->mail_driver ?? '')) ?: 'smtp';
        $mailEncryption = strtolower(trim(general()->mail_encryption ?? ''));
        $mailPort       = (int) (general()->mail_port ?: 0) ?: 587;

        // anything SMTP-ish resolves to the built-in "smtp" mailer
        if (in_array($mailDriver, ['smtp', 'smtps', 'ssl', 'tls', ''], true)) {
            $mailDriver = 'smtp';
        }

        \Config::set("mail.default", $mailDriver);
        \Config::set("mail.mailers.smtp.transport", 'smtp');
        \Config::set("mail.mailers.smtp.host", general()->mail_host);
        \Config::set("mail.mailers.smtp.port", $mailPort);
        \Config::set("mail.mailers.smtp.username", general()->mail_username);
        \Config::set("mail.mailers.smtp.password", general()->mail_password);

        if ($mailEncryption === 'ssl' || $mailPort === 465) {
            // implicit TLS — Laravel only auto-picks this for encryption "tls" + port 465
            \Config::set("mail.mailers.smtp.scheme", 'smtps');
            \Config::set("mail.mailers.smtp.encryption", 'ssl');
        } else {
            \Config::set("mail.mailers.smtp.scheme", null);
            \Config::set("mail.mailers.smtp.encryption", $mailEncryption ?: 'tls');
        }

        if (general()->mail_from_address) {
            \Config::set("mail.from.address", general()->mail_from_address);
            \Config::set("mail.from.name", general()->mail_from_name ?: config('app.name'));
        }
    }
}
