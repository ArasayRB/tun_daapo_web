<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use App\Traits\ServiceTrait;

class ServiceTableSeeder extends Seeder
{
  use ContentTypeTrait, TranslateTrait, LanguageTrait, ServiceTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $service=new Service();
      $service->name='Administración y Manejo de Redes Sociales';
      $service->description='<p>Buscas darte a conocer desde las redes sociales m&aacute;s usadas para as&iacute; poner tus servicios al alcance de tu comunidad? Adem&aacute;s de todo esto divulgamos y compartimos el contenido actualizado de su web en las mismas, as&iacute; como creamos campa&ntilde;as de publicidad para atraer clientes potenciales a su p&aacute;gina.</p>';
      $service->save();
      $contentType='Service';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<p><strong>Are you looking to make yourself known from the most used social networks in order to put your services within the reach of your community? In addition to all this, we disclose and share the updated content of your website on them, as well as create advertising campaigns to attract potential customers to your page.</strong></p>';
      $content_title='Managment and Admin Nethwork Sociality';
      $data_trans=array(
        ['id_content_trans'=>$service->id,
        'content'=>$service['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title],
        ['id_content_trans'=>$service->id,
        'content'=>$service['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'description',
        'content_trans'=>$content_description]
      );
      $this->storeTranslate($data_trans);

      $service=new Service();
      $service->name='Auditoría y Posicionamiento SEO';
      $service->description='<p>An&aacute;lisis SEO de su web en internet, dise&ntilde;o y planificaci&oacute;n de acciones para su optimizaci&oacute;n.</p>';
      $service->save();
      $contentType='Service';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<p><strong>SEO analysis of your website on the internet, design and planning of actions for its optimization.</strong></p>';
      $content_title='Auditory and SEO Position';
      $data_trans=array(
        ['id_content_trans'=>$service->id,
        'content'=>$service['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title],
        ['id_content_trans'=>$service->id,
        'content'=>$service['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'description',
        'content_trans'=>$content_description]
      );
      $this->storeTranslate($data_trans);

      $service=new Service();
      $service->name='Diseño y optimización de imágenes';
      $service->description='<p>Dise&ntilde;o profesional de logos y tarjetas de presentaci&oacute;n de empresas, as&iacute; como de posters publicitarios.</p>';
      $service->save();
      $contentType='Service';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<p><strong>Professional design of company logos and business cards, as well as advertising posters.</strong></p>';
      $content_title='Optimization and Image Design';
      $data_trans=array(
        ['id_content_trans'=>$service->id,
        'content'=>$service['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title],
        ['id_content_trans'=>$service->id,
        'content'=>$service['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'description',
        'content_trans'=>$content_description]
      );
      $this->storeTranslate($data_trans);

      $service=new Service();
      $service->name='Diseño Web';
      $service->description='<p>Creaci&oacute;n de webs responsivas con dise&ntilde;os atractivos y personalizados para su negocio virtual (Corporativo, Tienda, Blog); as&iacute; como de banners, botones, men&uacute;s, todos adaptados a su imagen.</p>';
      $service->save();
      $contentType='Service';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<p><strong>Creation of responsive websites with attractive and personalized designs for your virtual business (Corporate, Store, Blog); as well as banners, buttons, menus, all adapted to your image.</strong></p>';
      $content_title='Web Design';
      $data_trans=array(
        ['id_content_trans'=>$service->id,
        'content'=>$service['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title],
        ['id_content_trans'=>$service->id,
        'content'=>$service['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'description',
        'content_trans'=>$content_description]
      );
      $this->storeTranslate($data_trans);

      $service=new Service();
      $service->name='Programación Web';
      $service->description='<p>Programaci&oacute;n de aplicaciones web que automaticen los procesos diarios que se lleva a cabo en su empresa o negocio.</p>';
      $service->save();
      $contentType='Service';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<p><strong>Programming of web applications that automate the daily processes carried out in your company or business.</strong></p>';
      $content_title='Web Programming';
      $data_trans=array(
        ['id_content_trans'=>$service->id,
        'content'=>$service['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title],
        ['id_content_trans'=>$service->id,
        'content'=>$service['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'description',
        'content_trans'=>$content_description]
      );
      $this->storeTranslate($data_trans);

      $service=new Service();
      $service->name='Creación de contenido digital';
      $service->description='<p>Por si fuera poco se enfoca en la creaci&oacute;n de contenido (texto, im&aacute;gen, video) para su web, as&iacute; mantiene viva su idea en las redes de forma fresca y actualizada.</p>';
      $service->save();
      $contentType='Service';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<p><strong>As if that were not enough, it focuses on the creation of content (text, image, video) for its website, thus keeping its idea alive on the networks in a fresh and updated way.</strong></p>';
      $content_title='Digital Content Creation';
      $data_trans=array(
        ['id_content_trans'=>$service->id,
        'content'=>$service['name'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'name',
        'content_trans'=>$content_title],
        ['id_content_trans'=>$service->id,
        'content'=>$service['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'description',
        'content_trans'=>$content_description]
      );
      $this->storeTranslate($data_trans);
    }
}
