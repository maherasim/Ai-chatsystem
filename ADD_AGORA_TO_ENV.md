# Add Agora Credentials to .env File

## ✅ What You Have Now

- **App ID**: `27a5307cee6a4d959cbb726b36852b15` ✅
- **Customer ID**: `e852f1a85a804eecb12b03d0d65f8084` ✅
- **Customer Secret**: `2a0ba3e514374848bd3d3386b8df798d` ✅

## ⚠️ What You Still Need

- **App Certificate**: Get this from your Agora Console project settings

---

## 📝 Add to Your .env File

Open your `.env` file (located in the root of your project) and add these lines at the end:

```env
# Agora Chat Configuration
AGORA_APP_ID=27a5307cee6a4d959cbb726b36852b15
AGORA_APP_CERTIFICATE=YOUR_APP_CERTIFICATE_HERE
AGORA_CUSTOMER_ID=e852f1a85a804eecb12b03d0d65f8084
AGORA_CUSTOMER_SECRET=2a0ba3e514374848bd3d3386b8df798d

# Optional: Token expiry times (in seconds)
AGORA_RTM_TOKEN_EXPIRY=3600
AGORA_CHAT_TOKEN_EXPIRY=86400
```

**Important**: Replace `YOUR_APP_CERTIFICATE_HERE` with your actual App Certificate from the Agora Console.

---

## 🔍 How to Get App Certificate

1. In your Agora Console, click on **"LogiTeam_Chat"** project (or click "Configure")
2. Look for **"App Certificate"** section
3. Click **"Show"** or **"View"** to reveal it
4. Copy the certificate (it's a long alphanumeric string)
5. Replace `YOUR_APP_CERTIFICATE_HERE` in your `.env` file

**Note**: If you don't see an App Certificate option:
- You may need to enable it in project settings
- Or generate/create one if it doesn't exist
- Some older projects might not have certificates (you can create one)

---

## ✅ After Adding to .env

1. **Clear config cache**:
   ```bash
   php artisan config:clear
   ```

2. **Test the setup**:
   - Visit: `http://your-app.test/api/chat/token` (make sure you're logged in)
   - You should get a JSON response with token data

3. **Check for errors**:
   - If you get errors, check `storage/logs/laravel.log`
   - Make sure all credentials are correct

---

## 🎯 Next Steps

Once you have the App Certificate and added all credentials:

1. ✅ Add App Certificate to `.env`
2. ✅ Run `php artisan config:clear`
3. ✅ Include Agora SDK in your layout (see `AGORA_QUICK_START.md`)
4. ✅ Initialize chat in your blade template
5. ✅ Test sending/receiving messages

---

## 📋 Quick Checklist

- [x] App ID obtained
- [x] Customer ID obtained  
- [x] Customer Secret obtained
- [ ] App Certificate obtained ← **You need this**
- [ ] All credentials added to `.env`
- [ ] Config cache cleared
- [ ] Token endpoint tested

