<?php

namespace App\Http\Controllers;

use App\Models\admin\Admin;
use App\Models\admin\Book;
use App\Models\admin\Coupon;
use App\Models\admin\Publisher;
use App\Models\admin\PurchaseOrder;
use App\Models\admin\SalesOrder;
use App\Models\admin\Supplier;
use App\Models\admin\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = 1;
        $booksCount = 2;
        $suppliersCount = 3;
        $publishersCount = 4;
        $adminsCount = 5;
        $purchaseOrdersCount = 6;
        $salesOrdersCount = 8;
        $couponsCount = 9;
        return view('admin.index', compact('usersCount', 'booksCount', 'suppliersCount', 'publishersCount', 'adminsCount', 'purchaseOrdersCount', 'salesOrdersCount', 'couponsCount'));
    }
}
