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
      $sectiontun_daapo->description='<h2 style="text-align:justify"><span style="color:#ffffff">Sencillo como cre&iacute;as&nbsp;NO ES&nbsp;pero con</span>&nbsp;<span style="color:#f1c40f"><strong>Ingenio, Sencillez y Naturalidad Tun Daapo</strong></span>&nbsp;<span style="color:#ffffff">llevar&aacute; tu esencia al alcance</span>&nbsp;<strong><span style="color:#f1c40f">DE TU COMUNIDAD</span></strong></h2>';
      $sectiontun_daapo->save();
      $contentType='Section';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<h3 style="text-align:justify"><span style="color:#ffffff">Simple as you thought <strong>IT IS NOT</strong> but with</span> <strong><span style="color:#f1c40f">Ingenuity, Simplicity and Naturalness Tun Daapo</span></strong> <span style="color:#ffffff">will take your essence within the reach of </span><span style="color:#f1c40f"><strong>YOUR COMMUNITY</strong></span></h3>

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
      $sectiontun_daapo->img='BombillaMarketing.png';
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

      $sectiontun_daapo=new SectionPage();
      $sectiontun_daapo->title='Necesitas una Estrategia de Marketing Digital';
      $sectiontun_daapo->description='<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#youNeedDMS">No sabes si necesitas una estrategia que te haga crecer?</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="youNeedDMS">
<div class="card-body">Haces <strong>un producto</strong> que tiene todo para ser bueno y comercial, <strong>tiene excelente calidad y un muy buen precio, a&uacute;n as&iacute; te preguntas por qu&eacute; no se vende tanto como esperabas</strong>, o peor, ni se vende! <strong>Sue&ntilde;as con ser conocido, seguido y muy bien cotizado</strong>, con <strong>tener una marca</strong> establecida y bien difundida! No tienes presencia en ninguno de los canales digitales como redes sociales o web de presentaci&oacute;n. Tienes en algunos o en todos ellos pero no tienen el resultado que esperabas porque obtienen pocas o nulas visitas desde hace un tiempo Todo esto indica que <strong>el manejo de tu presencia digital es pobre en dise&ntilde;o y /o comunicaci&oacute;n</strong>. Tu estrategia, si es que cuentas con alguna, no est&aacute; funcionando, debe ser cambiada, mejorada o en su defecto totalmente reelaborada desde una perspectiva m&aacute;s enfocada a ti. Si tu servicio, proyecto o producto no ha tenido el desarrollo u obtenido las ventas que esperabas, incluso no ves en un futuro inmediato la soluci&oacute;n que cambie esta situaci&oacute;n y no sabes qu&eacute; hacer, est&aacute;s necesitando ex&aacute;ctamente uno o varios de los servicios que Tun Daapo ofrece. Una buena estrategia de marketing har&aacute; que te conozcan y despegues como nunca antes pensaste.</div>
</div>
</div>

<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#whyNeedDMS">Por qu&eacute; necesitas una estrategia de Marketing y Dies&ntilde;o Digital?</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="whyNeedDMS">
<div class="card-body">A&uacute;n cuando se sabe que con la digitalizaci&oacute;n todos los negocios han tenido que reinventarse producto de las oportunidades infinitas que brinda el mundo tecnol&oacute;gico, muchos ya sea por incredulidad, desconocimiento o falta de recursos no poseen una presencia digital acorde al &aacute;mbito profesional en que se desarrollan. Esto hace que incluso si <strong>hace unos a&ntilde;os ten&iacute;as un buen flujo de clientes en tu negocio</strong>, si<strong> ahora eres de los que est&aacute;n sin presencia en</strong> lo que se conoce como <strong>internet</strong>, casi seguro has perdido buena parte de las ventas que antes obten&iacute;as cuando deb&iacute;a suceder todo lo contrario. Viceversa a lo que muchos entienden, <strong>una buena presencia en la red es necesaria para todos</strong>, en Cuba, como en el resto del mundo, dir&iacute;a que hasta un carretillero que vende hortalizas, frutas o lo que sea, debe contar con visibilidad en alguna plataforma digital.</div>
</div>
</div>

<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#whatIsDMS">Qu&eacute; es una Estrategia de Marketing Difgital?</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="whatIsDMS">
<div class="card-body">Una estrategia de marketing es un <strong>plan adecuado y personalizado</strong> elaboradao para un ente con pautas o estrategias a desarrollar y seguir, <strong>que como objetivo final tiene alcanzar un fin</strong> que puede ser aumentar tu visibilidad, tus ventas totales o de un producto o servicio en espec&iacute;fico; promover una oferta especial en un per&iacute;odo determinado, un evento, una conferencia. O sea <strong>llegar a tu audiencia para lograr obtener de ella lo que se espera</strong>.</div>
</div>
</div>

<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#examplesDMS">Necesitas ejemplos que aterricen mejor como influye una buena estrategia de Marketing en el crecimiento y visibilidad de tu negocio?</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="examplesDMS">
<div class="card-body">Sencillo y actual. <strong>En tiempos de COVID-19</strong> ha habido cierres temporales de negocios, incluso restricci&oacute;n de movimiento. Tomando como ejemplo al carretillero, crees que <strong>si &eacute;l fuera accesible v&iacute;a digital</strong>, o sea <strong>tuviera un perfil de facebook</strong> con una buena personalizaci&oacute;n de sus datos, donde aparezca a qu&eacute; se dedica y como contactarlo, <strong>&eacute;l podr&iacute;a seguir comercializando sus productos desde casa</strong>? Pues claro que s&iacute;! Necesitar&iacute;a solo llevar lo vendido hasta el domicilio del comprador sin tener uqe pregonar por horas, evitando as&iacute; el riesgo que ofrece el estar en la calle donde el producto es manipulado por personas que muchas veces ni compran lo que toman en la mano. Y mucho mejor a&uacute;n sus ventas se disparar&iacute;an respecto a otros proveedores ambulantes como &eacute;l, pues la diferencia radica en qu&eacute; tan cerca te encuentras de tu comunidad, d&iacute;gase comunidad al universo de personas que necesitan lo que ofreces y no saben qui&eacute;n lo comercializa y /o como solicitarlo sin tener que esperar por divinidad del destino que este servicio, o producto llegue hasta la puerta de su casa o negocio. Un poco m&aacute;s complicado a la hora de desarrollar su estrategia de marketing, es <strong>un productor</strong> de guayabas o mango, pensemos en frutas tropicales( Pudiera ser cualquier tipo de producto o servicio), que <strong>desea buscar nuevos mercados</strong> para su cosecha porque por ejemplo en Cuba existen muchos productores de lo mismo y el exedente de producci&oacute;n muchas veces se hecha a perder por no tener los suficientes compradores o quien lo procese con otros fines, y/o simplemente <strong>desea obtener divisas</strong> para poder comprar insumos en el exterior, ya sea por su inexistencia en el pa&iacute;s o por su insuficiente calidad para lo que se necesita. Lo ideal para este productor es lograr licitar o contratar el comercio de su mercanc&iacute;a con empresas radicadas en lugares poco tropicales, fr&iacute;os, o con demanda alta de su producci&oacute;n. Para lograrlo la v&iacute;a menos costosa, aunque no lo parezca, es una buena estrategia de marketing apoyada en t&eacute;cnicas de posicionamiento SEO, y para catapultarla totalmente, una estrategia de publicidad &ldquo;SEM o pagada&rdquo; (Que desde Cuba &eacute;sta &uacute;ltima se hace muchas veces dif&iacute;cil para no decir imposible, sin embargo con las primeras tiene un 70 % aproximadamente ganado si se desarrolla de manera eficaz y efectiva).</div>
</div>
</div>

<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#designImageDMS">C&oacute;mo influye un buen dise&ntilde;o de im&aacute;gen y un texto adecuado en las estrategias de publicidad y comunicaci&oacute;n?</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="designImageDMS">
<div class="card-body"><strong>Dise&ntilde;ar, maquetar, crear y reproducir</strong> su idea haciendo uso de una imagen, logo, presentaci&oacute;n video, texto o web y basado en el <strong>dise&ntilde;o orientado hacia una interfaz de usuario con calidad (UI)</strong> y una <strong>exelente experiencia de usuario (UX)</strong> se logra desarrollar p&aacute;ginas y aplicaiones web haciendo uso de lenguajes y frameworks muy conocidos como HTML, CSS, JavaScript, PHP, Bootstrap, VueJs, Laravel; obteniendo as&iacute; un producto escalable, f&aacute;cil de actualizar, mantener y mejorar a futuro. <strong>Una llamada a la acci&oacute;n en el lugar y momento preciso</strong>, usando las palabras claves que interesan, apoy&aacute;ndose de una imagen y/o video que complemente la informaci&oacute;n que quieres que llegue al usuario har&aacute; que sea casi imposible abandonar la propuesta que les ofreces. Todo esto <strong>apoyado en la optimizaci&oacute;n SEO ayuda al desarrollo del marketing</strong>, de nada sirve una buena campa&ntilde;a SEM si al dirigir al usuario captado a donde queremos, &eacute;ste no encuentra lo que busca por mala experiencia, mal dise&ntilde;o, mal uso de palabras. Esto quiere decir que el Marketing es un entramado de dise&ntilde;o, texto y publicidad en todos los sentidos</div>
</div>
</div>

<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#resourcesDMS">Crees que no tienes los recursos para darte el lujo obtener de la mano de profesioales tu propia estrategia?</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="resourcesDMS">
<div class="card-body">Crees que no posees las condiciones o recursos para solicitar nuestros servicios? Te equivocas, para Tun Daapo el marketing digital debe ser un derecho de todos, por lo que <strong>ponemos a su alcance lo mejor de las estrategias basado en su presupesto</strong>, pues como piensa hacer crecer su idea si no va de la mano con una buena difusi&oacute;n de lo que hace? Este equipo de trabajo <strong>hace escalable los servicios que oferta</strong>, solo <strong>pagar&aacute; por lo que en la realdiad actual de su negocio necesita</strong>. <strong>Una consultor&iacute;a con nosotros es totalmente gratis</strong>, solo cont&aacute;ctenos con un mensaje donde incluya en breve detalle sus preocupaciones y espectativas, agendaremos una cita y podremos vernos cara a cara v&iacute;a remota debatirlas y darle algunos consejos; y si queda convencido, entonces desarrollaremos juntos un plan que haga crecer sin fin su negocio.</div>
</div>
</div>';
      $sectiontun_daapo->save();
      $contentType='Section';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#needDMS">How i know that i need a Digital Marketing Strategy?</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="needDMS">
<div class="card-body">You make <strong> a product </strong> that has everything to be good and commercial, <strong> has excellent quality and a very good price, yet you wonder why it doesn&#39;t sell as much as you expected </strong>, or worse , nor is it for sale! <strong> You dream of being known, followed and highly valued </strong>, with <strong> having an established and well-publicized brand </strong>! You do not have a presence in any of the digital channels such as social networks or presentation website. You have some or all of them but they do not have the result you expected because they have obtained few or no visits for a while. All this indicates that <strong> the management of your digital presence is poor in design and / or communication </strong>. Your strategy, if you have one, is not working, it must be changed, improved or, failing that, totally reworked from a perspective more focused on you. If your service, project or product has not had the development or obtained the sales that you expected, you do not even see in the immediate future the solution that will change this situation and you do not know what to do, you are needing exactly one or more of the services that Tun Daapo offers. A good marketing strategy will make you known and take off like you never thought before.</div>
</div>
</div>

<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#iNeedDMS">Why i need a Digital Marketing Strategy?</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="iNeedDMS">
<div class="card-body">Even though it is known that with digitization all businesses have had to reinvent themselves as a result of the infinite opportunities offered by the technological world, many, either due to disbelief, ignorance or lack of resources, do not have a digital presence according to the professional field in which they are developed. . This means that even if <strong> a few years ago you had a good flow of customers in your business </strong>, if <strong> now you are one of those who are without a presence in </strong> what is known as <strong> internet </strong>, you have almost certainly lost a good part of the sales that you previously obtained when the opposite should have happened. Vice versa to what many understand, <strong> a good presence on the web is necessary for everyone </strong>, in Cuba, as in the rest of the world, I would say that even a peddler who sells vegetables, fruits or whatever, it must have visibility on a digital platform.</div>
</div>
</div>

<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#whatIsDMS">What is a Digital Marketing Strategy?</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="whatIsDMS">
<div class="card-body">A marketing strategy is a <strong> adequate and personalized plan </strong> elaborated for an entity with guidelines or strategies to develop and follow, <strong> whose final objective is to achieve an end </strong> which may be to increase your visibility, your total sales or of a specific product or service; promote a special offer in a certain period, an event, a conference. In other words, <strong> reach your audience to achieve what is expected of them </strong>.</div>
</div>
</div>

<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#examplesDMS">Do you need examples of Marketing Strategy?</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="examplesDMS">
<div class="card-body">Simple and current. <strong> In times of COVID-19 </strong> there have been temporary business closures, including movement restrictions. Taking the peddler as an example, do you think that <strong> if he were accessible via digital </strong>, that is, <strong> had a Facebook profile </strong> with a good personalization of his data, where it appears what he does and how to contact him, <strong> could he continue to market his products from home </strong>? Well of course it is! He would only need to take what he sold to the buyer&#39;s home without having to preach for hours, thus avoiding the risk offered by being on the street where the product is manipulated by people who many times do not even buy what they take in hand. And even better still, his sales would skyrocket compared to other peddlers like him, because the difference lies in how close you are to your community, say community to the universe of people who need what you offer and do not know who sells it and / or How to request it without having to wait by divinity of the destination that this service, or product arrives at the door of your house or business. A little more complicated when developing your marketing strategy, is <strong> a producer </strong> of guavas or mango, let&#39;s think of tropical fruits (It could be any type of product or service), that <strong> you want to look for new markets </strong> for its harvest because, for example, in Cuba there are many producers of the same and the excess of production often goes to waste because it does not have enough buyers or who processes it for other purposes, and / or simply &lt; strong&gt; wants to obtain foreign exchange to be able to buy supplies abroad, either due to their inexistence in the country or due to their insufficient quality for what is needed. The ideal thing for this producer is to be able to tender or contract the trade of his merchandise with companies based in places that are not tropical, cold, or with high demand for their production. To achieve this the least expensive way, even if it may not seem like it, is a good marketing strategy supported by SEO positioning techniques, and to fully catapult it, an advertising strategy &quot;SEM or paid&quot; (That from Cuba the latter is often difficult not to say impossible, however with the former it has approximately 70% gained if it is developed efficiently and effectively).</div>
</div>
</div>

<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#designImageDMS">A good Image and design into Publicity and Comunication Strategy?</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="designImageDMS">
<div class="card-body"><strong>Design, layout, create and reproduce </strong> your idea using an image, logo, video, text or web presentation and based on <strong> design oriented towards a quality user interface (UI) </strong> and a <strong> excellent user experience (UX) </strong> it is possible to develop web pages and applications using well-known languages ​​and frameworks such as HTML, CSS, JavaScript, PHP, Bootstrap, VueJs, Laravel; thus obtaining a scalable product, easy to update, maintain and improve in the future. <strong> A call to action in the right place and time </strong>, using the keywords that interest you, relying on an image and / or video that complements the information you want to reach the user will make it almost impossible to abandon the proposal you offer them. All this <strong> supported by SEO optimization helps the development of marketing </strong>, a good SEM campaign is useless if when directing the captured user to where we want, he does not find what he is looking for due to bad experience, bad design, misuse of words. This means that Marketing is a framework of design, text and advertising in every way.</div>
</div>
</div>

<div class="card mb-4 shadow"><!-- Card Header - Accordion -->
<h6><a class="d-block card-header py-3" href="#resourcesDMS">Are you think you do not have enough money to make this??</a></h6>
<!-- Card Content - Collapse -->

<div class="collapse show" id="resourcesDMS">
<div class="card-body">Do you think you do not have the conditions or resources to request our services? You&#39;re wrong, for Tun Daapo digital marketing should be everyone&#39;s right, so <strong> we offer you the best of strategies based on your budget </strong>, because how do you plan to grow your idea if it doesn&#39;t hand in hand with a good diffusion of what it does? This work team <strong> makes the services it offers scalable </strong>, only <strong> will pay for what you need in the current reality of your business </strong>. <strong> A consultation with us is totally free </strong>, just contact us with a message where you include in brief detail your concerns and expectations, we will schedule an appointment and we can meet face to face remotely, discuss them and give you some advice; And if you are convinced, then we will develop together a plan that will grow your business without end.</div>
</div>
</div>';
      $content_title='Are you Need an Digital Strategy';
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
      $sectiontun_daapo->title='Términos y Condiciones';
      $sectiontun_daapo->description='<h1 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:xx-large">T&eacute;rminos y condiciones de desarrollo web</span></span></span></h1>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">T&eacute;rminos y Condiciones definomo se entiende un contrato de servicios entre <strong>Tun Daapo</strong> (en lo adelante &ldquo;<strong>la empresa</strong>&rdquo;) y la persona f&iacute;sica o jur&iacute;dica que recibir&aacute; los servicios (en lo adelante <strong>cliente</strong>).</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Aceptaci&oacute;n por parte del cliente:</span></span></span></p>

<p style="text-align:justify">&nbsp;</p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">La presencia del acceso a T&eacute;rminos y Condiciones es visible y accesible desde cualquier p&aacute;gina de la web de la empresa, el cliente debe llerlos con atenci&oacute;n. Desde el momento que&nbsp;<strong><strong>el cliente</strong>&nbsp;acepta un presupuesto de la empresa est&aacute; aceptando autom&aacute;ticamente estos t&eacute;rminos y condiciones</strong>, sin necesidad de haberlos firmado, pues el enlace a estos t&eacute;rminos aparece en todos los presupuestos.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">El derecho de a&ntilde;adir, eliminar, o modificar cualquiera de las disposiciones de estos t&eacute;rminos y condiciones se reserva a la empresa sin previo aviso y en cualquier momento. La no recepci&oacute;n de notificaci&oacute;n de alguno de los cambio en estos t&eacute;rminos y condiciones no invalida el cambio o los cambios realizados.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Pago de servicios a la empresa:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Todos&nbsp;<strong><strong>los precios que provee la empresa son sin IVA</strong></strong>&nbsp;(impuestos) a no ser que se especifique lo contrario.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">La empresa define, en el presupuesto que env&iacute;a al cliente por email, el precio de los servicios prestados. Los presupuestos emitidos por la empresa son v&aacute;lidos por 30 d&iacute;as a no ser que &eacute;sta indique lo contrario, luego de este per&iacute;odo la empresa puede modificarlos si as&iacute; lo estima.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Si el cliente propone alg&uacute;n tipo de cambio no contemplado inicialmente; o por causas que estime oportunas, la empresa se reserva el derecho a alterar el o los presupuestos. De cualquier manera un presupuesto no tiene ning&uacute;n valor contractual hasta que la empresa y el cliente formalicen el inicio del proyecto por medio del pago de la primera factura.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong>La empresa cobrar&aacute; un 35% del precio total por adelantado</strong> del proyecto encargado por el cliente salvo que se disponga algo diferente con el cliente. Al final del proyecto se abonar&aacute; el 65% restante para la entrega por parte de la empresa de los archivos para la migraci&oacute;n. Hasta que el cliente no abone el 35% inicial no se empezar&aacute; ning&uacute;n proyecto; as&iacute; como no se entregar&aacute; ninguno de los archivos del proyecto si no se recibe antes el 65% final del pago.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong>La empresa cobrar&aacute; el primer mes por adelantado en el caso de servicios peri&oacute;dicos</strong> como campa&ntilde;as SEM o mantenimiento SEO, luego ser&aacute; al final de cada mes a no ser que el cliente y la empresa acuerden otra cosa.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong><strong>El pago de los servicios se realizar&aacute; por medio de la v&iacute;a acordada en el presupuesto, </strong>puede ser transferencia bancaria o transferencia a monederos virtuales como Paypal, Airtm, Tropipay u otro determinado por la empresa. La justificante de este pago se enviar&aacute; por el cliente a la empresa v&iacute;a email.</strong></span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong><strong>El cliente proveer&aacute; a la empresa su n&uacute;mero de tarjeta de cr&eacute;dito en el caso de los anuncios en las campa&ntilde;as SEM</strong> para que Google, Facebook o las epresas proveedoras carguen directamente el coste de los anuncios a su cuenta.</strong></span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Plazos de entrega:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong><strong>Los plazos de entrega ser&aacute;n acordados por la empresa con el cliente </strong>antes de la aceptaci&oacute;n del presupuesto, donde &eacute;sta se compromete a respetarlos al m&aacute;ximo.</strong></span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Al realizar el pago inicial del 35% del precio total por la v&iacute;a acordada previamente, el cliente se compromete a aportar los contenidos de la web (textos, im&aacute;genes, v&iacute;deos, gr&aacute;ficos, archivos de sonido) junto al pago.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Requisitos para instalar la web:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">El cliente acepta proveer a la empresa acceso temporal a su hosting v&iacute;a FTP si requiere que su web sea instalada en un servidor de su elecci&oacute;n. La empresa tambi&eacute;n puede necesitar accesos del cliente a otros recursos del servidor dependiendo de la naturaleza espec&iacute;fica del proyecto.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong>El proyecto se desarrollar&aacute; en un servidor de pruebas propiedad de la empresa. </strong>El cliente tendr&aacute; acceso a su web en el servidor de pruebas para ver los cambios en su proyecto.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong>La migraci&oacute;n a un hosting</strong> de los proyectos web de la empresa <strong>se incluye dentro de los servios presupuestados</strong> una vez terminado el proyecto, siempre y cuando sea un hosting Linux con base de datos MySQL. <strong>Cuando no se conozca el tiempo que podr&iacute;a invertirse en un hosting no probado por la empresa antes</strong>, esto ser&aacute; notificado al cliente y deber&aacute; tenerse en cuenta en el tiempo de entrega final, <strong>reserv&aacute;ndose as&iacute;</strong> <strong>la empresa el derecho de facturar el tiempo invertido</strong> en estudiar su panel de control.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong>El mantenimiento del hosting ir&aacute; a cargo del cliente una vez migrada la web</strong>, a no ser que contrate mantenimiento web con la empresa (ver apartado &ldquo;Mantenimiento de la web&rdquo;). La empresa no trabaja en ning&uacute;n caso con hostings que no sean Linux.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Gesti&oacute;n de cuentas de AdWords o Facebook Ads:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">La empresa gestiona las cuentas de publicidad del cliente desde su propia cuenta de usuario; a la que tendra acceso &uacute;nico para garantizar que puede rentabilizar el presupuesto en clicks del cliente. Cuando el cliente desea expresamente que la empresa dise&ntilde;e su campa&ntilde;a de publicidad desde su cuenta de usuario o tener acceso compartdo a esa cuenta la contrataci&oacute;n del servicio implicar&aacute; un pago inicial de 350 euros en concepto de dise&ntilde;o de campa&ntilde;a y una permanencia m&iacute;nima de 6 meses.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Copyright de los contenidos:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Cuando el cliente no contrata la elaboraci&oacute;n de contenidos a la empresa, el <strong>cliente se compromete a aportar contenidos in&eacute;ditos</strong>, que sean de su propiedad. La empresa puede pedir en cualquier momento al cliente justificaci&oacute;n documental de la autor&iacute;a de textos, fotos y videos. <strong>En ning&uacute;n caso usar&aacute; en el desarrollo del proyecto web material que no sea propiedad del cliente.</strong></span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Ante posibles requerimientos de autoridades pertinentes <strong>el cliente responder&aacute; del copyrights sobre el material usado</strong> en su web y <strong>mantendr&aacute; a la empresa libre de posibles demandas de terceros</strong> por negligencia o incapacidad de obtener los derechos de autoe de los contenidos.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Cumplimiento de la LOPD:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Bajo petici&oacute;n, dentro del precio de todos los proyectos, la empresa <strong>incluir&aacute; una p&aacute;gina de aviso legal y una p&aacute;gina de pol&iacute;tica de privacidad</strong> accesible desde el pie de la p&aacute;gina web; l<strong>os textos ser&aacute;n aportados por el cliente</strong>, quien se responzabilizar&aacute; de su adecuaci&oacute;n a la legislaci&oacute;n vigente.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Revisiones de cambios:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong>El cliente tiene derecho a 2 revisiones de cambios del proyecto</strong>, salvo que la empresa y el cliente hayan acordado otra cosa; las cuales implicar&aacute;n peque&ntilde;as modificaciones (tipograf&iacute;as, fotograf&iacute;as, inclusi&oacute;n o exclusi&oacute;n de elementos, etc.), <strong>no incluye en ning&uacute;n momento revisiones sustanciales</strong> de dise&ntilde;o(cambios en la estructura de la web, maquetaci&oacute;n de las secciones, programaci&oacute;n adicional de funcionalidades web, etc.) o de contenido(textos, im&aacute;genes, etc.).</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">La empresa ser&aacute; quien siempre valore el alcance de los cambios solicitados, informar&aacute; al cliente si implican dedicaci&oacute;n adicional que requiera cambios en el presupuesto. Si el cliente solicita revisi&oacute;n sustancial, la empresa presupuestar&aacute; los cambios solicitados y los a&ntilde;adir&aacute; al presupuesto global para que &eacute;ste los abone al final del proyecto.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong>El cliente podr&aacute; revisar </strong>cuando la empresa le entregue su informe trimestral, o <strong>con la periodicidad acordada</strong> entre las dos partes <strong>el rendimiento de su campa&ntilde;a en el caso de las campa&ntilde;as SEM</strong>. El cliente puede proponer cambios en la campa&ntilde;a, la empresa se reserva el derecho de no aplicr dichos cambios si ve que estos pueden afectar su buen rendimiento . La empresa se compromete, a cambio, a lograr tasa de conversiones superior a la que lograr&iacute;a otro profesional o gestionando elcliente su propia campa&ntilde;a.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong>El cliente podr&aacute; revisar el post</strong> que redacten los profesionales de la empresa para su blog <strong>y corregir incorreciones mensualmente</strong> en las campa&ntilde;as de mantenimiento SEO con marketing de contenidos, pero <strong>nunca podr&aacute; proponer modificaciones sustanciales</strong>, pues requerir&iacute;an abonar el importe de dos posts. Debe tener presente que cada profesional en marketing de contenidos tiene un estilo propio.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Ausencia de &lsquo;feedback&rsquo; por parte del cliente:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Para ser competitivo se necesita ser eficiente, para lograrlo la empresa debe asegurarse que los plazos establecidos para la terminaci&oacute;n de un proyecto sean cumplidos. Incluso la empresa puede rechazar peticiones de presupuesto y proyectos para asegurarse que los proyectos en marcha se entreguen en los plazos acordados.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong>Si no tiene por adelantado los contenidos </strong>bien clasificados y listos para su inclusi&oacute;n en la web l<strong>a empresa no empezar&aacute; ning&uacute;n proyecto</strong>, a no ser que el cliente haya contratado los servicos de provisi&oacute;n de contenidos a la empresa o que se haya pactado entre empresa y cliente algo diferente.Cuando se contrata por el cliente una estrategia SEO para sus proyectos web, deben tener en cuenta que es imprescindible la entrega del contenido por adelantado, as&iacute; se podr&aacute; planificar la estructura web y revisar las palabras clave adecuadas para posicionar mejor sus p&aacute;ginas en buscadores.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">La empresa se reserva el derecho de dar por cerrado el proyecto si al inicio del mismo el cliente incumple con la promesa de aportar los contenidos necesarios tardando m&aacute;s de una semana, si esto sucede el cliente pierde autom&aacute;ticamente el abonado inicial del 35% del importe total.</span></span></span></p>

<p style="text-align:justify"><br />
&nbsp;</p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong><strong>El retraso countinuado </strong>de m&aacute;s de una semana<strong> en entregar contenidos faltantes o en revisar los cambios </strong>durante el desarrollo del proyecto<strong> puede provocar un recargo por parte de la empresa </strong>del 5% al precio fiinal por cada semana de retraso. Si los retrasos son con frecuencia la empresa se reserva el derecho de rescindir unilateralmente el proyecto, entregarlo en su estado actual y pasar al cliente la factura con todo lo trabajado hasta la fecha.</strong></span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong>Si el cliente no est&aacute; preparado</strong> <strong>para</strong> asegurarse que en el momento de empezar el proyecto podr&aacute; <strong>proveer todo lo que la empresa necesita</strong> para prestar eficientemente sus servicios, <strong>no debe comprometerse</strong> con la empresa <strong>hasta que lo est&eacute;</strong>.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Exceso de &lsquo;feedback&rsquo; por parte del cliente:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">La existencia de varios proyectos en marcha por parte de la empresa implica que &eacute;sta no pueda proporcionarle un feedback continuado, m&aacute;s all&aacute; de lo que necesariamente surja durante el proyecto, esto es aceptado por el cliente. </span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Para que la empresa sea competitiva en precios y calidad no puede reunirse de forma presencial a no ser que el presupuesto incluya reuniones o acuerde lo contrario con el cliente, siendo esta aclaraci&oacute;n acptada por el cliente. Como v&iacute;a de comunicaci&oacute;n con el cliente se utilizar&aacute; por parte de la empresa y el cliente los emails. Si se requiere alguna euni&oacute;n adicional a la mitad del proyecto la empresa se reserva el derecho de ampliar el presupuesto para incluir el tiempo invertido en el encuentro o cambiarla por una llamada por Skype o similar, que tambi&eacute;n se incluir&aacute; en el presupuesto final si no le es posible asistir por cuestiones de agenda.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Cancelaci&oacute;n de un proyecto:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Siempre que se haga por escrito, el cliente tiene derecho a cancelar un proyecto. La empresa emitir&aacute; una factura con el importe del trabajo realizado hasta la fecha de la notificaci&oacute;n que deber&aacute; ser abonada por el cliente antes del final del mismo mes.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Funcionamiento de las webs en diferentes dispositivos y navegadores:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Es un compromiso de la empresa que sus proyectos web sean adaptables a los principales dispositivos y navegadores m&aacute;s usados (Firefox, Internet Explorer en sus &uacute;ltimas versiones, Google Chrome, etc.), pero no garantiza el funcionamiento de todas las funcioalidades web con ciertos tipos de sistemas operativos. El cliente acepta esta condici&oacute;n, tanto como el hecho de que la empresa no es responsible de la adaptaci&oacute;n de la p&aacute;gina a nuevas versiones de navegadores y dispositivos, reserv&aacute;ndose el derecho de presupuestarlo adicionalemente. La empresa no dispone f&iacute;sicamente de todos los dispositivos del mercado para testear directamente su web y usa simuladores que pueden, en muy raras ocasiones, no coincidir 100% con la visualizaci&oacute;n del dispositivo en cuesti&oacute;n y esto debe ser aceptado por el cliente.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Gesti&oacute;n de la web o la tienda online:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">La entrega de webs y tiendas online por parte de la empresa son f&aacute;ciles de autogestionar, sin embargo el cliente acepta que debe contar con conocimientos b&aacute;sicos (gesti&oacute;n de textos, precios, cupones y promociones; adici&oacute;n o supresi&oacute;n de productos, etc.) para ello. La empresa presupuestar&aacute; aparte si el cliente necesita capturas de pantalla o tutoriales de cualquier tipo escritos o en video.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong>Los conceptos autogestionables no incluyen aquellos que pueden ocasionar problemas de dise&ntilde;o</strong> como el descuadre, tama&ntilde;os, colores y tipos de fuentes, medida de las im&aacute;genes, footer, proporciones de las secciones; la empresa no se har&aacute; responsible por los cambios que ocasionen estos problemas y no respeten la configuraci&oacute;n inicial, esto es aceptado por el cliente.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Mantenimiento de la web:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Al momento de la entrega la empresa proporcionar&aacute; una web en perfecto funcionamiento que debe ser comprobado por el cliente en ese momento. <strong>Cualquier necesidad que surja posteriormente a la entrega ser&aacute; presupuestada aparte</strong> y se llevar&aacute; a cabo de acuerdo a la disponibildad de la empresa, incluidas las que tengan car&aacute;cter de urgencia (web ca&iacute;da del servidor, carga lenta, virus en bases de datos u otros) y las que tienen car&aacute;cter peri&oacute;dico (adaptaciones de la web a nuevas versiones de navegadores o dispositivos, actualizaciones de plugins y software, etc.)</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Este concepto tambi&eacute;n incluye la actualizaci&oacute;n del gestor de contenidos de la web o la solventaci&oacute;n de errores que el ciente haya cometido al modificar su web o de cualquier otro tipo, contacto con el proveedor de hpstong del cliente en caso de problema o cualquier necesdad que surja luego de la entrega, testeo de pagos o de env&iacute;o de formularios o cualquier concepto derivado del funcionamiento de la web, incluyendo la asesor&iacute;a.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Si el contrato de los servicios de mantenimiento de la web fuera con la empresa, el cliente tiene derecho a que la empresa solvente las necesidades mencionadas de acuerdo con las condiciones de la modalidad de servico que se haya contratado, excluyendo modificaciones sustanciales de la web, que no est&aacute;n incluidas en ninguna modalidad de mantenimiento web (ver condiciones espec&iacute;ficas de cada servicio). La empresa puede presupuestar adicionalmente modificaciones derivadas de una manipulaci&oacute;n del c&oacute;digo por parte del cliente, po r ser este un problema ajeno a la empresa aunque tenga contratado servicio de mantenimiento web.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Mantenimiento del dominio y del hosting:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Los dominios que el cliente necesite comprar la empresa los pondr&aacute; a nombre del cliente, quien se har&aacute; responsable del pago de su cuota annual por medio de tarjeta de cr&eacute;dito o la forma de pago que desee.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Si el cliente contrata el servicio de mantenimiento web a la empresa que va asociado al hosting que ofrece la empresa no tendr&aacute; que asumir cpstes adicionales porque el precio del hosting se incluye en la cuota de mantenimiento web.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><strong><strong>La cancelaci&oacute;n del servicio de mantenimiento web con la empresa por parte del cliente significa que &eacute;ste &uacute;ltimo deber&aacute; migrar antes su web a otro hosting de su elecci&oacute;n, </strong>no podr&aacute; conservar el que le prove&iacute;a la empresa dado que los dos servicios est&aacute;n vinculados contractualmente. Si necesita que la migraci&oacute;n al nuevo hosting la haga la empresa, el presupuesto de esa migraci&oacute;n se enviar&aacute; aparte.</strong></span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Cr&eacute;ditos de desarrollo web:</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Aunque la web del cliente no contendr&aacute; ninguna referencia a la empresa el cliente acepta que la &eacute;sta incluya su web en su portafolio.</span></span></span></p>';
      $sectiontun_daapo->save();
      $contentType='Section';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Terms and conditions of web development</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">Terms and Conditions Definomo means a service contract between Tun Daapo (hereinafter &quot;<strong>the company</strong>&quot;) and the natural or legal person who will receive the services (hereinafter <strong>client</strong>).</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Acceptance by the client:</span></span></h3>

<p style="text-align:justify">&nbsp;</p>

<p style="text-align:justify"><span style="color:#ffffff">The presence of access to Terms and Conditions is visible and accessible from any page of the company&#39;s website, the client must fill them carefully. From the moment the client accepts a quote from the company, he is automatically accepting these terms and conditions, without having to sign them, as the link to these terms appears in all quotes.</span></p>

<p style="text-align:justify"><span style="color:#ffffff"><strong>The right to add, delete, or modify any of the provisions of these terms and conditions is reserved to the company without prior notice and at any time</strong>. Failure to receive notification of any of the changes in these terms and conditions does not invalidate the change or changes made.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Payment of services to the company:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">All prices provided by the company are without VAT (taxes) unless otherwise specified.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The company defines, in the budget that it sends to the client by email, the price of the services provided. The budgets issued by the company are valid for 30 days unless it indicates otherwise, after this period the company can modify them if it deems it so.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">If the client proposes some type of change not contemplated initially; or for reasons it deems appropriate, the company reserves the right to alter the budget (s). In any case, a budget has no contractual value until the company and the client formalize the start of the project by paying the first invoice.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The company will charge 35% of the total price in advance of the project commissioned by the client unless something different is arranged with the client. At the end of the project, the remaining 65% will be paid for the delivery by the company of the files for migration. Until the client pays the initial 35%, no project will start; as well as none of the project files will be delivered if the final 65% of the payment is not received before.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The company will charge the first month in advance in the case of periodic services such as SEM campaigns or SEO maintenance, then it will be at the end of each month unless the client and the company agree otherwise.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The payment of the services will be made through the route agreed in the budget, it can be a bank transfer or transfer to virtual wallets such as Paypal, Airtm, Tropipay or another determined by the company. The proof of this payment will be sent by the client to the company via email.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The client will provide the company with his credit card number in the case of advertisements in SEM campaigns so that Google, Facebook or the supplier companies directly charge the cost of the advertisements to his account.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Delivery times:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">Delivery times will be agreed by the company with the client before accepting the budget, where it undertakes to respect them as much as possible.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">By making the initial payment of 35% of the total price through the previously agreed route, the client agrees to provide the contents of the website (texts, images, videos, graphics, sound files) together with the payment.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Requirements to install the web:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">The client agrees to provide the company with temporary access to their hosting via FTP if they require their website to be installed on a server of their choice. The company may also need client access to other server resources depending on the specific nature of the project.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The project will be developed on a test server owned by the company. The client will have access to your website on the test server to see the changes in your project.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The migration to a hosting of the company&#39;s web projects is included within the budgeted services once the project is finished, as long as it is a Linux hosting with a MySQL database. When the time that could be invested in a hosting not tested by the company before is not known, this will be notified to the client and must be taken into account in the final delivery time, thus reserving the company the right to invoice the time invested in studying its control Panel.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The maintenance of the hosting will be the responsibility of the client once the web has been migrated, unless they contract web maintenance with the company (see section &ldquo;Maintenance of the web&rdquo;). The company does not work in any case with hostings other than Linux.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Management of AdWords or Facebook Ads accounts:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">The company manages the customer&#39;s advertising accounts from its own user account; To which you will have unique access to guarantee that you can make the budget profitable in customer clicks. When the client expressly wishes the company to design its advertising campaign from its user account or to have shared access to that account, contracting the service will imply an initial payment of 350 euros for campaign design and a minimum stay of 6 months.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Copyright of the contents:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">When the client does not contract the production of content to the company, the client agrees to provide unpublished content, which is their property. The company can ask the client at any time for documentary justification of the authorship of texts, photos and videos. In no case will it use material that is not owned by the client in the development of the web project.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">Before possible requirements of pertinent authorities, the client will respond to the copyrights on the material used on its website and will keep the company free from possible lawsuits from third parties for negligence or inability to obtain the copyright of the contents.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Compliance with the LOPD:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">Upon request, within the price of all projects, the company will include a legal notice page and a privacy policy page accessible from the footer of the web page; the texts will be provided by the client, who will be responsible for their adaptation to current legislation.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Change reviews:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">The client is entitled to 2 project change reviews, unless the company and the client have agreed otherwise; which will involve small modifications (fonts, photographs, inclusion or exclusion of elements, etc.), does not include at any time substantial design revisions (changes in the structure of the web, layout of the sections, additional programming of web functionalities, etc. .) or content (texts, images, etc.).</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The company will always assess the scope of the requested changes, will inform the client if they involve additional dedication that requires changes in the budget. If the client requests a substantial review, the company will budget for the requested changes and add them to the overall budget for the client to pay at the end of the project.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The client will be able to review when the company delivers its quarterly report, or with the periodicity agreed between the two parties, the performance of its campaign in the case of SEM campaigns. The client can propose changes in the campaign, the company reserves the right not to apply these changes if it sees that these may affect its good performance. The company undertakes, in return, to achieve a conversion rate higher than that achieved by another professional or by managing the client&#39;s own campaign.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The client will be able to review the post that the professionals of the company write for their blog and correct monthly errors in the SEO maintenance campaigns with content marketing, but they will never be able to propose substantial modifications, as they would require paying the amount of two posts. You should keep in mind that each content marketing professional has their own style.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Absence of &#39;feedback&#39; from the client:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">To be competitive you need to be efficient, to achieve this the company must ensure that the deadlines established for the completion of a project are met. Even the company can reject budget and project requests to ensure that ongoing projects are delivered within the agreed deadlines.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">If the content is not well classified and ready for inclusion on the web in advance, the company will not start any project, unless the client has contracted the content provision services to the company or it has been agreed between the company and the client. something different.When the client hires an SEO strategy for their web projects, they must take into account that it is essential to deliver the content in advance, so they can plan the web structure and review the appropriate keywords to better position their pages in search engines.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The company reserves the right to close the project if at the beginning of the project the client fails to comply with the promise to provide the necessary content, taking more than a week, if this happens the client automatically loses the initial payment of 35% of the total amount .</span></p>

<p style="text-align:justify">&nbsp;</p>

<p style="text-align:justify"><span style="color:#ffffff">The delayed delay of more than a week in delivering missing content or in reviewing changes during the development of the project can cause a surcharge by the company of 5% to the final price for each week of delay. If the delays are frequent, the company reserves the right to unilaterally terminate the project, deliver it in its current state and send the client the invoice with everything worked to date.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">If the client is not prepared to ensure that when the project begins, it will be able to provide everything the company needs to efficiently provide its services, it should not commit to the company until it is.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Excess &#39;feedback&#39; by the client:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">The existence of several ongoing projects by the company implies that it cannot provide continuous feedback, beyond what necessarily arises during the project, this is accepted by the client.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">For the company to be competitive in prices and quality, it cannot meet in person unless the budget includes meetings or otherwise agreed with the client, this clarification being accepted by the client. Emails will be used by the company and the client as a means of communication with the client. If an additional meeting is required in the middle of the project, the company reserves the right to extend the budget to include the time invested in the meeting or change it for a Skype call or similar, which will also be included in the final budget if not. It is possible to attend due to scheduling issues.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Canceling a project:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">As long as it is done in writing, the client has the right to cancel a project. The company will issue an invoice with the amount of the work carried out until the date of the notification that must be paid by the client before the end of the same month.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Operation of the webs in different devices and browsers:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">It is a commitment of the company that its web projects are adaptable to the main devices and most used browsers (Firefox, Internet Explorer in its latest versions, Google Chrome, etc.), but it does not guarantee the operation of all web functionalities with certain types operating systems. The client accepts this condition, as well as the fact that the company is not responsible for adapting the page to new versions of browsers and devices, reserving the right to additionally budget for it. The company does not physically have all the devices on the market to directly test its website and uses simulators that may, on very rare occasions, not coincide 100% with the display of the device in question and this must be accepted by the customer.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Management of the website or online store:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">The delivery of websites and online stores by the company are easy to self-manage, however the client accepts that they must have basic knowledge (management of texts, prices, coupons and promotions; addition or deletion of products, etc.) for this . The company will budget separately if the client needs screenshots or tutorials of any kind, written or on video.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">Self-manageable concepts do not include those that can cause design problems such as misfit, sizes, colors and types of fonts, image size, footer, section proportions; The company will not be responsible for the changes that cause these problems and do not respect the initial configuration, this is accepted by the customer.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Website maintenance:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">At the time of delivery, the company will provide a perfectly functioning website that must be checked by the client at that time. Any need that arises after delivery will be budgeted separately and will be carried out according to the availability of the company, including those of an urgent nature (web server crash, slow loading, virus in databases or others) and those of a periodic nature (adaptations of the web to new versions of browsers or devices, plugin and software updates, etc.)</span></p>

<p style="text-align:justify"><span style="color:#ffffff">This concept also includes updating the website&#39;s content manager or solving errors that the client has made when modifying their website or of any other type, contacting the client&#39;s hpstong provider in case of problem or any need that arises. after delivery, payment testing or submission of forms or any concept derived from the operation of the website, including advice.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">If the contract for the maintenance services of the website were with the company, the client has the right to have the company solve the aforementioned needs in accordance with the conditions of the service modality that has been contracted, excluding substantial modifications of the website, that are not included in any type of web maintenance (see specific conditions of each service). The company can additionally budget for modifications derived from a manipulation of the code by the client, as this is a problem outside the company even if it has contracted web maintenance service.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Domain and hosting maintenance:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">The domains that the client needs to buy the company will put them in the name of the client, who will be responsible for the payment of their annual fee by credit card or the form of payment they want.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">If the client contracts the web maintenance service to the company that is associated with the hosting offered by the company, he will not have to assume additional costs because the price of the hosting is included in the web maintenance fee.</span></p>

<p style="text-align:justify"><span style="color:#ffffff">The cancellation of the web maintenance service with the company by the client means that the latter must first migrate his website to another hosting of his choice, he will not be able to keep the one provided by the company since the two services are contractually linked. If you need the migration to the new hosting to be done by the company, the budget for that migration will be sent separately.</span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px">Web development credits:</span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff">Although the client&#39;s website will not contain any reference to the company, the client accepts that it includes its website in its portfolio.</span></p>';
      $content_title='Terms and Conditions';
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
      $sectiontun_daapo->title='Política de Privacidad';
      $sectiontun_daapo->description='<h1 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:xx-large">Pol&iacute;tica de Privacidad</span></span></span></h1>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">El establecimiento de los t&eacute;rminos en que Tun Daapo usa y protege la informaci&oacute;n personal o no que es proporcionada por sus usuarios en el momento de utiilizar su sitio web se presenta a continuaci&oacute;n como Pol&iacute;tica de Privacidad.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Tun Daapo celebra que est&eacute;s leyendo esta paǵina, teniendo en cuenta que seg&uacute;n las anal&iacute;ticas web refieren que es visitada por muy pocos usuarios.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">U<strong>na versi&oacute;n corta de la pol&iacute;tica de privacidad de nuestra web</strong> es tan simple como coomo que los datos que nos proporciones al ponerte en contacto con nosotros solo ser&aacute;n usados a fin de mantener nuestra relaci&oacute;n comercial o para informarte de novedades, ofertas, productos y servicios que pensemos que te va a brindar alg&uacute;n beneficio, y si no quieres que lo conservemos solo tienes que dec&iacute;rnoslo y dejaremos de usarlos.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Si quieres indagar en el tema la versi&oacute;n larga se lee a continuaci&oacute;n:</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">La Pol&iacute;tica de Priivacidad establece </span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">El presente Pol&iacute;tica de Privacidad establece los t&eacute;rminos en que Tun Daapo usa y protege la informaci&oacute;n que es proporcionada por sus usuarios en el momento de utilizar su sitio web. Tun Daapo se compromete con la seguridad de los datos de sus usuarios. Cuando pedimos rellenar los campos de informaci&oacute;n personal con la cual puedes ser identificado, lo hacemos asegurando que s&oacute;lo se emplear&aacute; de acuerdo con los t&eacute;rminos de este documento. Sin embargo esta Pol&iacute;tica de Privacidad puede cambiar con el tiempo o ser actualizada por lo que te recomendamos y enfatizamos revisar continuamente esta p&aacute;gina para asegurarte que est&aacute;s de acuerdo con dichos cambios.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Informaci&oacute;n que se recoge</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Nuestro sitio web recoger&aacute; informaci&oacute;n personal por ejemplo: Nombre, informaci&oacute;n de contacto como tu direcci&oacute;n de correo electr&oacute;nico e informaci&oacute;n demogr&aacute;fica. Podr&aacute; ser requerida adicionalmente informaci&oacute;n espec&iacute;fica para procesar alg&uacute;n pedido o realizar una entrega o facturaci&oacute;n.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Uso de la informaci&oacute;n recogida</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Nuestro sitio web emplea la informaci&oacute;n con el fin de proporcionar la mejor experiencia y servicio posible, particularmente para mantener un registro de usuarios, de pedidos en caso que aplique, y mejorar nuestros productos y servicios. Es posible que te llamemos o te enviemos correos electr&oacute;nicos peri&oacute;dicamente a trav&eacute;s de nuestro sitio con ofertas especiales, nuevos productos y otra informaci&oacute;n publicitaria que consideremos relevante para ti o que pueda brindarte alg&uacute;n beneficio. Estos correos electr&oacute;nicos y llamadas se har&aacute;n a la direcci&oacute;n y tel&eacute;fono que proporciones y podr&aacute;n ser cancelados en cualquier momento.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Tun Daapo est&aacute; altamente comprometida en mantener tu informaci&oacute;n segura. Usamos los sistemas m&aacute;s avanzados y los actualizamos constantemente para asegurarnos que no exista ning&uacute;n acceso no autorizado.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Uso de&nbsp;<em>cookies</em></span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Una&nbsp;<em>cookie</em>&nbsp;se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en tu ordenador. Al aceptar la pol&iacute;tica de&nbsp;<em>cookies</em>, dicho fichero se crea y la&nbsp;<em>cookie</em>&nbsp;sirve entonces para obtener informaci&oacute;n respecto al tr&aacute;fico web, y tambi&eacute;n facilita la navegabilidad en las futuras visitas recurrentes a una web. Otra funci&oacute;n que tienen las&nbsp;<em>cookies</em>&nbsp;es que con ellas las web pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Las&nbsp;<em>cookies</em>&nbsp;son epleadas por nuestra web para poder identificar las p&aacute;ginas que se visitan y su frecuencia. &Uacute;nicamente para an&aacute;lisis estad&iacute;stico es usada la informaci&oacute;n y luego se elimina de forma permanente. Puedes eliminar las&nbsp;<em>cookies</em>&nbsp;en cualquier momento desde tu ordenador. Sin embargo las&nbsp;<em>cookies</em>&nbsp;ayudan a proporcionar un mejor servicio en los sitios web, &eacute;stas no dan acceso a informaci&oacute;n de tu ordenador ni tuya a nivel personal, a menos de que as&iacute; lo quieras y la proporciones directamente. Puedes aceptar o negar el uso de&nbsp;<em>cookies</em>&nbsp;en el aviso web que informa de ello, sin embargo la mayor&iacute;a de los navegadores aceptan&nbsp;<em>cookies</em>&nbsp;autom&aacute;ticamente, al servir para obtener un mejor servicio web. Tambi&eacute;n puedes cambiar la configuraci&oacute;n de tu ordenador para declinar las&nbsp;<em>cookies</em>, aunque en este caso es posible que no puedas utilizar algunos de nuestros servicios.</span></span></span></p>

<p style="text-align:justify"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium"><span style="color:#ffffff">Puedes encontrar nuestra pol&iacute;tica de&nbsp;<em>cookies</em>&nbsp;completa&nbsp;</span><a href="http://104.131.38.146/sitelabs/politica-de-cookies"><span style="color:#ffffff">aqu&iacute;</span></a><span style="color:#ffffff">.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Enlaces a terceros</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Este sitio web puede contener enlaces a otros sitios que pudieran ser de tu inter&eacute;s. Una vez que hagas clic en estos enlaces y abandones nuestra p&aacute;gina no tenemos control sobre el sitio al que te dirigen y por lo tanto no somos responsables de los t&eacute;rminos o privacidad ni de la protecci&oacute;n de tus datos que se pueda producir en esos otros sitios terceros. Dichos sitios est&aacute;n sujetos a sus propias pol&iacute;ticas de privacidad por lo cual es recomendable que los consultes para confirmar que est&aacute;s de acuerdo con ellas.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Titillium Web"><span style="font-size:x-large">Control de tu informaci&oacute;n personal</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">En cualquier momento puedes restringir la recopilaci&oacute;n o uso de la informaci&oacute;n personal que proporcionas a nuestro sitio web. Cada vez que se te solicite rellenar un formulario puedes marcar o desmarcar la opci&oacute;n de recibir informaci&oacute;n por correo electr&oacute;nico. En caso de que hayas marcado la opci&oacute;n de recibir nuestro bolet&iacute;n o publicidad, puedes cancelarla en cualquier momento.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Tun Daapo nunca vender&aacute;, ceder&aacute; ni distribuir&aacute; la informaci&oacute;n personal que recopila sin tu consentimiento, salvo que sea requerida por un juez con un orden judicial.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Tun Daapo se reserva el derecho de cambiar los t&eacute;rminos de la presente Pol&iacute;tica de Privacidad en cualquier momento.</span></span></span></p>';
      $sectiontun_daapo->save();
      $contentType='Section';
      $tipo_content=$this->findContentId($contentType);
      $lang=$this->getLangIdByName('English');
      $content_description='<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px"><span style="font-family:Roboto,sans-serif">Privacy Policy</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">The establishment of the terms in which Tun Daapo uses and protects the personal information or not that is provided by its users at the time of using its website is presented below as a Privacy Policy.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Tun Daapo welcomes that you are reading this page, taking into account that according to web analytics they refer that it is visited by very few users.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">A short version of the privacy policy of our website is as simple as how the data you provide when contacting us will only be used to maintain our business relationship or to inform you of news, offers, products and services that Let&#39;s think that it will provide you with some benefit, and if you do not want us to keep it, you just have to tell us and we will stop using them.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">If you want to investigate the subject, the long version is read below:</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px"><span style="font-family:Roboto,sans-serif">The Privacy Policy establishes</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">This Privacy Policy establishes the terms in which Tun Daapo uses and protects the information that is provided by its users when using its website. Tun Daapo is committed to the security of its users&#39; data. When we ask to fill in the fields of personal information with which you can be identified, we do so ensuring that it will only be used in accordance with the terms of this document. However, this Privacy Policy may change over time or be updated, so we recommend and emphasize that you continually review this page to ensure that you agree with said changes.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px"><span style="font-family:Roboto,sans-serif">Information that is collected</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Our website will collect personal information such as: Name, contact information such as your email address and demographic information. Specific information may additionally be required to process an order or make a delivery or billing.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px"><span style="font-family:Roboto,sans-serif">Use of collected information</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Our website uses the information in order to provide the best possible experience and service, particularly to keep a record of users, orders if applicable, and improve our products and services. We may periodically call or email you through our site with special offers, new products and other advertising information that we consider relevant to you or that may provide you with some benefit. These emails and calls will be made to the address and telephone number you provide and may be canceled at any time.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Tun Daapo is highly committed to keeping your information safe. We use the most advanced systems and constantly update them to ensure that there is no unauthorized access.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px"><span style="font-family:Roboto,sans-serif">Use of cookies</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">A cookie refers to a file that is sent in order to request permission to be stored on your computer. By accepting the cookie policy, said file is created and the cookie is then used to obtain information regarding web traffic, and also facilitates navigability in future recurring visits to a website. Another function that cookies have is that with them the web can recognize you individually and therefore provide you with the best personalized service.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Cookies are used by our website to identify the pages that are visited and their frequency. Only for statistical analysis is the information used and then permanently deleted. You can delete cookies at any time from your computer. However, cookies help to provide a better service on websites, they do not give access to information on your computer or yours on a personal level, unless you want to and provide it directly. You can accept or deny the use of cookies in the web notice that informs about it, however, most browsers automatically accept cookies, as they serve to obtain a better web service. You can also change your computer settings to decline cookies, although in this case you may not be able to use some of our services.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">You can find our complete cookie policy here.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Links to third parties</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">This website may contain links to other sites that may be of interest to you. Once you click on these links and leave our page, we have no control over the site to which they direct you and therefore we are not responsible for the terms or privacy or the protection of your data that may occur on those other third-party sites. . These sites are subject to their own privacy policies, so it is recommended that you consult them to confirm that you agree with them.</span></span></span></p>

<h3 style="text-align:justify"><span style="color:#ffffff"><span style="font-size:26px"><span style="font-family:Roboto,sans-serif">Control of your personal information</span></span></span></h3>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">At any time you can restrict the collection or use of the personal information that you provide to our website. Every time you are asked to fill out a form, you can check or uncheck the option to receive information by email. In case you have marked the option to receive our newsletter or advertising, you can cancel it at any time.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Tun Daapo will never sell, assign or distribute the personal information it collects without your consent, unless required by a judge with a court order.</span></span></span></p>

<p style="text-align:justify"><span style="color:#ffffff"><span style="font-family:Roboto,sans-serif"><span style="font-size:medium">Tun Daapo reserves the right to change the terms of this Privacy Policy at any time.</span></span></span></p>';
      $content_title='Privacy Policy';
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
