<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Pusher\Pusher;

class ProductStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Product Status';
    protected $commands = [
        ProductStatus::class,
    ];
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
     * @return mixed
     */
    public function handle()
    {
        $countProduct = DB::table('san_phams')->count();

        if (Session::get('countProduct') < $countProduct){
            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher(
                '89d24c458f84fee2b970',
                'c7a6a712e9a4ac0463f1',
                '567170',
                $options
            );
            $data['message'] = $countProduct;
            $pusher->trigger('my-channel', 'my-event', $data);
            Session::forget('countProduct');
            // return 'end if';
        }
        // return 'end';
    }
}
