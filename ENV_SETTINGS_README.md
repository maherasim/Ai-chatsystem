# Fix 419 CSRF Token Error - Environment Settings

## Add these settings to your `.env` file:

```env
# Session Configuration (IMPORTANT for fixing 419 error)
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_DOMAIN=.it-supportline.de
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
SESSION_HTTP_ONLY=true
SESSION_PATH=/
SESSION_ENCRYPT=false

# App Configuration
APP_URL=https://logiteam.it-supportline.de
APP_ENV=production
APP_DEBUG=false
```

## Key Settings Explained:

1. **SESSION_DOMAIN=.it-supportline.de**
   - The leading dot (.) allows cookies to work across all subdomains
   - This is crucial for your domain structure

2. **SESSION_SECURE_COOKIE=true**
   - Required for HTTPS sites
   - Ensures cookies are only sent over secure connections

3. **SESSION_SAME_SITE=lax**
   - Allows cookies to be sent with top-level navigations
   - Use `none` if you still have issues (requires secure=true)

4. **SESSION_DRIVER=database**
   - Make sure your `sessions` table exists
   - Run: `php artisan session:table` and `php artisan migrate` if needed

## After updating .env:

1. Clear all caches:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   php artisan view:clear
   ```

2. Restart your web server/queue workers

3. Test the profile completion form again

## If still having issues:

- Check browser console for cookie errors
- Verify the sessions table exists in database
- Check if cookies are being set in browser DevTools
- Ensure APP_URL matches your actual domain exactly
