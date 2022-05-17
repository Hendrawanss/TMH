<?php

namespace App\Repositories;

use App\Interfaces\MenuRepositoryInterfaces;
use App\Models\Menu;

class MenuRepository implements MenuRepositoryInterfaces
{
    public function getAllMenus()
    {
        return Menu::all();
    }

    public function getDetailMenu($menuId)
    {
        return Menu::where('id', $menuId)->first();
    }
}