<?php

namespace Softlogo\CustomerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SoftlogoCustomerBundle extends Bundle
{
	public function getParent()
	{
		return "ApplicationSonataUserBundle";
	}
}
