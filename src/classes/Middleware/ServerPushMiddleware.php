<?php

namespace Ramsey\App\Middleware;

class ServerPushMiddleware
{
    /**
     * The assets to specify for HTTP/2 server push
     *
     * @var array
     */
    private $assets = [];

    /**
     * Sets up the server push middleware with an array of assets to be
     * used in HTTP/2 server push
     *
     * @param array $assets An array of keys and values where the key is the
     *                      asset URI and the value is its Link "as" type.
     *
     * @link https://w3c.github.io/preload/
     */
    public function __construct(array $assets)
    {
        $this->assets = $assets;
    }

    /**
     * Add HTTP Link headers for static assets to invoke server push in HTTP/2
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        foreach ($this->assets as $asset => $type) {
            $response = $response->withAddedHeader(
                'Link',
                "<{$asset}>; rel=preload; as={$type}"
            );
        }

        return $next($request, $response);
    }
}