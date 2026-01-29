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
        this.notificationAudio = null;
        this.pollingInterval = null;
        this.lastMessageId = null;
        this.notifiedMessageIds = new Set(); // Track which messages have already triggered notifications
        this.groupMembers = []; // Store group members for mentions
        this.mentionStartPos = null; // Track @ mention start position
        this.mentionDropdown = null; // Mention dropdown element
        this.selectedMentionIndex = -1; // Selected mention index
        this.unreadBadgeInterval = null; // Interval for polling unread counts
        this.onlineMembersInterval = null; // Interval for refreshing online members in header
        this.initNotificationSound();
    }

    /**
     * Show chat loader
     */
    showLoader() {
        const loader = document.getElementById('chatLoader');
        if (loader) {
            loader.classList.add('active');
        }
    }

    /**
     * Hide chat loader
     */
    hideLoader() {
        const loader = document.getElementById('chatLoader');
        if (loader) {
            loader.classList.remove('active');
        }
    }

    /**
     * Initialize notification sound
     */
    initNotificationSound() {
        try {
            // Try multiple paths
            const audioPaths = [
                '/assets/message_tone.wav',
                'assets/message_tone.wav',
                (window.baseUrl || 'https://logiteam.it-supportline.de') + '/assets/message_tone.wav',
            ];

            for (const audioPath of audioPaths) {
                try {
                    this.notificationAudio = new Audio(audioPath);
                    this.notificationAudio.volume = 0.7; // Set volume to 70%
                    this.notificationAudio.preload = 'auto';

                    // Test if audio can be loaded
                    this.notificationAudio.addEventListener('canplaythrough', () => {
                        console.log('✅ Notification sound loaded successfully:', audioPath);
                    });

                    this.notificationAudio.addEventListener('error', (e) => {
                        console.warn('Audio path failed:', audioPath, e);
                        // Try next path
                        if (audioPaths.indexOf(audioPath) < audioPaths.length - 1) {
                            return; // Will try next path
                        }
                    });

                    // If we got here without error, this path works
                    break;
                } catch (err) {
                    console.warn('Failed to create audio with path:', audioPath, err);
                    continue;
                }
            }
        } catch (error) {
            console.error('Failed to initialize notification sound:', error);
        }
    }

    /**
     * Play notification sound
     */
    playNotificationSound() {
        try {
            if (this.notificationAudio) {
                // Reset audio to beginning and play
                this.notificationAudio.currentTime = 0;
                const playPromise = this.notificationAudio.play();

                if (playPromise !== undefined) {
                    playPromise
                        .then(() => {
                            console.log('🔔 Notification sound played');
                        })
                        .catch(error => {
                            console.error('Failed to play notification sound:', error);
                            // Try to reload and play
                            this.notificationAudio.load();
                            this.notificationAudio.play().catch(e => {
                                console.error('Retry also failed:', e);
                            });
                        });
                }
            } else {
                console.warn('Notification audio not initialized');
            }
        } catch (error) {
            console.error('Error playing notification sound:', error);
        }
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

                // Setup reaction click handlers
                this.setupReactionClickHandlers();

                console.log('Agora Chat initialized successfully');

                // Start updating unread badges periodically
                this.startUnreadBadgePolling();

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

            // Setup reaction click handlers even if Agora fails
            this.setupReactionClickHandlers();

            return false;
        }
    }

    /**
     * Setup global event delegation for reaction items
     */
    setupReactionClickHandlers() {
        // Use event delegation for reaction items (handles dynamically added reactions)
        // Check if already set up to avoid duplicates
        if (this._reactionHandlersSetup) return;
        this._reactionHandlersSetup = true;

        document.addEventListener('click', (e) => {
            const reactionItem = e.target.closest('.reaction-item');
            if (reactionItem) {
                e.stopPropagation();
                e.preventDefault();
                const messageId = reactionItem.dataset.messageId;
                const emoji = reactionItem.dataset.emoji;
                if (messageId && emoji) {
                    console.log('Reaction clicked:', { messageId, emoji });
                    this.showReactionUsers(messageId, emoji);
                }
            }
        }, true); // Use capture phase to catch early
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
        if (!this.agoraClient) {
            console.warn('Agora client not available, cannot setup event listeners');
            return;
        }

        console.log('Setting up Agora event listeners...');

        // Message received handlers - for group chat
        // Accept all messages and filter in handleMessageReceived if needed
        this.agoraClient.addEventHandler('messageHandler', {
            onTextMessage: (message) => {
                console.log('📩 Text message received from Agora:', message);
                // For group chat, accept all messages - filtering will happen in handleMessageReceived
                this.handleMessageReceived(message);
            },
            onPictureMessage: (message) => {
                console.log('📩 Picture message received from Agora:', message);
                this.handleMessageReceived(message);
            },
            onFileMessage: (message) => {
                console.log('📩 File message received from Agora:', message);
                this.handleMessageReceived(message);
            },
            onAudioMessage: (message) => {
                console.log('📩 Audio message received from Agora:', message);
                this.handleMessageReceived(message);
            },
            onVideoMessage: (message) => {
                console.log('📩 Video message received from Agora:', message);
                this.handleMessageReceived(message);
            },
            onCustomMessage: (message) => {
                console.log('📩 Custom message received from Agora:', message);
                this.handleMessageReceived(message);
            },
        });

        // Connection status handlers
        this.agoraClient.addEventHandler('connectionHandler', {
            onConnected: () => {
                console.log('✅ Connected to Agora Chat');
                this.isConnected = true;
            },
            onDisconnected: () => {
                console.log('❌ Disconnected from Agora Chat');
                this.isConnected = false;
            },
            onTokenWillExpire: () => {
                console.warn('⚠️ Token will expire soon');
            },
            onTokenDidExpire: () => {
                console.error('❌ Token expired');
                this.isConnected = false;
            },
        });

        console.log('✅ Agora event listeners set up successfully');
    }

    /**
     * Open group chat
     */
    async openGroupChat(groupId, groupName, photoUrl) {
        // Clear notified messages when switching groups to allow notifications for new group
        if (this.currentGroupId !== groupId) {
            this.notifiedMessageIds.clear();
        }

        this.currentGroupId = groupId;
        this.currentGroupName = groupName;
        this.currentGroupPhoto = photoUrl;

        // Clear unread count badge for this group
        this.updateGroupUnreadBadge(groupId, 0);

        // Show loader
        this.showLoader();

        // Hide empty state
        const emptyState = document.getElementById('emptyChatState');
        if (emptyState) {
            emptyState.style.display = 'none';
        }

        try {
            // Load group members for mentions
            await this.loadGroupMembers();

            // Setup mention handler after a small delay to ensure DOM is ready
            setTimeout(() => {
                this.setupMentionHandler();
            }, 100);

            // Update chat header
            this.updateChatHeader(groupName, photoUrl);

            // Update contact info panel
            await this.updateContactInfo(groupId);
            
            // Load online members for the header (call loadAllUsers from chat.blade.php)
            if (typeof window.loadAllUsers === 'function') {
                setTimeout(() => {
                    window.loadAllUsers();
                }, 500); // Small delay to ensure DOM is ready
            }
            
            // Refresh online members periodically (every 30 seconds)
            // NOTE: Online members are now handled by loadAllUsers() in chat.blade.php
            // Disabled to prevent duplicate display
            // if (this.onlineMembersInterval) {
            //     clearInterval(this.onlineMembersInterval);
            // }
            // // Load immediately
            // this.loadOnlineMembersInHeader();
            // // Then refresh periodically
            // this.onlineMembersInterval = setInterval(() => {
            //     if (this.currentGroupId) {
            //         this.loadOnlineMembersInHeader();
            //     } else {
            //         // Clear interval if no group is open
            //         if (this.onlineMembersInterval) {
            //             clearInterval(this.onlineMembersInterval);
            //             this.onlineMembersInterval = null;
            //         }
            //     }
            // }, 30000);

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

            // Load existing messages (this will mark them as read on backend)
            await this.loadGroupMessages(groupId);

            // Update unread badges after loading messages (count should be 0 now)
            this.updateAllGroupUnreadBadges();

            // Load media for this group (don't await to avoid blocking)
            if (groupId) {
                this.loadGroupMedia(groupId).catch(err => {
                    console.error('Failed to load group media:', err);
                });
                // Load favorites when opening a group (non-blocking, optional)
                if (typeof this.loadFavorites === 'function') {
                    setTimeout(() => {
                        this.loadFavorites(groupId).catch(err => {
                            console.error('Failed to load favorites:', err);
                        });
                    }, 500); // Delay to not interfere with main loading
                }
            }
        } finally {
            // Hide loader after everything is loaded
            this.hideLoader();
        }

        // Join group chat room (if needed)
        if (this.agoraClient && this.isConnected && this.currentGroupId) {
            console.log('✅ Ready to receive messages for group:', groupId);
            console.log('Agora connection status:', {
                isConnected: this.isConnected,
                currentUserId: this.currentUserId,
                currentGroupId: this.currentGroupId
            });
        } else {
            console.warn('⚠️ Agora not ready:', {
                hasClient: !!this.agoraClient,
                isConnected: this.isConnected,
                currentGroupId: this.currentGroupId
            });
        }

        // Start polling as fallback if Agora is not working
        this.startMessagePolling();

        // Set last message ID from loaded messages
        const container = document.getElementById('chatMessagesContainer');
        if (container) {
            const lastMessage = container.querySelector('.chats:last-child');
            if (lastMessage) {
                this.lastMessageId = lastMessage.getAttribute('data-message-id');
            }
        }
    }

    /**
     * Start polling for unread badge counts
     */
    startUnreadBadgePolling() {
        // Update badges every 10 seconds
        if (this.unreadBadgeInterval) {
            clearInterval(this.unreadBadgeInterval);
        }

        // Update immediately
        this.updateAllGroupUnreadBadges();

        // Then update every 10 seconds
        this.unreadBadgeInterval = setInterval(() => {
            this.updateAllGroupUnreadBadges();
        }, 10000);
    }

    /**
     * Stop polling for unread badge counts
     */
    stopUnreadBadgePolling() {
        if (this.unreadBadgeInterval) {
            clearInterval(this.unreadBadgeInterval);
            this.unreadBadgeInterval = null;
        }
    }

    /**
     * Start polling for new messages (fallback if Agora fails)
     */
    startMessagePolling() {
        // Stop any existing polling
        this.stopMessagePolling();

        if (!this.currentGroupId) return;

        console.log('🔄 Starting message polling for group:', this.currentGroupId);

        // Poll every 3 seconds for new messages
        this.pollingInterval = setInterval(async () => {
            if (!this.currentGroupId) {
                this.stopMessagePolling();
                return;
            }

            try {
                // When polling, mark new messages as read since user is actively viewing the chat
                const response = await fetch(`/api/chat/group/${this.currentGroupId}/messages?last_id=${this.lastMessageId || ''}&mark_as_read=true`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                });

                const data = await response.json();

                if (data.success && data.messages && data.messages.length > 0) {
                    // Update unread badges immediately when new messages are received via polling
                    this.updateAllGroupUnreadBadges();

                    // Filter out messages we already have
                    const newMessages = data.messages.filter(msg => {
                        const msgId = String(msg._id || msg.id);
                        const agoraMsgId = msg.message_id; // Check for Agora ID

                        // Check if message exists by Backend ID
                        const existingById = document.querySelector(`[data-message-id="${msgId}"]`);

                        // Check if message exists by Agora ID (if available)
                        const existingByAgoraId = agoraMsgId ? document.querySelector(`[data-message-id="${agoraMsgId}"]`) : null;

                        // Also check if we already have this Agora ID in our notified set
                        const alreadyNotified = agoraMsgId ? this.notifiedMessageIds.has(agoraMsgId) : false;

                        return !existingById && !existingByAgoraId && !alreadyNotified;
                    });

                    if (newMessages.length > 0) {
                        console.log(`📥 Polling found ${newMessages.length} new messages`);

                        // Update unread badges immediately when new messages are found via polling
                        this.updateAllGroupUnreadBadges();

                        // Enrich with sender info
                        const enrichedMessages = await this.enrichMessagesWithSenderInfo(newMessages);

                        // Add new messages to UI
                        enrichedMessages.forEach((message, index) => {
                            const messageId = String(message._id || message.id);
                            const senderId = String(message.sender_id || message.from_user_id || '');
                            const currentUserIdStr = String(this.currentUserId || window.currentUserId || '').trim();
                            const isOwnMessage = senderId !== '' && currentUserIdStr !== '' &&
                                (senderId === currentUserIdStr || senderId.toLowerCase() === currentUserIdStr.toLowerCase());

                            // Play sound for received messages only once per message
                            if (!isOwnMessage && !this.notifiedMessageIds.has(messageId)) {
                                this.playNotificationSound();
                                this.notifiedMessageIds.add(messageId);
                            }

                            const messageElement = this.createMessageElement(message);
                            const container = document.getElementById('chatMessagesContainer');
                            if (container) {
                                const emptyState = document.getElementById('emptyChatState');
                                if (emptyState) {
                                    emptyState.style.display = 'none';
                                }

                                // Check if we need to add a date separator
                                const lastMessage = container.lastElementChild;
                                let messageDate;
                                try {
                                    messageDate = message.created_at ? new Date(message.created_at) : new Date();
                                    if (isNaN(messageDate.getTime())) {
                                        messageDate = new Date();
                                    }
                                } catch (error) {
                                    messageDate = new Date();
                                }

                                const dateStr = this.formatDate(messageDate);

                                if (lastMessage && lastMessage.classList.contains('chats')) {
                                    const lastMessageDate = lastMessage.getAttribute('data-date');
                                    if (lastMessageDate !== dateStr) {
                                        const dateSeparator = document.createElement('div');
                                        dateSeparator.className = 'chat-line';
                                        dateSeparator.innerHTML = `<span class="chat-date">${dateStr}</span>`;
                                        container.appendChild(dateSeparator);
                                    }
                                } else if (lastMessage && lastMessage.classList.contains('chat-line')) {
                                    const lastDateText = lastMessage.querySelector('.chat-date')?.textContent;
                                    if (lastDateText !== dateStr) {
                                        const dateSeparator = document.createElement('div');
                                        dateSeparator.className = 'chat-line';
                                        dateSeparator.innerHTML = `<span class="chat-date">${dateStr}</span>`;
                                        container.appendChild(dateSeparator);
                                    }
                                } else {
                                    const dateSeparator = document.createElement('div');
                                    dateSeparator.className = 'chat-line';
                                    dateSeparator.innerHTML = `<span class="chat-date">${dateStr}</span>`;
                                    container.appendChild(dateSeparator);
                                }

                                messageElement.setAttribute('data-date', dateStr);
                                container.appendChild(messageElement);
                            }

                            // Update last message ID
                            this.lastMessageId = messageId;
                        });

                        // Scroll to bottom after all new messages are added
                        if (enrichedMessages.length > 0) {
                            this.forceScrollToBottom();
                        }

                        // Update global notification manager's last checked message for this group
                        if (this.currentGroupId && enrichedMessages.length > 0) {
                            const latestMessageId = String(enrichedMessages[enrichedMessages.length - 1]._id || enrichedMessages[enrichedMessages.length - 1].id);
                            if (window.globalNotificationManager) {
                                window.globalNotificationManager.lastCheckedMessages[this.currentGroupId] = latestMessageId;
                                window.globalNotificationManager.saveLastCheckedMessages();
                            }
                        }
                    }
                }
            } catch (error) {
                console.error('Error polling for messages:', error);
            }
        }, 3000); // Poll every 3 seconds
    }

    /**
     * Stop message polling
     */
    stopMessagePolling() {
        if (this.pollingInterval) {
            clearInterval(this.pollingInterval);
            this.pollingInterval = null;
            console.log('🛑 Stopped message polling');
        }
        
        // Clear online members interval (but don't remove the container - it should persist)
        if (this.onlineMembersInterval) {
            clearInterval(this.onlineMembersInterval);
            this.onlineMembersInterval = null;
        }
    }

    /**
     * Clear online members from header (called when leaving/closing group)
     */
    clearOnlineMembersFromHeader() {
        const onlineMembersContainer = document.getElementById('headerOnlineMembers');
        if (onlineMembersContainer) {
            onlineMembersContainer.remove();
            console.log('👥 [Online Members] Cleared online members from header');
        }
    }

    /**
     * Update chat header with group name and photo
     */
    updateChatHeader(groupName, photoUrl, userType = null) {
        // Update group name
        const headerName = document.getElementById('chatHeaderName') || document.querySelector('.user-details h6');
        if (headerName) {
            headerName.textContent = groupName;
        }

        // Update group avatar
        const headerAvatar = document.getElementById('chatHeaderAvatar') || document.querySelector('.user-details .avatar img');
        if (headerAvatar && photoUrl) {
            headerAvatar.src = photoUrl;
            headerAvatar.alt = groupName || 'Group';
        }

        // Update user type if provided
        if (userType) {
            const headerType = document.getElementById('chatHeaderType') || document.querySelector('.user-details .last-seen');
            if (headerType) {
                // Capitalize first letter
                const displayType = userType.charAt(0).toUpperCase() + userType.slice(1);
                headerType.textContent = displayType;
            }
        }

        // Load and display online members in the header
        // NOTE: Online members are now handled by loadAllUsers() in chat.blade.php
        // Disabled to prevent duplicate display
        // this.loadOnlineMembersInHeader();
    }

    /**
     * Load and display online members in the chat header
     */
    async loadOnlineMembersInHeader() {
        console.log('👥 [Online Members] Loading online members for chat header...');
        try {
            // Get current group ID - required for fetching members
            const groupId = this.currentGroupId;
            if (!groupId) {
                console.log('👥 [Online Members] No group selected, skipping member load');
                return;
            }
            
            const url = `/api/chat/all-users?group_id=${groupId}`;
            
            const response = await fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            if (!response.ok) {
                throw new Error('Failed to fetch users');
            }

            const data = await response.json();
            
            if (data.success && data.members && data.members.length > 0) {
                // Filter only online members
                const onlineMembers = data.members.filter(member => member.is_online === true);
                console.log(`👥 [Online Members] Found ${onlineMembers.length} online member(s) out of ${data.members.length} total`);
                
                // Get the user-details container in the header
                const userDetailsContainer = document.querySelector('.chat-header .user-details');
                if (!userDetailsContainer) {
                    console.warn('👥 [Online Members] Chat header user-details container not found');
                    return;
                }

                // Find or create online members container
                let onlineMembersContainer = document.getElementById('headerOnlineMembers');
                if (!onlineMembersContainer) {
                    console.log('👥 [Online Members] Creating new container in header');
                    // Create container after the group name/avatar section
                    onlineMembersContainer = document.createElement('div');
                    onlineMembersContainer.id = 'headerOnlineMembers';
                    onlineMembersContainer.style.cssText = 'display: flex; gap: 8px; align-items: center; margin-left: 16px; padding-left: 16px; border-left: 1px solid #e0e0e0;';
                    
                    // Insert after the user info section (the div with ms-2 class)
                    const userInfoSection = userDetailsContainer.querySelector('.ms-2');
                    if (userInfoSection && userInfoSection.parentElement) {
                        userInfoSection.parentElement.insertBefore(onlineMembersContainer, userInfoSection.nextSibling);
                        console.log('👥 [Online Members] Container inserted after user info section');
                    } else {
                        // Fallback: append to user-details container
                        userDetailsContainer.appendChild(onlineMembersContainer);
                        console.log('👥 [Online Members] Container appended to user-details (fallback)');
                    }
                    
                    // Set up a MutationObserver to detect if container is removed and recreate it
                    const observer = new MutationObserver((mutations) => {
                        mutations.forEach((mutation) => {
                            mutation.removedNodes.forEach((node) => {
                                if (node === onlineMembersContainer || (node.nodeType === 1 && node.id === 'headerOnlineMembers')) {
                                    console.warn('👥 [Online Members] Container was removed! Recreating...');
                                    // Recreate after a short delay
                                    setTimeout(() => {
                                        if (!document.getElementById('headerOnlineMembers') && this.currentGroupId) {
                                            console.log('👥 [Online Members] Recreating container after removal');
                                            this.loadOnlineMembersInHeader();
                                        }
                                    }, 100);
                                }
                            });
                        });
                    });
                    
                    // Observe the parent for removals
                    if (onlineMembersContainer.parentElement) {
                        observer.observe(onlineMembersContainer.parentElement, { childList: true });
                        // Store observer reference to clean up later if needed
                        onlineMembersContainer._observer = observer;
                    }
                } else {
                    console.log('👥 [Online Members] Using existing container in header');
                }

                // Always clear and rebuild to ensure fresh data
                onlineMembersContainer.innerHTML = '';

                if (onlineMembers.length > 0) {
                    console.log(`👥 [Online Members] Displaying ${onlineMembers.length} online member(s) in header`);
                    
                    // Display each online member
                    onlineMembers.forEach((member, index) => {
                        const memberElement = document.createElement('div');
                        memberElement.style.cssText = 'display: flex; flex-direction: column; align-items: center; cursor: pointer; position: relative;';
                        memberElement.title = member.name || member.email;
                        
                        // Online indicator (green dot)
                        const onlineIndicator = '<div style="position: absolute; bottom: -2px; right: -2px; width: 12px; height: 12px; background: #00c853; border: 2px solid white; border-radius: 50%; z-index: 10;"></div>';
                        
                        memberElement.innerHTML = `
                            <!-- <div style="position: relative; margin-bottom: 4px;">
                                <img src="${member.avatar || '/build/img/profile.svg'}" 
                                     alt="${member.name || member.email}" 
                                     style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #e0e0e0;"
                                     onerror="this.onerror=null; this.src='/build/img/profile.svg';">
                                ${onlineIndicator}
                            </div> -->
                            <span style="font-size: 11px; color: #2e3a59; font-weight: 500; text-align: center; max-width: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; line-height: 1.2;">
                                ${this.escapeHtml(member.name || member.email || 'User')}
                            </span>
                        `;
                        
                        onlineMembersContainer.appendChild(memberElement);
                        console.log(`👥 [Online Members] Added member ${index + 1}/${onlineMembers.length}: ${member.name || member.email}`);
                    });
                    console.log('✅ [Online Members] Successfully displayed all online members in header');
                } else {
                    console.log('👥 [Online Members] No members online, showing empty state');
                    // Show "No members online" message
                    onlineMembersContainer.innerHTML = '<span style="font-size: 12px; color: #7f8ea3;">No members online</span>';
                }
            } else {
                console.warn('👥 [Online Members] No members data received from API');
            }
        } catch (error) {
            console.error('❌ [Online Members] Failed to load online members for header:', error);
        }
    }

    /**
     * Update contact info panel with group details
     */
    async updateContactInfo(groupId) {
        try {
            const response = await fetch(`/api/chat/group/${groupId}/profile`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            const data = await response.json();

            if (data.success && data.group) {
                const group = data.group;

                // Update profile avatar
                const profileAvatar = document.getElementById('contactProfileAvatar');
                if (profileAvatar) {
                    profileAvatar.src = group.photo || window.baseUrl + '/build/img/profiles/avatar-06.jpg';
                    profileAvatar.alt = group.name || 'Group';
                }

                // Update profile name
                const profileName = document.getElementById('contactProfileName');
                if (profileName) {
                    profileName.textContent = group.name || 'Untitled Group';
                }

                // Update status (can show member count or last seen)
                const profileStatus = document.getElementById('contactProfileStatus');
                if (profileStatus) {
                    profileStatus.textContent = `${group.member_count || 0} members`;
                }

                // Update chat header with admin type
                if (group.admin_type) {
                    this.updateChatHeader(group.name || 'Untitled Group', group.photo, group.admin_type);
                }

                // Update contact info details
                const contactInfoName = document.getElementById('contactInfoName');
                if (contactInfoName) {
                    contactInfoName.textContent = group.name || 'Untitled Group';
                }

                const contactInfoEmail = document.getElementById('contactInfoEmail');
                if (contactInfoEmail) {
                    contactInfoEmail.textContent = group.email || '-';
                }

                const contactInfoPhone = document.getElementById('contactInfoPhone');
                if (contactInfoPhone) {
                    contactInfoPhone.textContent = '-'; // Groups don't have phone numbers
                }

                const contactInfoBio = document.getElementById('contactInfoBio');
                if (contactInfoBio) {
                    contactInfoBio.textContent = group.description || group.name || '-';
                }
            } else {
                console.warn('Failed to load group profile:', data);
                // Set default values
                this.resetContactInfo();
            }
        } catch (error) {
            console.error('Failed to update contact info:', error);
            // Set default values on error
            this.resetContactInfo();
        }
    }

    /**
     * Reset contact info to default values
     */
    resetContactInfo() {
        const profileName = document.getElementById('contactProfileName');
        if (profileName) {
            profileName.textContent = 'Select a group';
        }

        const profileStatus = document.getElementById('contactProfileStatus');
        if (profileStatus) {
            profileStatus.textContent = 'Last seen at 07:15 PM';
        }

        const contactInfoName = document.getElementById('contactInfoName');
        if (contactInfoName) {
            contactInfoName.textContent = 'Select a group';
        }

        const contactInfoEmail = document.getElementById('contactInfoEmail');
        if (contactInfoEmail) {
            contactInfoEmail.textContent = '-';
        }

        const contactInfoPhone = document.getElementById('contactInfoPhone');
        if (contactInfoPhone) {
            contactInfoPhone.textContent = '-';
        }

        const contactInfoBio = document.getElementById('contactInfoBio');
        if (contactInfoBio) {
            contactInfoBio.textContent = '-';
        }
    }

    /**
     * Load group messages from backend
     */
    async loadGroupMessages(groupId, showLoader = false) {
        try {
            // Show loader only if explicitly requested (for standalone calls)
            if (showLoader) {
                this.showLoader();
            }

            // Add mark_as_read parameter to mark messages as read when user opens the chat
            const response = await fetch(`/api/chat/group/${groupId}/messages?mark_as_read=true`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            const data = await response.json();

            if (data.success && data.messages) {
                console.log('Loaded messages:', data.messages.length, 'Current user ID:', this.currentUserId);
                // Enrich messages with sender info if needed
                const enrichedMessages = await this.enrichMessagesWithSenderInfo(data.messages);
                this.renderMessages(enrichedMessages);
            } else {
                console.warn('No messages or failed to load:', data);
            }
        } catch (error) {
            console.error('Failed to load group messages:', error);
        } finally {
            // Hide loader only if we showed it
            if (showLoader) {
                this.hideLoader();
            }
        }
    }

    /**
     * Enrich messages with sender information (avatar, name) if missing
     */
    async enrichMessagesWithSenderInfo(messages) {
        const enrichedMessages = await Promise.all(messages.map(async (message) => {
            // If sender_avatar is already present, skip
            if (message.sender_avatar) {
                return message;
            }

            const senderId = String(message.sender_id || message.from_user_id || message.from || '').trim();
            if (!senderId) {
                return message;
            }

            try {
                const userResponse = await fetch(`/api/user/${senderId}/profile`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                });

                if (userResponse.ok) {
                    const userData = await userResponse.json();
                    if (userData.success && userData.user) {
                        message.sender_name = userData.user.name || userData.user.email || message.sender_name;
                        message.sender_avatar = userData.user.avatar || null;
                    }
                }
            } catch (error) {
                console.error(`Failed to fetch sender profile for message ${message._id}:`, error);
            }

            return message;
        }));

        return enrichedMessages;
    }

    /**
     * Render messages dynamically
     */
    renderMessages(messages) {
        const container = document.getElementById('chatMessagesContainer');
        if (!container) return;

        // Clear existing messages
        container.innerHTML = '';

        // Reset last message ID
        this.lastMessageId = null;

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

        // Set last message ID for polling and mark all loaded messages as notified
        if (messages.length > 0) {
            const lastMessage = messages[messages.length - 1];
            this.lastMessageId = String(lastMessage._id || lastMessage.id);

            // Mark all loaded messages as already notified (they're old messages)
            messages.forEach(message => {
                const messageId = String(message._id || message.id);
                if (messageId) {
                    this.notifiedMessageIds.add(messageId);
                }
            });

            // Update global notification manager's last checked message
            // This prevents notifications when navigating away and back
            if (this.currentGroupId && window.globalNotificationManager) {
                window.globalNotificationManager.lastCheckedMessages[this.currentGroupId] = this.lastMessageId;
                window.globalNotificationManager.saveLastCheckedMessages();
            }
        }

        // Scroll to bottom after rendering - use instant scroll for initial load
        this.forceScrollToBottom(false);
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
        try {
            // Handle both Date objects and date strings
            const dateObj = date instanceof Date ? date : new Date(date);

            // Check if date is valid
            if (isNaN(dateObj.getTime())) {
                console.warn('Invalid date provided to formatDate:', date);
                return 'Today'; // Fallback to Today for invalid dates
            }

            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);

            // Reset time to compare dates only
            const dateOnly = new Date(dateObj.getFullYear(), dateObj.getMonth(), dateObj.getDate());
            const todayOnly = new Date(today.getFullYear(), today.getMonth(), today.getDate());
            const yesterdayOnly = new Date(yesterday.getFullYear(), yesterday.getMonth(), yesterday.getDate());

            if (dateOnly.getTime() === todayOnly.getTime()) {
                return 'Today';
            } else if (dateOnly.getTime() === yesterdayOnly.getTime()) {
                return 'Yesterday';
            } else {
                return dateObj.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
            }
        } catch (error) {
            console.error('Error formatting date:', error, date);
            return 'Today'; // Fallback to Today on error
        }
    }

    /**
     * Escape string for use in JavaScript (single quotes)
     */
    escapeJs(str) {
        if (!str) return '';
        return String(str).replace(/\\/g, '\\\\').replace(/'/g, "\\'").replace(/\n/g, '\\n').replace(/\r/g, '\\r');
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
        const messageId = message._id || message.id;
        messageDiv.setAttribute('data-message-id', messageId);

        // Store message data on element for easy access
        messageDiv.__messageData = message;
        if (message.reactions) {
            messageDiv.dataset.reactions = JSON.stringify(message.reactions);
        }

        // Safely parse the date for time display
        let messageTime;
        try {
            const dateObj = message.created_at ? new Date(message.created_at) : new Date();
            if (isNaN(dateObj.getTime())) {
                messageTime = new Date().toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                });
            } else {
                messageTime = dateObj.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                });
            }
        } catch (error) {
            console.warn('Error parsing message time:', error);
            messageTime = new Date().toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
        }

        const time = messageTime;

        let messageContent = '';

        // Helper: caption below media (WhatsApp-style - text in same bubble, clean like WhatsApp)
        const captionHtml = (message.content && String(message.content).trim()) 
            ? `<div class="message-media-caption" style="margin: 0; padding: 8px 12px 10px; font-size: 14px; line-height: 1.45; color: inherit; word-wrap: break-word; text-align: left;">${this.formatMessageWithMentions(message.content)}</div>` 
            : '';

        // WhatsApp-style: time + checkmarks inside the bubble at bottom right
        const bubbleMetaHtml = `<div class="message-bubble-meta" style="display: flex; align-items: center; justify-content: flex-end; gap: 4px; padding: 2px 12px 8px; font-size: 11px; color: inherit; opacity: 0.85;"><span class="chat-time">${time}</span><span class="msg-read success"><i class="ti ti-checks" style="font-size: 12px;"></i></span></div>`;
        const wrapInBubble = (inner) => `<div class="message-content message-bubble-with-media" style="padding: 0; overflow: hidden; max-width: 85%;">${inner}${bubbleMetaHtml}</div>`;

        // Handle different message types (accept 'img' or 'image')
        const isImageMessage = (message.message_type === 'img' || message.message_type === 'image') && message.file_url;
        if (isImageMessage) {
            messageContent = wrapInBubble(`
                <div class="message-content-wrapper" style="position: relative; display: inline-block; max-width: 100%;">
                    <div class="chat-img" style="max-width: 100%; width: 100%;">
                        <div class="img-wrap" style="height: auto !important; min-height: 120px; max-height: 500px; max-width: 100%; flex: none !important;">
                            <img src="${message.file_url}" alt="Image" style="width: 100% !important; height: auto !important; max-width: 100%; max-height: 500px; object-fit: contain !important; object-position: center;">
                            <div class="img-overlay">
                                <a class="chat-view-image-btn" href="javascript:void(0);" data-image-url="${message.file_url}" data-image-name="${message.file_name || 'Image'}" title="View Image">
                                    <i class="ti ti-eye"></i>
                                </a>
                                <a href="${message.file_url}" download><i class="ti ti-download"></i></a>
                            </div>
                        </div>
                    </div>
                    ${captionHtml}
                </div>
            `);
        } else if (message.message_type === 'file' && message.file_url) {
            const fileInfo = this.getFileTypeInfo(message.file_name || 'file');
            messageContent = wrapInBubble(`
                <div class="message-content-wrapper" style="position: relative; display: inline-block;">
                    <div class="file-attach-professional" style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 12px; padding: 16px; display: flex; align-items: center; gap: 16px; max-width: 400px; transition: all 0.3s ease;">
                    <div class="file-icon-wrapper" style="width: 56px; height: 56px; border-radius: 12px; background: ${fileInfo.bgColor}; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        <i class="${fileInfo.icon}" style="font-size: 28px; color: ${fileInfo.color};"></i>
                    </div>
                    <div class="file-info" style="flex: 1; min-width: 0;">
                        <div class="file-name" style="font-weight: 600; font-size: 14px; color: #212529; margin-bottom: 4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; line-height: 1.4;">
                            ${this.escapeHtml(message.file_name || 'File')}
                        </div>
                        <div class="file-meta" style="display: flex; align-items: center; gap: 12px; font-size: 12px; color: #6c757d;">
                            <span class="file-size">${this.formatFileSize(message.file_size || 0)}</span>
                            <span class="file-type-badge" style="background: ${fileInfo.badgeColor}; color: ${fileInfo.badgeTextColor}; padding: 2px 8px; border-radius: 4px; font-weight: 500; font-size: 11px;">
                                ${fileInfo.extension.toUpperCase()}
                            </span>
                        </div>
                    </div>
                    <div class="file-actions" style="display: flex; flex-direction: column; gap: 8px; flex-shrink: 0;">
                        <a href="${message.file_url}" download class="download-btn" style="width: 36px; height: 36px; border-radius: 8px; background: #6338F6; color: #fff; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(99, 56, 246, 0.2);" title="Download">
                            <i class="ti ti-download" style="font-size: 16px;"></i>
                        </a>
                        <a href="${message.file_url}" target="_blank" class="view-btn" style="width: 36px; height: 36px; border-radius: 8px; background: #e9ecef; color: #495057; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s ease;" title="Open in new tab">
                            <i class="ti ti-external-link" style="font-size: 16px;"></i>
                        </a>
                    </div>
                </div>
                ${captionHtml}
                </div>
            `);
        } else if (message.message_type === 'audio' && message.file_url) {
            messageContent = wrapInBubble(`
                <div class="message-content-wrapper" style="position: relative; display: inline-block; max-width: 100%;">
                    <div class="message-content bg-transparent p-0">
                        <div class="message-audio">
                            <audio controls>
                                <source src="${message.file_url}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    ${captionHtml}
                </div>
            `);
        } else {
            // Text message with reply support
            let replySection = '';
            if (message.replied_to_message) {
                // WhatsApp-like reply UI with boxed view
                // Different styles for sent (own) vs received messages
                const isOwn = isOwnMessage;
                const barColor = isOwn ? '#4FC3F7' : '#4FC3F7'; // Teal/cyan bar for both
                const senderNameColor = isOwn ? '#4FC3F7' : '#4FC3F7'; // Lighter green for sent, blue for received
                const contentColor = isOwn ? '#212529' : '#212529'; // White for sent, dark for received
                const bgColor = isOwn ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.05)'; // Subtle background
                
                replySection = `
                    <div class="message-reply-container" style="border-left: 3px solid ${barColor}; background: ${bgColor}; padding: 6px 8px; margin-bottom: 6px; border-radius: 4px; text-align: left; max-width: 280px;">
                        <div style="font-weight: 600; font-size: 13px; color: ${senderNameColor}; margin-bottom: 2px; line-height: 1.3;">
                            ${this.escapeHtml(message.replied_to_message.sender_name || 'User')}
                        </div>
                        <div style="font-size: 13px; color: ${contentColor}; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; line-height: 1.3;">
                            ${this.formatMessageWithMentions(message.replied_to_message.content || '')}
                        </div>
                    </div>
                `;
            }

            messageContent = `
                ${replySection}
                <div class="message-content-wrapper" style="position: relative; display: inline-block; width: auto; max-width: 100%;">
                    <div class="message-content">
                        ${this.formatMessageWithMentions(message.content || '')}
                    </div>
                </div>
            `;
        }

        // Reactions - handle array format: [{user_id, emoji, created_at}, ...]
        // Group reactions by emoji and store full data for "who reacted" feature
        let reactionsHtml = '';
        let reactionsByEmoji = {}; // Store full reaction data grouped by emoji

        if (message.reactions && Array.isArray(message.reactions) && message.reactions.length > 0) {
            // Group reactions by emoji and store full data
            message.reactions.forEach(reaction => {
                const emoji = reaction.emoji || reaction;
                if (!reactionsByEmoji[emoji]) {
                    reactionsByEmoji[emoji] = [];
                }
                reactionsByEmoji[emoji].push(reaction);
            });

            // Build reactions HTML - positioned ON the message bubble (WhatsApp style)
            if (Object.keys(reactionsByEmoji).length > 0) {
                const isOwn = isOwnMessage;
                const positionStyle = isOwn
                    ? 'bottom: -8px; right: 8px;'
                    : 'bottom: -8px; left: 8px;';

                reactionsHtml = `<div class="message-reactions" style="position: absolute; ${positionStyle} display: flex; gap: 4px; flex-wrap: wrap; align-items: center; z-index: 1000; max-width: 200px; pointer-events: auto;">`;
                Object.entries(reactionsByEmoji).forEach(([emoji, reactions]) => {
                    const count = reactions.length;
                    const escapedEmoji = this.escapeHtml(emoji);
                    const messageId = message._id || message.id;
                    const messageIdStr = String(messageId);
                    reactionsHtml += `<div class="reaction-item" data-message-id="${messageIdStr}" data-emoji="${escapedEmoji}" style="background: #ffffff; border: 1px solid #e0e0e0; border-radius: 12px; padding: 0px 6px; display: flex; align-items: center; gap: 4px; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.1); transition: all 0.2s; position: relative; z-index: 1001;" title="Click to see who reacted">
                        <span style="font-size: 14px;">${emoji}</span>
                        <span style="font-size: 11px; color: #666; font-weight: 500;">${count}</span>
                    </div>`;
                });
                reactionsHtml += '</div>';
            }
        }

        // Structure for LEFT side (received messages): Avatar first, then content
        // Structure for RIGHT side (sent messages): Content first, then avatar
        if (isOwnMessage) {
            // RIGHT SIDE: Sent messages (content first, avatar last)
            messageDiv.innerHTML = `
                <div class="chat-content">
                    <div class="chat-info" style="display: flex; flex-direction: row; align-items: center; gap: 8px; justify-content: flex-end;">
                        <div class="chat-actions" style="position: relative; display: flex; z-index: 100;">
                            <a class="#" href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; color: #6c757d; text-decoration: none; cursor: pointer;">
                                <i class="ti ti-dots-vertical" style="font-size: 18px;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); event.stopPropagation(); window.groupChatManager.showEmojiPicker('${message._id || message.id}'); return false;">
                                    <i class="ti ti-mood-smile me-2"></i>React
                                </a></li>
                                <li><a class="dropdown-item reply-btn" href="javascript:void(0);" onclick="window.groupChatManager.setReplyMessage('${this.escapeJs(message._id || message.id)}', '${this.escapeJs(message.content || '')}', '${this.escapeJs(isOwnMessage ? 'You' : (message.sender_name || 'User'))}', '${this.escapeJs(isOwnMessage ? (window.currentUserAvatar || '') : (message.sender_avatar || ''))}')">
                                    <i class="ti ti-corner-up-left me-2"></i>Reply
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.groupChatManager.forwardMessage('${message._id || message.id}')">
                                    <i class="ti ti-pinned me-2"></i>Forward
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.groupChatManager.copyMessage('${message._id || message.id}')">
                                    <i class="ti ti-file-export me-2"></i>Copy
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); event.stopPropagation(); window.groupChatManager.createTodoFromMessage('${message._id || message.id}', '${this.escapeHtml(message.content || '')}'); return false;">
                                    <i class="ti ti-checklist me-2"></i>Todo
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.groupChatManager.deleteMessage('${message._id || message.id}')" data-bs-toggle="modal" data-bs-target="#message-delete">
                                    <i class="ti ti-trash me-2"></i>Delete
                                </a></li>
                            </ul>
                        </div>
                        <div style="position: relative; display: inline-block;">
                            ${messageContent}
                            ${reactionsHtml}
                        </div>
                    </div>
                    <div class="chat-time-status" style="text-align: right; margin-top: 2px; line-height: 1; font-size: 11px; color: #adb5bd; display: flex; align-items: center; justify-content: flex-end; gap: 4px;">
                        <span class="chat-time">${time}</span>
                        <span class="msg-read success"><i class="ti ti-checks" style="font-size: 12px;"></i></span>
                    </div>
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
                    <div class="chat-profile-name" style="margin-bottom: 2px;">
                        <h6 style="font-size: 13px; font-weight: 600; color: #495057; margin-bottom: 0;">
                            ${message.sender_name || 'User'}
                        </h6>
                    </div>
                    <div class="chat-info" style="display: flex; flex-direction: row; align-items: flex-start; gap: 8px; justify-content: flex-start;">
                        <div style="position: relative; display: inline-block;">
                            ${messageContent}
                            ${reactionsHtml}
                        </div>
                        <div class="chat-actions" style="position: relative; display: flex; z-index: 100;">
                            <a class="#" href="#" data-bs-toggle="dropdown" style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; color: #6c757d; text-decoration: none; cursor: pointer;">
                                <i class="ti ti-dots-vertical" style="font-size: 18px;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); event.stopPropagation(); window.groupChatManager.showEmojiPicker('${message._id || message.id}'); return false;">
                                    <i class="ti ti-mood-smile me-2"></i>React
                                </a></li>
                                <li><a class="dropdown-item reply-btn" href="javascript:void(0);" onclick="window.groupChatManager.setReplyMessage('${this.escapeJs(message._id || message.id)}', '${this.escapeJs(message.content || '')}', '${this.escapeJs(isOwnMessage ? 'You' : (message.sender_name || 'User'))}', '${this.escapeJs(isOwnMessage ? (window.currentUserAvatar || '') : (message.sender_avatar || ''))}')">
                                    <i class="ti ti-corner-up-left me-2"></i>Reply
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.groupChatManager.forwardMessage('${message._id || message.id}')">
                                    <i class="ti ti-pinned me-2"></i>Forward
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="window.groupChatManager.copyMessage('${message._id || message.id}')">
                                    <i class="ti ti-file-export me-2"></i>Copy
                                </a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); event.stopPropagation(); window.groupChatManager.createTodoFromMessage('${message._id || message.id}', '${this.escapeHtml(message.content || '')}'); return false;">
                                    <i class="ti ti-checklist me-2"></i>Todo
                                </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="chat-time-status" style="text-align: left; margin-top: 2px; line-height: 1; font-size: 11px; color: #adb5bd; display: flex; align-items: center; justify-content: flex-start; gap: 4px;">
                        <span class="chat-time">${time}</span>
                        <span class="msg-read success"><i class="ti ti-checks" style="font-size: 12px;"></i></span>
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
        console.log('📨 Handling received message:', message);

        // Check if this is a group chat message and if it's for the current group
        const messageGroupId = message.to || message.targetId || '';
        const isGroupChat = message.chatType === 'groupChat' || message.type === 'groupChat';

        // If we have a current group and this is a group message, check if it's for our group
        if (this.currentGroupId && isGroupChat) {
            // Check various possible group ID formats
            const groupIdMatches =
                messageGroupId === this.currentGroupId ||
                messageGroupId === `group_${this.currentGroupId}` ||
                messageGroupId === `group_${this.currentGroupId}` ||
                message.to === this.currentGroupId;

            if (!groupIdMatches) {
                console.log('⚠️ Message is for a different group, ignoring:', {
                    messageGroupId,
                    currentGroupId: this.currentGroupId
                });
                return; // Ignore messages not for current group
            }
        }

        // Check if message is from current user (don't play sound for own messages)
        const senderId = String(message.from || message.from_user_id || '');
        const currentUserIdStr = String(this.currentUserId || window.currentUserId || '').trim();
        const isOwnMessage = senderId !== '' && currentUserIdStr !== '' &&
            (senderId === currentUserIdStr || senderId.toLowerCase() === currentUserIdStr.toLowerCase());

        console.log('Message details:', {
            senderId,
            currentUserId: currentUserIdStr,
            isOwnMessage,
            messageType: message.type || message.message_type,
            chatType: message.chatType,
            to: message.to,
            messageGroupId,
            currentGroupId: this.currentGroupId
        });

        // Fetch sender's profile information for avatar
        let senderAvatar = null;
        let senderName = message.from || 'User';

        if (!isOwnMessage && senderId) {
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
        }

        // Play notification sound only for received messages (not own messages) and only once per message
        const messageId = String(message.id || message.serverMsgId || message._id || '');
        if (!isOwnMessage && messageId && !this.notifiedMessageIds.has(messageId)) {
            console.log('🔔 Playing notification sound for received message');
            this.playNotificationSound();
            this.notifiedMessageIds.add(messageId);
        }

        // Add message to UI (include file_url for image/file/audio/video from Agora)
        const msgType = message.type || message.message_type || 'txt';
        const messageData = {
            _id: message.id || message.serverMsgId || message._id,
            sender_id: senderId,
            content: message.msg || message.content || message.body?.content || '',
            message_type: msgType,
            created_at: message.time || message.timestamp || new Date().toISOString(),
            sender_name: senderName,
            sender_avatar: senderAvatar,
        };
        if (message.url) {
            messageData.file_url = message.url;
            messageData.file_name = message.filename || message.fileName || (msgType === 'img' ? 'Image' : 'File');
            messageData.file_size = message.file_length || message.fileSize || 0;
        }

        console.log('📝 Adding message to UI:', messageData);

        const messageElement = this.createMessageElement(messageData);
        const container = document.getElementById('chatMessagesContainer');
        if (container) {
            // Hide empty state
            const emptyState = document.getElementById('emptyChatState');
            if (emptyState) {
                emptyState.style.display = 'none';
            }

            // Check if we need to add a date separator
            const lastMessage = container.lastElementChild;

            // Safely parse the date
            let messageDate;
            try {
                messageDate = messageData.created_at ? new Date(messageData.created_at) : new Date();
                if (isNaN(messageDate.getTime())) {
                    console.warn('Invalid date in messageData.created_at:', messageData.created_at);
                    messageDate = new Date(); // Fallback to current date
                    messageData.created_at = messageDate.toISOString(); // Update with valid date
                }
            } catch (error) {
                console.warn('Error parsing message date:', error);
                messageDate = new Date(); // Fallback to current date
                messageData.created_at = messageDate.toISOString(); // Update with valid date
            }

            // Use formatDate method for consistent date formatting
            const dateStr = this.formatDate(messageDate);

            if (lastMessage && lastMessage.classList.contains('chats')) {
                const lastMessageDate = lastMessage.getAttribute('data-date');
                if (lastMessageDate === dateStr) {
                    // Same date, no separator needed
                } else {
                    const dateSeparator = document.createElement('div');
                    dateSeparator.className = 'chat-line';
                    dateSeparator.innerHTML = `<span class="chat-date">${dateStr}</span>`;
                    container.appendChild(dateSeparator);
                }
            } else if (lastMessage && lastMessage.classList.contains('chat-line')) {
                // Last element is a date separator, check if same date
                const lastDateText = lastMessage.querySelector('.chat-date')?.textContent;
                if (lastDateText !== dateStr) {
                    const dateSeparator = document.createElement('div');
                    dateSeparator.className = 'chat-line';
                    dateSeparator.innerHTML = `<span class="chat-date">${dateStr}</span>`;
                    container.appendChild(dateSeparator);
                }
            } else {
                // No messages yet or no date separator, add date separator
                const dateSeparator = document.createElement('div');
                dateSeparator.className = 'chat-line';
                dateSeparator.innerHTML = `<span class="chat-date">${dateStr}</span>`;
                container.appendChild(dateSeparator);
            }

            messageElement.setAttribute('data-date', dateStr);
            container.appendChild(messageElement);

            // Update last message ID
            this.lastMessageId = String(messageData._id || messageData.id || '');

            // Force scroll when adding new messages
            this.forceScrollToBottom();

            // Update unread badges immediately when message is received
            // If message is for current group (user is viewing it), badge should be 0
            // If message is for different group, badge should increment
            if (messageGroupId) {
                if (messageGroupId === this.currentGroupId || messageGroupId === `group_${this.currentGroupId}`) {
                    // Message is for current group - update to ensure badge is 0 (messages are marked as read when viewing)
                    setTimeout(() => {
                        this.updateAllGroupUnreadBadges();
                    }, 200);
                } else {
                    // Message is for different group - update immediately to show new count
                    this.updateAllGroupUnreadBadges();
                }
            } else {
                // No group ID, update all badges
                this.updateAllGroupUnreadBadges();
            }

            console.log('✅ Message added to UI successfully');
        } else {
            console.error('❌ Chat messages container not found');
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
                // Map messageType to backend expected type
                let backendType = messageType;
                if (messageType === 'img') {
                    backendType = 'image';
                }
                formData.append('type', backendType);
                formData.append('group_id', this.currentGroupId);

                const uploadResponse = await fetch('/api/chat/upload-file', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                    body: formData,
                });

                // Check if response is JSON
                const contentType = uploadResponse.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await uploadResponse.text();
                    console.error('Upload response is not JSON:', text.substring(0, 200));
                    throw new Error('Server returned an error. Please check file size and format.');
                }

                const uploadData = await uploadResponse.json();
                if (uploadData.success) {
                    messageData.file_url = uploadData.file_url;
                    messageData.file_name = uploadData.file_name;
                    messageData.file_size = uploadData.file_size;
                } else {
                    throw new Error(uploadData.message || 'File upload failed');
                }
            }

            let agoraMessageId = null;

            // Send via Agora if connected
            if (this.agoraClient && this.isConnected) {
                try {
                    let msgOptions = {
                        type: messageType,
                        to: this.currentGroupId,
                        chatType: 'groupChat',
                    };

                    // Handle file messages differently
                    if (messageType === 'img' && messageData.file_url) {
                        msgOptions.url = messageData.file_url;
                        msgOptions.filename = messageData.file_name;
                    } else if (messageType === 'file' && messageData.file_url) {
                        msgOptions.url = messageData.file_url;
                        msgOptions.filename = messageData.file_name;
                        msgOptions.file_length = messageData.file_size;
                    } else if (messageType === 'audio' && messageData.file_url) {
                        msgOptions.url = messageData.file_url;
                        msgOptions.length = 0; // Duration if available
                    } else if (messageType === 'video' && messageData.file_url) {
                        msgOptions.url = messageData.file_url;
                        msgOptions.filename = messageData.file_name;
                        msgOptions.length = 0; // Duration if available
                    } else {
                        // Text message
                        msgOptions.msg = content;
                    }

                    const msg = AgoraChat.message.create(msgOptions);
                    agoraMessageId = msg.id; // Capture Agora Message ID

                    console.log('📤 Sending message via Agora:', {
                        to: this.currentGroupId,
                        type: messageType,
                        content: messageType === 'txt' ? content.substring(0, 50) + '...' : messageData.file_name,
                        id: agoraMessageId
                    });

                    await this.agoraClient.send(msg);
                    console.log('✅ Message sent via Agora successfully');
                } catch (error) {
                    console.error('❌ Failed to send message via Agora:', error);
                }
            } else {
                console.warn('⚠️ Agora not connected, message will only be saved to backend');
            }

            // Save to backend
            messageData.message_id = agoraMessageId; // Add message_id to backend payload
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

                // Ensure created_at is set and valid
                if (!sentMessageData.created_at) {
                    sentMessageData.created_at = new Date().toISOString();
                }

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

                    // Safely parse the date
                    let messageDate;
                    try {
                        messageDate = sentMessageData.created_at ? new Date(sentMessageData.created_at) : new Date();
                        if (isNaN(messageDate.getTime())) {
                            console.warn('Invalid date in sentMessageData.created_at:', sentMessageData.created_at);
                            messageDate = new Date(); // Fallback to current date
                            sentMessageData.created_at = messageDate.toISOString(); // Update with valid date
                        }
                    } catch (error) {
                        console.warn('Error parsing sent message date:', error);
                        messageDate = new Date(); // Fallback to current date
                        sentMessageData.created_at = messageDate.toISOString(); // Update with valid date
                    }

                    // Use formatDate method for consistent date formatting
                    const dateStr = this.formatDate(messageDate);

                    if (lastMessage && lastMessage.classList.contains('chats')) {
                        const lastMessageDate = lastMessage.getAttribute('data-date');
                        if (lastMessageDate === dateStr) {
                            // Same date, no separator needed
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
                        if (lastDateText !== dateStr) {
                            const dateSeparator = document.createElement('div');
                            dateSeparator.className = 'chat-line';
                            dateSeparator.innerHTML = `<span class="chat-date">${dateStr}</span>`;
                            container.appendChild(dateSeparator);
                        }
                    } else {
                        // No messages yet or no date separator, add date separator
                        const dateSeparator = document.createElement('div');
                        dateSeparator.className = 'chat-line';
                        dateSeparator.innerHTML = `<span class="chat-date">${dateStr}</span>`;
                        container.appendChild(dateSeparator);
                    }

                    const messageElement = this.createMessageElement(sentMessageData);
                    messageElement.setAttribute('data-date', dateStr);
                    container.appendChild(messageElement);
                    // Force scroll when sending messages
                    this.forceScrollToBottom();

                    // Update unread badges immediately after sending a message
                    // If sent to current group, badge should stay at 0 (we're viewing it)
                    // If sent to different group, update all badges
                    setTimeout(() => {
                        this.updateAllGroupUnreadBadges();
                    }, 300); // Small delay to ensure message is saved on backend
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
     * Update unread count badge for a group in the sidebar
     */
    updateGroupUnreadBadge(groupId, count) {
        const groupCard = document.querySelector(`[data-group-id="${groupId}"]`);
        if (!groupCard) return;

        let badge = groupCard.querySelector('.group-unread-badge');

        if (count > 0) {
            if (!badge) {
                // Create badge if it doesn't exist
                badge = document.createElement('span');
                badge.className = 'group-unread-badge';
                badge.style.cssText = 'position: absolute; top: -5px; right: -5px; background: #dc3545; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 600; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.2); z-index: 10;';

                // Find the profile image container to attach badge
                const profileImg = groupCard.querySelector('div[style*="margin-top: -20px"]');
                if (profileImg) {
                    profileImg.appendChild(badge);
                } else {
                    // Fallback: attach to group card
                    groupCard.appendChild(badge);
                }
            }
            badge.textContent = count > 99 ? '99+' : count;
            badge.style.display = 'flex';
        } else {
            // Remove badge if count is 0
            if (badge) {
                badge.remove();
            }
        }
    }

    /**
     * Update all group unread badges
     */
    async updateAllGroupUnreadBadges() {
        try {
            // Check if user is authenticated before making API call
            const response = await fetch('/api/chat/groups/unread-counts', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                cache: 'no-cache', // Ensure fresh data
                credentials: 'same-origin',
            });

            // Handle 401 Unauthorized - user not authenticated
            if (response.status === 401) {
                // Silently fail - user is not logged in
                return;
            }

            if (!response.ok) {
                return;
            }

            const data = await response.json();
            if (data.success && data.unread_counts) {
                // Update each group's badge
                Object.keys(data.unread_counts).forEach(groupId => {
                    const count = data.unread_counts[groupId];
                    this.updateGroupUnreadBadge(groupId, count);
                });
            }
        } catch (error) {
            // Silently handle errors - don't log to avoid console spam
            // This can happen if user is not authenticated or network issues
        }
    }

    /**
     * Update unread badge for a specific group immediately
     * This is called when we know a message was received for a specific group
     */
    async updateGroupUnreadBadgeImmediate(groupId) {
        try {
            const response = await fetch('/api/chat/groups/unread-counts', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                cache: 'no-cache',
            });

            if (!response.ok) {
                return;
            }

            const data = await response.json();
            if (data.success && data.unread_counts && data.unread_counts[groupId] !== undefined) {
                const count = data.unread_counts[groupId];
                this.updateGroupUnreadBadge(groupId, count);
            }
        } catch (error) {
            console.error('Failed to update unread badge for group:', error);
        }
    }

    /**
     * Show emoji picker dropdown for a message
     */
    showEmojiPicker(messageId) {
        // Close any other open emoji pickers
        document.querySelectorAll('.emoj-group-list').forEach(list => {
            if (list.closest('[data-message-id]')?.getAttribute('data-message-id') !== messageId) {
                list.style.display = 'none';
                list.classList.remove('emoji-picker-shown');
            }
        });

        // Find the message element
        const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
        if (!messageElement) {
            console.warn('Message element not found for:', messageId);
            return;
        }

        // Find or create the emoji picker
        let emojiList = messageElement.querySelector('.emoj-group-list');
        
        if (!emojiList) {
            // Create emoji picker dynamically
            const chatActions = messageElement.querySelector('.chat-actions');
            if (!chatActions) {
                console.warn('Chat actions not found for message:', messageId);
                return;
            }
            
            emojiList = document.createElement('div');
            emojiList.className = 'emoj-group-list';
            emojiList.setAttribute('data-message-id', messageId);
            emojiList.style.cssText = 'z-index: 10000 !important; position: absolute; bottom: calc(100% + 8px); right: 0; background: #fff; border: 1px solid #e0e0e0; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.15); padding: 12px 10px; display: none; margin-bottom: 5px; opacity: 1 !important; visibility: visible !important; width: fit-content; min-width: fit-content; box-sizing: border-box;';
            
            emojiList.innerHTML = `
                <ul style="display: flex; padding: 0; margin: 0; list-style: none; gap: 6px; align-items: center; justify-content: center; width: 100%; flex-wrap: nowrap; box-sizing: border-box;">
                    <li style="list-style: none; margin: 0; padding: 0;"><a href="javascript:void(0);" onclick="event.stopPropagation(); window.groupChatManager.addReaction('${messageId}', '👍'); return false;" class="emoji-picker-item" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; padding: 0; border-radius: 8px; transition: all 0.2s ease; background: transparent; text-decoration: none; cursor: pointer;">
                        <span style="font-size: 28px; display: inline-block; line-height: 1; user-select: none;">👍</span>
                    </a></li>
                    <li style="list-style: none; margin: 0; padding: 0;"><a href="javascript:void(0);" onclick="event.stopPropagation(); window.groupChatManager.addReaction('${messageId}', '❤️'); return false;" class="emoji-picker-item" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; padding: 0; border-radius: 8px; transition: all 0.2s ease; background: transparent; text-decoration: none; cursor: pointer;">
                        <span style="font-size: 28px; display: inline-block; line-height: 1; user-select: none;">❤️</span>
                    </a></li>
                    <li style="list-style: none; margin: 0; padding: 0;"><a href="javascript:void(0);" onclick="event.stopPropagation(); window.groupChatManager.addReaction('${messageId}', '😄'); return false;" class="emoji-picker-item" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; padding: 0; border-radius: 8px; transition: all 0.2s ease; background: transparent; text-decoration: none; cursor: pointer;">
                        <span style="font-size: 28px; display: inline-block; line-height: 1; user-select: none;">😄</span>
                    </a></li>
                    <li style="list-style: none; margin: 0; padding: 0;"><a href="javascript:void(0);" onclick="event.stopPropagation(); window.groupChatManager.addReaction('${messageId}', '😮'); return false;" class="emoji-picker-item" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; padding: 0; border-radius: 8px; transition: all 0.2s ease; background: transparent; text-decoration: none; cursor: pointer;">
                        <span style="font-size: 28px; display: inline-block; line-height: 1; user-select: none;">😮</span>
                    </a></li>
                    <li style="list-style: none; margin: 0; padding: 0;"><a href="javascript:void(0);" onclick="event.stopPropagation(); window.groupChatManager.addReaction('${messageId}', '😢'); return false;" class="emoji-picker-item" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; padding: 0; border-radius: 8px; transition: all 0.2s ease; background: transparent; text-decoration: none; cursor: pointer;">
                        <span style="font-size: 28px; display: inline-block; line-height: 1; user-select: none;">😢</span>
                    </a></li>
                </ul>
            `;
            
            // Ensure chat-actions has relative positioning
            if (window.getComputedStyle(chatActions).position === 'static') {
                chatActions.style.position = 'relative';
            }
            
            chatActions.appendChild(emojiList);
            
            // Add hover effect to emoji links
            setTimeout(() => {
                const emojiLinks = emojiList.querySelectorAll('.emoji-picker-item');
                emojiLinks.forEach(link => {
                    link.addEventListener('mouseenter', () => {
                        link.style.backgroundColor = '#f5f5f5';
                        link.style.transform = 'scale(1.1)';
                    });
                    link.addEventListener('mouseleave', () => {
                        link.style.backgroundColor = 'transparent';
                        link.style.transform = 'scale(1)';
                    });
                });
            }, 0);
        }

        // Close dropdown menu first (with a small delay to allow click to register)
        setTimeout(() => {
            const dropdownToggle = messageElement.querySelector('[data-bs-toggle="dropdown"]');
            if (dropdownToggle) {
                const bsDropdown = bootstrap.Dropdown.getInstance(dropdownToggle);
                if (bsDropdown) {
                    bsDropdown.hide();
                }
            }
            
            // Show emoji picker after dropdown closes
            setTimeout(() => {
                // Add class to indicate emoji picker is shown
                emojiList.classList.add('emoji-picker-shown');
                // Set display and visibility with !important using setProperty
                emojiList.style.setProperty('display', 'flex', 'important');
                emojiList.style.setProperty('opacity', '1', 'important');
                emojiList.style.setProperty('visibility', 'visible', 'important');
                emojiList.style.setProperty('z-index', '10000', 'important');
                
                // Position it properly
                const chatActions = messageElement.querySelector('.chat-actions');
                if (chatActions) {
                    const rect = chatActions.getBoundingClientRect();
                    emojiList.style.right = '0';
                    emojiList.style.bottom = 'calc(100% + 5px)';
                }
            }, 150);
        }, 10);
    }

    /**
     * Add reaction to message
     */
    async addReaction(messageId, emoji) {
        try {
            // Close emoji picker
            const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
            if (messageElement) {
                const emojiList = messageElement.querySelector('.emoj-group-list');
                if (emojiList) {
                    emojiList.style.display = 'none';
                    emojiList.classList.remove('emoji-picker-shown');
                }
            }

            const response = await fetch(`/api/chat/message/${messageId}/reaction`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify({ emoji }),
            });

            const data = await response.json();
            if (data.success && data.reactions) {
                // Update the message element's reactions without reloading all messages
                this.updateMessageReactions(messageId, data.reactions);
            }
        } catch (error) {
            console.error('Failed to add reaction:', error);
        }
    }

    /**
     * Update reactions display for a specific message (WhatsApp style - on message bubble)
     */
    updateMessageReactions(messageId, reactions) {
        const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
        if (!messageElement) return;

        // Update stored message data
        if (messageElement.__messageData) {
            messageElement.__messageData.reactions = reactions;
        }
        if (reactions) {
            messageElement.dataset.reactions = JSON.stringify(reactions);
        } else {
            messageElement.removeAttribute('data-reactions');
        }

        // Group reactions by emoji (store full data)
        const reactionsByEmoji = {};
        if (Array.isArray(reactions) && reactions.length > 0) {
            reactions.forEach(reaction => {
                const emoji = reaction.emoji || reaction;
                if (!reactionsByEmoji[emoji]) {
                    reactionsByEmoji[emoji] = [];
                }
                reactionsByEmoji[emoji].push(reaction);
            });
        }

        // Find or create reactions container
        let reactionsContainer = messageElement.querySelector('.message-reactions');
        const isOwnMessage = messageElement.classList.contains('chats-right');
        const positionStyle = isOwnMessage
            ? 'bottom: -8px; right: 8px;'
            : 'bottom: -8px; left: 8px;';

        if (Object.keys(reactionsByEmoji).length > 0) {
            // Build reactions HTML - WhatsApp style
            let reactionsHtml = `<div class="message-reactions" style="position: absolute; ${positionStyle} display: flex; gap: 4px; flex-wrap: wrap; align-items: center; z-index: 1000; max-width: 200px; pointer-events: auto;">`;
            Object.entries(reactionsByEmoji).forEach(([emoji, reactionList]) => {
                const count = reactionList.length;
                const escapedEmoji = this.escapeHtml(emoji);
                const messageIdStr = String(messageId);
                reactionsHtml += `<div class="reaction-item" data-message-id="${messageIdStr}" data-emoji="${escapedEmoji}" style="background: #ffffff; border: 1px solid #e0e0e0; border-radius: 12px; padding: 0px 6px; display: flex; align-items: center; gap: 4px; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.1); transition: all 0.2s; position: relative; z-index: 1001;" title="Click to see who reacted">
                    <span style="font-size: 14px;">${emoji}</span>
                    <span style="font-size: 11px; color: #666; font-weight: 500;">${count}</span>
                </div>`;
            });
            reactionsHtml += '</div>';

            // Insert or update reactions
            if (reactionsContainer) {
                reactionsContainer.outerHTML = reactionsHtml;
            } else {
                // Find the message-content-wrapper or create one
                let wrapper = messageElement.querySelector('.message-content-wrapper');
                if (!wrapper) {
                    // Try to find message-content and wrap it
                    const messageContent = messageElement.querySelector('.message-content, .chat-img, .file-attach-professional');
                    if (messageContent) {
                        wrapper = messageContent.parentElement;
                        if (!wrapper || !wrapper.classList.contains('message-content-wrapper')) {
                            // Wrap it
                            const newWrapper = document.createElement('div');
                            newWrapper.className = 'message-content-wrapper';
                            newWrapper.style.cssText = 'position: relative; display: inline-block;';
                            messageContent.parentNode.insertBefore(newWrapper, messageContent);
                            newWrapper.appendChild(messageContent);
                            wrapper = newWrapper;
                        }
                    }
                }
                if (wrapper) {
                    wrapper.insertAdjacentHTML('beforeend', reactionsHtml);
                }
            }

            // Attach click handlers to reaction items
            const newReactionsContainer = messageElement.querySelector('.message-reactions');
            if (newReactionsContainer) {
                const reactionItems = newReactionsContainer.querySelectorAll('.reaction-item');
                reactionItems.forEach(item => {
                    // Remove existing listeners to avoid duplicates
                    const newItem = item.cloneNode(true);
                    item.parentNode.replaceChild(newItem, item);

                    // Add click handler
                    newItem.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const msgId = newItem.dataset.messageId || messageId;
                        const emoji = newItem.dataset.emoji;
                        if (msgId && emoji) {
                            this.showReactionUsers(msgId, emoji);
                        }
                    });

                    // Add hover effect
                    newItem.addEventListener('mouseenter', () => {
                        newItem.style.transform = 'scale(1.05)';
                        newItem.style.boxShadow = '0 2px 4px rgba(0,0,0,0.15)';
                    });
                    newItem.addEventListener('mouseleave', () => {
                        newItem.style.transform = 'scale(1)';
                        newItem.style.boxShadow = '0 1px 2px rgba(0,0,0,0.1)';
                    });
                });
            }
        } else {
            // Remove reactions if empty
            if (reactionsContainer) {
                reactionsContainer.remove();
            }
        }
    }

    /**
     * Show who reacted to a message (WhatsApp style)
     */
    async showReactionUsers(messageId, emoji) {
        try {
            // Try to get reactions from the message element in DOM
            const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
            let allReactions = [];

            // Try to get from message element data attribute
            if (messageElement) {
                const messageData = messageElement.dataset;
                if (messageData.reactions) {
                    try {
                        allReactions = JSON.parse(messageData.reactions);
                    } catch (e) {
                        // Try to get from the message object if stored
                        const messageObj = messageElement.__messageData;
                        if (messageObj && messageObj.reactions) {
                            allReactions = messageObj.reactions;
                        }
                    }
                } else {
                    // Try to get from stored message object
                    const messageObj = messageElement.__messageData;
                    if (messageObj && messageObj.reactions) {
                        allReactions = messageObj.reactions;
                    }
                }
            }

            // If still no reactions, try to get from current group messages array
            if (allReactions.length === 0 && this.currentGroupMessages) {
                const message = this.currentGroupMessages.find(m =>
                    (m._id || m.id) === messageId
                );
                if (message && message.reactions) {
                    allReactions = message.reactions;
                }
            }

            // If still no reactions, fetch from API by getting all reactions for each emoji
            if (allReactions.length === 0) {
                // Fetch message to get all reactions
                try {
                    // Get all unique emojis first by checking the reaction items in DOM
                    const reactionItems = messageElement?.querySelectorAll('.reaction-item');
                    const emojis = [];
                    if (reactionItems) {
                        reactionItems.forEach(item => {
                            const emojiText = item.textContent.trim().split(/\s/)[0];
                            if (emojiText) emojis.push(emojiText);
                        });
                    }

                    // If we have emojis, fetch reactions for each
                    if (emojis.length > 0) {
                        const reactionsPromises = emojis.map(async (emojiKey) => {
                            try {
                                const response = await fetch(`/api/chat/message/${messageId}/reactions/${encodeURIComponent(emojiKey)}`, {
                                    method: 'GET',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                                    },
                                });
                                const data = await response.json();
                                if (data.success && data.users) {
                                    return data.users.map(user => ({
                                        user_id: user.id,
                                        emoji: emojiKey,
                                        user: user
                                    }));
                                }
                            } catch (e) {
                                console.warn(`Failed to fetch reactions for ${emojiKey}:`, e);
                            }
                            return [];
                        });

                        const reactionsArrays = await Promise.all(reactionsPromises);
                        allReactions = reactionsArrays.flat();
                    } else {
                        // Fallback: just fetch for the clicked emoji
                        const response = await fetch(`/api/chat/message/${messageId}/reactions/${encodeURIComponent(emoji)}`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                            },
                        });
                        const data = await response.json();
                        if (data.success && data.users) {
                            allReactions = data.users.map(user => ({
                                user_id: user.id,
                                emoji: emoji,
                                user: user
                            }));
                        }
                    }
                } catch (e) {
                    console.error('Failed to fetch reactions from API:', e);
                }
            }

            // Group reactions by emoji
            const reactionsByEmoji = {};
            allReactions.forEach(reaction => {
                const emojiKey = reaction.emoji || emoji;
                if (!reactionsByEmoji[emojiKey]) {
                    reactionsByEmoji[emojiKey] = [];
                }
                reactionsByEmoji[emojiKey].push(reaction);
            });

            // Fetch user details for reactions that don't have them
            const reactionsNeedingUsers = allReactions.filter(r => !r.user || !r.user.avatar);
            if (reactionsNeedingUsers.length > 0) {
                const userIds = [...new Set(reactionsNeedingUsers.map(r => r.user_id).filter(Boolean))];
                const usersMap = await this.fetchUsersDetails(userIds);

                // Update reactions with user details
                allReactions.forEach(reaction => {
                    if (!reaction.user || !reaction.user.avatar) {
                        const userId = reaction.user_id;
                        if (usersMap[userId]) {
                            reaction.user = usersMap[userId];
                        } else if (!reaction.user) {
                            reaction.user = {
                                id: userId,
                                name: 'Unknown User',
                                email: '',
                                avatar: '/build/img/profiles/avatar-06.jpg'
                            };
                        }
                    }
                });
            }

            // Build reactions data structure
            const reactionsData = {};
            Object.keys(reactionsByEmoji).forEach(emojiKey => {
                reactionsData[emojiKey] = reactionsByEmoji[emojiKey].map(reaction => {
                    const userId = reaction.user_id;
                    const user = reaction.user || {
                        id: userId,
                        name: 'Unknown User',
                        email: '',
                        avatar: '/build/img/profiles/avatar-06.jpg'
                    };
                    return {
                        user_id: userId,
                        emoji: emojiKey,
                        user: user
                    };
                });
            });

            // Show overlay popup
            this.showReactionUsersOverlay(messageId, reactionsData, emoji);
        } catch (error) {
            console.error('Error fetching reaction users:', error);
        }
    }

    /**
     * Fetch user details for given user IDs
     */
    async fetchUsersDetails(userIds) {
        if (!userIds || userIds.length === 0) return {};

        const usersMap = {};
        const promises = userIds.map(async (userId) => {
            try {
                const response = await fetch(`/api/user/${userId}/profile`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                });
                const data = await response.json();
                if (data.success && data.user) {
                    usersMap[userId] = data.user;
                }
            } catch (error) {
                console.warn(`Failed to fetch user ${userId}:`, error);
            }
        });

        await Promise.all(promises);
        return usersMap;
    }

    /**
     * Get current group messages from memory/DOM
     */
    getCurrentGroupMessages() {
        // Try to get from a stored messages array if available
        if (this.currentGroupMessages) {
            return this.currentGroupMessages;
        }
        return [];
    }

    /**
     * Show overlay popup with users who reacted (WhatsApp style)
     */
    showReactionUsersOverlay(messageId, reactionsData, selectedEmoji) {
        // Remove existing overlay if any
        const existingOverlay = document.getElementById('reactionUsersOverlay');
        if (existingOverlay) {
            existingOverlay.remove();
        }

        // Find the message element to position popup near it
        const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
        if (!messageElement) {
            console.warn('Message element not found for positioning popup');
            return;
        }

        // Get message element position relative to viewport
        const messageRect = messageElement.getBoundingClientRect();

        // Calculate popup position - position it near the message bubble
        const popupWidth = 360;
        const popupHeight = Math.min(500, window.innerHeight * 0.7);
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;

        // Find the message bubble (message-content-wrapper or message-content)
        const messageBubble = messageElement.querySelector('.message-content-wrapper, .message-content, .chat-img, .file-attach-professional');
        let bubbleRect = messageBubble ? messageBubble.getBoundingClientRect() : messageRect;

        // Position popup below the message bubble, aligned to the right edge for sent messages, left for received
        const isOwnMessage = messageElement.classList.contains('chats-right');
        let top = bubbleRect.bottom + 8; // 8px gap below message
        let left;

        if (isOwnMessage) {
            // For sent messages: align to right edge of bubble
            left = bubbleRect.right - popupWidth;
        } else {
            // For received messages: align to left edge of bubble
            left = bubbleRect.left;
        }

        // Adjust if popup would go off-screen horizontally
        if (left < 10) {
            left = 10;
        } else if (left + popupWidth > viewportWidth - 10) {
            left = viewportWidth - popupWidth - 10;
        }

        // Position above message if there's not enough space below
        if (top + popupHeight > viewportHeight - 20) {
            top = bubbleRect.top - popupHeight - 8; // 8px gap above message
            // If still off-screen, position below but limit to viewport
            if (top < 10) {
                top = bubbleRect.bottom + 8;
                // Limit to viewport
                if (top + popupHeight > viewportHeight - 10) {
                    top = viewportHeight - popupHeight - 10;
                }
            }
        }

        // Calculate total reactions count
        const totalReactions = Object.values(reactionsData).reduce((sum, reactions) => sum + reactions.length, 0);

        // Get all emojis
        const emojis = Object.keys(reactionsData);
        const defaultEmoji = selectedEmoji || emojis[0] || '❤️';

        // Build tabs HTML
        let tabsHtml = '';
        tabsHtml += `<div class="reaction-tab ${selectedEmoji === 'all' || !selectedEmoji ? 'active' : ''}" data-emoji="all" style="padding: 8px 16px; cursor: pointer; border-bottom: 2px solid transparent; transition: all 0.2s;">
            All ${totalReactions}
        </div>`;

        emojis.forEach(emoji => {
            const count = reactionsData[emoji].length;
            const isActive = emoji === defaultEmoji && selectedEmoji !== 'all';
            tabsHtml += `<div class="reaction-tab ${isActive ? 'active' : ''}" data-emoji="${this.escapeHtml(emoji)}" style="padding: 8px 16px; cursor: pointer; border-bottom: 2px solid transparent; transition: all 0.2s;">
                ${emoji} ${count}
            </div>`;
        });

        // Build users list HTML for current tab
        const currentEmoji = selectedEmoji === 'all' ? 'all' : defaultEmoji;
        const currentReactions = currentEmoji === 'all'
            ? Object.values(reactionsData).flat()
            : reactionsData[currentEmoji] || [];

        let usersHtml = '';
        currentReactions.forEach(reaction => {
            const user = reaction.user;
            const isCurrentUser = user.id === this.currentUserId;
            const avatar = user.avatar || '/build/img/profiles/avatar-06.jpg';
            const name = user.name || user.email || 'Unknown User';
            const displayName = isCurrentUser ? 'You' : name;

            usersHtml += `
                <div class="reaction-user-item" style="display: flex; align-items: center; gap: 12px; padding: 12px; cursor: ${isCurrentUser ? 'pointer' : 'default'}; transition: background 0.2s;" ${isCurrentUser ? `onclick="window.groupChatManager.removeReaction('${messageId}', '${this.escapeHtml(reaction.emoji)}')"` : ''}>
                    <img src="${avatar}" alt="${name}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    <div style="flex: 1;">
                        <div style="font-weight: 500; color: #212529; display: flex; align-items: center; gap: 8px;">
                            <span>${this.escapeHtml(displayName)}</span>
                            ${isCurrentUser ? `<span style="font-size: 12px; color: #999; font-weight: normal;">Click to remove</span>` : ''}
                        </div>
                    </div>
                    <span style="font-size: 18px;">${reaction.emoji}</span>
                </div>
            `;
        });

        if (usersHtml === '') {
            usersHtml = '<div style="padding: 20px; text-align: center; color: #999;">No reactions</div>';
        }

        // Create overlay HTML with positioned popup (floating near message, not full-screen modal)
        const overlayHtml = `
            <div id="reactionUsersOverlay" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.3); z-index: 9999; animation: fadeIn 0.2s;">
                <div class="reaction-popup" style="position: fixed; background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); width: ${popupWidth}px; max-width: 90vw; max-height: ${popupHeight}px; display: flex; flex-direction: column; animation: slideUp 0.2s; top: ${top}px; left: ${left}px; z-index: 10000;">
                    <div class="reaction-tabs" style="display: flex; border-bottom: 1px solid #e0e0e0; overflow-x: auto;">
                        ${tabsHtml}
                    </div>
                    <div class="reaction-users-list" style="flex: 1; overflow-y: auto; max-height: 400px;">
                        ${usersHtml}
                    </div>
                </div>
            </div>
            <style>
                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
                @keyframes fadeOut {
                    from { opacity: 1; }
                    to { opacity: 0; }
                }
                @keyframes slideUp {
                    from { transform: translateY(20px); opacity: 0; }
                    to { transform: translateY(0); opacity: 1; }
                }
                .reaction-tab {
                    white-space: nowrap;
                    font-size: 14px;
                    color: #666;
                }
                .reaction-tab.active {
                    color: #25D366;
                    border-bottom-color: #25D366 !important;
                    font-weight: 500;
                }
                .reaction-user-item:hover {
                    background: #f5f5f5 !important;
                }
                .reaction-popup {
                    overflow: hidden;
                }
            </style>
        `;

        // Add overlay to body
        document.body.insertAdjacentHTML('beforeend', overlayHtml);

        // Add click handler to close overlay when clicking outside the popup
        const overlay = document.getElementById('reactionUsersOverlay');
        const popup = overlay.querySelector('.reaction-popup');

        // Close when clicking outside the popup
        overlay.addEventListener('click', (e) => {
            if (!popup.contains(e.target)) {
                this.closeReactionUsersOverlay();
            }
        });

        // Prevent clicks inside popup from closing it
        if (popup) {
            popup.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        }

        // Add tab click handlers
        const tabs = overlay.querySelectorAll('.reaction-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const emoji = tab.dataset.emoji;
                this.switchReactionTab(messageId, reactionsData, emoji);
            });
        });

        // Handle window resize and scroll to reposition
        const handleReposition = () => {
            if (!messageElement) return;
            const newRect = messageElement.getBoundingClientRect();
            const newScrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const newScrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

            const popup = overlay.querySelector('.reaction-popup');
            if (popup) {
                let newTop = newRect.bottom + newScrollTop + 10;
                let newLeft = newRect.left + newScrollLeft + (newRect.width / 2) - (popupWidth / 2);

                // Adjust if popup would go off-screen
                if (newLeft < 10) {
                    newLeft = 10;
                } else if (newLeft + popupWidth > window.innerWidth - 10) {
                    newLeft = window.innerWidth - popupWidth - 10;
                }

                popup.style.top = newTop + 'px';
                popup.style.left = newLeft + 'px';
            }
        };

        // Store handler for cleanup
        overlay.__repositionHandler = handleReposition;
        window.addEventListener('scroll', handleReposition, true);
        window.addEventListener('resize', handleReposition);
    }

    /**
     * Switch reaction tab
     */
    switchReactionTab(messageId, reactionsData, emoji) {
        // Update active tab
        const overlay = document.getElementById('reactionUsersOverlay');
        if (!overlay) return;

        const tabs = overlay.querySelectorAll('.reaction-tab');
        tabs.forEach(tab => {
            if (tab.dataset.emoji === emoji) {
                tab.classList.add('active');
            } else {
                tab.classList.remove('active');
            }
        });

        // Update users list
        const currentReactions = emoji === 'all'
            ? Object.values(reactionsData).flat()
            : reactionsData[emoji] || [];

        let usersHtml = '';
        currentReactions.forEach(reaction => {
            const user = reaction.user;
            const isCurrentUser = user.id === this.currentUserId;
            const avatar = user.avatar || '/build/img/profiles/avatar-06.jpg';
            const name = user.name || user.email || 'Unknown User';
            const displayName = isCurrentUser ? 'You' : name;

            usersHtml += `
                <div class="reaction-user-item" style="display: flex; align-items: center; gap: 12px; padding: 12px; cursor: ${isCurrentUser ? 'pointer' : 'default'}; transition: background 0.2s;" ${isCurrentUser ? `onclick="window.groupChatManager.removeReaction('${messageId}', '${this.escapeHtml(reaction.emoji)}')"` : ''}>
                    <img src="${avatar}" alt="${name}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    <div style="flex: 1;">
                        <div style="font-weight: 500; color: #212529; display: flex; align-items: center; gap: 8px;">
                            <span>${this.escapeHtml(displayName)}</span>
                            ${isCurrentUser ? `<span style="font-size: 12px; color: #999; font-weight: normal;">Click to remove</span>` : ''}
                        </div>
                    </div>
                    <span style="font-size: 18px;">${reaction.emoji}</span>
                </div>
            `;
        });

        if (usersHtml === '') {
            usersHtml = '<div style="padding: 20px; text-align: center; color: #999;">No reactions</div>';
        }

        const usersList = overlay.querySelector('.reaction-users-list');
        if (usersList) {
            usersList.innerHTML = usersHtml;
        }
    }

    /**
     * Close reaction users overlay
     */
    closeReactionUsersOverlay() {
        const overlay = document.getElementById('reactionUsersOverlay');
        if (overlay) {
            // Remove event listeners
            if (overlay.__repositionHandler) {
                window.removeEventListener('scroll', overlay.__repositionHandler, true);
                window.removeEventListener('resize', overlay.__repositionHandler);
            }

            overlay.style.animation = 'fadeOut 0.2s';
            setTimeout(() => {
                overlay.remove();
            }, 200);
        }
    }

    /**
     * Remove reaction
     */
    async removeReaction(messageId, emoji) {
        try {
            // Add the same reaction to remove it (toggle behavior)
            const response = await fetch(`/api/chat/message/${messageId}/reaction`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify({ emoji }),
            });

            const data = await response.json();
            if (data.success && data.reactions) {
                // Update the message element's reactions
                this.updateMessageReactions(messageId, data.reactions);

                // Update stored message if available
                const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
                if (messageElement) {
                    if (messageElement.__messageData) {
                        messageElement.__messageData.reactions = data.reactions;
                    }
                    messageElement.dataset.reactions = JSON.stringify(data.reactions);
                }
            }

            // Close overlay
            this.closeReactionUsersOverlay();
        } catch (error) {
            console.error('Failed to remove reaction:', error);
        }
    }

    /**
     * Set reply message
     */
    setReplyMessage(messageId, content, senderName, senderAvatar) {
        // Make parameters optional and provide defaults
        if (!messageId || !content) {
            console.error('setReplyMessage: messageId and content are required');
            return;
        }

        this.replyingToMessage = { id: messageId, content: content };

        // Show reply UI - try both possible selectors
        let replyDiv = document.getElementById('reply-div');
        if (!replyDiv) {
            // Fallback: try to find by class
            replyDiv = document.querySelector('.reply-chat');
        }

        if (replyDiv) {
            replyDiv.style.display = 'block';
            
            // Update reply content (WhatsApp style)
            const replyContent = replyDiv.querySelector('.reply-content');
            if (replyContent) {
                // Truncate content to fit in 2 lines (max ~60 chars)
                const maxLength = 60;
                const truncatedContent = content.length > maxLength ? content.substring(0, maxLength) + '...' : content;
                replyContent.textContent = truncatedContent;
            }
            
            // Update sender name (WhatsApp style - blue text #25D366)
            // Find the name element by looking for div with color style or font-weight
            const nameContainer = replyDiv.querySelector('div[style*="color: #25D366"]') || 
                                  replyDiv.querySelector('div[style*="font-weight: 600"]');
            if (nameContainer) {
                const displayName = senderName || 'User';
                nameContainer.textContent = displayName;
                // Ensure it has the blue color
                if (!nameContainer.style.color || nameContainer.style.color !== 'rgb(37, 211, 102)') {
                    nameContainer.style.color = '#25D366';
                }
            }
        } else {
            console.error('setReplyMessage: Could not find reply div element');
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
     * Create todo from message
     */
    async createTodoFromMessage(messageId, messageContent) {
        // Check if todo modal exists on the page
        let todoModal = document.getElementById('todomodel');
        
        if (!todoModal) {
            // Modal doesn't exist, redirect to todos page
            sessionStorage.setItem('todoFromMessage', JSON.stringify({
                content: messageContent,
                messageId: messageId
            }));
            window.location.href = '/todos';
            return;
        }
        
        // Get the message element to access message data
        const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
        let message = null;
        
        if (messageElement) {
            // Try to get message data from DOM element
            message = messageElement.__messageData;
            
            // If not found, try to get from current group messages
            if (!message && this.currentGroupMessages) {
                message = this.currentGroupMessages.find(m => 
                    (m._id || m.id) === messageId
                );
            }
        }
        
        // Modal exists, open it and pre-fill
        const bsModal = new bootstrap.Modal(todoModal);
        
        // Pre-fill the todo title with message content
        const todoNameInput = document.getElementById('todo_name');
        if (todoNameInput) {
            const content = messageContent.replace(/<[^>]*>/g, ''); // Remove HTML tags
            todoNameInput.value = content.length > 100 ? content.substring(0, 100) + '...' : content;
        }
        
        // Reset form state
        document.getElementById('todo_id').value = '';
        document.getElementById('todo_heading').innerText = 'Create new ToDo';
        
        // Clear any previous selections
        document.querySelectorAll('.user_div.user_active').forEach(el => {
            el.classList.remove('user_active');
        });
        if (window.selectedUsers) {
            window.selectedUsers = [];
        }
        const selectedUserInput = document.getElementById('selected_user');
        if (selectedUserInput) {
            selectedUserInput.value = '';
        }
        
        // Clear previous file uploads
        const createPdfList = document.getElementById('createPdfList');
        if (createPdfList) {
            const existingTiles = createPdfList.querySelectorAll('.d-flex.align-items-center.gap-2.px-2');
            existingTiles.forEach(tile => {
                if (tile._fileInput) {
                    tile._fileInput.remove();
                }
                tile.remove();
            });
        }
        const createPdfInputs = document.getElementById('createPdfInputs');
        if (createPdfInputs) {
            createPdfInputs.innerHTML = '';
        }
        
        // Check if message has an image and auto-add it
        if (message && message.message_type === 'img' && message.file_url) {
            try {
                // Download the image and convert to File object
                const response = await fetch(message.file_url);
                if (!response.ok) {
                    throw new Error('Failed to fetch image');
                }
                const blob = await response.blob();
                const fileName = message.file_name || 'image_' + Date.now() + '.jpg';
                const file = new File([blob], fileName, { type: blob.type || 'image/jpeg' });
                
                // Create file input using DataTransfer to properly set the file
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.name = 'attachments[]';
                fileInput.style.display = 'none';
                fileInput.accept = 'application/pdf, video/mp4, image/png, image/jpeg';
                
                // Use DataTransfer to set the file
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
                
                // Add to hidden inputs container (inside the form)
                // The createPdfInputs is inside the form, so the file will be submitted
                if (createPdfInputs) {
                    createPdfInputs.appendChild(fileInput);
                } else {
                    // Fallback: add directly to form if createPdfInputs doesn't exist
                    const todoForm = document.getElementById('todoForm');
                    if (todoForm) {
                        todoForm.appendChild(fileInput);
                    }
                }
                
                // Add visual tile to the file list
                if (createPdfList) {
                    const addTile = createPdfList.querySelector('.pdf-add-tile');
                    const imageURL = URL.createObjectURL(blob);
                    
                    const tile = document.createElement('div');
                    tile.className = 'd-flex align-items-center gap-2 px-2';
                    tile.style.cssText = 'border:1px solid #e5e7eb;border-radius:10px;height:60px;background:#fff;';
                    tile.innerHTML = `
                        <img src="${imageURL}" alt="Image" style="width:40px;height:40px;object-fit:cover;border-radius:6px;">
                        <div class="d-flex flex-column" style="min-width:100px;">
                            <small style="font-weight:600;">${fileName}</small>
                            <small style="color:#6b7280;">${Math.round(file.size / 1024)} KB</small>
                        </div>
                        <button type="button" class="btn" style="color:#ef4444;" onclick="if (typeof window.removePdfTile === 'function') { window.removePdfTile(this); }">
                            <i class="ti ti-trash"></i>
                        </button>
                    `;
                    
                    if (addTile) {
                        createPdfList.insertBefore(tile, addTile);
                    } else {
                        createPdfList.appendChild(tile);
                    }
                    
                    // Store file input reference for removal
                    tile._fileInput = fileInput;
                }
            } catch (error) {
                console.error('Failed to add image to todo:', error);
                // Show user-friendly error
                alert('Failed to add image from message to todo. You can manually upload it.');
            }
        }
        
        // Open the modal
        bsModal.show();
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
     * Load group media (photos, videos, documents, links)
     */
    async loadGroupMedia(groupId) {
        if (!groupId) {
            // Clear media containers if no group selected
            this.renderGroupMedia({ photos: [], videos: [], documents: [], links: [] }, { photos: 0, videos: 0, documents: 0, links: 0 }, []);
            return;
        }

        try {
            // Fetch media and favorites in parallel
            const [mediaResponse, favoritesResponse] = await Promise.all([
                fetch(`/api/chat/group/${groupId}/media`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                }),
                fetch(`/api/chat/favorites?group_id=${groupId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                })
            ]);

            if (!mediaResponse.ok) {
                throw new Error(`HTTP error! status: ${mediaResponse.status}`);
            }

            const data = await mediaResponse.json();
            let favoriteMessageIds = [];

            if (favoritesResponse.ok) {
                const favoritesData = await favoritesResponse.json();
                if (favoritesData.success && favoritesData.favorite_message_ids) {
                    favoriteMessageIds = favoritesData.favorite_message_ids;
                }
            }

            if (data.success && data.media) {
                this.renderGroupMedia(data.media, data.counts, favoriteMessageIds);
            } else {
                console.warn('Failed to load group media:', data);
                this.renderGroupMedia({ photos: [], videos: [], documents: [], links: [] }, { photos: 0, videos: 0, documents: 0, links: 0 }, []);
            }
        } catch (error) {
            console.error('Failed to load group media:', error);
            // Show empty state on error
            this.renderGroupMedia({ photos: [], videos: [], documents: [], links: [] }, { photos: 0, videos: 0, documents: 0, links: 0 }, []);
        }
    }

    /**
     * Render group media in Media Details section
     */
    renderGroupMedia(media, counts, favoriteMessageIds = []) {
        // Render Photos
        const photosContainer = document.getElementById('mediaPhotosContainer');
        if (photosContainer) {
            if (media.photos && media.photos.length > 0) {
                let photosHtml = '<div class="chat-img contact-gallery">';
                media.photos.slice(0, 12).forEach((photo) => {
                    const isFavorite = favoriteMessageIds.includes(photo.id || photo._id);
                    const favoriteClass = isFavorite ? 'favorited' : '';
                    const favoriteIcon = isFavorite ? 'ti-heart-filled' : 'ti-heart';
                    photosHtml += `
                        <div class="img-wrap">
                            <img src="${photo.file_url}" alt="${photo.file_name}" style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="img-overlay">
                                <a class="media-view-image-btn" href="javascript:void(0);" data-image-url="${photo.file_url}" data-image-name="${photo.file_name}" title="View Image">
                                    <i class="ti ti-eye"></i>
                                </a>
                                <a href="${photo.file_url}" download="${photo.file_name}">
                                    <i class="ti ti-download"></i>
                                </a>
                                <a href="#" class="favorite-btn ${favoriteClass}" 
                                   data-message-id="${photo.id || photo._id}" 
                                   data-media-type="photo" 
                                   data-file-url="${photo.file_url}" 
                                   data-file-name="${photo.file_name}"
                                   data-group-id="${this.currentGroupId || ''}"
                                   onclick="event.preventDefault(); window.groupChatManager.toggleFavorite(this);">
                                    <i class="ti ${favoriteIcon}"></i>
                                </a>
                            </div>
                        </div>
                    `;
                });
                photosHtml += '</div>';
                if (media.photos.length > 12) {
                    photosHtml += `<div class="text-center mt-3">
                        <span class="text-muted">Showing 12 of ${media.photos.length} photos</span>
                    </div>`;
                }
                photosContainer.innerHTML = photosHtml;
            } else {
                photosContainer.innerHTML = '<div class="text-center p-4 text-muted">No photos shared yet</div>';
            }
        }

        // Render Videos
        const videosContainer = document.getElementById('mediaVideosContainer');
        if (videosContainer) {
            if (media.videos && media.videos.length > 0) {
                let videosHtml = '';
                media.videos.slice(0, 6).forEach((video) => {
                    const isFavorite = favoriteMessageIds.includes(video.id || video._id);
                    const favoriteClass = isFavorite ? 'favorited' : '';
                    const favoriteIcon = isFavorite ? 'ti-heart-filled' : 'ti-heart';
                    videosHtml += `
                        <div class="video-item-wrapper mb-3" style="position: relative;">
                            <a class="media-view-video-btn" href="javascript:void(0);" data-video-url="${video.file_url}" data-video-name="${video.file_name}" style="display: block; position: relative;">
                                <img src="${video.file_url}" alt="${video.file_name}" style="width: 100%; height: auto; border-radius: 8px;">
                                <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.7); border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; cursor: pointer;"><i class="ti ti-player-play-filled" style="font-size: 28px; color: white;"></i></span>
                            </a>
                            <a href="#" class="favorite-btn ${favoriteClass}" 
                               data-message-id="${video.id || video._id}" 
                               data-media-type="video" 
                               data-file-url="${video.file_url}" 
                               data-file-name="${video.file_name}"
                               data-group-id="${this.currentGroupId || ''}"
                               onclick="event.preventDefault(); window.groupChatManager.toggleFavorite(this);"
                               style="position: absolute; top: 8px; right: 8px; background: rgba(0,0,0,0.5); padding: 6px; border-radius: 50%; color: white; z-index: 10;">
                                <i class="ti ${favoriteIcon}"></i>
                            </a>
                        </div>
                    `;
                });
                if (media.videos.length > 6) {
                    videosHtml += `<div class="text-center mt-3">
                        <span class="text-muted">Showing 6 of ${media.videos.length} videos</span>
                    </div>`;
                }
                videosContainer.innerHTML = videosHtml;
            } else {
                videosContainer.innerHTML = '<div class="text-center p-4 text-muted">No videos shared yet</div>';
            }
        }

        // Render Documents
        const documentsContainer = document.getElementById('mediaDocumentsContainer');
        if (documentsContainer) {
            if (media.documents && media.documents.length > 0) {
                let documentsHtml = '';
                media.documents.forEach((doc) => {
                    const fileSize = this.formatFileSize(doc.file_size || 0);
                    const fileIcon = this.getFileIcon(doc.file_name || 'file');
                    const isFavorite = favoriteMessageIds.includes(doc.id || doc._id);
                    const favoriteClass = isFavorite ? 'favorited' : '';
                    const favoriteIcon = isFavorite ? 'ti-heart-filled' : 'ti-heart';
                    documentsHtml += `
                        <div class="document-item mb-3">
                            <div class="d-flex align-items-center">
                                <span class="document-icon">
                                    <i class="${fileIcon}"></i>
                                </span>
                                <div class="ms-2 flex-grow-1">
                                    <h6 class="mb-0">${doc.file_name || 'Untitled'}</h6>
                                    <p class="mb-0 text-muted small">${fileSize}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a href="#" class="favorite-btn ${favoriteClass}" 
                                   data-message-id="${doc.id || doc._id}" 
                                   data-media-type="document" 
                                   data-file-url="${doc.file_url}" 
                                   data-file-name="${doc.file_name}"
                                   data-group-id="${this.currentGroupId || ''}"
                                   onclick="event.preventDefault(); window.groupChatManager.toggleFavorite(this);">
                                    <i class="ti ${favoriteIcon}"></i>
                                </a>
                                <a href="${doc.file_url}" download="${doc.file_name}" class="download-icon">
                                    <i class="ti ti-download"></i>
                                </a>
                            </div>
                        </div>
                    `;
                });
                documentsContainer.innerHTML = documentsHtml;
            } else {
                documentsContainer.innerHTML = '<div class="text-center p-4 text-muted">No documents shared yet</div>';
            }
        }

        // Render Links
        const linksContainer = document.getElementById('mediaLinksContainer');
        if (linksContainer) {
            if (media.links && media.links.length > 0) {
                let linksHtml = '';
                media.links.forEach((link) => {
                    const isFavorite = favoriteMessageIds.includes(link.id || link._id || link.message_id);
                    const favoriteClass = isFavorite ? 'favorited' : '';
                    const favoriteIcon = isFavorite ? 'ti-heart-filled' : 'ti-heart';
                    try {
                        const urlObj = new URL(link.url);
                        const domain = urlObj.hostname.replace('www.', '');
                        const faviconUrl = `https://www.google.com/s2/favicons?domain=${domain}&sz=64`;
                        const displayUrl = link.url.length > 60 ? link.url.substring(0, 60) + '...' : link.url;
                        
                        linksHtml += `
                            <div class="link-preview-card mb-3" style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; position: relative;" onclick="window.open('${link.url}', '_blank', 'noopener,noreferrer')">
                                <div style="padding: 16px; display: flex; align-items: flex-start; gap: 12px;">
                                    <div style="flex-shrink: 0; width: 48px; height: 48px; background: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                        <img src="${faviconUrl}" alt="${domain}" style="width: 32px; height: 32px; object-fit: contain;" onerror="this.style.display='none'; this.parentElement.innerHTML='<i class=\\'ti ti-link\\' style=\\'font-size: 24px; color: #6338F6;\\'></i>'">
                                    </div>
                                    <div style="flex: 1; min-width: 0; padding-right: 40px;">
                                        <div style="font-weight: 600; font-size: 15px; color: #212529; margin-bottom: 4px; line-height: 1.4; word-break: break-word;">
                                            ${domain}
                                        </div>
                                        <div style="font-size: 13px; color: #6c757d; line-height: 1.4; word-break: break-all; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            ${displayUrl}
                                        </div>
                                    </div>
                                    <a href="#" class="favorite-btn ${favoriteClass}" 
                                       data-message-id="${link.id || link._id || link.message_id}" 
                                       data-media-type="link" 
                                       data-url="${link.url}"
                                       data-group-id="${this.currentGroupId || ''}"
                                       onclick="event.preventDefault(); event.stopPropagation(); window.groupChatManager.toggleFavorite(this);"
                                       style="position: absolute; top: 12px; right: 12px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.9); border-radius: 50%; color: ${isFavorite ? '#e74c3c' : '#6c757d'}; text-decoration: none; transition: all 0.2s; z-index: 10; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                        <i class="ti ${favoriteIcon}" style="font-size: 16px;"></i>
                                    </a>
                                </div>
                            </div>
                        `;
                    } catch (e) {
                        // If URL parsing fails, still show the link
                        const displayUrl = link.url.length > 60 ? link.url.substring(0, 60) + '...' : link.url;
                        linksHtml += `
                            <div class="link-preview-card mb-3" style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; position: relative;" onclick="window.open('${link.url}', '_blank', 'noopener,noreferrer')">
                                <div style="padding: 16px; display: flex; align-items: flex-start; gap: 12px;">
                                    <div style="flex-shrink: 0; width: 48px; height: 48px; background: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                        <i class="ti ti-link" style="font-size: 24px; color: #6338F6;"></i>
                                    </div>
                                    <div style="flex: 1; min-width: 0; padding-right: 40px;">
                                        <div style="font-weight: 600; font-size: 15px; color: #212529; margin-bottom: 4px; line-height: 1.4; word-break: break-word;">
                                            Link
                                        </div>
                                        <div style="font-size: 13px; color: #6c757d; line-height: 1.4; word-break: break-all; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            ${displayUrl}
                                        </div>
                                    </div>
                                    <a href="#" class="favorite-btn ${favoriteClass}" 
                                       data-message-id="${link.id || link._id || link.message_id}" 
                                       data-media-type="link" 
                                       data-url="${link.url}"
                                       data-group-id="${this.currentGroupId || ''}"
                                       onclick="event.preventDefault(); event.stopPropagation(); window.groupChatManager.toggleFavorite(this);"
                                       style="position: absolute; top: 12px; right: 12px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.9); border-radius: 50%; color: ${isFavorite ? '#e74c3c' : '#6c757d'}; text-decoration: none; transition: all 0.2s; z-index: 10; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                        <i class="ti ${favoriteIcon}" style="font-size: 16px;"></i>
                                    </a>
                                </div>
                            </div>
                        `;
                    }
                });
                linksContainer.innerHTML = linksHtml;
                
                // Add hover effects
                const linkCards = linksContainer.querySelectorAll('.link-preview-card');
                linkCards.forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-2px)';
                        this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
                        this.style.borderColor = '#6338F6';
                    });
                    card.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0)';
                        this.style.boxShadow = 'none';
                        this.style.borderColor = '#e9ecef';
                    });
                });
            } else {
                linksContainer.innerHTML = '<div class="text-center p-4 text-muted">No links shared yet</div>';
            }
        }

        // Update accordion headers with counts
        const photosHeader = document.querySelector('[data-bs-target="#chatuser-collapse1"]');
        if (photosHeader && counts.photos > 0) {
            const currentText = photosHeader.textContent.trim();
            if (!currentText.includes('(')) {
                photosHeader.innerHTML = `<i class="ti ti-photo-shield me-2"></i>Photos (${counts.photos})`;
            }
        }

        const videosHeader = document.querySelector('[data-bs-target="#media-video"]');
        if (videosHeader && counts.videos > 0) {
            const currentText = videosHeader.textContent.trim();
            if (!currentText.includes('(')) {
                videosHeader.innerHTML = `<i class="ti ti-video me-2"></i>Videos (${counts.videos})`;
            }
        }

        const documentsHeader = document.querySelector('[data-bs-target="#media-document"]');
        if (documentsHeader && counts.documents > 0) {
            const currentText = documentsHeader.textContent.trim();
            if (!currentText.includes('(')) {
                documentsHeader.innerHTML = `<i class="ti ti-file me-2"></i>Documents (${counts.documents})`;
            }
        }

        const linksHeader = document.querySelector('[data-bs-target="#media-links"]');
        if (linksHeader && counts.links > 0) {
            const currentText = linksHeader.textContent.trim();
            if (!currentText.includes('(')) {
                linksHeader.innerHTML = `<i class="ti ti-unlink me-2"></i>Links (${counts.links})`;
            }
        }

        // Add event listeners to all favorite buttons in Media Details after rendering
        this.attachFavoriteButtonListeners();
    }

    /**
     * Attach event listeners to favorite buttons in Media Details
     */
    attachFavoriteButtonListeners() {
        // Get all containers
        const photosContainer = document.getElementById('mediaPhotosContainer');
        const videosContainer = document.getElementById('mediaVideosContainer');
        const documentsContainer = document.getElementById('mediaDocumentsContainer');
        const linksContainer = document.getElementById('mediaLinksContainer');

        // Attach listeners to all favorite buttons
        [photosContainer, videosContainer, documentsContainer, linksContainer].forEach(container => {
            if (container) {
                container.querySelectorAll('.favorite-btn').forEach(btn => {
                    // Remove inline onclick to avoid conflicts
                    btn.removeAttribute('onclick');
                    // Add proper event listener
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        if (window.groupChatManager && typeof window.groupChatManager.toggleFavorite === 'function') {
                            window.groupChatManager.toggleFavorite(btn);
                        }
                    });
                });
            }
        });
    }

    /**
     * Get file icon based on file extension
     */
    getFileIcon(fileName) {
        const ext = fileName.split('.').pop()?.toLowerCase() || '';
        const iconMap = {
            'pdf': 'ti ti-file-type-pdf',
            'doc': 'ti ti-file-type-doc',
            'docx': 'ti ti-file-type-doc',
            'xls': 'ti ti-file-type-xls',
            'xlsx': 'ti ti-file-type-xls',
            'ppt': 'ti ti-file-type-ppt',
            'pptx': 'ti ti-file-type-ppt',
            'zip': 'ti ti-file-zip',
            'rar': 'ti ti-file-zip',
            'txt': 'ti ti-file-text',
        };
        return iconMap[ext] || 'ti ti-file';
    }

    /**
     * Format file size
     */
    formatFileSize(bytes) {
        if (!bytes || bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    /**
     * Toggle favorite status for a media item
     */
    async toggleFavorite(buttonElement) {
        const messageId = buttonElement.getAttribute('data-message-id');
        const mediaType = buttonElement.getAttribute('data-media-type');
        const groupId = buttonElement.getAttribute('data-group-id');
        const fileUrl = buttonElement.getAttribute('data-file-url');
        const fileName = buttonElement.getAttribute('data-file-name');
        const url = buttonElement.getAttribute('data-url');

        if (!messageId || !mediaType) {
            console.error('Missing required data for favorite toggle');
            return;
        }

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
            if (!csrfToken) {
                console.error('CSRF token not found');
                alert('Security token missing. Please refresh the page.');
                return;
            }

            const response = await fetch('/api/chat/favorite/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    message_id: messageId,
                    media_type: mediaType,
                    group_id: groupId,
                    file_url: fileUrl,
                    file_name: fileName,
                    url: url,
                }),
            });

            if (!response.ok) {
                const errorText = await response.text();
                console.error('Failed to toggle favorite:', response.status, errorText);
                alert('Failed to toggle favorite. Please try again.');
                return;
            }

            const data = await response.json();

            if (data.success) {
                // Update UI
                const icon = buttonElement.querySelector('i');
                if (data.is_favorite) {
                    buttonElement.classList.add('favorited');
                    icon.classList.remove('ti-heart');
                    icon.classList.add('ti-heart-filled');
                } else {
                    buttonElement.classList.remove('favorited');
                    icon.classList.remove('ti-heart-filled');
                    icon.classList.add('ti-heart');
                }

                // Reload favorites if favorites offcanvas is open
                const favoritesOffcanvas = document.getElementById('contact-favourite');
                if (favoritesOffcanvas && favoritesOffcanvas.classList.contains('show')) {
                    if (typeof this.loadFavorites === 'function') {
                        this.loadFavorites(this.currentGroupId).catch(err => {
                            console.error('Failed to reload favorites:', err);
                        });
                    }
                }

                // Update favorites count
                const allFavoritesResponse = await fetch('/api/chat/favorites', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                });
                if (allFavoritesResponse.ok) {
                    const allFavoritesData = await allFavoritesResponse.json();
                    if (allFavoritesData.success && allFavoritesData.favorites) {
                        this.updateFavoritesCount(allFavoritesData.favorites.length);
                    }
                }
            } else {
                console.error('Failed to toggle favorite:', data.message);
                alert(data.message || 'Failed to toggle favorite');
            }
        } catch (error) {
            console.error('Error toggling favorite:', error);
            alert('Failed to toggle favorite. Please try again.');
        }
    }

    /**
     * Load and render favorites
     */
    async loadFavorites(groupId = null) {
        try {
            const url = groupId ? `/api/chat/favorites?group_id=${groupId}` : '/api/chat/favorites';
            const response = await fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success && data.favorites) {
                this.renderFavorites(data.favorites);
                // Update favorites count badge
                this.updateFavoritesCount(data.favorites.length);
            } else {
                this.renderFavorites([]);
                this.updateFavoritesCount(0);
            }
        } catch (error) {
            console.error('Failed to load favorites:', error);
            this.renderFavorites([]);
            this.updateFavoritesCount(0);
        }
    }

    /**
     * Render favorites in the favorites offcanvas
     */
    renderFavorites(favorites) {
        const container = document.getElementById('favoritesContainer');
        if (!container) return;

        if (!favorites || favorites.length === 0) {
            container.innerHTML = '<div class="text-center p-4 text-muted">No favorites yet</div>';
            return;
        }

        // Group favorites by media type
        const grouped = {
            photo: [],
            video: [],
            document: [],
            link: [],
            audio: [],
        };

        favorites.forEach(fav => {
            const type = fav.media_type || 'document';
            if (grouped[type]) {
                grouped[type].push(fav);
            }
        });

        let html = '';

        // Render Photos
        if (grouped.photo.length > 0) {
            html += '<div class="mb-4"><h6 class="mb-3"><i class="ti ti-photo-shield me-2"></i>Photos</h6>';
            html += '<div class="chat-img contact-gallery">';
            grouped.photo.forEach(fav => {
                html += `
                    <div class="img-wrap">
                        <img src="${fav.file_url}" alt="${fav.file_name || 'Photo'}" style="width: 100%; height: 100%; object-fit: cover;">
                        <div class="img-overlay">
                            <a class="favorites-view-image-btn" href="javascript:void(0);" data-image-url="${fav.file_url}" data-image-name="${fav.file_name || 'Photo'}" title="View Image">
                                <i class="ti ti-eye"></i>
                            </a>
                            <a href="${fav.file_url}" download="${fav.file_name || 'photo'}">
                                <i class="ti ti-download"></i>
                            </a>
                            <a href="#" class="favorite-btn favorited" 
                               data-message-id="${fav.message_id}" 
                               data-media-type="${fav.media_type}" 
                               data-file-url="${fav.file_url}" 
                               data-file-name="${fav.file_name}"
                               data-group-id="${fav.group_id || ''}"
                               onclick="event.preventDefault(); window.groupChatManager.toggleFavorite(this);">
                                <i class="ti ti-heart-filled"></i>
                            </a>
                        </div>
                    </div>
                `;
            });
            html += '</div></div>';
        }

        // Render Videos
        if (grouped.video.length > 0) {
            html += '<div class="mb-4"><h6 class="mb-3"><i class="ti ti-video me-2"></i>Videos</h6>';
            grouped.video.forEach(fav => {
                html += `
                    <div class="video-item-wrapper mb-3" style="position: relative;">
                        <a class="favorites-view-video-btn" href="javascript:void(0);" data-video-url="${fav.file_url}" data-video-name="${fav.file_name || 'Video'}" style="display: block; position: relative;">
                            <img src="${fav.file_url}" alt="${fav.file_name || 'Video'}" style="width: 100%; height: auto; border-radius: 8px;">
                            <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.7); border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; cursor: pointer;"><i class="ti ti-player-play-filled" style="font-size: 28px; color: white;"></i></span>
                        </a>
                        <a href="#" class="favorite-btn favorited" 
                           data-message-id="${fav.message_id}" 
                           data-media-type="${fav.media_type}" 
                           data-file-url="${fav.file_url}" 
                           data-file-name="${fav.file_name}"
                           data-group-id="${fav.group_id || ''}"
                           onclick="event.preventDefault(); window.groupChatManager.toggleFavorite(this);"
                           style="position: absolute; top: 8px; right: 8px; background: rgba(0,0,0,0.5); padding: 6px; border-radius: 50%; color: white; z-index: 10;">
                            <i class="ti ti-heart-filled"></i>
                        </a>
                    </div>
                `;
            });
            html += '</div>';
        }

        // Render Documents
        if (grouped.document.length > 0) {
            html += '<div class="mb-4"><h6 class="mb-3"><i class="ti ti-file me-2"></i>Documents</h6>';
            grouped.document.forEach(fav => {
                const fileSize = this.formatFileSize(0); // Size not stored in favorites
                const fileIcon = this.getFileIcon(fav.file_name || 'file');
                html += `
                    <div class="document-item mb-3">
                        <div class="d-flex align-items-center">
                            <span class="document-icon">
                                <i class="${fileIcon}"></i>
                            </span>
                            <div class="ms-2 flex-grow-1">
                                <h6 class="mb-0">${fav.file_name || 'Untitled'}</h6>
                                <p class="mb-0 text-muted small">${fileSize}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="#" class="favorite-btn favorited" 
                               data-message-id="${fav.message_id}" 
                               data-media-type="${fav.media_type}" 
                               data-file-url="${fav.file_url}" 
                               data-file-name="${fav.file_name}"
                               data-group-id="${fav.group_id || ''}"
                               onclick="event.preventDefault(); window.groupChatManager.toggleFavorite(this);">
                                <i class="ti ti-heart-filled"></i>
                            </a>
                            <a href="${fav.file_url}" download="${fav.file_name || 'file'}" class="download-icon">
                                <i class="ti ti-download"></i>
                            </a>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
        }

        // Render Links
        if (grouped.link.length > 0) {
            html += '<div class="mb-4"><h6 class="mb-3"><i class="ti ti-link me-2"></i>Links</h6>';
            grouped.link.forEach(fav => {
                try {
                    const urlObj = new URL(fav.url);
                    const domain = urlObj.hostname.replace('www.', '');
                    const faviconUrl = `https://www.google.com/s2/favicons?domain=${domain}&sz=64`;
                    const displayUrl = fav.url.length > 60 ? fav.url.substring(0, 60) + '...' : fav.url;
                    
                    html += `
                        <div class="link-preview-card mb-3" style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; position: relative;" onclick="window.open('${fav.url}', '_blank', 'noopener,noreferrer')">
                            <div style="padding: 16px; display: flex; align-items: flex-start; gap: 12px;">
                                <div style="flex-shrink: 0; width: 48px; height: 48px; background: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                    <img src="${faviconUrl}" alt="${domain}" style="width: 32px; height: 32px; object-fit: contain;" onerror="this.style.display='none'; this.parentElement.innerHTML='<i class=\\'ti ti-link\\' style=\\'font-size: 24px; color: #6338F6;\\'></i>'">
                                </div>
                                <div style="flex: 1; min-width: 0; padding-right: 40px;">
                                    <div style="font-weight: 600; font-size: 15px; color: #212529; margin-bottom: 4px; line-height: 1.4; word-break: break-word;">
                                        ${domain}
                                    </div>
                                    <div style="font-size: 13px; color: #6c757d; line-height: 1.4; word-break: break-all; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        ${displayUrl}
                                    </div>
                                </div>
                                <a href="#" class="favorite-btn favorited" 
                                   data-message-id="${fav.message_id}" 
                                   data-media-type="${fav.media_type}" 
                                   data-url="${fav.url}"
                                   data-group-id="${fav.group_id || ''}"
                                   onclick="event.preventDefault(); event.stopPropagation(); window.groupChatManager.toggleFavorite(this);"
                                   style="position: absolute; top: 12px; right: 12px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.9); border-radius: 50%; color: #e74c3c; text-decoration: none; transition: all 0.2s; z-index: 10; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    <i class="ti ti-heart-filled" style="font-size: 16px;"></i>
                                </a>
                            </div>
                        </div>
                    `;
                } catch (e) {
                    const displayUrl = fav.url.length > 60 ? fav.url.substring(0, 60) + '...' : fav.url;
                    html += `
                        <div class="link-preview-card mb-3" style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; position: relative;" onclick="window.open('${fav.url}', '_blank', 'noopener,noreferrer')">
                            <div style="padding: 16px; display: flex; align-items: flex-start; gap: 12px;">
                                <div style="flex-shrink: 0; width: 48px; height: 48px; background: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                    <i class="ti ti-link" style="font-size: 24px; color: #6338F6;"></i>
                                </div>
                                <div style="flex: 1; min-width: 0; padding-right: 40px;">
                                    <div style="font-weight: 600; font-size: 15px; color: #212529; margin-bottom: 4px; line-height: 1.4; word-break: break-word;">
                                        Link
                                    </div>
                                    <div style="font-size: 13px; color: #6c757d; line-height: 1.4; word-break: break-all; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        ${displayUrl}
                                    </div>
                                </div>
                                <a href="#" class="favorite-btn favorited" 
                                   data-message-id="${fav.message_id}" 
                                   data-media-type="${fav.media_type}" 
                                   data-url="${fav.url}"
                                   data-group-id="${fav.group_id || ''}"
                                   onclick="event.preventDefault(); event.stopPropagation(); window.groupChatManager.toggleFavorite(this);"
                                   style="position: absolute; top: 12px; right: 12px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.9); border-radius: 50%; color: #e74c3c; text-decoration: none; transition: all 0.2s; z-index: 10; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    <i class="ti ti-heart-filled" style="font-size: 16px;"></i>
                                </a>
                            </div>
                        </div>
                    `;
                }
            });
            html += '</div>';
        }

        // Render Audio
        if (grouped.audio.length > 0) {
            html += '<div class="mb-4"><h6 class="mb-3"><i class="ti ti-music me-2"></i>Audio</h6>';
            grouped.audio.forEach(fav => {
                html += `
                    <div class="document-item mb-3">
                        <div class="d-flex align-items-center">
                            <span class="document-icon">
                                <i class="ti ti-music"></i>
                            </span>
                            <div class="ms-2 flex-grow-1">
                                <h6 class="mb-0">${fav.file_name || 'Audio File'}</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="#" class="favorite-btn favorited" 
                               data-message-id="${fav.message_id}" 
                               data-media-type="${fav.media_type}" 
                               data-file-url="${fav.file_url}" 
                               data-file-name="${fav.file_name}"
                               data-group-id="${fav.group_id || ''}"
                               onclick="event.preventDefault(); window.groupChatManager.toggleFavorite(this);">
                                <i class="ti ti-heart-filled"></i>
                            </a>
                            <a href="${fav.file_url}" download="${fav.file_name || 'audio'}" class="download-icon">
                                <i class="ti ti-download"></i>
                            </a>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
        }

        container.innerHTML = html || '<div class="text-center p-4 text-muted">No favorites yet</div>';
        
        // Add hover effects for link preview cards
        container.querySelectorAll('.link-preview-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
                this.style.borderColor = '#6338F6';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
                this.style.borderColor = '#e9ecef';
            });
        });
    }

    /**
     * Update favorites count badge
     */
    updateFavoritesCount(count) {
        const badge = document.querySelector('[data-bs-target="#contact-favourite"] .badge');
        if (badge) {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'inline-block' : 'none';
        }
    }

    /**
     * Clear all favorites (mark all as unfavorite)
     */
    async clearAllFavorites() {
        if (!confirm('Are you sure you want to remove all favorites?')) {
            return;
        }

        try {
            // Get all favorites first
            const response = await fetch('/api/chat/favorites', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            const data = await response.json();
            if (!data.success || !data.favorites) {
                return;
            }

            // Remove each favorite
            for (const favorite of data.favorites) {
                await fetch('/api/chat/favorite/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                    body: JSON.stringify({
                        message_id: favorite.message_id,
                        media_type: favorite.media_type,
                        group_id: favorite.group_id,
                    }),
                });
            }

            // Reload favorites
            await this.loadFavorites(this.currentGroupId);
            // Reload media to update heart icons
            if (this.currentGroupId) {
                await this.loadGroupMedia(this.currentGroupId);
            }
        } catch (error) {
            console.error('Failed to clear favorites:', error);
            alert('Failed to clear favorites. Please try again.');
        }
    }

    /**
     * Scroll to bottom with smooth animation
     */
    scrollToBottom(smooth = true) {
        // Use more specific selector to avoid sidebar conflict
        const container = document.querySelector('.chat-page-group');
        if (!container) return;

        // Use requestAnimationFrame to ensure DOM is updated
        requestAnimationFrame(() => {
            // Check if user is near bottom (within 100px) - if so, auto-scroll
            const isNearBottom = container.scrollHeight - container.scrollTop - container.clientHeight < 100;

            // Always scroll if it's a new message from current user, or if user is already near bottom
            if (isNearBottom || !smooth) {
                if (smooth) {
                    container.scrollTo({
                        top: container.scrollHeight,
                        behavior: 'smooth'
                    });
                } else {
                    container.scrollTop = container.scrollHeight;
                }
            }
        });
    }

    /**
     * Force scroll to bottom (used when sending messages or receiving new messages)
     */
    forceScrollToBottom(smooth = true) {
        // Use more specific selector to avoid sidebar conflict
        const container = document.querySelector('.chat-page-group');
        if (container) {
            const performScroll = () => {
                const scrollHeight = container.scrollHeight;

                // Try standard scrollTo
                container.scrollTo({
                    top: scrollHeight,
                    behavior: smooth ? 'smooth' : 'auto'
                });

                // Fallback for some browsers/scrollers
                container.scrollTop = scrollHeight;

                // If jQuery and slimScroll are available, use them as well
                if (window.jQuery && jQuery.fn.slimScroll) {
                    jQuery(container).slimScroll({
                        scrollTo: scrollHeight + 'px',
                        animate: smooth
                    });
                }
            };

            // Initial attempt
            setTimeout(performScroll, 100);

            // Multiple attempts to handle late-rendering content (images, etc)
            // Only do multiple attempts for initial load (smooth=false)
            if (!smooth) {
                [300, 600, 1000, 2000].forEach(delay => {
                    setTimeout(performScroll, delay);
                });
            }
        }
    }

    /**
     * Format file size
     */
    /**
     * Get file type information (icon, color, etc.) based on file extension
     */
    getFileTypeInfo(fileName) {
        const extension = fileName.split('.').pop()?.toLowerCase() || 'file';

        const fileTypes = {
            // Code files
            'php': { icon: 'ti ti-brand-php', color: '#777BB4', bgColor: '#E8E9F0', badgeColor: '#777BB4', badgeTextColor: '#fff' },
            'js': { icon: 'ti ti-brand-javascript', color: '#F7DF1E', bgColor: '#FEF9E7', badgeColor: '#F7DF1E', badgeTextColor: '#000' },
            'jsx': { icon: 'ti ti-brand-react', color: '#61DAFB', bgColor: '#E6F7FF', badgeColor: '#61DAFB', badgeTextColor: '#000' },
            'ts': { icon: 'ti ti-brand-typescript', color: '#3178C6', bgColor: '#E3F2FD', badgeColor: '#3178C6', badgeTextColor: '#fff' },
            'tsx': { icon: 'ti ti-brand-react', color: '#61DAFB', bgColor: '#E6F7FF', badgeColor: '#61DAFB', badgeTextColor: '#000' },
            'py': { icon: 'ti ti-brand-python', color: '#3776AB', bgColor: '#E3F2FD', badgeColor: '#3776AB', badgeTextColor: '#fff' },
            'java': { icon: 'ti ti-brand-java', color: '#ED8B00', bgColor: '#FFF3E0', badgeColor: '#ED8B00', badgeTextColor: '#fff' },
            'cpp': { icon: 'ti ti-brand-cpp', color: '#00599C', bgColor: '#E3F2FD', badgeColor: '#00599C', badgeTextColor: '#fff' },
            'c': { icon: 'ti ti-brand-cpp', color: '#A8B9CC', bgColor: '#F5F5F5', badgeColor: '#A8B9CC', badgeTextColor: '#000' },
            'cs': { icon: 'ti ti-brand-csharp', color: '#239120', bgColor: '#E8F5E9', badgeColor: '#239120', badgeTextColor: '#fff' },
            'go': { icon: 'ti ti-brand-golang', color: '#00ADD8', bgColor: '#E0F7FA', badgeColor: '#00ADD8', badgeTextColor: '#fff' },
            'rb': { icon: 'ti ti-brand-ruby', color: '#CC342D', bgColor: '#FFEBEE', badgeColor: '#CC342D', badgeTextColor: '#fff' },
            'swift': { icon: 'ti ti-brand-swift', color: '#FA7343', bgColor: '#FFF3E0', badgeColor: '#FA7343', badgeTextColor: '#fff' },
            'kt': { icon: 'ti ti-brand-kotlin', color: '#7F52FF', bgColor: '#F3E5F5', badgeColor: '#7F52FF', badgeTextColor: '#fff' },
            'html': { icon: 'ti ti-brand-html5', color: '#E34F26', bgColor: '#FFEBEE', badgeColor: '#E34F26', badgeTextColor: '#fff' },
            'css': { icon: 'ti ti-brand-css3', color: '#1572B6', bgColor: '#E3F2FD', badgeColor: '#1572B6', badgeTextColor: '#fff' },
            'scss': { icon: 'ti ti-brand-sass', color: '#CC6699', bgColor: '#FCE4EC', badgeColor: '#CC6699', badgeTextColor: '#fff' },
            'vue': { icon: 'ti ti-brand-vue', color: '#4FC08D', bgColor: '#E8F5E9', badgeColor: '#4FC08D', badgeTextColor: '#fff' },
            'json': { icon: 'ti ti-code', color: '#000000', bgColor: '#F5F5F5', badgeColor: '#000000', badgeTextColor: '#fff' },
            'xml': { icon: 'ti ti-code', color: '#FF6600', bgColor: '#FFF3E0', badgeColor: '#FF6600', badgeTextColor: '#fff' },

            // Documents
            'pdf': { icon: 'ti ti-file-type-pdf', color: '#DC143C', bgColor: '#FFEBEE', badgeColor: '#DC143C', badgeTextColor: '#fff' },
            'doc': { icon: 'ti ti-file-type-doc', color: '#2B579A', bgColor: '#E3F2FD', badgeColor: '#2B579A', badgeTextColor: '#fff' },
            'docx': { icon: 'ti ti-file-type-doc', color: '#2B579A', bgColor: '#E3F2FD', badgeColor: '#2B579A', badgeTextColor: '#fff' },
            'xls': { icon: 'ti ti-file-type-xls', color: '#1D6F42', bgColor: '#E8F5E9', badgeColor: '#1D6F42', badgeTextColor: '#fff' },
            'xlsx': { icon: 'ti ti-file-type-xls', color: '#1D6F42', bgColor: '#E8F5E9', badgeColor: '#1D6F42', badgeTextColor: '#fff' },
            'ppt': { icon: 'ti ti-file-type-ppt', color: '#D04423', bgColor: '#FFEBEE', badgeColor: '#D04423', badgeTextColor: '#fff' },
            'pptx': { icon: 'ti ti-file-type-ppt', color: '#D04423', bgColor: '#FFEBEE', badgeColor: '#D04423', badgeTextColor: '#fff' },
            'txt': { icon: 'ti ti-file-type-txt', color: '#6c757d', bgColor: '#F5F5F5', badgeColor: '#6c757d', badgeTextColor: '#fff' },
            'rtf': { icon: 'ti ti-file-text', color: '#6c757d', bgColor: '#F5F5F5', badgeColor: '#6c757d', badgeTextColor: '#fff' },

            // Archives
            'zip': { icon: 'ti ti-file-zip', color: '#FF9800', bgColor: '#FFF3E0', badgeColor: '#FF9800', badgeTextColor: '#fff' },
            'rar': { icon: 'ti ti-file-zip', color: '#FF9800', bgColor: '#FFF3E0', badgeColor: '#FF9800', badgeTextColor: '#fff' },
            '7z': { icon: 'ti ti-file-zip', color: '#FF9800', bgColor: '#FFF3E0', badgeColor: '#FF9800', badgeTextColor: '#fff' },
            'tar': { icon: 'ti ti-file-zip', color: '#FF9800', bgColor: '#FFF3E0', badgeColor: '#FF9800', badgeTextColor: '#fff' },
            'gz': { icon: 'ti ti-file-zip', color: '#FF9800', bgColor: '#FFF3E0', badgeColor: '#FF9800', badgeTextColor: '#fff' },

            // Default
            'file': { icon: 'ti ti-file', color: '#6c757d', bgColor: '#F5F5F5', badgeColor: '#6c757d', badgeTextColor: '#fff' }
        };

        return {
            ...fileTypes[extension] || fileTypes['file'],
            extension: extension
        };
    }

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

    /**
     * Format message content with highlighted mentions
     */
    formatMessageWithMentions(content) {
        if (!content) return '';

        // Escape HTML first
        const escaped = this.escapeHtml(content);

        // First, convert URLs to clickable links
        // Pattern: http://, https://, or www. followed by valid URL characters
        // This regex matches URLs with or without protocol
        const urlRegex = /(https?:\/\/[^\s<>"{}|\\^`\[\]]+|www\.[^\s<>"{}|\\^`\[\]]+|[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}[^\s<>"{}|\\^`\[\]]*)/gi;
        
        let processed = escaped.replace(urlRegex, (url) => {
            // Ensure URL has protocol
            let href = url;
            if (!href.match(/^https?:\/\//i)) {
                if (href.match(/^www\./i)) {
                    href = 'https://' + href;
                } else {
                    href = 'https://' + href;
                }
            }
            
            // Create clickable link that opens in new tab
            // Use a lighter blue color with better contrast and underline for visibility
            return `<a href="${this.escapeHtml(href)}" target="_blank" rel="noopener noreferrer" style="color: #4A90E2; text-decoration: underline; word-break: break-all; font-weight: 500; opacity: 0.9;" onclick="event.stopPropagation();">${this.escapeHtml(url)}</a>`;
        });

        // Then, replace @mentions with highlighted spans
        // Pattern: @ followed by name (letters, numbers, spaces, hyphens, underscores, dots)
        // Stop at space, newline, punctuation (except @), or end of string
        // This matches: @username, @John Doe, @user.name, etc.
        // But don't match if it's inside a link tag
        const mentionRegex = /@([\w\s\-\.]+?)(?=\s|$|@|[^\w\s\-\.]|[\n\r])/g;
        let result = processed;
        let match;
        const replacements = [];
        
        // First, collect all mentions with their positions
        while ((match = mentionRegex.exec(processed)) !== null) {
            const matchIndex = match.index;
            const beforeMatch = processed.substring(0, matchIndex);
            const lastOpenTag = beforeMatch.lastIndexOf('<a');
            const lastCloseTag = beforeMatch.lastIndexOf('</a>');
            
            // If not inside a link tag, mark for replacement
            if (lastOpenTag <= lastCloseTag) {
                const trimmedName = match[1].trim();
                if (trimmedName && trimmedName.length > 0) {
                    replacements.push({
                        index: matchIndex,
                        length: match[0].length,
                        replacement: `<span class="mention-highlight" style="color: #1a73e8; font-weight: 600; background-color: rgba(26, 115, 232, 0.1); padding: 2px 6px; border-radius: 4px; display: inline-block;">@${this.escapeHtml(trimmedName)}</span>`
                    });
                }
            }
        }
        
        // Apply replacements in reverse order to maintain indices
        for (let i = replacements.length - 1; i >= 0; i--) {
            const rep = replacements[i];
            result = result.substring(0, rep.index) + rep.replacement + result.substring(rep.index + rep.length);
        }
        
        return result;
    }

    /**
     * Load group members for mentions
     */
    async loadGroupMembers() {
        if (!this.currentGroupId) return;

        try {
            const response = await fetch(`/api/chat/group/${this.currentGroupId}/members`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
            });

            const data = await response.json();
            if (data.success && data.members) {
                // Filter out current user from mentions list
                const currentUserIdStr = String(this.currentUserId || window.currentUserId || '').trim();

                this.groupMembers = data.members.filter(member => {
                    const memberId = String(member.id || member._id || '').trim();
                    // Keep if member ID is not empty and not equal to current user ID
                    return memberId !== '' && memberId !== currentUserIdStr;
                });

                console.log('✅ Loaded group members for mentions:', this.groupMembers.length);
            }
        } catch (error) {
            console.error('Failed to load group members:', error);
        }
    }

    /**
     * Setup mention functionality
     */
    setupMentionHandler() {
        const messageInput = document.querySelector('.chat-footer-wrap .form-control');
        if (!messageInput) {
            console.warn('Mention handler: Message input not found');
            return;
        }

        console.log('Setting up mention handler');

        // Remove existing handlers
        if (this.handleMentionInput) {
            messageInput.removeEventListener('input', this.handleMentionInput);
        }
        if (this.handleMentionKeydown) {
            messageInput.removeEventListener('keydown', this.handleMentionKeydown);
        }

        // Bind handlers
        this.handleMentionInput = this.handleMentionInput.bind(this);
        this.handleMentionKeydown = this.handleMentionKeydown.bind(this);

        messageInput.addEventListener('input', this.handleMentionInput);
        messageInput.addEventListener('keydown', this.handleMentionKeydown);

        // Also listen for keypress to catch @ immediately
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === '@' || e.keyCode === 64) {
                // Small delay to let the @ character be added to input
                setTimeout(() => {
                    this.handleMentionInput({ target: messageInput });
                }, 10);
            }
        });

        // Close dropdown when clicking outside
        if (!this.clickOutsideHandler) {
            this.clickOutsideHandler = (e) => {
                if (this.mentionDropdown && !this.mentionDropdown.contains(e.target) && e.target !== messageInput) {
                    this.hideMentionDropdown();
                }
            };
            document.addEventListener('click', this.clickOutsideHandler);
        }
    }

    /**
     * Handle input for mentions
     */
    handleMentionInput(e) {
        const input = e.target;
        const value = input.value;
        const cursorPos = input.selectionStart || value.length;

        // Check if @ was typed
        const textBeforeCursor = value.substring(0, cursorPos);
        const lastAtIndex = textBeforeCursor.lastIndexOf('@');

        if (lastAtIndex !== -1) {
            // Check if there's a space after @ (meaning mention is complete)
            const textAfterAt = textBeforeCursor.substring(lastAtIndex + 1);
            if (textAfterAt.includes(' ') || textAfterAt.includes('\n')) {
                this.hideMentionDropdown();
                return;
            }

            // Check if we have group members loaded
            if (!this.groupMembers || this.groupMembers.length === 0) {
                console.warn('No group members loaded yet');
                // Try to load members if not loaded
                if (this.currentGroupId) {
                    this.loadGroupMembers().then(() => {
                        // Retry showing dropdown after loading
                        if (this.groupMembers && this.groupMembers.length > 0) {
                            this.mentionStartPos = lastAtIndex;
                            const searchQuery = textAfterAt.toLowerCase();
                            this.showMentionDropdown(searchQuery, input);
                        }
                    });
                }
                return;
            }

            // Show mention dropdown
            this.mentionStartPos = lastAtIndex;
            const searchQuery = textAfterAt.toLowerCase();
            this.showMentionDropdown(searchQuery, input);
        } else {
            this.hideMentionDropdown();
        }
    }

    /**
     * Handle keydown for mentions
     */
    handleMentionKeydown(e) {
        if (!this.mentionDropdown || !this.mentionDropdown.parentElement) {
            return;
        }

        const items = this.mentionDropdown.querySelectorAll('.mention-item');
        if (items.length === 0) return;

        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                this.selectedMentionIndex = Math.min(this.selectedMentionIndex + 1, items.length - 1);
                this.updateMentionSelection(items);
                break;
            case 'ArrowUp':
                e.preventDefault();
                this.selectedMentionIndex = Math.max(this.selectedMentionIndex - 1, -1);
                this.updateMentionSelection(items);
                break;
            case 'Enter':
            case 'Tab':
                e.preventDefault();
                if (this.selectedMentionIndex >= 0 && items[this.selectedMentionIndex]) {
                    items[this.selectedMentionIndex].click();
                }
                break;
            case 'Escape':
                e.preventDefault();
                this.hideMentionDropdown();
                break;
        }
    }

    /**
     * Show mention dropdown
     */
    showMentionDropdown(searchQuery, input) {
        console.log('Showing mention dropdown, query:', searchQuery, 'members:', this.groupMembers.length);

        // Filter members based on search query
        const filteredMembers = this.groupMembers.filter(member => {
            const name = (member.name || '').toLowerCase();
            const email = (member.email || '').toLowerCase();
            return name.includes(searchQuery) || email.includes(searchQuery);
        });

        console.log('Filtered members:', filteredMembers.length);

        if (filteredMembers.length === 0) {
            this.hideMentionDropdown();
            return;
        }

        // Create or update dropdown
        if (!this.mentionDropdown) {
            this.mentionDropdown = document.createElement('div');
            this.mentionDropdown.className = 'mention-dropdown';
            this.mentionDropdown.style.cssText = `
                position: absolute;
                bottom: 100%;
                left: 0;
                background: white;
                border: 1px solid #ddd;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                max-height: 200px;
                overflow-y: auto;
                z-index: 1000;
                min-width: 250px;
                margin-bottom: 5px;
            `;
        }

        // Clear and populate dropdown
        this.mentionDropdown.innerHTML = '';
        this.selectedMentionIndex = -1;

        filteredMembers.forEach((member, index) => {
            const item = document.createElement('div');
            item.className = 'mention-item';
            item.style.cssText = `
                padding: 10px 15px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 10px;
                border-bottom: 1px solid #f0f0f0;
            `;
            item.innerHTML = `
                <img src="${member.avatar || '/build/img/profiles/avatar-06.jpg'}" 
                     style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;" 
                     onerror="this.src='/build/img/profiles/avatar-06.jpg'">
                <div style="flex: 1;">
                    <div style="font-weight: 500; font-size: 14px; color: #333;">${this.escapeHtml(member.name)}</div>
                </div>
            `;

            item.addEventListener('click', () => {
                this.insertMention(member, input);
            });

            item.addEventListener('mouseenter', () => {
                this.selectedMentionIndex = index;
                this.updateMentionSelection(this.mentionDropdown.querySelectorAll('.mention-item'));
            });

            this.mentionDropdown.appendChild(item);
        });

        // Append to input wrapper
        const inputWrapper = input.closest('.form-wrap');
        if (inputWrapper) {
            if (!inputWrapper.contains(this.mentionDropdown)) {
                inputWrapper.style.position = 'relative';
                inputWrapper.appendChild(this.mentionDropdown);
            }
        }
    }

    /**
     * Update mention selection highlight
     */
    updateMentionSelection(items) {
        items.forEach((item, index) => {
            if (index === this.selectedMentionIndex) {
                item.style.backgroundColor = '#f0f0f0';
            } else {
                item.style.backgroundColor = 'transparent';
            }
        });
    }

    /**
     * Insert mention into input
     */
    insertMention(member, input) {
        const value = input.value;
        const cursorPos = input.selectionStart;
        const textBeforeCursor = value.substring(0, this.mentionStartPos);
        const textAfterCursor = value.substring(cursorPos);

        // Insert mention
        const mentionText = `@${member.name} `;
        const newValue = textBeforeCursor + mentionText + textAfterCursor;

        input.value = newValue;
        input.focus();

        // Set cursor position after mention
        const newCursorPos = this.mentionStartPos + mentionText.length;
        input.setSelectionRange(newCursorPos, newCursorPos);

        // Hide dropdown
        this.hideMentionDropdown();
    }

    /**
     * Hide mention dropdown
     */
    hideMentionDropdown() {
        if (this.mentionDropdown && this.mentionDropdown.parentElement) {
            this.mentionDropdown.remove();
        }
        this.mentionStartPos = null;
        this.selectedMentionIndex = -1;
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

    // Setup message input handler (WhatsApp-style: prefer #chatMessageInput and #chatSendBtn)
    const messageInput = document.getElementById('chatMessageInput') || document.querySelector('.chat-footer-wrap .form-control');
    const sendButton = document.getElementById('chatSendBtn') || document.querySelector('.chat-footer-wrap .form-btn button, .chat-footer-wrap .form-btn a');

    async function sendAllAttachmentsAndText(content) {
        const selectedFiles = window.selectedFiles || [];
        if (selectedFiles.length === 0) return false;
        const fileInput = document.getElementById('files');
        for (let i = 0; i < selectedFiles.length; i++) {
            const item = selectedFiles[i];
            const messageContent = (i === 0 && content) ? content : (item.messageType === 'img' ? 'Image' : (item.file.name || ''));
            await window.groupChatManager.sendMessage(messageContent, item.messageType, item.file);
        }
        if (window.clearChatAttachments) window.clearChatAttachments();
        if (fileInput) fileInput.value = '';
        if (messageInput) messageInput.value = '';
        return true;
    }

    if (messageInput) {
        messageInput.addEventListener('keypress', async (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                const mentionDropdown = document.querySelector('.mention-dropdown');
                if (mentionDropdown && mentionDropdown.parentElement) return;
                e.preventDefault();
                const content = messageInput.value.trim();
                const selectedFiles = window.selectedFiles || [];
                const selectedFile = window.selectedFile || null;
                const selectedFileType = window.selectedFileType || null;
                if (content || selectedFiles.length > 0 || selectedFile) {
                    if (selectedFiles.length > 0) {
                        try {
                            await sendAllAttachmentsAndText(content);
                        } catch (err) {
                            console.error('Error sending files:', err);
                            alert('Failed to send: ' + (err.message || 'Unknown error'));
                        }
                    } else if (selectedFile) {
                        try {
                            // One message: image + your text as caption in same frame
                            const messageContent = content || (selectedFileType === 'img' ? 'Image' : selectedFile.name);
                            await window.groupChatManager.sendMessage(messageContent, selectedFileType, selectedFile);
                            window.selectedFile = null;
                            window.selectedFileType = null;
                            const fileInput = document.getElementById('files');
                            if (fileInput) fileInput.value = '';
                            if (window.removeFilePreview) window.removeFilePreview();
                            if (messageInput) messageInput.value = '';
                        } catch (error) {
                            console.error('Error sending file:', error);
                            alert('Failed to send file: ' + (error.message || 'Unknown error'));
                        }
                    } else {
                        window.groupChatManager.sendMessage(content);
                    }
                }
            }
        });

        // Setup mention handler after input is found
        if (window.groupChatManager && messageInput) {
            // Wait a bit for group to potentially be opened
            setTimeout(() => {
                window.groupChatManager.setupMentionHandler();
            }, 500);
        }
    }

    if (sendButton) {
        sendButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const content = messageInput ? messageInput.value.trim() : '';
            const selectedFiles = window.selectedFiles || [];
            const selectedFile = window.selectedFile || null;
            const selectedFileType = window.selectedFileType || null;
            const fileInput = document.getElementById('files');
            if (!content && selectedFiles.length === 0 && !selectedFile) return;
            if (selectedFiles.length > 0) {
                try {
                    sendButton.disabled = true;
                    sendButton.innerHTML = '<i class="ti ti-loader-2"></i>';
                    await sendAllAttachmentsAndText(content);
                } catch (err) {
                    console.error('Error sending files:', err);
                    alert('Failed to send: ' + (err.message || 'Unknown error'));
                } finally {
                    sendButton.disabled = false;
                    sendButton.innerHTML = '<i class="ti ti-send"></i>';
                }
                return;
            }
            if (selectedFile) {
                try {
                    sendButton.disabled = true;
                    sendButton.innerHTML = '<i class="ti ti-loader-2"></i>';
                    // Image + text in ONE message: content is the caption, shown in same bubble as image
                    const messageContent = content || (selectedFileType === 'img' ? 'Image' : selectedFile.name);
                    await window.groupChatManager.sendMessage(messageContent, selectedFileType, selectedFile);
                    window.selectedFile = null;
                    window.selectedFileType = null;
                    if (fileInput) fileInput.value = '';
                    if (window.removeFilePreview) window.removeFilePreview();
                    if (messageInput) messageInput.value = '';
                } catch (error) {
                    console.error('Error sending file:', error);
                    alert('Failed to send file: ' + (error.message || 'Unknown error'));
                } finally {
                    sendButton.disabled = false;
                    sendButton.innerHTML = '<i class="ti ti-send"></i>';
                }
                return;
            }
            window.groupChatManager.sendMessage(content);
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
