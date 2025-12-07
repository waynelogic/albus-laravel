<div>
    <x-filament::section>
        <x-slot name="heading">Свойства</x-slot>
        @foreach($getChildComponents() as $field)
            {{ $field }}
        @endforeach
    </x-filament::section>
</div>
