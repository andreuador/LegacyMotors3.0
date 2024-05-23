<?php
declare(strict_types=1);

namespace App\Helper;

final class FlashMessage{
    const SESSION_KEY = 'flash_message';

    public static function get(string $key, mixed $default = ''): mixed
    {
        $value = $_SESSION[self::SESSION_KEY][$key] ?? $default;
        self::unset($key);
        return $value;
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[self::SESSION_KEY][$key] = $value;
    }

    public static function unset(string $key): void
    {
        unset($_SESSION[self::SESSION_KEY][$key]);
    }
}
?>