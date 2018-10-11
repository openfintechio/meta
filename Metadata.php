<?php
declare(strict_types=1);

namespace Oft\Provider;


final class Metadata
{
    private static $cache = [];

    public static function getResourceMetadata(string $resourceType, string $resourceCode)
    {
        if (false === self::metadataExists($resourceType, $resourceCode)) {
            throw new \RuntimeException(
                sprintf('Resource with type %s and code %s not found.', $resourceType, $resourceCode)
            );
        }

        $data = self::loadData($resourceType);

        return $data[$resourceCode];
    }

    public static function metadataExists(string $resourceType, string $resourceCode): bool
    {
        $data = self::loadData($resourceType);

        return array_key_exists($resourceCode, $data);
    }

    private static function loadData(string $resourceType): array
    {
        if (false === array_key_exists($resourceType, self::$cache)) {
            $path = __DIR__ . '/data/' . $resourceType . '.json';

            if (false === file_exists($path)) {
                throw new \RuntimeException('Resource does not exist.');
            }

            self::$cache[$resourceType] = json_decode(file_get_contents($path), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \RuntimeException('Malformed json data provided.');
            }
        }

        return self::$cache[$resourceType];
    }
}