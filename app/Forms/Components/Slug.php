<?php

declare(strict_types=1);

namespace App\Forms\Components;

use Illuminate\Support\Str;
use Filament\Forms\Components\Field;

final class Slug extends Field
{
    protected string $view = 'forms.components.slug';

    protected ?int $minLength = null;

    protected ?int $maxLength = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(function (Slug $component, $state) {
            $component->id($component->getIdAttribute());
        });
    }

    public function getValue(): string
    {
        $value = parent::getValue();

        return Str::slug($value);
    }

    public function getIdAttribute(): string
    {
        return 'slug-'.Str::slug($this->getLabel());
    }

    public function minLength(int $length): static
    {
        $this->minLength = $length;
        $this->rule('min:'.$length);

        return $this;
    }

    public function maxLength(int $length): static
    {
        $this->maxLength = $length;
        $this->rule('max:'.$length);

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
