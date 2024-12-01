<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;
use Illuminate\Support\Str;

class Slug extends Field
{
    protected string $view = 'forms.components.slug';
    protected ?int $minLength = null;
    protected ?int $maxLength = null;

    public function getValue(): string
    {
        $value = parent::getValue();

        return Str::slug($value);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(function (Slug $component, $state) {
            $component->id($component->getIdAttribute());
        });
    }

    public function getIdAttribute(): string
    {
        return 'slug-' . Str::slug($this->getLabel());
    }

    public function minLength(int $length): static
    {
        $this->minLength = $length;
        $this->rule('min:' . $length);
        return $this;
    }

    public function maxLength(int $length): static
    {
        $this->maxLength = $length;
        $this->rule('max:' . $length);
        return $this;
    }

    public function getMinLength(): ?int
    {
        return $this->minLength;
    }

    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }
}
