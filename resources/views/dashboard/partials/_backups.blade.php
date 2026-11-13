@php
    $user = auth()->user();
    $isAdmin = $user->hasRole('Administrator');

    // Get backup files
    $backupDir = storage_path('app/backups');
    $backupFiles = [];
    if (is_dir($backupDir)) {
        foreach (scandir($backupDir) as $file) {
            if ($file === '.' || $file === '..') continue;
            if (!preg_match('/\.(sql|sql\.gz)$/i', $file)) continue;
            $path = $backupDir . DIRECTORY_SEPARATOR . $file;
            $backupFiles[] = [
                'filename'   => $file,
                'size'       => formatBackupSize(filesize($path)),
                'size_bytes' => filesize($path),
                'created_at' => date('M d, Y h:i A', filemtime($path)),
                'timestamp'  => filemtime($path),
            ];
        }
        usort($backupFiles, fn($a, $b) => $b['timestamp'] <=> $a['timestamp']);
    }

    function formatBackupSize(int $bytes): string {
        if ($bytes === 0) return '0 B';
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = floor(log($bytes, 1024));
        return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
    }

    $dbHost = config('database.connections.mysql.host');
    $dbName = config('database.connections.mysql.database');
    $isRemote = !in_array($dbHost, ['127.0.0.1', 'localhost', '::1']);
    $backupSettings = app(\App\Services\DatabaseBackupService::class)->getSettings();
    $autoBackupEnabled = $backupSettings['auto_backup_enabled'] ?? true;
    $lastAutoBackupDate = $backupSettings['last_auto_backup_date'] ?? null;
@endphp

<div class="content-card">
    {{-- Header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:24px;">
        <div>
            <h1 class="backup-title" style="font-size:1.5rem; font-weight:700; color:#1e293b; margin:0;">Data Backup</h1>
            <p class="backup-subtitle" style="color:#64748b; font-size:0.875rem; margin:4px 0 0;">Create, download, and manage database backups for disaster recovery</p>
        </div>
        <form method="POST" action="{{ url('/backups') }}" id="createBackupForm">
            @csrf
            <button type="submit" class="btn btn-primary" id="createBackupBtn" style="display:inline-flex; align-items:center; gap:8px; padding:10px 20px; font-weight:600;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Create New Backup
            </button>
        </form>
    </div>

    {{-- Flash Messages --}}
    @if(session('backup_success'))
    <div style="background:#ecfdf5; border:1px solid #a7f3d0; border-radius:8px; padding:12px 16px; margin-bottom:20px; display:flex; align-items:center; gap:10px; color:#065f46;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <span style="font-size:0.875rem; font-weight:500;">{{ session('backup_success') }}</span>
    </div>
    @endif

    @if(session('backup_error'))
    <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:12px 16px; margin-bottom:20px; display:flex; align-items:center; gap:10px; color:#991b1b;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="15" y1="9" x2="9" y2="15"></line>
            <line x1="9" y1="9" x2="15" y2="15"></line>
        </svg>
        <span style="font-size:0.875rem; font-weight:500;">{{ session('backup_error') }}</span>
    </div>
    @endif

    {{-- Database Info Card --}}
    <div class="backup-db-card" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px; margin-bottom:24px;">
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
            </svg>
            <span class="backup-db-title" style="font-weight:600; color:#334155; font-size:0.95rem;">Database Information</span>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:12px;">
            <div>
                <span class="backup-label" style="font-size:0.75rem; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em;">Host</span>
                <p class="backup-value" style="margin:2px 0 0; font-size:0.875rem; color:#334155; font-weight:500;">{{ $dbHost }}</p>
            </div>
            <div>
                <span class="backup-label" style="font-size:0.75rem; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em;">Database</span>
                <p class="backup-value" style="margin:2px 0 0; font-size:0.875rem; color:#334155; font-weight:500;">{{ $dbName }}</p>
            </div>
            <div>
                <span class="backup-label" style="font-size:0.75rem; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em;">Connection</span>
                <p class="backup-value" style="margin:2px 0 0; font-size:0.875rem; font-weight:500;">
                    @if($isRemote)
                        <span style="display:inline-flex; align-items:center; gap:4px; color:#0369a1;">
                            <span style="width:8px; height:8px; background:#0ea5e9; border-radius:50%; display:inline-block;"></span>
                            Cloud (Aiven)
                        </span>
                    @else
                        <span style="display:inline-flex; align-items:center; gap:4px; color:#16a34a;">
                            <span style="width:8px; height:8px; background:#22c55e; border-radius:50%; display:inline-block;"></span>
                            Local
                        </span>
                    @endif
                </p>
            </div>
            <div>
                <span class="backup-label" style="font-size:0.75rem; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em;">Total Backups</span>
                <p class="backup-value" style="margin:2px 0 0; font-size:0.875rem; color:#334155; font-weight:500;">{{ count($backupFiles) }}</p>
            </div>
        </div>
    </div>

    {{-- Backups Table --}}
    @if(count($backupFiles) > 0)
    <div class="table-responsive backup-table-responsive" style="border:1px solid #e2e8f0; border-radius:10px; overflow:hidden;">
        <table class="table backup-table" style="margin:0; width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f1f5f9;">
                    <th style="padding:12px 16px; text-align:left; font-size:0.75rem; font-weight:600; color:#475569; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #e2e8f0;">Filename</th>
                    <th style="padding:12px 16px; text-align:left; font-size:0.75rem; font-weight:600; color:#475569; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #e2e8f0;">Size</th>
                    <th style="padding:12px 16px; text-align:left; font-size:0.75rem; font-weight:600; color:#475569; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #e2e8f0;">Created</th>
                    <th style="padding:12px 16px; text-align:right; font-size:0.75rem; font-weight:600; color:#475569; text-transform:uppercase; letter-spacing:0.05em; border-bottom:1px solid #e2e8f0;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($backupFiles as $backup)
                <tr class="backup-tr" style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:12px 16px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div class="backup-fileicon" style="width:36px; height:36px; background:#eff6ff; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                </svg>
                            </div>
                            <span class="backup-filename" style="font-size:0.875rem; font-weight:500; color:#1e293b; word-break:break-all;">{{ $backup['filename'] }}</span>
                        </div>
                    </td>
                    <td style="padding:12px 16px;">
                        <span class="backup-meta" style="font-size:0.875rem; color:#64748b; font-weight:500;">{{ $backup['size'] }}</span>
                    </td>
                    <td style="padding:12px 16px;">
                        <span class="backup-meta" style="font-size:0.875rem; color:#64748b;">{{ $backup['created_at'] }}</span>
                    </td>
                    <td style="padding:12px 16px; text-align:right;">
                        <div style="display:flex; align-items:center; justify-content:flex-end; gap:8px;">
                            <a href="{{ url('/backups/' . $backup['filename'] . '/download') }}"
                               class="btn btn-sm"
                               style="display:inline-flex; align-items:center; gap:4px; padding:6px 12px; font-size:0.8rem; background:#eff6ff; color:#2563eb; border:1px solid #bfdbfe; border-radius:6px; text-decoration:none; font-weight:500;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download
                            </a>
                            <form method="POST" action="{{ url('/backups/' . $backup['filename']) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this backup?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm"
                                        style="display:inline-flex; align-items:center; gap:4px; padding:6px 12px; font-size:0.8rem; background:#fef2f2; color:#dc2626; border:1px solid #fecaca; border-radius:6px; font-weight:500; cursor:pointer;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    {{-- Empty State --}}
    <div class="backup-empty-state" style="text-align:center; padding:48px 20px; background:#f8fafc; border:2px dashed #e2e8f0; border-radius:12px;">
        <div style="width:64px; height:64px; background:#eff6ff; border-radius:16px; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
            </svg>
        </div>
        <h3 class="backup-empty-title" style="font-size:1.1rem; font-weight:600; color:#334155; margin:0 0 8px;">No Backups Yet</h3>
        <p class="backup-empty-desc" style="color:#64748b; font-size:0.875rem; margin:0 0 20px; max-width:400px; margin-left:auto; margin-right:auto;">
            Create your first database backup to protect your data against unexpected events like power outages or network interruptions.
        </p>
        <form method="POST" action="{{ url('/backups') }}">
            @csrf
            <button type="submit" class="btn btn-primary" style="display:inline-flex; align-items:center; gap:8px; padding:10px 24px; font-weight:600;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Create First Backup
            </button>
        </form>
    </div>
    @endif

    {{-- Automated Backup Info --}}
    <div class="backup-auto-box {{ $autoBackupEnabled ? 'active' : 'inactive' }}" style="margin-top:20px; background:{{ $autoBackupEnabled ? '#eff6ff' : '#f8fafc' }}; border:1px solid {{ $autoBackupEnabled ? '#bfdbfe' : '#e2e8f0' }}; border-radius:10px; padding:16px 20px;">
        <div style="display:flex; align-items:flex-start; gap:12px;">
            <div style="width:40px; height:40px; background:{{ $autoBackupEnabled ? '#dbeafe' : '#f1f5f9' }}; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="{{ $autoBackupEnabled ? '#2563eb' : '#94a3b8' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
            <div style="flex:1;">
                <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px; margin-bottom:4px;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span class="{{ $autoBackupEnabled ? 'backup-auto-title-active' : 'backup-auto-title-inactive' }}" style="font-size:0.925rem; font-weight:700; color:{{ $autoBackupEnabled ? '#1e40af' : '#64748b' }};">Automated Daily Backup</span>
                        <span style="font-size:0.7rem; font-weight:600; background:{{ $autoBackupEnabled ? '#dcfce7' : '#fee2e2' }}; color:{{ $autoBackupEnabled ? '#166534' : '#991b1b' }}; padding:2px 8px; border-radius:9999px;">
                            {{ $autoBackupEnabled ? 'Active' : 'Disabled' }}
                        </span>
                    </div>
                    <form method="POST" action="{{ url('/backups/auto-toggle') }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="enabled" value="{{ $autoBackupEnabled ? '0' : '1' }}">
                        <button type="submit" class="btn btn-sm" style="display:inline-flex; align-items:center; gap:6px; padding:6px 14px; font-size:0.8rem; font-weight:600; border-radius:6px; cursor:pointer; {{ $autoBackupEnabled ? 'background:#fef2f2; color:#dc2626; border:1px solid #fecaca;' : 'background:#ecfdf5; color:#059669; border:1px solid #a7f3d0;' }}">
                            @if($autoBackupEnabled)
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="6" y="4" width="4" height="16"></rect>
                                    <rect x="14" y="4" width="4" height="16"></rect>
                                </svg>
                                Turn Off
                            @else
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                                Turn On
                            @endif
                        </button>
                    </form>
                </div>
                <p class="{{ $autoBackupEnabled ? 'backup-auto-desc-active' : 'backup-auto-desc-inactive' }}" style="font-size:0.82rem; color:{{ $autoBackupEnabled ? '#3b82f6' : '#94a3b8' }}; line-height:1.5; margin:0;">
                    @if($autoBackupEnabled)
                        The system automatically creates a database backup once per day when the system is accessed.
                        Each auto-backup replaces the previous one so only the latest backup is kept, preventing storage buildup.
                        @if($lastAutoBackupDate)
                            <br><strong>Last auto-backup:</strong> {{ \Carbon\Carbon::parse($lastAutoBackupDate)->format('M d, Y') }}
                        @endif
                    @else
                        Automated backup is currently disabled. The system will not create automatic backups. You can still create manual backups using the button above.
                    @endif
                </p>
            </div>
        </div>
    </div>

    {{-- Info Note --}}
    <div class="backup-warning-box" style="margin-top:12px; background:#fffbeb; border:1px solid #fde68a; border-radius:8px; padding:12px 16px; display:flex; align-items:flex-start; gap:10px;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; margin-top:1px;">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        <div class="backup-warning-text" style="font-size:0.8rem; color:#92400e; line-height:1.5;">
            <strong>Important:</strong> Backups are stored locally in the server's storage directory.
            Download backup files to a separate device or cloud storage for maximum protection.
            @if($isRemote)
            <br>Your database is hosted remotely. An active internet connection is required to create a backup.
            @endif
        </div>
    </div>
</div>

{{-- Loading overlay for backup creation --}}
<style>
    .backup-loading-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(15, 23, 42, 0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    .backup-loading-overlay.active { display: flex; }
    .backup-loading-box {
        background: white;
        border-radius: 16px;
        padding: 32px 40px;
        text-align: center;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
        max-width: 360px;
    }
    .backup-spinner {
        width: 48px; height: 48px;
        border: 4px solid #e2e8f0;
        border-top-color: #3b82f6;
        border-radius: 50%;
        animation: backup-spin 0.8s linear infinite;
        margin: 0 auto 16px;
    }
    @keyframes backup-spin {
        to { transform: rotate(360deg); }
    }

    /* Dark mode overrides for Data Backup */
    html.dark .content-card {
        background: #0f172a;
        border-color: rgba(255, 255, 255, 0.08);
    }
    html.dark .backup-title {
        color: #f1f5f9 !important;
    }
    html.dark .backup-subtitle {
        color: #94a3b8 !important;
    }
    html.dark .backup-db-card {
        background: #0b1526 !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    html.dark .backup-db-title {
        color: #f1f5f9 !important;
    }
    html.dark .backup-label {
        color: #94a3b8 !important;
    }
    html.dark .backup-value {
        color: #f1f5f9 !important;
    }
    html.dark .backup-table-responsive {
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    html.dark .backup-table thead tr {
        background: #0b1526 !important;
    }
    html.dark .backup-table th {
        color: #94a3b8 !important;
        border-bottom-color: rgba(255, 255, 255, 0.08) !important;
    }
    html.dark .backup-table td {
        border-bottom-color: rgba(255, 255, 255, 0.06) !important;
    }
    html.dark .backup-filename {
        color: #f1f5f9 !important;
    }
    html.dark .backup-fileicon {
        background: rgba(59, 130, 246, 0.15) !important;
    }
    html.dark .backup-meta {
        color: #94a3b8 !important;
    }
    html.dark .backup-auto-box.active {
        background: rgba(14, 165, 233, 0.08) !important;
        border-color: rgba(14, 165, 233, 0.25) !important;
    }
    html.dark .backup-auto-box.inactive {
        background: #0b1526 !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    html.dark .backup-auto-title-active {
        color: #38bdf8 !important;
    }
    html.dark .backup-auto-title-inactive {
        color: #94a3b8 !important;
    }
    html.dark .backup-auto-desc-active {
        color: #94a3b8 !important;
    }
    html.dark .backup-auto-desc-inactive {
        color: #64748b !important;
    }
    html.dark .backup-warning-box {
        background: rgba(245, 158, 11, 0.08) !important;
        border-color: rgba(245, 158, 11, 0.25) !important;
    }
    html.dark .backup-warning-text {
        color: #fbbf24 !important;
    }
    html.dark .backup-empty-state {
        background: #0b1526 !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
    }
    html.dark .backup-empty-title {
        color: #f1f5f9 !important;
    }
    html.dark .backup-empty-desc {
        color: #94a3b8 !important;
    }
</style>

<div class="backup-loading-overlay" id="backupLoadingOverlay">
    <div class="backup-loading-box">
        <div class="backup-spinner"></div>
        <h3 style="font-size:1.1rem; font-weight:600; color:#1e293b; margin:0 0 8px;">Creating Backup...</h3>
        <p style="color:#64748b; font-size:0.875rem; margin:0;">
            This may take a moment depending on database size.
            <br>Please do not close this page.
        </p>
    </div>
</div>

<script>
    document.querySelectorAll('#createBackupForm, form[action$="/backups"]').forEach(function(form) {
        if (form.querySelector('button[type="submit"]') && !form.querySelector('input[name="_method"]')) {
            form.addEventListener('submit', function() {
                document.getElementById('backupLoadingOverlay').classList.add('active');
            });
        }
    });
</script>

