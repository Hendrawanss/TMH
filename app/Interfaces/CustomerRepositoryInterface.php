<?php

namespace App\Interfaces;

interface CustomerRepositoryInterface {
    public function getAllCustomers();
    public function getDetailCustomer($customerId);
}