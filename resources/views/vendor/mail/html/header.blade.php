@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'TuaPraia')
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/logotipo.png'))) }}" alt="TuaPraia Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
