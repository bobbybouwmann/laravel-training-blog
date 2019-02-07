<?php

namespace App\Console\Commands;

use App\Mail\NewsLetter;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class WeeklyNewsLetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a news letter to all users with a summary of all published posts last week.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $now = Carbon::today();

        $users = User::all();
        $posts = Post::published()
            ->whereBetween('published_at', [$now->copy()->subWeek(), $now])
            ->get();

        $this->info(sprintf('Found %d posts that have been published last week', $posts->count()));
        $this->info(sprintf('Sending %d emails...', $users->count()));

        foreach ($users as $user) {
            Mail::to($user)->send(new NewsLetter($posts));
        }

        $this->info('Newsletter dispatched :tada:');
    }
}
