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

<contact-us-component>
</contact-us-component>
<section class="mt-5 pt-5 pb-5" id="suscripcion" name="suscripcion"><!--Section Newsletter-->
    <newsletter-component locale="{{ App::getLocale() }}">
    </newsletter-component>
</section><!--END Section Newsletter-->
