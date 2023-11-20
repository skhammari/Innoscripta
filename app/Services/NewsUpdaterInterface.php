<?php

	namespace App\Services;

	interface NewsUpdaterInterface
	{
		public function sendRequest($url, ?array $params);
		public function update();
	}