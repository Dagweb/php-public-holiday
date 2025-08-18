<?php

declare(strict_types=1);

namespace Dagweb\PhpPublicHoliday\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Metadata\Api\DataProvider;

abstract class AbstractTestCase extends TestCase
{
    /**
     * @return array<string, array<array-key, mixed>>
     */
    public static function getJsonDataProvider(): array
    {
        // Waiting for PHPUnit to implement test name injection in DataProvider Attribute
        static::assertEmpty(func_get_args());
        $testMethodName = self::getTestName();

        $reflectionTestClass = new \ReflectionClass(static::class);
        $testDirectory = dirname($reflectionTestClass->getFileName());
        $dataProviderFilePath = "$testDirectory/Provider/{$reflectionTestClass->getShortName()}/$testMethodName.json";

        static::assertFileExists($dataProviderFilePath, "JSON provider test file does not exist for test {$reflectionTestClass->getShortName()}::$testMethodName");
        $file = \file_get_contents($dataProviderFilePath);
        static::assertNotFalse($file, "Unable to read JSON provider test file for test {$reflectionTestClass->getShortName()}::$testMethodName");
        $data = \json_decode($file, true);
        static::assertNotNull($data, "Unable to decode JSON provider test file for test {$reflectionTestClass->getShortName()}::$testMethodName");

        return $data;
    }

    /**
     * Temporary Method used as workaround for DataProvider Attribute.
     */
    private static function getTestName(): string
    {
        $testClass = static::class;

        /** @var array{file: string, line: int, function: string, class: class-string, object: ?object, type: string, args: array} $backTrace */
        $backTrace = debug_backtrace();

        foreach ($backTrace as $trace) {
            if (
                DataProvider::class === $trace['class']
                && 'providedData' === $trace['function']
                && 2 === count($trace['args'])
                && isset($trace['args'][0]) && $trace['args'][0] === $testClass
                && isset($trace['args'][1]) && is_string($trace['args'][1])
            ) {
                assert(method_exists($testClass, $trace['args'][1]));

                return $trace['args'][1];
            }
        }

        throw new \AssertionError('Unable to retrieve test name');
    }
}
