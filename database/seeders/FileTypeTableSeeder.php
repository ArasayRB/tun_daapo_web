<?php

namespace Database\Seeders;

use App\Models\FileType;
use Illuminate\Database\Seeder;

class FileTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_file=new FileType();
        $type_file->name='image';
        $type_file->ext_available='jpg,ico,png,svg';
        $type_file->save();

        $type_file=new FileType();
        $type_file->name='video';
        $type_file->ext_available='avi,mp4,mkv,mpg';
        $type_file->save();

        $type_file=new FileType();
        $type_file->name='texto';
        $type_file->ext_available='doc,pdf,occ,docx,ppt,txt';
        $type_file->save();
    }
}
