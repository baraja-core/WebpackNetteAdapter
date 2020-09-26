<?php

declare(strict_types = 1);

namespace Oops\WebpackNetteAdapter;

use Oops\WebpackNetteAdapter\Utils\DevServerUtils;


class DevServer
{

	/**
	 * @var bool
	 */
	private $enabled;

	/**
	 * @var bool
	 */
	private $available;

	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var ?string
	 */
	private $publicUrl;

	/**
	 * @var float
	 */
	private $timeout;


	public function __construct(bool $enabled, string $url, ?string $publicUrl, float $timeout)
	{
		$this->enabled = $enabled;
		$this->url = $url;
		$this->publicUrl = $publicUrl;
		$this->timeout = $timeout;
	}


	public function getUrl(): string
	{
		return $this->publicUrl ?? $this->url;
	}


	public function getInternalUrl(): string
	{
		return $this->url;
	}


	public function isEnabled(): bool
	{
		return $this->enabled;
	}


	public function isAvailable(): bool
	{
		if ( ! $this->isEnabled()) {
			return FALSE;
		}

		if ($this->available === NULL) {
			$this->available = DevServerUtils::isAvailable($this->url, $this->timeout);
		}

		return $this->available;
	}

}
