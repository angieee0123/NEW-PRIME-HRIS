<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip | PRIME HRIS - Job Order Employee</title>
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
        
        .latest-summary { background: #0b044d; border-radius: 14px; padding: 24px 28px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; }
        .latest-summary h2 { font-size: 10.5px; font-weight: 700; color: rgba(255,255,255,0.4); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 6px; }
        .latest-summary .net-value { font-size: 32px; font-weight: 800; color: #d9bb00; margin-bottom: 4px; }
        .latest-summary .net-label { font-size: 12.5px; color: rgba(255,255,255,0.45); }
        .summary-items { display: flex; gap: 24px; flex-wrap: wrap; }
        .summary-item { text-align: center; }
        .summary-item label { font-size: 11px; color: rgba(255,255,255,0.4); font-weight: 600; text-transform: uppercase; letter-spacing: 0.8; margin-bottom: 4px; display: block; }
        .summary-item span { font-size: 16px; font-weight: 700; color: #fff; }
        .btn-view-summary { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff; padding: 10px 20px; border-radius: 9px; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        .btn-view-summary:hover { background: rgba(255,255,255,0.18); }
        
        .salary-note { background: #f0fdf4; border: 1.5px solid #bbf7d0; border-radius: 10px; padding: 14px 18px; margin-bottom: 20px; }
        .salary-note p:first-child { font-size: 12.5px; color: #15803d; font-weight: 700; margin-bottom: 6px; }
        .salary-note p:last-child { font-size: 12px; color: #166534; line-height: 1.8; margin: 0; }
        
        .table-section { background: #fff; border-radius: 14px; border: 1.5px solid #e5e4f0; margin-bottom: 20px; overflow: hidden; }
        .table-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #e5e4f0; }
        .table-title { font-size: 14px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .table-sub { font-size: 12px; color: #9999bb; margin: 0; }
        .table-actions { display: flex; gap: 10px; }
        .filter-select { padding: 8px 12px; border-radius: 8px; border: 1.5px solid #e5e4f0; font-size: 12px; font-weight: 600; color: #6b6a8a; background: #fff; cursor: pointer; }
        .btn-export { padding: 8px 14px; border-radius: 8px; border: none; background: #15803d; font-size: 12px; font-weight: 600; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 6px; }
        .table-wrapper { overflow-x: auto; }
        .payroll-table { width: 100%; border-collapse: collapse; }
        .payroll-table th { text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 700; color: #9999bb; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e5e4f0; }
        .payroll-table td { padding: 14px 16px; font-size: 13px; color: #0b044d; border-bottom: 1px solid #f4f3ff; }
        .pay-cell { font-weight: 600; }
        .deduction { color: #dc2626; font-weight: 600; }
        .net-pay { font-weight: 700; color: #15803d; }
        .badge-status { font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 20px; display: inline-block; }
        .badge-status.processed { background: #e8f9ef; color: #15803d; border: 1px solid #bbf7d0; }
        .badge-status.pending { background: #fefce8; color: #a16207; border: 1px solid #fde68a; }
        .btn-view { padding: 7px 14px; border-radius: 8px; border: 1.5px solid #e5e4f0; background: #fff; font-size: 12px; font-weight: 600; color: #6b6a8a; cursor: pointer; }
        .btn-view:hover { border-color: #15803d; color: #15803d; }
        .table-footer { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-top: 1px solid #e5e4f0; background: #faf9ff; }
        .table-footer p { font-size: 12px; color: #6b6a8a; margin: 0; }
        
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(11, 4, 77, 0.6); display: flex; align-items: center; justify-content: center; z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.2s; }
        .modal-overlay.show { opacity: 1; visibility: visible; }
        .modal-box { background: #fff; border-radius: 16px; width: 90%; max-width: 520px; max-height: 90vh; overflow: hidden; transform: scale(0.95); transition: transform 0.2s; }
        .modal-overlay.show .modal-box { transform: scale(1); }
        .modal-header { display: flex; justify-content: space-between; align-items: flex-start; padding: 20px 24px; border-bottom: 1px solid #e5e4f0; }
        .modal-eyebrow { font-size: 10px; font-weight: 700; color: #9999bb; letter-spacing: 1px; text-transform: uppercase; }
        .modal-title { font-size: 18px; font-weight: 700; color: #0b044d; margin: 4px 0; }
        .modal-sub { font-size: 12px; color: #6b6a8a; margin: 0; }
        .modal-close { background: none; border: none; cursor: pointer; color: #9999bb; padding: 4px; }
        .modal-body { padding: 0 24px 20px; }
        .emp-info-strip { display: flex; align-items: center; gap: 14px; background: #f7f6ff; border-radius: 10px; padding: 12px 16px; margin: 16px 0; }
        .emp-avatar { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 14px; }
        .emp-info-strip p { font-size: 13px; font-weight: 700; color: #0b044d; margin: 0 0 2px; }
        .emp-info-strip span { font-size: 12px; color: #9999bb; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 18px; }
        .info-grid > div { background: #f7f6ff; border-radius: 9px; padding: 10px 14px; }
        .info-grid label { font-size: 10.5px; font-weight: 700; color: #aaa8cc; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; display: block; }
        .info-grid span { font-size: 13.5px; font-weight: 700; color: #0b044d; }
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
        .disclaimer { font-size: 11px; color: #aaa8cc; text-align: center; margin-top: 14px; line-height: 1.6; }
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
                <a href="/joborder/payslip" class="nav-item active"><span class="nav-active-bar"></span>Payslip</a>
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
                        <h2>Juan D. Cruz</h2>
                        <p>Utility Worker I · General Services Office · JO-0042</p>
                    </div>
                </div>
                <div class="banner-right">
                    <div class="banner-badge"><span class="banner-badge-dot"></span>Jun 16–30, 2025 Payroll Active</div>
                    <div class="banner-badge outline">Pay Date: Jun 30</div>
                </div>
            </div>
            
            <div class="latest-summary">
                <div>
                    <h2>Latest Payslip · Jun 16–30, 2025</h2>
                    <div class="net-value">₱10,235.45</div>
                    <p class="net-label">Net Pay · Pay Date: Jun 30, 2025</p>
                </div>
                <div class="summary-items">
                    <div class="summary-item">
                        <label>Daily Rate</label>
                        <span>₱1,136.36</span>
                    </div>
                    <div class="summary-item">
                        <label>Gross Pay</label>
                        <span>₱11,363.60</span>
                    </div>
                    <div class="summary-item">
                        <label>Deductions</label>
                        <span style="color:#f87171">₱1,128.15</span>
                    </div>
                    <div class="summary-item">
                        <label>Net Pay</label>
                        <span style="color:#d9bb00">₱10,235.45</span>
                    </div>
                </div>
                <button class="btn-view-summary" onclick="openModal(0)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    View Payslip
                </button>
            </div>
            
            <div class="salary-note">
                <p>&#x2139;&#xFE0F; Job Order Salary Computation</p>
                <p><strong>Gross Pay</strong> = Daily Rate (₱1,136.36) &times; Days Worked<br><strong>Late Deduction</strong> = Daily Rate &divide; 8 &divide; 60 &times; Total Late Minutes<br>No GSIS. Deductions: PhilHealth, Pag-IBIG, Withholding Tax &amp; Late.</p>
            </div>
            
            <section class="table-section">
                <div class="table-header">
                    <div>
                        <h3 class="table-title">Payslip History</h3>
                        <p class="table-sub">Juan D. Cruz · JO-0042 · Showing 6 records</p>
                    </div>
                    <div class="table-actions">
                        <select class="filter-select">
                            <option>All Status</option>
                            <option>Processed</option>
                            <option>Pending</option>
                        </select>
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
                                <th>Pay Period</th>
                                <th>Days Worked</th>
                                <th>Gross Pay</th>
                                <th>Late Deduction</th>
                                <th>Total Deductions</th>
                                <th>Net Pay</th>
                                <th>Pay Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div style="width:8px;height:8px;border-radius:50%;background:#d9bb00;flex-shrink:0;"></div>
                                        <span style="font-weight:600;color:#0b044d;font-size:13px;">Jun 16–30, 2025</span>
                                        <span style="font-size:10px;font-weight:700;background:#fefce8;color:#a16207;padding:2px 8px;border-radius:20px;border:1px solid #fde68a;">LATEST</span>
                                    </div>
                                </td>
                                <td style="font-weight:600;">10 days</td>
                                <td class="pay-cell">₱11,363.64</td>
                                <td style="color:#a16207;font-weight:600;">− ₱23.15</td>
                                <td class="deduction">− ₱1,128.18</td>
                                <td class="net-pay">₱10,235.45</td>
                                <td style="font-size:12.5px;color:#6b6a8a;">Jun 30, 2025</td>
                                <td><span class="badge-status pending">Pending</span></td>
                                <td><button class="btn-view" onclick="openModal(0)">View</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div style="width:8px;height:8px;border-radius:50%;background:#e4e3f0;flex-shrink:0;"></div>
                                        <span style="font-weight:600;color:#0b044d;font-size:13px;">Jun 1–15, 2025</span>
                                    </div>
                                </td>
                                <td style="font-weight:600;">11 days</td>
                                <td class="pay-cell">₱12,500.00</td>
                                <td style="color:#a16207;font-weight:600;">− ₱46.30</td>
                                <td class="deduction">− ₱1,296.30</td>
                                <td class="net-pay">₱11,203.70</td>
                                <td style="font-size:12.5px;color:#6b6a8a;">Jun 15, 2025</td>
                                <td><span class="badge-status processed">Processed</span></td>
                                <td><button class="btn-view" onclick="openModal(1)">View</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div style="width:8px;height:8px;border-radius:50%;background:#e4e3f0;flex-shrink:0;"></div>
                                        <span style="font-weight:600;color:#0b044d;font-size:13px;">May 16–31, 2025</span>
                                    </div>
                                </td>
                                <td style="font-weight:600;">11 days</td>
                                <td class="pay-cell">₱12,500.00</td>
                                <td style="color:#c0bedd;">—</td>
                                <td class="deduction">− ₱1,250.00</td>
                                <td class="net-pay">₱11,250.00</td>
                                <td style="font-size:12.5px;color:#6b6a8a;">May 31, 2025</td>
                                <td><span class="badge-status processed">Processed</span></td>
                                <td><button class="btn-view" onclick="openModal(2)">View</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div style="width:8px;height:8px;border-radius:50%;background:#e4e3f0;flex-shrink:0;"></div>
                                        <span style="font-weight:600;color:#0b044d;font-size:13px;">May 1–15, 2025</span>
                                    </div>
                                </td>
                                <td style="font-weight:600;">10 days</td>
                                <td class="pay-cell">₱11,363.64</td>
                                <td style="color:#a16207;font-weight:600;">− ₱34.72</td>
                                <td class="deduction">− ₱1,284.72</td>
                                <td class="net-pay">₱10,078.91</td>
                                <td style="font-size:12.5px;color:#6b6a8a;">May 15, 2025</td>
                                <td><span class="badge-status processed">Processed</span></td>
                                <td><button class="btn-view" onclick="openModal(3)">View</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div style="width:8px;height:8px;border-radius:50%;background:#e4e3f0;flex-shrink:0;"></div>
                                        <span style="font-weight:600;color:#0b044d;font-size:13px;">Apr 16–30, 2025</span>
                                    </div>
                                </td>
                                <td style="font-weight:600;">11 days</td>
                                <td class="pay-cell">₱12,500.00</td>
                                <td style="color:#c0bedd;">—</td>
                                <td class="deduction">− ₱1,250.00</td>
                                <td class="net-pay">₱11,250.00</td>
                                <td style="font-size:12.5px;color:#6b6a8a;">Apr 30, 2025</td>
                                <td><span class="badge-status processed">Processed</span></td>
                                <td><button class="btn-view" onclick="openModal(4)">View</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div style="width:8px;height:8px;border-radius:50%;background:#e4e3f0;flex-shrink:0;"></div>
                                        <span style="font-weight:600;color:#0b044d;font-size:13px;">Apr 1–15, 2025</span>
                                    </div>
                                </td>
                                <td style="font-weight:600;">11 days</td>
                                <td class="pay-cell">₱12,500.00</td>
                                <td style="color:#c0bedd;">—</td>
                                <td class="deduction">− ₱1,250.00</td>
                                <td class="net-pay">₱11,250.00</td>
                                <td style="font-size:12.5px;color:#6b6a8a;">Apr 15, 2025</td>
                                <td><span class="badge-status processed">Processed</span></td>
                                <td><button class="btn-view" onclick="openModal(5)">View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="table-footer">
                    <p>Showing <strong>6</strong> of <strong>6</strong> payslips for <strong>Juan D. Cruz</strong></p>
                    <div style="display:flex;align-items:center;gap:8px;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9999bb" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <p style="font-size:11.5px;color:#9999bb;">Only your payslips are visible. Data is confidential.</p>
                    </div>
                </div>
            </section>
        </main>
    </div>
    
    <div class="modal-overlay" id="payslipModal">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <span class="modal-eyebrow" id="modalPeriod">OFFICIAL PAYSLIP</span>
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
                <div class="emp-info-strip">
                    <div class="emp-avatar" style="background:#1a6e3c;">JD</div>
                    <div style="flex:1;">
                        <p>JO-0042</p>
                        <span id="modalContract">Job Order · Contract ends Dec 31, 2025</span>
                    </div>
                    <span class="badge-status" id="modalStatus">Pending</span>
                </div>
                
                <div class="info-grid">
                    <div>
                        <label>Pay Period</label>
                        <span id="modalPayPeriod">Jun 16–30, 2025</span>
                    </div>
                    <div>
                        <label>Pay Date</label>
                        <span id="modalPayDate">Jun 30, 2025</span>
                    </div>
                </div>
                
                <span class="modal-section-label">EARNINGS</span>
                <div class="modal-row">
                    <span>Daily Rate <span style="font-size:11px;color:#9999bb">(Monthly ÷ 22 days)</span></span>
                    <strong>₱1,136.36</strong>
                </div>
                <div class="modal-row">
                    <span>Days Worked</span>
                    <strong id="modalDaysWorked">10 days</strong>
                </div>
                <div class="modal-row" style="border-top:1px solid #eceaf8;">
                    <span>Gross Pay <span style="font-size:11px;color:#9999bb" id="modalGrossCalc">(10 × ₱1,136.36)</span></span>
                    <strong id="modalGrossPay">₱11,363.60</strong>
                </div>
                
                <span class="modal-section-label" style="margin-top:16px;">DEDUCTIONS</span>
                <div class="modal-row" id="lateRow">
                    <span>Late Deduction <span style="font-size:11px;color:#9999bb;display:block;">₱1,136.36 ÷ 8 ÷ 60 × 10 min</span></span>
                    <span class="modal-deduct" id="lateAmount">− ₱23.15</span>
                </div>
                <div class="modal-row"><span>PhilHealth</span><span class="modal-deduct">− ₱375.00</span></div>
                <div class="modal-row"><span>Pag-IBIG</span><span class="modal-deduct">− ₱100.00</span></div>
                <div class="modal-row"><span>Withholding Tax</span><span class="modal-deduct">− ₱775.00</span></div>
                <div class="modal-row total">
                    <span>Total Deductions</span>
                    <span class="modal-deduct" id="modalTotalDed">− ₱1,273.15</span>
                </div>
                
                <div class="modal-net-row">
                    <span>NET PAY</span>
                    <strong id="modalNetPay">₱10,090.45</strong>
                </div>
                
                <p class="disclaimer">Municipal Government of Pagsanjan · Human Resource Management Office<br>This is a system-generated payslip. No signature required.</p>
            </div>
            
            <div class="modal-footer">
                <button class="modal-btn-ghost" onclick="closeModal()">Close</button>
                <button class="modal-btn-primary">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    Download PDF
                </button>
            </div>
        </div>
    </div>
    
    <script>
        const DAILY_RATE = 1136.36;
        const PER_MINUTE = DAILY_RATE / 8 / 60;
        
        const payslips = [
            { period: 'Jun 16–30, 2025', payDate: 'Jun 30, 2025', status: 'Pending', daysWorked: 10, lateMinutes: 10, philhealth: 375, pagibig: 100, tax: 775 },
            { period: 'Jun 1–15, 2025', payDate: 'Jun 15, 2025', status: 'Processed', daysWorked: 11, lateMinutes: 20, philhealth: 375, pagibig: 100, tax: 775 },
            { period: 'May 16–31, 2025', payDate: 'May 31, 2025', status: 'Processed', daysWorked: 11, lateMinutes: 0, philhealth: 375, pagibig: 100, tax: 775 },
            { period: 'May 1–15, 2025', payDate: 'May 15, 2025', status: 'Processed', daysWorked: 10, lateMinutes: 15, philhealth: 375, pagibig: 100, tax: 775 },
            { period: 'Apr 16–30, 2025', payDate: 'Apr 30, 2025', status: 'Processed', daysWorked: 11, lateMinutes: 0, philhealth: 375, pagibig: 100, tax: 775 },
            { period: 'Apr 1–15, 2025', payDate: 'Apr 15, 2025', status: 'Processed', daysWorked: 11, lateMinutes: 0, philhealth: 375, pagibig: 100, tax: 775 },
        ];
        
        function grossPay(slip) { return DAILY_RATE * slip.daysWorked; }
        function lateDeduct(slip) { return PER_MINUTE * slip.lateMinutes; }
        function totalDed(slip) { return slip.philhealth + slip.pagibig + slip.tax + lateDeduct(slip); }
        function netPay(slip) { return grossPay(slip) - totalDed(slip); }
        
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
        
        function openModal(index) {
            const slip = payslips[index];
            document.getElementById('modalPeriod').textContent = 'OFFICIAL PAYSLIP · ' + slip.period.toUpperCase();
            document.getElementById('modalPayPeriod').textContent = slip.period;
            document.getElementById('modalPayDate').textContent = slip.payDate;
            document.getElementById('modalStatus').textContent = slip.status;
            document.getElementById('modalStatus').className = 'badge-status ' + (slip.status === 'Processed' ? 'processed' : 'pending');
            document.getElementById('modalDaysWorked').textContent = slip.daysWorked + ' days';
            document.getElementById('modalGrossCalc').textContent = '(' + slip.daysWorked + ' × ₱1,136.36)';
            document.getElementById('modalGrossPay').textContent = '₱' + grossPay(slip).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            
            if (slip.lateMinutes > 0) {
                document.getElementById('lateRow').style.display = 'flex';
                document.getElementById('lateAmount').textContent = '− ₱' + lateDeduct(slip).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            } else {
                document.getElementById('lateRow').style.display = 'none';
            }
            
            document.getElementById('modalTotalDed').textContent = '− ₱' + totalDed(slip).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            document.getElementById('modalNetPay').textContent = '₱' + netPay(slip).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            
            document.getElementById('payslipModal').classList.add('show');
        }
        
        function closeModal() {
            document.getElementById('payslipModal').classList.remove('show');
        }
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</body>
</html>