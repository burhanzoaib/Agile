<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Navbar;


class NavbarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $navbarlinks = [
            [
                'name' => 'Explore',
                'link' => 'https://agile.developer-ma.com/explore',
            ],
            [
                'name' => 'Wishlist',
                'link' => 'https://agile.developer-ma.com/wishlist',
            ],
            [
                'name' => 'Cart',
                'link' => 'https://agile.developer-ma.com/cart',
            ],
            [
                'name' => 'Help',
                'link' => 'https://agile.developer-ma.com/help',
            ],
            [
                'name' => 'Login',
                'link' => 'https://agile.developer-ma.com/auth',
            ],
            [
                'name' => 'Signup',
                'link' => 'https://agile.developer-ma.com/auth',
            ],
        ];

        foreach($navbarlinks as $navbar) {
           Navbar ::create($navbar);
        }
    }
}
