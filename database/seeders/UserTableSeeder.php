<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_client = Role::with('permissions')
                        ->where('slug', 'client')->first();
      $role_admin = Role::with('permissions')
                          ->where('slug', 'administrator')->first();
      $role_viewer = Role::with('permissions')
                          ->where('slug', 'viewer-content')->first();
      $role_writer = Role::with('permissions')
                          ->where('slug', 'writer-content')->first();
      $role_publisher = Role::with('permissions')
                          ->where('slug', 'publisher-content')->first();
      $role_moderator = Role::with('permissions')
                          ->where('slug', 'moderator-content')->first();
      $role_editor = Role::with('permissions')
                          ->where('slug', 'editor-content')->first();

                          $user = new User();
                          $user->name = 'User';
                          $user->email = 'user@example.com';
                          $user->password = bcrypt('secret/*1234');
                          $user->save();
                          $user->roles()->attach($role_client);
                          foreach ($role_client->permissions as $permission) {
                            $user->permissions()->attach($permission);
                          }

                          $user = new User();
                          $user->name = 'Arasay Rodriguez Bastida';
                          $user->email = 'arasay@example.com';
                          $user->password = bcrypt('secret/*1234');
                          $user->profile = 'CEO co-fundator of the page, manager and writer content';
                          $user->save();
                          $user->roles()->attach($role_admin);
                          foreach ($role_admin->permissions as $permission) {
                            $user->permissions()->attach($permission);
                          }

                          $user = new User();
                          $user->name = 'Admin';
                          $user->email = 'admin@example.com';
                          $user->password = bcrypt('secret/*1234');
                          $user->profile = 'Co-fundator of the page, manager and writer content';
                          $user->save();
                          $user->roles()->attach($role_admin);
                          foreach ($role_admin->permissions as $permission) {
                            $user->permissions()->attach($permission);
                          }

                          $user = new User();
                          $user->name = 'Ana Lidia Fernandez';
                          $user->email = 'ana@example.com';
                          $user->password = bcrypt('secret/*1234');
                          $user->profile = 'Viewer content of the web since 2 years ago, programmer and fanatic to excursions';
                          $user->save();
                          $user->roles()->attach($role_viewer);
                          foreach ($role_viewer->permissions as $permission) {
                            $user->permissions()->attach($permission);
                          }

                          $user = new User();
                          $user->name = 'Ramón Gonzalez';
                          $user->email = 'ramonglez@example.com';
                          $user->password = bcrypt('secret/*1234');
                          $user->profile = 'Writer content';
                          $user->save();
                          $user->roles()->attach($role_writer);
                          foreach ($role_writer->permissions as $permission) {
                            $user->permissions()->attach($permission);
                          }

                          $user = new User();
                          $user->name = 'Teresa Díaz Rodríguez';
                          $user->email = 'teresa_dr@example.com';
                          $user->password = bcrypt('secret/*1234');
                          $user->save();
                          $user->roles()->attach($role_publisher);
                          foreach ($role_publisher->permissions as $permission) {
                            $user->permissions()->attach($permission);
                          }

                          $user = new User();
                          $user->name = 'Julio Cuevas';
                          $user->email = 'julio@example.com';
                          $user->password = bcrypt('secret/*1234');
                          $user->profile = 'Co-fundator of the page, manager and writer content';
                          $user->save();
                          $user->roles()->attach($role_admin);
                          foreach ($role_admin->permissions as $permission) {
                            $user->permissions()->attach($permission);
                          }

                          $user = new User();
                          $user->name = 'Javier Hernández Díaz';
                          $user->email = 'javi@example.com';
                          $user->password = bcrypt('secret/*1234');
                          $user->save();
                          $user->roles()->attach($role_viewer);
                          foreach ($role_viewer->permissions as $permission) {
                            $user->permissions()->attach($permission);
                          }

                          $user = new User();
                          $user->name = 'Tadeo Rivas LaFuerte';
                          $user->email = 'tarla@example.com';
                          $user->password = bcrypt('secret/*1234');
                          $user->save();
                          $user->roles()->attach($role_moderator);
                          foreach ($role_moderator->permissions as $permission) {
                            $user->permissions()->attach($permission);
                          }

                          $user = new User();
                          $user->name = 'Gabriel Díaz Lopez';
                          $user->email = 'gabriel@example.com';
                          $user->password = bcrypt('secret/*1234');
                          $user->save();
                          $user->roles()->attach($role_editor);
                          foreach ($role_editor->permissions as $permission) {
                            $user->permissions()->attach($permission);
                          }
    }
}
