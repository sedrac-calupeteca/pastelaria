<label for="{{ $name }}">
    <i class="{{ $icon }}"></i>
    <span>{{ $label }}</span>
    @if ($require ?? false)
        <span class="text-danger">*</span>
    @endif
</label>
<textarea name="{{ $name }}" id="{{ $name }}"
class="form-control @error($name) is-invalid @enderror
@if(isset($rounded) && $rounded) rounded @endif"
@isset($cols) cols="{{$cols}}" @else cols="30" @endisset
@isset($rows) rows="{{$rows}}" @else rows="10" @endisset
@isset($value) value="{{$value}}" @endisset> </textarea>
@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
