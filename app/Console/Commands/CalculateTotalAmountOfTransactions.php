<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class CalculateTotalAmountOfTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:total-amount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates the total amount of transactions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $transactionsTotalAmount = Transaction::sum('amount');

        $this->info("total amount of transactions: $transactionsTotalAmount");
    }
}
