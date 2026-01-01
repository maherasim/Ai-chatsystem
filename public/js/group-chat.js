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
            const sdk = window.AgoraChat || window.WebIM;
            if (sdk) {
                console.log('Agora/WebIM SDK found, creating instance...');
                this.agoraClient = sdk.createInstance ? sdk.createInstance({
                    appKey: data.app_id,
                }) : new sdk.connection({
                    appKey: data.app_id,
                });

                // Login to Agora
                if (this.agoraClient.open) {
                    await this.agoraClient.open({
                        user: this.currentUserId,
                        agoraToken: data.token,
                    });
                } else {
                    await this.agoraClient.open({
                        apiUrl: 'https://a1.chat.agora.io',
                        user: this.currentUserId,
                        accessToken: data.token,
                        appKey: data.app_id
                    });
                }

                this.isConnected = true;
                this.setupEventListeners();

                console.log('Agora Chat initialized successfully');
                return true;
            } else {
                console.warn('Agora Chat SDK not loaded (checked AgoraChat and WebIM). Using fallback mode.');
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
            emptyState.classList.remove('d-flex');
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

        // Load group members
        await this.loadGroupMembers(groupId);

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
                this.renderMessages(data.messages);
            } else {
                console.warn('No messages or failed to load:', data);
            }
        } catch (error) {
            console.error('Failed to load group messages:', error);
        }
    }

    /**
     * Load group members
     */
    async loadGroupMembers(groupId) {
        try {
            const response = await fetch(`/api/chat/group/${groupId}/members`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            const data = await response.json();

            if (data.success && data.members) {
                this.renderMembers(data.members);
            }
        } catch (error) {
            console.error('Failed to load group members:', error);
        }
    }

    /**
     * Render group members in offcanvas
     */
    renderMembers(members) {
        const wrapper = document.getElementById('group-members-wrapper');
        const list = document.getElementById('group-members-list');
        const countSpan = document.getElementById('group-member-count');
        const headerStatus = document.querySelector('.last-seen');

        if (countSpan) countSpan.textContent = members.length;
        if (headerStatus) headerStatus.textContent = `${members.length} Members`;

        if (!list || !wrapper) return;

        wrapper.style.display = 'block';
        list.innerHTML = '';

        members.forEach(member => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex align-items-center justify-content-between p-3';
            li.innerHTML = `
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-md online">
                        <img src="${member.avatar || '/build/img/profiles/avatar-06.jpg'}" class="rounded-circle" alt="img" onerror="this.src='/build/img/profiles/avatar-06.jpg'">
                    </div>
                    <div class="ms-2">
                        <h6 class="mb-0">${member.id === this.currentUserId ? 'You' : member.name}</h6>
                        <small class="text-muted">${member.is_admin ? 'Admin' : 'Member'}</small>
                    </div>
                </div>
                ${member.is_admin ? '<i class="ti ti-crown text-warning"></i>' : ''}
            `;
            list.appendChild(li);
        });
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
                emptyState.classList.remove('d-flex');
                emptyState.style.display = 'none';
            }
        } else {
            // Show empty state if no messages
            if (emptyState) {
                emptyState.classList.add('d-flex');
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
                        <img src="${message.file_url}" alt="Image">
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
                    ${message.replied_to_message ? `
                        <div class="message-reply-wrap mb-2">
                             <div class="reply-content">
                                 <strong>${message.replied_to_message.sender_name}</strong>
                                 <p>${message.replied_to_message.content}</p>
                             </div>
                        </div>
                    ` : ''}
                    <div class="chat-info">
                        <div class="message-content">
                            ${messageContent}
                        </div>
                        <div class="chat-actions">
                            <a class="#" href="#" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a class="dropdown-item reply-btn" href="#" onclick="window.groupChatManager.setReply('${message._id || message.id}', '${this.escapeHtml(message.content || '')}', 'You', '${window.currentUserAvatar || ''}')"><i class="ti ti-corner-up-left me-2"></i>Reply</a></li>
                                <li><a class="dropdown-item" href="#"><i class="ti ti-trash me-2"></i>Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    ${message.reactions && message.reactions.length > 0 ? `
                        <div class="emonji-wrap text-end mt-1">
                            ${message.reactions.map(r => `<span>${r.emoji} ${r.count || 1}</span>`).join('')}
                        </div>
                    ` : ''}
                </div>
                <div class="chat-avatar">
                    <img src="${window.currentUserAvatar || '/build/img/profiles/avatar-17.jpg'}" class="rounded-circle dreams_chat" alt="image" onerror="this.src='/build/img/profiles/avatar-17.jpg'">
                </div>
            `;
        } else {
            // LEFT SIDE: Received messages (avatar first, content second)
            messageDiv.innerHTML = `
                <div class="chat-avatar">
                    <img src="${message.sender_avatar || '/build/img/profiles/avatar-06.jpg'}" class="rounded-circle" alt="image" onerror="this.src='/build/img/profiles/avatar-06.jpg'">
                </div>
                <div class="chat-content">
                    <div class="chat-profile-name">
                        <h6>${message.sender_name || 'User'}
                            <i class="ti ti-circle-filled fs-7 mx-2"></i>
                            <span class="chat-time">${time}</span>
                            <span class="msg-read success"><i class="ti ti-checks"></i></span>
                        </h6>
                    </div>
                    ${message.replied_to_message ? `
                        <div class="message-reply-wrap mb-2">
                             <div class="reply-content">
                                 <strong>${message.replied_to_message.sender_name}</strong>
                                 <p>${message.replied_to_message.content}</p>
                             </div>
                        </div>
                    ` : ''}
                    <div class="chat-info">
                        <div class="message-content">
                            ${messageContent}
                        </div>
                        <div class="chat-actions">
                            <a class="#" href="#" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a class="dropdown-item reply-btn" href="#" onclick="window.groupChatManager.setReply('${message._id || message.id}', '${this.escapeHtml(message.content || '')}', '${this.escapeHtml(message.sender_name || 'User')}', '${message.sender_avatar || ''}')"><i class="ti ti-corner-up-left me-2"></i>Reply</a></li>
                                <li><a class="dropdown-item" href="#"><i class="ti ti-flag me-2"></i>Report</a></li>
                            </ul>
                        </div>
                    </div>
                    ${message.reactions && message.reactions.length > 0 ? `
                        <div class="emonji-wrap mt-1">
                            ${message.reactions.map(r => `<span>${r.emoji} ${r.count || 1}</span>`).join('')}
                        </div>
                    ` : ''}
                </div>
            `;
        }

        return messageDiv;
    }

    /**
     * Handle received message
     */
    handleMessageReceived(message) {
        // Add message to UI
        const attrs = message.ext;
        const messageData = {
            _id: message.id || message.serverMsgId,
            sender_id: String(message.from || ''),
            content: message.msg || message.content,
            message_type: message.type || 'txt',
            created_at: new Date().toISOString(),
            sender_name: attrs?.sender_name || message.from,
            sender_avatar: attrs?.sender_avatar || null,
            replied_to_message: attrs?.replied_to_message ? JSON.parse(attrs.replied_to_message) : null,
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
                const ext = {
                    sender_name: window.currentUserName || 'User',
                    sender_avatar: window.currentUserAvatar || '',
                };

                if (this.replyingToMessage) {
                    ext.replied_to_message = JSON.stringify({
                        id: this.replyingToMessage.id,
                        content: this.replyingToMessage.content,
                        sender_name: this.replyingToMessage.sender_name
                    });
                }

                const msg = AgoraChat.message.create({
                    type: messageType,
                    to: this.currentGroupId,
                    msg: content,
                    chatType: 'groupChat',
                    ext: ext
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
     * Set reply
     */
    setReply(messageId, content, senderName, avatar) {
        this.replyingToMessage = {
            id: messageId,
            content: content,
            sender_name: senderName
        };

        const replyDiv = document.getElementById('reply-div');
        if (replyDiv) {
            replyDiv.style.display = 'flex';
            const nameEl = replyDiv.querySelector('h6');
            if (nameEl) nameEl.firstChild.textContent = senderName;

            const contentEl = replyDiv.querySelector('.reply-content');
            if (contentEl) contentEl.textContent = content;

            const avatarEl = replyDiv.querySelector('.chat-avatar img');
            if (avatarEl && avatar) avatarEl.src = avatar;
        }

        // Focus input
        const input = document.querySelector('.chat-footer-wrap .form-control');
        if (input) input.focus();
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
    } else {
        // Auto-select first group if no group_id in URL
        setTimeout(() => {
            // Find first group card with openGroupChat in onclick
            const firstGroupCard = document.querySelector('#cardScroller div[onclick*="openGroupChat"]');
            if (firstGroupCard) {
                console.log('Auto-selecting first group chat');
                firstGroupCard.click();
            }
        }, 1000); // Wait bit longer for sidebar to render
    }
});

// Update openGroupChat function in notification.blade.php
window.openGroupChat = function (groupId, groupName, photoUrl) {
    if (window.groupChatManager) {
        window.groupChatManager.openGroupChat(groupId, groupName, photoUrl);
    }
};

