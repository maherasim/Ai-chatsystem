# Agora Chat - Quick Start Guide

## 🎯 What Has Been Set Up

Your Laravel application now has a complete Agora Chat integration:

### ✅ Backend Components

1. **Config File**: `config/agora.php` - Agora configuration
2. **Service Class**: `app/Services/AgoraService.php` - Handles Agora API calls
3. **Model**: `app/Models/ChatMessage.php` - MongoDB model for storing messages
4. **Controller**: `app/Http/Controllers/ChatController.php` - Handles all chat API endpoints
5. **Routes**: Chat API routes added to `routes/web.php`

### ✅ Frontend Components

1. **JavaScript Manager**: `public/js/agora-chat.js` - Agora Chat SDK wrapper
2. **Setup Guide**: `AGORA_SETUP_GUIDE.md` - Complete setup instructions

---

## 🚀 Quick Setup (5 Steps)

### Step 1: Get Agora Credentials

1. Go to https://console.agora.io/
2. Create/select a project
3. Get your **App ID** and **App Certificate**
4. Enable **Agora Chat** service and get **Customer ID** and **Customer Secret**

### Step 2: Add to .env

```env
AGORA_APP_ID=your_app_id
AGORA_APP_CERTIFICATE=your_app_certificate
AGORA_CUSTOMER_ID=your_customer_id
AGORA_CUSTOMER_SECRET=your_customer_secret
```

### Step 3: Include SDK in Layout

Add to `resources/views/layout/partials/footer-scripts.blade.php` (before closing `</body>`):

```html
<!-- Agora Chat SDK -->
<script src="https://download.agora.io/sdk/release/AgoraChat-sdk-Web.js"></script>
<script src="{{ asset('js/agora-chat.js') }}"></script>
```

### Step 4: Initialize in Chat View

Add to `resources/views/Chats/chat.blade.php` (before `@endsection`):

```html
<script>
document.addEventListener('DOMContentLoaded', async function() {
    const chatManager = window.agoraChatManager;
    await chatManager.init();
    
    chatManager.onMessage((message) => {
        console.log('New message:', message);
        // Your message display logic here
    });
});
</script>
```

### Step 5: Test

1. Visit `/chat` route
2. Open browser console
3. Should see: "Agora Chat initialized successfully"

---

## 📡 API Endpoints Available

All routes require authentication (`auth` middleware):

- `GET /api/chat/token` - Get Agora token
- `GET /api/chat/conversations` - Get all conversations
- `GET /api/chat/conversation/{conversationId}/messages` - Get messages
- `GET /api/chat/conversation/user/{otherUserId}` - Get/create conversation
- `POST /api/chat/message` - Save message to DB
- `POST /api/chat/upload-file` - Upload file
- `POST /api/chat/conversation/{conversationId}/read` - Mark as read
- `DELETE /api/chat/message/{messageId}` - Delete message
- `POST /api/chat/message/{messageId}/reaction` - Add reaction

---

## 💻 JavaScript Usage Examples

### Send Text Message

```javascript
await chatManager.sendTextMessage('user_id_123', 'Hello!', 'conversation_id');
```

### Send File/Image

```javascript
const fileInput = document.querySelector('input[type="file"]');
const file = fileInput.files[0];
await chatManager.sendFileMessage('user_id_123', file, 'img');
```

### Load Messages

```javascript
const messages = await chatManager.loadConversationMessages('conversation_id', 50);
messages.forEach(msg => displayMessage(msg));
```

### Listen for Messages

```javascript
chatManager.onMessage((message) => {
    addMessageToUI(message);
});
```

### Get Conversation

```javascript
const conversation = await chatManager.getConversation('other_user_id');
```

---

## 🔗 Next Steps

1. **Read Full Setup Guide**: See `AGORA_SETUP_GUIDE.md` for detailed instructions
2. **Integrate with UI**: Connect Agora Chat Manager to your existing chat UI
3. **Test Thoroughly**: Test sending/receiving messages
4. **Add Features**: Implement reactions, replies, file sharing, etc.

---

## ⚠️ Important Notes

1. **Token Generation**: The current token generation is simplified. For production, consider using Agora's official token builder or REST API.

2. **SDK Version**: Make sure you're using the latest Agora Chat SDK. Check: https://docs.agora.io/en/agora-chat/get-started/get-started-sdk-web

3. **Security**: Never expose App Certificate in frontend code. Always generate tokens on backend.

4. **MongoDB**: The ChatMessage model uses MongoDB. Ensure your MongoDB connection is configured.

---

## 🆘 Need Help?

- Check `AGORA_SETUP_GUIDE.md` for detailed troubleshooting
- Review Agora Documentation: https://docs.agora.io/en/agora-chat/overview/product-overview
- Check browser console and Laravel logs for errors

---

## ✅ Checklist

Before going live, ensure:

- [ ] Agora credentials are set in `.env`
- [ ] Agora Chat SDK is included in layout
- [ ] Chat initialization code is added
- [ ] Token generation is working
- [ ] Messages can be sent/received
- [ ] Messages are saved to database
- [ ] UI is properly integrated
- [ ] Security measures are in place

---

**You're all set! 🎉** Your chat system is now dynamic and real-time using Agora Chat.

