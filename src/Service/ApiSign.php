<?php

namespace Yang\ApiSign\Service;

interface ApiSign
{
    public static function getSecret(string $appid): string;

    public static function create(string $appid, int $timestamp): string;

    public static function check(string $appid, int $timestamp, string $sign): bool;

}
