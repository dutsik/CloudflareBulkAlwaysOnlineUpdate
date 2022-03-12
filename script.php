<?php

require_once  __DIR__ .'/vendor/autoload.php';
require_once __DIR__ .'/creds.php';


$key     = new Cloudflare\API\Auth\APIKey($authemail, $authkey);
$adapter = new Cloudflare\API\Adapter\Guzzle($key);

$page = 0;
$i = 1;
$query = [
    'per_page' => 50,
    'match' => 'all',
    'account.id'=> $accountId
];
do{
    $query["page"] = ++$page;
    $response = $adapter->get('zones/',$query);
    $zoness = json_decode($response->getBody());
    foreach ($zoness->result as $zone) {
        echo $i++ . ' ' . $zone->name.' ('.$zone->plan->name.')'.PHP_EOL;
        $response = $adapter->get('zones/'. $zone->id . '/settings/always_online');
        $alwaysOnlineSetting = json_decode($response->getBody());
        if($alwaysOnlineSetting->result->value === 'on') {
            $response = $adapter->patch('zones/'. $zone->id . '/settings/always_online',
            [
                'v2'=> 'on',
                'value' => 'on'
            ]);
        }
    }
}while($zoness->result_info->total_pages > $page);


