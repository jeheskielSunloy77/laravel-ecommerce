@props(['hoverable'=>false])
<div {{$attributes->merge(['class' => ($hoverable ? 'transition-all hover:shadow-[6px_6px_black]':'') . ' shadow-[4px_4px_black] border border-black'])}}>
    {{ $slot}}
</div>