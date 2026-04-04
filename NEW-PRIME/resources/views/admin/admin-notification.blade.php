<div class="notification-container">
    <button class="notification-bell" id="notificationBell" onclick="toggleNotifications()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
        <span class="notification-badge" id="notificationBadge">5</span>
    </button>
    
    <div class="notification-dropdown" id="notificationDropdown" style="display: none;">
        <div class="notification-header">
            <h3>Notifications</h3>
            <button class="notification-mark-read" onclick="markAllAsRead()">Mark all as read</button>
        </div>
        <div class="notification-list">
            <div class="notification-item unread" data-id="1">
                <div class="notification-icon" style="background: #e8f9ef;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>
                <div class="notification-content">
                    <p class="notification-title">Leave Request Approved</p>
                    <p class="notification-text">Juan Dela Cruz's vacation leave has been approved</p>
                    <p class="notification-time">5 minutes ago</p>
                </div>
                <button class="notification-close" onclick="dismissNotification(1)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="notification-item unread" data-id="2">
                <div class="notification-icon" style="background: #fefce8;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#a16207" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div class="notification-content">
                    <p class="notification-title">New Employee Added</p>
                    <p class="notification-text">Maria Reyes has been added to the system</p>
                    <p class="notification-time">1 hour ago</p>
                </div>
                <button class="notification-close" onclick="dismissNotification(2)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="notification-item unread" data-id="3">
                <div class="notification-icon" style="background: #f0effe;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2">
                        <rect x="1" y="4" width="22" height="16" rx="2"/>
                        <line x1="1" y1="10" x2="23" y2="10"/>
                    </svg>
                </div>
                <div class="notification-content">
                    <p class="notification-title">Payroll Processing</p>
                    <p class="notification-text">June 16-30 payroll is ready for review</p>
                    <p class="notification-time">2 hours ago</p>
                </div>
                <button class="notification-close" onclick="dismissNotification(3)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="notification-item" data-id="4">
                <div class="notification-icon" style="background: #fdf0ef;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#8e1e18" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                </div>
                <div class="notification-content">
                    <p class="notification-title">DTR Submission Reminder</p>
                    <p class="notification-text">8 employees haven't submitted their DTR</p>
                    <p class="notification-time">3 hours ago</p>
                </div>
                <button class="notification-close" onclick="dismissNotification(4)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="notification-item" data-id="5">
                <div class="notification-icon" style="background: #e8f9ef;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2">
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                        <path d="M9 14l2 2 4-4"/>
                    </svg>
                </div>
                <div class="notification-content">
                    <p class="notification-title">Training Completed</p>
                    <p class="notification-text">Leadership Development Program completed by 25 employees</p>
                    <p class="notification-time">Yesterday</p>
                </div>
                <button class="notification-close" onclick="dismissNotification(5)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="notification-footer">
            <a href="#" class="notification-view-all">View all notifications</a>
        </div>
    </div>
</div>

<script>
    function toggleNotifications() {
        const dropdown = document.getElementById('notificationDropdown');
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    }

    function dismissNotification(id) {
        const item = document.querySelector(`.notification-item[data-id="${id}"]`);
        if (item) {
            item.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => {
                item.remove();
                updateNotificationBadge();
            }, 300);
        }
    }

    function markAllAsRead() {
        document.querySelectorAll('.notification-item.unread').forEach(item => {
            item.classList.remove('unread');
        });
        updateNotificationBadge();
    }

    function updateNotificationBadge() {
        const unreadCount = document.querySelectorAll('.notification-item.unread').length;
        const badge = document.getElementById('notificationBadge');
        if (unreadCount > 0) {
            badge.textContent = unreadCount;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    }

    document.addEventListener('click', function(event) {
        const notificationContainer = document.querySelector('.notification-container');
        const dropdown = document.getElementById('notificationDropdown');
        if (notificationContainer && !notificationContainer.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });

    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideOut {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(100%); }
        }
    `;
    document.head.appendChild(style);
</script>
