<?php

namespace AuroraWebSoftware\AIssue\Commands;

use Illuminate\Console\Command;

class AIssueCommand extends Command
{
    public $signature = 'aissue';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
