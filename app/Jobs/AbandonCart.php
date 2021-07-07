<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\AbandonedCart;


class AbandonCart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

      public $user;


      public $carts;

    
    public function __construct($carts, $user)
    {
        $this->carts = $carts;

        $this->user = $user;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         
		\Mail::to("jacob.atam@gmail.com")
        ->send(new AbandonedCart($this->carts, $this->user));
    }
}
