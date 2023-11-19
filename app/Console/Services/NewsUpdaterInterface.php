<?php

	namespace App\Console\Services;

	interface NewsUpdaterInterface
	{
		public function sendRequest($url, ?array $params);
		public function update();
	}