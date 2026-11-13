@echo off
REM ═══════════════════════════════════════════════════════════════
REM  ICOEP System - Automated Daily Database Backup
REM  
REM  Quick setup in Windows Task Scheduler:
REM
REM  1. Open Task Scheduler (taskschd.msc)
REM  2. Click "Create Basic Task..."
REM  3. Name: "ICOEP Daily Backup"
REM  4. Trigger: Daily, start at 3:00 AM
REM  5. Action: Start a Program
REM     - Program: C:\xampp\htdocs\ICOEP_system\daily-backup.bat
REM  6. Check "Run whether user is logged on or not"
REM ═══════════════════════════════════════════════════════════════

cd /d "C:\xampp\htdocs\ICOEP_system"
echo [%date% %time%] Starting automated backup... >> "storage\logs\database_backup.log"
"C:\xampp\php\php.exe" artisan db:backup --rotate >> "storage\logs\database_backup.log" 2>&1
echo [%date% %time%] Backup task finished. >> "storage\logs\database_backup.log"
echo. >> "storage\logs\database_backup.log"

