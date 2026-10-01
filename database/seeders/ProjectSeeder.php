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
            [
                'title' => 'Portfolio Website',
                'slug' => 'portfolio-website',
                'description' => 'Web portfolio dengan Laravel, Inertia, Vue, dan Tailwind.',
                'tech_stack' => ['Laravel', 'Vue', 'Inertia', 'Tailwind'],
                'thumbnail' => '/images/projects/portfolio-website.png',
                'demo_url' => 'https://example.com',
                'repo_url' => 'https://github.com/Zevhirus/portfolio',
                'is_featured' => true,
            ],
            [
                'title' => 'Himpunan mahasiswa',
                'slug' => 'himpunan-mahasiswa',
                'description' => 'Ruang digital Himpunan Mahasiswa untuk berbagi informasi, mengembangkan potensi, menyalurkan aspirasi, dan membangun kolaborasi menuju organisasi mahasiswa yang aktif dan inovatif.',
                'tech_stack' => ['Laravel', 'Supabase', 'Vue', 'React', 'Tailwind'],
                'thumbnail' => '/images/projects/himpunan-mahasiswa.png',
                'demo_url' => 'https://himadistik.vercel.app/',
                'repo_url' => 'https://github.com/Zevhirus/Himadisktik',
                'is_featured' => false,
            ],
            [
                'title' => 'Simara',
                'slug' => 'simara',
                'description' => 'Setiap surat masuk, terpantau sampai ke meja tujuan. Dari resepsionis hingga kepala bagian, lihat posisi dan disposisi surat secara langsung.',
                'tech_stack' => ['Supabase', 'Vue', 'React', 'Html', 'Tailwind'],
                'thumbnail' => '/images/projects/simara.png',
                'demo_url' => 'https://simara-mocha.vercel.app/',
                'repo_url' => 'https://github.com/Zevhirus/simara',
                'is_featured' => false,
            ],
            [
                'title' => 'ARSIP',
                'slug' => 'arsip',
                'description' => 'ARSIPAN adalah platform manajemen dan tata kelola arsip digital berbasis web yang dirancang untuk mempermudah pencarian, pengelompokan, serta penyimpanan dokumen secara terstruktur, efisien, dan terpusat.',
                'tech_stack' => ['react', 'laravel', 'vue'],
                'thumbnail' => '/images/projects/arsipan.png',
                'demo_url' => 'https://zevhirus.github.io/ARSIPAN/',
                'repo_url' => null,
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
