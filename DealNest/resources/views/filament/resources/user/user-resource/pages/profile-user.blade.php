<x-filament-panels::page>
<form wire:submit.prevent="submit">
      {{ $this->form }}
      <x-filament::button type="submit">Lưu</x-filament::button>
  </form>
</x-filament-panels::page>
