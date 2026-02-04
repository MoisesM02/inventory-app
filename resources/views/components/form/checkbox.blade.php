@props(['name', 'label', 'value' => 1, 'id'])

<div class="flex items-start">
    <div class="flex items-center h-5">
        <input
            id="{{ $id }}"
            name="{{ $name }}[]"
            type="checkbox"
            value="{{ $value }}"
            {{ $attributes->merge(['class' => 'focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded']) }}
        >
    </div>
    <div class="ml-3 text-sm">
        <label for="{{ $id }}" class="font-medium text-gray-700">
            {{ $label }}
        </label>
    </div>
</div>
