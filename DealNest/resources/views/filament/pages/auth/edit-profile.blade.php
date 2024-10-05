<x-filament-panels::page>

    <x-slot name="subheading">
        {{ $this->backAction() }}
    </x-slot>

    <x-filament-panels::form wire:submit.prevent="save">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

</x-filament-panels::page>
