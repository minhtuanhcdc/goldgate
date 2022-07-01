<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ImageThinprep extends Model
{
    use HasFactory;
    protected $table = "image_thinpreps";
    protected $guarded = [];
    protected $fillable = [
        'id',
        'thinprep_code',
        'thinLeft',
        'thinRight',
        'status',
    ];

    public function uploadFolderLeft(): string{
        return "public/ImageThinLeft";
    }
    public function deleteImageLeft(string $column = 'image'): void
    {
        $imageName = $this->$column;

        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolderLeft()}/{$imageName}");
        }
    }


    public function uploadFolderRight(): string{
        return "public/ImageThinRight";
    }
    public function deleteImageLefts(string $column = 'image'): void
    {
        dd($column);
        $imageName = $this->$column;

        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolderLeft()}/{$imageName}");
        }
    }
}
