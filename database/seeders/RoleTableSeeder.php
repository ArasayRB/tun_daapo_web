<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $permission_client = Permission::where('slug', 'list-post-published')->first();
      $permission_content_viewer=[];
      $permission_content_viewer[] = Permission::where('slug', 'list-post')->first();
      $permission_content_viewer[] = Permission::where('slug', 'pre-view-post')->first();
      $permission_content_viewer[] =$permission_client;
      $permission_content_writer=$permission_content_viewer;
      $permission_content_writer[] = Permission::where('slug', 'create-post')->first();
      $permission_content_writer[] = Permission::where('slug', 'update-post')->first();
      $permission_content_writer[] = Permission::where('slug', 'delete-post')->first();
      $permission_content_writer[] = Permission::where('slug', 'translate-post')->first();
      $permission_content_writer[] = Permission::where('slug', 'edit-translate-post')->first();
      $permission_content_publisher=$permission_content_viewer;
      $permission_content_publisher[] = Permission::where('slug', 'publish-post')->first();
      $permission_posts = Permission::where('slug', 'delete-post')->first();
      $permission_all=Permission::all();

      $role=new Role();
      $role->name='Administrator';
      $role->description='Administrador';
      $role->slug='administrator';
      $role->save();
      foreach ($permission_all as $permission) {
        $role->permissions()->attach($permission);
      }

      $role=new Role();
      $role->name='Client';
      $role->description='Client';
      $role->slug='client';
      $role->save();
      $role->permissions()->attach($permission_client);

      $role=new Role();
      $role->name='Viewer Content';
      $role->description='Revisor de contenido';
      $role->slug='viewer-content';
      $role->save();
      foreach ($permission_content_viewer as $permission) {
        $role->permissions()->attach($permission);
      }

      $role=new Role();
      $role->name='Writer Content';
      $role->description='Escritor de contenido';
      $role->slug='writer-content';
      $role->save();
      foreach ($permission_content_writer as $permission) {
        $role->permissions()->attach($permission);
      }

      $role=new Role();
      $role->name='Publisher Content';
      $role->description='Publicador de contenido';
      $role->slug='publisher-content';
      $role->save();
      foreach ($permission_content_publisher as $permission) {
        $role->permissions()->attach($permission);
      }
    }
}
