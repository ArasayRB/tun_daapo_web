<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ $message->embed(base_path() . '/images/img/pie_tundaapo_para_web.png') }}" class="logo rounded rounded-circle bg-warning pt-2 pr-3 pb-5" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
