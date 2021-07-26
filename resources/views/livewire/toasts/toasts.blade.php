<div>
    @if (!empty($toasts) && is_array($toasts) && (count($toasts['error']) > 0 || count($toasts['success']) > 0 || count($toasts['warning']) > 0))
        <div class="toasts space-y-4 fixed right-0 top-0 p-4 z-50">
            @foreach ($toasts as $type => $toast)
                @if (!empty($toast) && is_array($toast) && count($toast) > 0)
                    <div class="toast rounded py-4 px-8 shadow {{ $type }}">
                        <ul>
                            @foreach ($toast as $id => $message)
                                <li wire:poll.3s="removeToast('{{ $type }}', {{ $id }})">
                                    {{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
