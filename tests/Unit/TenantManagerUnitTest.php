<?php

namespace Ringierimu\MultiTenancy\Tests\Unit;

use Ringierimu\MultiTenancy\Models\Tenant;
use Ringierimu\MultiTenancy\TenantManager;
use Ringierimu\MultiTenancy\Tests\TestCase;

/**
 * Class TenantManagerUnitTest
 * @package Ringierimu\MultiTenancy\Tests\Unit
 */
class TenantManagerUnitTest extends TestCase
{
    public function testItShouldReturnTenant()
    {
        /** @var Tenant $tenant */
        $tenant = factory(Tenant::class)->create();

        /** @var TenantManager $tenantManager */
        $tenantManager = app(TenantManager::class);
        $tenantManager->setTenant($tenant);

        $this->assertInstanceOf(Tenant::class, $tenantManager->getTenant());
    }

    public function testItShouldLoadTenantFromDomain()
    {
        factory(Tenant::class)->create();

        $domain = "tenant.test";
        $tenantManager = app(TenantManager::class);
        $this->assertTrue($tenantManager->loadTenant($domain));

        /** @var TenantManager $manager */
        $manager = app(TenantManager::class);

        $this->assertInstanceOf(Tenant::class, $manager->getTenant());
        $this->assertEquals($domain, $manager->getTenant()->domain);
    }

}