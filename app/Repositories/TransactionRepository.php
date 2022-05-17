<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\MenuRepositoryInterfaces;
use App\Interfaces\TransactionRepositoryInterfaces;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Throwable;

class TransactionRepository implements TransactionRepositoryInterfaces
{
    private CustomerRepositoryInterface $customerRepository;
    private MenuRepositoryInterfaces $menuRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository, MenuRepositoryInterfaces $menuRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->menuRepository = $menuRepository;
    }

    public function getAllTransactions()
    {
        return Transaction::all();
    }

    public function getDetailTransaction($transactionId)
    {
        return Transaction::where('id', $transactionId)->first();
    }

    public function createTransaction($customerId,array $transactionDetails)
    {
        try 
        {
            DB::beginTransaction();

            $transaction = Transaction::create(
                [
                    'customer_id' => $customerId
                ]
            );

            foreach($transactionDetails['menu'] as $detail)
            {
                DetailTransaction::create(
                    [
                        'transaction_id' => $transaction->id,
                        'menu_id' => $detail['menu_id'],
                        'total_item' => $detail['total_item'],
                    ]
                );
            }

            DB::commit();

            return true;
        } 
        catch (Throwable $e)
        {
            DB::rollBack();
            return $e;
        }
    }

    public function updateTransaction($transactionId, array $transactionDetails)
    {
        try 
        {
            DB::beginTransaction();

            foreach($transactionDetails as $detail)
            {
                DetailTransaction::where('transaction_id', $transactionId)->where('menu_id', $detail["menu_id"])->update(
                    [
                        'total_item' => $detail['total_item'],
                    ]
                );
            }

            DB::commit();

            return true;
        } 
        catch (Throwable $e)
        {
            DB::rollBack();
            return $e;
        }
    }

    public function deleteTransaction($transactionId)
    {
        Transaction::destroy($transactionId);
    }

    public function calculatePrice($customerId, array $transactionDetails)
    {
        $customer = $this->customerRepository->getDetailCustomer($customerId);
        $discount = false; // Get discoutn 10% if agree with term
        $totalPrice = 0;
        $lastPrice = 0;

        foreach($transactionDetails['menu'] as $detail)
        {
            $menu = $this->menuRepository->getDetailMenu($detail['menu_id']);
            $totalPrice += $menu->price * $detail['total_item'];
        }

        // Selection discount
        if($customer->customer_type->name == 'Gold')
        {
            if($totalPrice >= 500000)
            {
                $discount = true;
            }
        }

        $lastPrice = $discount ? $totalPrice - ($totalPrice/10) : $totalPrice;

        $transactionDetails['discount'] = $discount;
        $transactionDetails['final_price'] = $lastPrice;
        $transactionDetails['final_price_before_discount'] = $totalPrice;

        return $transactionDetails;
    }
}