<?php
declare(strict_types=1);

namespace MovieTicketFee\Customer;

use MyCLabs\Enum\Enum;

/**
 * 持ち物
 *
 * @method static self NONE()
 * @method static self MEMBER_CARD()
 * @method static self IDENTIFICATION()
 * @method static self STUDENT_CARD()
 * @method static self STUDENT_NOTEBOOK()
 * @method static self DISABILITY_CERTIFICATE()
 */
class Belongings extends Enum
{
    private const NONE = 'none';
    private const MEMBER_CARD = 'member_card';
    private const IDENTIFICATION = 'identification';
    private const STUDENT_CARD = 'student_card';
    private const STUDENT_NOTEBOOK = 'student_notebook';
    private const DISABILITY_CERTIFICATE = 'disability_certificate';
}
