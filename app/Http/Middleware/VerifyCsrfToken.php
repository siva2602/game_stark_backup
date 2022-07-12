<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
      '/apps/action',
      '/game/action',
      '/quiz/action',
      '/payment-options/action',
      '/videos/action',
      '/websites/action',
      '/banner/action',
      '/faq/action',
      '/request/action',
      '/transaction/action',
      '/transaction/transactionbydate',
      '/coinstore/action',
      '/offerwall/action',
      'appinfo',
    ];
}
