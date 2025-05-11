<?php

namespace App\Console\Commands\Address;

use App\Models\City;
use App\Models\Region;
use Illuminate\Console\Command;

class AddressImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:address-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '匯入地區';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = __DIR__.'/city_region.csv';

        if (!file_exists($filePath) || !is_readable($filePath)) {
            $this->error('The file does not exist or is not readable.');
            return;
        }

        $header = null;
        $data = [];
        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row; // First row as header
                } else {
                    $data[] = $row; // Combine header with row data
                }
            }
            fclose($handle);
        }
        $addressData = [];
        foreach ($data as $item) {
            $addressData[] = [
                "zipcode" => $item[0],
                "city" => mb_substr($item[1], 0, 3),
                "region" => mb_substr($item[1], 3,100),
            ];
        }
        //
        foreach ($addressData as $item) {
            //
            $city = City::where("name", $item["city"])->firstOrNew();
            $city->name = $item["city"];
            $city->save();
            //
            $region = new Region();
            $region->city_id = $city->id;
            $region->name = $item["region"];
            $region->zipcode = $item["zipcode"];
            $region->save();
        }
    }
}
