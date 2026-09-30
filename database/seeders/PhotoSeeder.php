<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    public function run(): void
    {
        $photos = [
            ['image' => '/images/gallery/foto-01.jpg', 'category' => 'Portrait', 'exif' => 'f/2.8 · 50mm', 'sort' => 0],
            ['image' => '/images/gallery/foto-02.jpg', 'category' => 'Portrait', 'exif' => 'f/2.8 · 50mm', 'sort' => 1],
            ['image' => '/images/gallery/foto-03.jpg', 'category' => 'Yudisium', 'exif' => 'long exposure · spin blur', 'sort' => 2],
            ['image' => '/images/gallery/foto-04.jpg', 'category' => 'Yudisium', 'exif' => 'long exposure · spin blur', 'sort' => 3],
            ['image' => '/images/gallery/foto-05.jpg', 'category' => 'Yudisium', 'exif' => 'long exposure · spin blur', 'sort' => 4],
            ['image' => '/images/gallery/foto-06.jpg', 'category' => 'Yudisium', 'exif' => 'ISO 3200 · 1/60', 'sort' => 5],
            ['image' => '/images/gallery/foto-07.jpg', 'category' => 'Yudisium', 'exif' => 'golden hour · f/4', 'sort' => 6],
            ['image' => '/images/gallery/foto-08.jpg', 'category' => 'Landscape', 'exif' => 'f/8 · silhouette', 'sort' => 7],
            ['image' => '/images/gallery/foto-09.jpg', 'category' => 'Landscape', 'exif' => 'f/5.6 · wide angle', 'sort' => 8],
            ['image' => '/images/gallery/foto-10.jpg', 'category' => 'Yudisium', 'exif' => 'ISO 1600 · f/2.8', 'sort' => 9],
            ['image' => '/images/gallery/foto-11.jpg', 'category' => 'Yudisium', 'exif' => 'ISO 2000 · 1/80', 'sort' => 10],
            ['image' => '/images/gallery/foto-12.jpg', 'category' => 'Wisuda', 'exif' => 'f/1.8 · 50mm', 'sort' => 11],
            ['image' => '/images/gallery/foto-13.jpg', 'category' => 'Wisuda', 'exif' => 'f/2 · natural light', 'sort' => 12],
            ['image' => '/images/gallery/foto-14.jpg', 'category' => 'Wisuda', 'exif' => 'gel lighting · purple', 'sort' => 13],
            ['image' => '/images/gallery/foto-15.jpg', 'category' => 'Wisuda', 'exif' => 'f/2.8 · blue hour', 'sort' => 14],
            ['image' => '/images/gallery/foto-16.jpg', 'category' => 'Wisuda', 'exif' => 'f/2 · architectural', 'sort' => 15],
            ['image' => '/images/gallery/foto-17.jpg', 'category' => 'Wisuda', 'exif' => 'f/2.5 · poolside', 'sort' => 16],
            ['image' => '/images/gallery/foto-18.jpg', 'category' => 'Wisuda', 'exif' => 'f/2 · candid', 'sort' => 17],
            ['image' => '/images/gallery/foto-19.jpg', 'category' => 'Wisuda', 'exif' => 'f/1.8 · low angle', 'sort' => 18],
            ['image' => '/images/gallery/foto-20.jpg', 'category' => 'Wisuda', 'exif' => 'f/2.2 · studio blue', 'sort' => 19],
            ['image' => '/images/gallery/foto-21.jpg', 'category' => 'Wisuda', 'exif' => 'f/2.2 · studio blue', 'sort' => 20],
            ['image' => '/images/gallery/foto-22.jpg', 'category' => 'Wisuda', 'exif' => 'f/2.5 · staircase', 'sort' => 21],
        ];

        foreach ($photos as $photo) {
            Photo::updateOrCreate(
                ['image' => $photo['image']],
                $photo
            );
        }
    }
}
