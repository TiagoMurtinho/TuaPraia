<x-mail::message>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}

@isset($actionText)
    @slot('subcopy')
    @lang(
    "Se estiver com dificuldades em clicar no botão \":actionText\", copie e cole o URL abaixo\n".
    'no seu navegador:',
                [
                    'actionText' => $actionText,
                ]
    ) <span class="break-all">[{{ $actionUrl }}]({{ $actionUrl }})</span>
    @endslot
@endisset
</x-mail::message>
