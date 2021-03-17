<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FunctionIncluded;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use App\Traits\FunctionIncludedTrait;

class FunctionIncludedTableSeeder extends Seeder
{
  use ContentTypeTrait, TranslateTrait, LanguageTrait, FunctionIncludedTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $function_included=new FunctionIncluded();
      $function_included->name='3 Páginas';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='3 Pages';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='1 Idioma';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='1 Language';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Diseño e imágen de tu página web';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Design and image of your website';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Adaptada a móviles y 100% responsive';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Adapted to mobiles and 100% responsive';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='CMS Autogestionable';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Self-managed CMS';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Leyes obligatorias web(LSSI,RGPD y Cookies)';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Mandatory web laws (LSSI, RGPD and Cookies)';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Sitio web seguro (HTTPS)';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Secure website (HTTPS)';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Página web o Blog';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Website or Blog';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='5 Páginas';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='5 Pages';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Imágenes de stock';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Stock images';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Posicionamiento en Google SEO';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Positioning in Google SEO';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='10 Páginas';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='10 Pages';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='2 idioma';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='2 Languages';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Chat de contacto';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Contact chat';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Multidioma';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Multi-language';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Textos de Calidad';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Quality Texts';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Importación de tu actual web';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Importing your current website';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);

      $function_included=new FunctionIncluded();
      $function_included->name='Página web, Blog o Tienda Online';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='Website, Blog or Digital Shopping';
      $data_trans=array(
        ['id_content_trans'=>$function_included->id,
        'content'=>$function_included['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title]
      );
      $this->storeTranslate($data_trans);
    }
}
