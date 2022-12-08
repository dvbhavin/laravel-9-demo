<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Response;

class GenerateCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:generate {no_of_rows}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $noOfRows = $this->argument('no_of_rows');
        $result=$this->export($noOfRows);
        if ($result == true) {
            echo "File succssfully generated in public directory.";
        }else{
            echo $result;
        }
    }
    public function export($noOfRows)
    {
        $fileName = "Sample-Data.csv";
        $path = public_path() . "/";
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('id', 'name', 'email', 'school', 'class', 'total_score', 'address', 'phone_no');
        $faker = Faker::create();
        try {
            $file = fopen($path . $fileName, 'w');
            fputcsv($file, $columns);
            foreach (range(1,  $noOfRows) as $index) {
                $row['Id']  = $index;
                $row['Name']  =  $faker->name();
                $row['Email']  = $faker->email();
                $row['School']  = $faker->name();
                $row['Class']  = $faker->name(2);
                $row['Total-Score']  = $faker->numberBetween(0, 100);
                $row['Address']  = $faker->sentence(4, true);
                $row['Phone-No']  = $faker->numerify('##########');
                fputcsv($file, array($row['Id'], $row['Name'], $row['Email'], $row['School'], $row['Class'], $row['Total-Score'], $row['Address'], $row['Phone-No']));
            }
            fclose($file);
            return true;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
