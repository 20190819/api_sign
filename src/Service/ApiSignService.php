<?php
/**
 * Created by phpstorm.
 * User: yangliang
 * Date: 2020/8/31 0031
 * Time: 16:14
 */

namespace Young\ApiSign\Service;


class ApiSignService implements ApiSign
{

    public static function getSecret(string $appid): string
    {
        if ($appid) {
            $secret = config("sign.{$appid}");
        }
        return $secret ?? null;
    }

    public static function create($appid, $timestamp): string
    {
        $secret = static::getSecret($appid);
        if ($secret) {
            $params = [
                '_y_appid' => $appid,
                '_y_expire' => $timestamp,
                '_y_secret' => $secret,
            ];
            ksort($params);
            $str = http_build_query($params);
            $signature = hash_hmac('sha1', $str, $secret, true);
            return md5(base64_encode($signature));
        } else {
            // todo
        }

    }

    public static function check($appid, $timestamp, $sign): bool
    {
        $local_sign = static::create($appid, $timestamp);
        return $local_sign == $sign;
    }
}
