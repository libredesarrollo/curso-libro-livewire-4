<?php extract((new \Illuminate\Support\Collection($attributes->getAttributes()))->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
@props(['id','class'])
<x-livewire-filemanager::icons.mimes.file :id="$id" :class="$class" >

{{ $slot ?? "" }}
</x-livewire-filemanager::icons.mimes.file>