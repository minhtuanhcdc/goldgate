<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Imagethin extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


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
    public function deleteImageRight(string $column = 'image'): void
    {
        //dd($column);
        $imageName = $this->$column;

        if ($imageName !== null) {
            Storage::delete("{$this->uploadFolderLeft()}/{$imageName}");
        }
    }
}
