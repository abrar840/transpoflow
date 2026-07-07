@props([
    'icon' => 'inbox',
    'title' => 'Nothing here yet',
    'text' => '',
    'link' => null,
    'cta' => null,
])

<div style="text-align:center; padding:32px 16px; color:#666;">
    <div style="display:inline-flex; align-items:center; justify-content:center; width:56px; height:56px; border-radius:50%; background:#eef0f5; color:#9aa1ad; font-size:1.4rem; margin-bottom:14px;">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
    <h4 style="margin:0 0 6px; font-size:1.05rem; font-weight:600; color:#333;">{{ $title }}</h4>
    @if($text)
        <p style="margin:0 auto 16px; max-width:380px; font-size:0.9rem; line-height:1.5;">{{ $text }}</p>
    @endif
    @if($link && $cta)
        <a href="{{ $link }}"
           style="display:inline-flex; align-items:center; gap:8px; background:#7c3aed; color:#fff; text-decoration:none; padding:9px 18px; border-radius:8px; font-size:0.9rem; font-weight:600;">
            <i class="fas fa-plus"></i> {{ $cta }}
        </a>
    @endif
</div>
