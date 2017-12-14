<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $series = \CodeFlix\Models\Serie::all();
        $categories = \CodeFlix\Models\Category::all();
        $repository = app(\CodeFlix\Contracts\Repositories\VideoRepository::class);
        $collectionThumbs = $this->getThumbs();
        factory(\CodeFlix\Models\Video::class, 70)
            ->create()
            ->each(function($video) use ($series, $categories, $repository, $collectionThumbs){
                $repository->uploadThumb($video->id, $collectionThumbs->random());
                $video->categories()->attach($categories->random(4)->pluck('id'));
                $num = rand(1, 3);
                if($num % 2 == 0) {
                    $serie = $series->random();
                    $video->serie()->associate($serie);
                    $video->save();
                }
            });
    }

    protected function getThumbs()
    {
        return new \Illuminate\Support\Collection([
            new \Illuminate\Http\UploadedFile(storage_path('app/files/faker/thumbs/thumb.jpg'), 'thumb.jpg')
        ]);
    }
}
