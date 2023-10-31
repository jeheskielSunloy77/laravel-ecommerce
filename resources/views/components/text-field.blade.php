@props(['errors', 'label' => '', 'type' => 'text'])
<div class="flex flex-col">
    <x-input-label for="{{$attributes['id']}}">
        {{$label}}
    </x-input-label>
    <x-text-input {{$attributes->except('label')}} />
    @if($errors && !$errors->isEmpty())
    <x-input-error :messages="$errors" />
    @endif
</div>