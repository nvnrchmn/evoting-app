<select name="{{ $name }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-200']) }}>
    @foreach ($options as $key => $label)
        <option value="{{ $key }}" {{ (old($name, $selected) == $key) ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
</select>