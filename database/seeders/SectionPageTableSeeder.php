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
    }
}
