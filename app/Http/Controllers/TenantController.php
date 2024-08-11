<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class TenantController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    
    public function showRegistrationForm()
    {
        return view('tenants.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|unique:tenants,domain',
            'email' => 'required|email|unique:tenants,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();

        try {
            $tenant = Tenant::create([
                'name' => $request->name,
                'domain' => $request->domain,
                'database' => 'tenant_' . $request->domain,
            ]);

            // Create the tenant's database
            DB::statement("CREATE DATABASE {$tenant->database}");

            // Configure the tenant's database connection
            config(["database.connections.tenant.database" => $tenant->database]);

            // Run migrations for the tenant's database
            Artisan::call('migrate', [
                '--database' => 'tenant',
                '--path' => 'database/migrations/tenant',
                '--force' => true,
            ]);

            // Create the first user for the tenant
            DB::connection('tenant')->table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            DB::commit();

            return redirect()->route('tenant.login')->with('success', 'Tenant registered successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Registration failed. Please try again.');
        }
    }
}