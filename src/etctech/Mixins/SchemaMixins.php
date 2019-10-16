<?php

namespace etctech\OverallHelper\Mixins;

use Closure;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ShcemaMixins
{

    /**
     * Check have table but no column
     */
    public function hasTableButNoColumn(): Closure
    {
        return function (string $table_name, string $column) {
            return (Schema::hasTable($table_name) && !Schema::hasColumn($column));
        };
    }

    /**
     * Check have table and column
     */
    public function hasTableAndColumn(): Closure
    {
        return function (string $table_name, string $column) {
            return (Schema::hasTable($table_name) && Schema::hasColumn($column));
        };
    }

    /**
     * Create table if not exists
     */
    public function createTableIfNotExists(): Closure
    {
        return function (string $table_name, $callback) {
            if (!Schema::hasTable($table_name)) {
                Schema::create($table_name, $callback);
            }
        };
    }

    /**
     * Add Column if not exists
     */
    public function addColumnIfNotExists(): Closure
    {
        return function (string $table_name, string $column, $callback) {
            if (Schema::hasTableButNoColumn($table_name, $column)) {
                Schema::table($table_name, $callback);
            }
        };
    }

    /**
     * Drop Columns if exists
     */
    public function dropColumnsIfExists(): Closure
    {
        return function (string $table_name, array $columns) {
            if (Schema::hasTable($table_name)) {

                $columns_to_drop = [];

                foreach ($columns as $column) {
                    if (Schema::hasTableAndColumn($table_name, $column)) {
                        array_push($columns_to_drop, $column);
                    }
                }

                if (!empty($columns_to_drop)) {
                    Schema::table($table_name, function (Blueprint $table) use ($columns_to_drop) {
                        $table->dropColumn($columns_to_drop);
                    });
                }
            }
        };
    }
}
