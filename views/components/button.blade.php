<button 
    type="{{ $type ?? 'button' }}" 
    class="btn btn-{{ $variant ?? 'primary' }} {{ $class ?? '' }}"
    {{ $attributes }}
>
    {{ $slot }}
</button>

<style>
.btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.2s;
}

.btn-primary {
    background-color: #3b82f6;
    color: white;
}

.btn-primary:hover {
    background-color: #2563eb;
}

.btn-secondary {
    background-color: #64748b;
    color: white;
}

.btn-secondary:hover {
    background-color: #475569;
}
</style>
