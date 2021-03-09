<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaketType;
use App\Models\FunctionIncluded;
use App\Models\Service;
use App\Models\Paket;

class PaketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $paket_basic=PaketType::where('name','Básico')
                            ->get();
      $paket_avanzado=PaketType::where('name','Avanzado')
                            ->get();
      $paket_profesional=PaketType::where('name','Profesional')
                            ->get();
      $paket_premium=PaketType::where('name','Premium')
                            ->get();
      $paket=new Paket();
      $paket->name='Básico';
      $paket->name_button='Contratar';
      $paket->description='<p>Plan b&aacute;sico que incluye dise&ntilde;o e iimage web de su empresa totalmente responsivo y adaptado a m&oacute;viles</p>';
      $paket->price=139.99;
      $paket->type_id=$paket_basic[0]->id;
      $paket->save();
      $paket->services()->attach(3,array('status'=>true));
      $paket->services()->attach(4,array('status'=>true));
      $paket->functions()->attach(1);
      $paket->functions()->attach(2);
      $paket->functions()->attach(3);
      $paket->functions()->attach(4);
      $paket->functions()->attach(5);
      $paket->functions()->attach(6);
      $paket->functions()->attach(7);
      $paket->functions()->attach(8);

      $paket=new Paket();
      $paket->name='Avanzado';
      $paket->name_button='Contratar';
      $paket->description='<p>Incluye 5 p&aacute;ginas dise&ntilde;adas a medida, as&iacute; como sale lista para posicionarse en buscadores web haciendo uso de SEO</p>';
      $paket->price=469.90;
      $paket->type_id=$paket_avanzado[0]->id;
      $paket->save();
      $paket->services()->attach(2,array('status'=>true));
      $paket->services()->attach(3,array('status'=>true));
      $paket->services()->attach(4,array('status'=>true));
      $paket->functions()->attach(7);
      $paket->functions()->attach(9);
      $paket->functions()->attach(10);
      $paket->functions()->attach(3);
      $paket->functions()->attach(4);
      $paket->functions()->attach(2);
      $paket->functions()->attach(5);
      $paket->functions()->attach(6);
      $paket->functions()->attach(8);

      $paket=new Paket();
      $paket->name='Profesional';
      $paket->name_button='Contratar';
      $paket->description='<p>Dise&ntilde;o autoresposivo, con adaptaci&oacute;n a m&oacute;viles, m&aacute;s de 1 idioma, con chat de contacto</p>';
      $paket->price=699.00;
      $paket->type_id=$paket_profesional[0]->id;
      $paket->save();
      $paket->services()->attach(2,array('status'=>true));
      $paket->services()->attach(3,array('status'=>true));
      $paket->services()->attach(4,array('status'=>true));
      $paket->functions()->attach(11);
      $paket->functions()->attach(12);
      $paket->functions()->attach(13);
      $paket->functions()->attach(3);
      $paket->functions()->attach(4);
      $paket->functions()->attach(7);
      $paket->functions()->attach(5);
      $paket->functions()->attach(14);
      $paket->functions()->attach(6);
      $paket->functions()->attach(8);

      $paket=new Paket();
      $paket->name='Premium';
      $paket->name_button='Pedir Presupuesto';
      $paket->description='<p>Web multidioma con textos de calidad, importaci&oacute;n de su p&aacute;gina web actual, disponible para web, blog &oacute; tienda virtual</p>';
      $paket->price=890.00;
      $paket->type_id=$paket_premium[0]->id;
      $paket->save();
      $paket->services()->attach(2,array('status'=>true));
      $paket->services()->attach(3,array('status'=>true));
      $paket->services()->attach(4,array('status'=>true));
      $paket->functions()->attach(14);
      $paket->functions()->attach(15);
      $paket->functions()->attach(16);
      $paket->functions()->attach(18);
      $paket->functions()->attach(17);
      $paket->functions()->attach(3);
      $paket->functions()->attach(4);
      $paket->functions()->attach(5);
      $paket->functions()->attach(6);
      $paket->functions()->attach(7);
    }
}
