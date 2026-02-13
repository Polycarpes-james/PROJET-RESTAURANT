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
        '/rettine/panier/ajouter',
        '/rettine/panier/modifier',
        '/rettine/panier/supprimer',
        '/rettine/panier/commander',
        '/invite/panier/ajouter',
        '/invite/panier/modifier',
        '/invite/panier/supprimer',
        '/invite/session',
    ];
}
