<?php

namespace Tests\Browser;

use CodeFlix\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCrud()
    {
        $user = User::where('email', 'admin@user.com')->first();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
            ->visit(route('admin.categories.index'))
            ->assertSee('Listagem de categorias')
            ->clickLink('Nova categoria')
            ->assertSee('Nova categoria')
            ->type('name', 'test')
            ->click('button[type=submit]')
            ->assertSee('Listagem de categorias')
            ->assertSee('test');
        });

        $this->testEdit($user);
        $this->testShow($user);
        $this->testDelete($user);
    }

    protected function testEdit($user)
    {
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('admin.categories.edit', ['category' => 1]))
                ->assertSee('Editar categoria')
                ->type('name', 'test1')
                ->click('button[type=submit]')
                ->assertSee('Listagem de categorias')
                ->assertSee('test1');
        });
    }

    protected function testShow($user)
    {
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('admin.categories.show', ['category' => 1]))
                ->assertSee('Ver categoria');
        });
    }

    protected function testDelete($user)
    {
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('admin.categories.show', ['category' => 1]))
                ->assertSee('Ver categoria')
                ->clickLink('Remover categoria')
                ->assertSee('Categoria removida com sucesso!')
                ->assertSee('Listagem de categorias');
        });
    }
}
