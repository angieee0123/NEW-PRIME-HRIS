<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | PRIME HRIS - Job Order Employee</title>
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
        
        .nav-section-label { font-size: 10px; font-weight: 700; color: #9999bb; padding: 20px 20px 10px; letter-spacing: 1px; }
        
        .sidebar-nav { flex: 1; padding: 0 10px; overflow-y: auto; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; text-decoration: none; color: #6b6a8a; font-size: 13px; font-weight: 500; position: relative; margin-bottom: 4px; transition: all 0.15s; }
        .nav-item:hover { background: #f8f7fc; color: #0b044d; }
        .nav-item.active { background: #15803d; color: #fff; }
        .nav-icon { width: 20px; height: 20px; display: flex; align-items: center; }
        .nav-icon svg { width: 18px; height: 18px; }
        .nav-active-bar { position: absolute; right: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 20px; background: #15803d; border-radius: 2px; }
        
        .sidebar-footer { padding: 16px; border-top: 1px solid #e5e4f0; display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #1a6e3c, #145c30); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 12px; font-weight: 700; }
        .user-info { flex: 1; }
        .user-name { font-size: 13px; font-weight: 600; color: #0b044d; }
        .user-role { font-size: 11px; color: #9999bb; }
        .logout-btn { background: none; border: none; cursor: pointer; color: #9999bb; padding: 6px; }
        
        .main-content { flex: 1; margin-left: 260px; padding: 24px 28px; transition: margin-left 0.3s; }
        
        .settings-container { display: flex; gap: 24px; max-width: 1200px; }
        
        .settings-sidebar { width: 280px; flex-shrink: 0; }
        .settings-profile-card { background: linear-gradient(135deg, #1a6e3c 0%, #22c55e 100%); border-radius: 16px; padding: 24px; color: #fff; }
        .settings-profile-avatar { width: 60px; height: 60px; border-radius: 50%; background: #fff; color: #1a6e3c; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700; margin: 0 auto 12px; }
        .settings-profile-name { font-size: 18px; font-weight: 700; text-align: center; margin: 0 0 4px; }
        .settings-profile-role { font-size: 12px; text-align: center; opacity: 0.8; margin: 0 0 16px; }
        .settings-profile-info { display: flex; flex-direction: column; gap: 12px; }
        .settings-profile-info-item { display: flex; justify-content: space-between; font-size: 11px; }
        .settings-profile-info-label { opacity: 0.7; text-transform: uppercase; letter-spacing: 0.5px; }
        .settings-profile-info-value { font-weight: 600; }
        .settings-profile-info-item.pending { background: rgba(255,255,255,0.15); padding: 8px 10px; border-radius: 8px; margin-top: 8px; }
        
        .settings-nav { background: #fff; border-radius: 16px; border: 1.5px solid #e5e4f0; padding: 8px; margin-top: 16px; }
        .settings-nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: 10px; font-size: 13px; font-weight: 500; color: #6b6a8a; cursor: pointer; transition: all 0.15s; width: 100%; border: none; background: none; text-align: left; }
        .settings-nav-item:hover { background: #f8f7fc; color: #0b044d; }
        .settings-nav-item.active { background: #1a6e3c; color: #fff; }
        .settings-nav-icon { width: 18px; height: 18px; display: flex; align-items: center; }
        .settings-nav-icon svg { width: 16px; height: 16px; }
        .settings-nav-label { flex: 1; }
        .settings-nav-arrow { display: none; }
        .settings-nav-item.active .settings-nav-arrow { display: block; }
        
        .settings-tip { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1.5px solid #bbf7d0; border-radius: 12px; padding: 14px; margin-top: 16px; }
        .settings-tip-header { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
        .settings-tip-icon { width: 18px; height: 18px; display: flex; align-items: center; }
        .settings-tip-title { font-size: 10px; font-weight: 700; color: #15803d; letter-spacing: 0.5px; margin: 0; }
        .settings-tip-text { font-size: 12px; color: #166534; margin: 0; line-height: 1.6; }
        
        .settings-content { flex: 1; }
        
        .settings-section { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; margin-bottom: 20px; overflow: hidden; }
        .settings-section-title { font-size: 14px; font-weight: 700; color: #0b044d; padding: 16px 20px; border-bottom: 1px solid #e5e4f0; margin: 0; }
        .settings-section-content { padding: 20px; }
        
        .settings-form-wrapper { display: flex; flex-direction: column; gap: 16px; }
        .settings-avatar-row { display: flex; align-items: center; gap: 14px; padding-bottom: 16px; border-bottom: 1px solid #e5e4f0; margin-bottom: 8px; }
        .settings-avatar { width: 56px; height: 56px; border-radius: 50%; background: #1a6e3c; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 700; }
        .settings-avatar-info { flex: 1; }
        .settings-avatar-name { font-size: 15px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .settings-avatar-role { font-size: 12px; color: #9999bb; margin: 0; }
        
        .settings-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .settings-form-field { display: flex; flex-direction: column; gap: 6px; }
        .settings-form-field label { font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; }
        .settings-form-field input { padding: 10px 14px; border: 1.5px solid #e5e4f0; border-radius: 8px; font-size: 13px; color: #0b044d; transition: border-color 0.2s; }
        .settings-form-field input:focus { outline: none; border-color: #1a6e3c; }
        
        .settings-row { display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #f4f3ff; }
        .settings-row:last-child { border-bottom: none; }
        .settings-row-label { flex: 1; }
        .settings-row-title { font-size: 13px; font-weight: 600; color: #0b044d; margin: 0 0 2px; }
        .settings-row-desc { font-size: 12px; color: #9999bb; margin: 0; }
        .settings-row-control { flex-shrink: 0; }
        
        .settings-toggle { width: 44px; height: 24px; border-radius: 12px; border: none; cursor: pointer; position: relative; transition: background 0.2s; }
        .settings-toggle.active { background: #1a6e3c; }
        .settings-toggle:not(.active) { background: #dddcf0; }
        .settings-toggle-thumb { position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; border-radius: 50%; background: #fff; transition: transform 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.2); }
        .settings-toggle.active .settings-toggle-thumb { transform: translateX(20px); }
        
        .settings-select { padding: 8px 12px; border: 1.5px solid #e5e4f0; border-radius: 8px; font-size: 13px; color: #0b044d; background: #fff; cursor: pointer; }
        
        .settings-form-field-full { grid-column: 1 / -1; }
        
        .settings-message { font-size: 12px; padding: 10px 14px; border-radius: 8px; margin: 8px 0; }
        .settings-message.success { background: #f0fdf4; color: #15803d; }
        .settings-message.error { background: #fef2f2; color: #dc2626; }
        
        .settings-btn-primary { padding: 10px 20px; background: #1a6e3c; color: #fff; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; }
        .settings-btn-primary:hover { background: #166534; }
        
        .settings-save-bar { display: flex; justify-content: flex-end; gap: 10px; margin-top: 16px; padding-top: 16px; border-top: 1px solid #e5e4f0; }
        .settings-btn-reset { padding: 10px 20px; border: 1.5px solid #e5e4f0; border-radius: 8px; background: #fff; font-size: 13px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .settings-btn-reset:hover { border-color: #0b044d; color: #0b044d; }
        .settings-btn-save { padding: 10px 20px; border: none; border-radius: 8px; background: #1a6e3c; font-size: 13px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        .settings-btn-save:hover { background: #166534; }
        .settings-btn-save.saved { background: #15803d; }
        
        .contract-notice { background: #f0fdf4; border: 1.5px solid #bbf7d0; border-radius: 10px; padding: 14px 18px; margin-top: 16px; display: flex; gap: 12px; }
        .contract-notice-icon { flex-shrink: 0; }
        .contract-notice-title { font-size: 12.5px; color: #15803d; font-weight: 700; margin-bottom: 4px; }
        .contract-notice-text { font-size: 12px; color: #166534; line-height: 1.7; margin: 0; }
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
                <a href="/joborder/dashboard" class="nav-item">Dashboard</a>
                <a href="/joborder/payslip" class="nav-item">Payslip</a>
                <a href="/joborder/attendance" class="nav-item">Attendance</a>
                <a href="/joborder/leave" class="nav-item">Leave Request</a>
                <a href="/joborder/training" class="nav-item">Training</a>
                <a href="/joborder/profile" class="nav-item">Profile</a>
                <a href="/joborder/settings" class="nav-item active"><span class="nav-active-bar"></span>Settings</a>
            </nav>
            
            <div class="sidebar-footer">
                <div class="user-avatar">JD</div>
                <div class="user-info">
                    <div class="user-name">Juan D. Cruz</div>
                    <div class="user-role">Job Order</div>
                </div>
                <button class="logout-btn">⏻</button>
            </div>
        </aside>
        
        <main class="main-content">
            <div class="settings-container">
                <div class="settings-sidebar">
                    <div class="settings-profile-card">
                        <div class="settings-profile-avatar">JD</div>
                        <h3 class="settings-profile-name">Juan D. Cruz</h3>
                        <p class="settings-profile-role">JO-0042</p>
                        <div class="settings-profile-info">
                            <div class="settings-profile-info-item">
                                <span class="settings-profile-info-label">POSITION</span>
                                <span class="settings-profile-info-value">Utility Worker I</span>
                            </div>
                            <div class="settings-profile-info-item">
                                <span class="settings-profile-info-label">DEPARTMENT</span>
                                <span class="settings-profile-info-value">General Services Office</span>
                            </div>
                            <div class="settings-profile-info-item">
                                <span class="settings-profile-info-label">TYPE</span>
                                <span class="settings-profile-info-value">Job Order</span>
                            </div>
                            <div class="settings-profile-info-item pending">
                                <span class="settings-profile-info-label">CONTRACT ENDS</span>
                                <span class="settings-profile-info-value">Dec 31, 2025</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-nav">
                        <button class="settings-nav-item active" onclick="switchTab('profile')">
                            <span class="settings-nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
                            <span class="settings-nav-label">Profile</span>
                            <span class="settings-nav-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="9 18 15 12 9 6"/></svg></span>
                        </button>
                        <button class="settings-nav-item" onclick="switchTab('security')">
                            <span class="settings-nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span>
                            <span class="settings-nav-label">Security</span>
                            <span class="settings-nav-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="9 18 15 12 9 6"/></svg></span>
                        </button>
                        <button class="settings-nav-item" onclick="switchTab('notifications')">
                            <span class="settings-nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></span>
                            <span class="settings-nav-label">Notifications</span>
                            <span class="settings-nav-arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="9 18 15 12 9 6"/></svg></span>
                        </button>
                    </div>
                    
                    <div class="settings-tip">
                        <div class="settings-tip-header">
                            <span class="settings-tip-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></span>
                            <p class="settings-tip-title">CONTRACT INFO</p>
                        </div>
                        <p class="settings-tip-text">Your contract is valid until Dec 31, 2025. Contact HR for renewal.</p>
                    </div>
                </div>
                
                <div class="settings-content" id="settingsContent">
                    <!-- Profile Tab -->
                    <div id="tab-profile">
                        <div class="settings-section">
                            <h3 class="settings-section-title">Personal Information</h3>
                            <div class="settings-section-content">
                                <div class="settings-form-wrapper">
                                    <div class="settings-avatar-row">
                                        <div class="settings-avatar">JD</div>
                                        <div class="settings-avatar-info">
                                            <p class="settings-avatar-name">Juan D. Cruz</p>
                                            <p class="settings-avatar-role">Utility Worker I · General Services Office</p>
                                        </div>
                                    </div>
                                    
                                    <div class="settings-form-grid">
                                        <div class="settings-form-field">
                                            <label>First Name</label>
                                            <input type="text" value="Juan" id="firstName">
                                        </div>
                                        <div class="settings-form-field">
                                            <label>Last Name</label>
                                            <input type="text" value="D. Cruz" id="lastName">
                                        </div>
                                        <div class="settings-form-field">
                                            <label>Email Address</label>
                                            <input type="email" value="juan.cruz@pagsanjan.gov.ph" id="email">
                                        </div>
                                        <div class="settings-form-field">
                                            <label>Contact No.</label>
                                            <input type="text" value="09181234568" id="contact">
                                        </div>
                                    </div>
                                    <div class="settings-save-bar">
                                        <button class="settings-btn-reset" onclick="resetProfile()">Reset</button>
                                        <button class="settings-btn-save" onclick="saveProfile()">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                            Save Changes
                                        </button>
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
                                    <div class="settings-row-control">
                                        <span style="font-size:13px;font-weight:600;color:#5a5888;background:#f7f6ff;padding:5px 12px;border-radius:7px;">JO-0042</span>
                                    </div>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Position</p>
                                        <p class="settings-row-desc">Assigned by HR — not editable</p>
                                    </div>
                                    <div class="settings-row-control">
                                        <span style="font-size:13px;font-weight:600;color:#5a5888;background:#f7f6ff;padding:5px 12px;border-radius:7px;">Utility Worker I</span>
                                    </div>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Department</p>
                                        <p class="settings-row-desc">Assigned by HR — not editable</p>
                                    </div>
                                    <div class="settings-row-control">
                                        <span style="font-size:13px;font-weight:600;color:#5a5888;background:#f7f6ff;padding:5px 12px;border-radius:7px;">General Services Office</span>
                                    </div>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Employment Type</p>
                                        <p class="settings-row-desc">Assigned by HR — not editable</p>
                                    </div>
                                    <div class="settings-row-control">
                                        <span style="font-size:13px;font-weight:600;color:#5a5888;background:#f7f6ff;padding:5px 12px;border-radius:7px;">Job Order</span>
                                    </div>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Contract Start</p>
                                        <p class="settings-row-desc">Assigned by HR — not editable</p>
                                    </div>
                                    <div class="settings-row-control">
                                        <span style="font-size:13px;font-weight:600;color:#5a5888;background:#f7f6ff;padding:5px 12px;border-radius:7px;">Jan 1, 2025</span>
                                    </div>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Contract End</p>
                                        <p class="settings-row-desc">Assigned by HR — not editable</p>
                                    </div>
                                    <div class="settings-row-control">
                                        <span style="font-size:13px;font-weight:600;color:#5a5888;background:#f7f6ff;padding:5px 12px;border-radius:7px;">Dec 31, 2025</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contract-notice">
                            <div class="contract-notice-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                            <div>
                                <p class="contract-notice-title">Contract Renewal Notice</p>
                                <p class="contract-notice-text">Your Job Order contract is valid until <strong>Dec 31, 2025</strong>. Contact the HR Management Office for renewal inquiries.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Security Tab -->
                    <div id="tab-security" style="display:none;">
                        <div class="settings-section">
                            <h3 class="settings-section-title">Change Password</h3>
                            <div class="settings-section-content">
                                <div class="settings-form-wrapper">
                                    <div class="settings-form-field settings-form-field-full">
                                        <label>Current Password</label>
                                        <input type="password" id="currentPw" placeholder="••••••••">
                                    </div>
                                    <div class="settings-form-field settings-form-field-full">
                                        <label>New Password</label>
                                        <input type="password" id="newPw" placeholder="••••••••">
                                    </div>
                                    <div class="settings-form-field settings-form-field-full">
                                        <label>Confirm New Password</label>
                                        <input type="password" id="confirmPw" placeholder="••••••••">
                                    </div>
                                    <p id="pwMessage" style="display:none;"></p>
                                    <button class="settings-btn-primary" onclick="changePassword()">Change Password</button>
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
                                    <div class="settings-row-control">
                                        <button class="settings-toggle" id="twoFAToggle" onclick="toggle2FA()">
                                            <span class="settings-toggle-thumb"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Session Timeout</p>
                                        <p class="settings-row-desc">Auto-logout after inactivity</p>
                                    </div>
                                    <div class="settings-row-control">
                                        <select class="settings-select" id="sessionTimeout" onchange="updateTimeout()">
                                            <option value="15">15 minutes</option>
                                            <option value="30" selected>30 minutes</option>
                                            <option value="60">1 hour</option>
                                            <option value="120">2 hours</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Notifications Tab -->
                    <div id="tab-notifications" style="display:none;">
                        <div class="settings-section">
                            <h3 class="settings-section-title">In-App Notifications</h3>
                            <div class="settings-section-content">
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Payslip Available</p>
                                        <p class="settings-row-desc">Notify when your payslip is ready for the pay period</p>
                                    </div>
                                    <div class="settings-row-control">
                                        <button class="settings-toggle active" id="toggle-payslip" onclick="toggleNotif('payslip')">
                                            <span class="settings-toggle-thumb"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Contract Renewal Alert</p>
                                        <p class="settings-row-desc">Notify 30 days before your contract expires</p>
                                    </div>
                                    <div class="settings-row-control">
                                        <button class="settings-toggle active" id="toggle-contract" onclick="toggleNotif('contract')">
                                            <span class="settings-toggle-thumb"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">DTR Deadline Reminder</p>
                                        <p class="settings-row-desc">Remind before DTR submission deadline</p>
                                    </div>
                                    <div class="settings-row-control">
                                        <button class="settings-toggle active" id="toggle-dtr" onclick="toggleNotif('dtr')">
                                            <span class="settings-toggle-thumb"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="settings-row">
                                    <div class="settings-row-label">
                                        <p class="settings-row-title">Attendance Alert</p>
                                        <p class="settings-row-desc">Notify when a late or absent entry is recorded</p>
                                    </div>
                                    <div class="settings-row-control">
                                        <button class="settings-toggle" id="toggle-attendance" onclick="toggleNotif('attendance')">
                                            <span class="settings-toggle-thumb"></span>
                                        </button>
                                    </div>
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
                                    <div class="settings-row-control">
                                        <button class="settings-toggle active" id="toggle-email" onclick="toggleNotif('email')">
                                            <span class="settings-toggle-thumb"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="settings-save-bar">
                                    <button class="settings-btn-reset" onclick="resetNotifs()">Reset</button>
                                    <button class="settings-btn-save" onclick="saveNotifs()">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        const ACCENT = '#1a6e3c';
        
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
        
        function switchTab(tab) {
            document.querySelectorAll('.settings-nav-item').forEach(btn => btn.classList.remove('active'));
            event.target.closest('.settings-nav-item').classList.add('active');
            
            document.getElementById('tab-profile').style.display = tab === 'profile' ? 'block' : 'none';
            document.getElementById('tab-security').style.display = tab === 'security' ? 'block' : 'none';
            document.getElementById('tab-notifications').style.display = tab === 'notifications' ? 'block' : 'none';
        }
        
        function resetProfile() {
            document.getElementById('firstName').value = 'Juan';
            document.getElementById('lastName').value = 'D. Cruz';
            document.getElementById('email').value = 'juan.cruz@pagsanjan.gov.ph';
            document.getElementById('contact').value = '09181234568';
        }
        
        function saveProfile() {
            const btn = document.querySelector('#tab-profile .settings-btn-save');
            btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Saved!';
            btn.classList.add('saved');
            setTimeout(() => {
                btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> Save Changes';
                btn.classList.remove('saved');
            }, 2000);
        }
        
        function changePassword() {
            const current = document.getElementById('currentPw').value;
            const newPw = document.getElementById('newPw').value;
            const confirm = document.getElementById('confirmPw').value;
            const msg = document.getElementById('pwMessage');
            
            if (!current || !newPw || !confirm) {
                msg.textContent = 'Please fill in all fields.';
                msg.className = 'settings-message error';
                msg.style.display = 'block';
                return;
            }
            if (newPw !== confirm) {
                msg.textContent = 'New passwords do not match.';
                msg.className = 'settings-message error';
                msg.style.display = 'block';
                return;
            }
            if (newPw.length < 8) {
                msg.textContent = 'Password must be at least 8 characters.';
                msg.className = 'settings-message error';
                msg.style.display = 'block';
                return;
            }
            
            msg.textContent = '✓ Password changed successfully.';
            msg.className = 'settings-message success';
            msg.style.display = 'block';
            document.getElementById('currentPw').value = '';
            document.getElementById('newPw').value = '';
            document.getElementById('confirmPw').value = '';
            setTimeout(() => msg.style.display = 'none', 3000);
        }
        
        function toggle2FA() {
            document.getElementById('twoFAToggle').classList.toggle('active');
        }
        
        function updateTimeout() {
            // Session timeout updated
        }
        
        function toggleNotif(id) {
            document.getElementById('toggle-' + id).classList.toggle('active');
        }
        
        function resetNotifs() {
            document.getElementById('toggle-payslip').classList.add('active');
            document.getElementById('toggle-contract').classList.add('active');
            document.getElementById('toggle-dtr').classList.add('active');
            document.getElementById('toggle-attendance').classList.remove('active');
            document.getElementById('toggle-email').classList.add('active');
        }
        
        function saveNotifs() {
            const btn = document.querySelector('#tab-notifications .settings-btn-save');
            btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Saved!';
            btn.classList.add('saved');
            setTimeout(() => {
                btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> Save Changes';
                btn.classList.remove('saved');
            }, 2000);
        }
    </script>
</body>
</html>