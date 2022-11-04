<x-mail::message>
# Introduction

Hi,

A new file has been shared with you from {{ \App\Models\Setting::org_name() }}.

<x-mail::button :url="$url" color="primary">
Clik to Open
</x-mail::button>

Regards,<br>
{{ config('app.name') }}
</x-mail::message>
