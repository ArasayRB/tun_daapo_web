<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SectionPage;

class SectionPageTableSeeder extends Seeder
{
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

      $sectiontun_daapo=new SectionPage();
      $sectiontun_daapo->img='BombillaEfectos.png';
      $sectiontun_daapo->title='Diseñamos';
      $sectiontun_daapo->description='<p>Enfocados en las &uacute;ltimas tendencias de posicionamiento SEO, haciendo que su web pueda competir en el mercado obteniendo una buena posici&oacute;n en los principales Motores de B&uacute;squeda</p>';
      $sectiontun_daapo->save();

      $sectiontun_daapo=new SectionPage();
      $sectiontun_daapo->title='Pida su Presupuesto';
      $sectiontun_daapo->description='<p style="text-align:justify"><span style="color:#f1c40f"><strong>Para la contrataci&oacute;n de uno o varios de los restantes servicios</strong></span> <strong><span style="color:#f1c40f">que ofrece Tun Daapo</span></strong> <span style="color:#f1c40f"><strong>debe contactar previamente para otorgarle una cita </strong></span><span style="color:#ffffff">donde usted<strong>&nbsp;</strong>&nbsp;detalle su solicitud de manera que podamos evaluar, seg&uacute;n sus demandas, la cantidad de horas a dedicar, as&iacute; como la complejidad del trabajo a desarrollar.</span></p>';
      $sectiontun_daapo->save();

      $sectiontun_daapo=new SectionPage();
      $sectiontun_daapo->title='Planes de Desarrollo Web';
      $sectiontun_daapo->description='<p><span style="color:#ffffff">Hemos conformado algunos paquetes de servicios para ti! Pero te aseguro que un plan a tu medida es la mejor apuesta pues</span> <span style="color:#f1c40f"><strong>NO SIEMPRE EN UN SOLO PAQUETE ENCUENTRAS TODO LO QUE NECESITAS</strong></span>&nbsp;<span style="color:#ffffff">, as&iacute; que</span> <span style="color:#f1c40f"><strong>no dudes en</strong></span> <strong><a href="http://www.tundaapoweb.localhost/#contacto"><span style="color:#f1c40f">contactarnos</span></a></strong><span style="color:#f1c40f"><strong>.</strong></span></p>

<p><br />
&nbsp; <span style="color:#f1c40f"><strong>No te alarmes, d&eacute;janos tu contacto para as&iacute; darte una cita y conformar tu idea de acuerdo a tu presupuesto!!! Se pueden obtener muy buenos productos</strong></span></p>';
      $sectiontun_daapo->save();
    }
}
