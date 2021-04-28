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
      $function_included->name='<p><span style="color:#f39c12">5 P&aacute;ginas</span></p>';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='<p><span style="color:#f39c12">5 Pages</span></p>';
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
      $function_included->name='<p><span style="color:#f39c12">Im&aacute;genes de stock</span></p>';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='<p><span style="color:#f39c12">Stock images</span></p>';
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
      $function_included->name='<p><span style="color:#f39c12">Posicionamiento en Google SEO</span></p>';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='<p><span style="color:#f39c12">Positioning in Google SEO</span></p>';
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
      $function_included->name='<p><span style="color:#f39c12">10 P&aacute;ginas</span></p>';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='<p><span style="color:#f39c12">10 Pages</span></p>';
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
      $function_included->name='<p><span style="color:#f39c12">2 idioma</span></p>';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='<p><span style="color:#f39c12">2 Languages</span></p>';
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
      $function_included->name='<p><span style="color:#f39c12">Chat de contacto</span></p>';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='<p><span style="color:#f39c12">Contact chat</span></p>';
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
      $function_included->name='<p><span style="color:#f39c12">Multidioma</span></p>';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='<p><span style="color:#f39c12">Multi-language</span></p>';
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
      $function_included->name='<p><span style="color:#f39c12">Textos de Calidad</span></p>';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='<p><span style="color:#f39c12">Quality Texts</span></p>';
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
      $function_included->name='<p><span style="color:#f39c12">Importaci&oacute;n de tu actual web</span></p>';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='<p><span style="color:#f39c12">Importing your current website</span></p>';
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
      $function_included->name='<p><span style="color:#f39c12">P&aacute;gina web, Blog o Tienda Online</span></p>';
      $function_included->save();
      $contentType='Function';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_title='<p><span style="color:#f39c12">Website, Blog or Digital Shopping</span></p>';
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
