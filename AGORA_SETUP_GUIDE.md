# Agora Chat Integration Setup Guide

This guide will help you set up and configure Agora Chat for your Laravel application.

## 📋 Prerequisites

1. Agora.io account (sign up at https://console.agora.io/)
2. Laravel 11 application with MongoDB
3. Node.js and npm (for frontend dependencies)

---

## 🚀 Step 1: Get Agora Credentials

1. Go to https://console.agora.io/
2. Create a new project or use existing one
3. Navigate to **Project Management** → **Project List**
4. Click on your project
5. Find your **App ID** and **App Certificate**

For Chat service specifically:
- You may need to enable **Agora Chat** service in your project
- Get your **Customer ID** and **Customer Secret** from the Chat service settings

---

## ⚙️ Step 2: Configure Environment Variables

Add these to your `.env` file:

```env
# Agora Configuration
AGORA_APP_ID=your_app_id_here
AGORA_APP_CERTIFICATE=your_app_certificate_here
AGORA_CUSTOMER_ID=your_customer_id_here
AGORA_CUSTOMER_SECRET=your_customer_secret_here

# Optional: Token expiry times (in seconds)
AGORA_RTM_TOKEN_EXPIRY=3600
AGORA_CHAT_TOKEN_EXPIRY=86400

# For Chat service (if using Chat REST API)
AGORA_ORG_NAME=your_org_name
AGORA_APP_NAME=your_app_name
```

---

## 📦 Step 3: Include Agora Chat SDK in Frontend

You need to include the Agora Chat JavaScript SDK in your layout file.

### Option 1: CDN (Recommended for quick setup)

Add this to your `resources/views/layout/mainlayout.blade.php` or wherever you include scripts:

```html
<!-- Agora Chat SDK -->
<script src="https://download.agora.io/sdk/release/AgoraChat-sdk-Web.js"></script>

<!-- Your Agora Chat Manager -->
<script src="{{ asset('js/agora-chat.js') }}"></script>
```

### Option 2: NPM Package (Recommended for production)

```bash
npm install agora-chat
```

Then in your JavaScript file:

```javascript
import * as AgoraChat from 'agora-chat';
```

---

## 🎯 Step 4: Update Chat Blade Template

Add the Agora Chat initialization script to your `resources/views/Chats/chat.blade.php`:

Add before `@endsection`:

```html
<!-- Agora Chat SDK -->
<script src="https://download.agora.io/sdk/release/AgoraChat-sdk-Web.js"></script>
<script src="{{ asset('js/agora-chat.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    // Initialize Agora Chat
    const chatManager = window.agoraChatManager;
    const initialized = await chatManager.init();
    
    if (!initialized) {
        console.error('Failed to initialize Agora Chat');
        return;
    }

    // Set current user info
    window.currentUserId = '{{ Auth::id() }}';
    
    // Example: Handle incoming messages
    chatManager.onMessage((message) => {
        console.log('New message received:', message);
        // Add your message handling logic here
        displayMessage(message);
    });

    // Example: Send message function
    window.sendMessage = async function(toUserId, content) {
        try {
            await chatManager.sendTextMessage(toUserId, content);
            console.log('Message sent successfully');
        } catch (error) {
            console.error('Failed to send message:', error);
        }
    };

    // Example: Load conversation messages
    window.loadMessages = async function(conversationId) {
        const messages = await chatManager.loadConversationMessages(conversationId);
        // Display messages in UI
        messages.forEach(msg => displayMessage(msg));
    };
});
</script>
```

---

## 🔧 Step 5: Fix AgoraService Token Generation

**IMPORTANT**: The `AgoraService.php` has a simplified token generation. For production, you should use Agora's official token generator.

### Install Agora Token Builder (Optional but Recommended)

```bash
composer require agora/token-builder
```

Or use Agora's REST API for token generation (which is what we're doing in the service).

---

## 📝 Step 6: Update Chat Controller (if needed)

The `ChatController` is already set up, but you may need to adjust the `getConversations` method if you want to expose it as a route properly.

Update `routes/web.php` if the conversations route needs fixing:

```php
Route::get('/api/chat/conversations', [ChatController::class, 'getConversations'])->name('chat.conversations');
```

And add a public method in `ChatController`:

```php
public function getConversationsApi()
{
    $conversations = $this->getConversations();
    return response()->json($conversations);
}
```

---

## 🗄️ Step 7: Database Schema

The `ChatMessage` model will automatically create the MongoDB collection. No migration needed for MongoDB, but ensure your MongoDB connection is configured in `config/database.php`.

---

## 🧪 Step 8: Test the Integration

1. **Test Token Generation:**
   ```bash
   curl -X GET http://your-app.test/api/chat/token \
     -H "Cookie: laravel_session=..." \
     -H "X-CSRF-TOKEN: ..."
   ```

2. **Test Message Saving:**
   ```bash
   curl -X POST http://your-app.test/api/chat/message \
     -H "Content-Type: application/json" \
     -H "X-CSRF-TOKEN: ..." \
     -d '{
       "message_id": "test123",
       "conversation_id": "user1_user2",
       "to_user_id": "user2_id",
       "message_type": "txt",
       "content": "Hello!"
     }'
   ```

3. **Check Browser Console:**
   - Open browser DevTools
   - Check console for "Agora Chat initialized successfully"
   - Try sending a message

---

## 🎨 Step 9: Integrate with Your UI

You need to connect the Agora Chat Manager to your existing chat UI. Here's an example:

```javascript
// In your chat.blade.php or separate JS file

// Initialize chat when page loads
let chatManager;
let currentConversationId = null;

async function initChat() {
    chatManager = window.agoraChatManager;
    await chatManager.init();
    
    // Listen for new messages
    chatManager.onMessage((message) => {
        addMessageToUI(message);
    });
    
    // Listen for custom events
    document.addEventListener('agora:message', (e) => {
        const message = e.detail;
        addMessageToUI(message);
    });
}

// Function to send message from input
async function sendChatMessage() {
    const input = document.querySelector('.form-control[placeholder="Type Your Message"]');
    const message = input.value.trim();
    
    if (!message || !currentConversationId) return;
    
    const toUserId = getOtherUserIdFromConversation(currentConversationId);
    
    try {
        await chatManager.sendTextMessage(toUserId, message, currentConversationId);
        input.value = '';
    } catch (error) {
        alert('Failed to send message: ' + error.message);
    }
}

// Function to load and display messages
async function loadConversation(conversationId) {
    currentConversationId = conversationId;
    
    // Clear current messages
    const messagesContainer = document.querySelector('.chat-body .messages');
    messagesContainer.innerHTML = '';
    
    // Load messages
    const messages = await chatManager.loadConversationMessages(conversationId);
    
    // Display messages
    messages.forEach(msg => {
        addMessageToUI(msg);
    });
    
    // Mark as read
    await chatManager.markAsRead(conversationId);
}

// Function to add message to UI
function addMessageToUI(message) {
    // Use your existing message HTML structure
    // Check CHAT_UI_GUIDE.md for message structure
    const messagesContainer = document.querySelector('.chat-body .messages');
    
    const isMyMessage = message.from === window.currentUserId;
    const messageClass = isMyMessage ? 'chats chats-right' : 'chats';
    
    const messageHTML = `
        <div class="${messageClass}">
            <div class="chat-content">
                <div class="chat-profile-name ${isMyMessage ? 'text-end' : ''}">
                    <h6>${isMyMessage ? 'You' : message.from}</h6>
                    <span class="chat-time">${formatTime(new Date())}</span>
                </div>
                <div class="chat-info">
                    <div class="message-content">
                        ${escapeHtml(message.msg || message.content)}
                    </div>
                </div>
            </div>
        </div>
    `;
    
    messagesContainer.insertAdjacentHTML('beforeend', messageHTML);
    scrollToBottom();
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', initChat);
```

---

## 🔐 Step 10: Security Considerations

1. **Never expose App Certificate in frontend code**
2. **Always generate tokens on the backend**
3. **Validate user permissions before allowing chat**
4. **Implement rate limiting on API endpoints**
5. **Sanitize message content before saving**

---

## 📚 Additional Resources

- [Agora Chat Documentation](https://docs.agora.io/en/agora-chat/overview/product-overview)
- [Agora Chat Web SDK](https://docs.agora.io/en/agora-chat/get-started/get-started-sdk-web)
- [Agora REST API](https://docs.agora.io/en/agora-chat/restfulapi/get-started)

---

## 🐛 Troubleshooting

### Issue: "Agora Chat SDK not loaded"
**Solution**: Make sure you've included the Agora Chat SDK script before your `agora-chat.js` file.

### Issue: "Failed to get Agora token"
**Solution**: 
- Check your `.env` file has correct credentials
- Verify Agora App ID and Certificate are correct
- Check backend logs for detailed error

### Issue: Messages not appearing
**Solution**:
- Check browser console for errors
- Verify Agora Chat connection is established
- Check if message handlers are properly set up
- Verify backend message saving is working

### Issue: Token expiration
**Solution**: The token refresh is handled automatically, but if issues persist, check token expiry settings in `.env`.

---

## ✅ Checklist

- [ ] Agora account created and credentials obtained
- [ ] Environment variables added to `.env`
- [ ] Agora Chat SDK included in frontend
- [ ] `agora-chat.js` file created and included
- [ ] Chat initialization code added to blade template
- [ ] Backend routes are accessible
- [ ] Test token generation
- [ ] Test message sending/receiving
- [ ] UI integration completed
- [ ] Security measures implemented

---

## 🎉 You're Done!

Your chat system should now be fully dynamic using Agora Chat. Messages will be sent and received in real-time, and stored in your MongoDB database.

If you encounter any issues, check the browser console and Laravel logs for detailed error messages.

