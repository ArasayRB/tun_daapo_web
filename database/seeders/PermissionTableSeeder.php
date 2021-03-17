<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $permission=new Permission();
      $permission->name='Create Post';
      $permission->slug='create-post';
      $permission->description='Obtiene acceso a insertar post';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Post';
      $permission->slug='update-post';
      $permission->description='Acceso a actualizar posts';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Post';
      $permission->slug='delete-post';
      $permission->description='Acceso a eliminar posts';
      $permission->save();

      $permission=new Permission();
      $permission->name='Publish Post';
      $permission->slug='publish-post';
      $permission->description='Acceso a publicar posts';
      $permission->save();

      $permission=new Permission();
      $permission->name='Pre View Post';
      $permission->slug='pre-view-post';
      $permission->description='Acceso a ver vista previa del post';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Post';
      $permission->slug='list-post';
      $permission->description='Acceso a ver listado de posts';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Post Published';
      $permission->slug='list-post-published';
      $permission->description='Acceso a ver listado de posts publicados';
      $permission->save();

      $permission=new Permission();
      $permission->name='Translate Post';
      $permission->slug='translate-post';
      $permission->description='Acceso a añadir traducción de un post en un idioma de los permitidos por la aplicacion';
      $permission->save();

      $permission=new Permission();
      $permission->name='Edit Translate Post';
      $permission->slug='edit-translate-post';
      $permission->description='Acceso a editar traducción de un post en un idioma de los permitidos por la aplicacion';
      $permission->save();

      $permission=new Permission();
      $permission->name='Creat Usuario';
      $permission->slug='creat-usuario';
      $permission->description='Acceso a crear usuario';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Usuario';
      $permission->slug='update-usuario';
      $permission->description='Acceso a actualizar usuario';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Usuario';
      $permission->slug='delete-usuario';
      $permission->description='Acceso a eliminar usuario';
      $permission->save();

      $permission=new Permission();
      $permission->name='List User';
      $permission->slug='list-user';
      $permission->description='Acceso a ver listado de users';
      $permission->save();

      $permission=new Permission();
      $permission->name='Create Role';
      $permission->slug='create-role';
      $permission->description='Acceso a crear role';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Role';
      $permission->slug='update-role';
      $permission->description='Acceso a actualizar role';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Role';
      $permission->slug='delete-role';
      $permission->description='Acceso a eliminar role';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Roles';
      $permission->slug='list-roles';
      $permission->description='Acceso a ver listado de roles';
      $permission->save();

      $permission=new Permission();
      $permission->name='Create Permission';
      $permission->slug='create-permission';
      $permission->description='Acceso a crear permission';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Permission';
      $permission->slug='update-permission';
      $permission->description='Acceso a actualizar permission';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Permission';
      $permission->slug='delete-permission';
      $permission->description='Acceso a actualizar permission';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Permission';
      $permission->slug='list-permission';
      $permission->description='Acceso a ver listado de permissions';
      $permission->save();

      $permission=new Permission();
      $permission->name='Admin Settings';
      $permission->slug='admin-settings';
      $permission->description='Acceso a administrar todas las configuraciones de la aplicacion y a todas ';
      $permission->save();

      $permission=new Permission();
      $permission->name='Create Section Page';
      $permission->slug='create-section-page';
      $permission->description='Crear secciones de la pagina principal';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Section Page';
      $permission->slug='update-section-page';
      $permission->description='Actualizar secciones de página';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Section Page';
      $permission->slug='delete-section-page';
      $permission->description='Eliminar secciones de página';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Section Page';
      $permission->slug='list-section-page';
      $permission->description='Listar las secciones de página';
      $permission->save();

      $permission=new Permission();
      $permission->name='Edit Translate Section';
      $permission->slug='edit-translate-section';
      $permission->description='Editar la traducción de una sección de página';
      $permission->save();

      $permission=new Permission();
      $permission->name='Translate Section';
      $permission->slug='translate-section';
      $permission->description='Traducir una sección de la página principal a uno de los lengiajes disponibles';
      $permission->save();

      $permission=new Permission();
      $permission->name='Create Service';
      $permission->slug='create-service';
      $permission->description='Permite Crear los servicios que ofrece la página con su respectiva descrición';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Service';
      $permission->slug='update-service';
      $permission->description='Permite Actualizar los servicios que ofrece la página con su respectiva descrición';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Service';
      $permission->slug='delete-service';
      $permission->description='Permite Eliminar los servicios que ya no ofrece la página con su respectiva descrición';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Service';
      $permission->slug='list-service';
      $permission->description='Permite Listar los servicios que ya no ofrece la página con su respectiva descrición';
      $permission->save();

      $permission=new Permission();
      $permission->name='Translate Service';
      $permission->slug='translate-service';
      $permission->description='Permite Traducir en diferentes idiomas disponibles los servicios que ya no ofrece la página con su respectiva descrición';
      $permission->save();

      $permission=new Permission();
      $permission->name='Edit Translate Service';
      $permission->slug='edit-translate-service';
      $permission->description='Permite editar las traducciones disponibles de los servicios que ya no ofrece la página con su respectiva descrición';
      $permission->save();

      $permission=new Permission();
      $permission->name='Create Portfolio';
      $permission->slug='create-portfolio';
      $permission->description='Permite crear nuevos proyectos en el portafolio a mosttrar en pagina ppal';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Portfolio';
      $permission->slug='update-portfolio';
      $permission->description='Permite actualizar nuevos proyectos en el portafolio a mosttrar en pagina ppal';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Portfolio';
      $permission->slug='delete-portfolio';
      $permission->description='Permite eliminar nuevos proyectos en el portafolio a mosttrar en pagina ppal';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Portfolio';
      $permission->slug='list-portfolio';
      $permission->description='Permite listar nuevos proyectos en el portafolio a mosttrar en pagina ppal';
      $permission->save();

      $permission=new Permission();
      $permission->name='Translate Portfolio';
      $permission->slug='translate-portfolio';
      $permission->description='Permite traducir a idiomas permitidos proyectos en el portafolio a mosttrar en pagina ppal';
      $permission->save();

      $permission=new Permission();
      $permission->name='Edit Translate Portfolio';
      $permission->slug='edit-translate-portfolio';
      $permission->description='Permite editar traducciones de proyectos en el portafolio a mosttrar en pagina ppal';
      $permission->save();

      $permission=new Permission();
      $permission->name='Create Packet';
      $permission->slug='create-packet';
      $permission->description='Inserta paquetes de servicios por un precio único, que pueden ser por ofertas permanentes o especiales';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Packet';
      $permission->slug='update-packet';
      $permission->description='Actualiza paquetes de servicios por un precio único, que pueden ser por ofertas permanentes o especiales';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Packet';
      $permission->slug='delete-packet';
      $permission->description='Elimina paquetes de servicios por un precio único, que pueden ser por ofertas permanentes o especiales';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Packet';
      $permission->slug='list-packet';
      $permission->description='Lista paquetes de servicios por un precio único, que pueden ser por ofertas permanentes o especiales';
      $permission->save();

      $permission=new Permission();
      $permission->name='Translate Packet';
      $permission->slug='translate-packet';
      $permission->description='Traduce a idiomas disponibles por la page paquetes de servicios por un precio único, que pueden ser por ofertas permanentes o especiales';
      $permission->save();

      $permission=new Permission();
      $permission->name='Edit Translate Packet';
      $permission->slug='edit-translate-packet';
      $permission->description='Edita las traducciones de paquetes de servicios por un precio único, que pueden ser por ofertas permanentes o especiales';
      $permission->save();

      $permission=new Permission();
      $permission->name='Create Packet Type';
      $permission->slug='create-packet-type';
      $permission->description='Crear tipos de paketes de servicios a comercializar';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Packet Type';
      $permission->slug='update-packet-type';
      $permission->description='Actualizar tipos de paketes de servicios a comercializar';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Packet Type';
      $permission->slug='delete-packet-type';
      $permission->description='Eliminar tipos de paketes de servicios a comercializar';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Packet Type';
      $permission->slug='list-packet-type';
      $permission->description='Listar tipos de paketes de servicios a comercializar';
      $permission->save();

      $permission=new Permission();
      $permission->name='Translate Packet Type';
      $permission->slug='translate-packet-type';
      $permission->description='Traducir a lenguajes disponibles tipos de paketes de servicios a comercializar';
      $permission->save();

      $permission=new Permission();
      $permission->name='Edit Translate Packet Type';
      $permission->slug='edit-translate-packet-type';
      $permission->description='Editar traducciones disponibles tipos de paketes de servicios a comercializar';
      $permission->save();

      $permission=new Permission();
      $permission->name='Create Function Included';
      $permission->slug='create-function-included';
      $permission->description='Crear las funciones que incluyen los diferente paketes de servicios';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Function Included';
      $permission->slug='update-function-included';
      $permission->description='Actualizar las funciones que incluyen los diferente paketes de servicios';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Function Included';
      $permission->slug='list-function-included';
      $permission->description='Listar las funciones que incluyen los diferente paketes de servicios';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Function Included';
      $permission->slug='delete-function-included';
      $permission->description='Eliminar las funciones que incluyen los diferente paketes de servicios';
      $permission->save();

      $permission=new Permission();
      $permission->name='Translate Function Included';
      $permission->slug='translate-function-included';
      $permission->description='Traducir a lenguajes disponibles las funciones que incluyen los diferente paketes de servicios';
      $permission->save();

      $permission=new Permission();
      $permission->name='Edit Translate Function Included';
      $permission->slug='edit-translate-function-included';
      $permission->description='Actualizar o modificar las traducciones disponibles de las funciones que incluyen los diferente paketes de servicios';
      $permission->save();

      $permission=new Permission();
      $permission->name='Create Contact';
      $permission->slug='create-contact';
      $permission->description='Crear Contacto';
      $permission->save();

      $permission=new Permission();
      $permission->name='Update Contact';
      $permission->slug='update-contact';
      $permission->description='Actualizar Contacto';
      $permission->save();

      $permission=new Permission();
      $permission->name='Delete Contact';
      $permission->slug='delete-contact';
      $permission->description='Eliminar Contacto';
      $permission->save();

      $permission=new Permission();
      $permission->name='List Contact';
      $permission->slug='list-contact';
      $permission->description='Listar Contacto';
      $permission->save();

      $permission=new Permission();
      $permission->name='Translate Contact';
      $permission->slug='translate-contact';
      $permission->description='Traducir a lenguajes disponibles los Contactos';
      $permission->save();

      $permission=new Permission();
      $permission->name='Edit Translate Contact';
      $permission->slug='edit-translate-contact';
      $permission->description='Editar las traducciones disponibles los Contactos';
      $permission->save();
    }
}
