<?php

namespace App\Jobs;

use App\Utils\GenealogyDataManagerInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BrowseGenealogy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 300;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    protected $folder, $file_name, $format;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($folder = '/var/www/', $file_name = 'gnl_testing_user_level_update', $format = 'json')
    {
        $this->folder = $folder;
        $this->file_name = $file_name;
        $this->format = $format;
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addSeconds(300);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(GenealogyDataManagerInterface $genealogyManager)
    {
        $logs = $genealogyManager->browseAllGenalogy();
        file_put_contents("{$this->folder}{$this->file_name}.{$this->format}", json_encode($logs));
    }
}
