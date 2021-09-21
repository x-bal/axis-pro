<?php

namespace App\Console\Commands;

use App\Models\CaseList;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ReportSatuCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reportsatu:limit';

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
        $caseLists = CaseList::get();

        foreach ($caseLists as $case) {
            $limit = Carbon::parse($case->ia_limit)->format('Ymd');
            $date = Carbon::now()->format('Ymd');

            if ($case->ia_status == 0) {
                if ($date > $limit) {
                    Mail::raw("This is automatically generated Reminder", function ($message) use ($case) {
                        $message->from('axis-pro@gmail.com');
                        $message->to($case->adjuster->email)->subject('Reminder');
                    });
                }
            }
        }
        $this->info('Reminder has been send successfully');
    }
}
