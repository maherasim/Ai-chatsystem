# PowerShell script to install and configure MongoDB using Chocolatey
# Run as Administrator

Write-Host "Installing MongoDB Community Edition..." -ForegroundColor Cyan

# Check if running as Administrator
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "This script requires Administrator privileges." -ForegroundColor Red
    Write-Host "Please run PowerShell as Administrator and try again." -ForegroundColor Yellow
    Write-Host "`nOr run: Start-Process powershell -Verb RunAs -ArgumentList '-File install-mongodb.ps1'" -ForegroundColor Cyan
    exit 1
}

# Create data directory
$dataPath = "C:\data\db"
if (-not (Test-Path $dataPath)) {
    Write-Host "Creating MongoDB data directory: $dataPath" -ForegroundColor Yellow
    New-Item -ItemType Directory -Path $dataPath -Force | Out-Null
}

# Install MongoDB via Chocolatey
Write-Host "Installing MongoDB (this may take a few minutes)..." -ForegroundColor Yellow
try {
    choco install mongodb -y
    Write-Host "MongoDB installed successfully!" -ForegroundColor Green
} catch {
    Write-Host "Installation failed: $_" -ForegroundColor Red
    Write-Host "You may need to install MongoDB manually from: https://www.mongodb.com/try/download/community" -ForegroundColor Yellow
    exit 1
}

# Start MongoDB service
Write-Host "`nStarting MongoDB service..." -ForegroundColor Cyan
$serviceName = Get-Service -Name "*mongo*" -ErrorAction SilentlyContinue | Select-Object -First 1 -ExpandProperty Name

if ($serviceName) {
    try {
        Start-Service -Name $serviceName
        Write-Host "MongoDB service started!" -ForegroundColor Green
        Write-Host "`nMongoDB is now running. You can run: php artisan migrate" -ForegroundColor Green
    } catch {
        Write-Host "Failed to start service automatically. Try starting it manually from Services (services.msc)" -ForegroundColor Yellow
    }
} else {
    Write-Host "MongoDB service not found. You may need to install it as a service manually." -ForegroundColor Yellow
    Write-Host "Run: mongod --install --serviceName MongoDB --dbpath $dataPath" -ForegroundColor Cyan
}





