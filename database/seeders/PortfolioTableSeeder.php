<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;
use App\Models\Service;

class PortfolioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $service1=Service::where('name','Administración y Manejo de Redes Sociales')
                       ->get();
      $service2=Service::where('name','Diseño Web')
                      ->get();
     $service3=Service::where('name','Programación Web')
                     ->get();
     $service4=Service::where('name','Diseño y optimización de imágenes')
                      ->get();
      $section_portfolio=new Portfolio();
      $section_portfolio->img='Now with pod step.png';
      $section_portfolio->empresa_solicitante='Hostal Turmalina';
      $section_portfolio->description='Post dedicado a informar en redes sociales sobre medidas del hostal para actualizarse ante la nueva pandemia';
      $section_portfolio->project_name='Post promocional COVID-19';
      $section_portfolio->service_id='Administración y Manejo de Redes Sociales';
      $section_portfolio->save();
      $section_portfolio->services()->attach($service1[0]->id);

      $section_portfolio=new Portfolio();
      $section_portfolio->img='Nueva oferta.jpg';
      $section_portfolio->empresa_solicitante='Hostal Turmalina';
      $section_portfolio->description='Post para promocionar una oferta especial temporal en redes sociales';
      $section_portfolio->project_name='Post Promocional de oferta especial';
      $section_portfolio->service_id='Administración y Manejo de Redes Sociales';
      $section_portfolio->save();
      $section_portfolio->services()->attach($service1[0]->id);

      $section_portfolio=new Portfolio();
      $section_portfolio->img='PostCovid19Turmalina.jpg';
      $section_portfolio->empresa_solicitante='Hostal Turmalina';
      $section_portfolio->description='Post para informar a clientes potenciales como el Hostal toma medidas que ayuden a mantener a raya a la COVID-19 dentro del hogar, por la salud de todos en casa';
      $section_portfolio->project_name='Post con medidas covid-19';
      $section_portfolio->service_id='Administración y Manejo de Redes Sociales';
      $section_portfolio->save();
      $section_portfolio->services()->attach($service1[0]->id);

      $section_portfolio=new Portfolio();
      $section_portfolio->img='tundaapo';
      $section_portfolio->empresa_solicitante='Tun Daapo';
      $section_portfolio->description='Es una web automatizada para una agencia de Programación y Marketing Digital';
      $section_portfolio->project_name='Portal-Blog';
      $section_portfolio->service_id='Diseño Web,Programación Web,Diseño y optimización de imágenes';
      $section_portfolio->save();
      $section_portfolio->services()->attach($service2[0]->id);
      $section_portfolio->services()->attach($service3[0]->id);
      $section_portfolio->services()->attach($service4[0]->id);
    }
}
