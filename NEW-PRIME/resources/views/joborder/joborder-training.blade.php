<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training | PRIME HRIS - Job Order Employee</title>
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
        
        .table-section { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; margin-bottom: 20px; overflow: hidden; }
        .table-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #e5e4f0; }
        .table-title { font-size: 14px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .table-sub { font-size: 12px; color: #9999bb; margin: 0; }
        .table-wrapper { overflow-x: auto; }
        .payroll-table { width: 100%; border-collapse: collapse; }
        .payroll-table th { text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e5e4f0; }
        .payroll-table td { padding: 14px 16px; font-size: 13px; color: #0b044d; border-bottom: 1px solid #f4f3ff; }
        .badge-status { font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 20px; display: inline-block; }
        .badge-status.processed { background: #e8f9ef; color: #15803d; border: 1px solid #bbf7d0; }
        .badge-status.on-hold { background: #f3e8ff; color: #6b3fa0; border: 1px solid #e9d5ff; }
        .badge-emptype { font-size: 10px; font-weight: 600; padding: 3px 8px; border-radius: 20px; background: #f0effe; color: #6b3fa0; }
        .btn-view { padding: 7px 14px; border-radius: 8px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 12px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .btn-view:hover { border-color: #15803d; color: #15803d; }
        .btn-edit { padding: 7px 14px; border-radius: 8px; border: none; background: #15803d; font-size: 12px; font-weight: 600; color: #fff; cursor: pointer; }
        .table-footer { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-top: 1px solid #e5e4f0; background: #faf9ff; }
        .table-footer p { font-size: 12px; color: #6b6a8a; margin: 0; }
        
        .training-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 16px; padding: 16px 20px; }
        .training-card { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; padding: 20px; cursor: pointer; position: relative; }
        .training-card:hover { border-color: #15803d; }
        .type-badge { position: absolute; top: 16px; right: 16px; }
        .card-header { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
        .card-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; font-weight: 700; }
        .card-title { font-size: 14px; font-weight: 700; color: #0b044d; }
        .card-id { font-size: 10px; color: #9999bb; font-weight: 600; margin-bottom: 2px; }
        .card-venue { font-size: 12px; color: #6b6a8a; margin-bottom: 12px; }
        .capacity-bar { margin-bottom: 12px; }
        .capacity-label { display: flex; justify-content: space-between; margin-bottom: 4px; }
        .capacity-label span:first-child { font-size: 10px; color: #9999bb; font-weight: 600; }
        .capacity-label span:last-child { font-size: 10px; font-weight: 700; }
        .progress-bar { height: 6px; background: #f0effe; border-radius: 99px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 99px; }
        .card-footer { border-top: 1px solid #f0effe; padding-top: 12px; display: flex; justify-content: space-between; align-items: center; }
        .card-footer div p:first-child { font-size: 10px; color: #9999bb; margin-bottom: 2px; }
        .card-footer div p:last-child { font-size: 12px; color: #0b044d; font-weight: 600; }
        .card-actions { display: flex; gap: 6px; }
        
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
        .modal-section-label { font-size: 10.5px; font-weight: 700; color: #aaa8cc; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block; }
        .modal-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f4f3ff; font-size: 13px; }
        .modal-row span:first-child { color: #6b6a8a; }
        .modal-row strong { color: #0b044d; }
        .modal-progress { margin-bottom: 20px; }
        .modal-progress-label { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .modal-progress-label span:first-child { font-size: 11px; color: #9999bb; font-weight: 600; letter-spacing: 0.8px; }
        .modal-progress-label span:last-child { font-size: 11px; font-weight: 700; }
        .slots-card { display: flex; align-items: center; gap: 12px; background: #f7f6ff; border-radius: 10px; padding: 14px 16px; margin-bottom: 18px; }
        .slots-icon { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .slots-card p { font-size: 11px; color: #9999bb; margin-bottom: 2px; }
        .slots-card span { font-size: 16px; font-weight: 800; color: #0b044d; }
        .slots-card span small { font-size: 12px; font-weight: 500; color: #9999bb; }
        .modal-footer { display: flex; justify-content: space-between; padding: 16px 24px; border-top: 1px solid #e5e4f0; }
        .modal-btn-ghost { padding: 10px 20px; border-radius: 9px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 13px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .modal-btn-primary { padding: 10px 20px; border-radius: 9px; border: none; background: #15803d; font-size: 13px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        
        .position-cell { font-weight: 600; }
        
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
                <a href="/joborder/training" class="nav-item active"><span class="nav-active-bar"></span>Training</a>
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
                    <div class="banner-badge"><span class="banner-badge-dot"></span>Training & Development</div>
                    <div class="banner-badge outline">2 Programs Enrolled</div>
                </div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Total Trainings</p>
                        <div class="stat-icon-wrap" style="background:#0b044d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></div>
                    </div>
                    <h2 class="stat-value">2</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#0b044d"></span>
                        <p class="stat-sub">All programs</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Completed</p>
                        <div class="stat-icon-wrap" style="background:#15803d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
                    </div>
                    <h2 class="stat-value">1</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#15803d"></span>
                        <p class="stat-sub">Finished programs</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Enrolled</p>
                        <div class="stat-icon-wrap" style="background:#d9bb0015"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d9bb00" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg></div>
                    </div>
                    <h2 class="stat-value">1</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#d9bb00"></span>
                        <p class="stat-sub">Currently active</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Available</p>
                        <div class="stat-icon-wrap" style="background:#8e1e1815"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8e1e18" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                    </div>
                    <h2 class="stat-value">2</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#8e1e18"></span>
                        <p class="stat-sub">Open for enrollment</p>
                    </div>
                </div>
            </div>
            
            <section class="table-section" style="margin-bottom:24px;">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">My Trainings</h3>
                        <p class="table-sub">Your enrolled and completed training programs</p>
                    </div>
                </div>
                
                <div class="table-wrapper">
                    <table class="payroll-table">
                        <thead>
                            <tr>
                                <th>Training ID</th>
                                <th>Program Title</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size:12.5px;color:#6b6a8a;font-weight:500;">TRN-005</td>
                                <td class="position-cell">Emergency Response Training</td>
                                <td><span class="badge-emptype">Safety</span></td>
                                <td style="font-size:12.5px;color:#6b6a8a;">Jun 20, 2025</td>
                                <td style="font-size:12.5px;color:#6b6a8a;">Jun 22, 2025</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <div style="flex:1;height:6px;background:#f0effe;border-radius:99px;min-width:60px;"><div style="height:100%;width:40%;background:#d9bb00;border-radius:99px;"></div></div>
                                        <span style="font-size:12;font-weight:600;color:#6b6a8a;min-width:35px;">40%</span>
                                    </div>
                                </td>
                                <td><span class="badge-status processed">Enrolled</span></td>
                                <td>
                                    <button class="btn-view" onclick="openMyTraining('Emergency Response Training', 'Safety', 40, 'Jun 20, 2025', 'Jun 22, 2025', 'MDRRM Office', 'Enrolled', null)">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:12.5px;color:#6b6a8a;font-weight:500;">TRN-003</td>
                                <td class="position-cell">Customer Service Excellence</td>
                                <td><span class="badge-emptype">Soft Skills</span></td>
                                <td style="font-size:12.5px;color:#6b6a8a;">May 10, 2025</td>
                                <td style="font-size:12.5px;color:#6b6a8a;">May 20, 2025</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <div style="flex:1;height:6px;background:#f0effe;border-radius:99px;min-width:60px;"><div style="height:100%;width:100%;background:#15803d;border-radius:99px;"></div></div>
                                        <span style="font-size:12;font-weight:600;color:#6b6a8a;min-width:35px;">100%</span>
                                    </div>
                                </td>
                                <td><span class="badge-status on-hold">Completed</span></td>
                                <td>
                                    <button class="btn-view" onclick="openMyTraining('Customer Service Excellence', 'Soft Skills', 100, 'May 10, 2025', 'May 20, 2025', 'Municipal Hall Conference Room', 'Completed', 'CERT-2025-003')">View</button>
                                    <button class="btn-edit" style="margin-left:4px;">Certificate</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="table-footer">
                    <p>Showing <strong>2</strong> training programs</p>
                </div>
            </section>
            
            <section class="table-section">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Available Trainings</h3>
                        <p class="table-sub">Open programs you can enroll in</p>
                    </div>
                </div>
                
                <div class="training-cards">
                    <div class="training-card">
                        <span class="type-badge badge-emptype">Technical</span>
                        <div class="card-header">
                            <div class="card-icon" style="background:linear-gradient(135deg, #15803d, #166534);">8</div>
                            <div>
                                <p class="card-id">TRN-006</p>
                                <h4 class="card-title">Basic Computer Skills Workshop</h4>
                            </div>
                        </div>
                        <p class="card-venue">IT Training Center</p>
                        <div class="capacity-bar">
                            <div class="capacity-label">
                                <span>CAPACITY</span>
                                <span style="color:#15803d">40% filled</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width:40%;background:linear-gradient(90deg, #15803d, #166534);"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div>
                                <p>Start Date</p>
                                <p>Jul 8, 2025</p>
                            </div>
                            <div class="card-actions">
                                <button class="btn-view" onclick="openAvailableTraining('Basic Computer Skills Workshop', 'Technical', 8, 20, 'Jul 8, 2025', 'Jul 12, 2025', 'IT Training Center')">View</button>
                                <button class="btn-edit">Enroll</button>
                            </div>
                        </div>
                    </div>
                    <div class="training-card">
                        <span class="type-badge badge-emptype">Safety</span>
                        <div class="card-header">
                            <div class="card-icon" style="background:linear-gradient(135deg, #8e1e18, #5a0f0b);">15</div>
                            <div>
                                <p class="card-id">TRN-007</p>
                                <h4 class="card-title">Workplace Safety and Health</h4>
                            </div>
                        </div>
                        <p class="card-venue">Municipal Hall Conference Room</p>
                        <div class="capacity-bar">
                            <div class="capacity-label">
                                <span>CAPACITY</span>
                                <span style="color:#8e1e18">50% filled</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width:50%;background:linear-gradient(90deg, #8e1e18, #5a0f0b);"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div>
                                <p>Start Date</p>
                                <p>Jul 25, 2025</p>
                            </div>
                            <div class="card-actions">
                                <button class="btn-view" onclick="openAvailableTraining('Workplace Safety and Health', 'Safety', 15, 30, 'Jul 25, 2025', 'Jul 27, 2025', 'Municipal Hall Conference Room')">View</button>
                                <button class="btn-edit">Enroll</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    
    <div class="modal-overlay" id="trainingModal">
        <div class="modal-box">
            <div class="modal-header">
                <div class="pmodal-hero">
                    <div class="pmodal-hero-icon" id="modalIcon" style="background:linear-gradient(135deg, #15803d, #166534);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <div>
                        <span class="modal-eyebrow" id="modalId">TRAINING PROGRAM</span>
                        <h3 class="modal-title" id="modalTitle">Training Title</h3>
                        <p class="modal-sub" id="modalSub">Type Training · Venue</p>
                        <div class="pmodal-badges" id="modalBadges">
                            <span class="badge-status">Status</span>
                            <span class="badge-emptype">Type</span>
                        </div>
                    </div>
                </div>
                <button class="modal-close" onclick="closeModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
            </div>
            <div class="modal-footer" id="modalFooter">
                <button class="modal-btn-ghost" onclick="closeModal()">Close</button>
                <button class="modal-btn-primary" id="modalAction">Enroll Now</button>
            </div>
        </div>
    </div>
    
    <script>
        const typeColors = { Leadership: '#0b044d', Technical: '#15803d', 'Soft Skills': '#d9bb00', Safety: '#8e1e18', Compliance: '#6b3fa0' };
        
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
        
        function openMyTraining(title, type, progress, startDate, endDate, venue, status, certificate) {
            const color = typeColors[type] || '#15803d';
            document.getElementById('modalId').textContent = 'TRAINING PROGRAM';
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalSub').textContent = type + ' Training · ' + venue;
            document.getElementById('modalIcon').style.background = 'linear-gradient(135deg, ' + color + ', ' + color + '99)';
            document.getElementById('modalBadges').innerHTML = '<span class="badge-status ' + (status === 'Enrolled' ? 'processed' : 'on-hold') + '">' + status + '</span><span class="badge-emptype">' + type + '</span>';
            
            let progressHtml = '<div class="modal-progress"><div class="modal-progress-label"><span>TRAINING PROGRESS</span><span style="color:' + color + '">' + progress + '%</span></div><div style="height:8px;background:#f0effe;border-radius:99px;"><div style="height:100%;width:' + progress + '%;background:linear-gradient(90deg,' + color + ',' + color + '99);border-radius:99px;"></div></div></div>';
            
            let certRow = certificate ? '<div class="modal-row"><span>Certificate No.</span><strong>' + certificate + '</strong></div>' : '';
            
            document.getElementById('modalBody').innerHTML = progressHtml + '<div class="modal-section-label">SCHEDULE & DETAILS</div><div class="modal-row"><span>Start Date</span><strong>' + startDate + '</strong></div><div class="modal-row"><span>End Date</span><strong>' + endDate + '</strong></div><div class="modal-row"><span>Venue</span><strong>' + venue + '</strong></div>' + certRow;
            
            if (certificate) {
                document.getElementById('modalAction').innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Certificate';
            } else {
                document.getElementById('modalAction').textContent = 'Enroll Now';
            }
            
            document.getElementById('modalAction').style.display = 'flex';
            document.getElementById('trainingModal').classList.add('show');
        }
        
        function openAvailableTraining(title, type, slots, capacity, startDate, endDate, venue) {
            const color = typeColors[type] || '#15803d';
            document.getElementById('modalId').textContent = 'TRAINING PROGRAM';
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalSub').textContent = type + ' Training · ' + venue;
            document.getElementById('modalIcon').style.background = 'linear-gradient(135deg, ' + color + ', ' + color + '99)';
            document.getElementById('modalBadges').style.display = 'none';
            
            document.getElementById('modalBody').innerHTML = '<div class="slots-card"><div class="slots-icon" style="background:linear-gradient(135deg, #d9bb00, #fbbf24);"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div><div><p>Available Slots</p><span>' + slots + '<small> / ' + capacity + '</small></span></div></div><div class="modal-section-label">SCHEDULE & DETAILS</div><div class="modal-row"><span>Start Date</span><strong>' + startDate + '</strong></div><div class="modal-row"><span>End Date</span><strong>' + endDate + '</strong></div><div class="modal-row"><span>Venue</span><strong>' + venue + '</strong></div>';
            
            document.getElementById('modalFooter').style.display = 'flex';
            document.getElementById('trainingModal').classList.add('show');
        }
        
        function closeModal() {
            document.getElementById('trainingModal').classList.remove('show');
            document.getElementById('modalBadges').style.display = 'flex';
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</body>
</html>