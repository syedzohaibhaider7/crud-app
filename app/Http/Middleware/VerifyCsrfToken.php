<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/', '/login', '/register', '/user/dashboard', '/admin/dashboard', '/admin/database', '/admin/add', '/forgot_password', '/admin/edit/*', '/register/duplicate', '/admin/add/duplicate', '/admin/edit/*/duplicate',
    ];
}
