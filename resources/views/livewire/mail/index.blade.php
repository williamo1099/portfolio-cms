<div class="flex flex-col gap-3">
    <div class="flex flex-row items-center justify-between">
        <x-page-header :title="$title" :breadcrumbs="$breadcrumbs" />
    </div>

    {{-- Summary --}}
    <div class="flex flex-row justify-start gap-3 mb-5">
        {{-- Notified --}}
        <x-summary-card title="Notified Mails" :text="$notifiedCount" click="setStatusFilter('notified')" :active="$this->isActive('notified')" />

        {{-- Dismissed --}}
        <x-summary-card title="Dismissed Mails" :text="$dismissedCount" click="setStatusFilter('dismissed')"
            :active="$this->isActive('dismissed')" />
    </div>

    {{-- Flash alert --}}
    @foreach (['success', 'error'] as $type)
        @if (session($type))
            <x-flash-alert :type="$type">{{ session($type) }}</x-flash-alert>
        @endif
    @endforeach

    {{-- Table --}}
    <x-mail.table :mails="$mails" />
</div>
