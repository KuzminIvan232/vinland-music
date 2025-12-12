<?php

function generateUUIDv4(): string {
    $data = random_bytes(16);
    // Версія 4 (random)
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
    // Варіант RFC 4122
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}