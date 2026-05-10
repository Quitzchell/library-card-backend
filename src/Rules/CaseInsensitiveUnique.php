<?php

namespace Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use function App\Rules\blank;

class CaseInsensitiveUnique implements ValidationRule
{
    /**
     * @param  class-string<Model>  $model
     * @param  array<string, string|null>  $columns  Extra column => value pairs to scope the uniqueness check.
     */
    public function __construct(
        protected string $model,
        protected array $columns = [],
        protected ?Model $ignore = null,
        protected ?string $message = null,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (blank($value)) {
            return;
        }

        foreach ($this->columns as $columnValue) {
            if (blank($columnValue)) {
                return;
            }
        }

        $column = Str::afterLast($attribute, '.');

        $query = $this->model::query()
            ->whereRaw($this->lowerEquals($column), [Str::lower((string) $value)]);

        foreach ($this->columns as $column => $columnValue) {
            $query->whereRaw($this->lowerEquals($column), [Str::lower((string) $columnValue)]);
        }

        if ($this->ignore) {
            $query->whereKeyNot($this->ignore->getKey());
        }

        if ($query->exists()) {
            $fail($this->message ?? "The {$attribute} (combined with related fields) is already taken.");
        }
    }

    private function lowerEquals(string $column): string
    {
        if (! preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $column)) {
            throw new \InvalidArgumentException("Invalid column name: {$column}");
        }

        return "LOWER({$column}) = ?";
    }
}
