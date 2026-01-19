<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    public function getOrdersByStatus(string $status): Collection
    {
        return Order::where('status', $status)->get();
    }

    public function getOrderStatistics(): array
    {
        return [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];
    }

    public function updateOrderStatus(Order $order, string $newStatus): bool
    {
        $oldStatus = $order->status;
        
        if ($order->update(['status' => $newStatus])) {
            OrderStatusHistory::create([
                'order_id' => $order->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'changed_by' => auth()->id(),
            ]);
            
            return true;
        }
        
        return false;
    }

    public function getRecentOrders(int $limit = 10): Collection
    {
        return Order::latest()->take($limit)->get();
    }

    public function searchOrders(string $query): Collection
    {
        return Order::where('id', 'like', "%$query%")
            ->orWhereHas('customer', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->get();
    }
}
