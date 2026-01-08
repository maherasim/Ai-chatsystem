# Quick Fix for MongoDB Connection Error

## Problem
```
MongoDB\Driver\Exception\ConnectionTimeoutException 
No suitable servers found: [connection refused calling hello on '127.0.0.1:27017']
```

## Solution Options

### Option 1: Install MongoDB Locally (Recommended for Development)

**Using Chocolatey (Fastest):**
```powershell
# Run PowerShell as Administrator
choco install mongodb -y

# Create data directory
New-Item -ItemType Directory -Path "C:\data\db" -Force

# Install as Windows Service
mongod --install --serviceName MongoDB --dbpath C:\data\db

# Start the service
Start-Service MongoDB
```

**Or use the provided script:**
```powershell
# Run PowerShell as Administrator
.\install-mongodb.ps1
```

### Option 2: Use MongoDB Atlas (Cloud - No Installation Needed)

1. Sign up for free at: https://www.mongodb.com/cloud/atlas
2. Create a free cluster
3. Get your connection string
4. Update your `.env` file:
   ```
   MONGO_DB_HOST=your-cluster.mongodb.net
   MONGO_DB_PORT=27017
   MONGO_DB_USERNAME=your-username
   MONGO_DB_PASSWORD=your-password
   DB_DATABASE=chatsystem_online
   ```

### Option 3: Use Docker (If Docker Desktop is Installed)

```powershell
docker run -d -p 27017:27017 --name mongodb mongo:latest
```

### Option 4: Check Current Status

Run the diagnostic script:
```powershell
.\fix-mongodb-connection.ps1
```

## After Installation

Once MongoDB is running, test the connection:
```powershell
Test-NetConnection -ComputerName 127.0.0.1 -Port 27017
```

Then run your migrations:
```powershell
php artisan migrate
```

## Troubleshooting

- **Service won't start**: Check Windows Event Viewer for MongoDB errors
- **Port already in use**: Another application may be using port 27017
- **Permission denied**: Run commands as Administrator
- **Data directory issues**: Ensure `C:\data\db` exists and has proper permissions






