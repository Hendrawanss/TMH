<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAllCustomers()
    {
        return Customer::all();
    }

    public function getDetailCustomer($customerId)
    {
        return Customer::where('id', $customerId)->first();
    }
}