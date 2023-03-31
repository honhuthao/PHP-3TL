<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductStatus extends Enum
{
    const PUBLISHED = 0;
    const DRAFT = 1;
    const ARCHIVED = 2;
}
