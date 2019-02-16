<?php
declare(strict_types = 1);
namespace Scarab\Common;

final class Uuid {
    private function __construct() {
    }

    public static function v4(): string {
        $bytes = \random_bytes(16);
        $bytes[6] = \chr(\ord($bytes[6]) & 0x0F | 0x40);
        $bytes[8] = \chr(\ord($bytes[8]) & 0x3F | 0x80);
        $quads = \str_split(\bin2hex($bytes), 4);
        return \vsprintf('%s%s-%s-%s-%s-%s%s%s', $quads);
    }
}
