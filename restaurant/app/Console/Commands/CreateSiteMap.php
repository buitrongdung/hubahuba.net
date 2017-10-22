<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

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
     * @return mixed
     */
    public function handle()
    {
        // add bài viết
        $posts = \DB::table('news')
                ->orderBy('created_at', 'desc')
                ->get();
        foreach ($posts as $post) {
                $sitemap->add(route('getDetailNews', [$post->slug]), $post->created_at, '0.6', 'daily');
        }

        // lưu file và phân quyền
        $sitemap->store('xml', 'sitemap');
        if (File::exists(public_path() . '/sitemap.xml')) {
                chmod(public_path() . '/sitemap.xml', 0777);
        }
    }
}
