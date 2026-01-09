/**
 * Global Notification System for Chat Messages
 * Works across all pages, not just the chat page
 */

class GlobalNotificationManager {
    constructor() {
        this.currentUserId = null;
        this.notificationAudio = null;
        this.pollingInterval = null;
        this.lastCheckedMessages = this.loadLastCheckedMessages(); // Load from localStorage
        this.unreadCounts = {}; // Store unread message counts per group
        this.notifiedMessageIds = new Set(); // Track which messages have already triggered notifications
        this.isPageVisible = true;
        this.initTime = new Date(); // Track when we started to calculate "new" messages
        this.initialLoadComplete = false; // Track if initial load is done
        this.init();
    }

    /**
     * Initialize the notification system
     */
    async init() {
        // Get current user ID
        this.currentUserId = this.getCurrentUserId();
        if (!this.currentUserId) {
            console.warn('Global notifications: User ID not found');
            return;
        }

        // Initialize notification sound
        this.initNotificationSound();

        // Request browser notification permission
        this.requestNotificationPermission();

        // Initialize last checked messages from current state (don't notify about existing messages)
        await this.initializeLastCheckedMessages();

        // Start polling for new messages
        this.startPolling();

        // Handle page visibility changes
        document.addEventListener('visibilitychange', () => {
            this.isPageVisible = !document.hidden;
            if (this.isPageVisible) {
                // Page became visible, check for new messages immediately
                this.checkForNewMessages();
            }
        });

        // Listen for focus events
        window.addEventListener('focus', () => {
            this.checkForNewMessages();
        });

        console.log('✅ Global notification system initialized');
    }

    /**
     * Load last checked messages from localStorage
     */
    loadLastCheckedMessages() {
        try {
            const stored = localStorage.getItem('chat_lastCheckedMessages');
            if (stored) {
                return JSON.parse(stored);
            }
        } catch (error) {
            console.error('Error loading last checked messages from localStorage:', error);
        }
        return {};
    }

    /**
     * Save last checked messages to localStorage
     */
    saveLastCheckedMessages() {
        try {
            localStorage.setItem('chat_lastCheckedMessages', JSON.stringify(this.lastCheckedMessages));
        } catch (error) {
            console.error('Error saving last checked messages to localStorage:', error);
        }
    }

    /**
     * Initialize last checked messages from current groups (don't notify about existing messages)
     */
    async initializeLastCheckedMessages() {
        try {
            const groupsResponse = await fetch('/api/chat/groups', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            if (!groupsResponse.ok) {
                return;
            }

            const groupsData = await groupsResponse.json();
            if (!groupsData.success || !groupsData.groups) {
                return;
            }

            // For each group, get the latest message ID and set it as last checked
            // This prevents notifying about messages that already exist when page loads
            for (const group of groupsData.groups) {
                const groupId = String(group._id || group.id);

                // Only initialize if we don't already have a last checked message for this group
                if (!this.lastCheckedMessages[groupId]) {
                    try {
                        const response = await fetch(`/api/chat/group/${groupId}/messages?limit=1`, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                            },
                        });

                        if (response.ok) {
                            const data = await response.json();
                            if (data.success && data.messages && data.messages.length > 0) {
                                const latestMessage = data.messages[0];
                                const messageId = String(latestMessage._id || latestMessage.id);
                                if (messageId) {
                                    this.lastCheckedMessages[groupId] = messageId;
                                }
                            }
                        }
                    } catch (error) {
                        console.error(`Error initializing last checked message for group ${groupId}:`, error);
                    }
                }
            }

            // Save to localStorage
            this.saveLastCheckedMessages();
            this.initialLoadComplete = true;
        } catch (error) {
            console.error('Error initializing last checked messages:', error);
            this.initialLoadComplete = true;
        }
    }

    /**
     * Get current user ID from meta tag or window variable
     */
    getCurrentUserId() {
        const userIdMeta = document.querySelector('meta[name="user-id"]');
        if (userIdMeta) {
            return String(userIdMeta.content).trim();
        }
        if (window.currentUserId) {
            return String(window.currentUserId).trim();
        }
        return null;
    }

    /**
     * Initialize notification sound
     */
    initNotificationSound() {
        try {
            const audioPaths = [
                '/assets/message_tone.wav',
                'assets/message_tone.wav',
                (window.baseUrl || 'https://logiteam.it-supportline.de') + '/assets/message_tone.wav',
            ];

            for (const audioPath of audioPaths) {
                try {
                    this.notificationAudio = new Audio(audioPath);
                    this.notificationAudio.volume = 0.7;
                    this.notificationAudio.preload = 'auto';
                    break;
                } catch (err) {
                    continue;
                }
            }
        } catch (error) {
            console.error('Failed to initialize notification sound:', error);
        }
    }

    /**
     * Request browser notification permission
     */
    async requestNotificationPermission() {
        if (!('Notification' in window)) {
            console.warn('Browser does not support notifications');
            return;
        }

        if (Notification.permission === 'default') {
            try {
                await Notification.requestPermission();
            } catch (error) {
                console.error('Error requesting notification permission:', error);
            }
        }
    }

    /**
     * Play notification sound
     */
    playNotificationSound() {
        try {
            if (this.notificationAudio) {
                this.notificationAudio.currentTime = 0;
                const playPromise = this.notificationAudio.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.error('Failed to play notification sound:', error);
                    });
                }
            }
        } catch (error) {
            console.error('Error playing notification sound:', error);
        }
    }

    /**
     * Show browser notification
     */
    showBrowserNotification(title, body, groupId, groupName) {
        if (!('Notification' in window)) {
            return;
        }

        if (Notification.permission === 'granted') {
            try {
                const notification = new Notification(title, {
                    body: body,
                    icon: '/build/img/favicon.png',
                    badge: '/build/img/favicon.png',
                    tag: `chat-${groupId}`, // Prevent duplicate notifications
                    requireInteraction: false,
                });

                // Handle notification click
                notification.onclick = () => {
                    window.focus();
                    // Navigate to chat page with the group
                    if (window.location.pathname !== '/chat') {
                        window.location.href = `/chat?group_id=${groupId}&group_name=${encodeURIComponent(groupName)}`;
                    } else if (window.groupChatManager) {
                        // If already on chat page, open the group
                        window.groupChatManager.openGroupChat(groupId, groupName, '');
                    }
                    notification.close();
                };

                // Auto-close after 5 seconds
                setTimeout(() => {
                    notification.close();
                }, 5000);
            } catch (error) {
                console.error('Error showing browser notification:', error);
            }
        }
    }

    /**
     * Update unread message badge
     */
    updateUnreadBadge() {
        const totalUnread = Object.values(this.unreadCounts).reduce((sum, count) => sum + count, 0);

        // Update badge in navigation/header if it exists
        const badgeElements = document.querySelectorAll('.chat-notification-badge, .notification-badge, [data-chat-badge]');
        badgeElements.forEach(badge => {
            if (totalUnread > 0) {
                badge.textContent = totalUnread > 99 ? '99+' : totalUnread;
                badge.style.display = 'inline-block';
            } else {
                badge.style.display = 'none';
            }
        });

        // Update page title
        if (totalUnread > 0) {
            const originalTitle = document.title.replace(/^\(\d+\)\s*/, '');
            document.title = `(${totalUnread}) ${originalTitle}`;
        } else {
            document.title = document.title.replace(/^\(\d+\)\s*/, '');
        }
    }

    /**
     * Check for new messages in all groups
     */
    async checkForNewMessages() {
        if (!this.currentUserId) {
            return;
        }

        // Don't check until initial load is complete (prevents notifying about existing messages on page refresh)
        if (!this.initialLoadComplete) {
            return;
        }

        try {
            // Get all groups the user is a member of
            const groupsResponse = await fetch('/api/chat/groups', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            if (!groupsResponse.ok) {
                return;
            }

            const groupsData = await groupsResponse.json();
            if (!groupsData.success || !groupsData.groups) {
                return;
            }

            // Check each group for new messages
            for (const group of groupsData.groups) {
                const groupId = String(group._id || group.id);
                await this.checkGroupForNewMessages(groupId, group.name || 'Group');
            }
        } catch (error) {
            console.error('Error checking for new messages:', error);
        }
    }

    /**
     * Check a specific group for new messages
     */
    async checkGroupForNewMessages(groupId, groupName) {
        try {
            const lastMessageId = this.lastCheckedMessages[groupId] || '';
            const response = await fetch(`/api/chat/group/${groupId}/messages?last_id=${lastMessageId}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            if (!response.ok) {
                return;
            }

            const data = await response.json();
            if (!data.success || !data.messages || data.messages.length === 0) {
                return;
            }

            // Filter out messages from current user
            const newMessages = data.messages.filter(msg => {
                const senderId = String(msg.sender_id || msg.from_user_id || '');
                return senderId !== this.currentUserId;
            });

            if (newMessages.length > 0) {
                // Check if we're on the chat page and viewing this group
                const isViewingThisGroup = window.location.pathname === '/chat' &&
                    window.groupChatManager &&
                    window.groupChatManager.currentGroupId === groupId;

                if (!isViewingThisGroup) {
                    // Filter out messages we've already notified about
                    const messagesToNotify = newMessages.filter(msg => {
                        const messageId = String(msg._id || msg.id);
                        const notificationKey = `${groupId}-${messageId}`;
                        return !this.notifiedMessageIds.has(notificationKey);
                    });

                    if (messagesToNotify.length > 0) {
                        // We're not viewing this group, show notifications
                        const latestMessage = messagesToNotify[messagesToNotify.length - 1];
                        const messageContent = latestMessage.content || 'New message';
                        const senderName = latestMessage.sender_name || 'Someone';

                        // Mark messages as notified
                        messagesToNotify.forEach(msg => {
                            const messageId = String(msg._id || msg.id);
                            const notificationKey = `${groupId}-${messageId}`;
                            this.notifiedMessageIds.add(notificationKey);
                        });

                        // Only notify if message is newer than initialization time (prevent noise on refresh)
                        const messageTime = new Date(latestMessage.created_at || Date.now());

                        // Check if message is strictly newer than page load
                        if (messageTime > this.initTime) {
                            // Play sound only once for the latest message
                            this.playNotificationSound();

                            // Show browser notification
                            this.showBrowserNotification(
                                `${groupName}`,
                                `${senderName}: ${messageContent.substring(0, 50)}${messageContent.length > 50 ? '...' : ''}`,
                                groupId,
                                groupName
                            );
                        }

                        // Update unread count
                        this.unreadCounts[groupId] = (this.unreadCounts[groupId] || 0) + messagesToNotify.length;
                        this.updateUnreadBadge();
                    }
                }

                // Update last checked message ID
                const latestMessageId = newMessages[newMessages.length - 1]._id || newMessages[newMessages.length - 1].id;
                this.lastCheckedMessages[groupId] = String(latestMessageId);
                // Save to localStorage
                this.saveLastCheckedMessages();
            }
        } catch (error) {
            console.error(`Error checking group ${groupId} for new messages:`, error);
        }
    }

    /**
     * Start polling for new messages
     */
    startPolling() {
        // Stop any existing polling
        this.stopPolling();

        // Poll every 5 seconds for new messages
        this.pollingInterval = setInterval(() => {
            // Only check if initial load is complete
            if (this.initialLoadComplete) {
                this.checkForNewMessages();
            }
        }, 5000); // Poll every 5 seconds

        // Don't check immediately - wait for initial load to complete
        // This prevents notifying about existing messages on page load
        setTimeout(() => {
            if (this.initialLoadComplete) {
                this.checkForNewMessages();
            }
        }, 2000); // Wait 2 seconds after page load

        console.log('🔄 Started polling for new messages');
    }

    /**
     * Stop polling
     */
    stopPolling() {
        if (this.pollingInterval) {
            clearInterval(this.pollingInterval);
            this.pollingInterval = null;
        }
    }

    /**
     * Mark group as read (clear unread count)
     */
    markGroupAsRead(groupId) {
        if (this.unreadCounts[groupId]) {
            delete this.unreadCounts[groupId];
            this.updateUnreadBadge();
        }
    }

    /**
     * Clear all unread counts
     */
    clearAllUnread() {
        this.unreadCounts = {};
        this.updateUnreadBadge();
    }
}

// Initialize global notification manager when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        if (window.currentUserId || document.querySelector('meta[name="user-id"]')) {
            window.globalNotificationManager = new GlobalNotificationManager();
        }
    });
} else {
    if (window.currentUserId || document.querySelector('meta[name="user-id"]')) {
        window.globalNotificationManager = new GlobalNotificationManager();
    }
}

