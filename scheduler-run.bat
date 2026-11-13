@echo off
REM ═══════════════════════════════════════════════════════════════
REM  ICOEP System - Laravel Scheduler Runner
REM  
REM  This batch file triggers Laravel's task scheduler.
REM  Set it up in Windows Task Scheduler to run every minute:
REM
REM  1. Open Task Scheduler (taskschd.msc)
REM  2. Click "Create Basic Task..."
REM  3. Name: "ICOEP Laravel Scheduler"
REM  4. Trigger: Daily, start at 12:00 AM, repeat every 1 minute
REM  5. Action: Start a Program
REM     - Program: C:\xampp\htdocs\ICOEP_system\scheduler-run.bat
REM  6. Check "Run whether user is logged on or not"
REM
REM  OR simply run once daily at 3:00 AM for just the backup:
REM  Program: C:\xampp\php\php.exe
REM  Arguments: artisan db:backup --rotate
REM  Start in: C:\xampp\htdocs\ICOEP_system
REM ═══════════════════════════════════════════════════════════════

cd /d "C:\xampp\htdocs\ICOEP_system"
"C:\xampp\php\php.exe" artisan schedule:run >> "storage\logs\scheduler.log" 2>&1

