<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-aurarouter for the canonical source repository
 * @copyright Copyright (c) 2018 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-aurarouter/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace ZendTest\Expressive\Router\AuraRouter;

use PHPUnit\Framework\TestCase;
use Zend\Expressive\Router\AuraRouter;
use Zend\Expressive\Router\AuraRouter\ConfigProvider;
use Zend\Expressive\Router\RouterInterface;

class ConfigProviderTest extends TestCase
{
    /**
     * @var ConfigProvider
     */
    private $provider;

    protected function setUp() : void
    {
        $this->provider = new ConfigProvider();
    }

    public function testInvocationReturnsArray() : array
    {
        $config = ($this->provider)();
        $this->assertInternalType('array', $config);

        return $config;
    }

    /**
     * @depends testInvocationReturnsArray
     */
    public function testReturnedArrayContainsDependencies(array $config) : void
    {
        $this->assertArrayHasKey('dependencies', $config);
        $this->assertInternalType('array', $config['dependencies']);

        $this->assertArrayHasKey('aliases', $config['dependencies']);
        $this->assertInternalType('array', $config['dependencies']['aliases']);
        $this->assertArrayHasKey(RouterInterface::class, $config['dependencies']['aliases']);

        $this->assertArrayHasKey('invokables', $config['dependencies']);
        $this->assertInternalType('array', $config['dependencies']['invokables']);
        $this->assertArrayHasKey(AuraRouter::class, $config['dependencies']['invokables']);
    }
}
