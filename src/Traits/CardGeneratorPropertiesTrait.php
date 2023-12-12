<?php

declare(strict_types=1);

namespace App\Traits;

use App\Entity\Card;
use App\Enums\Color;
use App\Enums\GlobalSortedCardKeys;
use App\Enums\Value;

trait CardGeneratorPropertiesTrait
{
    /**
     * @var array<string>
     */
    protected array $colors;

    /**
     * @var array<string>
     */
    protected array $values;

    public function __construct()
    {
        $this->colors = Color::strings();
        $this->values = Value::strings();
    }
}
