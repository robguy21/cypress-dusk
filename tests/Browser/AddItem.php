<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddItem extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAddItem()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('DEFAULT')
                    ->type('new_item', 'my new item')
                    ->click('[data-test-id="button-add_item"]')
                    ->clear('new_item');

            $browser->with('[data-test-id="component-tab_container"]', function ($tab) {
                $tab->assertSee('my new item');
            });
        });
    }

    public function testAddCategory()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/')
                ->assertSee('DEFAULT')
                ->click('[data-test-id="button-add_category"]')
                ->waitFor('[data-test-id="component-dialog"]')
                ->type('new_category', 'EverythingIsAwesome')
                ->click('[data-test-id="button-save_dialog"]');

            $browser->with('[data-test-id="component-app_bar"]', function($bar) {
                $bar->assertSee('EVERYTHINGISAWESOME');
            });
        });
    }

    public function testClosePopup()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/')
                ->assertSee('DEFAULT')
                ->click('[data-test-id="button-add_category"]')
                ->waitFor('[data-test-id="component-dialog"]')
                ->click('[data-test-id="button-close_dialog"]')
                ->waitUntilMissing('[data-test-id="component-dialog"]')
                ->assertMissing('[data-test-id="component-dialog"]');
        });
    }
}
