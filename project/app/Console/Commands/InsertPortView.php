<?php

namespace App\Console\Commands;

use App\Helpers\Libraries\RedisQueueLib;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InsertPortView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $arr= RedisQueueLib::getArrayQueue(env("QUEUE_VIEW"));
        $dataArray=array();
        foreach ($arr as $item){
            $data = json_decode($item["data"],TRUE);
            array_push($dataArray,$data);
            $cases[] = " WHEN {$data["post_id"]} then `view` + 1";
        }
        $new = implode(' ', $cases);
        DB::update("UPDATE posts SET `view` = CASE `id` {$new} ELSE `view` END");
        DB::table('post_views')->insert($dataArray);
        return 0;
    }
}
