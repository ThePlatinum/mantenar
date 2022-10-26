<x-mail::message>
# Collaboration Invitation

Hi, 

{{ \App\Models\Setting::org_name() }} has invited you to collaborate and share files with them.

<x-mail::button :url="$url" color="primary">
Accept Invitation
</x-mail::button>

If you are unable to click button, copy and paste url into your browser: {{ $url }}

Regards,<br>
{{ config('app.name') }}
</x-mail::message>
