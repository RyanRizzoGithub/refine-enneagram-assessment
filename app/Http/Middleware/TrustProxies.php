<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * Railway (and any PaaS) serves the app behind a reverse proxy that
     * terminates TLS and forwards over HTTP with X-Forwarded-Proto. Trust it
     * so Laravel detects HTTPS and generates https:// URLs / secure cookies —
     * otherwise forms post to http:// and logins loop.
     *
     * @var array|string
     */
    protected $proxies = '*';

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
