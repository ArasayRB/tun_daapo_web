<div class="contenedor-slider-testimonios">
  <div class="testimonial-slider bg-info">
      <div class="rounded row">
        <tun-daapo-section-component name_section="Tun Daapo">
        </tun-daapo-section-component>

        <div class="mt-5" id="services"><h1 class="text-center mb-2 mt-2">{{__('messages.Services')}}</h1>
          <service-section-component>
          </service-section-component>

        </div>



      </div>
  </div>



</div>
<div class="contenedor-testimonios"><!--SECTION TESTIMONIOS-->
<portfolio-section-component>
</portfolio-section-component>
<div class="contenedor-slider-testimonios programming"><!--Blog-->
<design-section-component name_section="Diseñamos">
</design-section-component>





</div>

</div><!--Fin SECTION TESTIMONIOS-->

<section class="mt-5" description="Planes y Precios" id="planes_precios"><!--Pricing and Planes-->
  <development-section-component name_section="Planes de Desarrollo Web">
  </development-section-component>
  <development-plan-section-component>
  </development-plan-section-component>

</section><!--END Pricing and Planes-->

<ask-budget-section-component name_section="Pida su Presupuesto">
</ask-budget-section-component>


@if ( isset($posts) && $posts>0)
<section class="container-fluid col-12 pt-5 bg-light" id="blog" name="blog"><h1 id="post" class="text-center pb-2 pt-5 text-uppercase animate__animated animate__zoomIn">{{ __('Posts') }}</h1><!--Section Blog-->
  <post-ppal-tab-component>
  </post-ppal-tab-component>

</section><!--END Section Blog-->
@endif

<div class="panel pt-5 pb-5 mt-5" id="contacto">
<div class="panel-header">
  <h1 class="panel-title text-center text-light">Contacto</h1>
</div>
<div class="panel-body">

    <div class="row justify-content-center">
      <div class="col-6">
    <form action="" class="ml-3">
        <input type="text" class="form-control font-italic mt-5" placeholder="Email...">
        <input type="text" class="form-control font-italic mt-2" placeholder="Nombre...">
        <textarea name="mensaje" class="form-control font-italic mt-2" id="" cols="33" rows="2" placeholder="Su mensaje..."></textarea>
       <button type="button" class="btn btn-primary rounded btn-lg mt-3">Enviar</button>
    </form>
    </div>
    <div class="col-6">
    <section class="info-contact">
      <div class="container mt-5">
          <div class="tel-fijo"><p class="text-light"><mark class="bg-dark text-light">Teléfono Fijo: <br></mark>+53-41993797</p></div>
          <div class="movil"><p class="text-light"><mark class="bg-dark text-light">Móvil Arasay: <br></mark>+53-53419001</p>
          <p class="text-light"><mark class="bg-dark text-light">Móvil Youblián: <br></mark>+53-52474269</p></div>
          <div class="email"> <p class="text-light"><mark class="bg-dark text-light">Email: <br></mark>hostalgranfamilia@gmail.com</p></div>
          <div class="direc"><p class="text-light"><mark class="bg-dark text-light">Dirección: <br></mark>Camilo Cienfuegos #180A entre José Martí y Miguel Calzada. Trinidad, Sancti Spíritus, Cuba | 62600</p></div>
        </div>
    </section>
    </div>
    </div>
</div>
</div>
<section class="mt-5 pt-5 pb-5" id="suscripcion" name="suscripcion"><!--Section Newsletter-->
    <form action="" class="mt-5">
      <div class="container mt-5"><h4 class="text-uppercase text-center text-light mt-5 mb-5">Suscríbete!! No te pierdas las novedades de nuestro Blog y Promociones</h4>
        <div class="row justify-content-center">
          <div class="col-6 mb-2"><input type="text" class="form-control font-italic" placeholder="Nombre..."></div>
            <div class="col-2 d-block">
            </div>
          <div class="col-6"><input type="text" class="form-control font-italic" placeholder="Déjanos tu email..."></div>
          <div class="col-2"><img src="{!! asset('images/img/enviar.png') !!}" alt="" type="button" id="enviar-news" class="btn rounded bg-info px-2 py-2 newsletter"></div>
        </div>
      </div>
    </form>
</section><!--END Section Newsletter-->
