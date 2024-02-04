<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

//                 [
//                    'name' => 'citytour update',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'role list',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'role edit',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'role create',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'role index',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'role delete',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'citytour list',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'citytour edit',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'citytour delete',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'citytour show',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'citytour create',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'attraction list',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'attraction edit',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'attraction delete',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'attraction show',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'attraction create',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'adventure list',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'adventure edit',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'adventure delete',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'adventure show',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'adventure create',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'citytourbooking list',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'citytourbooking show',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'attractionbooking list',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'attractionbooking show',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'adventurebooking list',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'setting create',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'setting edit',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'setting delete',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                        'name' => 'flightdata list',
//                        'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'flightdata show',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'adventurebooking show',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'page list',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'page create',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'page edit',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'page destroy',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'viptransportation list',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'viptransportation edit',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'viptransportation delete',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'viptransportation show',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                    'name' => 'viptransportation create',
//                    'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'viptransportationbooking list',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'viptransportationbooking show',
//                     'guard_name' => 'web',
//                 ],
//
//                 [
//                     'name' => 'bannersliders list',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'bannersliders create',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'bannersliders edit',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'bannersliders delete',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'bannersliders show',
//                     'guard_name' => 'web',
//                 ],
//
//
//
//
//                 [
//                     'name' => 'reviews list',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'reviews create',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'reviews edit',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'reviews delete',
//                     'guard_name' => 'web',
//                 ],
//                 [
//                     'name' => 'reviews show',
//                     'guard_name' => 'web',
//                 ],
//
//
//
//
//
//
//                [
//                    'name' => 'promocode list',
//                    'guard_name' => 'web',
//                ],
//                [
//                    'name' => 'promocode create',
//                    'guard_name' => 'web',
//                ],
//                [
//                    'name' => 'promocode edit',
//                    'guard_name' => 'web',
//                ],
//                [
//                    'name' => 'promocode delete',
//                    'guard_name' => 'web',
//                ],
//                [
//                    'name' => 'promocode show',
//                    'guard_name' => 'web',
//                ],

            // [
            //     'name' => 'adminData list',
            //     'guard_name' => 'web',
            // ],
            // [
            //     'name' => 'adminData show',
            //     'guard_name' => 'web',
            // ],


                                [
                                   'name' => 'transportation list',
                                   'guard_name' => 'web',
                                ],
                                [
                                   'name' => 'transportation edit',
                                    'guard_name' => 'web',
                                ],
                                [
                                   'name' => 'transportation delete',
                                   'guard_name' => 'web',
                                ],
                                [
                                   'name' => 'transportation show',
                                   'guard_name' => 'web',
                                ],
                                [
                                   'name' => 'transportation create',
                                   'guard_name' => 'web',
                                ],
                                [
                                    'name' => 'transportationbooking list',
                                    'guard_name' => 'web',
                                ],
                                [
                                    'name' => 'transportationbooking show',
                                    'guard_name' => 'web',
                                ],
        ];
        foreach($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
