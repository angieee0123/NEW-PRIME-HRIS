<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance | PRIME HRIS - Permanent Employee</title>
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
        .nav-item.active { background: #6b3fa0; color: #fff; }
        .nav-item.active .nav-icon svg { stroke: #fff; }
        .nav-icon { width: 20px; height: 20px; display: flex; align-items: center; }
        .nav-icon svg { width: 18px; height: 18px; }
        .nav-active-bar { position: absolute; right: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 20px; background: #6b3fa0; border-radius: 2px; }
        .sidebar.collapsed .nav-active-bar { display: none; }
        
        .sidebar-footer { padding: 16px; border-top: 1px solid #e5e4f0; display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #8e1e18, #5a0f0b); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 12px; font-weight: 700; }
        .user-info { flex: 1; }
        .user-name { font-size: 13px; font-weight: 600; color: #0b044d; }
        .user-role { font-size: 11px; color: #9999bb; }
        .logout-btn { background: none; border: none; cursor: pointer; color: #9999bb; padding: 6px; }
        
        .main-content { flex: 1; margin-left: 260px; padding: 24px 28px; transition: margin-left 0.3s; }
        .sidebar.collapsed + .main-content, .sidebar.collapsed ~ .main-content { margin-left: 70px; }
        
        .welcome-banner { background: linear-gradient(135deg, #6b3fa0 0%, #5a2e8a 100%); border-radius: 16px; padding: 24px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .banner-left { display: flex; align-items: center; gap: 16px; }
        .banner-avatar { width: 46px; height: 46px; border-radius: 50%; background: #8e1e18; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 16px; }
        .banner-left h2 { font-size: 17px; font-weight: 700; color: #fff; margin: 0 0 4px; }
        .banner-left p { font-size: 12px; color: rgba(255,255,255,0.55); margin: 0; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: #fff; border-radius: 14px; padding: 18px; border: 1.5px solid #e5e4f0; }
        .stat-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
        .stat-label { font-size: 12px; color: #9999bb; font-weight: 600; }
        .stat-icon-wrap { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .stat-value { font-size: 22px; font-weight: 800; color: #0b044d; margin: 0 0 6px; }
        .stat-footer { display: flex; align-items: center; gap: 6px; }
        .stat-dot { width: 6px; height: 6px; border-radius: 50%; }
        .stat-sub { font-size: 11px; color: #9999bb; margin: 0; }
        
        .table-section { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; margin-bottom: 20px; overflow: hidden; }
        .table-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #e5e4f0; }
        .table-title { font-size: 14px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .table-sub { font-size: 12px; color: #9999bb; margin: 0; }
        .table-actions { display: flex; gap: 10px; }
        .btn-export { padding: 8px 14px; border-radius: 8px; border: none; background: #6b3fa0; font-size: 12px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 6px; }
        .table-wrapper { overflow-x: auto; }
        .payroll-table { width: 100%; border-collapse: collapse; }
        .payroll-table th { text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e5e4f0; }
        .payroll-table td { padding: 14px 16px; font-size: 13px; color: #0b044d; border-bottom: 1px solid #f4f3ff; }
        .badge-status { font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 20px; display: inline-block; }
        .badge-status.on-hold { background: #f3e8ff; color: #6b3fa0; border: 1px solid #e9d5ff; }
        .badge-status.processed { background: #e8f9ef; color: #15803d; border: 1px solid #bbf7d0; }
        .badge-emptype { font-size: 10px; font-weight: 600; padding: 3px 8px; border-radius: 20px; background: #f0effe; color: #6b3fa0; }
        .dept-tag { font-size: 10px; font-weight: 600; padding: 3px 8px; border-radius: 20px; background: #f0effe; color: #6b3fa0; }
        .btn-view { padding: 7px 14px; border-radius: 8px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 12px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .btn-view:hover { border-color: #6b3fa0; color: #6b3fa0; }
        .btn-edit { padding: 7px 14px; border-radius: 8px; border: none; background: #6b3fa0; font-size: 12px; font-weight: 600; color: #fff; cursor: pointer; }
        .table-footer { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-top: 1px solid #e5e4f0; background: #faf9ff; }
        .table-footer p { font-size: 12px; color: #6b6a8a; margin: 0; }
        
        .training-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 16px; padding: 16px 20px; }
        .training-card { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; padding: 20px; position: relative; }
        .card-header { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
        .card-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; }
        .card-title { font-size: 14px; font-weight: 700; color: #0b044d; }
        .card-sub { font-size: 11px; color: #9999bb; margin-bottom: 2px; }
        .card-desc { font-size: 12.5px; color: #6b6a8a; line-height: 1.6; margin-bottom: 12px; }
        .card-footer { border-top: 1px solid #f0effe; padding-top: 12px; display: flex; align-items: center; gap: 8px; }
        
        .goals-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 16px; padding: 16px 20px; }
        .goal-card { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; padding: 20px; cursor: pointer; }
        .goal-card:hover { border-color: #6b3fa0; }
        .goal-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; }
        .goal-header > div { flex: 1; }
        .goal-id { font-size: 10px; color: #9999bb; font-weight: 600; margin-bottom: 4px; display: block; }
        .goal-title { font-size: 14px; font-weight: 700; color: #0b044d; margin-bottom: 4px; }
        .goal-category { font-size: 12px; color: #6b6a8a; }
        .progress-bar { margin-bottom: 12px; }
        .progress-label { display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 10px; }
        .progress-label span:first-child { color: #9999bb; font-weight: 600; }
        .progress-fill { height: 6px; background: #f0effe; border-radius: 99px; overflow: hidden; }
        .goal-footer { border-top: 1px solid #f0effe; padding-top: 12px; }
        .goal-footer p:first-child { font-size: 10px; color: #9999bb; margin-bottom: 2px; }
        .goal-footer p:last-child { font-size: 12px; font-weight: 600; color: #0b044d; }
        
        .chart-container { display: flex; align-items: flex-end; gap: 16px; height: 200px; padding: 28px 32px; }
        .chart-bar { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 12px; }
        .chart-bar-fill { width: 100%; display: flex; flex-direction: column; justify-content: flex-end; height: 100%; }
        .chart-bar-content { width: 100%; border-radius: 8px 8px 0 0; display: flex; align-items: flex-start; justify-content: center; padding-top: 8px; min-height: 40px; }
        .chart-bar-content span { font-size: 13px; font-weight: 700; color: #fff; }
        .chart-bar-label { text-align: center; }
        .chart-bar-label p { font-size: 11px; color: #6b6a8a; font-weight: 600; white-space: nowrap; }
        
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(11, 4, 77, 0.6); display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.2s; }
        .modal-overlay.show { opacity: 1; visibility: visible; }
        .modal-box { background: #fff; border-radius: 16px; width: 90%; max-width: 520px; max-height: 90vh; overflow: hidden; transform: scale(0.95); transition: transform 0.2s; }
        .modal-overlay.show .modal-box { transform: scale(1); }
        .modal-header { display: flex; justify-content: space-between; align-items: flex-start; padding: 20px 24px; border-bottom: 1px solid #e5e4f0; }
        .pmodal-hero { display: flex; align-items: center; gap: 14px; }
        .pmodal-hero-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .modal-eyebrow { font-size: 10px; font-weight: 700; color: #9999bb; letter-spacing: 1px; text-transform: uppercase; }
        .modal-title { font-size: 18px; font-weight: 700; color: #0b044d; margin: 4px 0; }
        .modal-sub { font-size: 12px; color: #6b6a8a; margin: 0; }
        .modal-close { background: none; border: none; cursor: pointer; color: #9999bb; padding: 4px; }
        .modal-body { padding: 0 24px 20px; }
        .pmodal-badges { display: flex; gap: 6px; margin-top: 8px; }
        .rating-box { background: #f7f6ff; border-radius: 12px; padding: 18px 20px; margin-bottom: 20px; display: flex; align-items: center; gap: 16px; }
        .rating-box-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
        .rating-box-icon span { font-size: 20px; font-weight: 800; color: #fff; }
        .rating-box p:first-child { font-size: 11px; color: #9999bb; margin-bottom: 4px; font-weight: 600; letter-spacing: 0.8px; }
        .rating-box p:last-child { font-size: 16px; font-weight: 800; color: #0b044d; }
        .modal-section-label { font-size: 10.5px; font-weight: 700; color: #aaa8cc; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block; }
        .modal-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f4f3ff; font-size: 13px; }
        .modal-row span:first-child { color: #6b6a8a; }
        .modal-row strong { color: #0b044d; }
        .strengths { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }
        .strength-tag { font-size: 10px; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
        .modal-progress { margin-bottom: 20px; }
        .modal-progress-label { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .modal-progress-label span:first-child { font-size: 11px; color: #9999bb; font-weight: 600; letter-spacing: 0.8px; }
        .modal-progress-label span:last-child { font-size: 11px; font-weight: 700; }
        .modal-footer { display: flex; justify-content: space-between; padding: 16px 24px; border-top: 1px solid #e5e4f0; }
        .modal-btn-ghost { padding: 10px 20px; border-radius: 9px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 13px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .modal-btn-primary { padding: 10px 20px; border-radius: 9px; border: none; background: #6b3fa0; font-size: 13px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        
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
                <a href="/permanent/performance" class="nav-item active"><span class="nav-active-bar"></span>Performance</a>
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
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Latest Rating</p>
                        <div class="stat-icon-wrap" style="background:#0b044d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                    </div>
                    <h2 class="stat-value">4.8</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#0b044d"></span>
                        <p class="stat-sub">Jan-Jun 2025</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Average Rating</p>
                        <div class="stat-icon-wrap" style="background:#15803d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 18"/></svg></div>
                    </div>
                    <h2 class="stat-value">4.7</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#15803d"></span>
                        <p class="stat-sub">All evaluations</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Total Evaluations</p>
                        <div class="stat-icon-wrap" style="background:#d9bb0015"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d9bb00" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg></div>
                    </div>
                    <h2 class="stat-value">4</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#d9bb00"></span>
                        <p class="stat-sub">Completed reviews</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Goals Achieved</p>
                        <div class="stat-icon-wrap" style="background:#8e1e1815"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8e1e18" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></div>
                    </div>
                    <h2 class="stat-value">1</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#8e1e18"></span>
                        <p class="stat-sub">4 total goals</p>
                    </div>
                </div>
            </div>
            
            <section class="table-section" style="margin-bottom:24px;">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Training Impact on Performance</h3>
                        <p class="table-sub">How completed training programs have influenced your performance metrics</p>
                    </div>
                </div>
                <div class="training-cards">
                    <div class="training-card">
                        <span class="badge-status on-hold" style="position:absolute;top:16px;right:16px;">Completed</span>
                        <div class="card-header">
                            <div class="card-icon" style="background:linear-gradient(135deg, #15803d, #166534);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div>
                            <div>
                                <h4 class="card-title">Customer Service Excellence</h4>
                                <p class="card-sub">Completed: May 20, 2025</p>
                            </div>
                        </div>
                        <p class="card-desc">Improved team collaboration score by 25%</p>
                        <div class="card-footer">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d9bb00" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span style="font-size:13px;font-weight:700;color:#0b044d;">4.9</span>
                            <span style="font-size:11px;color:#9999bb;">Training Rating</span>
                        </div>
                    </div>
                    <div class="training-card">
                        <span class="badge-status on-hold" style="position:absolute;top:16px;right:16px;">Completed</span>
                        <div class="card-header">
                            <div class="card-icon" style="background:linear-gradient(135deg, #15803d, #166534);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div>
                            <div>
                                <h4 class="card-title">Digital Literacy Training</h4>
                                <p class="card-sub">Completed: Apr 15, 2025</p>
                            </div>
                        </div>
                        <p class="card-desc">Enhanced technical proficiency and workflow efficiency</p>
                        <div class="card-footer">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d9bb00" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span style="font-size:13px;font-weight:700;color:#0b044d;">4.7</span>
                            <span style="font-size:11px;color:#9999bb;">Training Rating</span>
                        </div>
                    </div>
                    <div class="training-card">
                        <span class="badge-status processed" style="position:absolute;top:16px;right:16px;">In Progress</span>
                        <div class="card-header">
                            <div class="card-icon" style="background:linear-gradient(135deg, #d9bb00, #fbbf24);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div>
                            <div>
                                <h4 class="card-title">Leadership Development Program</h4>
                                <p class="card-sub">Completed: In Progress</p>
                            </div>
                        </div>
                        <p class="card-desc">Developing management and decision-making skills</p>
                    </div>
                </div>
            </section>
            
            <section class="table-section" style="margin-bottom:24px;">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Performance Trend</h3>
                        <p class="table-sub">Your rating history over time</p>
                    </div>
                </div>
                <div class="chart-container">
                    <div class="chart-bar">
                        <div class="chart-bar-fill">
                            <div class="chart-bar-content" style="background:linear-gradient(180deg, #15803d, #15803d99);height:90%;">
                                <span>4.5</span>
                            </div>
                        </div>
                        <div class="chart-bar-label">
                            <p>Jul-Dec 2023</p>
                        </div>
                    </div>
                    <div class="chart-bar">
                        <div class="chart-bar-fill">
                            <div class="chart-bar-content" style="background:linear-gradient(180deg, #15803d, #15803d99);height:92%;">
                                <span>4.6</span>
                            </div>
                        </div>
                        <div class="chart-bar-label">
                            <p>Jan-Jun 2024</p>
                        </div>
                    </div>
                    <div class="chart-bar">
                        <div class="chart-bar-fill">
                            <div class="chart-bar-content" style="background:linear-gradient(180deg, #15803d, #15803d99);height:94%;">
                                <span>4.7</span>
                            </div>
                        </div>
                        <div class="chart-bar-label">
                            <p>Jul-Dec 2024</p>
                        </div>
                    </div>
                    <div class="chart-bar">
                        <div class="chart-bar-fill">
                            <div class="chart-bar-content" style="background:linear-gradient(180deg, #15803d, #15803d99);height:96%;">
                                <span>4.8</span>
                            </div>
                        </div>
                        <div class="chart-bar-label">
                            <p>Jan-Jun 2025</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="table-section" style="margin-bottom:24px;">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Performance Goals</h3>
                        <p class="table-sub">Track your progress towards set objectives linked to training programs</p>
                    </div>
                </div>
                <div class="goals-grid">
                    <div class="goal-card" onclick="openGoal('Complete Advanced Leadership Training', 'Professional Development', 65, 'Jul 15, 2025', 'In Progress')">
                        <div class="goal-header">
                            <div>
                                <span class="goal-id">GOAL-001</span>
                                <h4 class="goal-title">Complete Advanced Leadership Training</h4>
                                <p class="goal-category">Professional Development</p>
                            </div>
                            <span class="badge-status processed">In Progress</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-label"><span>PROGRESS</span><span style="color:#d9bb00">65%</span></div>
                            <div class="progress-fill"><div style="height:100%;width:65%;background:linear-gradient(90deg, #d9bb00, #fbbf24);border-radius:99px;"></div></div>
                        </div>
                        <div class="goal-footer">
                            <p>Target Date</p>
                            <p>Jul 15, 2025</p>
                        </div>
                    </div>
                    <div class="goal-card" onclick="openGoal('Improve Team Collaboration Metrics', 'Teamwork', 100, 'Jun 30, 2025', 'Achieved')">
                        <div class="goal-header">
                            <div>
                                <span class="goal-id">GOAL-002</span>
                                <h4 class="goal-title">Improve Team Collaboration Metrics</h4>
                                <p class="goal-category">Teamwork</p>
                            </div>
                            <span class="badge-status on-hold">Achieved</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-label"><span>PROGRESS</span><span style="color:#15803d">100%</span></div>
                            <div class="progress-fill"><div style="height:100%;width:100%;background:linear-gradient(90deg, #15803d, #166534);border-radius:99px;"></div></div>
                        </div>
                        <div class="goal-footer">
                            <p>Target Date</p>
                            <p>Jun 30, 2025</p>
                        </div>
                    </div>
                    <div class="goal-card" onclick="openGoal('Reduce Processing Time by 20%', 'Efficiency', 45, 'Dec 31, 2025', 'In Progress')">
                        <div class="goal-header">
                            <div>
                                <span class="goal-id">GOAL-003</span>
                                <h4 class="goal-title">Reduce Processing Time by 20%</h4>
                                <p class="goal-category">Efficiency</p>
                            </div>
                            <span class="badge-status processed">In Progress</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-label"><span>PROGRESS</span><span style="color:#d9bb00">45%</span></div>
                            <div class="progress-fill"><div style="height:100%;width:45%;background:linear-gradient(90deg, #d9bb00, #fbbf24);border-radius:99px;"></div></div>
                        </div>
                        <div class="goal-footer">
                            <p>Target Date</p>
                            <p>Dec 31, 2025</p>
                        </div>
                    </div>
                    <div class="goal-card" onclick="openGoal('Complete Safety Certification', 'Compliance', 30, 'Aug 30, 2025', 'In Progress')">
                        <div class="goal-header">
                            <div>
                                <span class="goal-id">GOAL-004</span>
                                <h4 class="goal-title">Complete Safety Certification</h4>
                                <p class="goal-category">Compliance</p>
                            </div>
                            <span class="badge-status processed">In Progress</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-label"><span>PROGRESS</span><span style="color:#d9bb00">30%</span></div>
                            <div class="progress-fill"><div style="height:100%;width:30%;background:linear-gradient(90deg, #d9bb00, #fbbf24);border-radius:99px;"></div></div>
                        </div>
                        <div class="goal-footer">
                            <p>Target Date</p>
                            <p>Aug 30, 2025</p>
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
                    <div class="table-actions">
                        <button class="btn-export">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="7 10 12 15 17 10"/>
                                <line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                            Export All
                        </button>
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
                                <td style="font-size:12.5px;color:#0b044d;font-weight:600;">Jan-Jun 2025</td>
                                <td><span class="dept-tag">Mayor Office</span></td>
                                <td style="font-size:12.5px;color:#6b6a8a;">Jun 28, 2025</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <span style="font-size:14px;font-weight:700;color:#15803d;">4.8</span>
                                        <span style="font-size:11px;color:#9999bb;">/ 5.0</span>
                                    </div>
                                </td>
                                <td><span class="badge-status on-hold">Completed</span></td>
                                <td>
                                    <button class="btn-view" onclick="openEvaluation('EVAL-2025-01', 'Jan-Jun 2025', 4.8, 'Jun 28, 2025', 'Mayor Office', 'Excellent performance and leadership skills demonstrated. Shows strong commitment to professional development and training completion.', ['Leadership', 'Communication', 'Problem Solving', 'Training Completion'], ['Time Management'])">View</button>
                                    <button class="btn-edit" style="margin-left:4px;">Download</button>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12.5px;color:#6b6a8a;font-weight:500;">EVAL-2024-02</td>
                                <td style="font-size:12.5px;color:#0b044d;font-weight:600;">Jul-Dec 2024</td>
                                <td><span class="dept-tag">Mayor Office</span></td>
                                <td style="font-size:12.5px;color:#6b6a8a;">Dec 20, 2024</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <span style="font-size:14px;font-weight:700;color:#15803d;">4.7</span>
                                        <span style="font-size:11px;color:#9999bb;">/ 5.0</span>
                                    </div>
                                </td>
                                <td><span class="badge-status on-hold">Completed</span></td>
                                <td><button class="btn-view">View</button><button class="btn-edit" style="margin-left:4px;">Download</button></td>
                            </tr>
                            <tr>
                                <td style="font-size:12.5px;color:#6b6a8a;font-weight:500;">EVAL-2024-01</td>
                                <td style="font-size:12.5px;color:#0b044d;font-weight:600;">Jan-Jun 2024</td>
                                <td><span class="dept-tag">Mayor Office</span></td>
                                <td style="font-size:12.5px;color:#6b6a8a;">Jun 25, 2024</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <span style="font-size:14px;font-weight:700;color:#15803d;">4.6</span>
                                        <span style="font-size:11px;color:#9999bb;">/ 5.0</span>
                                    </div>
                                </td>
                                <td><span class="badge-status on-hold">Completed</span></td>
                                <td><button class="btn-view">View</button><button class="btn-edit" style="margin-left:4px;">Download</button></td>
                            </tr>
                            <tr>
                                <td style="font-size:12.5px;color:#6b6a8a;font-weight:500;">EVAL-2023-02</td>
                                <td style="font-size:12.5px;color:#0b044d;font-weight:600;">Jul-Dec 2023</td>
                                <td><span class="dept-tag">Mayor Office</span></td>
                                <td style="font-size:12.5px;color:#6b6a8a;">Dec 18, 2023</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <span style="font-size:14px;font-weight:700;color:#15803d;">4.5</span>
                                        <span style="font-size:11px;color:#9999bb;">/ 5.0</span>
                                    </div>
                                </td>
                                <td><span class="badge-status on-hold">Completed</span></td>
                                <td><button class="btn-view">View</button><button class="btn-edit" style="margin-left:4px;">Download</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="table-footer">
                    <p>Showing <strong>4</strong> evaluation records</p>
                </div>
            </section>
        </main>
    </div>
    
    <div class="modal-overlay" id="evalModal">
        <div class="modal-box">
            <div class="modal-header">
                <div class="pmodal-hero">
                    <div class="pmodal-hero-icon" id="evalIcon" style="background:linear-gradient(135deg, #6b3fa0, #7c4fc0);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <div>
                        <span class="modal-eyebrow" id="evalId">PERFORMANCE EVALUATION</span>
                        <h3 class="modal-title">Evaluation Report</h3>
                        <p class="modal-sub" id="evalSub">Period · Completed on Date</p>
                    </div>
                </div>
                <button class="modal-close" onclick="closeModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body" id="evalBody">
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
                    <span class="modal-eyebrow" id="goalId">PERFORMANCE GOAL</span>
                    <h3 class="modal-title" id="goalTitle">Goal Title</h3>
                    <p class="modal-sub" id="goalSub">Category · Target</p>
                </div>
                <button class="modal-close" onclick="closeGoalModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body" id="goalBody">
            </div>
            <div class="modal-footer" id="goalFooter">
                <button class="modal-btn-ghost" onclick="closeGoalModal()">Close</button>
                <button class="modal-btn-primary" id="goalAction">Update Progress</button>
            </div>
        </div>
    </div>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
        
        function openEvaluation(id, period, rating, completedDate, evaluator, feedback, strengths, improvements) {
            const ratingColor = rating >= 4.5 ? '#15803d' : rating >= 4.0 ? '#d9bb00' : '#8e1e18';
            document.getElementById('evalId').textContent = 'PERFORMANCE EVALUATION · ' + id;
            document.getElementById('evalSub').textContent = period + ' · Completed on ' + completedDate;
            document.getElementById('evalIcon').style.background = 'linear-gradient(135deg, ' + ratingColor + ', ' + ratingColor + '99)';
            
            let strengthsHtml = strengths.map(s => '<span class="strength-tag" style="background:#15803d15;color:#15803d;">' + s + '</span>').join('');
            let improvementsHtml = improvements.map(i => '<span class="strength-tag" style="background:#d9bb0015;color:#d9bb00;">' + i + '</span>').join('');
            
            document.getElementById('evalBody').innerHTML = '<div class="rating-box"><div class="rating-box-icon" style="background:linear-gradient(135deg,' + ratingColor + ',' + ratingColor + '99);"><span>' + rating + '</span></div><div><p>OVERALL RATING</p><p>' + rating + ' out of 5.0</p></div></div><div class="modal-section-label">EVALUATION DETAILS</div><div class="modal-row"><span>Evaluation Period</span><strong>' + period + '</strong></div><div class="modal-row"><span>Evaluator</span><strong>' + evaluator + '</strong></div><div class="modal-row"><span>Completed Date</span><strong>' + completedDate + '</strong></div><div class="modal-section-label" style="margin-top:20px;">FEEDBACK</div><p style="font-size:13px;color:#6b6a8a;line-height:1.6;margin-bottom:16px;">' + feedback + '</p><div class="modal-section-label">STRENGTHS</div><div class="strengths">' + strengthsHtml + '</div><div class="modal-section-label">AREAS FOR IMPROVEMENT</div><div class="strengths">' + improvementsHtml + '</div>';
            
            document.getElementById('evalModal').classList.add('show');
        }
        
        function closeModal() {
            document.getElementById('evalModal').classList.remove('show');
        }
        
        function openGoal(title, category, progress, target, status) {
            const statusColor = status === 'Achieved' ? '#15803d' : status === 'In Progress' ? '#d9bb00' : '#8e1e18';
            document.getElementById('goalTitle').textContent = title;
            document.getElementById('goalSub').textContent = category + ' · Target: ' + target;
            document.getElementById('goalBody').innerHTML = '<div class="modal-progress"><div class="modal-progress-label"><span>PROGRESS</span><span style="color:' + statusColor + '">' + progress + '%</span></div><div style="height:8px;background:#f0effe;border-radius:99px;"><div style="height:100%;width:' + progress + '%;background:linear-gradient(90deg,' + statusColor + ',' + statusColor + '99);border-radius:99px;"></div></div></div><div class="modal-section-label">GOAL DETAILS</div><div class="modal-row"><span>Category</span><strong>' + category + '</strong></div><div class="modal-row"><span>Target Date</span><strong>' + target + '</strong></div><div class="modal-row"><span>Status</span><span class="badge-status ' + (status === 'Achieved' ? 'on-hold' : 'processed') + '">' + status + '</span></div>';
            
            document.getElementById('goalFooter').style.display = status !== 'Achieved' ? 'flex' : 'flex';
            document.getElementById('goalAction').style.display = status !== 'Achieved' ? 'block' : 'none';
            document.getElementById('goalModal').classList.add('show');
        }
        
        function closeGoalModal() {
            document.getElementById('goalModal').classList.remove('show');
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeGoalModal();
            }
        });
    </script>
</body>
</html>