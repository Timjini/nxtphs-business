<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BillingController extends Controller

{
    public function index(): View
    {
        return view('admin.billing.index');
    }
}