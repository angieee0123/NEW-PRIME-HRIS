<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave & Benefits | PRIME HRIS - Permanent Employee</title>
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
        .nav-item.active { background: #a16207; color: #fff; }
        .nav-item.active .nav-icon svg { stroke: #fff; }
        .nav-icon { width: 20px; height: 20px; display: flex; align-items: center; }
        .nav-icon svg { width: 18px; height: 18px; }
        .nav-active-bar { position: absolute; right: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 20px; background: #a16207; border-radius: 2px; }
        .sidebar.collapsed .nav-active-bar { display: none; }
        
        .sidebar-footer { padding: 16px; border-top: 1px solid #e5e4f0; display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #8e1e18, #5a0f0b); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 12px; font-weight: 700; }
        .user-info { flex: 1; }
        .user-name { font-size: 13px; font-weight: 600; color: #0b044d; }
        .user-role { font-size: 11px; color: #9999bb; }
        .logout-btn { background: none; border: none; cursor: pointer; color: #9999bb; padding: 6px; }
        
        .main-content { flex: 1; margin-left: 260px; padding: 24px 28px; transition: margin-left 0.3s; }
        .sidebar.collapsed + .main-content, .sidebar.collapsed ~ .main-content { margin-left: 70px; }
        
        .welcome-banner { background: linear-gradient(135deg, #a16207 0%, #854d0b 100%); border-radius: 16px; padding: 24px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .banner-left { display: flex; align-items: center; gap: 16px; }
        .banner-avatar { width: 46px; height: 46px; border-radius: 50%; background: #8e1e18; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 16px; }
        .banner-left h2 { font-size: 17px; font-weight: 700; color: #fff; margin: 0 0 4px; }
        .banner-left p { font-size: 12px; color: rgba(255,255,255,0.55); margin: 0; }
        .banner-right { display: flex; gap: 12px; }
        .banner-badge { font-size: 11px; font-weight: 600; padding: 8px 14px; border-radius: 20px; display: flex; align-items: center; gap: 6px; }
        .banner-badge:not(.outline) { background: #fff; color: #0b044d; }
        .banner-badge.outline { background: transparent; border: 1px solid rgba(255,255,255,0.3); color: #fff; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: #fff; border-radius: 14px; padding: 18px; border: 1.5px solid #e5e4f0; }
        .stat-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
        .stat-label { font-size: 12px; color: #9999bb; font-weight: 600; }
        .stat-icon-wrap { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .stat-value { font-size: 22px; font-weight: 800; color: #0b044d; margin: 0 0 6px; }
        .stat-footer { display: flex; align-items: center; gap: 6px; }
        .stat-dot { width: 6px; height: 6px; border-radius: 50%; }
        .stat-sub { font-size: 11px; color: #9999bb; margin: 0; }
        
        .tabs { display: flex; gap: 4px; margin-bottom: 24px; border-bottom: 1.5px solid #eceaf8; }
        .tab-btn { background: none; border: none; cursor: pointer; padding: 10px 20px; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 600; color: #9999bb; border-bottom: 2.5px solid transparent; margin-bottom: -1.5px; transition: all 0.2s; }
        .tab-btn:hover { color: #0b044d; }
        .tab-btn.active { color: #0b044d; border-bottom-color: #0b044d; }
        
        .table-section { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; margin-bottom: 20px; overflow: hidden; }
        .table-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #e5e4f0; }
        .table-title { font-size: 14px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .table-sub { font-size: 12px; color: #9999bb; margin: 0; }
        .table-actions { display: flex; gap: 10px; }
        .filter-select { padding: 8px 12px; border-radius: 8px; border: 1.5px solid #e5e4f0; font-size: 12px; font-weight: 600; color: #6b6a8a; background: #fff; cursor: pointer; }
        .btn-export { padding: 8px 14px; border-radius: 8px; border: none; background: #0b044d; font-size: 12px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 6px; }
        .table-wrapper { overflow-x: auto; }
        .payroll-table { width: 100%; border-collapse: collapse; }
        .payroll-table th { text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e5e4f0; }
        .payroll-table td { padding: 14px 16px; font-size: 13px; color: #0b044d; border-bottom: 1px solid #f4f3ff; }
        .badge-status { font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 20px; display: inline-block; }
        .badge-status.processed { background: #e8f9ef; color: #15803d; border: 1px solid #bbf7d0; }
        .badge-status.pending { background: #fefce8; color: #a16207; border: 1px solid #fde68a; }
        .btn-view { padding: 7px 14px; border-radius: 8px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 12px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .btn-view:hover { border-color: #a16207; color: #a16207; }
        .table-footer { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-top: 1px solid #e5e4f0; background: #faf9ff; }
        .table-footer p { font-size: 12px; color: #6b6a8a; margin: 0; }
        .table-footer strong { color: #0b044d; }
        
        .credits-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .credit-card { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; padding: 22px; }
        .credit-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px; }
        .credit-header label { font-size: 12px; color: #9999bb; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; display: block; }
        .credit-header h2 { font-size: 28px; font-weight: 800; margin: 0; }
        .credit-header p { font-size: 12px; color: #9999bb; margin-top: 2px; }
        .credit-stats { text-align: right; }
        .credit-stats p { font-size: 11.5px; color: #9999bb; margin-bottom: 4px; }
        .credit-stats strong { color: #0b044d; }
        .progress-bar { height: 8px; background: #f0effe; border-radius: 4px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 4px; transition: width 0.4s; }
        .progress-labels { display: flex; justify-content: space-between; margin-top: 6px; }
        .progress-labels span { font-size: 11px; color: #9999bb; }
        
        .dept-tag { font-size: 10px; font-weight: 600; padding: 3px 8px; border-radius: 20px; background: #f0effe; color: #6b3fa0; }
        .deduction { color: #dc2626; font-weight: 600; }
        
        .benefits-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .benefits-grid .stat-card { margin-bottom: 0; }
        
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(11, 4, 77, 0.6); display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.2s; }
        .modal-overlay.show { opacity: 1; visibility: visible; }
        .modal-box { background: #fff; border-radius: 16px; width: 90%; max-width: 480px; max-height: 90vh; overflow: hidden; transform: scale(0.95); transition: transform 0.2s; }
        .modal-overlay.show .modal-box { transform: scale(1); }
        .modal-header { display: flex; justify-content: space-between; align-items: flex-start; padding: 20px 24px; border-bottom: 1px solid #e5e4f0; }
        .modal-eyebrow { font-size: 10px; font-weight: 700; color: #9999bb; letter-spacing: 1px; text-transform: uppercase; }
        .modal-title { font-size: 18px; font-weight: 700; color: #0b044d; margin: 4px 0; }
        .modal-sub { font-size: 12px; color: #6b6a8a; margin: 0; }
        .modal-close { background: none; border: none; cursor: pointer; color: #9999bb; padding: 4px; }
        .modal-body { padding: 0 24px 20px; }
        .modal-emp-row { display: flex; align-items: center; gap: 14px; margin: 16px 0; }
        .emp-avatar { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 14px; }
        .modal-emp-id { font-size: 13px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .modal-section-label { font-size: 10.5px; font-weight: 700; color: #aaa8cc; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block; }
        .modal-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f4f3ff; font-size: 13px; }
        .modal-row span:first-child { color: #6b6a8a; }
        .modal-row strong { color: #0b044d; }
        .modal-footer { display: flex; justify-content: space-between; padding: 16px 24px; border-top: 1px solid #e5e4f0; }
        .modal-btn-ghost { padding: 10px 20px; border-radius: 9px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 13px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .modal-btn-primary { padding: 10px 20px; border-radius: 9px; border: none; background: #a16207; font-size: 13px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .form-field { }
        .form-field label { display: block; font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .form-field input, .form-field select { width: 100%; padding: 10px 12px; border-radius: 8px; border: 1.5px solid #e5e4f0; font-size: 13px; font-family: 'Poppins', sans-serif; }
        .form-field input:focus, .form-field select:focus { outline: none; border-color: #a16207; }
        
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
                <a href="/permanent/leave" class="nav-item active"><span class="nav-active-bar"></span>Leave & Benefits</a>
                <a href="/permanent/training" class="nav-item">Training</a>
                <a href="/permanent/performance" class="nav-item">Performance</a>
                <a href="/permanent/profile" class="nav-item">Profile</a>
                <a href="/permanent/settings" class="nav-item">Settings</a>
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
            <div class="welcome-banner">
                <div class="banner-left">
                    <div class="banner-avatar">AR</div>
                    <div>
                        <h2>Ana R. Reyes</h2>
                        <p>Nurse II · Municipal Health Office · PGS-0115</p>
                    </div>
                </div>
                <div class="banner-right">
                    <div class="banner-badge">VL: 10 days</div>
                    <div class="banner-badge outline">SL: 11 days</div>
                </div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Total Leave Filed</p>
                        <div class="stat-icon-wrap" style="background:#0b044d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
                    </div>
                    <h2 class="stat-value">6</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#0b044d"></span>
                        <p class="stat-sub">All time</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Total Days Used</p>
                        <div class="stat-icon-wrap" style="background:#8e1e1815"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8e1e18" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                    </div>
                    <h2 class="stat-value">13</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#8e1e18"></span>
                        <p class="stat-sub">Across all types</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Pending Requests</p>
                        <div class="stat-icon-wrap" style="background:#d9bb0015"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d9bb00" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                    </div>
                    <h2 class="stat-value">1</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#d9bb00"></span>
                        <p class="stat-sub">Awaiting approval</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">VL + SL Balance</p>
                        <div class="stat-icon-wrap" style="background:#15803d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
                    </div>
                    <h2 class="stat-value">21</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#15803d"></span>
                        <p class="stat-sub">10 VL · 11 SL</p>
                    </div>
                </div>
            </div>
            
            <div class="tabs">
                <button class="tab-btn active" onclick="switchTab('leave', this)">My Leave Requests</button>
                <button class="tab-btn" onclick="switchTab('credits', this)">Leave Credits</button>
                <button class="tab-btn" onclick="switchTab('benefits', this)">My Benefits</button>
            </div>
            
            <div id="tab-leave" class="tab-content">
                <section class="table-section">
                    <div class="table-header">
                        <div>
                            <h3 class="table-title">My Leave Requests</h3>
                            <p class="table-sub">6 of 6 records</p>
                        </div>
                        <div class="table-actions">
                            <select class="filter-select">
                                <option>All Types</option>
                                <option>Vacation Leave</option>
                                <option>Sick Leave</option>
                                <option>Emergency Leave</option>
                                <option>Special Leave</option>
                            </select>
                            <select class="filter-select">
                                <option>All Status</option>
                                <option>Approved</option>
                                <option>Pending</option>
                                <option>Rejected</option>
                            </select>
                            <button class="btn-export" onclick="openFileModal()">+ File Leave</button>
                        </div>
                    </div>
                    
                    <div class="table-wrapper">
                        <table class="payroll-table">
                            <thead>
                                <tr>
                                    <th>Leave ID</th>
                                    <th>Leave Type</th>
                                    <th>Date From</th>
                                    <th>Date To</th>
                                    <th>Days</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-size:12;color:#9999bb;font-weight:500;">LV-2025-002</td>
                                    <td style="font-weight:600;">Sick Leave</td>
                                    <td>Jun 15, 2025</td>
                                    <td>Jun 16, 2025</td>
                                    <td style="font-weight:700;">2</td>
                                    <td style="font-size:12.5;color:#5a5888;">Medical consultation</td>
                                    <td><span class="badge-status processed">Approved</span></td>
                                    <td><button class="btn-view" onclick="openDetailModal('Sick Leave', 'Jun 15, 2025', 'Jun 16, 2025', 2, 'Medical consultation', 'Approved')">View</button></td>
                                </tr>
                                <tr>
                                    <td style="font-size:12;color:#9999bb;font-weight:500;">LV-2025-007</td>
                                    <td style="font-weight:600;">Vacation Leave</td>
                                    <td>Jun 10, 2025</td>
                                    <td>Jun 11, 2025</td>
                                    <td style="font-weight:700;">2</td>
                                    <td style="font-size:12.5;color:#5a5888;">Rest and recreation</td>
                                    <td><span class="badge-status processed">Approved</span></td>
                                    <td><button class="btn-view" onclick="openDetailModal('Vacation Leave', 'Jun 10, 2025', 'Jun 11, 2025', 2, 'Rest and recreation', 'Approved')">View</button></td>
                                </tr>
                                <tr>
                                    <td style="font-size:12;color:#9999bb;font-weight:500;">LV-2025-010</td>
                                    <td style="font-weight:600;">Emergency Leave</td>
                                    <td>May 22, 2025</td>
                                    <td>May 22, 2025</td>
                                    <td style="font-weight:700;">1</td>
                                    <td style="font-size:12.5;color:#5a5888;">Family emergency</td>
                                    <td><span class="badge-status processed">Approved</span></td>
                                    <td><button class="btn-view" onclick="openDetailModal('Emergency Leave', 'May 22, 2025', 'May 22, 2025', 1, 'Family emergency', 'Approved')">View</button></td>
                                </tr>
                                <tr>
                                    <td style="font-size:12;color:#9999bb;font-weight:500;">LV-2025-013</td>
                                    <td style="font-weight:600;">Sick Leave</td>
                                    <td>May 5, 2025</td>
                                    <td>May 6, 2025</td>
                                    <td style="font-weight:700;">2</td>
                                    <td style="font-size:12.5;color:#5a5888;">Flu and fever</td>
                                    <td><span class="badge-status processed">Approved</span></td>
                                    <td><button class="btn-view" onclick="openDetailModal('Sick Leave', 'May 5, 2025', 'May 6, 2025', 2, 'Flu and fever', 'Approved')">View</button></td>
                                </tr>
                                <tr>
                                    <td style="font-size:12;color:#9999bb;font-weight:500;">LV-2025-018</td>
                                    <td style="font-weight:600;">Vacation Leave</td>
                                    <td>Apr 14, 2025</td>
                                    <td>Apr 16, 2025</td>
                                    <td style="font-weight:700;">3</td>
                                    <td style="font-size:12.5;color:#5a5888;">Family vacation</td>
                                    <td><span class="badge-status processed">Approved</span></td>
                                    <td><button class="btn-view" onclick="openDetailModal('Vacation Leave', 'Apr 14, 2025', 'Apr 16, 2025', 3, 'Family vacation', 'Approved')">View</button></td>
                                </tr>
                                <tr>
                                    <td style="font-size:12;color:#9999bb;font-weight:500;">LV-2025-021</td>
                                    <td style="font-weight:600;">Vacation Leave</td>
                                    <td>Jul 7, 2025</td>
                                    <td>Jul 9, 2025</td>
                                    <td style="font-weight:700;">3</td>
                                    <td style="font-size:12.5;color:#5a5888;">Personal trip</td>
                                    <td><span class="badge-status pending">Pending</span></td>
                                    <td><button class="btn-view" onclick="openDetailModal('Vacation Leave', 'Jul 7, 2025', 'Jul 9, 2025', 3, 'Personal trip', 'Pending')">View</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="table-footer">
                        <p>Showing <strong>6</strong> of <strong>6</strong> records</p>
                    </div>
                </section>
            </div>
            
            <div id="tab-credits" class="tab-content hidden">
                <div class="credits-grid">
                    <div class="credit-card">
                        <div class="credit-header">
                            <div>
                                <label>Vacation Leave</label>
                                <h2 style="color:#0b044d">10</h2>
                                <p>days remaining</p>
                            </div>
                            <div class="credit-stats">
                                <p>Earned: <strong>15</strong></p>
                                <p>Used: <strong style="color:#8e1e18">5</strong></p>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width:67%;background:#0b044d"></div>
                        </div>
                        <div class="progress-labels">
                            <span>0</span>
                            <span>15 days max</span>
                        </div>
                    </div>
                    <div class="credit-card">
                        <div class="credit-header">
                            <div>
                                <label>Sick Leave</label>
                                <h2 style="color:#15803d">11</h2>
                                <p>days remaining</p>
                            </div>
                            <div class="credit-stats">
                                <p>Earned: <strong>15</strong></p>
                                <p>Used: <strong style="color:#8e1e18">4</strong></p>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width:73%;background:#15803d"></div>
                        </div>
                        <div class="progress-labels">
                            <span>0</span>
                            <span>15 days max</span>
                        </div>
                    </div>
                    <div class="credit-card">
                        <div class="credit-header">
                            <div>
                                <label>Emergency Leave</label>
                                <h2 style="color:#8e1e18">2</h2>
                                <p>days remaining</p>
                            </div>
                            <div class="credit-stats">
                                <p>Earned: <strong>3</strong></p>
                                <p>Used: <strong style="color:#8e1e18">1</strong></p>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width:67%;background:#8e1e18"></div>
                        </div>
                        <div class="progress-labels">
                            <span>0</span>
                            <span>3 days max</span>
                        </div>
                    </div>
                    <div class="credit-card">
                        <div class="credit-header">
                            <div>
                                <label>Special Leave</label>
                                <h2 style="color:#d9bb00">3</h2>
                                <p>days remaining</p>
                            </div>
                            <div class="credit-stats">
                                <p>Earned: <strong>3</strong></p>
                                <p>Used: <strong style="color:#8e1e18">0</strong></p>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width:100%;background:#d9bb00"></div>
                        </div>
                        <div class="progress-labels">
                            <span>0</span>
                            <span>3 days max</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="tab-benefits" class="tab-content hidden">
                <div class="benefits-grid">
                    <div class="stat-card">
                        <div class="stat-top">
                            <p class="stat-label">GSIS Premium</p>
                            <div class="stat-icon-wrap" style="background:#0b044d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg></div>
                        </div>
                        <h2 class="stat-value">₱3,046</h2>
                        <div class="stat-footer">
                            <span class="stat-dot" style="background:#0b044d"></span>
                            <p class="stat-sub">Monthly contribution</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-top">
                            <p class="stat-label">PhilHealth</p>
                            <div class="stat-icon-wrap" style="background:#15803d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></div>
                        </div>
                        <h2 class="stat-value">₱850</h2>
                        <div class="stat-footer">
                            <span class="stat-dot" style="background:#15803d"></span>
                            <p class="stat-sub">Monthly contribution</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-top">
                            <p class="stat-label">Pag-IBIG</p>
                            <div class="stat-icon-wrap" style="background:#8e1e1815"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8e1e18" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg></div>
                        </div>
                        <h2 class="stat-value">₱100</h2>
                        <div class="stat-footer">
                            <span class="stat-dot" style="background:#8e1e18"></span>
                            <p class="stat-sub">Monthly contribution</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-top">
                            <p class="stat-label">Withholding Tax</p>
                            <div class="stat-icon-wrap" style="background:#d9bb0015"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d9bb00" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
                        </div>
                        <h2 class="stat-value">₱2,772</h2>
                        <div class="stat-footer">
                            <span class="stat-dot" style="background:#d9bb00"></span>
                            <p class="stat-sub">Monthly deduction</p>
                        </div>
                    </div>
                </div>
                
                <section class="table-section">
                    <div class="table-header">
                        <div>
                            <h3 class="table-title">Benefits Breakdown — June 2025</h3>
                            <p class="table-sub">Government-mandated contributions and deductions</p>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="payroll-table">
                            <thead>
                                <tr>
                                    <th>Benefit / Contribution</th>
                                    <th>Type</th>
                                    <th>Monthly Amount</th>
                                    <th>Annual Estimate</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight:600;">GSIS Premium</td>
                                    <td><span class="dept-tag">Retirement & Insurance</span></td>
                                    <td class="deduction">₱3,046</td>
                                    <td style="font-weight:600;color:#5a5888;">₱36,552</td>
                                    <td><span class="badge-status processed">Active</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600;">PhilHealth</td>
                                    <td><span class="dept-tag">Health Insurance</span></td>
                                    <td class="deduction">₱850</td>
                                    <td style="font-weight:600;color:#5a5888;">₱10,200</td>
                                    <td><span class="badge-status processed">Active</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600;">Pag-IBIG</td>
                                    <td><span class="dept-tag">Housing Fund</span></td>
                                    <td class="deduction">₱100</td>
                                    <td style="font-weight:600;color:#5a5888;">₱1,200</td>
                                    <td><span class="badge-status processed">Active</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600;">Withholding Tax</td>
                                    <td><span class="dept-tag">Government Tax</span></td>
                                    <td class="deduction">₱2,772</td>
                                    <td style="font-weight:600;color:#5a5888;">₱33,264</td>
                                    <td><span class="badge-status processed">Active</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer">
                        <p>🔒 Benefits data is confidential and visible only to you.</p>
                    </div>
                </section>
            </div>
        </main>
    </div>
    
    <div class="modal-overlay" id="detailModal">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <span class="modal-eyebrow">LEAVE REQUEST · LV-2025-002</span>
                    <h3 class="modal-title" id="detailType">Sick Leave</h3>
                    <p class="modal-sub" id="detailDates">Jun 15, 2025 — Jun 16, 2025</p>
                </div>
                <button class="modal-close" onclick="closeModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-emp-row">
                    <div class="emp-avatar" style="background:#8e1e18;">AR</div>
                    <div>
                        <p class="modal-emp-id">PGS-0115</p>
                        <span class="badge-status processed" id="detailStatus">Approved</span>
                    </div>
                </div>
                <span class="modal-section-label">LEAVE DETAILS</span>
                <div class="modal-row"><span>Leave Type</span><strong id="detailType2">Sick Leave</strong></div>
                <div class="modal-row"><span>Date From</span><strong id="detailFrom">Jun 15, 2025</strong></div>
                <div class="modal-row"><span>Date To</span><strong id="detailTo">Jun 16, 2025</strong></div>
                <div class="modal-row"><span>No. of Days</span><strong id="detailDays">2 days</strong></div>
                <span class="modal-section-label" style="margin-top:16px;">REASON</span>
                <div class="modal-row"><span id="detailReason">Medical consultation</span></div>
            </div>
            <div class="modal-footer">
                <button class="modal-btn-ghost" onclick="closeModal()">Close</button>
                <button class="modal-btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Download
                </button>
            </div>
        </div>
    </div>
    
    <div class="modal-overlay" id="fileModal">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <span class="modal-eyebrow">NEW LEAVE REQUEST</span>
                    <h3 class="modal-title">File a Leave</h3>
                    <p class="modal-sub">Ana R. Reyes · PGS-0115</p>
                </div>
                <button class="modal-close" onclick="closeFileModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-grid">
                    <div class="form-field">
                        <label>Leave Type</label>
                        <select id="leaveType">
                            <option>Vacation Leave</option>
                            <option>Sick Leave</option>
                            <option>Emergency Leave</option>
                            <option>Special Leave</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label>No. of Days</label>
                        <input type="number" min="1" value="1" id="leaveDays">
                    </div>
                    <div class="form-field">
                        <label>Date From</label>
                        <input type="date" id="leaveFrom">
                    </div>
                    <div class="form-field">
                        <label>Date To</label>
                        <input type="date" id="leaveTo">
                    </div>
                </div>
                <div class="form-field" style="margin-top:12px;">
                    <label>Reason</label>
                    <input type="text" id="leaveReason" placeholder="Brief reason for leave">
                </div>
            </div>
            <div class="modal-footer">
                <button class="modal-btn-ghost" onclick="closeFileModal()">Cancel</button>
                <button class="modal-btn-primary" onclick="submitLeave()">Submit Request</button>
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
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }
        
        function openDetailModal(type, from, to, days, reason, status) {
            document.getElementById('detailType').textContent = type;
            document.getElementById('detailType2').textContent = type;
            document.getElementById('detailFrom').textContent = from;
            document.getElementById('detailTo').textContent = to;
            document.getElementById('detailDays').textContent = days + ' day' + (days > 1 ? 's' : '');
            document.getElementById('detailReason').textContent = reason;
            document.getElementById('detailDates').textContent = from + ' — ' + to;
            document.getElementById('detailStatus').textContent = status;
            document.getElementById('detailStatus').className = 'badge-status ' + (status === 'Approved' ? 'processed' : 'pending');
            document.getElementById('detailModal').classList.add('show');
        }
        
        function closeModal() {
            document.getElementById('detailModal').classList.remove('show');
        }
        
        function openFileModal() {
            document.getElementById('fileModal').classList.add('show');
        }
        
        function closeFileModal() {
            document.getElementById('fileModal').classList.remove('show');
        }
        
        function submitLeave() {
            alert('Leave request submitted successfully!');
            closeFileModal();
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeFileModal();
            }
        });
    </script>
</body>
</html>