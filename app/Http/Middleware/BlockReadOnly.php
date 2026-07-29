<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockReadOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->isReadOnly()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'error' => 'Akses ditolak: Peran Anda hanya memiliki hak baca (read-only).'
                ], 403);
            }
            return redirect()->back()->with('error', 'Akses ditolak: Akun Anda adalah Read-Only (hanya baca) dan tidak dapat menambah, mengubah, atau menghapus data.');
        }

        return $next($request);
    }
}
