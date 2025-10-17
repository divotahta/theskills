<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Handle413Error
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if response is 413 Request Entity Too Large
        if ($response->getStatusCode() === 413) {
            if ($request->isMethod('POST') || $request->isMethod('PUT')) {
                return back()
                    ->withInput()
                    ->with('error', 'File yang diupload terlalu besar. Maksimal 10MB.');
            }
        }

        return $response;
    }
}
