<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Cafe Posttropis',
                'slug' => 'cafe-posttropis',
                'description' => 'Website untuk cafe Posttropis, menampilkan menu dan informasi toko secara online.',
                'tech_stack' => ['React', 'Node.js', 'PostgreSQL', 'Tailwind'],
                'thumbnail' => '/images/projects/cafe.jpeg',
                'demo_url' => 'https://posttropis.store/',
                'repo_url' => null,
                'is_featured' => true,
            ],
            [
                'title' => 'Web Desa Lompo Tengah',
                'slug' => 'web-desa-lompo-tengah',
                'description' => 'Website profil dan informasi resmi Desa Lompo Tengah.',
                'tech_stack' => ['React', 'Node.js', 'PostgreSQL', 'Tailwind'],
                'thumbnail' => '/images/projects/desa.jpeg',
                'demo_url' => 'https://desalompotengah.site/',
                'repo_url' => null,
                'is_featured' => true,
            ],
            [
                'title' => 'Portal Pelayanan Publik',
                'slug' => 'portal-pelayanan-publik',
                'description' => 'Memotong rantai birokrasi konvensional. Urus berkas administrasi persuratan secara mandiri melalui sistem online tanpa perlu datang bolak-balik hanya untuk menanyakan persyaratan.',
                'tech_stack' => ['React', 'Node.js', 'PostgreSQL', 'Tailwind'],
                'thumbnail' => '/images/projects/portal.png',
                'demo_url' => 'https://primawatangsoreang.com/',
                'repo_url' => null,
                'is_featured' => true,
            ],
            [
                'title' => 'Arsip Desa',
                'slug' => 'arsip-desa',
                'description' => 'Kontribusi open source untuk sistem pengarsipan dokumen desa.',
                'tech_stack' => ['React', 'Node.js', 'PostgreSQL', 'Tailwind'],
                'thumbnail' => '/images/projects/arsip.jpeg',
                'demo_url' => null,
                'repo_url' => 'https://zevhirus.github.io/ARSIPAN-DESA/',
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['slug' => $project['slug']],
                $project
            );
        }
    }
}
