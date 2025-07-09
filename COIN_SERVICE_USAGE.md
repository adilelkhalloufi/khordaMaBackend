# Coin Service Usage Examples

## Basic Usage

The `CoinService` provides a centralized way to manage user coins throughout your application.

### 1. Check if user has enough coins
```php
$coinService = new CoinService();
$user = Auth::user();

if ($coinService->hasEnoughCoins($user, 5)) {
    // User has at least 5 coins
}
```

### 2. Deduct coins from user
```php
$coinService = new CoinService();
$user = Auth::user();

try {
    $coinService->deductCoins($user, 3, 'Purchase premium feature');
    // Success - 3 coins deducted
} catch (Exception $e) {
    // Not enough coins
    return response()->json(['error' => $e->getMessage()], 402);
}
```

### 3. Add coins to user
```php
$coinService = new CoinService();
$user = Auth::user();

$coinService->addCoins($user, 10, 'Daily reward');
// 10 coins added to user
```

### 4. Transfer coins between users
```php
$coinService = new CoinService();
$fromUser = Auth::user();
$toUser = User::find($recipientId);

try {
    $coinService->transferCoins($fromUser, $toUser, 5, 'Gift coins');
    // Success - 5 coins transferred
} catch (Exception $e) {
    // Not enough coins for transfer
    return response()->json(['error' => $e->getMessage()], 402);
}
```

### 5. Get user's current balance
```php
$coinService = new CoinService();
$user = Auth::user();

$balance = $coinService->getBalance($user);
```

### 6. Initialize new user with starting coins
```php
$coinService = new CoinService();
$newUser = User::create([...]);

$coinService->initializeUserCoins($newUser, 20); // Give 20 starting coins
```

## Usage in Controllers

### Example: Premium Feature Controller
```php
<?php

namespace App\Http\Controllers;

use App\Services\CoinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremiumFeatureController extends Controller
{
    public function purchasePremiumFeature(Request $request)
    {
        $coinService = new CoinService();
        $user = Auth::user();
        $featureCost = 5; // 5 coins for premium feature

        if (!$coinService->hasEnoughCoins($user, $featureCost)) {
            return response()->json([
                'message' => "Insufficient coins. You need {$featureCost} coins.",
                'required_coins' => $featureCost,
                'current_coins' => $user->coins
            ], 402);
        }

        try {
            // Deduct coins
            $coinService->deductCoins($user, $featureCost, 'Premium feature purchase');
            
            // Enable premium feature logic here
            // ...

            return response()->json([
                'message' => 'Premium feature activated successfully',
                'coins_deducted' => $featureCost,
                'remaining_coins' => $coinService->getBalance($user)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to activate premium feature: ' . $e->getMessage()
            ], 500);
        }
    }
}
```

## Configuration

You can modify the coin costs in the `CoinService`:

- `getProductCreationCost()` - Returns cost for creating a product (currently 1 coin)
- `initializeUserCoins()` - Default starting coins for new users (currently 10 coins)

## Error Handling

The service throws exceptions when:
- User doesn't have enough coins for deduction
- User doesn't have enough coins for transfer

Always wrap coin operations in try-catch blocks to handle these exceptions gracefully.

## Logging

All coin transactions are automatically logged for auditing purposes. You can check the logs to track:
- Coin deductions with reasons
- Coin additions with reasons  
- Coin transfers between users
