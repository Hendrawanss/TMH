<?php

namespace App\Interfaces;

interface TransactionRepositoryInterfaces {
    public function getAllTransactions();
    public function getDetailTransaction($transactionId);
    public function createTransaction($customerId, array $transactionDetails);
    public function updateTransaction($transactionId, array $transactionDetails);
    public function deleteTransaction($transactionId);
    public function calculatePrice($customerId, array $transactionDetails);
}