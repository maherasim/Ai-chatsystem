# Agora Credentials Setup Guide

## ✅ What You Already Have

You have the **REST API credentials**:
- **Key (Customer ID)**: `e852f1a85a804eecb12b03d0d65f8084`
- **Secret (Customer Secret)**: `2a0ba3e514374848bd3d3386b8df798d`

These go in your `.env` file as:
```env
AGORA_CUSTOMER_ID=e852f1a85a804eecb12b03d0d65f8084
AGORA_CUSTOMER_SECRET=2a0ba3e514374848bd3d3386b8df798d
```

---

## 🔍 What You Still Need

You need to get **App ID** and **App Certificate** from your Agora project:

### How to Find App ID and App Certificate:

1. **Log in to Agora Console**: https://console.agora.io/

2. **Go to Project Management**:
   - Click on **"Project Management"** in the left sidebar
   - Click on **"Project List"**

3. **Select Your Project**:
   - Click on your project name

4. **Find App ID**:
   - Look for **"App ID"** - it's a long string like: `1234567890123456789012345678901234`
   - Copy this value

5. **Find App Certificate**:
   - Scroll down to find **"App Certificate"** section
   - Click on **"Show"** or **"View"** to reveal the certificate
   - Copy the certificate string (it's a long alphanumeric string)

**Note**: If you don't see App Certificate, you may need to:
   - Create a new project
   - Or enable the certificate in project settings
   - Or you can generate one if it doesn't exist

---

## 📝 Add All Credentials to .env File

Once you have all 4 values, add them to your `.env` file:

```env
# Agora Configuration
AGORA_APP_ID=your_app_id_here
AGORA_APP_CERTIFICATE=your_app_certificate_here
AGORA_CUSTOMER_ID=e852f1a85a804eecb12b03d0d65f8084
AGORA_CUSTOMER_SECRET=2a0ba3e514374848bd3d3386b8df798d

# Optional: Token expiry times (in seconds)
AGORA_RTM_TOKEN_EXPIRY=3600
AGORA_CHAT_TOKEN_EXPIRY=86400
```

---

## 🔐 Important Security Notes

1. **Never commit `.env` file to git** (it should already be in `.gitignore`)
2. **Keep credentials secure** - don't share them publicly
3. **Customer Secret is sensitive** - treat it like a password
4. **App Certificate is sensitive** - don't expose it in frontend code

---

## ✅ Quick Checklist

- [ ] Found App ID from Agora Console
- [ ] Found App Certificate from Agora Console
- [ ] Added all 4 credentials to `.env` file
- [ ] Verified `.env` file is not in git (check `.gitignore`)
- [ ] Tested token generation endpoint

---

## 🧪 Test Your Setup

After adding credentials, test the token endpoint:

```bash
# Make sure you're logged in first, then visit:
http://your-app.test/api/chat/token
```

Or use curl:
```bash
curl -X GET http://your-app.test/api/chat/token \
  -H "Cookie: laravel_session=..." \
  -H "X-CSRF-TOKEN: ..."
```

You should get a JSON response with:
```json
{
  "success": true,
  "app_id": "your_app_id",
  "user_id": "user_id",
  "token": "agora_token_string",
  ...
}
```

If you get an error, check:
1. All credentials are correct in `.env`
2. You've run `php artisan config:clear` to refresh config cache
3. Check Laravel logs: `storage/logs/laravel.log`

---

## 📞 Need Help Finding App ID/Certificate?

If you can't find App ID or Certificate:
1. Check if you're in the correct project
2. Try creating a new project and enable all features
3. Check Agora documentation: https://docs.agora.io/en/agora-chat/get-started/get-started-console-app

---

## 🎯 Next Steps After Adding Credentials

1. ✅ Add credentials to `.env`
2. Clear config cache: `php artisan config:clear`
3. Include Agora SDK in your layout (see `AGORA_QUICK_START.md`)
4. Initialize chat in your blade template
5. Test sending/receiving messages

