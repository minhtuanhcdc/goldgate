<?php

namespace App\Actions;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

class UploadFile
{
    private $file;
    private $uploadPath;

    /**
     * Set the value of file
     *
     * @return  self
     */
    public function setFile(?UploadedFile $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Set the value of uploadPath
     *
     * @return  self
     */
    public function setUploadPath(string $uploadPath)
    {
        $this->uploadPath = $uploadPath;

        return $this;
    }

    public function execute(): ?string
    {
        if (!$this->file) {
            return null;
        }
        $curentTime= Carbon::now()->format('YmdHs');
        $imageName = (string) Str::of($curentTime)
            ->beforeLast('.')
            ->slug()
            ->append('.')
            ->append($this->file->getClientOriginalExtension());
        $this->file->storeAs($this->uploadPath, $imageName);
        return $imageName;
    }
    public function executeOrigin(): ?string
    {
        if (!$this->file) {
            return null;
        }
        $imageName = (string) $this->file->getClientOriginalName();
        $this->file->storeAs($this->uploadPath, $imageName);
        return $imageName;
    }
}
