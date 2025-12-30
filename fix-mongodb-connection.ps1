# PowerShell script to fix MongoDB connection issue
# This script checks if MongoDB is installed and running, and provides solutions

Write-Host "Checking MongoDB installation..." -ForegroundColor Cyan

# Check if MongoDB service exists
$mongoService = Get-Service -Name "*mongo*" -ErrorAction SilentlyContinue

if ($mongoService) {
    Write-Host "MongoDB service found: $($mongoService.Name)" -ForegroundColor Green
    
    if ($mongoService.Status -eq 'Running') {
        Write-Host "MongoDB is already running!" -ForegroundColor Green
        exit 0
    } else {
        Write-Host "MongoDB service is stopped. Attempting to start..." -ForegroundColor Yellow
        try {
            Start-Service -Name $mongoService.Name
            Write-Host "MongoDB service started successfully!" -ForegroundColor Green
            Start-Sleep -Seconds 3
            Write-Host "You can now run: php artisan migrate" -ForegroundColor Cyan
            exit 0
        } catch {
            Write-Host "Failed to start MongoDB service: $_" -ForegroundColor Red
            Write-Host "Try running as Administrator or start manually from Services" -ForegroundColor Yellow
        }
    }
} else {
    Write-Host "MongoDB service not found." -ForegroundColor Yellow
}

# Check if MongoDB is installed in common locations
$mongoPaths = @(
    "C:\Program Files\MongoDB\Server\*\bin\mongod.exe",
    "C:\mongodb\bin\mongod.exe",
    "$env:LOCALAPPDATA\Programs\MongoDB\*\bin\mongod.exe"
)

$mongoExe = $null
foreach ($path in $mongoPaths) {
    $found = Get-ChildItem -Path $path -ErrorAction SilentlyContinue | Select-Object -First 1
    if ($found) {
        $mongoExe = $found.FullName
        Write-Host "Found MongoDB executable at: $mongoExe" -ForegroundColor Green
        break
    }
}

if ($mongoExe) {
    Write-Host "`nMongoDB is installed but not running as a service." -ForegroundColor Yellow
    Write-Host "To start MongoDB manually, run:" -ForegroundColor Cyan
    Write-Host "  Start-Process '$mongoExe' -ArgumentList '--dbpath C:\data\db' -WindowStyle Hidden" -ForegroundColor White
    Write-Host "`nOr install MongoDB as a Windows service:" -ForegroundColor Cyan
    Write-Host "  '$mongoExe' --install --serviceName MongoDB --dbpath C:\data\db" -ForegroundColor White
    Write-Host "  Start-Service MongoDB" -ForegroundColor White
} else {
    Write-Host "`nMongoDB is not installed on this system." -ForegroundColor Red
    Write-Host "`nTo fix this issue, you have the following options:" -ForegroundColor Cyan
    Write-Host "`n1. Install MongoDB Community Edition:" -ForegroundColor Yellow
    Write-Host "   Download from: https://www.mongodb.com/try/download/community" -ForegroundColor White
    Write-Host "   Or use Chocolatey: choco install mongodb" -ForegroundColor White
    Write-Host "`n2. Use MongoDB Atlas (Cloud - Free tier available):" -ForegroundColor Yellow
    Write-Host "   Sign up at: https://www.mongodb.com/cloud/atlas" -ForegroundColor White
    Write-Host "   Then update your .env file with the connection string" -ForegroundColor White
    Write-Host "`n3. Use Docker (if Docker Desktop is installed):" -ForegroundColor Yellow
    Write-Host "   docker run -d -p 27017:27017 --name mongodb mongo:latest" -ForegroundColor White
    Write-Host "`n4. Temporarily switch to SQLite for development:" -ForegroundColor Yellow
    Write-Host "   Update .env: DB_CONNECTION=sqlite" -ForegroundColor White
    Write-Host "   Note: This may not work if your models use MongoDB-specific features" -ForegroundColor White
}

Write-Host "`nCurrent MongoDB configuration:" -ForegroundColor Cyan
Write-Host "  Host: 127.0.0.1" -ForegroundColor White
Write-Host "  Port: 27017" -ForegroundColor White
Write-Host "`nTo test MongoDB connection, run:" -ForegroundColor Cyan
Write-Host "  Test-NetConnection -ComputerName 127.0.0.1 -Port 27017" -ForegroundColor White





