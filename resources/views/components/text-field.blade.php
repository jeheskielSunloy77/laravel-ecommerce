@props(['errors', 'wrapperClassName','label' => ''])
<div class="flex flex-col {{$wrapperClassName ?? ''}}">
    <x-input-label for="{{$attributes['id']}}">
        {{$label}}
    </x-input-label>
    <x-text-input {{$attributes->except('label')}} />
    @if(isset($errors))
    <x-input-error :messages="$errors" />
    @endif
</div>