@if(isset($message))
<div class="border px-4 py-3 rounded relative bg-green-100 border-green-400 text-green-700">
    {{$message}}
</div>
@endif
<!--一番上に@props(['message'])と入れるとapp\View\Components\Message.phpを作らなくてもできる-->