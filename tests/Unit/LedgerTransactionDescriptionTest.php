<?php

namespace Tests\Unit;

use App\Utils\TransactionUtil;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class LedgerTransactionDescriptionTest extends TestCase
{
    /** @dataProvider descriptions */
    public function test_sale_custom_field_is_added_only_to_format_one($type, $format, $notes, $field, $expected)
    {
        $class = new ReflectionClass(TransactionUtil::class);
        $method = $class->getMethod('getLedgerTransactionDescription');
        $method->setAccessible(true);
        $transaction = (object) ['type' => $type, 'additional_notes' => $notes, 'custom_field_7' => $field];

        $this->assertSame($expected, $method->invoke($class->newInstanceWithoutConstructor(), $transaction, $format));
    }

    public static function descriptions(): array
    {
        return [
            ['sell', 'format_1', null, 'Delivery details', 'Delivery details'],
            ['sell', 'format_1', 'Sale note', 'Delivery details', 'Sale note<br>Delivery details'],
            ['sell', 'format_1', '', "<script>alert(1)</script>\nA & B", "&lt;script&gt;alert(1)&lt;/script&gt;<br />\nA &amp; B"],
            ['sell', 'format_1', 'Sale note', ' ', 'Sale note'],
            ['sell', 'format_1', null, '0', '0'],
            ['purchase', 'format_1', 'Purchase note', 'Other details', 'Purchase note'],
            ['sell', 'format_4', 'Sale note', 'Other details', 'Sale note'],
        ];
    }
}
