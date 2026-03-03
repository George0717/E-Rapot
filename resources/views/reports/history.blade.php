@extends('layouts.app')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --danger-gradient:  linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --info-gradient:    linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        --dark-gradient:    linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.04);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.08);
        --shadow-lg: 0 8px 32px rgba(0,0,0,0.12);
        --shadow-xl: 0 16px 48px rgba(0,0,0,0.16);
        --transition-base: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-fast: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .history-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding: 48px 0 100px;
        min-height: 100vh;
        background: linear-gradient(to bottom, #f8fafc 0%, #ffffff 100%);
    }

    .history-page-header {
        margin-bottom: 40px;
        position: relative;
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 32px;
        border: 1px solid rgba(255,255,255,0.8);
        box-shadow: var(--shadow-lg);
        animation: slideDown 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideDown {
        from { opacity:0; transform:translateY(-20px); }
        to   { opacity:1; transform:translateY(0); }
    }

    .history-page-header::before {
        content:''; position:absolute; top:0; left:0; right:0; height:4px;
        background:var(--primary-gradient); border-radius:20px 20px 0 0;
    }

    .history-page-header .tag {
        display:inline-flex; align-items:center; gap:6px;
        font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase;
        color:#6366f1; background:linear-gradient(135deg,#eef2ff 0%,#e0e7ff 100%);
        border-radius:30px; padding:6px 16px; margin-bottom:14px;
        border:1px solid rgba(99,102,241,0.2);
    }

    .history-page-header .tag::before { content:'◆'; font-size:8px; animation:pulse 2s ease-in-out infinite; }

    @keyframes pulse { 0%,100%{ opacity:1; } 50%{ opacity:0.4; } }

    .history-page-header h2 {
        font-size:32px; font-weight:800;
        background:linear-gradient(135deg,#1e293b 0%,#475569 100%);
        -webkit-background-clip:text; -webkit-text-fill-color:transparent;
        background-clip:text; margin:0 0 8px; line-height:1.2;
    }

    .history-page-header p { color:#64748b; font-size:15px; margin:0; font-weight:500; }

    .search-container { position:relative; margin-bottom:24px; animation:fadeIn 0.8s ease-out 0.3s both; }

    @keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

    .search-box {
        width:100%; padding:14px 50px 14px 48px; border-radius:16px;
        border:2px solid #e5e7eb; background:#ffffff; font-size:14px;
        font-family:'Plus Jakarta Sans', sans-serif; transition:var(--transition-base);
        box-shadow:var(--shadow-sm); box-sizing:border-box; outline:none; color:#111827;
    }

    .search-box:focus { border-color:#6366f1; box-shadow:0 0 0 4px rgba(99,102,241,0.1); }

    .search-icon {
        position:absolute; left:16px; top:50%; transform:translateY(-50%);
        color:#9ca3af; pointer-events:none; display:flex; align-items:center;
    }

    .search-clear {
        position:absolute; right:14px; top:50%; transform:translateY(-50%);
        background:#f3f4f6; border:none; width:26px; height:26px; border-radius:50%;
        color:#6b7280; cursor:pointer; font-size:14px; line-height:1;
        display:flex; align-items:center; justify-content:center;
        opacity:0; pointer-events:none; transition:var(--transition-fast);
    }

    .search-clear.show { opacity:1; pointer-events:auto; }
    .search-clear:hover { background:#e5e7eb; color:#374151; }

    .filter-bar { display:flex; gap:10px; margin-bottom:24px; flex-wrap:wrap; animation:fadeIn 0.8s ease-out 0.2s both; }

    .filter-btn, .filter-btn:focus, .filter-btn:active {
        display:inline-flex !important; align-items:center !important; gap:6px !important;
        padding:10px 20px !important; border-radius:12px !important; border:2px solid #e5e7eb !important;
        background:#ffffff !important; color:#6b7280 !important; font-size:13px !important;
        font-weight:600 !important; font-family:'Plus Jakarta Sans', sans-serif !important;
        cursor:pointer !important; transition:var(--transition-base) !important;
        white-space:nowrap !important; position:relative !important; overflow:hidden !important;
        box-shadow:none !important; outline:none !important; text-decoration:none !important;
    }

    .filter-btn:hover {
        border-color:#c7d2fe !important; color:#4f46e5 !important;
        transform:translateY(-2px) !important; box-shadow:var(--shadow-md) !important; background:#f5f3ff !important;
    }

    .filter-btn.active, .filter-btn.active:focus, .filter-btn.active:hover {
        background:var(--primary-gradient) !important; border-color:transparent !important;
        color:#ffffff !important; box-shadow:0 4px 16px rgba(99,102,241,0.35) !important; transform:translateY(-1px) !important;
    }

    .filter-btn .count-badge {
        display:inline-flex; align-items:center; justify-content:center;
        background:rgba(0,0,0,0.1); color:inherit; padding:1px 8px;
        border-radius:20px; font-size:11px; font-weight:700; min-width:20px;
    }

    .filter-btn.active .count-badge { background:rgba(255,255,255,0.25); color:#fff; }

    #skeletonLoader { display:none; }
    #skeletonLoader.active { display:block; }

    .skeleton-card {
        border-radius:14px; margin-bottom:10px; height:80px; animation:shimmer 1.5s infinite;
        background:linear-gradient(90deg,#f3f4f6 0%,#e5e7eb 50%,#f3f4f6 100%); background-size:200% 100%;
    }

    @keyframes shimmer { 0%{ background-position:-200% 0; } 100%{ background-position:200% 0; } }

    .h-card {
        background:#ffffff !important; border:1px solid #e5e7eb !important;
        border-radius:16px !important; margin-bottom:12px !important;
        transition:var(--transition-base) !important; position:relative !important;
        overflow:hidden !important; box-shadow:var(--shadow-sm) !important;
        animation:slideUp 0.5s ease-out both;
        animation-delay:calc(var(--card-index,0) * 0.05s);
    }

    @keyframes slideUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }

    .h-card:hover {
        border-color:transparent !important; box-shadow:var(--shadow-lg) !important;
        transform:translateY(-4px) scale(1.01) !important;
    }

    .h-card::before {
        content:''; position:absolute; left:0; top:0; bottom:0; width:5px;
        border-radius:16px 0 0 16px; opacity:0; transition:var(--transition-base);
    }

    .h-card:hover::before { opacity:1; }
    .h-card.ac-success::before  { background:var(--success-gradient); }
    .h-card.ac-primary::before  { background:var(--primary-gradient); }
    .h-card.ac-danger::before   { background:var(--danger-gradient); }
    .h-card.ac-warning::before  { background:var(--warning-gradient); }
    .h-card.ac-info::before     { background:var(--info-gradient); }
    .h-card.ac-dark::before     { background:var(--dark-gradient); }
    .h-card.ac-secondary::before{ background:linear-gradient(135deg,#94a3b8 0%,#64748b 100%); }

    .h-card-body { display:flex; align-items:center; justify-content:space-between; padding:20px 24px; gap:16px; }

    .h-icon {
        width:48px; height:48px; border-radius:14px; display:flex; align-items:center;
        justify-content:center; flex-shrink:0; font-size:18px; font-weight:800; transition:var(--transition-base);
    }

    .h-card:hover .h-icon { transform:rotate(10deg) scale(1.1); }
    .h-icon.ic-success   { background:linear-gradient(135deg,#d1fae5,#a7f3d0); color:#059669; }
    .h-icon.ic-primary   { background:linear-gradient(135deg,#e0e7ff,#c7d2fe); color:#4f46e5; }
    .h-icon.ic-danger    { background:linear-gradient(135deg,#fee2e2,#fecaca); color:#dc2626; }
    .h-icon.ic-warning   { background:linear-gradient(135deg,#fef3c7,#fde68a); color:#d97706; }
    .h-icon.ic-info      { background:linear-gradient(135deg,#cffafe,#a5f3fc); color:#0891b2; }
    .h-icon.ic-dark      { background:linear-gradient(135deg,#ede9fe,#ddd6fe); color:#7c3aed; }
    .h-icon.ic-secondary { background:linear-gradient(135deg,#f1f5f9,#e2e8f0); color:#64748b; }
    .h-icon[data-action="created"]::after  { content:'✚'; }
    .h-icon[data-action="updated"]::after  { content:'✎'; }
    .h-icon[data-action="deleted"]::after  { content:'✕'; }
    .h-icon[data-action="restored"]::after { content:'↺'; }
    .h-icon[data-action="other"]::after    { content:'◈'; }

    .h-content { flex:1; min-width:0; }

    .h-title { display:flex; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:8px; }

    .h-model-name { font-size:15px; font-weight:700; color:#111827; letter-spacing:-0.2px; }

    .h-model-id {
        font-size:11px; color:#6b7280;
        background:linear-gradient(135deg,#f9fafb,#f3f4f6); border:1px solid #e5e7eb;
        border-radius:8px; padding:3px 10px; font-weight:600; font-family:'Courier New', monospace;
    }

    .h-badge {
        display:inline-flex !important; align-items:center !important; font-size:10px !important;
        font-weight:800 !important; letter-spacing:1px !important; text-transform:uppercase !important;
        padding:4px 12px !important; border-radius:30px !important;
        box-shadow:0 2px 8px rgba(0,0,0,0.1) !important; border:none !important;
    }

    .h-badge.bg-success  { background:linear-gradient(135deg,#d1fae5,#a7f3d0) !important; color:#065f46 !important; }
    .h-badge.bg-primary  { background:linear-gradient(135deg,#e0e7ff,#c7d2fe) !important; color:#3730a3 !important; }
    .h-badge.bg-danger   { background:linear-gradient(135deg,#fee2e2,#fecaca) !important; color:#991b1b !important; }
    .h-badge.bg-warning  { background:linear-gradient(135deg,#fef3c7,#fde68a) !important; color:#92400e !important; }
    .h-badge.bg-info     { background:linear-gradient(135deg,#cffafe,#a5f3fc) !important; color:#155e75 !important; }
    .h-badge.bg-dark     { background:linear-gradient(135deg,#ede9fe,#ddd6fe) !important; color:#4c1d95 !important; }
    .h-badge.bg-secondary{ background:linear-gradient(135deg,#f1f5f9,#e2e8f0) !important; color:#475569 !important; }

    .h-meta {
        font-size:13px; color:#9ca3af; display:flex; align-items:center;
        flex-wrap:wrap; gap:8px; font-weight:500;
    }

    .h-meta svg { width:13px; height:13px; opacity:0.7; flex-shrink:0; }
    .h-card:hover .h-meta svg { opacity:1; color:#6366f1; }
    .h-meta .dot { width:4px; height:4px; border-radius:50%; background:#d1d5db; }

    .h-actions { display:flex; align-items:center; gap:10px; flex-shrink:0; }

    .btn-h-detail, .btn-h-detail:visited {
        display:inline-flex !important; align-items:center !important; gap:6px !important;
        padding:10px 18px !important; border-radius:12px !important; border:2px solid #e5e7eb !important;
        background:#ffffff !important; color:#6b7280 !important; font-size:13px !important;
        font-weight:600 !important; font-family:'Plus Jakarta Sans', sans-serif !important;
        cursor:pointer !important; transition:var(--transition-base) !important;
        white-space:nowrap !important; text-decoration:none !important;
        position:relative !important; overflow:hidden !important;
        box-shadow:none !important; outline:none !important;
    }

    .btn-h-detail:hover {
        background:linear-gradient(135deg,#eef2ff,#e0e7ff) !important;
        border-color:#c7d2fe !important; color:#4f46e5 !important;
        transform:translateY(-2px) !important; box-shadow:var(--shadow-md) !important;
    }

    .btn-h-detail:active { transform:translateY(0) !important; }

    .btn-h-restore, .btn-h-restore:visited {
        display:inline-flex !important; align-items:center !important; gap:6px !important;
        padding:10px 18px !important; border-radius:12px !important; border:none !important;
        background:var(--warning-gradient) !important; color:#ffffff !important;
        font-size:13px !important; font-weight:600 !important;
        font-family:'Plus Jakarta Sans', sans-serif !important; cursor:pointer !important;
        transition:var(--transition-base) !important; white-space:nowrap !important;
        text-decoration:none !important; box-shadow:0 4px 16px rgba(245,158,11,0.3) !important;
        outline:none !important; position:relative !important; overflow:hidden !important;
    }

    .btn-h-restore:hover { transform:translateY(-3px) !important; box-shadow:0 8px 24px rgba(245,158,11,0.45) !important; }
    .btn-h-restore:active { transform:translateY(-1px) !important; }
    .btn-h-restore:disabled { opacity:0.7 !important; cursor:not-allowed !important; }

    /* ── MODAL — JANGAN override display, biarkan Bootstrap yang atur ── */
    .h-modal .modal-content {
        border-radius:24px !important; border:none !important;
        box-shadow:var(--shadow-xl) !important; overflow:hidden !important;
    }

    .h-modal.show .modal-dialog {
        animation: modalSlide 0.4s cubic-bezier(0.16,1,0.3,1);
    }

    @keyframes modalSlide {
        from { opacity:0; transform:scale(0.95) translateY(-20px); }
        to   { opacity:1; transform:scale(1) translateY(0); }
    }

    .h-modal .modal-header {
        background:linear-gradient(135deg,#f8fafc,#f1f5f9) !important;
        border-bottom:2px solid #e2e8f0 !important; padding:24px 28px !important; position:relative !important;
    }

    .h-modal .modal-header::before {
        content:''; position:absolute; top:0; left:0; right:0; height:3px; background:var(--primary-gradient);
    }

    .h-modal .modal-title {
        font-family:'Plus Jakarta Sans', sans-serif !important; font-size:18px !important;
        font-weight:800 !important; color:#111827 !important;
    }

    .h-modal .modal-subtitle { font-size:13px; color:#9ca3af; margin-top:4px; font-weight:500; }

    .h-modal .modal-body {
        padding:28px !important; background:#ffffff !important;
        max-height:70vh !important; overflow-y:auto !important;
    }

    .h-modal .modal-body::-webkit-scrollbar { width:8px; }
    .h-modal .modal-body::-webkit-scrollbar-track { background:#f1f5f9; border-radius:10px; }
    .h-modal .modal-body::-webkit-scrollbar-thumb { background:linear-gradient(180deg,#6366f1,#8b5cf6); border-radius:10px; }

    .meta-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:14px; margin-bottom:24px; }

    .meta-box {
        background:linear-gradient(135deg,#f9fafb,#f3f4f6); border:1px solid #e5e7eb;
        border-radius:14px; padding:16px 18px; transition:var(--transition-base);
        position:relative; overflow:hidden;
    }

    .meta-box::before {
        content:''; position:absolute; top:0; left:0; width:4px; height:100%;
        background:var(--primary-gradient); opacity:0; transition:opacity 0.3s;
    }

    .meta-box:hover::before { opacity:1; }
    .meta-box:hover { transform:translateX(4px); box-shadow:var(--shadow-sm); }
    .meta-box .meta-label { font-size:11px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:#9ca3af; margin-bottom:6px; }
    .meta-box .meta-val { font-size:15px; font-weight:700; color:#1f2937; }

    .divider {
        height:2px; background:linear-gradient(90deg,transparent,#e5e7eb,transparent);
        margin:24px 0; position:relative;
    }

    .divider::before {
        content:'◆'; position:absolute; top:50%; left:50%;
        transform:translate(-50%,-50%); background:#fff; color:#6366f1; padding:0 12px; font-size:10px;
    }

    .diff-heading {
        font-size:12px; font-weight:800; letter-spacing:1.5px; text-transform:uppercase;
        margin-bottom:12px; display:flex; align-items:center; gap:10px;
    }

    .diff-heading.before-h { color:#ef4444; }
    .diff-heading.after-h  { color:#10b981; }
    .diff-heading::before { content:''; width:20px; height:3px; background:currentColor; border-radius:2px; }
    .diff-heading::after  { content:''; flex:1; height:2px; background:linear-gradient(90deg,currentColor,transparent); opacity:0.2; }

    .dv-card { border-radius:14px; overflow:hidden; border:1px solid #e5e7eb; margin-bottom:4px; }
    .dv-before { border-color:#fecaca; }
    .dv-after  { border-color:#a7f3d0; }
    .dv-grid   { display:grid; grid-template-columns:1fr; gap:0; }

    .dv-row {
        display:flex; align-items:baseline; gap:12px; padding:11px 18px;
        border-bottom:1px solid #f3f4f6; transition:background 0.15s;
    }
    .dv-row:last-child { border-bottom:none; }
    .dv-row:hover { background:#fafafa; }
    .dv-label { flex:0 0 140px; font-size:11px; font-weight:700; letter-spacing:0.06em; text-transform:uppercase; color:#9ca3af; padding-top:2px; }
    .dv-val   { flex:1; font-size:14px; font-weight:500; color:#111827; word-break:break-word; }

    .dv-details-wrap { padding:14px 18px 18px; background:#fafafa; border-top:1px solid #f3f4f6; }
    .dv-details-label { font-size:11px; font-weight:700; letter-spacing:0.06em; text-transform:uppercase; color:#9ca3af; margin-bottom:10px; }

    .dv-table { width:100%; border-collapse:collapse; font-size:13px; }
    .dv-table thead tr { background:#f1f5f9; }
    .dv-table th { padding:8px 12px; text-align:left; font-size:10px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#64748b; }
    .dv-table th:first-child { border-radius:8px 0 0 8px; }
    .dv-table th:last-child  { border-radius:0 8px 8px 0; text-align:center; }
    .dv-table td { padding:10px 12px; border-bottom:1px solid #f1f5f9; color:#334155; font-weight:500; vertical-align:middle; }
    .dv-table td:last-child { text-align:center; }
    .dv-table tr:last-child td { border-bottom:none; }
    .dv-table tbody tr:hover td { background:#f8fafc; }

    @media (max-width:480px) { .dv-row { flex-direction:column; gap:4px; } .dv-label { flex:none; } }

    .h-empty { text-align:center; padding:100px 24px; animation:fadeIn 0.8s ease-out; }

    .h-empty-icon {
        width:80px; height:80px; background:linear-gradient(135deg,#f3f4f6,#e5e7eb);
        border-radius:20px; display:flex; align-items:center; justify-content:center;
        margin:0 auto 20px; color:#9ca3af; animation:float 3s ease-in-out infinite; box-shadow:var(--shadow-md);
    }

    @keyframes float { 0%,100%{ transform:translateY(0); } 50%{ transform:translateY(-10px); } }
    .h-empty h5 { color:#374151; font-weight:800; font-size:20px; margin-bottom:8px; }
    .h-empty p  { color:#9ca3af; font-size:15px; margin:0; font-weight:500; }

    .h-pagination { margin-top:36px; display:flex; justify-content:center; animation:fadeIn 1s ease-out; }
    .h-pagination .pagination { gap:6px; margin:0; }

    .h-pagination .page-link {
        border-radius:12px !important; border:2px solid #e5e7eb !important; color:#6b7280 !important;
        font-size:14px !important; padding:10px 16px !important; transition:var(--transition-base) !important;
        font-family:'Plus Jakarta Sans', sans-serif !important; font-weight:600 !important;
        min-width:44px; text-align:center;
    }

    .h-pagination .page-link:hover {
        background:linear-gradient(135deg,#eef2ff,#e0e7ff) !important; border-color:#c7d2fe !important;
        color:#4f46e5 !important; transform:translateY(-2px); box-shadow:var(--shadow-md);
    }

    .h-pagination .page-item.active .page-link {
        background:var(--primary-gradient) !important; border-color:transparent !important;
        color:#ffffff !important; box-shadow:0 4px 16px rgba(99,102,241,0.4);
    }

    .h-pagination .page-item.disabled .page-link { opacity:0.5; cursor:not-allowed; }

    .toast-container-custom { position:fixed; top:24px; right:24px; z-index:9999; display:flex; flex-direction:column; gap:12px; }

    .toast-notification {
        background:#ffffff; border-radius:14px; padding:16px 20px; box-shadow:var(--shadow-xl);
        min-width:300px; display:flex; align-items:center; gap:12px;
        animation:toastSlide 0.4s cubic-bezier(0.16,1,0.3,1); border-left:4px solid;
    }

    @keyframes toastSlide  { from { opacity:0; transform:translateX(120px); } to { opacity:1; transform:translateX(0); } }
    @keyframes toastFadeOut{ from { opacity:1; transform:translateX(0); } to { opacity:0; transform:translateX(120px); } }

    .toast-notification.success { border-color:#10b981; }
    .toast-notification.error   { border-color:#ef4444; }
    .toast-notification.info    { border-color:#6366f1; }

    .toast-icon {
        width:36px; height:36px; border-radius:10px; display:flex; align-items:center;
        justify-content:center; flex-shrink:0; font-size:16px; font-weight:700;
    }

    .toast-notification.success .toast-icon { background:#d1fae5; color:#059669; }
    .toast-notification.error   .toast-icon { background:#fee2e2; color:#dc2626; }
    .toast-notification.info    .toast-icon { background:#e0e7ff; color:#4f46e5; }

    .toast-content { flex:1; }
    .toast-title   { font-weight:700; font-size:14px; color:#111827; margin-bottom:2px; }
    .toast-msg     { font-size:12px; color:#6b7280; }

    #scrollTopBtn {
        position:fixed; bottom:30px; right:30px; width:50px; height:50px; border-radius:50%;
        background:var(--primary-gradient); color:#ffffff; border:none; font-size:20px;
        cursor:pointer; opacity:0; visibility:hidden; transition:var(--transition-base);
        box-shadow:0 8px 24px rgba(99,102,241,0.4); z-index:1000; display:flex;
        align-items:center; justify-content:center;
    }

    #scrollTopBtn.show { opacity:1; visibility:visible; }
    #scrollTopBtn:hover { transform:translateY(-4px) scale(1.05); }

    @media (max-width:768px) {
        .history-page { padding:24px 0 80px; }
        .history-page-header { padding:24px; }
        .history-page-header h2 { font-size:24px; }
        .h-card-body { flex-wrap:wrap; padding:16px 18px; }
        .h-actions { width:100%; justify-content:flex-end; margin-top:8px; }
        .meta-grid { grid-template-columns:1fr; }
        .filter-bar { overflow-x:auto; flex-wrap:nowrap; padding-bottom:8px; }
        .toast-notification { min-width:calc(100vw - 48px); }
    }

    @media (max-width:576px) {
        .btn-h-detail, .btn-h-restore { font-size:12px !important; padding:8px 14px !important; }
        #scrollTopBtn { bottom:16px; right:16px; }
    }
</style>

@section('content')
<div class="container history-page">

    {{-- HEADER --}}
    <div class="history-page-header">
        <span class="tag">Audit Trail</span>
        <h2>History Perubahan Data</h2>
        <p>Rekam jejak seluruh aktivitas perubahan data dalam sistem.</p>
    </div>

    {{-- SEARCH --}}
    <div class="search-container">
        <span class="search-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <circle cx="11" cy="11" r="8"/>
                <path d="m21 21-4.3-4.3"/>
            </svg>
        </span>
        <input type="text" id="searchInput" class="search-box"
               placeholder="Cari berdasarkan model, user, atau ID…  (Ctrl+K)">
        <button class="search-clear" id="searchClear" type="button" aria-label="Hapus pencarian">✕</button>
    </div>

    {{-- FILTER BAR --}}
    <div class="filter-bar">
        <button class="filter-btn active" data-action="all">Semua <span class="count-badge" id="countAll">0</span></button>
        <button class="filter-btn" data-action="created">Created <span class="count-badge" id="countCreated">0</span></button>
        <button class="filter-btn" data-action="updated">Updated <span class="count-badge" id="countUpdated">0</span></button>
        <button class="filter-btn" data-action="deleted">Deleted <span class="count-badge" id="countDeleted">0</span></button>
        <button class="filter-btn" data-action="restored">Restored <span class="count-badge" id="countRestored">0</span></button>
    </div>

    {{-- SKELETON --}}
    <div id="skeletonLoader">
        <div class="skeleton-card"></div>
        <div class="skeleton-card"></div>
        <div class="skeleton-card"></div>
    </div>

    {{-- HISTORY LIST (card saja, tanpa modal di dalamnya) --}}
    <div id="historyList">
        @forelse($histories as $index => $history)
            @php
                $colorKey = match($history->action) {
                    'created'  => 'success',
                    'updated'  => 'primary',
                    'deleted'  => 'danger',
                    'restored' => 'warning',
                    default    => 'secondary'
                };
            @endphp

            <div class="h-card ac-{{ $colorKey }}"
                 style="--card-index:{{ $index }};"
                 data-action="{{ $history->action }}"
                 data-search="{{ strtolower($history->model_type . ' ' . $history->model_id . ' ' . ($history->user->name ?? '')) }}">
                <div class="h-card-body">

                    <div class="h-icon ic-{{ $colorKey }}" data-action="{{ $history->action }}"></div>

                    <div class="h-content">
                        <div class="h-title">
                            <span class="h-model-name">{{ $history->model_type }}</span>
                            <span class="h-model-id">#{{ $history->model_id }}</span>
                            <span class="h-badge badge bg-{{ $colorKey }}">{{ strtoupper($history->action) }}</span>
                        </div>
                        <div class="h-meta">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M6 20v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
                            </svg>
                            {{ $history->user->name ?? '—' }}
                            <span class="dot"></span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2"/>
                                <path d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>
                            {{ $history->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <div class="h-actions">
                        {{--
                            Gunakan data-bs-toggle + data-bs-target seperti Bootstrap standar.
                            Modal dirender di LUAR #historyList (di bawah) agar tidak
                            terjebak dalam overflow:hidden milik .h-card.
                        --}}
                        <button type="button"
                                class="btn-h-detail"
                                data-bs-toggle="modal"
                                data-bs-target="#hModal{{ $history->id }}">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.3-4.3"/>
                            </svg>
                            Detail
                        </button>

                        @if($history->action === 'deleted')
                            <form class="restore-form d-inline"
                                  action="{{ route('histories.restore', $history->id) }}"
                                  method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-h-restore">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                                        <path d="M3 3v5h5"/>
                                    </svg>
                                    Restore
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

        @empty
            <div class="h-empty" id="emptyDefault">
                <div class="h-empty-icon">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                        <rect x="9" y="3" width="6" height="4" rx="1"/>
                        <path d="M9 12h6M9 16h4"/>
                    </svg>
                </div>
                <h5>Belum ada history</h5>
                <p>Seluruh aktivitas perubahan data akan muncul di sini.</p>
            </div>
        @endforelse
    </div>

    @if($histories->hasPages())
    <div class="h-pagination">{{ $histories->links() }}</div>
    @endif

</div>

<button id="scrollTopBtn" aria-label="Kembali ke atas">↑</button>
<div class="toast-container-custom" id="toastContainer"></div>

{{--
╔══════════════════════════════════════════════════════════════════════╗
║  MODAL DIRENDER DI SINI — di luar .container dan di luar #historyList ║
║  Ini solusi root cause:                                              ║
║  .h-card punya overflow:hidden → Bootstrap tidak bisa render modal   ║
║  backdrop + dialog melewati batas elemen tersebut.                  ║
║  Dengan menaruh modal di level body (luar semua wrapper), Bootstrap  ║
║  dapat merender modal dengan benar.                                  ║
╚══════════════════════════════════════════════════════════════════════╝
--}}
@foreach($histories as $history)
@php
$ck = match($history->action) {
    'created'  => 'success',
    'updated'  => 'primary',
    'deleted'  => 'danger',
    'restored' => 'warning',
    default    => 'secondary'
};

$hiddenKeys = ['id','report_id','sm_class_id','created_by','updated_by'];

$labelMap = [
    'student_name'=>'Nama Siswa','month'=>'Bulan',
    'class'=>'Kelas','grade'=>'Nilai','subject'=>'Mata Pelajaran',
    'created_at'=>'Dibuat','updated_at'=>'Diperbarui','name'=>'Nama',
    'email'=>'Email','phone'=>'Telepon','address'=>'Alamat',
    'description'=>'Deskripsi','status'=>'Status','note'=>'Catatan',
    'type'=>'Tipe','amount'=>'Jumlah',
];

$gc = [
    'A'=>['bg'=>'#d1fae5','color'=>'#065f46'],
    'B'=>['bg'=>'#dbeafe','color'=>'#1e40af'],
    'C'=>['bg'=>'#fef9c3','color'=>'#854d0e'],
    'D'=>['bg'=>'#fee2e2','color'=>'#991b1b'],
];

$fmtVal = function($key, $value) use ($gc) {
    if (is_null($value)) return '<span style="color:#9ca3af;font-style:italic;">—</span>';
    if (is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}/', $value)) {
        try {
            $dt = \Carbon\Carbon::parse($value)->locale('id');
            return '<span style="color:#374151;">'.$dt->format('H:i').' &middot; '.$dt->translatedFormat('j F Y').'</span>';
        } catch (\Exception $e) {}
    }
    if ($key === 'grade' && isset($gc[strtoupper($value)])) {
        $c = $gc[strtoupper($value)];
        return '<span style="background:'.$c['bg'].';color:'.$c['color'].';padding:3px 12px;border-radius:20px;font-weight:700;font-size:12px;">'.e(strtoupper($value)).'</span>';
    }
    if (is_bool($value)) return $value
        ? '<span style="color:#059669;font-weight:600;">Ya</span>'
        : '<span style="color:#dc2626;font-weight:600;">Tidak</span>';
    return '<span style="color:#111827;">'.e($value).'</span>';
};

$renderData = function(array $data) use ($hiddenKeys, $labelMap, $fmtVal, $gc) {
    $html = '<div class="dv-grid">';
    $hasDetails = false; $details = [];
    foreach ($data as $key => $value) {
        if (in_array($key, $hiddenKeys)) continue;
        if ($key === 'details' && is_array($value)) { $hasDetails = true; $details = $value; continue; }
        $label = $labelMap[$key] ?? ucwords(str_replace('_',' ',$key));
        $html .= '<div class="dv-row"><div class="dv-label">'.e($label).'</div><div class="dv-val">'.$fmtVal($key,$value).'</div></div>';
    }
    $html .= '</div>';
    if ($hasDetails && count($details)) {
        $html .= '<div class="dv-details-wrap"><div class="dv-details-label">Daftar Nilai</div>';
        $html .= '<table class="dv-table"><thead><tr><th>#</th><th>Mata Pelajaran</th><th>Nilai</th></tr></thead><tbody>';
        foreach ($details as $i => $det) {
            $grade = strtoupper($det['grade'] ?? '—');
            $pill = isset($gc[$grade])
                ? '<span style="background:'.$gc[$grade]['bg'].';color:'.$gc[$grade]['color'].';padding:3px 14px;border-radius:20px;font-weight:700;font-size:12px;">'.$grade.'</span>'
                : e($grade);
            $html .= '<tr><td style="color:#9ca3af;font-size:12px;">'.($i+1).'</td><td>'.e($det['subject']??'—').'</td><td>'.$pill.'</td></tr>';
        }
        $html .= '</tbody></table></div>';
    }
    return $html;
};
@endphp

<div class="modal fade h-modal"
     id="hModal{{ $history->id }}"
     tabindex="-1"
     aria-labelledby="hModalLabel{{ $history->id }}"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="hModalLabel{{ $history->id }}">Detail Perubahan</h5>
                    <div class="modal-subtitle">{{ $history->model_type }} #{{ $history->model_id }} — {{ $history->created_at->format('d M Y, H:i') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="meta-grid">
                    <div class="meta-box">
                        <div class="meta-label">Action</div>
                        <div class="meta-val"><span class="h-badge badge bg-{{ $ck }}">{{ strtoupper($history->action) }}</span></div>
                    </div>
                    <div class="meta-box">
                        <div class="meta-label">User</div>
                        <div class="meta-val">{{ $history->user->name ?? '—' }}</div>
                    </div>
                    <div class="meta-box">
                        <div class="meta-label">Model</div>
                        <div class="meta-val">{{ $history->model_type }}</div>
                    </div>
                </div>

                @if($history->before)
                    <div class="divider"></div>
                    <div class="diff-heading before-h">Data Sebelum</div>
                    <div class="dv-card dv-before">
                        {!! $renderData(is_array($history->before) ? $history->before : json_decode($history->before, true) ?? []) !!}
                    </div>
                @endif

                @if($history->after)
                    <div class="divider"></div>
                    <div class="diff-heading after-h">Data Sesudah</div>
                    <div class="dv-card dv-after">
                        {!! $renderData(is_array($history->after) ? $history->after : json_decode($history->after, true) ?? []) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
/* ═══════════════════════════════════════════════════════════════════════
   TOAST
═══════════════════════════════════════════════════════════════════════ */
function showToast(type, title, message) {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    const icons = { success:'✓', error:'✕', info:'ℹ' };
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type}`;
    toast.innerHTML = `
        <div class="toast-icon">${icons[type] ?? '•'}</div>
        <div class="toast-content">
            <div class="toast-title">${title}</div>
            <div class="toast-msg">${message}</div>
        </div>`;
    container.appendChild(toast);
    setTimeout(() => {
        toast.style.animation = 'toastFadeOut 0.4s cubic-bezier(0.16,1,0.3,1) forwards';
        setTimeout(() => toast.remove(), 420);
    }, 4000);
}

/* ═══════════════════════════════════════════════════════════════════════
   FILTER COUNTS
═══════════════════════════════════════════════════════════════════════ */
function updateFilterCounts() {
    const counts = { all:0, created:0, updated:0, deleted:0, restored:0 };
    document.querySelectorAll('.h-card').forEach(card => {
        counts.all++;
        const a = card.dataset.action;
        if (counts[a] !== undefined) counts[a]++;
    });
    Object.entries(counts).forEach(([key, val]) => {
        const el = document.getElementById('count' + key.charAt(0).toUpperCase() + key.slice(1));
        if (el) el.textContent = val;
    });
}

/* ═══════════════════════════════════════════════════════════════════════
   FILTER BY ACTION
═══════════════════════════════════════════════════════════════════════ */
let activeAction = 'all';

document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        activeAction = this.dataset.action;
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        applyFilters();
    });
});

/* ═══════════════════════════════════════════════════════════════════════
   SEARCH
═══════════════════════════════════════════════════════════════════════ */
const searchInput = document.getElementById('searchInput');
const searchClear = document.getElementById('searchClear');
let searchTerm = '', searchTimeout;

searchInput.addEventListener('input', function () {
    searchTerm = this.value.toLowerCase().trim();
    searchClear.classList.toggle('show', searchTerm.length > 0);
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(applyFilters, 280);
});

searchClear.addEventListener('click', function () {
    searchInput.value = '';
    searchTerm = '';
    this.classList.remove('show');
    applyFilters();
    searchInput.focus();
});

/* ═══════════════════════════════════════════════════════════════════════
   APPLY FILTER + SEARCH
═══════════════════════════════════════════════════════════════════════ */
function applyFilters() {
    const cards = document.querySelectorAll('#historyList .h-card');
    let visible = 0;

    cards.forEach(card => {
        const ok = (activeAction === 'all' || card.dataset.action === activeAction)
                && (!searchTerm || (card.dataset.search || '').includes(searchTerm));
        card.style.display = ok ? '' : 'none';
        if (ok) { card.style.setProperty('--card-index', visible); visible++; }
    });

    let emp = document.getElementById('emptySearch');
    if (visible === 0 && cards.length > 0) {
        if (!emp) {
            emp = document.createElement('div');
            emp.id = 'emptySearch';
            emp.className = 'h-empty';
            emp.innerHTML = `
                <div class="h-empty-icon">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                    </svg>
                </div>
                <h5>Tidak ada hasil</h5>
                <p>Coba kata kunci atau filter yang berbeda.</p>`;
            document.getElementById('historyList').appendChild(emp);
        }
    } else {
        if (emp) emp.remove();
    }
}

/* ═══════════════════════════════════════════════════════════════════════
   RESTORE — AJAX
═══════════════════════════════════════════════════════════════════════ */
document.querySelectorAll('.restore-form').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const btn = this.querySelector('button[type="submit"]');
        const ori = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            style="animation:spinAnim 1s linear infinite;flex-shrink:0;"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Memproses…`;

        fetch(this.action, {
            method:'POST', body: new FormData(this),
            headers:{ 'X-Requested-With':'XMLHttpRequest', 'Accept':'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast('success', 'Berhasil!', data.message || 'Data berhasil dipulihkan');
                setTimeout(() => location.reload(), 1400);
            } else {
                showToast('error', 'Gagal!', data.message || 'Terjadi kesalahan');
                btn.disabled = false; btn.innerHTML = ori;
            }
        })
        .catch(() => {
            showToast('error', 'Gagal!', 'Koneksi bermasalah, coba lagi.');
            btn.disabled = false; btn.innerHTML = ori;
        });
    });
});

/* ═══════════════════════════════════════════════════════════════════════
   PAGINATION — AJAX
═══════════════════════════════════════════════════════════════════════ */
document.addEventListener('click', function (e) {
    const link = e.target.closest('.h-pagination .page-link');
    if (!link) return;
    const href = link.getAttribute('href');
    if (!href || href === '#' || href.startsWith('javascript')) return;
    e.preventDefault();

    const skel = document.getElementById('skeletonLoader');
    const list = document.getElementById('historyList');
    skel.classList.add('active');
    list.style.opacity = '0.4';
    list.style.pointerEvents = 'none';
    window.scrollTo({ top:0, behavior:'smooth' });

    fetch(href, { headers:{ 'X-Requested-With':'XMLHttpRequest' } })
        .then(r => r.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const nl  = doc.querySelector('#historyList');
            if (nl) list.innerHTML = nl.innerHTML;
            const np = doc.querySelector('.h-pagination');
            const cp = document.querySelector('.h-pagination');
            if (np && cp) cp.innerHTML = np.innerHTML;
            skel.classList.remove('active');
            list.style.opacity = '1';
            list.style.pointerEvents = '';
            updateFilterCounts();
            applyFilters();
            window.history.pushState({}, '', href);
        })
        .catch(() => {
            showToast('error','Gagal!','Terjadi kesalahan saat memuat halaman');
            skel.classList.remove('active');
            list.style.opacity = '1';
            list.style.pointerEvents = '';
        });
});

/* ═══════════════════════════════════════════════════════════════════════
   SCROLL TO TOP
═══════════════════════════════════════════════════════════════════════ */
const scrollTopBtn = document.getElementById('scrollTopBtn');
window.addEventListener('scroll', () => scrollTopBtn.classList.toggle('show', window.scrollY > 300));
scrollTopBtn.addEventListener('click', () => window.scrollTo({ top:0, behavior:'smooth' }));

/* ═══════════════════════════════════════════════════════════════════════
   KEYBOARD SHORTCUTS
═══════════════════════════════════════════════════════════════════════ */
document.addEventListener('keydown', function (e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') { e.preventDefault(); searchInput.focus(); searchInput.select(); }
    if (e.key === 'Escape' && document.activeElement === searchInput) {
        searchInput.value = ''; searchTerm = '';
        searchClear.classList.remove('show'); applyFilters(); searchInput.blur();
    }
});

/* Spin animation */
const spinStyle = document.createElement('style');
spinStyle.textContent = '@keyframes spinAnim { to { transform: rotate(360deg); } }';
document.head.appendChild(spinStyle);

/* INIT */
updateFilterCounts();

@if(session('success'))
    showToast('success', 'Berhasil!', @json(session('success')));
@endif
@if(session('error'))
    showToast('error', 'Gagal!', @json(session('error')));
@endif
</script>
@endpush