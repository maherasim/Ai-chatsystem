# Production Deployment Guide

## Image Loading Fix - Deployment Instructions

### Overview
This guide explains how to deploy the image loading fix to your production server (`https://logiteam.it-supportline.de`).

---

## Prerequisites
- SSH access to your production server
- Composer installed on production server  
- Git access to push code changes

---

## Step 1: Push Code Changes to Production

```bash
# On your local machine (already done)
git add .
git commit -m "Fix image loading issue - Added ImageHelper and updated blade templates"
git push origin main  # or your production branch
```

## Step 2: Deploy on Production Server

SSH into your production server and navigate to your project directory:

```bash
ssh your-username@logiteam.it-supportline.de
cd /path/to/your/laravel/project
```

Pull the latest changes:

```bash
git pull origin main  # or your production branch
```

## Step 3: Run Composer Autoload

```bash
composer dump-autoload
```

## Step 4: Create Storage Symlink

**This is the most critical step!** Run the following command:

```bash
php artisan storage:link
```

**If you get an error saying the link already exists:**

```bash
# Remove the existing symlink
rm public/storage

# Then create it again
php artisan storage:link
```

## Step 5: Clear All Caches

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Step 6: Verify Deployment

1. Visit `https://logiteam.it-supportline.de/tasks`
2. Check if project logos are now visible
3. Visit `https://logiteam.it-supportline.de/ticket`
4. Check if project logos in tickets are visible
5. Check the header - your profile image should be visible

**Use browser developer tools (F12) → Network tab:**
- Look for requests to `/storage/projects/...` or `/storage/upload/users/...`
- They should return `200 OK` instead of `404 Not Found`

---

## Troubleshooting

### Images still not loading?

**Check 1: Verify symlink exists**
```bash
ls -la public/storage
```
Should show: `public/storage -> ../storage/app/public`

**Check 2: Verify images exist in storage**
```bash
ls -la storage/app/public/projects/
ls -la storage/app/public/upload/users/
```

**Check 3: Check file permissions**
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

**Check 4: Check .htaccess or nginx config**
Make sure your web server is configured to follow symlinks.

For Apache (`.htaccess`):
```apache
Options +FollowSymLinks
```

For Nginx (`nginx.conf`):
```nginx
# Should already be configured in most Laravel setups
location /storage {
    try_files $uri $uri/ =404;
}
```

---

## What Was Fixed?

### Changed Files:
1. **app/Helpers/ImageHelper.php** (NEW)
   - Created helper functions to normalize image paths
   - Handles duplicate path prefixes automatically

2. **composer.json** (MODIFIED)
   - Added ImageHelper to autoload files

3. **resources/views/Chats/header.blade.php** (MODIFIED)
   - Uses `user_avatar_url()` for profile images

4. **resources/views/Chats/task.blade.php** (MODIFIED)
   - Uses `project_logo_url()` for project logos

### Root Cause:
The database stores paths like `upload/users/image.png` and code was adding `storage/` prefix, creating `/storage/upload/users/image.png`. But without the symlink `public/storage -> storage/app/public`, the web server couldn't find these files.

The helper functions now:
- Remove duplicate prefixes
- Ensure consistent path format
- Work on both local and production environments

---

## Success Checklist

- [ ] Code pushed to production
- [ ] `composer dump-autoload` completed
- [ ] `php artisan storage:link` completed
- [ ] All caches cleared
- [ ] Project logos visible on `/tasks`
- [ ] Project logos visible on `/ticket`
- [ ] Profile images visible in header
- [ ] No 404 errors in browser console for images
