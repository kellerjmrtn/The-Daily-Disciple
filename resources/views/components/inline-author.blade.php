@if ($link)
    <a
        class="author-container martel inline-block"
        href="{{ route('devotions.index', ['search' => $user->name]) }}"
    >
        <i class="fa-solid fa-user incline-block mr-2"></i>
        <span>{{ $user->name }}</span>
    </a>
@else
    <span class="author-container martel inline-block">
        <i class="fa-solid fa-user incline-block mr-2"></i>
        <span>{{ $user->name }}</span>
    </span>
@endif