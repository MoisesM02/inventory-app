<table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200']) }}>
    <thead class="bg-gray-50">
        {{ $head }}
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        {{ $slot }}
    </tbody>
    <tfoot>
        {{ $foot ?? '' }}
    </tfoot>
</table>
