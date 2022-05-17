<?php

namespace App\Interfaces;

interface MenuRepositoryInterfaces {
    public function getAllMenus();
    public function getDetailMenu($menuId);
}