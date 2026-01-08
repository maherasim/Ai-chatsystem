/**
 * Global Chat Notifications System
 * Works on all pages to notify users of new messages
 */

class GlobalChatNotifications {
    constructor() {
        this.currentUserId = null;
        this.lastMessageIds = {}; // Track last message ID per group
        this.pollingInterval = null;
        this.notificationSound = null;
        this.unreadCounts = {}; // Track unread counts per group
        this.totalUnreadCount = 0;
        this.isOnChatPage = false;
        this.notificationPermission = null;
        
        this.init();
    }

    /**
     * Initialize the notification system
     */
    async init() {
        // Get current user ID
        this.currentUserId = this.getCurrentUserId();
        
        // Initialize notification sound
        this.initNotificationSound();
        
        // Request notification permission
        this.requestNotificationPermission();
        
        // Check if we're on the chat page
        this.isOnChatPage = window.location.pathname.includes('/chat');
        
        // Start polling for new messages
        this.startPolling();
        
        // Update badge on page load
        this.updateUnreadBadge();
        
        console.log('Global chat notifications initialized');
    }

    /**
     * Get current user ID from various sources
     */
    getCurrentUserId() {
        // Try meta tag first
        const userIdMeta = document.querySelector('meta[name="user-id"]');
        if (userIdMeta) {
            return String(userIdMeta.content).trim();
        }
        
        // Try window variable
        if (window.currentUserId) {
            return String(window.currentUserId).trim();
        }
        
        // Try from groupChatManager if available
        if (window.groupChatManager && window.groupChatManager.currentUserId) {
            return String(window.groupChatManager.currentUserId).trim();
        }
        
        return null;
    }

    /**
     * Initialize notification sound
     */
    initNotificationSound() {
        try {
            const soundPaths = [
                '/assets/message_tone.wav',
                'assets/message_tone.wav',
                window.baseUrl ? `${window.baseUrl}/assets/message_tone.wav` : null,
            ].filter(Boolean);
            
            this.notificationSound = new Audio(soundPaths[0]);
            this.notificationSound.volume = 0.7;
            this.notificationSound.preload = 'auto';
            
            this.notificationSound.addEventListener('error', () => {
                console.warn('Failed to load notification sound from:', soundPaths[0]);
                if (soundPaths[1]) {
                    this.notificationSound = new Audio(soundPaths[1]);
                    this.notificationSound.volume = 0.7;
                }
            });
        } catch (error) {
            console.warn('Failed to initialize notification sound:', error);
        }
    }

    /**
     * Request browser notification permission
     */
    async requestNotificationPermission() {
        if (!('Notification' in window)) {
            console.log('This browser does not support notifications');
            return;
        }

        if (Notification.permission === 'granted') {
            this.notificationPermission = 'granted';
            return;
        }

        if (Notification.permission !== 'denied') {
            // Don't request automatically - wait for user interaction
            // User can grant permission when they receive first notification
            this.notificationPermission = Notification.permission;
        }
    }

    /**
     * Show browser notification
     */
    showBrowserNotification(title, message, groupId, groupName) {
        if (!('Notification' in window)) {
            return;
        }

        if (Notification.permission === 'granted') {
            const notification = new Notification(title, {
                body: message,
                icon: '/build/img/favicon.png',
                badge: '/build/img/favicon.png',
                tag: `chat-${groupId}`, // Prevent duplicate notifications
                requireInteraction: false,
            });

            // Handle notification click
            notification.onclick = () => {
                window.focus();
                // Navigate to chat page with group
                if (groupId) {
                    window.location.href = `/chat?group_id=${groupId}&group_name=${encodeURIComponent(groupName || 'Chat')}`;
                } else {
                    window.location.href = '/chat';
                }
                notification.close();
            };

            // Auto close after 5 seconds
            setTimeout(() => {
                notification.close();
            }, 5000);
        } else if (Notification.permission !== 'denied') {
            // Request permission on first notification attempt
            Notification.requestPermission().then(permission => {
                this.notificationPermission = permission;
                if (permission === 'granted') {
                    this.showBrowserNotification(title, message, groupId, groupName);
                }
            });
        }
    }

    /**
     * Play notification sound
     */
    playNotificationSound() {
        try {
            if (this.notificationSound) {
                this.notificationSound.currentTime = 0;
                const playPromise = this.notificationSound.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.warn('Failed to play notification sound:', error);
                    });
                }
            }
        } catch (error) {
            console.warn('Error playing notification sound:', error);
        }
    }

    /**
     * Start polling for new messages
     */
    startPolling() {
        // Stop any existing polling
        this.stopPolling();

        // Poll every 5 seconds for new messages
        this.pollingInterval = setInterval(async () => {
            await this.checkForNewMessages();
        }, 5000);

        console.log('Started global polling for new messages');
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
     * Check for new messages across all groups
     */
    async checkForNewMessages() {
        if (!this.currentUserId) {
            // Try to get user ID again
            this.currentUserId = this.getCurrentUserId();
            if (!this.currentUserId) {
                return;
            }
        }

        try {
            // Get all groups user is part of
            const response = await fetch('/api/chat/groups', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            if (!response.ok) {
                return;
            }

            const data = await response.json();
            
            if (!data.success || !data.groups) {
                return;
            }

            // Check for new messages in each group
            for (const group of data.groups) {
                const groupId = String(group._id || group.id || '');
                if (!groupId) continue;

                await this.checkGroupForNewMessages(groupId, group.name || 'Group');
            }

            // Update badge after checking all groups
            this.updateUnreadBadge();
        } catch (error) {
            console.error('Failed to check for new messages:', error);
        }
    }

    /**
     * Check a specific group for new messages
     */
    async checkGroupForNewMessages(groupId, groupName) {
        try {
            const lastMessageId = this.lastMessageIds[groupId] || '';
            const response = await fetch(`/api/chat/group/${groupId}/messages?last_id=${lastMessageId}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            if (!response.ok) {
                return;
            }

            const data = await response.json();

            if (data.success && data.messages && data.messages.length > 0) {
                // Filter messages from other users
                const newMessages = data.messages.filter(msg => {
                    const senderId = String(msg.sender_id || msg.from_user_id || '').trim();
                    const currentUserIdStr = String(this.currentUserId || '').trim();
                    return senderId !== '' && currentUserIdStr !== '' && 
                           senderId !== currentUserIdStr && 
                           senderId.toLowerCase() !== currentUserIdStr.toLowerCase();
                });

                if (newMessages.length > 0) {
                    // Update last message ID
                    const latestMessage = newMessages[newMessages.length - 1];
                    this.lastMessageIds[groupId] = latestMessage._id || latestMessage.id;

                    // Update unread count for this group
                    if (!this.unreadCounts[groupId]) {
                        this.unreadCounts[groupId] = 0;
                    }
                    this.unreadCounts[groupId] += newMessages.length;

                    // Only notify if not on chat page or if on chat page but different group
                    const isCurrentGroup = window.groupChatManager && 
                                          window.groupChatManager.currentGroupId === groupId;
                    
                    if (!this.isOnChatPage || !isCurrentGroup) {
                        // Get the latest message for notification
                        const latestMsg = newMessages[newMessages.length - 1];
                        const senderName = latestMsg.sender_name || 'Someone';
                        const messagePreview = latestMsg.content ? 
                            (latestMsg.content.length > 50 ? 
                                latestMsg.content.substring(0, 50) + '...' : 
                                latestMsg.content) : 
                            'New message';

                        // Show browser notification
                        this.showBrowserNotification(
                            `${senderName} in ${groupName}`,
                            messagePreview,
                            groupId,
                            groupName
                        );

                        // Play sound
                        this.playNotificationSound();
                    }
                } else {
                    // Update last message ID even if no new messages from others
                    const latestMessage = data.messages[data.messages.length - 1];
                    this.lastMessageIds[groupId] = latestMessage._id || latestMessage.id;
                }
            }
        } catch (error) {
            console.error(`Failed to check group ${groupId} for new messages:`, error);
        }
    }

    /**
     * Update unread badge on chat icon
     */
    updateUnreadBadge() {
        // Calculate total unread count
        this.totalUnreadCount = Object.values(this.unreadCounts).reduce((sum, count) => sum + count, 0);

        // Find chat icon in sidebar
        const chatLinks = document.querySelectorAll('a[href*="chat"]');
        
        chatLinks.forEach(link => {
            // Remove existing badge
            const existingBadge = link.querySelector('.chat-unread-badge');
            if (existingBadge) {
                existingBadge.remove();
            }

            // Add badge if there are unread messages
            if (this.totalUnreadCount > 0) {
                const badge = document.createElement('span');
                badge.className = 'chat-unread-badge';
                badge.textContent = this.totalUnreadCount > 99 ? '99+' : this.totalUnreadCount;
                badge.style.cssText = `
                    position: absolute;
                    top: -5px;
                    right: -5px;
                    background-color: #ef4444;
                    color: white;
                    border-radius: 10px;
                    min-width: 20px;
                    height: 20px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 11px;
                    font-weight: 600;
                    padding: 0 6px;
                    border: 2px solid white;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                    z-index: 1000;
                `;
                
                // Make parent position relative if not already
                if (getComputedStyle(link.parentElement).position === 'static') {
                    link.parentElement.style.position = 'relative';
                }
                
                link.style.position = 'relative';
                link.appendChild(badge);
            }
        });
    }

    /**
     * Mark messages as read for a group
     */
    markGroupAsRead(groupId) {
        if (this.unreadCounts[groupId]) {
            delete this.unreadCounts[groupId];
            this.updateUnreadBadge();
        }
    }

    /**
     * Initialize last message IDs from current groups
     */
    async initializeLastMessageIds() {
        try {
            const response = await fetch('/api/chat/groups', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            if (!response.ok) {
                return;
            }

            const data = await response.json();
            
            if (data.success && data.groups) {
                for (const group of data.groups) {
                    const groupId = String(group._id || group.id || '');
                    if (!groupId) continue;

                    // Get last message for this group
                    const msgResponse = await fetch(`/api/chat/group/${groupId}/messages?limit=1`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        },
                    });

                    if (msgResponse.ok) {
                        const msgData = await msgResponse.json();
                        if (msgData.success && msgData.messages && msgData.messages.length > 0) {
                            const lastMsg = msgData.messages[msgData.messages.length - 1];
                            this.lastMessageIds[groupId] = lastMsg._id || lastMsg.id;
                        }
                    }
                }
            }
        } catch (error) {
            console.error('Failed to initialize last message IDs:', error);
        }
    }
}

// Initialize global notifications when DOM is ready
let globalChatNotifications = null;

document.addEventListener('DOMContentLoaded', () => {
    // Only initialize if not on auth pages
    if (!window.location.pathname.includes('signin') && 
        !window.location.pathname.includes('signup') && 
        !window.location.pathname.includes('forgot-password') &&
        !window.location.pathname.includes('reset-password')) {
        
        globalChatNotifications = new GlobalChatNotifications();
        
        // Initialize last message IDs after a short delay
        setTimeout(() => {
            if (globalChatNotifications) {
                globalChatNotifications.initializeLastMessageIds();
            }
        }, 2000);
    }
});

// Cleanup on page unload
window.addEventListener('beforeunload', () => {
    if (globalChatNotifications) {
        globalChatNotifications.stopPolling();
    }
});

// Pause/resume polling based on page visibility
document.addEventListener('visibilitychange', () => {
    if (globalChatNotifications) {
        if (document.hidden) {
            // Page is hidden, can reduce polling frequency or pause
            // For now, we'll keep polling but could optimize later
        } else {
            // Page is visible, ensure polling is active
            if (!globalChatNotifications.pollingInterval) {
                globalChatNotifications.startPolling();
            }
            // Check for new messages immediately
            globalChatNotifications.checkForNewMessages();
        }
    }
});

// Export for use in other scripts
window.globalChatNotifications = globalChatNotifications;

