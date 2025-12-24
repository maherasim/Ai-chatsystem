# PowerShell script to enable mbstring PHP extension
# This fixes: Call to undefined function mb_split()

$phpIniPath = "C:\php\php.ini"

Write-Host "Enabling mbstring extension in PHP..." -ForegroundColor Cyan

# Check if php.ini exists
if (-not (Test-Path $phpIniPath)) {
    Write-Host "Error: php.ini not found at $phpIniPath" -ForegroundColor Red
    Write-Host "Please update the path in this script to match your PHP installation." -ForegroundColor Yellow
    exit 1
}

# Check if mbstring is already enabled
$currentContent = Get-Content $phpIniPath -Raw
if ($currentContent -match "(?m)^\s*extension\s*=\s*mbstring") {
    Write-Host "mbstring extension is already enabled!" -ForegroundColor Green
    exit 0
}

# Check if running as Administrator (needed to edit php.ini)
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "Warning: Not running as Administrator. Attempting to edit anyway..." -ForegroundColor Yellow
}

try {
    # Read the file
    $content = Get-Content $phpIniPath
    
    # Replace commented mbstring with enabled version
    $modified = $false
    $newContent = $content | ForEach-Object {
        if ($_ -match "^\s*;extension\s*=\s*mbstring\s*$") {
            $modified = $true
            "extension=mbstring"
        } else {
            $_
        }
    }
    
    if ($modified) {
        # Backup original file
        $backupPath = "$phpIniPath.backup-$(Get-Date -Format 'yyyyMMdd-HHmmss')"
        Copy-Item $phpIniPath $backupPath -Force
        Write-Host "Backup created: $backupPath" -ForegroundColor Green
        
        # Write the modified content
        $newContent | Set-Content $phpIniPath -Encoding UTF8
        Write-Host "mbstring extension enabled successfully!" -ForegroundColor Green
        Write-Host "`nPlease verify with: php -m | Select-String mbstring" -ForegroundColor Cyan
    } else {
        Write-Host "Could not find ';extension=mbstring' line to uncomment." -ForegroundColor Yellow
        Write-Host "The extension might already be enabled or the format is different." -ForegroundColor Yellow
        Write-Host "`nManual fix: Open $phpIniPath and change:" -ForegroundColor Cyan
        Write-Host "  ;extension=mbstring" -ForegroundColor White
        Write-Host "to:" -ForegroundColor Cyan
        Write-Host "  extension=mbstring" -ForegroundColor White
    }
} catch {
    Write-Host "Error editing php.ini: $_" -ForegroundColor Red
    Write-Host "`nYou may need to:" -ForegroundColor Yellow
    Write-Host "1. Run PowerShell as Administrator" -ForegroundColor White
    Write-Host "2. Or manually edit: $phpIniPath" -ForegroundColor White
    Write-Host "3. Find the line: ;extension=mbstring" -ForegroundColor White
    Write-Host "4. Remove the semicolon to make it: extension=mbstring" -ForegroundColor White
    exit 1
}




