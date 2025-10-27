<?php

namespace SaKanjo\EasyMetrics\Enums;

use Carbon\CarbonImmutable;

enum Range: string
{
    case TODAY = 'TODAY';
    case YESTERDAY = 'YESTERDAY';
    case MTD = 'MTD';
    case QTD = 'QTD';
    case YTD = 'YTD';
    case ALL = 'ALL';

    public function getPreviousRange(CarbonImmutable $date): ?array
    {
        return match ($this) {
            Range::TODAY => [
                $date->subDay()->startOfDay(),
                $date->subDay(),
            ],
            Range::YESTERDAY => [
                $date->subDays(2)->startOfDay(),
                $date->subDays(2),
            ],
            Range::MTD => [
                $date->subMonthWithoutOverflow()->startOfMonth(),
                $date->subMonthWithoutOverflow(),
            ],
            Range::QTD => [
                $date->subQuarter()->startOfQuarter(),
                $date->subQuarter(),
            ],
            Range::YTD => [
                $date->subYear()->startOfYear(),
                $date->subYear(),
            ],
            Range::ALL => null,
        };
    }

    public function getRange(CarbonImmutable $date): ?array
    {
        return match ($this) {
            Range::TODAY => [
                $date->startOfDay(),
                $date,
            ],
            Range::YESTERDAY => [
                $date->subDay()->startOfDay(),
                $date->subDay(),
            ],
            Range::MTD => [
                $date->startOfMonth(),
                $date,
            ],
            Range::QTD => [
                $date->startOfQuarter(),
                $date,
            ],
            Range::YTD => [
                $date->startOfYear(),
                $date,
            ],
            Range::ALL => null,
        };
    }
}
