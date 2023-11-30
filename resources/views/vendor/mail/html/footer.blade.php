<tr>
<td>
	<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
		<tr>
			<td class="content-cell" align="center">
			{{-- Please do not reply to this email. Emails sent to this address will not be answered.</br> --}}
			{{ Illuminate\Mail\Markdown::parse($slot) }}

			{{-- <a href="https://anypo.net/" style="display: inline-block;">
				{{ Illuminate\Mail\Markdown::parse($slot) }}
			</a> --}}

			</td>
		</tr>
	</table>
</td>
</tr>
