@props([
    'title' => '',
    'icon' => 'border-all',
    'subtitle' => null,
])

<div class="admin-page-header">
    <div class="aph-left">
        <h1>
            <i class="fas fa-{{ $icon }}"></i>
            {{ $title }}
        </h1>
        <ul class="breadcrumb">
            <li><a href="/admin" wire:navigate>Dashboard</a></li>
            <i class="fas fa-chevron-right"></i>
            <li><a href="#" class="active">{{ $title }}</a></li>
        </ul>
        @if($subtitle)
            <p class="aph-subtitle">{{ $subtitle }}</p>
        @endif
    </div>

    @if(isset($actions))
        <div class="aph-actions">{{ $actions }}</div>
    @endif
</div>

@once
    @push('styles')
    <style>
        .admin-page-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            background: #fff;
            border-radius: 12px;
            padding: 18px 22px;
            margin-bottom: 24px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
            border-left: 4px solid #7c3aed;
        }
        .admin-page-header h1 {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }
        .admin-page-header h1 i { color: #7c3aed; font-size: 1.25rem; }
        .admin-page-header .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 8px 0 0;
            font-size: 0.82rem;
        }
        .admin-page-header .breadcrumb li a { color: #94a3b8; text-decoration: none; }
        .admin-page-header .breadcrumb li a.active { color: #7c3aed; font-weight: 600; }
        .admin-page-header .breadcrumb i { font-size: 0.65rem; color: #cbd5e1; }
        .admin-page-header .aph-subtitle { margin: 8px 0 0; color: #64748b; font-size: 0.9rem; }
    </style>
    @endpush
@endonce
