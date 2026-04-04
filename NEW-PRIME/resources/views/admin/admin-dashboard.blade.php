@extends('layouts.app')

@section('title', 'Admin Dashboard · PRIME HRIS')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="app-layout">

    {{-- Mobile Menu Button --}}
    <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Toggle menu">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <line x1="3" y1="12" x2="21" y2="12"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>

    {{-- Mobile Overlay --}}
    <div class="mobile-overlay" id="mobile-overlay"></div>

    @include('admin.admin-sidebarnav')

    {{-- Main Content --}}
    <main class="main-content">

        @include('admin.admin-notification')

        {{-- Welcome Banner --}}
        <div class="welcome-banner">
            <div class="banner-left">
                <div class="banner-icon">
                    <svg width="22" height="22" fill="none" stroke="#d9bb00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <div>
                    <h2>Welcome back, Admin!</h2>
                    <p>{{ now()->format('l, F j, Y') }} &nbsp;·&nbsp; PRIME HRIS Admin Panel</p>
                </div>
            </div>
            <div class="banner-right">
                <span class="banner-badge">
                    <span class="banner-badge-dot"></span>
                    System Online
                </span>
                <span class="banner-badge outline">FY {{ now()->year }}</span>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="stats-grid stats-grid-4">

            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Total Employees</p>
                    <div class="stat-icon-wrap" style="background:#f0effe">
                        <svg width="17" height="17" fill="none" stroke="#0b044d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                </div>
                <p class="stat-value">248</p>
                <div class="stat-footer">
                    <span class="stat-dot" style="background:#22c55e"></span>
                    <p class="stat-sub">+4 new this month</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Present Today</p>
                    <div class="stat-icon-wrap" style="background:#e8f9ef">
                        <svg width="17" height="17" fill="none" stroke="#15803d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
                    </div>
                </div>
                <p class="stat-value">211</p>
                <div class="stat-footer">
                    <span class="stat-dot" style="background:#22c55e"></span>
                    <p class="stat-sub">85.1% attendance rate</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">On Leave</p>
                    <div class="stat-icon-wrap" style="background:#fefce8">
                        <svg width="17" height="17" fill="none" stroke="#a16207" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                </div>
                <p class="stat-value">22</p>
                <div class="stat-footer">
                    <span class="stat-dot" style="background:#f59e0b"></span>
                    <p class="stat-sub">8 pending approval</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <p class="stat-label">Monthly Payroll</p>
                    <div class="stat-icon-wrap" style="background:#fdf0ef">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="#8e1e18" stroke="none"><text x="3" y="19" font-size="17" font-weight="bold" font-family="Arial, sans-serif">₱</text></svg>
                    </div>
                </div>
                <p class="stat-value" style="font-size:20px">₱1.24M</p>
                <div class="stat-footer">
                    <span class="stat-dot" style="background:#0b044d"></span>
                    <p class="stat-sub">{{ now()->format('F Y') }} payroll</p>
                </div>
            </div>

        </div>

        {{-- Recent Employees Table --}}
        <div class="table-section">
            <div class="table-header">
                <div>
                    <p class="table-title">Employee Directory</p>
                    <p class="table-sub">All active government personnel</p>
                </div>
                <div class="table-actions">
                    <select class="filter-select">
                        <option>All Departments</option>
                        <option>Administration</option>
                        <option>Engineering</option>
                        <option>Health</option>
                        <option>Finance</option>
                        <option>HRMO</option>
                    </select>
                    <select class="filter-select">
                        <option>All Types</option>
                        <option>Permanent</option>
                        <option>Job Order</option>
                    </select>
                    <button class="btn-export">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Export
                    </button>
                    <button class="modal-btn-primary">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Add Employee
                    </button>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="payroll-table">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $employees = [
                            ['initials'=>'JD','color'=>'#0b044d','name'=>'Juan Dela Cruz','id'=>'EMP-001','position'=>'Administrative Officer II','dept'=>'Administration','type'=>'Permanent','status'=>'active'],
                            ['initials'=>'MR','color'=>'#8e1e18','name'=>'Maria Reyes','id'=>'EMP-002','position'=>'Nurse II','dept'=>'Health','type'=>'Permanent','status'=>'active'],
                            ['initials'=>'PS','color'=>'#15803d','name'=>'Pedro Santos','id'=>'EMP-003','position'=>'Engineer I','dept'=>'Engineering','type'=>'Permanent','status'=>'on-leave'],
                            ['initials'=>'AL','color'=>'#a16207','name'=>'Ana Lim','id'=>'EMP-004','position'=>'Bookkeeper','dept'=>'Finance','type'=>'Job Order','status'=>'active'],
                            ['initials'=>'RC','color'=>'#7c3aed','name'=>'Roberto Cruz','id'=>'EMP-005','position'=>'Driver','dept'=>'Administration','type'=>'Job Order','status'=>'active'],
                        ];
                        @endphp
                        @foreach($employees as $emp)
                        <tr>
                            <td>
                                <div class="emp-cell">
                                    <div class="emp-avatar" style="background:{{ $emp['color'] }}">{{ $emp['initials'] }}</div>
                                    <div>
                                        <p class="emp-name">{{ $emp['name'] }}</p>
                                        <p class="emp-id">{{ $emp['id'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="position-cell">{{ $emp['position'] }}</span></td>
                            <td><span class="dept-tag">{{ $emp['dept'] }}</span></td>
                            <td><span class="dept-tag" style="background:{{ $emp['type']==='Permanent' ? '#e8f9ef' : '#fefce8' }};color:{{ $emp['type']==='Permanent' ? '#15803d' : '#a16207' }};border-color:{{ $emp['type']==='Permanent' ? '#bbf7d0' : '#fde68a' }}">{{ $emp['type'] }}</span></td>
                            <td>
                                @if($emp['status']==='active')
                                    <span class="badge-status processed">Active</span>
                                @else
                                    <span class="badge-status pending">On Leave</span>
                                @endif
                            </td>
                            <td><button class="btn-view">View</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <span>Showing <strong>1–5</strong> of <strong>248</strong> employees</span>
                <div class="pagination">
                    <button class="page-btn">‹</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">›</button>
                </div>
            </div>
        </div>

        {{-- Bottom Row: Leave Requests + Quick Stats --}}
        <div class="bottom-row">

            {{-- Leave Requests --}}
            <div class="table-section mb-0">
                <div class="table-header">
                    <div>
                        <p class="table-title">Pending Leave Requests</p>
                        <p class="table-sub">Requires your approval</p>
                    </div>
                    <button class="btn-export">View All</button>
                </div>
                <div class="table-wrapper">
                    <table class="payroll-table">
                        <thead>
                            <tr><th>Employee</th><th>Type</th><th>Duration</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @php
                            $leaves = [
                                ['initials'=>'JD','color'=>'#0b044d','name'=>'Juan Dela Cruz','type'=>'Vacation Leave','days'=>'3 days'],
                                ['initials'=>'MR','color'=>'#8e1e18','name'=>'Maria Reyes','type'=>'Sick Leave','days'=>'2 days'],
                                ['initials'=>'AL','color'=>'#a16207','name'=>'Ana Lim','type'=>'Emergency Leave','days'=>'1 day'],
                            ];
                            @endphp
                            @foreach($leaves as $l)
                            <tr>
                                <td>
                                    <div class="emp-cell">
                                        <div class="emp-avatar" style="background:{{ $l['color'] }};width:30px;height:30px;font-size:10px">{{ $l['initials'] }}</div>
                                        <p class="emp-name" style="margin:0">{{ $l['name'] }}</p>
                                    </div>
                                </td>
                                <td><span class="dept-tag">{{ $l['type'] }}</span></td>
                                <td style="font-size:12.5px;color:#5a5888">{{ $l['days'] }}</td>
                                <td>
                                    <div style="display:flex;gap:6px">
                                        <button class="btn-view" style="color:#15803d;border-color:#bbf7d0">Approve</button>
                                        <button class="btn-view" style="color:#8e1e18;border-color:#f5d0ce">Deny</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Quick Overview --}}
            <div class="side-col">

                <div class="table-section mb-0">
                    <div class="table-header" style="padding:16px 20px">
                        <p class="table-title" style="font-size:13px">Department Breakdown</p>
                    </div>
                    @php
                    $depts = [
                        ['name'=>'Administration','count'=>62,'color'=>'#0b044d'],
                        ['name'=>'Engineering','count'=>38,'color'=>'#8e1e18'],
                        ['name'=>'Health','count'=>55,'color'=>'#15803d'],
                        ['name'=>'Finance','count'=>29,'color'=>'#a16207'],
                        ['name'=>'HRMO','count'=>14,'color'=>'#7c3aed'],
                    ];
                    $total = 248;
                    @endphp
                    <div style="padding:4px 20px 16px">
                        @foreach($depts as $d)
                        <div style="margin-bottom:10px">
                            <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:4px">
                                <span style="font-weight:600;color:#0b044d">{{ $d['name'] }}</span>
                                <span style="color:#9999bb">{{ $d['count'] }}</span>
                            </div>
                            <div style="height:6px;background:#f0effe;border-radius:99px;overflow:hidden">
                                <div style="height:100%;width:{{ round($d['count']/$total*100) }}%;background:{{ $d['color'] }};border-radius:99px"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="stat-card no-margin">
                    <p class="stat-label" style="margin-bottom:12px">Upcoming Events</p>
                    @php
                    $events = [
                        ['label'=>'Payroll Release','date'=>'Jun 15','color'=>'#0b044d'],
                        ['label'=>'CSC Training','date'=>'Jun 18','color'=>'#8e1e18'],
                        ['label'=>'Performance Review','date'=>'Jun 25','color'=>'#15803d'],
                    ];
                    @endphp
                    @foreach($events as $ev)
                    <div style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f7f6ff">
                        <div style="width:36px;height:36px;background:{{ $ev['color'] }};border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <svg width="14" height="14" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div style="flex:1">
                            <p style="font-size:12.5px;font-weight:600;color:#0b044d;margin:0 0 2px">{{ $ev['label'] }}</p>
                            <p style="font-size:11px;color:#9999bb;margin:0">{{ $ev['date'] }}, {{ now()->year }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>

    </main>

    @include('admin.admin-chatbot')

</div>

<script>
    const sidebar      = document.getElementById('sidebar');
    const toggleBtn    = document.getElementById('toggle-btn');
    const logoText     = document.getElementById('logo-text');
    const navLabel     = document.getElementById('nav-label');
    const userInfo     = document.getElementById('user-info');
    const sidebarFooter = document.getElementById('sidebar-footer');
    const mobileBtn    = document.getElementById('mobile-menu-btn');
    const overlay      = document.getElementById('mobile-overlay');

    toggleBtn.addEventListener('click', () => {
        const collapsed = sidebar.classList.toggle('collapsed');
        toggleBtn.textContent = collapsed ? '›' : '‹';
        logoText.style.display  = collapsed ? 'none' : '';
        navLabel.style.display  = collapsed ? 'none' : '';
        userInfo.style.display  = collapsed ? 'none' : '';
        sidebarFooter.classList.toggle('collapsed-footer', collapsed);
        document.querySelectorAll('.nav-label, .nav-active-bar').forEach(el => {
            el.style.display = collapsed ? 'none' : '';
        });
    });

    mobileBtn.addEventListener('click', () => {
        sidebar.classList.toggle('mobile-open');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('active');
    });
</script>
@endsection
