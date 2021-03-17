<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaketType;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;

class PaketTypeTableSeeder extends Seeder
{
  use ContentTypeTrait, TranslateTrait, LanguageTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $paket_type=new PaketType();
      $paket_type->name='Básico';
      $paket_type->save();
      $contentType='Paket Type';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Basic';
      $data_trans=array(
        ['id_content_trans'=>$paket_type->id,
        'content'=>$paket_type['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $paket_type=new PaketType();
      $paket_type->name='Avanzado';
      $paket_type->save();
      $contentType='Paket Type';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Advanced';
      $data_trans=array(
        ['id_content_trans'=>$paket_type->id,
        'content'=>$paket_type['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $paket_type=new PaketType();
      $paket_type->name='Profesional';
      $paket_type->save();
      $contentType='Paket Type';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Professional';
      $data_trans=array(
        ['id_content_trans'=>$paket_type->id,
        'content'=>$paket_type['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $paket_type=new PaketType();
      $paket_type->name='Premium';
      $paket_type->save();
      $contentType='Paket Type';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Premium';
      $data_trans=array(
        ['id_content_trans'=>$paket_type->id,
        'content'=>$paket_type['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $paket_type=new PaketType();
      $paket_type->name='Oferta Especial';
      $paket_type->save();
      $contentType='Paket Type';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Special Offer';
      $data_trans=array(
        ['id_content_trans'=>$paket_type->id,
        'content'=>$paket_type['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);
    }
}
