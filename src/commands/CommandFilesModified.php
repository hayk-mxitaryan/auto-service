<?php

namespace HaykMxitaryan\AutoService\commands;

use HaykMxitaryan\AutoService\DirectoryService;
use HaykMxitaryan\AutoService\FileCreators\CreateArgvInput;
use HaykMxitaryan\AutoService\FileCreators\CreateCommandFinished;
use Illuminate\Console\Command;

class CommandFilesModified extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto-service:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modifying command files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // modifying command files (Command finished, ArgvInput) by deleting and writing new updated files

        DirectoryService::modify(new CreateCommandFinished(),new CreateArgvInput());

        $this->comment("Auto service was added successfully");

        return 0;
    }
}
