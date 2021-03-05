<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceTableSeeder extends Seeder
{
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

      $service=new Service();
      $service->name='Auditoría y Posicionamiento SEO';
      $service->description='<p>An&aacute;lisis SEO de su web en internet, dise&ntilde;o y planificaci&oacute;n de acciones para su optimizaci&oacute;n.</p>';
      $service->save();

      $service=new Service();
      $service->name='Diseño y optimización de imágenes';
      $service->description='<p>Dise&ntilde;o profesional de logos y tarjetas de presentaci&oacute;n de empresas, as&iacute; como de posters publicitarios.</p>';
      $service->save();

      $service=new Service();
      $service->name='Diseño Web';
      $service->description='<p>Creaci&oacute;n de webs responsivas con dise&ntilde;os atractivos y personalizados para su negocio virtual (Corporativo, Tienda, Blog); as&iacute; como de banners, botones, men&uacute;s, todos adaptados a su imagen.</p>';
      $service->save();

      $service=new Service();
      $service->name='Programación Web';
      $service->description='<p>Programaci&oacute;n de aplicaciones web que automaticen los procesos diarios que se lleva a cabo en su empresa o negocio.</p>';
      $service->save();

      $service=new Service();
      $service->name='Creación de contenido digital';
      $service->description='<p>Por si fuera poco se enfoca en la creaci&oacute;n de contenido (texto, im&aacute;gen, video) para su web, as&iacute; mantiene viva su idea en las redes de forma fresca y actualizada.</p>';
      $service->save();
    }
}
