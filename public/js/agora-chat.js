/**
 * Agora Chat Integration
 * Dynamic Real-Time Chat System using Agora Chat SDK
 */

class AgoraChatManager {
    constructor() {
        this.client = null;
        this.currentUserId = null;
        this.currentToken = null;
        this.appId = null;
        this.currentConversationId = null;
        this.isConnected = false;
        this.messageHandlers = [];
        this.typingUsers = new Set();
    }

    /**
     * Initialize Agora Chat
     */
    async init() {
        try {
            // Get token from backend
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

            this.currentUserId = data.user_id;
            this.currentToken = data.token;
            this.appId = data.app_id;

            // Initialize Agora Chat SDK
            // Note: You need to include Agora Chat SDK in your HTML:
            // <script src="https://download.agora.io/sdk/release/AgoraChat-sdk-Web.js"></script>
            
            if (typeof AgoraChat !== 'undefined') {
                this.client = AgoraChat.createInstance({
                    appKey: this.appId,
                });

                // Login to Agora
                await this.client.open({
                    user: this.currentUserId,
                    agoraToken: this.currentToken,
                });

                this.isConnected = true;
                this.setupEventListeners();
                
                console.log('Agora Chat initialized successfully');
                return true;
            } else {
                console.error('Agora Chat SDK not loaded. Please include AgoraChat SDK script.');
                return false;
            }
        } catch (error) {
            console.error('Failed to initialize Agora Chat:', error);
            return false;
        }
    }

    /**
     * Setup event listeners
     */
    setupEventListeners() {
        if (!this.client) return;

        // Message received
        this.client.addEventHandler('messageHandler', {
            onTextMessage: (message) => {
                this.handleMessageReceived(message);
            },
            onPictureMessage: (message) => {
                this.handleMessageReceived(message);
            },
            onFileMessage: (message) => {
                this.handleMessageReceived(message);
            },
            onAudioMessage: (message) => {
                this.handleMessageReceived(message);
            },
            onVideoMessage: (message) => {
                this.handleMessageReceived(message);
            },
            onCustomMessage: (message) => {
                this.handleMessageReceived(message);
            },
            onPresenceMessage: (message) => {
                // Handle presence updates (online/offline)
                this.handlePresenceUpdate(message);
            },
            onReadMessage: (message) => {
                // Handle read receipts
                this.handleReadReceipt(message);
            },
        });

        // Connection status
        this.client.addEventHandler('connectionHandler', {
            onConnected: () => {
                console.log('Connected to Agora Chat');
                this.isConnected = true;
            },
            onDisconnected: () => {
                console.log('Disconnected from Agora Chat');
                this.isConnected = false;
            },
            onTokenWillExpire: () => {
                console.log('Token will expire, refreshing...');
                this.refreshToken();
            },
            onTokenDidExpire: () => {
                console.log('Token expired, refreshing...');
                this.refreshToken();
            },
        });
    }

    /**
     * Send text message
     */
    async sendTextMessage(toUserId, content, conversationId = null) {
        if (!this.isConnected || !this.client) {
            throw new Error('Not connected to Agora Chat');
        }

        try {
            // Generate conversation ID if not provided
            if (!conversationId) {
                conversationId = this.generateConversationId(this.currentUserId, toUserId);
            }

            // Create text message
            const msg = AgoraChat.message.create({
                type: 'txt',
                to: toUserId,
                msg: content,
                chatType: 'singleChat', // or 'groupChat' for group
            });

            // Send message
            const result = await this.client.send(msg);

            // Save message to backend database
            await this.saveMessageToBackend({
                message_id: result.id || result.serverMsgId,
                conversation_id: conversationId,
                to_user_id: toUserId,
                message_type: 'txt',
                content: content,
            });

            return result;
        } catch (error) {
            console.error('Failed to send message:', error);
            throw error;
        }
    }

    /**
     * Send file message (image, file, audio, video)
     */
    async sendFileMessage(toUserId, file, messageType = 'img', conversationId = null) {
        if (!this.isConnected || !this.client) {
            throw new Error('Not connected to Agora Chat');
        }

        try {
            // Upload file to backend first
            const formData = new FormData();
            formData.append('file', file);
            formData.append('type', messageType);

            const uploadResponse = await fetch('/api/chat/upload-file', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: formData,
            });

            const uploadData = await uploadResponse.json();
            
            if (!uploadData.success) {
                throw new Error('Failed to upload file');
            }

            // Generate conversation ID if not provided
            if (!conversationId) {
                conversationId = this.generateConversationId(this.currentUserId, toUserId);
            }

            // Create file message based on type
            let msgType = messageType;
            let msgOptions = {
                type: msgType,
                to: toUserId,
                chatType: 'singleChat',
            };

            if (messageType === 'img') {
                msgOptions.url = uploadData.file_url;
                msgOptions.filename = uploadData.file_name;
                msgOptions.width = uploadData.width;
                msgOptions.height = uploadData.height;
            } else if (messageType === 'file') {
                msgOptions.url = uploadData.file_url;
                msgOptions.filename = uploadData.file_name;
                msgOptions.file_length = uploadData.file_size;
            } else if (messageType === 'audio') {
                msgOptions.url = uploadData.file_url;
                msgOptions.length = uploadData.duration || 0;
            } else if (messageType === 'video') {
                msgOptions.url = uploadData.file_url;
                msgOptions.filename = uploadData.file_name;
                msgOptions.length = uploadData.duration || 0;
                msgOptions.thumb = uploadData.thumbnail_url;
            }

            const msg = AgoraChat.message.create(msgOptions);
            const result = await this.client.send(msg);

            // Save message to backend
            await this.saveMessageToBackend({
                message_id: result.id || result.serverMsgId,
                conversation_id: conversationId,
                to_user_id: toUserId,
                message_type: messageType,
                content: messageType === 'img' ? 'Image' : uploadData.file_name,
                file_url: uploadData.file_url,
                file_name: uploadData.file_name,
                file_size: uploadData.file_size,
            });

            return result;
        } catch (error) {
            console.error('Failed to send file message:', error);
            throw error;
        }
    }

    /**
     * Save message to backend database
     */
    async saveMessageToBackend(messageData) {
        try {
            await fetch('/api/chat/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify(messageData),
            });
        } catch (error) {
            console.error('Failed to save message to backend:', error);
        }
    }

    /**
     * Handle received message
     */
    handleMessageReceived(message) {
        // Trigger message handlers
        this.messageHandlers.forEach(handler => {
            handler(message);
        });

        // Emit custom event
        const event = new CustomEvent('agora:message', { detail: message });
        document.dispatchEvent(event);
    }

    /**
     * Handle presence update
     */
    handlePresenceUpdate(message) {
        const event = new CustomEvent('agora:presence', { detail: message });
        document.dispatchEvent(event);
    }

    /**
     * Handle read receipt
     */
    handleReadReceipt(message) {
        const event = new CustomEvent('agora:read', { detail: message });
        document.dispatchEvent(event);
    }

    /**
     * Add message handler
     */
    onMessage(handler) {
        this.messageHandlers.push(handler);
    }

    /**
     * Load conversation messages from backend
     */
    async loadConversationMessages(conversationId, limit = 50, beforeMessageId = null) {
        try {
            let url = `/api/chat/conversation/${conversationId}/messages?limit=${limit}`;
            if (beforeMessageId) {
                url += `&before_message_id=${beforeMessageId}`;
            }

            const response = await fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            const data = await response.json();
            return data.messages || [];
        } catch (error) {
            console.error('Failed to load messages:', error);
            return [];
        }
    }

    /**
     * Get or create conversation with user
     */
    async getConversation(otherUserId) {
        try {
            const response = await fetch(`/api/chat/conversation/user/${otherUserId}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Failed to get conversation:', error);
            return null;
        }
    }

    /**
     * Mark messages as read
     */
    async markAsRead(conversationId) {
        try {
            await fetch(`/api/chat/conversation/${conversationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });
        } catch (error) {
            console.error('Failed to mark as read:', error);
        }
    }

    /**
     * Delete message
     */
    async deleteMessage(messageId) {
        try {
            await fetch(`/api/chat/message/${messageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });
        } catch (error) {
            console.error('Failed to delete message:', error);
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
            return data;
        } catch (error) {
            console.error('Failed to add reaction:', error);
            return null;
        }
    }

    /**
     * Refresh token
     */
    async refreshToken() {
        try {
            const response = await fetch('/api/chat/token');
            const data = await response.json();
            
            if (data.success && this.client) {
                this.currentToken = data.token;
                // Renew token in SDK
                await this.client.renewToken(this.currentToken);
            }
        } catch (error) {
            console.error('Failed to refresh token:', error);
        }
    }

    /**
     * Generate conversation ID
     */
    generateConversationId(userId1, userId2) {
        const ids = [String(userId1), String(userId2)].sort();
        return ids.join('_');
    }

    /**
     * Disconnect
     */
    async disconnect() {
        if (this.client) {
            await this.client.close();
            this.isConnected = false;
        }
    }
}

// Global instance
window.agoraChatManager = new AgoraChatManager();

