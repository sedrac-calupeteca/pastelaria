<label for="{{ $name }}">
    <i class="{{ $icon }}"></i>
    <span>{{ $label }}</span>
    @if ($require ?? false)
        <span class="text-danger">*</span>
    @endif
</label>
<input name="{{ $name }}" id="{{ $name }}"
    @isset($min) min="{{ $min }}" @endisset
    @isset($max) max="{{ $max }}" @endisset
    @if ($require ?? false) required @endif
    @isset($type) type="{{ $type }}" @else type="text" @endisset
    @isset($placeholder) placeholder="{{ $placeholder }}"  @endisset
    @isset($value) value="{{ $value }}" @else value="{{ old($name) }}" @endisset
    class="form-control @isset($class) {{ $class }} @endisset @error($name) is-invalid @enderror
    @if(isset($rounded) && $rounded) rounded @endif
    @if(isset($inline) && $inline) inline @endif"
    @if(isset($disabled) && $disabled) disabled @endif
    @if(isset($readonly) && $readonly) readonly @endif
>
@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
