<?php

namespace App\Console\Commands;

use App\Models\Batch;
use App\Models\Trainee;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateTraineesStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trainees:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update trainees status to completed after 10 days from batch start date';

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
        Log::info('cron job started');
        $batches = Batch::get();
        //dd($batches->toArray());
        foreach ($batches as $batch){
            // Calculate the date after 10 days from the batch start date
            $batchStartDate= $batch->batch_start_date;
            $batchId= $batch->batch;
            $user_id= $batch->user_id;
            $completionDate = Carbon::parse($batchStartDate);
            //$completionDate = Carbon::parse($batchStartDate)->addDays(10);

            // Check if the current date is equal to or greater than the completion date
            if (Carbon::now()->greaterThanOrEqualTo($completionDate)) {
                // Update trainees' status to "completed" for the given batch
                Trainee::where('batch', $batchId)->whereHas('lab', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->update(['status' => 1]);
            }
        }
        dd('passed');
    }
}
