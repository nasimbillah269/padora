<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSeeder extends Seeder
{
    /**
     * Seed the single `generals` settings row. The whole app (helpers,
     * service providers, every view) calls general() and assumes a row
     * exists, so this is required for the site to boot on a fresh install.
     *
     * Only non-secret operational settings are copied from the project's
     * real configuration. Credentials (SMTP, SMS gateway, Facebook/Google
     * OAuth app secrets) are intentionally left blank — set those from
     * Admin Panel -> App Setting after install, never commit them here.
     */
    public function run(): void
    {
        DB::table('generals')->updateOrInsert(
            ['id' => 1],
            [
                'title' => 'Pandora',
                'subtitle' => 'Premium Quality Fashion Cloth',
                'about' => null,
                'website' => 'https://pandorand.com/',
                'logo' => 'medies/noimage.jpg',
                'favicon' => 'medies/noimage.jpg',
                'mobile' => '01313610173',
                'email' => 'info@gmail.com',
                'address_one' => 'Dhaka',
                'address_two' => null,
                'postal_address' => null,
                'postal_code' => null,
                'city' => null,
                'state' => null,
                'division' => null,
                'country' => null,
                'commingsoon_mode' => 0,
                'notification_status' => 0,
                'fb_pageId' => null,
                'meta_keyword' => 'Pandora',
                'meta_description' => 'Pandora',
                'meta_author' => 'Pandora',
                'meta_title' => 'Pandora',
                'script_head' => null,
                'script_body' => null,
                'custom_css' => null,
                'custom_js' => null,
                'copyright_text' => 'Welcome to Pandora Fashion!',

                'inside_dhaka_shipping_charge' => 100,
                'outside_metro_charge' => 120,
                'outside_metro_area' => '627,628,593,594,597,596,872,623',
                'outside_dhaka_shipping_charge' => 450,
                'minimum_shopping' => 0,

                // Mail — off by default, no credentials committed
                'mail_driver' => 'smtp',
                'mail_host' => null,
                'mail_port' => '465',
                'mail_username' => null,
                'mail_password' => null,
                'mail_encryption' => 'ssl',
                'mail_from_name' => null,
                'mail_from_address' => null,
                'mail_status' => 0,

                // SMS — off by default, no credentials committed
                'sms_username' => null,
                'sms_password' => null,
                'sms_senderid' => 'setme',
                'sms_url_masking' => 'setme',
                'sms_url_nonmasking' => null,
                'sms_type' => 'smtp',
                'sms_status' => 0,
                'admin_numbers' => null,

                // Social login / OAuth — off by default, no secrets committed
                'fb_app_id' => '#',
                'fb_app_secret' => null,
                'fb_app_redirect_url' => '#',
                'tw_app_id' => '#',
                'tw_app_secret' => null,
                'tw_app_redirect_url' => '#',
                'google_client_id' => '#',
                'google_client_secret' => null,
                'google_client_redirect_url' => '#',

                'facebook_link' => '#',
                'twitter_link' => '#',
                'instagram_link' => '#',
                'linkedin_link' => '#',
                'pinterest_link' => '#',
                'youtube_link' => '#',

                'shipping_charge_type' => 5,
                'defult_shipping_charge' => 0,
                'product_discount' => 0,
                'tax' => 0,
                'tax_status' => 1,
                'currency' => '৳',
                'currency_decimal' => 1,
                'currency_position' => 1,
                'seller_product_verify' => 1,
                'coupon_apply' => 1,
                'slider' => 1,

                'cus_reg_sms_customer' => 1,
                'cus_reg_sms_admin' => 1,
                'vendor_reg_sms_vendor' => 1,
                'vendor_reg_sms_admin' => 1,
                'order_place_sms_customer' => 1,
                'order_place_sms_vendor' => 1,
                'order_place_sms_admin' => 1,
                'order_status_sms_customer' => 1,
                'order_status_sms_vendor' => 1,
                'order_status_sms_admin' => 1,
                'order_payment_sms_customer' => 1,
                'order_payment_sms_admin' => 1,
                'Vendor_payment_sms_vendor' => 1,
                'Vendor_payment_sms_admin' => 1,
                'cus_recharge_sms_customer' => 1,
                'cus_recharge_sms_admin' => 1,

                'theme' => 'welcome',
                'adminTheme' => 'admin',
                'admin_mails' => null,
                'register_mail_user' => 0,
                'register_mail_author' => 0,
                'forget_password_mail_user' => 0,
                'register_verify_mail_user' => 0,
                'balance' => 0,

                'updated_at' => now(),
            ]
        );
    }
}
