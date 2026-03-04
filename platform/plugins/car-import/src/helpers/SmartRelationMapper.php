<?php

namespace Botble\CarImport\Helpers;

use Illuminate\Database\Eloquent\Model;

class SmartRelationMapper
{
    /**
     * Map single name to ID (create if missing)
     */
    public static function mapSingle(string $modelClass, ?string $name)
    {
        if (empty($name)) {
            return null;
        }

        /** @var Model $record */
        $record = $modelClass::firstOrCreate([
            'name' => trim($name),
        ]);

        return $record->id;
    }

    /**
     * Map multiple names (pipe-separated) to IDs array
     */
    public static function mapMultiple(string $model, ?string $names): array
    {
        if (empty($names)) {
            return [];
        }

        $namesArray = explode('|', $names);

        $ids = [];

        foreach ($namesArray as $name) {
            $name = trim($name);
            if ($name === '') continue;

            $record = $model::firstOrCreate(['name' => $name]);
            $ids[] = $record->id;
        }

        return $ids;
    }
}