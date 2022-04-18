<?php

namespace App\Console\Commands;

use App\Helpers\Libraries\RedisQueueLib;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InsertPostLike extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:like';

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
        $arr= RedisQueueLib::getArrayQueue(env("QUEUE_LIKE"));

        foreach ($arr as $item){
            $data = json_decode($item["data"],TRUE);
            $cases[] = " WHEN {$data["post_id"]} then `like` + 1";
        }
        $new = implode(' ', $cases);
        DB::update("UPDATE posts SET `like` = CASE `id` {$new} ELSE `like` END");

        return 0;
    }
}
