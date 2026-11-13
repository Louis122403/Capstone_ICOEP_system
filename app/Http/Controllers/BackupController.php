<?php

namespace App\Http\Controllers;

use App\Services\DatabaseBackupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BackupController extends Controller
{
    public function __construct(
        protected DatabaseBackupService $backupService
    ) {}

    /**
     * List existing backup files (JSON API).
     */
    public function index()
    {
        $this->authorise();

        return response()->json([
            'success' => true,
            'backups' => $this->backupService->getBackups(),
        ]);
    }

    /**
     * Create a new database backup.
     */
    public function create(Request $request)
    {
        $this->authorise();

        try {
            $backup = $this->backupService->createBackup();
            return back()->with('backup_success', "Backup created successfully: {$backup['filename']} ({$backup['size']})");
        } catch (\Throwable $e) {
            return back()->with('backup_error', 'Backup failed: ' . $e->getMessage());
        }
    }

    /**
     * Download a backup file.
     */
    public function download(string $filename): BinaryFileResponse
    {
        $this->authorise();

        $filePath = $this->backupService->getBackupPath($filename);

        if (!$filePath) {
            abort(404, 'Backup file not found.');
        }

        return response()->download($filePath, $filename, [
            'Content-Type'        => 'application/sql',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Delete a backup file.
     */
    public function destroy(string $filename)
    {
        $this->authorise();

        if ($this->backupService->deleteBackup($filename)) {
            return back()->with('backup_success', "Backup '{$filename}' deleted successfully.");
        }

        return back()->with('backup_error', 'Backup file not found or could not be deleted.');
    }

    /**
     * Toggle automated backup on/off.
     */
    public function toggleAuto(Request $request)
    {
        $this->authorise();

        $enabled = $request->boolean('enabled');
        $this->backupService->toggleAutoBackup($enabled);

        $status = $enabled ? 'enabled' : 'disabled';
        return back()->with('backup_success', "Automated daily backup has been {$status}.");
    }

    /**
     * Check that the current user is an Administrator.
     */
    protected function authorise(): void
    {
        if (!Auth::user()->hasRole('Administrator')) {
            abort(403, 'Only administrators can manage backups.');
        }
    }
}
