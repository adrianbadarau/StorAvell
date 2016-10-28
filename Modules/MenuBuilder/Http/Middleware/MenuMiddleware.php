<?php

namespace Modules\MenuBuilder\Http\Middleware;

use Caffeinated\Menus\Builder;
use Closure;
use Illuminate\Http\Request;
use Modules\MenuBuilder\Entities\MenuItem;

class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $menuItems = MenuItem::with(['parent', 'children'])->get();
//        dd($menuItems);
        foreach ($menuItems as $index => $menuItem) {
            if ($index === 0) {
                \Menu::make('AdminMenu', function (Builder $menu) use ($menuItem) {
                    $menu->add($menuItem->label, $menuItem->link);
                    $itemToBuild = $menu->get(camel_case(str_slug($menuItem->label)));
                    if($menuItem->active_zone){
                        $itemToBuild->active($menuItem->active_zone);
                    }
                    if($itemToBuild->open_in_new_tab){
                        $itemToBuild->attribute('target','_blank');
                    }
                    if($menuItem->icon_class){
                        $itemToBuild->icon($menuItem->icon_class);
                    }
                });
                continue;
            }
            $menu = \Menu::get('AdminMenu');
            $this->recursivelyBuildMenu($menuItem, $menu);

        }
        return $next($request);
    }

    protected function recursivelyBuildMenu(MenuItem $menuItem, Builder $menu)
    {
        if ($menuItem->children()->count()) {
            $this->addItemToMenu($menuItem, $menu);
            foreach ($menuItem->children() as $child) {
                $this->recursivelyBuildMenu($child, $menu);
            }
        }else{
            $this->addItemToMenu($menuItem, $menu);
        }

    }

    protected function addItemToMenu(MenuItem $menuItem, Builder $menu)
    {
        if($menuItem->is_active){
            if($menuItem->parent){
                $parent = $menu->get(camel_case(str_slug($menuItem->parent->label)));
                $parent->add($menuItem->label, $menuItem->link);
            }else{
                $menu->add($menuItem->label, $menuItem->link);
            }
            $itemToBuild = $menu->get(camel_case(str_slug($menuItem->label)));
            if($menuItem->active_zone){
                $itemToBuild->active($menuItem->active_zone);
            }
            if($itemToBuild->open_in_new_tab){
                $itemToBuild->attribute('target','_blank');
            }
            if($menuItem->icon_class){
                $itemToBuild->icon($menuItem->icon_class);
            }
        }
    }
}
