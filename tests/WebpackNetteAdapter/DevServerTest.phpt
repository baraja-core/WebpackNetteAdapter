<?php

declare(strict_types = 1);

namespace OopsTests\WebpackNetteAdapter;

use Oops\WebpackNetteAdapter\DevServer;
use Oops\WebpackNetteAdapter\Utils\DevServerUtils;
use Tester\Assert;
use Tester\TestCase;


require_once __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class DevServerTest extends TestCase
{

	public function testDevServer(): void
	{
		$devServer = new DevServer(TRUE, 'http://localhost:3000', NULL, 0.1);
		Assert::true($devServer->isEnabled());
		Assert::same($devServer->getUrl(), 'http://localhost:3000');
		Assert::same($devServer->getInternalUrl(), 'http://localhost:3000');

		DevServerUtils::mock('http://localhost:3000', 0.1, true);
		Assert::true($devServer->isAvailable());
	}


	public function testPublicUrl(): void
	{
	    $devServer = new DevServer(TRUE, 'http://localhost:3000', 'http://localhost:3030', 0.1);
	    Assert::true($devServer->isEnabled());
		Assert::same($devServer->getUrl(), 'http://localhost:3030');
		Assert::same($devServer->getInternalUrl(), 'http://localhost:3000');

		DevServerUtils::mock('http://localhost:3000', 0.1, true);
        Assert::true($devServer->isAvailable());
	}


	public function testUnavailable(): void
	{
		$devServer = new DevServer(TRUE, 'http://localhost:3000', NULL, 0.5);
		Assert::true($devServer->isEnabled());

		DevServerUtils::mock('http://localhost:3000', 0.5, false);
		Assert::false($devServer->isAvailable());
	}


	public function testDisabled(): void
	{
		$devServer = new DevServer(FALSE, 'http://localhost:3000', NULL, 0.1);
		Assert::false($devServer->isEnabled());
		Assert::false($devServer->isAvailable());
	}

}


(new DevServerTest())->run();
