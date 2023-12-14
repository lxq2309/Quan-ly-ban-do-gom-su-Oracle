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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword(Request $request)
    {
        $user = Employee::find(session('admin_id'));

        // Update the user's password
        $user->password = $request->input('new_password');
        $user->save();

        // Xóa thông tin người dùng khỏi session
        session()->forget(['admin_id', 'admin_name']);
        Auth::guard('admin')->logout();
        return redirect('/login');
    }
}
