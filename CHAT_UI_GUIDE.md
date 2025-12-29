# Chat UI Functionality Guide

This document explains how the chat UI components work in `chat.blade.php`.

## Table of Contents
1. [Message Structure](#message-structure)
2. [Message Actions Dropdown](#message-actions-dropdown)
3. [Emoji Reactions](#emoji-reactions)
4. [Reply Functionality](#reply-functionality)
5. [Forward Functionality](#forward-functionality)
6. [Chat Footer (Input Area)](#chat-footer-input-area)
7. [Message Types](#message-types)

---

## 1. Message Structure

Each message in the chat follows this structure:

```html
<div class="chats">  <!-- Left side (incoming) -->
  <div class="chat-avatar">
    <img src="..." class="rounded-circle" alt="image">
  </div>
  <div class="chat-content">
    <div class="chat-profile-name">
      <h6>Username</h6>
      <span class="chat-time">02:39 PM</span>
      <span class="msg-read success"><i class="ti ti-checks"></i></span>
    </div>
    <div class="chat-info">
      <div class="message-content">
        <!-- Message text here -->
      </div>
      <div class="chat-actions">
        <!-- Dropdown menu here -->
      </div>
    </div>
  </div>
</div>

<div class="chats chats-right">  <!-- Right side (outgoing) -->
  <!-- Same structure, but aligned to right -->
</div>
```

### Key Classes:
- `chats` - Left-aligned messages (received)
- `chats-right` - Right-aligned messages (sent)
- `chat-avatar` - User avatar image
- `chat-content` - Message content wrapper
- `chat-profile-name` - Username and timestamp
- `message-content` - Actual message text/media
- `chat-actions` - Action buttons (3-dot menu)

---

## 2. Message Actions Dropdown

Each message has a **3-dot vertical menu** (⋮) that provides actions:

```html
<div class="chat-actions">
  <a href="#" data-bs-toggle="dropdown">
    <i class="ti ti-dots-vertical"></i>
  </a>
  <ul class="dropdown-menu dropdown-menu-end p-3">
    <li><a class="dropdown-item reply-btn" href="#">
      <i class="ti ti-corner-up-left me-2"></i>Reply
    </a></li>
    <li><a class="dropdown-item" href="#">
      <i class="ti ti-pinned me-2"></i>Forward
    </a></li>
    <li><a class="dropdown-item" href="#">
      <i class="ti ti-file-export me-2"></i>Copy
    </a></li>
    <li><a class="dropdown-item" href="#">
      <i class="ti ti-heart me-2"></i>Mark as Favourite
    </a></li>
    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#message-delete">
      <i class="ti ti-trash me-2"></i>Delete
    </a></li>
    <li><a class="dropdown-item" href="#">
      <i class="ti ti-check me-2"></i>Mark as Unread
    </a></li>
    <li><a class="dropdown-item" href="#">
      <i class="ti ti-box-align-right me-2"></i>Archive Chat
    </a></li>
    <li><a class="dropdown-item" href="#">
      <i class="ti ti-pinned me-2"></i>Pin Chat
    </a></li>
  </ul>
</div>
```

### Actions Available:
1. **Reply** - Reply to the message (uses `reply-btn` class)
2. **Forward** - Forward message (opens modal `#forward-message`)
3. **Copy** - Copy message text
4. **Mark as Favourite** - Star/favorite the message
5. **Delete** - Delete message (opens modal `#message-delete`)
6. **Mark as Unread** - Mark message as unread
7. **Archive Chat** - Archive the conversation
8. **Pin Chat** - Pin the conversation to top

### Bootstrap Dropdown:
- Uses Bootstrap 5 dropdown: `data-bs-toggle="dropdown"`
- Position: `dropdown-menu-end` (right-aligned)

---

## 3. Emoji Reactions

Messages can have **emoji reactions** attached. There are two ways to react:

### A. Quick Reaction Button (On Message)
```html
<div class="emoj-group">
  <ul>
    <li class="emoj-action">
      <a href="javascript:void(0);">
        <i class="ti ti-mood-smile"></i>
      </a>
      <div class="emoj-group-list">
        <ul>
          <li><a href="javascript:void(0);">
            <img src="/build/img/icons/emonji-02.svg" alt="Icon">
          </a></li>
          <li><a href="javascript:void(0);">
            <img src="/build/img/icons/emonji-05.svg" alt="Icon">
          </a></li>
          <!-- More emojis... -->
          <li class="add-emoj">
            <a href="javascript:void(0);">
              <i class="ti ti-plus"></i>
            </a>
          </li>
        </ul>
      </div>
    </li>
    <li>
      <a href="#" data-bs-toggle="modal" data-bs-target="#forward-message">
        <i class="ti ti-arrow-forward-up"></i>
      </a>
    </li>
  </ul>
</div>
```

### B. Display Existing Reactions
```html
<div class="emonji-wrap">
  <a href="javascript:void(0);">
    <img src="/build/img/icons/emonji-02.svg" class="me-2" alt="icon">24
  </a>
  <a href="javascript:void(0);">
    <img src="/build/img/icons/emonji-03.svg" class="me-2" alt="icon">15
  </a>
</div>
```
- Shows emoji icon + count of reactions
- Clickable to see who reacted

---

## 4. Reply Functionality

### A. Reply Button (In Dropdown)
Clicking "Reply" in the dropdown should:
1. Store the message being replied to
2. Show reply preview in chat footer
3. Scroll to input area

### B. Reply Preview (In Chat Footer)
```html
<div class="chats reply-chat reply-div" id="reply-div">
  <div class="chat-avatar">
    <img src="..." class="rounded-circle" alt="image">
  </div>
  <div class="chat-content">
    <div class="chat-profile-name">
      <h6>Edward Lietz</h6>
    </div>
    <div class="chat-info">
      <div class="message-content">
        <div class="message-reply reply-content">
          Thank you for your support  <!-- Original message -->
        </div>
      </div>
    </div>
  </div>
  <a href="#" class="close-replay">
    <i class="ti ti-x"></i>  <!-- Close reply -->
  </a>
</div>
```

### C. Reply Display (In Message Thread)
```html
<div class="message-content">
  <div class="chat-profile-name">
    <h6>You</h6>
  </div>
  <div class="message-reply">
    Thanks for Sharing!!! Can we have a call??
  </div>
  Yes Please  <!-- Your reply text -->
</div>
```

### Implementation Notes:
- Use JavaScript to capture clicked `reply-btn`
- Extract message content, sender, and ID
- Populate `#reply-div` with reply preview
- Store reply reference when sending message
- Display reply context above your new message

---

## 5. Forward Functionality

Forward opens a modal (`#forward-message`):

```html
<li><a href="#" data-bs-toggle="modal" data-bs-target="#forward-message">
  <i class="ti ti-pinned me-2"></i>Forward
</a></li>
```

The modal should allow:
- Selecting contacts/chats to forward to
- Option to add a message with forwarded content
- Preview of message being forwarded

**Note:** The modal `#forward-message` is referenced but may need to be implemented in a separate component or included file.

---

## 6. Chat Footer (Input Area)

The chat input area is at the bottom:

```html
<div class="chat-footer">
  <form class="footer-form">
    <!-- Reply Preview (shown when replying) -->
    <div class="chats reply-chat reply-div" id="reply-div">...</div>
    
    <div class="chat-footer-wrap">
      <!-- 1. Voice/Audio Recording -->
      <div class="form-item">
        <a href="#" class="action-circle">
          <i class="ti ti-microphone"></i>
        </a>
      </div>
      
      <!-- 2. Text Input -->
      <div class="form-wrap">
        <input type="text" class="form-control" placeholder="Type Your Message">
      </div>
      
      <!-- 3. Emoji Picker -->
      <div class="form-item emoj-action-foot">
        <a href="#" class="action-circle">
          <i class="ti ti-mood-smile"></i>
        </a>
        <div class="emoj-group-list-foot down-emoji-circle">
          <ul>
            <li><a href="javascript:void(0);">
              <img src="/build/img/icons/emonji-02.svg" alt="Icon">
            </a></li>
            <!-- More emojis... -->
          </ul>
        </div>
      </div>
      
      <!-- 4. File Upload -->
      <div class="form-item position-relative">
        <a href="#" class="action-circle file-action">
          <i class="ti ti-folder"></i>
        </a>
        <input type="file" class="open-file" name="files" id="files">
      </div>
      
      <!-- 5. More Options Dropdown -->
      <div class="form-item">
        <a href="#" data-bs-toggle="dropdown">
          <i class="ti ti-dots-vertical"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end p-3">
          <a href="#" class="dropdown-item">
            <i class="ti ti-camera-selfie me-2"></i>Camera
          </a>
          <a href="#" class="dropdown-item">
            <i class="ti ti-photo-up me-2"></i>Gallery
          </a>
          <a href="#" class="dropdown-item">
            <i class="ti ti-music me-2"></i>Audio
          </a>
          <a href="#" class="dropdown-item">
            <i class="ti ti-map-pin-share me-2"></i>Location
          </a>
          <a href="#" class="dropdown-item">
            <i class="ti ti-user-check me-2"></i>Contact
          </a>
        </div>
      </div>
      
      <!-- 6. Send Button -->
      <div class="form-btn">
        <button class="btn btn-primary" type="submit">
          <i class="ti ti-send"></i>
        </button>
      </div>
    </div>
  </form>
</div>
```

### Footer Features:
1. **Microphone** - Voice/audio recording
2. **Text Input** - Type message
3. **Emoji** - Quick emoji picker
4. **File Upload** - Attach files
5. **More Options** - Camera, Gallery, Audio, Location, Contact
6. **Send** - Submit message

---

## 7. Message Types

The chat supports different message types:

### A. Text Message
```html
<div class="message-content">
  Hi there! I'm interested in your services.
</div>
```

### B. Image/Gallery
```html
<div class="message-content">
  <div class="chat-img">
    <div class="img-wrap">
      <img src="..." alt="img">
      <div class="img-overlay">
        <a class="gallery-img" data-fancybox="gallery-img" href="...">
          <i class="ti ti-eye"></i>
        </a>
        <a href="#"><i class="ti ti-download"></i></a>
      </div>
    </div>
    <!-- More images... -->
  </div>
</div>
```

### C. File Attachment
```html
<div class="file-attach">
  <span class="file-icon">
    <i class="ti ti-files"></i>
  </span>
  <div class="ms-2 overflow-hidden">
    <h6 class="mb-1">Ecommerce.zip</h6>
    <p>14.23 KB</p>
  </div>
  <a href="javascript:void(0);" class="download-icon">
    <i class="ti ti-download"></i>
  </a>
</div>
```

### D. Audio Message
```html
<div class="message-audio">
  <audio controls>
    <source src="build/img/audio/audio.mp3" type="audio/mpeg">
  </audio>
</div>
```

### E. Video Message
```html
<div class="message-video">
  <video width="400" controls>
    <source src="build/img/video/video.mp4" type="video/mp4">
  </video>
</div>
```

### F. Link Preview
```html
<div class="message-link">
  <div class="link-img">
    <img src="/build/img/icons/github.svg" alt="Icon">
  </div>
  <a href="javascript:void(0);" class="link-primary">
    https://segmentfault.com/u/guanguans/articles
  </a>
</div>
```

### G. Forwarded Message
```html
<div class="chat-forward">
  <div class="forward-text text-primary">
    <i class="ti ti-arrow-forward me-2"></i>Forward
  </div>
  <!-- Original message content -->
</div>
```

---

## JavaScript Implementation Suggestions

To make these features work, you'll need JavaScript handlers:

### Reply Handler
```javascript
document.querySelectorAll('.reply-btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    const message = this.closest('.chats');
    const content = message.querySelector('.message-content').textContent;
    const sender = message.querySelector('.chat-profile-name h6').textContent;
    
    // Show reply preview
    document.getElementById('reply-div').style.display = 'block';
    document.querySelector('.reply-content').textContent = content;
    
    // Store reply data for when message is sent
    window.replyTo = {
      messageId: message.dataset.messageId,
      content: content,
      sender: sender
    };
  });
});
```

### Close Reply Handler
```javascript
document.querySelector('.close-replay').addEventListener('click', function(e) {
  e.preventDefault();
  document.getElementById('reply-div').style.display = 'none';
  window.replyTo = null;
});
```

### Forward Handler
```javascript
document.querySelectorAll('[data-bs-target="#forward-message"]').forEach(btn => {
  btn.addEventListener('click', function(e) {
    const message = this.closest('.chats');
    const content = message.querySelector('.message-content').innerHTML;
    
    // Store message to forward
    window.forwardMessage = {
      messageId: message.dataset.messageId,
      content: content
    };
  });
});
```

---

## CSS Classes Reference

| Class | Purpose |
|-------|---------|
| `chats` | Message container (left) |
| `chats-right` | Message container (right) |
| `chat-avatar` | User avatar |
| `chat-content` | Message content wrapper |
| `chat-profile-name` | Username/timestamp |
| `message-content` | Message text/content |
| `chat-actions` | Action buttons area |
| `emoj-group` | Emoji reaction buttons |
| `emoj-group-list` | Emoji picker dropdown |
| `reply-div` | Reply preview container |
| `message-reply` | Reply context display |
| `chat-footer` | Input area container |
| `footer-form` | Message input form |

---

## Summary

The chat UI is structured with:
- **Left/Right alignment** for incoming/outgoing messages
- **Dropdown menus** for message actions
- **Emoji reactions** for quick feedback
- **Reply system** with preview in footer
- **Forward modal** for sharing messages
- **Rich media support** (images, files, audio, video)
- **Comprehensive input area** with multiple attachment options

Most actions are **UI-ready** but need **JavaScript handlers** to make them functional with backend APIs.

