<div class="grid grid-cols-6 items-center py-2">
    <div class="col-span-1 text-sm font-medium text-gray-700">{{ $label }}</div>
    @foreach ($ratings as $index => $ratingLabel)
        <div class="col-span-1 text-center">
            <input type="radio" name="{{ $field }}" value="{{ 5 - $index }}" id="{{ $field }}_{{ 5 - $index }}" class="form-radio h-5 w-5 text-blue-600" {{ old($field) == (5 - $index) ? 'checked' : '' }}>
        </div>
    @endforeach
</div> 