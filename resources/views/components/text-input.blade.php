@props(['isTextArea' => false])
@if($isTextArea)
<textarea {{$attributes->except('value')->merge(['class'=>'px-4 py-2 border border-black bg-transparent placeholder:text-gray-500 outline-none focus:shadow-[4px_4px_black] transition-shadow'])}}>{{$attributes['value']}}</textarea>
@else
<input {{$attributes->merge(['class'=>'px-4 py-2 border border-black bg-transparent placeholder:text-gray-500 outline-none focus:shadow-[4px_4px_black] transition-shadow'])}}>
@endif