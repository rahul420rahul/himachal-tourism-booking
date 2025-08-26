<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Package;

class UpdatePackageAdvancePayment extends Seeder
{
    public function run()
    {
        Package::query()->update(['advance_payment_percentage' => 20]);
    }
}
