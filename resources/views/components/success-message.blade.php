@php
    $messageKey = request()->query('message_key');
@endphp

@if($messageKey)
    <div class="alert alert-success alert-success-custom">
        {{ __('success.' . $messageKey) }}
    </div>
@endif
