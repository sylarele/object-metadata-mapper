<?php

declare(strict_types=1);

namespace Sylarele\ObjectMetadataMapper\Helpers;

class Arr
{
    /**
     * Prepend the key names of an associative array.
     *
     * @param array<string, string> $array
     * @return array<string, string>
     */
    public static function prependKeysWith(array $array, string $prependWith): array
    {
        return static::mapWithKeys(
            $array,
            static fn ($item, string $key): array => [$prependWith.$key => $item]
        );
    }

    /**
     * Run an associative map over each of the items.
     *
     * The callback should return an associative array with a single key/value pair.
     *
     * @template TKey
     * @template TValue
     * @template TMapWithKeysKey of array-key
     * @template TMapWithKeysValue
     *
     * @param array<TKey, TValue> $array
     * @param callable(TValue, TKey): array<TMapWithKeysKey, TMapWithKeysValue> $callback
     *
     * @return array<TMapWithKeysKey, TMapWithKeysValue>
     */
    public static function mapWithKeys(array $array, callable $callback): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            $assoc = $callback($value, $key);

            foreach ($assoc as $mapKey => $mapValue) {
                $result[$mapKey] = $mapValue;
            }
        }

        return $result;
    }
}
