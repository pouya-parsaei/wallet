<?php

use App\Enums\Transaction\TransactionType;
use App\Helpers\DatabaseCommenter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('reference_id')->unique();
            $table->bigInteger('amount');
            $table
                ->tinyInteger('type')
                ->comment(DatabaseCommenter::setCommentBasedOnEnum(TransactionType::class));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
