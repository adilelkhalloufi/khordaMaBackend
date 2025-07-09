<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class CoinService
{
    /**
     * Check if user has enough coins
     */
    public function hasEnoughCoins(User $user, int $amount): bool
    {
        return $user->coins >= $amount;
    }

    /**
     * Deduct coins from user
     */
    public function deductCoins(User $user, int $amount, string $reason = null): bool
    {
        if (!$this->hasEnoughCoins($user, $amount)) {
            throw new Exception("Insufficient coins. User has {$user->coins} coins but needs {$amount} coins.");
        }

        $user->coins -= $amount;
        $success = $user->save();

        if ($success && $reason) {
            // You can log the transaction here if you want to keep track
            Log::info("Coins deducted from user {$user->id}: -{$amount} coins. Reason: {$reason}");
        }

        return $success;
    }

    /**
     * Add coins to user
     */
    public function addCoins(User $user, int $amount, string $reason = null): bool
    {
        $user->coins += $amount;
        $success = $user->save();

        if ($success && $reason) {
            // You can log the transaction here if you want to keep track
            Log::info("Coins added to user {$user->id}: +{$amount} coins. Reason: {$reason}");
        }

        return $success;
    }

    /**
     * Get user's current coin balance
     */
    public function getBalance(User $user): int
    {
        return $user->fresh()->coins ?? 0;
    }

    /**
     * Transfer coins between users
     */
    public function transferCoins(User $fromUser, User $toUser, int $amount, string $reason = null): bool
    {
        if (!$this->hasEnoughCoins($fromUser, $amount)) {
            throw new Exception("Insufficient coins for transfer. User has {$fromUser->coins} coins but needs {$amount} coins.");
        }

        // Use database transaction to ensure both operations succeed or fail together
        return DB::transaction(function () use ($fromUser, $toUser, $amount, $reason) {
            $fromUser->coins -= $amount;
            $toUser->coins += $amount;

            $fromSuccess = $fromUser->save();
            $toSuccess = $toUser->save();

            if ($fromSuccess && $toSuccess && $reason) {
                Log::info("Coins transferred from user {$fromUser->id} to user {$toUser->id}: {$amount} coins. Reason: {$reason}");
            }

            return $fromSuccess && $toSuccess;
        });
    }

    /**
     * Cost for adding a product (you can make this configurable)
     */
    public function getProductCreationCost(): int
    {
        return 1; // 1 coin per product creation
    }

    /**
     * Charge user for creating a product
     */
    public function chargeForProductCreation(User $user): bool
    {
        $cost = $this->getProductCreationCost();
        return $this->deductCoins($user, $cost, 'Product creation');
    }

    /**
     * Initialize a new user with starting coins
     */
    public function initializeUserCoins(User $user, int $startingCoins = 10): bool
    {
        $user->coins = $startingCoins;
        $success = $user->save();

        if ($success) {
            Log::info("User {$user->id} initialized with {$startingCoins} coins");
        }

        return $success;
    }
}
