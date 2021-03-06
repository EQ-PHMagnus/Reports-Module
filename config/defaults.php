<?php

return [
	'system-users' => ['finance user' ,'master cashier','finance admin'],
	'affiliates' => ['agent','super agent'],
	'agent_levels' => [1,2,3,4],
	'arena-status' => ['active', 'inactive'],
	'transcation_type' => ['cash_in','cash_out','earnings','loses'],
	'imports'	=> [
		1 => 'bets', 
		2 => 'fights'],
	'agent_deposit_status' => [
		'pending'	=> 1,
		'approved'	=> 2,
		'rejected'	=> 3],
	'transcation_status' => ['pending','approved','rejected','auto-generated'],
	'picks' => ['meron', 'walla','draw'],
	'bet_results' => ['waiting','defeated','winning'],
	'months' => [
		'January' => 0,
		'February' => 1,
		'March'	 => 2,
		'April'  => 3,
		'May'  => 4,
		'June'  => 5,
		'July'  => 6,
		'August'  => 7,
		'Septemeer'  => 8,
		'October'  => 9,
		'November'  => 10,
		'December'  => 11
	]
];