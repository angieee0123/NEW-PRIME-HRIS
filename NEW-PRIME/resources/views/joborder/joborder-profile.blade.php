<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | PRIME HRIS - Job Order Employee</title>
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
        .nav-item.active { background: #15803d; color: #fff; }
        .nav-item.active .nav-icon svg { stroke: #fff; }
        .nav-icon { width: 20px; height: 20px; display: flex; align-items: center; }
        .nav-icon svg { width: 18px; height: 18px; }
        .nav-active-bar { position: absolute; right: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 20px; background: #15803d; border-radius: 2px; }
        .sidebar.collapsed .nav-active-bar { display: none; }
        
        .sidebar-footer { padding: 16px; border-top: 1px solid #e5e4f0; display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #1a6e3c, #145c30); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 12px; font-weight: 700; }
        .user-info { flex: 1; }
        .user-name { font-size: 13px; font-weight: 600; color: #0b044d; }
        .user-role { font-size: 11px; color: #9999bb; }
        .logout-btn { background: none; border: none; cursor: pointer; color: #9999bb; padding: 6px; }
        
        .main-content { flex: 1; margin-left: 260px; padding: 24px 28px; transition: margin-left 0.3s; }
        .sidebar.collapsed + .main-content, .sidebar.collapsed ~ .main-content { margin-left: 70px; }
        
        .profile-header { background: linear-gradient(135deg, #15803d 0%, #166534 100%); border-radius: 16px; padding: 24px 28px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; }
        .profile-header-left { display: flex; align-items: center; gap: 20px; flex: 1; }
        .profile-avatar { width: 72px; height: 72px; border-radius: 50%; background: #1a6e3c; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 26px; flex-shrink: 0; }
        .profile-info h2 { font-size: 20px; font-weight: 800; color: #ffffff; margin: 0 0 6px; }
        .profile-info p { font-size: 13px; color: rgba(255,255,255,0.65); margin-bottom: 10px; }
        .banner-badge { font-size: 11px; font-weight: 600; padding: 6px 12px; border-radius: 20px; display: inline-flex; align-items: center; gap: 6px; }
        .banner-badge:not(.outline) { background: #15803d; color: #fff; }
        .banner-badge.outline { background: transparent; border: 1px solid rgba(255,255,255,0.3); color: #fff; }
        .banner-badge-dot { width: 6px; height: 6px; border-radius: 50%; background: #fff; }
        .btn-edit-profile { padding: 9px 20px; border-radius: 9px; border: none; background: #fff; color: #15803d; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: #fff; border-radius: 14px; padding: 18px; border: 1.5px solid #e5e4f0; }
        .stat-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
        .stat-label { font-size: 12px; color: #9999bb; font-weight: 600; }
        .stat-icon-wrap { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .stat-value { font-size: 22px; font-weight: 800; color: #0b044d; margin: 0 0 6px; }
        .stat-footer { display: flex; align-items: center; gap: 6px; }
        .stat-dot { width: 6px; height: 6px; border-radius: 50%; }
        .stat-sub { font-size: 11px; color: #9999bb; margin: 0; }
        
        .contract-alert { background: linear-gradient(135deg, #1a6e3c 0%, #15803d 100%); border-radius: 14px; padding: 20px 24px; display: flex; align-items: center; gap: 16px; box-shadow: 0 4px 12px rgba(26, 110, 60, 0.15); flex-wrap: wrap; margin-bottom: 24px; }
        .contract-alert-icon { width: 48px; height: 48px; border-radius: 12px; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .contract-alert-content { flex: 1; min-width: 200px; }
        .contract-alert-content h4 { font-size: 14px; font-weight: 700; color: #fff; margin: 0 0 4px; }
        .contract-alert-content p { font-size: 12px; color: rgba(255,255,255,0.85); margin: 0; line-height: 1.5; }
        .contract-alert-btn { padding: 8px 16px; font-size: 12px; background: #fff; color: #1a6e3c; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; white-space: nowrap; flex-shrink: 0; }
        
        .table-section { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; margin-bottom: 20px; overflow: hidden; }
        .table-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #e5e4f0; }
        .table-title { font-size: 14px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .table-sub { font-size: 12px; color: #9999bb; margin: 0; }
        
        .pmodal-tabs { display: flex; border-bottom: 1px solid #f0effe; padding: 0 24px; }
        .pmodal-tab { background: none; border: none; padding: 14px 18px; font-size: 12px; font-weight: 600; color: #9999bb; cursor: pointer; border-bottom: 2px solid transparent; margin-bottom: -1px; }
        .pmodal-tab.active { color: #0b044d; border-bottom-color: #0b044d; }
        
        .pmodal-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .pmodal-field { padding: 14px 0; border-bottom: 1px solid #f4f3ff; }
        .pmodal-field span { display: block; font-size: 11px; color: #9999bb; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .pmodal-field strong { display: block; font-size: 14px; color: #0b044d; font-weight: 600; }
        .pmodal-field.pmodal-full { grid-column: 1 / -1; }
        .note-box { background: #fff9e6; padding: 12px 16px; border-radius: 8px; border: 1px solid #ffeaa7; }
        .note-box-content { display: flex; align-items: flex-start; gap: 8px; }
        .note-box-content svg { margin-top: 2px; flex-shrink: 0; }
        .note-box-content span:first-child { font-size: 11px; color: #9b8600; font-weight: 600; display: block; margin-bottom: 4px; }
        .note-box-content span:last-child { font-size: 12px; color: #6b6a8a; }
        
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(11, 4, 77, 0.6); display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.2s; }
        .modal-overlay.show { opacity: 1; visibility: visible; }
        .modal-box { background: #fff; border-radius: 16px; width: 90%; max-width: 560px; max-height: 90vh; overflow: hidden; transform: scale(0.95); transition: transform 0.2s; }
        .modal-overlay.show .modal-box { transform: scale(1); }
        .modal-header { display: flex; justify-content: space-between; align-items: flex-start; padding: 20px 24px; border-bottom: 1px solid #e5e4f0; }
        .modal-eyebrow { font-size: 10px; font-weight: 700; color: #9999bb; letter-spacing: 1px; text-transform: uppercase; }
        .modal-title { font-size: 18px; font-weight: 700; color: #0b044d; margin: 4px 0; }
        .modal-close { background: none; border: none; cursor: pointer; color: #9999bb; padding: 4px; }
        .modal-body { padding: 0 24px 20px; max-height: 60vh; overflow-y: auto; }
        .form-section-label { font-size: 10.5px; font-weight: 700; color: #aaa8cc; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; display: block; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .form-field { }
        .form-field label { display: block; font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .form-field input { width: 100%; padding: 10px 12px; border-radius: 8px; border: 1.5px solid #e5e4f0; font-size: 13px; font-family: 'Poppins', sans-serif; }
        .form-field input:focus { outline: none; border-color: #15803d; }
        .form-field.form-full { grid-column: 1 / -1; }
        .modal-footer { display: flex; justify-content: space-between; padding: 16px 24px; border-top: 1px solid #e5e4f0; }
        .modal-btn-ghost { padding: 10px 20px; border-radius: 9px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 13px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .modal-btn-primary { padding: 10px 20px; border-radius: 9px; border: none; background: #15803d; font-size: 13px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        
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
                <a href="/joborder/dashboard" class="nav-item">Dashboard</a>
                <a href="/joborder/payslip" class="nav-item">Payslip</a>
                <a href="/joborder/attendance" class="nav-item">Attendance</a>
                <a href="/joborder/leave" class="nav-item">Leave Request</a>
                <a href="/joborder/training" class="nav-item">Training</a>
                <a href="/joborder/profile" class="nav-item active"><span class="nav-active-bar"></span>Profile</a>
                <a href="/joborder/settings" class="nav-item">Settings</a>
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
            <div class="profile-header">
                <div class="profile-header-left">
                    <div class="profile-avatar">JD</div>
                    <div class="profile-info">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;flex-wrap:wrap;">
                            <h2>Juan D. Cruz</h2>
                            <span class="banner-badge"><span class="banner-badge-dot"></span>Active</span>
                        </div>
                        <p>Utility Worker I · General Services Office</p>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;">
                            <span class="banner-badge outline">Job Order</span>
                            <span class="banner-badge outline">JO-0042</span>
                            <span class="banner-badge outline">Contract: Jan 1, 2025 - Dec 31, 2025</span>
                        </div>
                    </div>
                </div>
                <button class="btn-edit-profile" onclick="openEditModal()">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Profile
                </button>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Months Served</p>
                        <div class="stat-icon-wrap" style="background:#0b044d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                    </div>
                    <h2 class="stat-value">4</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#0b044d"></span>
                        <p class="stat-sub">Since Jan 2025</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Contract Days Left</p>
                        <div class="stat-icon-wrap" style="background:#d9bb0015"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d9bb00" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                    </div>
                    <h2 class="stat-value">272</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#d9bb00"></span>
                        <p class="stat-sub">Until Dec 31, 2025</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Attendance Rate</p>
                        <div class="stat-icon-wrap" style="background:#15803d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
                    </div>
                    <h2 class="stat-value">90%</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#15803d"></span>
                        <p class="stat-sub">19 days present</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Trainings Completed</p>
                        <div class="stat-icon-wrap" style="background:#8e1e1815"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8e1e18" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div>
                    </div>
                    <h2 class="stat-value">2</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#8e1e18"></span>
                        <p class="stat-sub">Total programs</p>
                    </div>
                </div>
            </div>
            
            <div class="contract-alert">
                <div class="contract-alert-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <div class="contract-alert-content">
                    <h4>Job Order Contract Status</h4>
                    <p>Your contract is valid from Jan 1, 2025 to Dec 31, 2025. 272 days remaining.</p>
                </div>
                <button class="contract-alert-btn">View Contract</button>
            </div>
            
            <section class="table-section">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Profile Information</h3>
                        <p class="table-sub">View and manage your personal details</p>
                    </div>
                </div>
                
                <div class="pmodal-tabs">
                    <button class="pmodal-tab active" onclick="switchTab('personal', this)">Personal Info</button>
                    <button class="pmodal-tab" onclick="switchTab('employment', this)">Employment</button>
                    <button class="pmodal-tab" onclick="switchTab('government', this)">Government IDs</button>
                    <button class="pmodal-tab" onclick="switchTab('emergency', this)">Emergency Contact</button>
                </div>
                
                <div style="padding:28px 32px;">
                    <div id="tab-personal" class="tab-content">
                        <div class="pmodal-grid">
                            <div class="pmodal-field"><span>Full Name</span><strong>Juan D. Cruz</strong></div>
                            <div class="pmodal-field"><span>Gender</span><strong>Male</strong></div>
                            <div class="pmodal-field"><span>Date of Birth</span><strong>Aug 12, 1992</strong></div>
                            <div class="pmodal-field"><span>Contact No.</span><strong>09171234567</strong></div>
                            <div class="pmodal-field pmodal-full"><span>Email Address</span><strong>juan.cruz@pagsanjan.gov.ph</strong></div>
                            <div class="pmodal-field pmodal-full"><span>Address</span><strong>789 Rizal Street, Barangay Sampaloc, Pagsanjan, Laguna</strong></div>
                        </div>
                    </div>
                    <div id="tab-employment" class="tab-content hidden">
                        <div class="pmodal-grid">
                            <div class="pmodal-field"><span>Employee ID</span><strong>JO-0042</strong></div>
                            <div class="pmodal-field"><span>Employment Type</span><strong>Job Order</strong></div>
                            <div class="pmodal-field"><span>Contract Start</span><strong>Jan 1, 2025</strong></div>
                            <div class="pmodal-field"><span>Contract End</span><strong>Dec 31, 2025</strong></div>
                            <div class="pmodal-field"><span>Status</span><strong>Active</strong></div>
                            <div class="pmodal-field"><span>Days Remaining</span><strong>272 days</strong></div>
                            <div class="pmodal-field pmodal-full"><span>Position / Designation</span><strong>Utility Worker I</strong></div>
                            <div class="pmodal-field pmodal-full"><span>Department / Office</span><strong>General Services Office</strong></div>
                        </div>
                    </div>
                    <div id="tab-government" class="tab-content hidden">
                        <div class="pmodal-grid">
                            <div class="pmodal-field"><span>SSS No.</span><strong>34-5678901-2</strong></div>
                            <div class="pmodal-field"><span>PhilHealth No.</span><strong>12-345678901-2</strong></div>
                            <div class="pmodal-field"><span>Pag-IBIG No.</span><strong>1234-5678-9012</strong></div>
                            <div class="pmodal-field"><span>TIN</span><strong>123-456-789</strong></div>
                            <div class="pmodal-field pmodal-full">
                                <div class="note-box">
                                    <div class="note-box-content">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d9bb00" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                                        <div>
                                            <span>NOTE FOR JOB ORDER EMPLOYEES</span>
                                            <span>Job Order employees use SSS instead of GSIS. Make sure your SSS contributions are up to date.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-emergency" class="tab-content hidden">
                        <div class="pmodal-grid">
                            <div class="pmodal-field"><span>Contact Person</span><strong>Maria Cruz</strong></div>
                            <div class="pmodal-field"><span>Relationship</span><strong>Spouse</strong></div>
                            <div class="pmodal-field"><span>Phone Number</span><strong>09181234567</strong></div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    
    <div class="modal-overlay" id="editModal">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <span class="modal-eyebrow">EDIT PROFILE</span>
                    <h3 class="modal-title">Update Personal Information</h3>
                </div>
                <button class="modal-close" onclick="closeEditModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            
            <div class="modal-body">
                <p class="form-section-label">CONTACT INFORMATION</p>
                <div class="form-grid">
                    <div class="form-field">
                        <label>Contact No.</label>
                        <input type="text" value="09171234567" id="contact">
                    </div>
                    <div class="form-field">
                        <label>Email Address</label>
                        <input type="email" value="juan.cruz@pagsanjan.gov.ph" id="email">
                    </div>
                    <div class="form-field form-full">
                        <label>Address</label>
                        <input type="text" value="789 Rizal Street, Barangay Sampaloc, Pagsanjan, Laguna" id="address">
                    </div>
                </div>
                
                <p class="form-section-label" style="margin-top:20px;">EMERGENCY CONTACT</p>
                <div class="form-grid">
                    <div class="form-field">
                        <label>Contact Person</label>
                        <input type="text" value="Maria Cruz" id="emergencyContact">
                    </div>
                    <div class="form-field">
                        <label>Relationship</label>
                        <input type="text" value="Spouse" id="emergencyRelation">
                    </div>
                    <div class="form-field">
                        <label>Phone Number</label>
                        <input type="text" value="09181234567" id="emergencyPhone">
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="modal-btn-ghost" onclick="closeEditModal()">Cancel</button>
                <button class="modal-btn-primary" onclick="saveProfile()">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    Save Changes
                </button>
            </div>
        </div>
    </div>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
        
        function switchTab(tabId, btn) {
            document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
            document.getElementById('tab-' + tabId).classList.remove('hidden');
            document.querySelectorAll('.pmodal-tab').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }
        
        function openEditModal() {
            document.getElementById('editModal').classList.add('show');
        }
        
        function closeEditModal() {
            document.getElementById('editModal').classList.remove('show');
        }
        
        function saveProfile() {
            alert('Profile updated successfully!');
            closeEditModal();
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeEditModal();
        });
    </script>
</body>
</html>