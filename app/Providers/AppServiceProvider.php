<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Builder::macro('whereLike', function(string $attribute, string $searchTerm) {
            return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        });
        Builder::macro('whereIsLike', function(string $attribute, string $searchTerm) {
            return $this->where($attribute, 'LIKE', "%{$searchTerm}%");
        });
        config()->set('payment.drivers.zarinpal.merchantId',option('payment_merchant') ?? '');
        config()->set('payment.drivers.zarinpal.callbackUrl',url('/user/api/payment/verification'));
        config()->set('services.google.client_id',option('google_client_id') ?? env('GOOGLE_CLIENT_ID'));
        config()->set('services.google.client_secret',option('google_client_secret') ?? env('GOOGLE_CLIENT_SECRET'));
        config()->set('services.google.redirect',url('/login/google/callback'));
    }
}
