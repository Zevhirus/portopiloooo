<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    protected $fillable = ['title','slug','description','thumbnail','tech_stack','demo_url','repo_url','is_featured'];
    protected $casts = ['tech_stack' => 'array', 'is_featured' => 'boolean'];
    protected $appends = ['thumbnail_url'];

    public function getThumbnailUrlAttribute(): ?string
    {
        if (!$this->thumbnail) {
            return null;
        }

        // Kalau sudah path langsung (diawali / atau http), pakai apa adanya.
        // Kalau bukan, anggap itu path relatif di storage/app/public.
        if (str_starts_with($this->thumbnail, '/') || str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }

        return Storage::url($this->thumbnail);
    }
}
