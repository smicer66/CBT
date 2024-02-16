<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property null|string mime
 * @property null|string original_filename
 * @property string filename
 * @property mixed user_id
 * @property mixed examination_id
 */
class FileUpload extends Model
{

    protected $guarded = [];
    protected $table = 'fileuploads';
}
