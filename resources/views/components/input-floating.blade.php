@props(['label', 'id', 'containerClass' => 'mb-6'])

<div class="form-floating form-floating-outline {{ $containerClass }}">
    <input {{ $attributes->merge(['class' => 'form-control' . ($errors->has($id) ? ' is-invalid' : '')]) }}
        id="{{ $id }}" placeholder="{{ $label }}" />
    <label for="{{ $id }}">{{ $label }} @if($attributes->has('required') && $attributes->get('required') !== false)
        <span class="text-danger">*</span>
    @endif</label>
    @error($id)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>