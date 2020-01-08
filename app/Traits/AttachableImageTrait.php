<?php

namespace App\Traits;

use App\Models\AttachmentImage;


trait AttachableImageTrait
{
    public function attachments()
    {
        return $this->morphMany(AttachmentImage::class, 'attachable');
    }

    public function addAttachment($name, $path, $isPublished, $desc=null)
    {
        $attachment = new AttachmentImage;
        $attachment->name = $name;
        $attachment->path = $path;
        $attachment->desc = $desc;
        $attachment->isPublished = $isPublished;

        $this->attachments()->save($attachment);

        return $attachment;
    }

}
