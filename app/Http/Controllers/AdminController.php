<?php

namespace App\Http\Controllers;

use App\Models\admin\Customer;
use App\Models\admin\Employee;
use App\Models\admin\Job;
use App\Models\admin\Product;
use App\Models\admin\Productset;
use App\Models\admin\PurchaseOrder;
use App\Models\admin\SalesInvoice;
use App\Models\admin\Supplier;

class AdminController extends Controller
{
    public function index()
    {
        $employeesCount = Employee::count();
        $productsCount = Product::count();
        $productsetsCount = Productset::count();
        $suppliersCount = Supplier::count();
        $customersCount = Customer::count();
        $jobsCount = Job::count();
        $purchaseOrdersCount = PurchaseOrder::count();
        $salesInvoicesCount = SalesInvoice::count();
        return view('admin.index', compact('employeesCount', 'productsCount', 'productsetsCount', 'suppliersCount', 'customersCount', 'jobsCount', 'purchaseOrdersCount', 'salesInvoicesCount'));
    }
}
