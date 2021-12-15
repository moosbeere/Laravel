<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Articles;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $article;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Articles $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $testMail = new TestMail('Для статьи "'.$this->article->name.'" создан новый комментарий. Ожидает модерации.');
        Mail::send($testMail);
    }
}
