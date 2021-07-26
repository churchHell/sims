<?php

if (!function_exists('cartRepository')) {
    function cartRepository(string $email, string $password)
    {
        return app(\App\Repositories\Contracts\CartRepositoryContract::class, compact('email', 'password'));
    }
}

if (!function_exists('itemRepository')) {
    function itemRepository()
    {
        return app(\App\Repositories\Contracts\ItemRepositoryContract::class);
    }
}

if (!function_exists('deliveryRepository')) {
    function deliveryRepository()
    {
        return app(\App\Repositories\Contracts\DeliveryRepositoryContract::class);
    }
}

if (!function_exists('isSynced')) {
    function isSynced(array $result): bool
    {
        return count($result['attached']) > 0 || count($result['updated']) > 0;
    }
}

if (!function_exists('isUnsynced')) {
    function isUnsynced(array $result): bool
    {
        return count($result['detached']) > 0;
    }
}

if (!function_exists('dateToShow')) {
    function dateToShow(string $date): string
    {
        return \Carbon\Carbon::make($date)->format('d.m H:i');
    }
}

if (!function_exists('isNewColor')) {
    function isNewColor(string $date): string
    {
        return \Carbon\Carbon::now()->diffInMinutes(new \Carbon\Carbon($date)) < 1440 ? 'success' : 'error';
    }
}

if (!function_exists('___')) {
    function ___(string $key, int $qty): string
    {
        return trans_choice($key, $qty);
    }
}

if (!function_exists('fullName')) {
    function fullName(string $name, string $surname): string
    {
        return ucfirst(strtolower($surname)) . ' ' . ucfirst(strtolower($name));
    }
}

if (!function_exists('shortName')) {
    function shortName(string $name, string $surname): string
    {
        return ucfirst(strtolower($surname)) . ' ' . ucfirst(mb_substr($name, 0, 1)) . '.';
    }
}

if (!function_exists('filterClasses')) {
    function filterClasses(string $classes, array $filters = []): string
    {
        return \Illuminate\Support\Str::of($classes)
            ->explode(' ')
            ->filter(
                fn($class) => \Illuminate\Support\Str::startsWith($class, $filters)
            )
            ->implode(' ');
    }
}
