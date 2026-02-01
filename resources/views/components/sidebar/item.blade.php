<li class="menu-item {{ $isActive() ? 'active' : '' }}">
    <a href="{{ route($route) }}" wire:navigate class="menu-link">
        <i class="menu-icon tf-icons {{ $icon }}"></i>
        <div>{{ $label }}</div>
    </a>
</li>