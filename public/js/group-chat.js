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
            // For group chat, we use the group ID as the conversation ID
            // You may need to adjust this based on your Agora setup
            console.log('Joining group chat:', groupId);
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
        } else if (message.message_type === 'audio' && message.file_url) {
            messageContent = `
                <div class="message-content bg-transparent p-0">
                    <div class="message-audio">
                        <audio controls>
                            <source src="${message.file_url}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>
            `;
        } else {
            // Text message with reply support
            let replySection = '';
            if (message.replied_to_message) {
                replySection = `
                    <div class="chat-profile-name">
                        <h6>${message.replied_to_message.sender_name || 'User'}</h6>
                    </div>
                    <div class="message-reply">
                        ${message.replied_to_message.content || ''}
                    </div>
                `;
            }

            messageContent = `
                ${replySection}
                <div class="message-content">
                    ${this.escapeHtml(message.content || '')}
                </div>
            `;
        }

        // Reactions
        let reactionsHtml = '';
        if (message.reactions && Object.keys(message.reactions).length > 0) {
            reactionsHtml = '<div class="emonji-wrap">';
            Object.entries(message.reactions).forEach(([emoji, count]) => {
                reactionsHtml += `<a href="javascript:void(0);" onclick="window.groupChatManager.addReaction('${message._id || message.id}', '${emoji}')">
                    <img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" class="me-2" alt="icon">${count}
                </a>`;
            });
            reactionsHtml += '</div>';
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
                        <div class="chat-actions">
                            <a class="#" href="#" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a class="dropdown-item reply-btn" href="javascript:void(0);" onclick="window.groupChatManager.setReplyMessage('${message._id || message.id}', '${this.escapeHtml(message.content || '')}')">
                                    <i class="ti ti-corner-up-left me-2"></i>Reply
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.groupChatManager.forwardMessage('${message._id || message.id}')">
                                    <i class="ti ti-pinned me-2"></i>Forward
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.groupChatManager.copyMessage('${message._id || message.id}')">
                                    <i class="ti ti-file-export me-2"></i>Copy
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.groupChatManager.deleteMessage('${message._id || message.id}')" data-bs-toggle="modal" data-bs-target="#message-delete">
                                    <i class="ti ti-trash me-2"></i>Delete
                                </a></li>
                            </ul>
                        </div>
                        ${messageContent}
                        <div class="emoj-group">
                                <ul>
                                    <li class="emoj-action">
                                        <a href="javascript:void(0);" onclick="window.groupChatManager.showEmojiPicker('${message._id || message.id}')">
                                            <i class="ti ti-mood-smile"></i>
                                        </a>
                                        <div class="emoj-group-list">
                                            <ul>
                                                <li><a href="javascript:void(0);" onclick="window.groupChatManager.addReaction('${message._id || message.id}', '👍')">
                                                    <img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon">
                                                </a></li>
                                                <li><a href="javascript:void(0);" onclick="window.groupChatManager.addReaction('${message._id || message.id}', '❤️')">
                                                    <img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon">
                                                </a></li>
                                                <li><a href="javascript:void(0);" onclick="window.groupChatManager.addReaction('${message._id || message.id}', '😄')">
                                                    <img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon">
                                                </a></li>
                                                <li><a href="javascript:void(0);" onclick="window.groupChatManager.addReaction('${message._id || message.id}', '😮')">
                                                    <img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon">
                                                </a></li>
                                                <li><a href="javascript:void(0);" onclick="window.groupChatManager.addReaction('${message._id || message.id}', '😢')">
                                                    <img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon">
                                                </a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li><a href="javascript:void(0);" onclick="window.groupChatManager.forwardMessage('${message._id || message.id}')">
                                        <i class="ti ti-arrow-forward-up"></i>
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    ${reactionsHtml}
                </div>
                <div class="chat-avatar">
                    <img src="${window.currentUserAvatar || (window.baseUrl || 'https://logiteam.it-supportline.de') + '/storage/'}" 
                        class="rounded-circle dreams_chat" 
                        alt="image" 
                        title="${window.currentUserAvatar || (window.baseUrl || 'https://logiteam.it-supportline.de') + '/storage/'}"
                        onerror="if (!this.getAttribute('data-tried-fallback')) { this.setAttribute('data-tried-fallback', 'true'); try { const u = new URL(this.src); this.src = 'https://logiteam.it-supportline.de' + u.pathname; } catch(e) { this.src = '/build/img/profiles/avatar-02.jpg'; } } else { this.src = '/build/img/profiles/avatar-02.jpg'; }">
                </div>
            `;
        } else {
            // LEFT SIDE: Received messages (avatar first, content second)
            messageDiv.innerHTML = `
                <div class="chat-avatar">
                    <img src="${message.sender_avatar || (window.baseUrl || 'https://logiteam.it-supportline.de') + '/storage/'}" 
                        class="rounded-circle" 
                        alt="image" 
                        title="${message.sender_avatar || (window.baseUrl || 'https://logiteam.it-supportline.de') + '/storage/'}"
                        onerror="if (!this.getAttribute('data-tried-fallback')) { this.setAttribute('data-tried-fallback', 'true'); try { const u = new URL(this.src); this.src = 'https://logiteam.it-supportline.de' + u.pathname; } catch(e) { this.src = '/build/img/profiles/avatar-06.jpg'; } } else { this.src = '/build/img/profiles/avatar-06.jpg'; }">
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
                            <div class="emoj-group">
                                <ul>
                                    <li class="emoj-action">
                                        <a href="javascript:void(0);" onclick="window.groupChatManager.showEmojiPicker('${message._id || message.id}')">
                                            <i class="ti ti-mood-smile"></i>
                                        </a>
                                        <div class="emoj-group-list">
                                            <ul>
                                                <li><a href="javascript:void(0);" onclick="window.groupChatManager.addReaction('${message._id || message.id}', '👍')">
                                                    <img src="{{URL::asset('/build/img/icons/emonji-02.svg')}}" alt="Icon">
                                                </a></li>
                                                <li><a href="javascript:void(0);" onclick="window.groupChatManager.addReaction('${message._id || message.id}', '❤️')">
                                                    <img src="{{URL::asset('/build/img/icons/emonji-05.svg')}}" alt="Icon">
                                                </a></li>
                                                <li><a href="javascript:void(0);" onclick="window.groupChatManager.addReaction('${message._id || message.id}', '😄')">
                                                    <img src="{{URL::asset('/build/img/icons/emonji-06.svg')}}" alt="Icon">
                                                </a></li>
                                                <li><a href="javascript:void(0);" onclick="window.groupChatManager.addReaction('${message._id || message.id}', '😮')">
                                                    <img src="{{URL::asset('/build/img/icons/emonji-07.svg')}}" alt="Icon">
                                                </a></li>
                                                <li><a href="javascript:void(0);" onclick="window.groupChatManager.addReaction('${message._id || message.id}', '😢')">
                                                    <img src="{{URL::asset('/build/img/icons/emonji-08.svg')}}" alt="Icon">
                                                </a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li><a href="javascript:void(0);" onclick="window.groupChatManager.forwardMessage('${message._id || message.id}')">
                                        <i class="ti ti-arrow-forward-up"></i>
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="chat-actions">
                            <a class="#" href="#" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a class="dropdown-item reply-btn" href="javascript:void(0);" onclick="window.groupChatManager.setReplyMessage('${message._id || message.id}', '${this.escapeHtml(message.content || '')}')">
                                    <i class="ti ti-corner-up-left me-2"></i>Reply
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.groupChatManager.forwardMessage('${message._id || message.id}')">
                                    <i class="ti ti-pinned me-2"></i>Forward
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.groupChatManager.copyMessage('${message._id || message.id}')">
                                    <i class="ti ti-file-export me-2"></i>Copy
                                </a></li>
                            </ul>
                        </div>
                    </div>
                    ${reactionsHtml}
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
        const messageData = {
            _id: message.id || message.serverMsgId,
            sender_id: String(message.from || ''),
            content: message.msg || message.content,
            message_type: message.type || 'txt',
            created_at: new Date().toISOString(),
            sender_name: message.from,
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

                    // Check if we need to add a date separator
                    const lastMessage = container.lastElementChild;
                    const messageDate = new Date(sentMessageData.created_at);
                    let needsDateSeparator = true;

                    if (lastMessage && lastMessage.classList.contains('chats')) {
                        const lastMessageDate = lastMessage.getAttribute('data-date');
                        const today = new Date();
                        const yesterday = new Date(today);
                        yesterday.setDate(yesterday.getDate() - 1);

                        let dateStr = '';
                        if (messageDate.toDateString() === today.toDateString()) {
                            dateStr = 'Today';
                        } else if (messageDate.toDateString() === yesterday.toDateString()) {
                            dateStr = 'Yesterday';
                        } else {
                            dateStr = messageDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
                        }

                        if (lastMessageDate === dateStr) {
                            needsDateSeparator = false;
                        } else {
                            // Add date separator
                            const dateSeparator = document.createElement('div');
                            dateSeparator.className = 'chat-line';
                            dateSeparator.innerHTML = `<span class="chat-date">${dateStr}</span>`;
                            container.appendChild(dateSeparator);
                        }
                    } else if (lastMessage && lastMessage.classList.contains('chat-line')) {
                        // Last element is a date separator, check if same date
                        const lastDateText = lastMessage.querySelector('.chat-date')?.textContent;
                        const today = new Date();
                        const yesterday = new Date(today);
                        yesterday.setDate(yesterday.getDate() - 1);

                        let dateStr = '';
                        if (messageDate.toDateString() === today.toDateString()) {
                            dateStr = 'Today';
                        } else if (messageDate.toDateString() === yesterday.toDateString()) {
                            dateStr = 'Yesterday';
                        } else {
                            dateStr = messageDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
                        }

                        if (lastDateText === dateStr) {
                            needsDateSeparator = false;
                        }
                    } else {
                        // No messages yet, add date separator
                        const today = new Date();
                        const yesterday = new Date(today);
                        yesterday.setDate(yesterday.getDate() - 1);

                        let dateStr = '';
                        if (messageDate.toDateString() === today.toDateString()) {
                            dateStr = 'Today';
                        } else if (messageDate.toDateString() === yesterday.toDateString()) {
                            dateStr = 'Yesterday';
                        } else {
                            dateStr = messageDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
                        }

                        const dateSeparator = document.createElement('div');
                        dateSeparator.className = 'chat-line';
                        dateSeparator.innerHTML = `<span class="chat-date">${dateStr}</span>`;
                        container.appendChild(dateSeparator);
                    }

                    const messageElement = this.createMessageElement(sentMessageData);
                    messageElement.setAttribute('data-date', this.formatDate(messageDate));
                    container.appendChild(messageElement);
                    this.scrollToBottom();
                }

                // Also reload messages to ensure consistency (but UI already updated)
                // await this.loadGroupMessages(this.currentGroupId);
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
     * Add reaction to message
     */
    async addReaction(messageId, emoji) {
        try {
            const response = await fetch(`/api/chat/message/${messageId}/reaction`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify({ emoji }),
            });

            const data = await response.json();
            if (data.success) {
                // Reload messages to show updated reactions
                await this.loadGroupMessages(this.currentGroupId);
            }
        } catch (error) {
            console.error('Failed to add reaction:', error);
        }
    }

    /**
     * Set reply message
     */
    setReplyMessage(messageId, content) {
        this.replyingToMessage = { id: messageId, content: content };

        // Show reply UI
        const replyDiv = document.getElementById('reply-div');
        if (replyDiv) {
            replyDiv.style.display = 'block';
            const replyContent = replyDiv.querySelector('.reply-content');
            if (replyContent) {
                replyContent.textContent = content.substring(0, 50) + (content.length > 50 ? '...' : '');
            }
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
     * Forward message
     */
    forwardMessage(messageId) {
        // Open forward modal
        const modal = document.getElementById('forward-message');
        if (modal) {
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
            // Store message ID for forwarding
            modal.setAttribute('data-message-id', messageId);
        }
    }

    /**
     * Copy message
     */
    copyMessage(messageId) {
        const messageElement = document.querySelector(`[data-message-id="${messageId}"] .message-content`);
        if (messageElement) {
            const text = messageElement.textContent;
            navigator.clipboard.writeText(text).then(() => {
                alert('Message copied to clipboard');
            });
        }
    }

    /**
     * Delete message
     */
    async deleteMessage(messageId) {
        if (!confirm('Are you sure you want to delete this message?')) {
            return;
        }

        try {
            const response = await fetch(`/api/chat/message/${messageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            const data = await response.json();
            if (data.success) {
                // Remove message from UI
                const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
                if (messageElement) {
                    messageElement.remove();
                }
            }
        } catch (error) {
            console.error('Failed to delete message:', error);
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
});

// Update openGroupChat function in notification.blade.php
window.openGroupChat = function (groupId, groupName, photoUrl) {
    if (window.groupChatManager) {
        window.groupChatManager.openGroupChat(groupId, groupName, photoUrl);
    }
};
