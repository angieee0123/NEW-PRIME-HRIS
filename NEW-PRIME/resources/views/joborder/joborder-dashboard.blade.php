<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | PRIME HRIS - Job Order Employee</title>
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
        .banner-left h2 { font-size: 17px; font-weight: 700; color: #fff; margin: 0 0 4px; }
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
        
        .bottom-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        
        .table-section { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; margin-bottom: 0; overflow: hidden; }
        .table-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #e5e4f0; }
        .table-title { font-size: 14px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .table-sub { font-size: 12px; color: #9999bb; margin: 0; }
        .table-wrapper { overflow-x: auto; }
        .payroll-table { width: 100%; border-collapse: collapse; }
        .payroll-table th { text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e5e4f0; }
        .payroll-table td { padding: 14px 16px; font-size: 13px; color: #0b044d; border-bottom: 1px solid #f4f3ff; }
        .net-pay { font-weight: 700; color: #15803d; }
        .badge-status { font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 20px; display: inline-block; }
        .badge-status.processed { background: #e8f9ef; color: #15803d; border: 1px solid #bbf7d0; }
        .badge-status.pending { background: #fefce8; color: #a16207; border: 1px solid #fde68a; }
        .btn-view { padding: 7px 14px; border-radius: 8px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 12px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .btn-view:hover { border-color: #15803d; color: #15803d; }
        
        .notif-item { display: flex; gap: 12px; padding: 12px 16px; border-bottom: 1px solid #f4f3ff; }
        .notif-dot { width: 8px; height: 8px; border-radius: 50%; margin-top: 5px; flex-shrink: 0; }
        .notif-content { flex: 1; }
        .notif-title { font-size: 13px; font-weight: 600; color: #0b044d; margin: 0 0 2px; }
        .notif-desc { font-size: 12px; color: #6b6a8a; margin: 0 0 3px; }
        .notif-time { font-size: 11px; color: #aaa8cc; }
        
        .quick-actions { padding: 16px 20px 8px; }
        .quick-actions h3 { font-size: 14px; font-weight: 700; color: #0b044d; margin: 0 0 4px; }
        .quick-actions p { font-size: 12px; color: #9999bb; margin: 0 0 14px; }
        .quick-actions-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .quick-action-btn { display: flex; align-items: center; gap: 9px; padding: 10px 14px; border: 1.5px solid #eceaf8; border-radius: 10px; background: #fafafe; cursor: pointer; font-size: 13px; font-weight: 600; color: #0b044d; font-family: 'Poppins', sans-serif; transition: border-color 0.18s; }
        .quick-action-btn:hover { border-color: #1a6e3c; }
        
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
        .modal-emp-id { font-size: 13px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .modal-section-label { font-size: 10.5px; font-weight: 700; color: #aaa8cc; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block; }
        .modal-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f4f3ff; font-size: 13px; }
        .modal-row span:first-child { color: #6b6a8a; }
        .modal-row strong { color: #0b044d; }
        .modal-row.total { border-bottom: 2px solid #e5e4f0; padding-top: 12px; margin-bottom: 8px; }
        .modal-deduct { color: #dc2626; }
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
                <a href="/joborder/dashboard" class="nav-item active"><span class="nav-active-bar"></span>Dashboard</a>
                <a href="/joborder/payslip" class="nav-item">Payslip</a>
                <a href="/joborder/attendance" class="nav-item">Attendance</a>
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
                        <h2>Welcome back, Juan!</h2>
                        <p>Utility Worker I · General Services Office · JO-0042</p>
                    </div>
                </div>
                <div class="banner-right">
                    <div class="banner-badge"><span class="banner-badge-dot"></span>June 2025 Payroll Active</div>
                    <div class="banner-badge outline">Contract Until: Dec 31, 2025</div>
                </div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Basic Pay</p>
                        <div class="stat-icon-wrap" style="background:#0b044d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
                    </div>
                    <h2 class="stat-value">₱12,500.00</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#0b044d"></span>
                        <p class="stat-sub">Jun 16–30, 2025</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Net Pay</p>
                        <div class="stat-icon-wrap" style="background:#15803d15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
                    </div>
                    <h2 class="stat-value">₱11,250.00</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#15803d"></span>
                        <p class="stat-sub">After deductions</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Contract End</p>
                        <div class="stat-icon-wrap" style="background:#1a6e3c15"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1a6e3c" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
                    </div>
                    <h2 class="stat-value">Dec 31</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#1a6e3c"></span>
                        <p class="stat-sub">Dec 31, 2025</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <p class="stat-label">Attendance</p>
                        <div class="stat-icon-wrap" style="background:#8e1e1815"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8e1e18" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                    </div>
                    <h2 class="stat-value">90%</h2>
                    <div class="stat-footer">
                        <span class="stat-dot" style="background:#8e1e18"></span>
                        <p class="stat-sub">19 days present</p>
                    </div>
                </div>
            </div>
            
            <div class="bottom-grid">
                <section class="table-section">
                    <div class="table-header">
                        <div>
                            <h3 class="table-title">My Payslips</h3>
                            <p class="table-sub">Recent payroll history</p>
                        </div>
                        <button class="btn-view" onclick="openPayslipModal()">View Latest</button>
                    </div>
                    <div class="table-wrapper">
                        <table class="payroll-table">
                            <thead>
                                <tr>
                                    <th>Period</th>
                                    <th>Net Pay</th>
                                    <th>Pay Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 16–30, 2025</td>
                                    <td class="net-pay">₱11,250.00</td>
                                    <td style="font-size:12.5px;color:#6b6a8a;">Jun 30, 2025</td>
                                    <td><span class="badge-status pending">Pending</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600;color:#0b044d;font-size:13px;">Jun 1–15, 2025</td>
                                    <td class="net-pay">₱11,250.00</td>
                                    <td style="font-size:12.5px;color:#6b6a8a;">Jun 15, 2025</td>
                                    <td><span class="badge-status processed">Processed</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600;color:#0b044d;font-size:13px;">May 16–31, 2025</td>
                                    <td class="net-pay">₱11,250.00</td>
                                    <td style="font-size:12.5px;color:#6b6a8a;">May 31, 2025</td>
                                    <td><span class="badge-status processed">Processed</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
                
                <div style="display:flex;flex-direction:column;gap:20px;">
                    <section class="table-section">
                        <div class="table-header">
                            <div>
                                <h3 class="table-title">Notifications</h3>
                                <p class="table-sub">2 unread</p>
                            </div>
                            <button class="btn-view">Mark all read</button>
                        </div>
                        <div style="padding:0 4px 8px">
                            <div class="notif-item">
                                <div style="width:8px;height:8px;border-radius:50%;margin-top:5px;flex-shrink:0;background:#d9bb00;"></div>
                                <div class="notif-content">
                                    <p class="notif-title">DTR Reminder</p>
                                    <p class="notif-desc">Please submit your daily time record for June 30, 2025</p>
                                    <span class="notif-time">2 hours ago</span>
                                </div>
                            </div>
                            <div class="notif-item">
                                <div style="width:8px;height:8px;border-radius:50%;margin-top:5px;flex-shrink:0;background:#1a6e3c;"></div>
                                <div class="notif-content">
                                    <p class="notif-title">Payslip Available</p>
                                    <p class="notif-desc">Your payslip for Jun 1–15, 2025 is now available</p>
                                    <span class="notif-time">1 day ago</span>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <section class="table-section">
                        <div class="quick-actions">
                            <h3>Quick Actions</h3>
                            <p>Common tasks</p>
                            <div class="quick-actions-grid">
                                <button class="quick-action-btn" onclick="openPayslipModal()">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                    View Payslip
                                </button>
                                <button class="quick-action-btn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    View Attendance
                                </button>
                                <button class="quick-action-btn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    My Profile
                                </button>
                                <button class="quick-action-btn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0b044d" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                    Security
                                </button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
    
    <div class="modal-overlay" id="payslipModal">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <span class="modal-eyebrow">PAYSLIP · JUN 16–30, 2025</span>
                    <h3 class="modal-title">Juan D. Cruz</h3>
                    <p class="modal-sub">Utility Worker I · General Services Office</p>
                </div>
                <button class="modal-close" onclick="closeModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-emp-row">
                    <div class="user-avatar" style="width:44px;height:44px;">JD</div>
                    <div>
                        <p class="modal-emp-id">JO-0042</p>
                        <span class="badge-status pending">Pending</span>
                    </div>
                </div>
                <span class="modal-section-label">EARNINGS</span>
                <div class="modal-row"><span>Basic Semi-Monthly Pay</span><strong>₱12,500.00</strong></div>
                <span class="modal-section-label" style="margin-top:16px;">DEDUCTIONS</span>
                <div class="modal-row"><span>PhilHealth</span><span class="modal-deduct">₱375</span></div>
                <div class="modal-row"><span>Pag-IBIG</span><span class="modal-deduct">₱100</span></div>
                <div class="modal-row"><span>Withholding Tax</span><span class="modal-deduct">₱775</span></div>
                <div class="modal-row total"><span>Total Deductions</span><span class="modal-deduct">₱1,250</span></div>
                <div class="modal-net-row"><span>NET PAY</span><strong>₱11,250.00</strong></div>
            </div>
            <div class="modal-footer">
                <button class="modal-btn-ghost" onclick="closeModal()">Close</button>
                <button class="modal-btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Download Payslip
                </button>
            </div>
        </div>
    </div>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
        
        function openPayslipModal() {
            document.getElementById('payslipModal').classList.add('show');
        }
        
        function closeModal() {
            document.getElementById('payslipModal').classList.remove('show');
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
        
        document.getElementById('payslipModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
</body>
</html>