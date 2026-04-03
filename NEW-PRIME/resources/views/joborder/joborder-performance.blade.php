<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance | PRIME HRIS - Job Order Employee</title>
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
        
        .table-section { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; margin-bottom: 24px; overflow: hidden; }
        .table-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #e5e4f0; }
        .table-title { font-size: 14px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .table-sub { font-size: 12px; color: #9999bb; margin: 0; }
        
        .chart-container { padding: 28px 32px; }
        .chart-bars { display: flex; align-items: flex-end; gap: 16px; height: 200px; }
        .chart-bar-wrapper { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 12px; }
        .chart-bar-container { width: 100%; display: flex; flex-direction: column; justify-content: flex-end; height: 100%; }
        .chart-bar { width: 100%; border-radius: 8px 8px 0 0; display: flex; align-items: flex-start; justify-content: center; padding-top: 8px; min-height: 40px; transition: all 0.3s; }
        .chart-bar-label { font-size: 13px; font-weight: 700; color: #fff; }
        .chart-bar-period { text-align: center; }
        .chart-bar-period p { font-size: 11px; color: #6b6a8a; font-weight: 600; white-space: nowrap; }
        
        .goals-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 16px; padding: 16px 20px; }
        .goal-card { cursor: pointer; transition: transform 0.2s; }
        .goal-card:hover { transform: translateY(-2px); }
        .goal-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px; }
        .goal-id { font-size: 10px; color: #9999bb; font-weight: 600; margin-bottom: 4px; }
        .goal-title { font-size: 14px; font-weight: 700; color: #0b044d; margin: 0; line-height: 1.3; margin-bottom: 4px; }
        .goal-category { font-size: 12px; color: #6b6a8a; }
        .goal-progress { margin-bottom: 12px; }
        .goal-progress-header { display: flex; justify-content: space-between; margin-bottom: 4px; }
        .goal-progress-label { font-size: 10px; color: #9999bb; font-weight: 600; }
        .goal-progress-value { font-size: 10px; font-weight: 700; }
        .goal-progress-track { height: 6px; background: #f0effe; border-radius: 99px; }
        .goal-progress-fill { height: 100%; border-radius: 99px; }
        .goal-footer { border-top: 1px solid #f0effe; padding-top: 12px; display: flex; justify-content: space-between; align-items: center; }
        .goal-footer-label { font-size: 10px; color: #9999bb; margin-bottom: 2px; }
        .goal-footer-value { font-size: 12px; color: #0b044d; font-weight: 600; }
        
        .table-wrapper { overflow-x: auto; }
        .payroll-table { width: 100%; border-collapse: collapse; }
        .payroll-table th { text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e5e4f0; }
        .payroll-table td { padding: 14px 16px; font-size: 13px; color: #0b044d; border-bottom: 1px solid #f4f3ff; }
        
        .badge-status { font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 20px; display: inline-block; }
        .badge-status.completed { background: #e8f9ef; color: #15803d; }
        .badge-status.on-hold { background: #fefce8; color: #d9bb00; }
        .badge-status.processed { background: #e8f9ef; color: #15803d; }
        
        .dept-tag { font-size: 11px; font-weight: 600; padding: 4px 10px; background: #f7f6ff; color: #6b6a8a; border-radius: 20px; }
        
        .row-actions { display: flex; gap: 8px; }
        .btn-view { padding: 6px 12px; border-radius: 6px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 11px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .btn-view:hover { border-color: #15803d; color: #15803d; }
        .btn-edit { padding: 6px 12px; border-radius: 6px; border: none; background: #f0f0f0; font-size: 11px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .btn-edit:hover { background: #e5e5e5; }
        
        .table-footer { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-top: 1px solid #e5e4f0; background: #faf9ff; }
        .table-footer p { font-size: 12px; color: #6b6a8a; margin: 0; }
        
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(11, 4, 77, 0.6); display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.2s; }
        .modal-overlay.show { opacity: 1; visibility: visible; }
        .modal-box { background: #fff; border-radius: 16px; width: 90%; max-width: 500px; max-height: 90vh; overflow: hidden; transform: scale(0.95); transition: transform 0.2s; }
        .modal-lg { max-width: 560px; }
        .modal-overlay.show .modal-box { transform: scale(1); }
        .modal-header { display: flex; justify-content: space-between; align-items: flex-start; padding: 20px 24px; border-bottom: 1px solid #e5e4f0; }
        .pmodal-hero { display: flex; gap: 16px; align-items: flex-start; }
        .pmodal-hero-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .modal-eyebrow { font-size: 10px; font-weight: 700; color: #9999bb; letter-spacing: 1px; text-transform: uppercase; }
        .modal-title { font-size: 18px; font-weight: 700; color: #0b044d; margin: 4px 0; }
        .modal-sub { font-size: 12px; color: #6b6a8a; margin: 0; }
        .pmodal-badges { display: flex; gap: 8px; margin-top: 8px; }
        .badge-emptype { font-size: 10px; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
        .modal-close { background: none; border: none; cursor: pointer; color: #9999bb; padding: 4px; }
        .modal-body { padding: 0 24px 20px; }
        .modal-rating-box { background: #f7f6ff; border-radius: 12px; padding: 18px 20px; margin-bottom: 20px; display: flex; align-items: center; gap: 16px; }
        .modal-rating-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .modal-rating-label { font-size: 11px; color: #9999bb; margin-bottom: 4px; font-weight: 600; letter-spacing: 0.8px; }
        .modal-rating-value { font-size: 16px; font-weight: 800; color: #0b044d; }
        .modal-section-label { font-size: 10.5px; font-weight: 700; color: #aaa8cc; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block; }
        .modal-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f4f3ff; font-size: 13px; }
        .modal-row span:first-child { color: #6b6a8a; }
        .modal-row strong { color: #0b044d; }
        .modal-feedback { font-size: 13px; color: #6b6a8a; line-height: 1.6; margin-bottom: 16px; }
        .badge-list { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
        .badge-strength { background: #15803d15; color: #15803d; }
        .badge-improve { background: #d9bb0015; color: #d9bb00; }
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
                <a href="/joborder/attendance" class="nav-item">Attendance</a>
                <a href="/joborder/leave" class="nav-item">Leave Request</a>
                <a href="/joborder/training" class="nav-item">Training</a>
                <a href="/joborder/profile" class="nav-item">Profile</a>
                <a href="/joborder/performance" class="nav-item active"><span class="nav-active-bar"></span>Performance</a>
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
                    <div class="banner-badge"><span class="banner-badge-dot"></span>Performance Management</div>
                    <div class="banner-badge outline">Latest Rating: 4.5 / 5.0</div>
                </div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Latest Rating</p>
                        <div class="stat-icon-wrap" style="background:#0b044d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                    </div>
                    <h2 class="stat-value">4.5</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#0b044d"></span>
                        <p class="stat-sub">Apr-Jun 2025</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Average Rating</p>
                        <div class="stat-icon-wrap" style="background:#15803d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg></div>
                    </div>
                    <h2 class="stat-value">4.4</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#15803d"></span>
                        <p class="stat-sub">All evaluations</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Total Evaluations</p>
                        <div class="stat-icon-wrap" style="background:#d9bb0015"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d9bb00" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg></div>
                    </div>
                    <h2 class="stat-value">2</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#d9bb00"></span>
                        <p class="stat-sub">Completed reviews</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Active Goals</p>
                        <div class="stat-icon-wrap" style="background:#8e1e1815"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8e1e18" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></div>
                    </div>
                    <h2 class="stat-value">2</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#8e1e18"></span>
                        <p class="stat-sub">0 achieved</p>
                    </div>
                </div>
            </div>
            
            <section class="table-section">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Performance Trend</h3>
                        <p class="table-sub">Your rating history over time</p>
                    </div>
                </div>
                <div class="chart-container">
                    <div class="chart-bars">
                        <div class="chart-bar-wrapper">
                            <div class="chart-bar-container">
                                <div class="chart-bar" style="height: 86%; background: linear-gradient(180deg, #15803d 0%, #15803d99 100%);">
                                    <span class="chart-bar-label">4.3</span>
                                </div>
                            </div>
                            <div class="chart-bar-period">
                                <p>Jan-Mar 2025</p>
                            </div>
                        </div>
                        <div class="chart-bar-wrapper">
                            <div class="chart-bar-container">
                                <div class="chart-bar" style="height: 90%; background: linear-gradient(180deg, #15803d 0%, #15803d99 100%);">
                                    <span class="chart-bar-label">4.5</span>
                                </div>
                            </div>
                            <div class="chart-bar-period">
                                <p>Apr-Jun 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="table-section">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Performance Goals</h3>
                        <p class="table-sub">Track your progress towards set objectives</p>
                    </div>
                </div>
                <div class="goals-grid">
                    <div class="stat-card goal-card" onclick="openGoalModal()">
                        <div class="goal-header">
                            <div>
                                <p class="goal-id">GOAL-001</p>
                                <h4 class="goal-title">Complete Safety Training Program</h4>
                                <p class="goal-category">Professional Development</p>
                            </div>
                            <span class="badge-status processed">In Progress</span>
                        </div>
                        <div class="goal-progress">
                            <div class="goal-progress-header">
                                <span class="goal-progress-label">PROGRESS</span>
                                <span class="goal-progress-value" style="color:#d9bb00;">40%</span>
                            </div>
                            <div class="goal-progress-track">
                                <div class="goal-progress-fill" style="width: 40%; background: linear-gradient(90deg, #d9bb00, #d9bb0099);"></div>
                            </div>
                        </div>
                        <div class="goal-footer">
                            <div>
                                <p class="goal-footer-label">Target Date</p>
                                <p class="goal-footer-value">Jun 22, 2025</p>
                            </div>
                        </div>
                    </div>
                    <div class="stat-card goal-card" onclick="openGoalModal()">
                        <div class="goal-header">
                            <div>
                                <p class="goal-id">GOAL-002</p>
                                <h4 class="goal-title">Improve Task Completion Rate</h4>
                                <p class="goal-category">Efficiency</p>
                            </div>
                            <span class="badge-status processed">In Progress</span>
                        </div>
                        <div class="goal-progress">
                            <div class="goal-progress-header">
                                <span class="goal-progress-label">PROGRESS</span>
                                <span class="goal-progress-value" style="color:#d9bb00;">75%</span>
                            </div>
                            <div class="goal-progress-track">
                                <div class="goal-progress-fill" style="width: 75%; background: linear-gradient(90deg, #d9bb00, #d9bb0099);"></div>
                            </div>
                        </div>
                        <div class="goal-footer">
                            <div>
                                <p class="goal-footer-label">Target Date</p>
                                <p class="goal-footer-value">Jul 31, 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="table-section">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Evaluation History</h3>
                        <p class="table-sub">Your complete performance evaluation records</p>
                    </div>
                </div>
                
                <div class="table-wrapper">
                    <table class="payroll-table">
                        <thead>
                            <tr>
                                <th>Evaluation ID</th>
                                <th>Period</th>
                                <th>Evaluator</th>
                                <th>Completed Date</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size:12.5px;color:#6b6a8a;font-weight:500;">EVAL-2025-01</td>
                                <td style="font-size:12.5px;color:#0b044d;font-weight:600;">Apr-Jun 2025</td>
                                <td><span class="dept-tag">General Services Head</span></td>
                                <td style="font-size:12.5px;color:#6b6a8a;white-space:nowrap;">Jun 28, 2025</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <span style="font-size:14px;font-weight:700;color:#15803d;">4.5</span>
                                        <span style="font-size:11px;color:#9999bb;">/ 5.0</span>
                                    </div>
                                </td>
                                <td><span class="badge-status completed">Completed</span></td>
                                <td>
                                    <div class="row-actions">
                                        <button class="btn-view" onclick="openEvalModal()">View</button>
                                        <button class="btn-edit">Download</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12.5px;color:#6b6a8a;font-weight:500;">EVAL-2025-02</td>
                                <td style="font-size:12.5px;color:#0b044d;font-weight:600;">Jan-Mar 2025</td>
                                <td><span class="dept-tag">General Services Head</span></td>
                                <td style="font-size:12.5px;color:#6b6a8a;white-space:nowrap;">Mar 30, 2025</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <span style="font-size:14px;font-weight:700;color:#15803d;">4.3</span>
                                        <span style="font-size:11px;color:#9999bb;">/ 5.0</span>
                                    </div>
                                </td>
                                <td><span class="badge-status completed">Completed</span></td>
                                <td>
                                    <div class="row-actions">
                                        <button class="btn-view" onclick="openEvalModal()">View</button>
                                        <button class="btn-edit">Download</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="table-footer">
                    <p>Showing <strong>2</strong> evaluation records</p>
                </div>
            </section>
        </main>
    </div>
    
    <div class="modal-overlay" id="evalModal">
        <div class="modal-box modal-lg">
            <div class="modal-header">
                <div class="pmodal-hero">
                    <div class="pmodal-hero-icon" style="background: linear-gradient(135deg, #15803d 0%, #15803d99 100%);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <div>
                        <span class="modal-eyebrow">PERFORMANCE EVALUATION · EVAL-2025-01</span>
                        <h3 class="modal-title">Evaluation Report</h3>
                        <p class="modal-sub">Apr-Jun 2025 · Completed on Jun 28, 2025</p>
                        <div class="pmodal-badges">
                            <span class="badge-status completed">Completed</span>
                            <span class="badge-emptype" style="background:#15803d15;color:#15803d;">Rating: 4.5</span>
                        </div>
                    </div>
                </div>
                <button class="modal-close" onclick="closeModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-rating-box">
                    <div class="modal-rating-icon" style="background: linear-gradient(135deg, #15803d 0%, #15803d99 100%);">
                        <span style="font-size:20px;font-weight:800;color:#fff;">4.5</span>
                    </div>
                    <div>
                        <p class="modal-rating-label">OVERALL RATING</p>
                        <p class="modal-rating-value">4.5 out of 5.0</p>
                    </div>
                </div>
                
                <span class="modal-section-label">EVALUATION DETAILS</span>
                <div class="modal-row"><span>Evaluation Period</span><strong>Apr-Jun 2025</strong></div>
                <div class="modal-row"><span>Evaluator</span><strong>General Services Head</strong></div>
                <div class="modal-row"><span>Completed Date</span><strong>Jun 28, 2025</strong></div>
                
                <span class="modal-section-label" style="margin-top:20px;">FEEDBACK</span>
                <p class="modal-feedback">Good performance and dedication to assigned tasks.</p>
                
                <span class="modal-section-label">STRENGTHS</span>
                <div class="badge-list">
                    <span class="badge-emptype badge-strength">Reliability</span>
                    <span class="badge-emptype badge-strength">Teamwork</span>
                    <span class="badge-emptype badge-strength">Punctuality</span>
                </div>
                
                <span class="modal-section-label">AREAS FOR IMPROVEMENT</span>
                <div class="badge-list">
                    <span class="badge-emptype badge-improve">Technical Skills</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="modal-btn-ghost" onclick="closeModal()">Close</button>
                <button class="modal-btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Download Report
                </button>
            </div>
        </div>
    </div>
    
    <div class="modal-overlay" id="goalModal">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <span class="modal-eyebrow">PERFORMANCE GOAL · GOAL-001</span>
                    <h3 class="modal-title">Complete Safety Training Program</h3>
                    <p class="modal-sub">Professional Development · Target: Jun 22, 2025</p>
                </div>
                <button class="modal-close" onclick="closeModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div style="margin-bottom:20px;">
                    <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                        <span style="font-size:11px;color:#9999bb;font-weight:600;letter-spacing:0.8px;">PROGRESS</span>
                        <span style="font-size:11px;color:#d9bb00;font-weight:700;">40%</span>
                    </div>
                    <div style="height:8px;background:#f0effe;border-radius:99px;">
                        <div style="height:100%;width:40%;background:linear-gradient(90deg, #d9bb00, #d9bb0099);border-radius:99px;transition:width 0.4s;"></div>
                    </div>
                </div>
                
                <div class="modal-row"><span>Category</span><strong>Professional Development</strong></div>
                <div class="modal-row"><span>Target Date</span><strong>Jun 22, 2025</strong></div>
                <div class="modal-row"><span>Status</span><span class="badge-status processed">In Progress</span></div>
            </div>
            <div class="modal-footer">
                <button class="modal-btn-ghost" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
        
        function openEvalModal() {
            document.getElementById('evalModal').classList.add('show');
        }
        
        function openGoalModal() {
            document.getElementById('goalModal').classList.add('show');
        }
        
        function closeModal() {
            document.querySelectorAll('.modal-overlay').forEach(m => m.classList.remove('show'));
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
        
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) closeModal();
            });
        });
    </script>
</body>
</html>