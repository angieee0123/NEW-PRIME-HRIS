<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance | PRIME HRIS - Permanent Employee</title>
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
        .sidebar.collapsed .logo-text, .sidebar.collapsed .logo-sub, .sidebar.collapsed .nav-label { display: none; }
        
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
        
        .sidebar-footer { padding: 16px; border-top: 1px solid #e5e4f0; display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #8e1e18, #5a0f0b); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 12px; font-weight: 700; }
        .user-info { flex: 1; }
        .user-name { font-size: 13px; font-weight: 600; color: #0b044d; }
        .user-role { font-size: 11px; color: #9999bb; }
        .logout-btn { background: none; border: none; cursor: pointer; color: #9999bb; padding: 6px; }
        
        .main-content { flex: 1; margin-left: 260px; padding: 24px 28px; transition: margin-left 0.3s; }
        
        /* Welcome Banner */
        .welcome-banner { background: linear-gradient(135deg, #8e1e18 0%, #5a0f0b 100%); border-radius: 16px; padding: 24px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .banner-left { display: flex; align-items: center; gap: 16px; }
        .banner-avatar { width: 46px; height: 46px; border-radius: 50%; background: #fff; display: flex; align-items: center; justify-content: center; color: #8e1e18; font-weight: 700; font-size: 16px; }
        .banner-left h2 { font-size: 16px; font-weight: 700; color: #fff; margin: 0 0 4px; }
        .banner-left p { font-size: 12px; color: rgba(255,255,255,0.55); margin: 0; }
        .banner-right { display: flex; gap: 12px; }
        .banner-badge { font-size: 11px; font-weight: 600; padding: 8px 14px; border-radius: 20px; display: flex; align-items: center; gap: 6px; }
        .banner-badge:not(.outline) { background: #fff; color: #8e1e18; }
        .banner-badge.outline { background: transparent; border: 1px solid rgba(255,255,255,0.3); color: #fff; }
        .banner-badge-dot { width: 6px; height: 6px; border-radius: 50%; background: #8e1e18; }
        
        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: #fff; border-radius: 14px; padding: 18px; border: 1.5px solid #e5e4f0; }
        .stat-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
        .stat-label { font-size: 12px; color: #9999bb; font-weight: 600; }
        .stat-icon-wrap { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .stat-value { font-size: 22px; font-weight: 800; color: #0b044d; margin: 0 0 6px; }
        .stat-footer { display: flex; align-items: center; gap: 6px; }
        .stat-dot { width: 6px; height: 6px; border-radius: 50%; }
        .stat-sub { font-size: 11px; color: #9999bb; margin: 0; }
        
        /* Attendance Rate Bar */
        .attendance-rate-bar { background: #fff; border: 1.5px solid #eceaf8; border-radius: 12px; padding: 16px 22px; margin-bottom: 24px; display: flex; align-items: center; gap: 20px; }
        .rate-bar-flex { flex: 1; }
        .rate-bar-header { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .rate-bar-label { font-size: 12.5px; font-weight: 600; color: #0b044d; }
        .rate-bar-value { font-size: 13px; font-weight: 700; color: #15803d; }
        .rate-bar-track { height: 10px; background: #f0effe; border-radius: 10px; overflow: hidden; }
        .rate-bar-fill { height: 100%; background: #15803d; border-radius: 10px; transition: width 0.4s ease; }
        .rate-legend { display: flex; gap: 16px; flex-shrink: 0; }
        .rate-legend-item { text-align: center; background: #f0fdf4; border-radius: 9px; padding: 8px 14px; }
        .rate-legend-count { font-size: 18px; font-weight: 800; color: #15803d; margin-bottom: 2px; }
        .rate-legend-label { font-size: 10.5px; font-weight: 600; color: #15803d; opacity: 0.8; }
        
        /* Table Section */
        .table-section { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; margin-bottom: 20px; overflow: hidden; }
        .table-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #e5e4f0; flex-wrap: wrap; gap: 10px; }
        .table-title { font-size: 14px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .table-sub { font-size: 12px; color: #9999bb; margin: 0; }
        .table-actions { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
        .filter-select { padding: 8px 12px; border: 1.5px solid #e4e3f0; border-radius: 8px; font-size: 12px; background: #fff; color: #0b044d; cursor: pointer; }
        .btn-view { padding: 7px 14px; border-radius: 8px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 12px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .btn-view:hover { border-color: #8e1e18; color: #8e1e18; }
        .btn-export { display: flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 8px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 12px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .btn-export:hover { border-color: #0b044d; color: #0b044d; }
        
        /* Summary Bar */
        .summary-bar { display: flex; align-items: center; gap: 16px; padding: 12px 20px; background: #f8f7fc; border-bottom: 1px solid #e5e4f0; }
        .summary-item { display: flex; flex-direction: column; }
        .summary-label { font-size: 11px; color: #9999bb; }
        .summary-value { font-size: 14px; font-weight: 700; color: #0b044d; }
        .summary-divider { width: 1px; height: 32px; background: #e5e4f0; }
        
        .table-wrapper { overflow-x: auto; }
        .payroll-table { width: 100%; border-collapse: collapse; }
        .payroll-table th { text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e5e4f0; }
        .payroll-table td { padding: 14px 16px; font-size: 13px; color: #0b044d; border-bottom: 1px solid #f4f3ff; }
        .status-badge { padding: 4px 11px; border-radius: 20px; font-size: 11px; font-weight: 600; display: inline-block; }
        .status-present { background: #e8f9ef; color: #15803d; }
        .status-late { background: #fefce8; color: #a16207; }
        .status-absent { background: #fdf0ef; color: #8e1e18; }
        .status-leave { background: #f0effe; color: #0b044d; }
        .status-holiday { background: #f7f6ff; color: #6b6a8a; }
        .late-tag { margin-left: 6px; font-size: 10px; background: #fefce8; color: #a16207; padding: 2px 7px; border-radius: 20px; font-weight: 700; }
        
        .table-footer { display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; border-top: 1px solid #e5e4f0; }
        .table-footer p { font-size: 12px; color: #9999bb; margin: 0; }
        .table-footer strong { color: #0b044d; }
        .pagination { display: flex; gap: 6px; }
        .page-btn { width: 32px; height: 32px; border: 1.5px solid #e5e4f0; border-radius: 8px; background: #fff; font-size: 12px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .page-btn:hover { border-color: #0b044d; color: #0b044d; }
        .page-btn.active { background: #0b044d; color: #fff; border-color: #0b044d; }
        
        /* Modal */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(11, 4, 77, 0.6); backdrop-filter: blur(4px); display: flex; align-items: center; justify-content: center; z-index: 1000; padding: 20px; }
        .modal-box { background: #fff; border-radius: 16px; width: 100%; max-width: 500px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); animation: slideUp 0.3s ease; }
        @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-header { display: flex; justify-content: space-between; align-items: flex-start; padding: 24px 24px 0; }
        .modal-eyebrow { font-size: 10.5px; color: #9999bb; font-weight: 700; letter-spacing: 1px; }
        .modal-title { font-size: 18px; font-weight: 700; color: #0b044d; margin: 4px 0 2px; }
        .modal-sub { font-size: 13px; color: #6b6a8a; margin: 0; }
        .modal-close { background: none; border: none; cursor: pointer; padding: 4px; color: #9999bb; }
        .modal-close:hover { color: #0b044d; }
        .modal-body { padding: 20px 24px; }
        .modal-emp-row { display: flex; align-items: center; gap: 14px; background: #f7f6ff; border-radius: 10px; padding: 12px 16px; margin-bottom: 18px; }
        .modal-emp-avatar { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; font-weight: 700; }
        .modal-section-label { font-size: 10.5px; font-weight: 700; color: #9999bb; letter-spacing: 1px; margin-bottom: 12px; }
        .modal-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0effe; }
        .modal-row span { font-size: 13px; color: #9999bb; font-weight: 600; }
        .modal-row strong { font-size: 13px; color: #0b044d; font-weight: 600; }
        .modal-net-row { display: flex; justify-content: space-between; padding: 14px; margin-top: 16px; background: #f0fdf4; border-radius: 10px; }
        .modal-net-row span { font-size: 13px; color: #15803d; font-weight: 700; }
        .modal-net-row strong { font-size: 18px; color: #15803d; }
        .modal-footer { display: flex; justify-content: flex-end; gap: 10px; padding: 16px 24px 24px; }
        .modal-btn-ghost { padding: 9px 18px; border-radius: 9px; border: 1.5px solid #dddcf0; background: #fff; font-size: 13px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .modal-btn-ghost:hover { border-color: #8e1e18; color: #8e1e18; }
        .modal-btn-primary { padding: 9px 18px; border-radius: 9px; border: none; background: linear-gradient(135deg, #8e1e18, #5a0f0b); color: #fff; font-size: 13px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 6px; }
        
        @media (max-width: 1024px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .stats-grid { grid-template-columns: 1fr; }
            .welcome-banner { flex-direction: column; align-items: flex-start; gap: 16px; }
            .attendance-rate-bar { flex-direction: column; }
            .rate-legend { flex-wrap: wrap; justify-content: center; }
        }
    </style>
</head>
<body>

<div class="app-layout">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <div class="logo-mark">PR</div>
                <div>
                    <span class="logo-text">PRIME HRIS</span>
                    <span class="logo-sub">Pagsanjan, Laguna</span>
                </div>
            </div>
            <button class="toggle-btn" onclick="document.getElementById('sidebar').classList.toggle('collapsed');">‹</button>
        </div>
        
        <p class="nav-section-label">NAVIGATION</p>
        
        <nav class="sidebar-nav">
            <a href="#" class="nav-item">
                <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg></span>
                <span class="nav-label">Dashboard</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></span>
                <span class="nav-label">Payslip</span>
            </a>
            <a href="#" class="nav-item active">
                <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                <span class="nav-label">Attendance</span>
                <span class="nav-active-bar"></span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></span>
                <span class="nav-label">Leave & Benefits</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></span>
                <span class="nav-label">Training</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></span>
                <span class="nav-label">Performance</span>
            </a>
            <a href="#" class="nav-item">
                <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></span>
                <span class="nav-label">Settings</span>
            </a>
        </nav>
        
        <div class="sidebar-footer">
            <div class="user-avatar">AR</div>
            <div class="user-info">
                <p class="user-name">Ana R. Reyes</p>
                <p class="user-role">Permanent Employee</p>
            </div>
            <button class="logout-btn" title="Logout">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            </button>
        </div>
    </aside>
    
    <main class="main-content">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="banner-left">
                <div class="banner-avatar">AR</div>
                <div>
                    <h2>Ana R. Reyes</h2>
                    <p>Nurse II · Municipal Health Office · PGS-0115</p>
                </div>
            </div>
            <div class="banner-right">
                <div class="banner-badge"><span class="banner-badge-dot"></span>Schedule: 8:00 AM - 5:00 PM</div>
                <div class="banner-badge outline">June 2025</div>
            </div>
        </div>
        
        <!-- Stats Grid -->
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Days Present</p>
                    <div class="stat-icon-wrap" style="background: #15803d18">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                </div>
                <h2 class="stat-value">17</h2>
                <div class="stat-footer">
                    <span class="stat-dot" style="background:#15803d"></span>
                    <p class="stat-sub">1 late arrival</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Days Absent</p>
                    <div class="stat-icon-wrap" style="background: #8e1e1818">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8e1e18" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
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
                    <div class="stat-icon-wrap" style="background: #0b044d18">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    </div>
                </div>
                <h2 class="stat-value">3h</h2>
                <div class="stat-footer">
                    <span class="stat-dot" style="background:#0b044d"></span>
                    <p class="stat-sub">2 leave days</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Attendance Rate</p>
                    <div class="stat-icon-wrap" style="background: #15803d18">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    </div>
                </div>
                <h2 class="stat-value">94%</h2>
                <div class="stat-footer">
                    <span class="stat-dot" style="background:#15803d"></span>
                    <p class="stat-sub">18 working days</p>
                </div>
            </div>
        </section>
        
        <!-- Attendance Rate Bar -->
        <div class="attendance-rate-bar">
            <div class="rate-bar-flex">
                <div class="rate-bar-header">
                    <span class="rate-bar-label">Monthly Attendance Rate</span>
                    <span class="rate-bar-value">94%</span>
                </div>
                <div class="rate-bar-track">
                    <div class="rate-bar-fill" style="width: 94%;"></div>
                </div>
            </div>
            <div class="rate-legend">
                <div class="rate-legend-item">
                    <p class="rate-legend-count">17</p>
                    <p class="rate-legend-label">Present</p>
                </div>
                <div class="rate-legend-item" style="background: #fefce8;">
                    <p class="rate-legend-count" style="color: #a16207;">1</p>
                    <p class="rate-legend-label" style="color: #a16207;">Late</p>
                </div>
                <div class="rate-legend-item" style="background: #fdf0ef;">
                    <p class="rate-legend-count" style="color: #8e1e18;">1</p>
                    <p class="rate-legend-label" style="color: #8e1e18;">Absent</p>
                </div>
                <div class="rate-legend-item" style="background: #f0effe;">
                    <p class="rate-legend-count" style="color: #0b044d;">2</p>
                    <p class="rate-legend-label" style="color: #0b044d;">Leave</p>
                </div>
            </div>
        </div>
        
        <!-- Daily Time Record Table -->
        <section class="table-section">
            <div class="table-header">
                <div>
                    <h3 class="table-title">Daily Time Record — June 2025</h3>
                    <p class="table-sub">Ana R. Reyes · PGS-0115 · 19 entries</p>
                </div>
                <div class="table-actions">
                    <select class="filter-select">
                        <option>January</option><option>February</option><option>March</option><option>April</option><option>May</option>
                        <option selected>June</option><option>July</option><option>August</option><option>September</option><option>October</option><option>November</option><option>December</option>
                    </select>
                    <select class="filter-select">
                        <option selected>2025</option><option>2024</option>
                    </select>
                    <select class="filter-select">
                        <option value="All">All Status</option>
                        <option>Present</option>
                        <option>Late</option>
                        <option>Absent</option>
                        <option>Leave</option>
                        <option>Holiday</option>
                    </select>
                    <button class="btn-view" onclick="showDTRModal()">View DTR Summary</button>
                    <button class="btn-export">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Export
                    </button>
                </div>
            </div>
            
            <!-- Summary Strip -->
            <div class="summary-bar">
                <div class="summary-item">
                    <span class="summary-label">Present</span>
                    <span class="summary-value" style="color: #15803d;">17</span>
                </div>
                <div class="summary-divider"></div>
                <div class="summary-item">
                    <span class="summary-label">Late</span>
                    <span class="summary-value" style="color: #a16207;">1</span>
                </div>
                <div class="summary-divider"></div>
                <div class="summary-item">
                    <span class="summary-label">Absent</span>
                    <span class="summary-value" style="color: #8e1e18;">1</span>
                </div>
                <div class="summary-divider"></div>
                <div class="summary-item">
                    <span class="summary-label">Leave</span>
                    <span class="summary-value" style="color: #0b044d;">2</span>
                </div>
                <div class="summary-divider"></div>
                <div class="summary-item">
                    <span class="summary-label">OT Hours</span>
                    <span class="summary-value">3h</span>
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
                            <th>OT Hours</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-weight: 600; color: #0b044d; font-size: 13px;">Jun 27</td>
                            <td style="font-size: 12.5px; color: #9999bb;">Fri</td>
                            <td style="font-size: 13px; color: #0b044d;">8:00 AM</td>
                            <td style="font-size: 13px; color: #0b044d;">5:00 PM</td>
                            <td style="font-size: 13px; color: #c0bedd;">—</td>
                            <td><span class="status-badge status-present">Present</span></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #0b044d; font-size: 13px;">Jun 26</td>
                            <td style="font-size: 12.5px; color: #9999bb;">Thu</td>
                            <td style="font-size: 13px; color: #c0bedd;">—</td>
                            <td style="font-size: 13px; color: #c0bedd;">—</td>
                            <td style="font-size: 13px; color: #c0bedd;">—</td>
                            <td><span class="status-badge status-absent">Absent</span></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #0b044d; font-size: 13px;">Jun 25</td>
                            <td style="font-size: 12.5px; color: #9999bb;">Wed</td>
                            <td style="font-size: 13px; color: #0b044d;">8:00 AM</td>
                            <td style="font-size: 13px; color: #0b044d;">5:00 PM</td>
                            <td style="font-size: 13px; color: #c0bedd;">—</td>
                            <td><span class="status-badge status-present">Present</span></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #0b044d; font-size: 13px;">Jun 24</td>
                            <td style="font-size: 12.5px; color: #9999bb;">Tue</td>
                            <td style="font-size: 13px; color: #0b044d;">8:00 AM</td>
                            <td style="font-size: 13px; color: #0b044d;">5:00 PM</td>
                            <td style="font-size: 13px; color: #c0bedd;">—</td>
                            <td><span class="status-badge status-present">Present</span></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #0b044d; font-size: 13px;">Jun 23</td>
                            <td style="font-size: 12.5px; color: #9999bb;">Mon</td>
                            <td style="font-size: 13px; color: #0b044d;">8:00 AM</td>
                            <td style="font-size: 13px; color: #0b044d;">5:00 PM</td>
                            <td style="font-size: 13px; color: #c0bedd;">—</td>
                            <td><span class="status-badge status-present">Present</span></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #0b044d; font-size: 13px;">Jun 20</td>
                            <td style="font-size: 12.5px; color: #9999bb;">Fri</td>
                            <td style="font-size: 13px; color: #0b044d;">8:00 AM</td>
                            <td style="font-size: 13px; color: #0b044d;">5:00 PM</td>
                            <td style="font-size: 13px; color: #c0bedd;">—</td>
                            <td><span class="status-badge status-present">Present</span></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #0b044d; font-size: 13px;">Jun 19</td>
                            <td style="font-size: 12.5px; color: #9999bb;">Thu</td>
                            <td style="font-size: 13px; color: #0b044d;">8:00 AM</td>
                            <td style="font-size: 13px; color: #0b044d;">5:00 PM</td>
                            <td style="font-size: 13px; color: #c0bedd;">—</td>
                            <td><span class="status-badge status-present">Present</span></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #0b044d; font-size: 13px;">Jun 18</td>
                            <td style="font-size: 12.5px; color: #9999bb;">Wed</td>
                            <td style="font-size: 13px; color: #0b044d;">7:59 AM</td>
                            <td style="font-size: 13px; color: #0b044d;">6:00 PM</td>
                            <td style="font-size: 13px; color: #0b044d; font-weight: 600;">+1h</td>
                            <td><span class="status-badge status-present">Present</span></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #0b044d; font-size: 13px;">Jun 17</td>
                            <td style="font-size: 12.5px; color: #9999bb;">Tue</td>
                            <td style="font-size: 13px; color: #0b044d;">8:05 AM</td>
                            <td style="font-size: 13px; color: #0b044d;">5:00 PM</td>
                            <td style="font-size: 13px; color: #c0bedd;">—</td>
                            <td><span class="status-badge status-present">Present</span></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: #0b044d; font-size: 13px;">Jun 16</td>
                            <td style="font-size: 12.5px; color: #9999bb;">Mon</td>
                            <td style="font-size: 13px; color: #0b044d;">8:00 AM</td>
                            <td style="font-size: 13px; color: #0b044d;">5:00 PM</td>
                            <td style="font-size: 13px; color: #c0bedd;">—</td>
                            <td><span class="status-badge status-present">Present</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="table-footer">
                <p>Showing <strong>1-10</strong> of <strong>19</strong> entries</p>
                <div class="pagination">
                    <button class="page-btn">‹</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">›</button>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- DTR Modal -->
<div class="modal-overlay" id="dtrModal" style="display: none;" onclick="closeModal('dtrModal')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-header">
            <div>
                <span class="modal-eyebrow">DAILY TIME RECORD · JUNE 2025</span>
                <h3 class="modal-title">Ana R. Reyes</h3>
                <p class="modal-sub">Nurse II · Municipal Health Office</p>
            </div>
            <button class="modal-close" onclick="closeModal('dtrModal')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="modal-emp-row">
                <div class="modal-emp-avatar" style="background: #8e1e18;">AR</div>
                <div>
                    <p style="font-size: 13px; font-weight: 700; color: #0b044d; margin-bottom: 2px;">PGS-0115</p>
                    <p style="font-size: 12px; color: #9999bb;">Schedule: 8:00 AM - 5:00 PM</p>
                </div>
                <span style="margin-left: auto; background: #e8f9ef; color: #15803d; padding: 4px 11px; border-radius: 20px; font-size: 11px; font-weight: 600;">Complete</span>
            </div>
            
            <div class="modal-section-label">ATTENDANCE SUMMARY</div>
            <div class="modal-row"><span>Working Days</span><strong>18 days</strong></div>
            <div class="modal-row"><span>Days Present</span><strong style="color: #15803d;">17 days</strong></div>
            <div class="modal-row"><span>Days Absent</span><strong style="color: #8e1e18;">1 day</strong></div>
            <div class="modal-row"><span>Late Arrivals</span><strong style="color: #a16207;">1 time</strong></div>
            <div class="modal-row"><span>Leave Days</span><strong style="color: #0b044d;">2 days</strong></div>
            <div class="modal-row"><span>Holidays</span><strong style="color: #6b6a8a;">1 day</strong></div>
            
            <div class="modal-section-label" style="margin-top: 16px;">OVERTIME</div>
            <div class="modal-row"><span>Total OT Hours</span><strong style="color: #0b044d;">3 hrs</strong></div>
            
            <div class="modal-net-row">
                <span>ATTENDANCE RATE</span>
                <strong>94%</strong>
            </div>
        </div>
        <div class="modal-footer">
            <button class="modal-btn-ghost" onclick="closeModal('dtrModal')">Close</button>
            <button class="modal-btn-primary">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Download DTR
            </button>
        </div>
    </div>
</div>

<script>
function showDTRModal() {
    document.getElementById('dtrModal').style.display = 'flex';
}

function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay').forEach(m => m.style.display = 'none');
    }
});
</script>

</body>
</html>