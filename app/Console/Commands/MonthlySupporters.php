<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MonthlySupporters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MonthlySupporters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy Monthly Supporters to Donations Table.';

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
      $monthlies = \App\Monthly::all();

  		foreach ($monthlies as $monthly){
  			$donation = new \App\Donation;
  			$donation->user_id = $monthly->user_id;
  			$donation->first_name = $monthly->first_name;
        $donation->last_name = $monthly->last_name;
  			$donation->email = $monthly->email;
  			$donation->amount = $monthly->amount;
  			$donation->created_at = \Carbon\Carbon::now();
  			$donation->transaction_id = $monthly->customer_id;
  			$donation->category = 'M';
  			$donation->save();  			
  		}

    }
}
