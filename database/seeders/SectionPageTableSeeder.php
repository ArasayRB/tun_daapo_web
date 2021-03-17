<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SectionPage;
use App\Traits\ContentTypeTrait;
use App\Traits\TranslateTrait;
use App\Traits\LanguageTrait;
use App\Traits\SectionPageTrait;

class SectionPageTableSeeder extends Seeder
{
  use ContentTypeTrait, TranslateTrait, LanguageTrait, SectionPageTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $sectiontun_daapo=new SectionPage();
      $sectiontun_daapo->img='tunDaapo32x32.ico';
      $sectiontun_daapo->title='Tun Daapo';
      $sectiontun_daapo->description='<h2 style="text-align:justify">Tiene un <strong>OBJETIVO CLARO</strong> y es&nbsp; <span style="color:#02164f"><strong>MOSTRARTE LO MAS PARECIDO A TU COMUNIDAD PARA QUE QUEDES IMPREGNADO EN SU IDENTIDAD</strong></span>. Para ello &nbsp;se apoya en el <strong>ESTUDIO, PLANIFICACI&Oacute;N, DISE&Ntilde;O, MAQUETACI&Oacute;N, y CONSTRUCCI&Oacute;N</strong> de tu <span style="color:#02164f"><strong>IMAGEN digital</strong></span>.</h2>';
      $sectiontun_daapo->save();
      $contentType='Section';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<h3 style="text-align:justify"><span style="color:#ffffff">It has a</span> <strong><span style="color:#02164f">CLEAR OBJECTIVE</span></strong> <span style="color:#ffffff">and it is</span> <strong><span style="color:#02164f">TO SHOW YOU THE MOST LIKE TO YOUR COMMUNITY SO THAT YOU ARE IMPREGNATED IN YOUR IDENTITY</span></strong><span style="color:#ffffff">. For this, it relies on the</span> <span style="color:#ffffff"><strong>STUDY, PLANNING, DESIGN, LAYOUT, and CONSTRUCTION</strong></span> <span style="color:#ffffff">of your</span> <strong><span style="color:#02164f">digital IMAGE</span></strong>.</h3>

<p>&nbsp;</p>';
      $content_title='Tun Daapo';
      $data_trans=array(
        ['id_content_trans'=>$sectiontun_daapo->id,
        'content'=>$sectiontun_daapo['title'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'title',
        'content_trans'=>$content_title],
        ['id_content_trans'=>$sectiontun_daapo->id,
        'content'=>$sectiontun_daapo['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'description',
        'content_trans'=>$content_description]
      );
      $this->storeTranslate($data_trans);

      $sectiontun_daapo=new SectionPage();
      $sectiontun_daapo->img='BombillaEfectos.png';
      $sectiontun_daapo->title='Diseñamos';
      $sectiontun_daapo->description='<p>Enfocados en las &uacute;ltimas tendencias de posicionamiento SEO, haciendo que su web pueda competir en el mercado obteniendo una buena posici&oacute;n en los principales Motores de B&uacute;squeda</p>';
      $sectiontun_daapo->save();
      $contentType='Section';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<p><span style="color:#ffffff">Focused on the latest SEO positioning trends, making your website able to compete in the market by obtaining a good position in the main Search Engines</span></p>';
      $content_title='Design';
      $data_trans=array(
        ['id_content_trans'=>$sectiontun_daapo->id,
        'content'=>$sectiontun_daapo['title'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'title',
        'content_trans'=>$content_title],
        ['id_content_trans'=>$sectiontun_daapo->id,
        'content'=>$sectiontun_daapo['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'description',
        'content_trans'=>$content_description]
      );
      $this->storeTranslate($data_trans);

      $sectiontun_daapo=new SectionPage();
      $sectiontun_daapo->title='Pida su Presupuesto';
      $sectiontun_daapo->description='<p style="text-align:justify"><span style="color:#f1c40f"><strong>Para la contrataci&oacute;n de uno o varios de los restantes servicios</strong></span> <strong><span style="color:#f1c40f">que ofrece Tun Daapo</span></strong> <span style="color:#f1c40f"><strong>debe contactar previamente para otorgarle una cita </strong></span><span style="color:#ffffff">donde usted<strong>&nbsp;</strong>&nbsp;detalle su solicitud de manera que podamos evaluar, seg&uacute;n sus demandas, la cantidad de horas a dedicar, as&iacute; como la complejidad del trabajo a desarrollar.</span></p>';
      $sectiontun_daapo->save();
      $contentType='Section';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<p style="text-align:justify"><span style="color:#f1c40f"><strong>To contract one or more of the other services offered by Tun Daapo, you must contact in advance to grant an appointment</strong></span><span style="color:#FC08"><strong> </strong></span><span style="color:#ffffff">where you detail your request so that we can evaluate, according to your demands, the number of hours to dedicate, as well as the complexity of the work. develop.</span></p>';
      $content_title='Ask for Budget';
      $data_trans=array(
        ['id_content_trans'=>$sectiontun_daapo->id,
        'content'=>$sectiontun_daapo['title'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'title',
        'content_trans'=>$content_title],
        ['id_content_trans'=>$sectiontun_daapo->id,
        'content'=>$sectiontun_daapo['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'description',
        'content_trans'=>$content_description]
      );
      $this->storeTranslate($data_trans);

      $sectiontun_daapo=new SectionPage();
      $sectiontun_daapo->title='Planes de Desarrollo Web';
      $sectiontun_daapo->description='<p><span style="color:#ffffff">Hemos conformado algunos paquetes de servicios para ti! Pero te aseguro que un plan a tu medida es la mejor apuesta pues</span> <span style="color:#f1c40f"><strong>NO SIEMPRE EN UN SOLO PAQUETE ENCUENTRAS TODO LO QUE NECESITAS</strong></span>&nbsp;<span style="color:#ffffff">, as&iacute; que</span> <span style="color:#f1c40f"><strong>no dudes en</strong></span> <strong><a href="http://www.tundaapoweb.localhost/#contacto"><span style="color:#f1c40f">contactarnos</span></a></strong><span style="color:#f1c40f"><strong>.</strong></span></p>

<p><br />
&nbsp; <span style="color:#f1c40f"><strong>No te alarmes, d&eacute;janos tu contacto para as&iacute; darte una cita y conformar tu idea de acuerdo a tu presupuesto!!! Se pueden obtener muy buenos productos</strong></span></p>';
      $sectiontun_daapo->save();

      $contentType='Section';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<<p style="text-align:center"><span style="color:#ffffff">We have put together some service packages for you! But I assure you that a tailor-made plan is the best bet because </span><span style="color:#f1c40f"><strong>YOU WILL NOT ALWAYS FIND EVERYTHING YOU NEED IN ONE PACKAGE</strong></span><span style="color:#ffffff">, so </span><strong><span style="color:#f1c40f">do not hesitate to </span><a href="http://www.tundaapoweb.localhost/#contacto"><span style="color:#f1c40f">contact us</span></a><span style="color:#f1c40f">.</span></strong></p>

<p style="text-align:center"><br />
&nbsp;<span style="color:#f1c40f"><strong> Do not be alarmed, leave us your contact to give you an appointment and shape your idea according to your budget !!! You can get very good products</strong></span></p>';
      $content_title='Plans for Web Design';
      $data_trans=array(
        ['id_content_trans'=>$sectiontun_daapo->id,
        'content'=>$sectiontun_daapo['title'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'title',
        'content_trans'=>$content_title],
        ['id_content_trans'=>$sectiontun_daapo->id,
        'content'=>$sectiontun_daapo['description'],
        'tipo_content'=>$tipo_content,
        'trans_lang'=>$lang,
        'indice_content'=>'description',
        'content_trans'=>$content_description]
      );
      $this->storeTranslate($data_trans);
    }
}
