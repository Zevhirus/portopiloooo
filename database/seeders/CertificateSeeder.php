<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        $certificates = [
            [
                'title' => 'Pelatihan Office Administrator',
                'issuer' => 'BBPVP Makassar — Kementerian Ketenagakerjaan RI',
                'description' => 'Dinyatakan LULUS pelatihan Office Administrator selama 80 jam (08–17 Juni 2026), mencakup 10 unit kompetensi: pengelolaan arsip, produksi dokumen, komunikasi lisan bahasa Inggris dasar, pengelolaan kas kecil, dan lainnya. No. Sertifikat: 2607067AE9339E.',
                'category' => 'Pelatihan',
                'year' => 2026,
                'thumbnail' => '/images/certificates/sertifikat-kemnaker.jpg',
                'file_url' => '/files/certificates/sertifikat-kemnaker.pdf',
                'is_featured' => true,
            ],
            [
                'title' => 'Belajar Penerapan Data Science dengan Microsoft Fabric',
                'issuer' => 'Dicoding Indonesia × Microsoft',
                'description' => 'Kelas end-to-end data science: eksplorasi data, preprocessing, training & tracking model ML dengan MLflow, hingga deployment di Microsoft Fabric. ID: N9ZO070EDXG5.',
                'category' => 'Pelatihan',
                'year' => 2026,
                'thumbnail' => '/images/certificates/sertifikat-dicoding.jpg',
                'file_url' => '/files/certificates/sertifikat-dicoding.pdf',
                'is_featured' => false,
            ],
            [
                'title' => 'Humas UPTD CPI',
                'issuer' => 'UPTD CPI',
                'description' => null,
                'category' => 'Organisasi',
                'year' => 2025,
                'thumbnail' => null,
                'file_url' => null,
                'is_featured' => false,
            ],
        ];

        foreach ($certificates as $certificate) {
            Certificate::updateOrCreate(
                ['title' => $certificate['title'], 'issuer' => $certificate['issuer']],
                $certificate
            );
        }
    }
}
