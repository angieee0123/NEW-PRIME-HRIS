<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance | PRIME HRIS - Job Order Employee</title>
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
        
        .welcome-banner { background: linear-gradient(135deg, #15803d 0%, #166534 100%); border-radius: 16px; padding: 24px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .banner-left { display: flex; align-items: center; gap: 16px; }
        .banner-avatar { width: 46px; height: 46px; border-radius: 50%; background: #1a6e3c; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 16px; }
        .banner-left h2 { font-size: 16px; font-weight: 700; color: #fff; margin: 0 0 4px; }
        .banner-left p { font-size: 12px; color: rgba(255,255,255,0.55); margin: 0; }
        .banner-right { display: flex; gap: 12px; }
        .banner-badge { font-size: 11px; font-weight: 600; padding: 8px 14px; border-radius: 20px; display: flex; align-items: center; gap: 6px; }
        .banner-badge:not(.outline) { background: #d9bb00; color: #0b044d; }
        .banner-badge.outline { background: transparent; border: 1px solid rgba(255,255,255,0.3); color: #fff; }
        .banner-badge-dot { width: 6px; height: 6px; border-radius: 50%; background: #0b044d; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: #fff; border-radius: 14px; padding: 18px; border: 1.5px solid #e5e4f0; }
        .stat-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
        .stat-label { font-size: 12px; color: #9999bb; font-weight: 600; }
        .stat-icon-wrap { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .stat-value { font-size: 22px; font-weight: 800; color: #0b044d; margin: 0 0 6px; }
        .stat-footer { display: flex; align-items: center; gap: 6px; }
        .stat-dot { width: 6px; height: 6px; border-radius: 50%; }
        .stat-sub { font-size: 11px; color: #9999bb; margin: 0; }
        
        .attendance-bar { background: #fff; border: 1.5px solid #eceaf8; border-radius: 12px; padding: 16px 22px; margin-bottom: 24px; display: flex; align-items: center; gap: 20px; }
        .attendance-bar-left { flex: 1; }
        .attendance-bar-header { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .attendance-bar-title { font-size: 12.5px; font-weight: 600; color: #0b044d; }
        .attendance-bar-value { font-size: 13px; font-weight: 700; color: #15803d; }
        .attendance-bar-track { height: 10px; background: #f0fdf4; border-radius: 10px; overflow: hidden; }
        .attendance-bar-fill { height: 100%; background: #1a6e3c; border-radius: 10px; transition: width 0.4s ease; }
        .attendance-bar-right { display: flex; gap: 16px; flex-shrink: 0; }
        .attendance-bar-stat { text-align: center; border-radius: 9px; padding: 8px 14px; }
        .attendance-bar-stat-label { font-size: 10.5px; font-weight: 600; opacity: 0.8; margin-bottom: 2px; }
        .attendance-bar-stat-value { font-size: 18px; font-weight: 800; }
        
        .table-section { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; margin-bottom: 20px; overflow: hidden; }
        .table-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #e5e4f0; }
        .table-title { font-size: 14px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .table-sub { font-size: 12px; color: #9999bb; margin: 0; }
        .table-actions { display: flex; gap: 10px; }
        .filter-select { padding: 8px 12px; border-radius: 8px; border: 1.5px solid #e5e4f0; font-size: 12px; font-weight: 600; color: #6b6a8a; background: #fff; cursor: pointer; }
        .btn-view { padding: 7px 14px; border-radius: 8px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 12px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .btn-view:hover { border-color: #15803d; color: #15803d; }
        .btn-export { padding: 8px 14px; border-radius: 8px; border: none; background: #15803d; font-size: 12px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 6px; }
        
        .payroll-summary-bar { display: flex; align-items: center; background: #f7f6ff; border-radius: 10px; padding: 12px 18px; margin: 0 20px 16px; }
        .psummary-item { display: flex; align-items: center; gap: 8px; }
        .psummary-item span { font-size: 12px; color: #6b6a8a; }
        .psummary-item strong { font-size: 14px; font-weight: 700; }
        .psummary-divider { width: 1px; height: 20px; background: #e5e4f0; margin: 0 16px; }
        
        .table-wrapper { overflow-x: auto; }
        .payroll-table { width: 100%; border-collapse: collapse; }
        .payroll-table th { text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e5e4f0; }
        .payroll-table td { padding: 14px 16px; font-size: 13px; color: #0b044d; border-bottom: 1px solid #f4f3ff; }
        .badge-status { font-size: 10px; font-weight: 700; padding: 4px 11px; border-radius: 20px; display: inline-block; }
        .badge-status.present { background: #e8f9ef; color: #15803d; }
        .badge-status.late { background: #fefce8; color: #a16207; }
        .badge-status.absent { background: #fdf0ef; color: #8e1e18; }
        .badge-status.holiday { background: #f7f6ff; color: #6b6a8a; }
        .late-tag { margin-left: 6px; font-size: 10px; background: #fefce8; color: #a16207; padding: 2px 7px; border-radius: 20px; font-weight: 700; }
        .table-footer { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-top: 1px solid #e5e4f0; background: #faf9ff; }
        .table-footer p { font-size: 12px; color: #6b6a8a; margin: 0; }
        .page-btn { width: 32px; height: 32px; border-radius: 8px; border: 1px solid #e5e4f0; background: #fff; font-size: 14px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .page-btn:hover { border-color: #15803d; color: #15803d; }
        .page-btn.active { background: #15803d; color: #fff; border-color: #15803d; }
        
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(11, 4, 77, 0.6); display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.2s; }
        .modal-overlay.show { opacity: 1; visibility: visible; }
        .modal-box { background: #fff; border-radius: 16px; width: 90%; max-width: 500px; max-height: 90vh; overflow: hidden; transform: scale(0.95); transition: transform 0.2s; }
        .modal-overlay.show .modal-box { transform: scale(1); }
        .modal-header { display: flex; justify-content: space-between; align-items: flex-start; padding: 20px 24px; border-bottom: 1px solid #e5e4f0; }
        .modal-eyebrow { font-size: 10px; font-weight: 700; color: #9999bb; letter-spacing: 1px; text-transform: uppercase; }
        .modal-title { font-size: 18px; font-weight: 700; color: #0b044d; margin: 4px 0; }
        .modal-sub { font-size: 12px; color: #6b6a8a; margin: 0; }
        .modal-close { background: none; border: none; cursor: pointer; color: #9999bb; padding: 4px; }
        .modal-body { padding: 0 24px 20px; }
        .modal-emp-strip { display: flex; align-items: center; gap: 14px; background: #f7f6ff; border-radius: 10px; padding: 12px 16px; margin-bottom: 18px; }
        .emp-avatar { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 14px; }
        .modal-section-label { font-size: 10.5px; font-weight: 700; color: #aaa8cc; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block; }
        .modal-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f4f3ff; font-size: 13px; }
        .modal-row span:first-child { color: #6b6a8a; }
        .modal-row strong { color: #0b044d; }
        .modal-net-row { display: flex; justify-content: space-between; padding: 14px; background: #f0fdf4; border-radius: 10px; margin-top: 14px; }
        .modal-net-row span { font-size: 12px; font-weight: 700; color: #15803d; text-transform: uppercase; }
        .modal-net-row strong { font-size: 20px; color: #15803d; }
        .modal-footer { display: flex; justify-content: space-between; padding: 16px 24px; border-top: 1px solid #e5e4f0; }
        .modal-btn-ghost { padding: 10px 20px; border-radius: 9px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 13px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .modal-btn-primary { padding: 10px 20px; border-radius: 9px; border: none; background: #15803d; font-size: 13px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 8px; }
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
                <a href="/joborder/attendance" class="nav-item active"><span class="nav-active-bar"></span>Attendance</a>
                <a href="/joborder/leave" class="nav-item">Leave Request</a>
                <a href="/joborder/training" class="nav-item">Training</a>
                <a href="/joborder/profile" class="nav-item">Profile</a>
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
            <div class="welcome-banner">
                <div class="banner-left">
                    <div class="banner-avatar">JD</div>
                    <div>
                        <h2>Juan D. Cruz</h2>
                        <p>Utility Worker I · General Services Office · JO-0042</p>
                    </div>
                </div>
                <div class="banner-right">
                    <div class="banner-badge"><span class="banner-badge-dot"></span>Schedule: 8:00 AM – 5:00 PM</div>
                    <div class="banner-badge outline">June 2025</div>
                </div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Days Present</p>
                        <div class="stat-icon-wrap" style="background:#15803d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
                    </div>
                    <h2 class="stat-value">17</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#15803d"></span>
                        <p class="stat-sub">2 late arrivals</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Days Absent</p>
                        <div class="stat-icon-wrap" style="background:#8e1e1815"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8e1e18" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>
                    </div>
                    <h2 class="stat-value">1</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#8e1e18"></span>
                        <p class="stat-sub">This month</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Overtime Hours</p>
                        <div class="stat-icon-wrap" style="background:#0b044d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                    </div>
                    <h2 class="stat-value">2.5h</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#0b044d"></span>
                        <p class="stat-sub">1 holiday</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Attendance Rate</p>
                        <div class="stat-icon-wrap" style="background:#a1620715"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#a16207" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
                    </div>
                    <h2 class="stat-value">94%</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#15803d"></span>
                        <p class="stat-sub">18 working days</p>
                    </div>
                </div>
            </div>
            
            <div class="attendance-bar">
                <div class="attendance-bar-left">
                    <div class="attendance-bar-header">
                        <span class="attendance-bar-title">Monthly Attendance Rate</span>
                        <span class="attendance-bar-value">94%</span>
                    </div>
                    <div class="attendance-bar-track">
                        <div class="attendance-bar-fill" style="width: 94%"></div>
                    </div>
                </div>
                <div class="attendance-bar-right">
                    <div class="attendance-bar-stat" style="background:#e8f9ef;">
                        <div class="attendance-bar-stat-value" style="color:#15803d;">17</div>
                        <div class="attendance-bar-stat-label" style="color:#15803d;">Present</div>
                    </div>
                    <div class="attendance-bar-stat" style="background:#fefce8;">
                        <div class="attendance-bar-stat-value" style="color:#a16207;">2</div>
                        <div class="attendance-bar-stat-label" style="color:#a16207;">Late</div>
                    </div>
                    <div class="attendance-bar-stat" style="background:#fdf0ef;">
                        <div class="attendance-bar-stat-value" style="color:#8e1e18;">1</div>
                        <div class="attendance-bar-stat-label" style="color:#8e1e18;">Absent</div>
                    </div>
                </div>
            </div>
            
            <section class="table-section">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Daily Time Record — June 2025</h3>
                        <p class="table-sub">Juan D. Cruz · JO-0042 · 20 entries</p>
                    </div>
                    <div class="table-actions">
                        <select class="filter-select" id="monthSelect" onchange="filterMonth()">
                            <option>June 2025</option>
                            <option>May 2025</option>
                        </select>
                        <select class="filter-select" id="statusFilter" onchange="filterStatus()">
                            <option value="all">All Status</option>
                            <option value="Present">Present</option>
                            <option value="Late">Late</option>
                            <option value="Absent">Absent</option>
                            <option value="Holiday">Holiday</option>
                        </select>
                        <button class="btn-view" onclick="openDTRModal()">View DTR Summary</button>
                        <button class="btn-export">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="7 10 12 15 17 10"/>
                                <line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                            Export
                        </button>
                    </div>
                </div>
                
                <div class="payroll-summary-bar">
                    <div class="psummary-item">
                        <span>Present</span>
                        <strong style="color:#15803d;">17</strong>
                    </div>
                    <div class="psummary-divider"></div>
                    <div class="psummary-item">
                        <span>Late</span>
                        <strong style="color:#a16207;">2</strong>
                    </div>
                    <div class="psummary-divider"></div>
                    <div class="psummary-item">
                        <span>Absent</span>
                        <strong style="color:#8e1e18;">1</strong>
                    </div>
                    <div class="psummary-divider"></div>
                    <div class="psummary-item">
                        <span>OT Hours</span>
                        <strong style="color:#0b044d;">2.5h</strong>
                    </div>
                </div>
                
                <div class="table-wrapper">
                    <table class="payroll-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Late (min)</th>
                                <th>OT Hours</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="attendanceTable">
                            <tr>
                                <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 27</td>
                                <td style="font-size:12.5px;color:#9999bb;">Fri</td>
                                <td style="font-weight:500;">8:00 AM</td>
                                <td style="font-weight:500;">5:00 PM</td>
                                <td style="color:#c0bedd;">—</td>
                                <td style="color:#c0bedd;">—</td>
                                <td><span class="badge-status present">Present</span></td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 26</td>
                                <td style="font-size:12.5px;color:#9999bb;">Thu</td>
                                <td style="font-weight:500;">8:00 AM</td>
                                <td style="font-weight:500;">5:00 PM</td>
                                <td style="color:#c0bedd;">—</td>
                                <td style="color:#c0bedd;">—</td>
                                <td><span class="badge-status present">Present</span></td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 25</td>
                                <td style="font-size:12.5px;color:#9999bb;">Wed</td>
                                <td style="font-weight:500;">8:00 AM</td>
                                <td style="font-weight:500;">5:00 PM</td>
                                <td style="color:#c0bedd;">—</td>
                                <td style="color:#c0bedd;">—</td>
                                <td><span class="badge-status present">Present</span></td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 24</td>
                                <td style="font-size:12.5px;color:#9999bb;">Tue</td>
                                <td style="font-weight:500;">7:50 AM</td>
                                <td style="font-weight:500;">5:00 PM</td>
                                <td style="color:#c0bedd;">—</td>
                                <td style="color:#c0bedd;">—</td>
                                <td><span class="badge-status present">Present</span></td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 23</td>
                                <td style="font-size:12.5px;color:#9999bb;">Mon</td>
                                <td style="font-weight:500;">8:00 AM</td>
                                <td style="font-weight:500;">5:00 PM</td>
                                <td style="color:#c0bedd;">—</td>
                                <td style="color:#c0bedd;">—</td>
                                <td><span class="badge-status present">Present</span></td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 20</td>
                                <td style="font-size:12.5px;color:#9999bb;">Fri</td>
                                <td style="color:#c0bedd;">—</td>
                                <td style="color:#c0bedd;">—</td>
                                <td style="color:#c0bedd;">—</td>
                                <td style="color:#c0bedd;">—</td>
                                <td><span class="badge-status absent">Absent</span></td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 19</td>
                                <td style="font-size:12.5px;color:#9999bb;">Thu</td>
                                <td style="font-weight:500;">8:00 AM</td>
                                <td style="font-weight:500;">5:00 PM</td>
                                <td style="color:#c0bedd;">—</td>
                                <td style="color:#c0bedd;">—</td>
                                <td><span class="badge-status present">Present</span></td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 18</td>
                                <td style="font-size:12.5px;color:#9999bb;">Wed</td>
                                <td style="font-weight:500;">8:00 AM</td>
                                <td style="font-weight:500;">5:00 PM</td>
                                <td style="color:#c0bedd;">—</td>
                                <td style="color:#c0bedd;">—</td>
                                <td><span class="badge-status present">Present</span></td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 17</td>
                                <td style="font-size:12.5px;color:#9999bb;">Tue</td>
                                <td style="font-weight:500;">8:10 AM<span class="late-tag">LATE</span></td>
                                <td style="font-weight:500;">5:00 PM</td>
                                <td style="color:#a16207;font-weight:700;">10 min</td>
                                <td style="color:#c0bedd;">—</td>
                                <td><span class="badge-status late">Late</span></td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 16</td>
                                <td style="font-size:12.5px;color:#9999bb;">Mon</td>
                                <td style="font-weight:500;">8:00 AM</td>
                                <td style="font-weight:500;">5:00 PM</td>
                                <td style="color:#c0bedd;">—</td>
                                <td style="color:#c0bedd;">—</td>
                                <td><span class="badge-status present">Present</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="table-footer">
                    <p>Showing <strong>10</strong> of <strong>20</strong> entries</p>
                    <div style="display:flex;align-items:center;gap:6px;">
                        <button class="page-btn">‹</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">›</button>
                    </div>
                </div>
            </section>
        </main>
    </div>
    
    <div class="modal-overlay" id="dtrModal">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <span class="modal-eyebrow">DAILY TIME RECORD · JUNE 2025</span>
                    <h3 class="modal-title">Juan D. Cruz</h3>
                    <p class="modal-sub">Utility Worker I · General Services Office</p>
                </div>
                <button class="modal-close" onclick="closeModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-emp-strip">
                    <div class="emp-avatar" style="background:#1a6e3c;">JD</div>
                    <div style="flex:1;">
                        <p style="font-size:13px;font-weight:700;color:#0b044d;margin:0 0 2px;">JO-0042</p>
                        <span style="font-size:12px;color:#9999bb;">Schedule: 8:00 AM – 5:00 PM</span>
                    </div>
                    <span class="badge-status present">Complete</span>
                </div>
                
                <span class="modal-section-label">ATTENDANCE SUMMARY</span>
                <div class="modal-row"><span>Working Days</span><strong>18 days</strong></div>
                <div class="modal-row"><span>Days Present</span><strong style="color:#15803d;">17 days</strong></div>
                <div class="modal-row"><span>Days Absent</span><strong style="color:#8e1e18;">1 day</strong></div>
                <div class="modal-row"><span>Late Arrivals</span><strong style="color:#a16207;">2 times</strong></div>
                <div class="modal-row"><span>Holidays</span><strong style="color:#6b6a8a;">1 day</strong></div>
                
                <span class="modal-section-label" style="margin-top:16px;">OVERTIME</span>
                <div class="modal-row"><span>Total OT Hours</span><strong style="color:#0b044d;">2.5 hrs</strong></div>
                
                <div class="modal-net-row">
                    <span>ATTENDANCE RATE</span>
                    <strong>94%</strong>
                </div>
            </div>
            <div class="modal-footer">
                <button class="modal-btn-ghost" onclick="closeModal()">Close</button>
                <button class="modal-btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    Download DTR
                </button>
            </div>
        </div>
    </div>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
        
        function openDTRModal() {
            document.getElementById('dtrModal').classList.add('show');
        }
        
        function closeModal() {
            document.getElementById('dtrModal').classList.remove('show');
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
        
        document.getElementById('dtrModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
</body>
</html>