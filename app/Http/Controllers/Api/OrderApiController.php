<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(): JsonResponse
    {
        $orders = Order::with(['customer', 'deliveryDriver', 'orderType'])->paginate(15);
        return response()->json($orders);
    }

    public function show(Order $order): JsonResponse
    {
        return response()->json($order->load(['customer', 'deliveryDriver', 'orderType', 'statusHistories']));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'delivery_driver_id' => 'nullable|exists:delivery_drivers,id',
            'order_type_id' => 'required|exists:order_types,id',
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string|max:1000',
        ]);

        $order = Order::create($validated);
        return response()->json($order, 201);
    }

    public function update(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'sometimes|exists:customers,id',
            'delivery_driver_id' => 'nullable|exists:delivery_drivers,id',
            'order_type_id' => 'sometimes|exists:order_types,id',
            'status' => 'sometimes|in:pending,completed,cancelled',
            'notes' => 'nullable|string|max:1000',
        ]);

        $order->update($validated);
        return response()->json($order);
    }

    public function destroy(Order $order): JsonResponse
    {
        $order->delete();
        return response()->json(['message' => 'تم حذف الطلب بنجاح']);
    }

    public function statistics(): JsonResponse
    {
        return response()->json($this->orderService->getOrderStatistics());
    }

    public function byStatus(string $status): JsonResponse
    {
        $orders = $this->orderService->getOrdersByStatus($status);
        return response()->json($orders);
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');
        $orders = $this->orderService->searchOrders($query);
        return response()->json($orders);
    }
}
