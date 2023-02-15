<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class GenericDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit_articles']);
        Permission::create(['name' => 'delete_articles']);
        Permission::create(['name' => 'publish_articles']);

        Permission::create(['name' => 'edit_categories']);
        Permission::create(['name' => 'delete_categories']);

        Permission::create(['name' => 'change_role']);

        Permission::create(['name' => 'edit_permissions']);
        Permission::create(['name' => 'edit_roles']);

        // create roles and assign existing permissions
        $role_writer = Role::create(['name' => 'post_manager']);
        $role_writer->givePermissionTo('edit_articles');
        $role_writer->givePermissionTo('delete_articles');
        //$role_writer->givePermissionTo('publish_articles');

        $role_cat_manager = Role::create(['name' => 'category_manager']);
        $role_cat_manager->givePermissionTo('edit_categories');
        $role_cat_manager->givePermissionTo('delete_categories');

        $role_user_manager = Role::create(['name' => 'user_manager']);
        $role_user_manager->givePermissionTo('change_role');

        $role_access_manager = Role::create(['name' => 'access_manager']);
        $role_access_manager->givePermissionTo('edit_permissions');
        $role_access_manager->givePermissionTo('edit_roles');

        $role_super_admin = Role::create(['name' => 'super_admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider


        // create demo users
        /*
        $user1 = User::factory()->create([
            'name' 		=> 'SuperAdmin',
            'email' 	=> 'superadmin@example.com',
            'password' 	=> Hash::make('123456789'),
        ]);
        */

        $user1 = User::create([
            'name' 		=> 'SuperAdmin',
            'email' 	=> 'superadmin@example.com',
            'password' 	=> Hash::make('123456789'),
        ]);

        $user1->assignRole($role_super_admin);

        $user2 = User::create([
            'name'	 	=> 'Writer',
            'email' 	=> 'writer@example.com',
            'password' 	=> Hash::make('123456789'),
        ]);
        $user2->assignRole($role_writer);

        $user3 = User::create([
            'name' 		=> 'Admin',
            'email' 	=> 'admin@example.com',
            'password' 	=> Hash::make('123456789'),
        ]);

        $user3->assignRole($role_cat_manager);
        $user3->assignRole($role_user_manager);
        $user3->givePermissionTo('publish_articles');

        //$user3->syncRoles(['super-admin']);

        // create categories
        $cat1 = Category::create([
            'title' 		=> 'IA',
        ]);
        $cat2 = Category::create([
            'title' 		=> 'Chat GTP',
        ]);
        $cat2 = Category::create([
            'title' 		=> 'Bitcoin',
        ]);

        // create article
        $title1 = Str::random(30);
        $title2 = Str::random(30);

        $post1 = Post::create([
        	'ref'			=> uniqid(),
        	'category_id'	=> $cat1->id,
        	'initiator_id'	=> $user2->id,
            'title' 		=> $title1,
            'slug'			=> Str::slug($title1),
            'content' 		=> Str::random(190),
            'banner' 		=> 'default.jpeg',
        ]);

        $post2 = Post::create([
        	'ref'			=> uniqid(),
        	'category_id'	=> $cat1->id,
        	'initiator_id'	=> $user2->id,
            'title' 		=> $title2,
            'slug'			=> Str::slug($title2),
            'content' 		=> Str::random(190),
            'banner' 		=> 'default.jpeg',
        ]);
    }
}
