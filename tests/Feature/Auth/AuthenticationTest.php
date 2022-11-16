<?php

namespace Tests\Feature\Auth;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Tax;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {

        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_admin_user_register_screen_can_rander_with_branches_ok()
    {
        $user = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);
        Branch::get()->first();
        $response = $this->get('admin-user-register');
        $response->assertViewHas('branches');
        $this->assertDatabaseCount('branches','1');
        $response->assertStatus(200);
    }

    public function test_admin_user_register_ok()
    {
        $user = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);

        $branch = Branch::get()->first();
        $response = $this->post('admin-user-register',[
            'name' => "dfghjkl",
            'email' => 'xdfcghjk2cghjk@vhbnm.com',
            'phone' => '7538577545',
            'address' => 'hjdfhb',
            'country' => 'jfjh',
            'state' => 'bdfjb',
            'city' => 'djhgjer',
            'pin_code' => '243555',
            'branch' => $branch['id'],
            'role' => 'User',
        ]);

        $response->assertRedirect('users');
        $response->assertSessionHas('success');

    }

    public function test_admin_can_view_users_table_ok()
    {
        $admin = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);
        User::factory()->count(5)->create();
        $response = $this->get('/users');
        $response->assertViewHas('users');
        $this->assertDatabaseCount('users','6');
        $response->assertStatus(200);

    }

    public function test_user_deleted_ok()
    {
        $admin = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);
        $user = User::factory()->create();
        $response = $this->post('delete/user',[
           'id' => $user['id'],
        ]);
        $response->assertRedirect('users');
        $response->assertSessionHas('success');

    }

    public function test_user_updated_ok()
    {
        $admin = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);

        $user = User::factory()->create();
        $response = $this->post('update/user/'.$user['id'],[
            'name' => "Amzad",
            'email' => $user->email,
            'phone' => '7538577545',
            'address' => 'hjdfhb',
            'country' => 'jfjh',
            'state' => 'bdfjb',
            'city' => 'djhgjer',
            'pin_code' => '243555',
            'branch' => $user['branch_id'],
            'role' => 'User',
        ]);
        $response->assertRedirect('users');
        $response->assertSessionHas('success');

    }

    public function test_branch_registered_ok()
    {
        $user = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);

        $response = $this->post('branch_register',[
            'name' => fake()->unique()->name(),
            'address' => fake()->address(),
            'country' => 'India',
            'state' => 'Delhi',
            'city' => fake()->city(),
            'pin_code' => '123456',
        ]);

        $response->assertRedirect('branches');
        $response->assertSessionHas('success');

    }

    public function test_admin_can_view_branch_table_ok()
    {
        $admin = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);
        Branch::factory()->count(5)->create();
        $response = $this->get('/branches');
        $response->assertViewHas('branches');
        $this->assertDatabaseCount('branches','6');
        $response->assertStatus(200);
    }

    public function test_branch_updated_ok()
    {
        $user = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);

        $branch = Branch::get()->first();
        $response = $this->post('update/branch/'.$branch['id'],[
            'name' => fake()->unique()->name(),
            'address' => fake()->address(),
            'country' => 'India',
            'state' => 'Delhi',
            'city' => fake()->city(),
            'pin_code' => '123456',
        ]);

        $response->assertRedirect('branches');
        $response->assertSessionHas('success');

    }


    public function test_branch_cannot_be_deleted_on_foreign_key_used_ok()
    {
        $user = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);

        $branch = Branch::get()->first();
        $response = $this->post('delete/branch',[
           'id' => $branch['id'],
        ]);

        $response->assertRedirect('branches');
        $response->assertSessionHas('danger');
    }

    public function test_tax_rate_registred_ok()
    {
        $user = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);

        $response = $this->post('tax/register',[
            'name' => fake()->unique()->name(),
            'tax_percentage' => 28.00,
        ]);

        $response->assertRedirect('tax/rate');
        $response->assertSessionHas('success');

    }

    public function test_admin_can_view_taxes_table_ok()
    {
        $admin = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);
        Tax::factory()->count(5)->create();
        $response = $this->get('/tax/rate');
        $response->assertViewHas('taxes');
        $this->assertDatabaseCount('taxes','5');
        $response->assertStatus(200);
    }

    public function test_product_registered_ok()
    {
        $user = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);

        $tax = Tax::factory()->create();

        $response = $this->post('product/register',[
            'name' => fake()->unique()->name(),
            'cost' => 2000,
            'tax_rate' => $tax['id'],
        ]);

        $response->assertRedirect('products');
        $response->assertSessionHas('success');
    }

    public function test_admin_product_register_screen_can_rander_with_taxes_ok()
    {
        $user = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);
        Tax::factory()->create();
        $response = $this->get('product/register');
        $response->assertViewHas('taxes');
        $this->assertDatabaseCount('taxes','1');
        $response->assertStatus(200);
    }
    public function test_admin_can_view_product_table_ok()
    {
        $admin = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);
        Product::factory()->count(5)->create();
        $response = $this->get('/products');
        $response->assertViewHas('products');
        $this->assertDatabaseCount('products','5');
        $response->assertStatus(200);
    }

    public function test_updated_product_ok()
    {
        $user = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);

        $product = Product::factory()->create();
        $response = $this->post('update/product/'.$product['id'],[
            'name' => fake()->unique()->name(),
            'cost' => 4000,
            'tax_rate' => $product['tax_rate_id'],
        ]);

        $response->assertRedirect('/products');
        $response->assertSessionHas('success');
    }

    public function test_delete_product_ok()
    {
        $user = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);

        $product = Product::factory()->create();

        $response = $this->post('delete/product',[
            'id' => $product['id'],
        ]);

        $response->assertRedirect('/products');
        $response->assertSessionHas('success');
    }


    public function test_tax_rate_cannot_be_deleted_on_foreign_key_used_ok()
    {
        $user = User::factory()->create(['role'=>'Admin']);

        $registered = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $registered->assertRedirect(RouteServiceProvider::HOME);

        Product::factory()->create();
        $taxrate = Tax::get()->first();

        $response = $this->post('tax/delete',[
            'id' => $taxrate['id'],
        ]);

        $response->assertRedirect('tax/rate');
        $response->assertSessionHas('danger');
    }

}
