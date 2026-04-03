<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | PRIME HRIS - Permanent Employee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #f8f7fc; min-height: 100vh; }
        
        .app-layout { display: flex; min-height: 100vh; }
        
        .sidebar { width: 260px; background: #fff; border-right: 1px solid #e5e4f0; display: flex; flex-direction: column; position: fixed; height: 100vh; transition: all 0.3s; z-index: 100; }
        .sidebar.collapsed { width: 70px; }
        .sidebar-header { padding: 20px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e5e4f0; }
        .logo { display: flex; align-items: center; gap: 10px; }
        .logo-mark { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #0b044d, #2d1a8e); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800; font-size: 14px; }
        .logo-text { font-size: 16px; font-weight: 800; color: #0b044d; }
        .logo-sub { font-size: 10px; color: #9999bb; display: block; }
        .toggle-btn { background: none; border: none; font-size: 20px; cursor: pointer; color: #6b6a8a; padding: 4px 8px; }
        .sidebar.collapsed .logo-text, .sidebar.collapsed .logo-sub, .sidebar.collapsed .nav-label, .sidebar.collapsed .nav-active-bar { display: none; }
        
        .nav-section-label { font-size: 10px; font-weight: 700; color: #9999bb; padding: 20px 20px 10px; letter-spacing: 1px; }
        .sidebar.collapsed .nav-section-label { display: none; }
        
        .sidebar-nav { flex: 1; padding: 0 10px; overflow-y: auto; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; text-decoration: none; color: #6b6a8a; font-size: 13px; font-weight: 500; position: relative; margin-bottom: 4px; transition: all 0.15s; }
        .nav-item:hover { background: #f8f7fc; color: #0b044d; }
        .nav-item.active { background: #0b044d; color: #fff; }
        .nav-item.active .nav-icon svg { stroke: #fff; }
        .nav-icon { width: 20px; height: 20px; display: flex; align-items: center; }
        .nav-icon svg { width: 18px; height: 18px; }
        .nav-active-bar { position: absolute; right: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 20px; background: #0b044d; border-radius: 2px; }
        .sidebar.collapsed .nav-active-bar { display: none; }
        
        .sidebar-footer { padding: 16px; border-top: 1px solid #e5e4f0; display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #8e1e18, #5a0f0b); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 12px; font-weight: 700; }
        .user-info { flex: 1; }
        .user-name { font-size: 13px; font-weight: 600; color: #0b044d; }
        .user-role { font-size: 11px; color: #9999bb; }
        .logout-btn { background: none; border: none; cursor: pointer; color: #9999bb; padding: 6px; }
        
        .main-content { flex: 1; margin-left: 260px; padding: 24px 28px; transition: margin-left 0.3s; }
        .sidebar.collapsed + .main-content, .sidebar.collapsed ~ .main-content { margin-left: 70px; }
        
        .settings-container { display: flex; gap: 24px; }
        .settings-sidebar { width: 280px; flex-shrink: 0; }
        .settings-profile-card { background: linear-gradient(135deg, #8e1e18 0%, #b02a1f 100%); border-radius: 16px; padding: 24px; margin-bottom: 16px; }
        .settings-profile-avatar { width: 56px; height: 56px; border-radius: 50%; background: #fff; display: flex; align-items: center; justify-content: center; color: #8e1e18; font-size: 18px; font-weight: 700; margin-bottom: 12px; }
        .settings-profile-name { font-size: 16px; font-weight: 700; color: #fff; margin-bottom: 2px; }
        .settings-profile-role { font-size: 12px; color: rgba(255,255,255,0.7); margin-bottom: 16px; }
        .settings-profile-info-item { margin-bottom: 12px; }
        .settings-profile-info-item p:first-child { font-size: 10px; color: rgba(255,255,255,0.5); font-weight: 600; letter-spacing: 0.5px; margin-bottom: 2px; }
        .settings-profile-info-item p:last-child { font-size: 12px; color: #fff; font-weight: 600; }
        
        .settings-nav { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; overflow: hidden; }
        .settings-nav-item { display: flex; align-items: center; gap: 12px; width: 100%; padding: 14px 18px; border: none; background: none; font-size: 13px; font-weight: 500; color: #6b6a8a; cursor: pointer; text-align: left; transition: all 0.15s; position: relative; }
        .settings-nav-item:hover { background: #f8f7fc; }
        .settings-nav-item.active { background: #8e1e18; color: #fff; }
        .settings-nav-arrow { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); }
        
        .settings-tip { background: #fefce8; border-radius: 14px; border: 1px solid #fde68a; padding: 16px; margin-top: 16px; }
        .settings-tip-header { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
        .settings-tip-title { font-size: 10px; font-weight: 700; color: #a16207; letter-spacing: 0.5px; }
        .settings-tip-text { font-size: 12px; color: #92400e; line-height: 1.5; }
        
        .settings-content { flex: 1; }
        .settings-section { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; margin-bottom: 20px; }
        .settings-section-title { font-size: 14px; font-weight: 700; color: #0b044d; padding: 18px 20px; border-bottom: 1px solid #e5e4f0; }
        .settings-section-content { padding: 20px; }
        
        .settings-form-wrapper { margin-bottom: 20px; }
        .settings-avatar-row { display: flex; align-items: center; gap: 16px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #f0effe; }
        .settings-avatar { width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; font-weight: 700; }
        .settings-avatar-name { font-size: 15px; font-weight: 700; color: #0b044d; margin-bottom: 2px; }
        .settings-avatar-role { font-size: 12px; color: #6b6a8a; }
        
        .settings-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .settings-form-field { }
        .settings-form-field label { display: block; font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .settings-form-field input { width: 100%; padding: 10px 14px; border-radius: 8px; border: 1.5px solid #e5e4f0; font-size: 13px; font-family: 'Poppins', sans-serif; }
        .settings-form-field input:focus { outline: none; border-color: #0b044d; }
        
        .settings-row { display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #f4f3ff; }
        .settings-row:last-child { border-bottom: none; }
        .settings-row-label p:first-child { font-size: 13px; font-weight: 600; color: #0b044d; margin-bottom: 2px; }
        .settings-row-label p:last-child { font-size: 11px; color: #9999bb; }
        
        .settings-toggle { width: 44px; height: 24px; border-radius: 12px; background: #e5e4f0; border: none; cursor: pointer; position: relative; transition: background 0.2s; }
        .settings-toggle.active { background: #15803d; }
        .settings-toggle-thumb { position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; border-radius: 50%; background: #fff; transition: transform 0.2s; }
        .settings-toggle.active .settings-toggle-thumb { transform: translateX(20px); }
        
        .settings-select { padding: 8px 12px; border-radius: 8px; border: 1.5px solid #e5e4f0; font-size: 13px; font-family: 'Poppins', sans-serif; background: #fff; }
        
        .settings-message { font-size: 13px; padding: 10px 14px; border-radius: 8px; margin-bottom: 12px; }
        .settings-message.success { background: #f0fdf4; color: #15803d; }
        .settings-message.error { background: #fef2f2; color: #dc2626; }
        
        .settings-save-bar { display: flex; justify-content: flex-end; gap: 10px; padding-top: 16px; border-top: 1px solid #f0effe; margin-top: 16px; }
        .settings-btn-reset { padding: 10px 20px; border-radius: 9px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 13px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .settings-btn-save { padding: 10px 20px; border-radius: 9px; border: none; background: #8e1e18; font-size: 13px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        .settings-btn-save.saved { background: #15803d; }
        .settings-btn-primary { padding: 10px 20px; border-radius: 9px; border: none; background: #8e1e18; font-size: 13px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        
        .notif-readonly { background: #f7f6ff; padding: 5px 12px; border-radius: 7px; font-size: 13px; font-weight: 600; color: #5a5888; }
        
        .hidden { display: none; }
    </style>
</head>
<body>
    <div class="app-layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-mark">P</div>
                    <div>
                        <div class="logo-text">PRIME HRIS</div>
                        <span class="logo-sub">Pagsanjan</span>
                    </div>
                </div>
                <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
            </div>
            
            <div class="nav-section-label">MAIN MENU</div>
            <nav class="sidebar-nav">
                <a href="/permanent/dashboard" class="nav-item">Dashboard</a>
                <a href="/permanent/payslip" class="nav-item">Payslip</a>
                <a href="/permanent/attendance" class="nav-item">Attendance</a>
                <a href="/permanent/leave" class="nav-item">Leave & Benefits</a>
                <a href="/permanent/training" class="nav-item">Training</a>
                <a href="/permanent/performance" class="nav-item">Performance</a>
                <a href="/permanent/profile" class="nav-item">Profile</a>
                <a href="/permanent/settings" class="nav-item active"><span class="nav-active-bar"></span>Settings</a>
            </nav>
            
            <div class="sidebar-footer">
                <div class="user-avatar">AR</div>
                <div class="user-info">
                    <div class="user-name">Ana R. Reyes</div>
                    <div class="user-role">Permanent Employee</div>
                </div>
                <button class="logout-btn">⏻</button>
            </div>
        </aside>
        
        <main class="main-content">
            <div class="settings-container">
                <div class="settings-sidebar">
                    <div class="settings-profile-card">
                        <div class="settings-profile-avatar">AR</div>
                        <h3 class="settings-profile-name">Ana R. Reyes</h3>
                        <p class="settings-profile-role">PGS-0115</p>
                        <div class="settings-profile-info">
                            <div class="settings-profile-info-item">
                                <p>POSITION</p>
                                <p>Nurse II</p>
                            </div>
                            <div class="settings-profile-info-item">
                                <p>DEPARTMENT</p>
                                <p>Municipal Health Office</p>
                            </div>
                            <div class="settings-profile-info-item">
                                <p>TYPE</p>
                                <p>Permanent</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-nav">
                        <button class="settings-nav-item active" onclick="switchTab('profile', this)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <span>Profile</span>
                        </button>
                        <button class="settings-nav-item" onclick="switchTab('security', this)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <span>Security</span>
                        </button>
                        <button class="settings-nav-item" onclick="switchTab('notifications', this)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                            <span>Notifications</span>
                        </button>
                    </div>
                    
                    <div class="settings-tip">
                        <div class="settings-tip-header">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d9bb00" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                            <p class="settings-tip-title">QUICK TIP</p>
                        </div>
                        <p class="settings-tip-text">Keep your profile updated for accurate payroll processing.</p>
                    </div>
                </div>
                
                <div class="settings-content">
                    <div id="tab-profile">
                        <div class="settings-section">
                            <h3 class="settings-section-title">Personal Information</h3>
                            <div class="settings-section-content">
                                <div class="settings-form-wrapper">
                                    <div class="settings-avatar-row">
                                        <div class="settings-avatar" style="background:#8e1e18;">AR</div>
                                        <div class="settings-avatar-info">
                                            <p class="settings-avatar-name">Ana R. Reyes</p>
                                            <p class="settings-avatar-role">Nurse II · Municipal Health Office</p>
                                        </div>
                                    </div>
                                    
                                    <div class="settings-form-grid">
                                        <div class="settings-form-field">
                                            <label>First Name</label>
                                            <input type="text" value="Ana">
                                        </div>
                                        <div class="settings-form-field">
                                            <label>Last Name</label>
                                            <input type="text" value="R. Reyes">
                                        </div>
                                        <div class="settings-form-field">
                                            <label>Email Address</label>
                                            <input type="email" value="ana.reyes@pagsanjan.gov.ph">
                                        </div>
                                        <div class="settings-form-field">
                                            <label>Contact No.</label>
                                            <input type="text" value="09201122334">
                                        </div>
                                    </div>
                                    <div class="settings-save-bar">
                                        <button class="settings-btn-reset">Reset</button>
                                        <button class="settings-btn-save">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="settings-section">
                            <h3 class="settings-section-title">Employment Details</h3>
                            <div class="settings-section-content">
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Employee ID</p>
                                        <p class="settings-row-desc">Assigned by HR — not editable</p>
                                    </div>
                                    <span class="notif-readonly">PGS-0115</span>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Position</p>
                                        <p class="settings-row-desc">Assigned by HR — not editable</p>
                                    </div>
                                    <span class="notif-readonly">Nurse II</span>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Department</p>
                                        <p class="settings-row-desc">Assigned by HR — not editable</p>
                                    </div>
                                    <span class="notif-readonly">Municipal Health Office</span>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Employment Type</p>
                                        <p class="settings-row-desc">Assigned by HR — not editable</p>
                                    </div>
                                    <span class="notif-readonly">Permanent</span>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Date Hired</p>
                                        <p class="settings-row-desc">Assigned by HR — not editable</p>
                                    </div>
                                    <span class="notif-readonly">Jan 15, 2018</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="tab-security" class="hidden">
                        <div class="settings-section">
                            <h3 class="settings-section-title">Change Password</h3>
                            <div class="settings-section-content">
                                <div class="settings-form-wrapper">
                                    <div class="settings-form-field" style="margin-bottom:12px;">
                                        <label>Current Password</label>
                                        <input type="password" placeholder="••••••••">
                                    </div>
                                    <div class="settings-form-field" style="margin-bottom:12px;">
                                        <label>New Password</label>
                                        <input type="password" placeholder="••••••••">
                                    </div>
                                    <div class="settings-form-field" style="margin-bottom:16px;">
                                        <label>Confirm New Password</label>
                                        <input type="password" placeholder="••••••••">
                                    </div>
                                    <p class="settings-message success hidden" id="pwMsg"></p>
                                    <button class="settings-btn-primary" onclick="changePassword()">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="settings-section">
                            <h3 class="settings-section-title">Login Security</h3>
                            <div class="settings-section-content">
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Two-Factor Authentication</p>
                                        <p class="settings-row-desc">Require OTP on every login</p>
                                    </div>
                                    <button class="settings-toggle" id="twoFA" onclick="toggleSetting(this)">
                                        <span class="settings-toggle-thumb"></span>
                                    </button>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Session Timeout</p>
                                        <p class="settings-row-desc">Auto-logout after inactivity</p>
                                    </div>
                                    <select class="settings-select">
                                        <option value="15">15 minutes</option>
                                        <option value="30" selected>30 minutes</option>
                                        <option value="60">1 hour</option>
                                        <option value="120">2 hours</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="tab-notifications" class="hidden">
                        <div class="settings-section">
                            <h3 class="settings-section-title">In-App Notifications</h3>
                            <div class="settings-section-content">
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Payslip Available</p>
                                        <p class="settings-row-desc">Notify when your monthly payslip is ready</p>
                                    </div>
                                    <button class="settings-toggle active" onclick="toggleSetting(this)">
                                        <span class="settings-toggle-thumb"></span>
                                    </button>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Leave Status Update</p>
                                        <p class="settings-row-desc">Notify when your leave request is approved or rejected</p>
                                    </div>
                                    <button class="settings-toggle active" onclick="toggleSetting(this)">
                                        <span class="settings-toggle-thumb"></span>
                                    </button>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">DTR Deadline Reminder</p>
                                        <p class="settings-row-desc">Remind before DTR submission deadline</p>
                                    </div>
                                    <button class="settings-toggle active" onclick="toggleSetting(this)">
                                        <span class="settings-toggle-thumb"></span>
                                    </button>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Attendance Alert</p>
                                        <p class="settings-row-desc">Notify when a late or absent entry is recorded</p>
                                    </div>
                                    <button class="settings-toggle" onclick="toggleSetting(this)">
                                        <span class="settings-toggle-thumb"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="settings-section">
                            <h3 class="settings-section-title">Email Notifications</h3>
                            <div class="settings-section-content">
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Email Digest</p>
                                        <p class="settings-row-desc">Receive a daily summary of updates via email</p>
                                    </div>
                                    <button class="settings-toggle active" onclick="toggleSetting(this)">
                                        <span class="settings-toggle-thumb"></span>
                                    </button>
                                </div>
                                <div class="settings-form-wrapper">
                                    <div class="settings-save-bar">
                                        <button class="settings-btn-reset">Reset</button>
                                        <button class="settings-btn-save">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
        
        function switchTab(tabId, btn) {
            document.querySelectorAll('.settings-nav-item').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.querySelectorAll('#tab-profile, #tab-security, #tab-notifications').forEach(t => t.classList.add('hidden'));
            document.getElementById('tab-' + tabId).classList.remove('hidden');
        }
        
        function toggleSetting(btn) {
            btn.classList.toggle('active');
        }
        
        function changePassword() {
            const msg = document.getElementById('pwMsg');
            msg.textContent = '✓ Password changed successfully.';
            msg.classList.remove('hidden');
            setTimeout(() => msg.classList.add('hidden'), 3000);
        }
    </script>
</body>
</html>