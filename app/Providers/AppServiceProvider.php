<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event){
            $authVerify = auth()->guard('admin')->user()->status;

            if($authVerify == 6 || $authVerify == 10){
                $event->menu->add(
                    [
                        'text' => 'Encomendas',
                        'icon' => 'fas fa-fw fa-shopping-bag',
                        'url'  => 'admin/encomendas',
                    ],
                );
            }
            if($authVerify == 4 || $authVerify == 10){
                $event->menu->add(
                    [
                        'text'    => 'Catalogos',
                        'icon'    => 'fas fa-fw fa-clipboard-list',
                        'submenu' => [
                            [
                                'text' => 'Produtos',
                                'url'  => 'admin/catalogos/produtos',
                                'icon' => 'fas fa-fw fa-angle-right'
                            ],
                            [
                                'text' => 'Categorias',
                                'url'  => 'admin/catalogos/categorias',
                                'icon' => 'fas fa-fw fa-angle-right'
                            ],
                        ],
                    ],
                );
            }
            if($authVerify == 2 || $authVerify == 10){
                $event->menu->add(
                    [
                        'text'    => 'Clientes',
                        'icon'    => 'fas fa-fw fa-users',
                        'submenu' => [
                            [
                                'text' => 'Clientes',
                                'url'  => 'admin/clientes/clientes',
                                'icon' => 'fas fa-fw fa-angle-right'
                            ],
                            [
                                'text' => 'Endereços',
                                'url'  => 'admin/clientes/enderecos',
                                'icon' => 'fas fa-fw fa-angle-right'
                            ],
                        ],
                    ],
                );
            }
            if($authVerify == 10){
                $event->menu->add(
                    [
                        'text' => 'Imagens',
                        'url'  => 'admin/imagens',
                        'icon' => 'fas fa-fw fa-images',
                    ],
                );
            }
            if($authVerify == 2 || $authVerify == 4 ||$authVerify == 6 || $authVerify == 10){
                $event->menu->add(
                    ['header' => 'Contas'],
                    [
                        'text' => 'Perfil',
                        'url'  => 'admin/perfil',
                        'icon' => 'fas fa-fw fa-user-edit',
                    ],
                );
            }
            if($authVerify == 10){
                $event->menu->add(
                    [
                        'text' => 'Administradores',
                        'url'  => 'admin/admins',
                        'icon' => 'fas fa-fw fa-user-cog',
                    ],
                );
            }
        });
    }
}
