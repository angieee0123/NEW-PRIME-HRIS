@extends('layouts.app')

@section('title', 'Payslip | PRIME HRIS - Permanent Employee')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<style>
.latest-summary { background: linear-gradient(135deg, #15803d 0%, #166534 100%); border-radius: 14px; padding: 24px 28px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; }
.latest-summary h2 { font-size: 10.5px; font-weight: 700; color: rgba(255,255,255,0.4); letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 6px; }
.latest-summary .net-value { font-size: 32px; font-weight: 800; color: #d9bb00; margin-bottom: 4px; }
.latest-summary .net-label { font-size: 12.5px; color: rgba(255,255,255,0.45); }
.summary-items { display: flex; gap: 24px; flex-wrap: wrap; }
.summary-item { text-align: center; }
.summary-item label { font-size: 11px; color: rgba(255,255,255,0.4); font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 4px; display: block; }
.summary-item span { font-size: 16px; font-weight: 700; color: #fff; }
.btn-view-summary { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff; padding: 10px 20px; border-radius: 9px; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; }
.btn-view-summary:hover { background: rgba(255,255,255,0.18); }
.pay-cell { font-weight: 600; }
.deduction { color: #dc2626; font-weight: 600; }
.emp-info-strip { display: flex; align-items: center; gap: 14px; background: #f7f6ff; border-radius: 10px; padding: 12px 16px; margin: 16px 0; }
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
.disclaimer { font-size: 11px; color: #aaa8cc; text-align: center; margin-top: 14px; line-height: 1.6; }
</style>
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

    @include('permanent.permanent-sidebarnav')

    {{-- Main Content --}}
    <main class="main-content">

        {{-- Welcome Banner --}}
        <div class="welcome-banner" style="background: linear-gradient(135deg, #15803d 0%, #166534 100%);">
            <div class="banner-left">
                <div class="banner-icon">
                    <svg width="22" height="22" fill="none" stroke="#d9bb00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                </div>
                <div>
                    <h2>Ana R. Reyes</h2>
                    <p>{{ now()->format('l, F j, Y') }} &nbsp;·&nbsp; Nurse II · Municipal Health Office · PGS-0115</p>
                </div>
            </div>
            <div class="banner-right">
                <span class="banner-badge" style="background:#d9bb00;color:#0b044d">
                    <span class="banner-badge-dot" style="background:#0b044d"></span>
                    Jun 16–30, 2025 Payroll Active
                </span>
                <span class="banner-badge outline">Pay Date: Jun 30</span>
            </div>
        </div>

        {{-- Latest Payslip Summary --}}
        <div class="latest-summary">
            <div>
                <h2>Latest Payslip · Jun 16–30, 2025</h2>
                <div class="net-value">₱13,537.50</div>
                <p class="net-label">Net Pay · Pay Date: Jun 30, 2025</p>
            </div>
            <div class="summary-items">
                <div class="summary-item">
                    <label>Basic Pay</label>
                    <span>₱16,921.50</span>
                </div>
                <div class="summary-item">
                    <label>Deductions</label>
                    <span>₱3,384.00</span>
                </div>
                <div class="summary-item">
                    <label>Net Pay</label>
                    <span>₱13,537.50</span>
                </div>
            </div>
            <button class="btn-view-summary" onclick="openModal()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                View Payslip
            </button>
        </div>

        {{-- Payslip History Table --}}
        <div class="table-section">
            <div class="table-header">
                <div>
                    <p class="table-title">Payslip History</p>
                    <p class="table-sub">Ana R. Reyes · PGS-0115 · Showing 8 records</p>
                </div>
                <div class="table-actions">
                    <select class="filter-select">
                        <option>All Status</option>
                        <option>Processed</option>
                        <option>Pending</option>
                    </select>
                    <button class="btn-export">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Export All
                    </button>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="payroll-table">
                    <thead>
                        <tr>
                            <th>Pay Period</th>
                            <th>Basic Pay</th>
                            <th>Total Deductions</th>
                            <th>Net Pay</th>
                            <th>Pay Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $payslips = [
                            ['period'=>'Jun 16–30, 2025','basic'=>'₱16,921.50','deduct'=>'₱3,384.00','net'=>'₱13,537.50','date'=>'Jun 30, 2025','status'=>'pending','latest'=>true],
                            ['period'=>'Jun 1–15, 2025','basic'=>'₱16,921.50','deduct'=>'₱3,384.00','net'=>'₱13,537.50','date'=>'Jun 15, 2025','status'=>'processed','latest'=>false],
                            ['period'=>'May 16–31, 2025','basic'=>'₱16,921.50','deduct'=>'₱3,384.00','net'=>'₱13,537.50','date'=>'May 31, 2025','status'=>'processed','latest'=>false],
                            ['period'=>'May 1–15, 2025','basic'=>'₱16,921.50','deduct'=>'₱3,384.00','net'=>'₱13,537.50','date'=>'May 15, 2025','status'=>'processed','latest'=>false],
                            ['period'=>'Apr 16–30, 2025','basic'=>'₱16,921.50','deduct'=>'₱3,384.00','net'=>'₱13,537.50','date'=>'Apr 30, 2025','status'=>'processed','latest'=>false],
                            ['period'=>'Apr 1–15, 2025','basic'=>'₱16,921.50','deduct'=>'₱3,384.00','net'=>'₱13,537.50','date'=>'Apr 15, 2025','status'=>'processed','latest'=>false],
                            ['period'=>'Mar 16–31, 2025','basic'=>'₱16,921.50','deduct'=>'₱3,384.00','net'=>'₱13,537.50','date'=>'Mar 31, 2025','status'=>'processed','latest'=>false],
                            ['period'=>'Mar 1–15, 2025','basic'=>'₱16,921.50','deduct'=>'₱3,384.00','net'=>'₱13,537.50','date'=>'Mar 15, 2025','status'=>'processed','latest'=>false],
                        ];
                        @endphp
                        @foreach($payslips as $p)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px">
                                    <div style="width:8px;height:8px;border-radius:50%;background:{{ $p['latest'] ? '#d9bb00' : '#e4e3f0' }};flex-shrink:0"></div>
                                    <span style="font-weight:600;color:#0b044d;font-size:13px">{{ $p['period'] }}</span>
                                    @if($p['latest'])
                                        <span style="font-size:10px;font-weight:700;background:#fefce8;color:#a16207;padding:2px 8px;border-radius:20px;border:1px solid #fde68a">LATEST</span>
                                    @endif
                                </div>
                            </td>
                            <td class="pay-cell">{{ $p['basic'] }}</td>
                            <td class="deduction">− {{ $p['deduct'] }}</td>
                            <td class="net-pay">{{ $p['net'] }}</td>
                            <td style="font-size:12.5px;color:#6b6a8a">{{ $p['date'] }}</td>
                            <td>
                                @if($p['status']==='pending')
                                    <span class="badge-status pending">Pending</span>
                                @else
                                    <span class="badge-status processed">Processed</span>
                                @endif
                            </td>
                            <td><button class="btn-view" onclick="openModal()">View</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <span>Showing <strong>8</strong> of <strong>8</strong> payslips for <strong>Ana R. Reyes</strong></span>
                <div style="display:flex;align-items:center;gap:8px">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#9999bb" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <span style="font-size:11.5px;color:#9999bb">Only your payslips are visible. Data is confidential.</span>
                </div>
            </div>
        </div>

    </main>

</div>

{{-- Payslip Modal --}}
<div class="modal-overlay" id="payslipModal" style="display:none" onclick="closeModal('payslipModal')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-header">
            <div>
                <span class="modal-eyebrow">OFFICIAL PAYSLIP · JUN 16–30, 2025</span>
                <h3 class="modal-title">Ana R. Reyes</h3>
                <p class="modal-sub">Nurse II · Municipal Health Office</p>
            </div>
            <button class="modal-close" onclick="closeModal('payslipModal')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="emp-info-strip">
                <div class="emp-avatar" style="background:#8e1e18;width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:14px">AR</div>
                <div style="flex:1">
                    <p style="font-size:13px;font-weight:700;color:#0b044d;margin:0 0 2px">PGS-0115</p>
                    <span style="font-size:12px;color:#9999bb">Permanent · Hired Jan 15, 2018</span>
                </div>
                <span class="badge-status pending">Pending</span>
            </div>
            
            <div class="info-grid">
                <div>
                    <label>Pay Period</label>
                    <span>Jun 16–30, 2025</span>
                </div>
                <div>
                    <label>Pay Date</label>
                    <span>Jun 30, 2025</span>
                </div>
            </div>
            
            <span class="modal-section-label">EARNINGS</span>
            <div class="modal-row"><span>Basic Semi-Monthly Pay</span><strong>₱16,921.50</strong></div>
            
            <span class="modal-section-label" style="margin-top:16px">DEDUCTIONS</span>
            <div class="modal-row"><span>GSIS Premium</span><span class="modal-deduct">− ₱1,523.00</span></div>
            <div class="modal-row"><span>PhilHealth</span><span class="modal-deduct">− ₱425.00</span></div>
            <div class="modal-row"><span>Pag-IBIG</span><span class="modal-deduct">− ₱50.00</span></div>
            <div class="modal-row"><span>Withholding Tax</span><span class="modal-deduct">− ₱1,386.00</span></div>
            <div class="modal-row total"><span>Total Deductions</span><span class="modal-deduct">− ₱3,384.00</span></div>
            
            <div class="modal-net-row">
                <span>NET PAY</span>
                <strong>₱13,537.50</strong>
            </div>
            
            <p class="disclaimer">Municipal Government of Pagsanjan · Human Resource Management Office<br>This is a system-generated payslip. No signature required.</p>
        </div>
        <div class="modal-footer">
            <button class="modal-btn-ghost" onclick="closeModal('payslipModal')">Close</button>
            <button class="modal-btn-primary">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Download PDF
            </button>
        </div>
    </div>
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

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            const collapsed = sidebar.classList.toggle('collapsed');
            toggleBtn.textContent = collapsed ? '›' : '‹';
            if (logoText) logoText.style.display  = collapsed ? 'none' : '';
            if (navLabel) navLabel.style.display  = collapsed ? 'none' : '';
            if (userInfo) userInfo.style.display  = collapsed ? 'none' : '';
            if (sidebarFooter) sidebarFooter.classList.toggle('collapsed-footer', collapsed);
            document.querySelectorAll('.nav-label, .nav-active-bar').forEach(el => {
                el.style.display = collapsed ? 'none' : '';
            });
        });
    }

    if (mobileBtn) {
        mobileBtn.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('active');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        });
    }

    function openModal() {
        document.getElementById('payslipModal').style.display = 'flex';
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
@endsection
