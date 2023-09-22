<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum StatusItem: string implements HasLabel, HasColor, HasIcon
{
    case Accepted = 'Accepted';
    case Reject = 'Reject';
    case Use_as_is = 'Use as is';
    case Waiting = 'Waiting';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Accepted => 'Accepted',
            self::Reject => 'Reject',
            self::Use_as_is => 'Use as is',
            self::Waiting => 'Waiting',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Accepted => 'success',
            self::Reject => 'danger',
            self::Use_as_is => 'warning',
            self::Waiting => 'gray',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Accepted => 'heroicon-m-check',
            self::Reject => 'heroicon-m-no-symbol',
            self::Use_as_is => 'heroicon-m-exclamation-triangle',
            self::Waiting => 'heroicon-m-clock',
        };
    }
}
