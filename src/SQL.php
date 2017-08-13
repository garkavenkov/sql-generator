<?php

namespace Garkavenkov\SQLGenerator;

class SQL
{
    /**
     * Generate 'INSERT' SQL statement
     * @param  string $table  Table name for insert
     * @param  array  $fields Fields for insert
     * @param  arrey  $values Fields' values
     * @return string         SQL statement
     */
    public static function insert(string $table, array $fields, array $values = null): string
    {
        // Compare $fields and $values arrays for equality
        if (isset($values)) {
            if (count($values) !== count($fields)) {
                echo "Fields count is not equal to Values count!" . PHP_EOL;
                exit;
            }
        }

        // Generate SQL statement
        $sql  = "INSERT INTO `$table` (";
        $sql .= "`" . implode('`, `', $fields) . "`";
        $sql .= ") VALUES (";

        $sql_fields = '';
        if (!isset($values)) {
            // If $value array  is not set, generate prepared SQL statement
            foreach ($fields as $field) {
                $sql_fields .= ":$field, ";
            }
        } else {
            // Otherwise use $values fields' values
            foreach ($values as $field) {
                $sql_fields .= "'$field', ";
            }
        }
        $sql .= rtrim($sql_fields, ' ,') . ")";
        return $sql;
    }
}
