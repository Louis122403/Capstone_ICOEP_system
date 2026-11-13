<?php

namespace App\Http\Middleware;

use App\Services\DatabaseBackupService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AutoBackup
{
    public function handle(Request $request, Closure $next): Response
    {
        // Process the request first (don't block the user)
        $response = $next($request);

        // Trigger for any authenticated user on regular GET page views
        if (
            $request->isMethod('GET') &&
            !$request->ajax() &&
            !$request->expectsJson() &&
            Auth::check()
        ) {
            try {
                $backupService = app(DatabaseBackupService::class);

                if ($backupService->isAutoBackupEnabled() && !$backupService->hasBackupToday()) {
                    // Run backup in the background after sending response
                    app()->terminating(function () use ($backupService) {
                        try {
                            $backup = $backupService->runAutoBackup();
                            if ($backup) {
                                Log::info('Auto-backup completed: ' . $backup['filename'] . ' (' . $backup['size'] . ')');
                            }
                        } catch (\Throwable $e) {
                            Log::error('Auto-backup failed: ' . $e->getMessage());
                        }
                    });
                }
            } catch (\Throwable $e) {
                // Never block user access if backup check fails
                Log::error('Auto-backup check error: ' . $e->getMessage());
            }
        }

        return $response;
    }
}
