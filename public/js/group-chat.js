/**
 * Dynamic Group Chat with Agora
 * Handles real-time group messaging with reactions, reply, forward
 */

class GroupChatManager {
    constructor() {
        this.currentGroupId = null;
        this.currentGroupName = null;
        this.currentGroupPhoto = null;
        this.currentUserId = null;
        this.agoraClient = null;
        this.isConnected = false;
        this.replyingToMessage = null;
    }

    /**
     * Initialize Agora Chat for group messaging
     */
    async initAgora() {
        try {
            // Get token from backend to get user ID
            const response = await fetch('/api/chat/token', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            const data = await response.json();

            if (!data.success) {
                throw new Error(data.message || 'Failed to get Agora token');
            }

            // Store user ID as string for consistent comparison (ALWAYS set this, even if Agora fails)
            this.currentUserId = String(data.user_id || data.userId || '').trim();
            console.log('Current user ID set:', this.currentUserId);

            // Initialize Agora Chat SDK if available
            if (typeof AgoraChat !== 'undefined') {
                this.agoraClient = AgoraChat.createInstance({
                    appKey: data.app_id,
                });

                // Login to Agora
                await this.agoraClient.open({
                    user: this.currentUserId,
                    agoraToken: data.token,
                });

                this.isConnected = true;
                this.setupEventListeners();

                console.log('Agora Chat initialized successfully');
                return true;
            } else {
                console.warn('Agora Chat SDK not loaded. Using fallback mode.');
                // Still return true because we got the user ID
                return true;
            }
        } catch (error) {
            console.error('Failed to initialize Agora Chat:', error);
            // Try to get user ID from a fallback endpoint or current user data
            await this.initializeUserIdFallback();
            return false;
        }
    }

    /**
     * Fallback method to get user ID if token endpoint fails
     */
    async initializeUserIdFallback() {
        try {
            // Try to get user ID from a meta tag or global variable
            const userIdMeta = document.querySelector('meta[name="user-id"]');
            if (userIdMeta) {
                this.currentUserId = String(userIdMeta.content).trim();
                console.log('User ID set from meta tag:', this.currentUserId);
                return;
            }

            // Try to get from window object if available
            if (window.currentUserId) {
                this.currentUserId = String(window.currentUserId).trim();
                console.log('User ID set from window:', this.currentUserId);
                return;
            }

            console.warn('Could not determine current user ID');
        } catch (error) {
            console.error('Failed to initialize user ID fallback:', error);
        }
    }

    /**
     * Setup Agora event listeners
     */
    setupEventListeners() {
        if (!this.agoraClient) return;

        // Message received
        this.agoraClient.addEventHandler('messageHandler', {
            onTextMessage: (message) => {
                this.handleMessageReceived(message);
            },
            onPictureMessage: (message) => {
                this.handleMessageReceived(message);
            },
            onFileMessage: (message) => {
                this.handleMessageReceived(message);
            },
        });
    }

    /**
     * Open group chat
     */
    async openGroupChat(groupId, groupName, photoUrl) {
        // If not on the chat page, redirect to it
        const chatMessagesContainer = document.getElementById('chatMessagesContainer');
        if (!chatMessagesContainer) {
            console.log('Not on chat page, redirecting...');
            window.location.href = `/chat?group_id=${groupId}&group_name=${encodeURIComponent(groupName)}&photo_url=${encodeURIComponent(photoUrl || '')}`;
            return;
        }

        this.currentGroupId = groupId;
        this.currentGroupName = groupName;
        this.currentGroupPhoto = photoUrl;

        // Hide empty state
        const emptyState = document.getElementById('emptyChatState');
        if (emptyState) {
            emptyState.style.display = 'none';
        }

        // Update chat header
        this.updateChatHeader(groupName, photoUrl);

        // Initialize user ID and Agora if not already done
        if (!this.currentUserId) {
            await this.initAgora();
        } else if (!this.isConnected) {
            // User ID is set but Agora not connected, try to connect
            await this.initAgora();
        }

        // Ensure we have user ID before loading messages
        if (!this.currentUserId) {
            console.error('Cannot load messages: User ID not set');
            await this.initializeUserIdFallback();
        }

        // Load existing messages
        await this.loadGroupMessages(groupId);

        // Join group chat room
        if (this.agoraClient && this.currentGroupId) {
            console.log('Joining group chat room:', groupId);
        }
    }

    /**
     * Update chat header with group name and photo
     */
    updateChatHeader(groupName, photoUrl) {
        const headerName = document.getElementById('chatHeaderName') || document.querySelector('.user-details h6');
        if (headerName) {
            headerName.textContent = groupName;
        }

        const headerAvatar = document.getElementById('chatHeaderAvatar') || document.querySelector('.user-details .avatar img');
        if (headerAvatar && photoUrl) {
            headerAvatar.src = photoUrl;
            headerAvatar.alt = groupName || 'Group';
        }
    }

    /**
     * Load group messages from backend
     */
    async loadGroupMessages(groupId) {
        try {
            const response = await fetch(`/api/chat/group/${groupId}/messages`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            const data = await response.json();

            if (data.success && data.messages) {
                console.log('Loaded messages:', data.messages.length, 'Current user ID:', this.currentUserId);

                // Enrich messages with sender avatars if missing
                const enrichedMessages = await Promise.all(data.messages.map(async (message) => {
                    // If sender_avatar is missing but we have sender_id, try to fetch it
                    if (!message.sender_avatar && message.sender_id) {
                        try {
                            const userResponse = await fetch(`/api/user/${message.sender_id}/profile`, {
                                method: 'GET',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                },
                            });

                            if (userResponse.ok) {
                                const userData = await userResponse.json();
                                if (userData.success && userData.user && userData.user.avatar) {
                                    message.sender_avatar = userData.user.avatar;
                                    message.sender_name = userData.user.name || message.sender_name;
                                }
                            }
                        } catch (error) {
                            console.error('Failed to fetch sender profile for message:', error);
                        }
                    }
                    return message;
                }));

                this.renderMessages(enrichedMessages);
            } else {
                console.warn('No messages or failed to load:', data);
            }
        } catch (error) {
            console.error('Failed to load group messages:', error);
        }
    }

    /**
     * Render messages dynamically
     */
    renderMessages(messages) {
        const container = document.getElementById('chatMessagesContainer');
        if (!container) return;

        // Clear existing messages
        container.innerHTML = '';

        // Hide empty state if we have messages
        const emptyState = document.getElementById('emptyChatState');
        if (messages.length > 0) {
            if (emptyState) {
                emptyState.style.display = 'none';
            }
        } else {
            // Show empty state if no messages
            if (emptyState) {
                emptyState.style.display = 'flex';
            }
            return;
        }

        // Group messages by date
        const groupedMessages = this.groupMessagesByDate(messages);

        Object.keys(groupedMessages).forEach(date => {
            // Add date separator
            const dateSeparator = document.createElement('div');
            dateSeparator.className = 'chat-line';
            dateSeparator.innerHTML = `<span class="chat-date">${date}</span>`;
            container.appendChild(dateSeparator);

            // Add messages for this date
            groupedMessages[date].forEach(message => {
                const messageElement = this.createMessageElement(message);
                container.appendChild(messageElement);
            });
        });

        // Scroll to bottom after rendering
        this.scrollToBottom();
    }

    /**
     * Group messages by date
     */
    groupMessagesByDate(messages) {
        const grouped = {};

        messages.forEach(message => {
            const date = new Date(message.created_at);
            const dateStr = this.formatDate(date);

            if (!grouped[dateStr]) {
                grouped[dateStr] = [];
            }
            grouped[dateStr].push(message);
        });

        return grouped;
    }

    /**
     * Format date for display
     */
    formatDate(date) {
        const today = new Date();
        const yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1);

        if (date.toDateString() === today.toDateString()) {
            return 'Today';
        } else if (date.toDateString() === yesterday.toDateString()) {
            return 'Yesterday';
        } else {
            return date.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
        }
    }

    /**
     * Create message element with all UI features
     */
    createMessageElement(message) {
        // Compare sender_id with currentUserId (handle both string and object ID)
        // Normalize both IDs by trimming and converting to string
        const senderId = String(message.sender_id || message.from_user_id || message.from || '').trim();
        const currentUserIdStr = String(this.currentUserId || window.currentUserId || '').trim();

        // Compare IDs (handle MongoDB ObjectId format)
        const isOwnMessage = senderId !== '' && currentUserIdStr !== '' &&
            (senderId === currentUserIdStr ||
                senderId.toLowerCase() === currentUserIdStr.toLowerCase());

        // Debug logging (always log to help debug)
        console.log('Message comparison:', {
            senderId: senderId,
            currentUserIdStr: currentUserIdStr,
            isOwnMessage: isOwnMessage,
            messageId: message._id || message.id,
            messageContent: message.content?.substring(0, 30) || ''
        });

        const messageDiv = document.createElement('div');
        messageDiv.className = `chats ${isOwnMessage ? 'chats-right' : ''}`;
        messageDiv.setAttribute('data-message-id', message._id || message.id);

        const time = new Date(message.created_at).toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });

        let messageContent = '';

        // Handle different message types
        if (message.message_type === 'img' && message.file_url) {
            messageContent = `
                <div class="chat-img">
                    <div class="img-wrap">
                        <img src="${message.file_url}" alt="Image" title="${message.file_url}">
                        <div class="img-overlay">
                            <a class="gallery-img" data-fancybox="gallery-img" href="${message.file_url}" title="Image">
                                <i class="ti ti-eye"></i>
                            </a>
                            <a href="${message.file_url}" download><i class="ti ti-download"></i></a>
                        </div>
                    </div>
                </div>
            `;
        } else if (message.message_type === 'file' && message.file_url) {
            messageContent = `
                <div class="file-attach">
                    <span class="file-icon">
                        <i class="ti ti-files"></i>
                    </span>
                    <div class="ms-2 overflow-hidden">
                        <h6 class="mb-1">${message.file_name || 'File'}</h6>
                        <p>${this.formatFileSize(message.file_size)}</p>
                    </div>
                    <a href="${message.file_url}" download class="download-icon">
                        <i class="ti ti-download"></i>
                    </a>
                </div>
            `;
        } else {
            // Text message
            messageContent = `
                <div class="message-content">
                    ${this.escapeHtml(message.content || '')}
                </div>
            `;
        }

        // Structure for LEFT side (received messages): Avatar first, then content
        // Structure for RIGHT side (sent messages): Content first, then avatar
        if (isOwnMessage) {
            // RIGHT SIDE: Sent messages (content first, avatar last)
            messageDiv.innerHTML = `
                <div class="chat-content">
                    <div class="chat-profile-name text-end">
                        <h6>You
                            <i class="ti ti-circle-filled fs-7 mx-2"></i>
                            <span class="chat-time">${time}</span>
                            <span class="msg-read success"><i class="ti ti-checks"></i></span>
                        </h6>
                    </div>
                    <div class="chat-info">
                        <div class="message-content">
                            ${messageContent}
                        </div>
                    </div>
                </div>
                <div class="chat-avatar">
                    <img src="${window.currentUserAvatar || (window.baseUrl || 'https://logiadmin.it-supportline.de') + '/storage/'}" 
                        class="rounded-circle dreams_chat" 
                        alt="image" 
                        title="${window.currentUserAvatar || (window.baseUrl || 'https://logiadmin.it-supportline.de') + '/storage/'}"
                        onerror="if (!this.getAttribute('data-tried-fallback')) { this.setAttribute('data-tried-fallback', 'true'); this.src = this.src.replace(window.location.origin, 'https://logiadmin.it-supportline.de'); } else { this.src = '/build/img/profiles/avatar-02.jpg'; }">
                </div>
            `;
        } else {
            // LEFT SIDE: Received messages (avatar first, content second)
            messageDiv.innerHTML = `
                <div class="chat-avatar">
                    <img src="${message.sender_avatar || (window.baseUrl || 'https://logiadmin.it-supportline.de') + '/storage/'}" 
                        class="rounded-circle" 
                        alt="image" 
                        title="${message.sender_avatar || (window.baseUrl || 'https://logiadmin.it-supportline.de') + '/storage/'}"
                        onerror="if (!this.getAttribute('data-tried-fallback')) { this.setAttribute('data-tried-fallback', 'true'); this.src = this.src.replace(window.location.origin, 'https://logiadmin.it-supportline.de'); } else { this.src = '/build/img/profiles/avatar-02.jpg'; }">
                </div>
                <div class="chat-content">
                    <div class="chat-profile-name">
                        <h6>${message.sender_name || 'User'}
                            <i class="ti ti-circle-filled fs-7 mx-2"></i>
                            <span class="chat-time">${time}</span>
                            <span class="msg-read success"><i class="ti ti-checks"></i></span>
                        </h6>
                    </div>
                    <div class="chat-info">
                        <div class="message-content">
                            ${messageContent}
                        </div>
                    </div>
                </div>
            `;
        }

        return messageDiv;
    }

    /**
     * Handle received message
     */
    async handleMessageReceived(message) {
        // Fetch sender's profile information
        const senderId = String(message.from || '');
        let senderAvatar = null;
        let senderName = message.from || 'User';

        // Try to fetch sender info from backend
        try {
            const userResponse = await fetch(`/api/user/${senderId}/profile`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            if (userResponse.ok) {
                const userData = await userResponse.json();
                if (userData.success && userData.user) {
                    senderName = userData.user.name || userData.user.email || senderName;
                    senderAvatar = userData.user.avatar || null;
                }
            }
        } catch (error) {
            console.error('Failed to fetch sender profile:', error);
        }

        // Add message to UI
        const messageData = {
            _id: message.id || message.serverMsgId,
            sender_id: senderId,
            content: message.msg || message.content,
            message_type: message.type || 'txt',
            created_at: new Date().toISOString(),
            sender_name: senderName,
            sender_avatar: senderAvatar,
        };

        const messageElement = this.createMessageElement(messageData);
        const container = document.getElementById('chatMessagesContainer');
        if (container) {
            // Hide empty state
            const emptyState = document.getElementById('emptyChatState');
            if (emptyState) {
                emptyState.style.display = 'none';
            }

            container.appendChild(messageElement);
            this.scrollToBottom();
        }
    }

    /**
     * Send message
     */
    async sendMessage(content, messageType = 'txt', file = null) {
        if (!this.currentGroupId) {
            alert('Please select a group first');
            return;
        }

        try {
            let messageData = {
                group_id: this.currentGroupId,
                content: content,
                message_type: messageType,
                replied_to_message_id: this.replyingToMessage ? this.replyingToMessage.id : null,
            };

            // Handle file upload
            if (file) {
                const formData = new FormData();
                formData.append('file', file);
                formData.append('type', messageType);
                formData.append('group_id', this.currentGroupId);

                const uploadResponse = await fetch('/api/chat/upload-file', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                    body: formData,
                });

                const uploadData = await uploadResponse.json();
                if (uploadData.success) {
                    messageData.file_url = uploadData.file_url;
                    messageData.file_name = uploadData.file_name;
                    messageData.file_size = uploadData.file_size;
                }
            }

            // Send via Agora if connected
            if (this.agoraClient && this.isConnected) {
                const msg = AgoraChat.message.create({
                    type: messageType,
                    to: this.currentGroupId,
                    msg: content,
                    chatType: 'groupChat',
                });

                await this.agoraClient.send(msg);
            }

            // Save to backend
            const response = await fetch('/api/chat/group/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify(messageData),
            });

            const data = await response.json();

            if (data.success && data.message) {
                // Clear input
                const input = document.querySelector('.chat-footer-wrap .form-control');
                if (input) {
                    input.value = '';
                }

                // Clear reply
                this.clearReply();

                // Immediately add the sent message to UI (on right side)
                const sentMessageData = {
                    ...data.message,
                    sender_id: String(this.currentUserId || ''),
                    from_user_id: String(this.currentUserId || ''),
                };

                // Add message to UI immediately
                const container = document.getElementById('chatMessagesContainer');
                if (container) {
                    // Hide empty state
                    const emptyState = document.getElementById('emptyChatState');
                    if (emptyState) {
                        emptyState.style.display = 'none';
                    }

                    const messageDate = new Date(sentMessageData.created_at);
                    const messageElement = this.createMessageElement(sentMessageData);
                    messageElement.setAttribute('data-date', this.formatDate(messageDate));
                    container.appendChild(messageElement);
                    this.scrollToBottom();
                }
            } else if (data.success) {
                // Fallback: reload all messages if message data not returned
                await this.loadGroupMessages(this.currentGroupId);
            }
        } catch (error) {
            console.error('Failed to send message:', error);
            alert('Failed to send message. Please try again.');
        }
    }

    /**
     * Set reply message
     */
    setReplyMessage(messageId, messageContent) {
        this.replyingToMessage = {
            id: messageId,
            content: messageContent
        };

        const replyDiv = document.getElementById('reply-div');
        const replyContent = document.getElementById('reply-content');

        if (replyDiv && replyContent) {
            replyContent.textContent = messageContent;
            replyDiv.style.display = 'block';
        }
    }

    /**
     * Clear reply
     */
    clearReply() {
        this.replyingToMessage = null;
        const replyDiv = document.getElementById('reply-div');
        if (replyDiv) {
            replyDiv.style.display = 'none';
        }
    }

    /**
     * Scroll to bottom
     */
    scrollToBottom() {
        const container = document.querySelector('.chat-body');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    }

    /**
     * Format file size
     */
    formatFileSize(bytes) {
        if (!bytes) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    /**
     * Escape HTML
     */
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Global instance
window.groupChatManager = new GroupChatManager();

// Initialize on page load
document.addEventListener('DOMContentLoaded', async () => {
    // Initialize user ID immediately on page load
    if (window.groupChatManager && !window.groupChatManager.currentUserId) {
        await window.groupChatManager.initAgora();
    }

    // Setup message input handler
    const messageInput = document.querySelector('.chat-footer-wrap .form-control');
    const sendButton = document.querySelector('.chat-footer-wrap .form-btn button, .chat-footer-wrap .form-btn a');

    if (messageInput) {
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                const content = messageInput.value.trim();
                if (content) {
                    window.groupChatManager.sendMessage(content);
                }
            }
        });
    }

    if (sendButton) {
        sendButton.addEventListener('click', (e) => {
            e.preventDefault();
            const content = messageInput ? messageInput.value.trim() : '';
            if (content) {
                window.groupChatManager.sendMessage(content);
            }
        });
    }

    // Close reply handler
    const closeReply = document.querySelector('.close-replay');
    if (closeReply) {
        closeReply.addEventListener('click', (e) => {
            e.preventDefault();
            window.groupChatManager.clearReply();
        });
    }

    // Check for group_id in URL to auto-open chat
    const urlParams = new URLSearchParams(window.location.search);
    const urlGroupId = urlParams.get('group_id');
    const urlGroupName = urlParams.get('group_name');
    const urlPhotoUrl = urlParams.get('photo_url');

    if (urlGroupId) {
        console.log('Auto-opening chat for group:', urlGroupId);
        setTimeout(() => {
            if (window.groupChatManager) {
                window.groupChatManager.openGroupChat(urlGroupId, urlGroupName || 'Group Chat', urlPhotoUrl);

                // Clean up URL parameters after opening
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
        }, 500); // Small delay to ensure everything is ready
    }
});

// Update openGroupChat function in notification.blade.php
window.openGroupChat = function (groupId, groupName, photoUrl) {
    if (window.groupChatManager) {
        window.groupChatManager.openGroupChat(groupId, groupName, photoUrl);
    }
};

