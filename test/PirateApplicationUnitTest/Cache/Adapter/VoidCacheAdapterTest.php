<?php declare(strict_types=1);

namespace PirateApplicationUnitTest\Cache\Adapter;

use PirateApplication\Cache\Adapter\VoidCacheAdapter;
use PHPUnit\Framework\TestCase;

class VoidCacheAdapterTest extends TestCase
{
    public function testAdapterSimpleBehaviour(): void
    {
        $adapter = new VoidCacheAdapter();

        // Should always get the default value
        TestCase::assertEquals($adapter->get('non-existent-key', 'default-value'), 'default-value');

        // Void methods that always should return true
        TestCase::assertTrue($adapter->set('key', 'value'));
        TestCase::assertTrue($adapter->delete('key'));
        TestCase::assertTrue($adapter->clear());
        TestCase::assertTrue($adapter->setMultiple([]));
        TestCase::assertTrue($adapter->deleteMultiple([]));

        // Get multiple test
        TestCase::assertEquals(
            [
                1 => 'test',
                2 => 'test',
                3 => 'test',
            ],
            $adapter->getMultiple([1, 2, 3], 'test')
        );

        // the method has will always return false because this is a non-functional feature wise replacement of Cache
        TestCase::assertFalse($adapter->has('anykey'));
    }
}
