<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Http\Resources\PackageResource;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)->get();
        return PackageResource::collection($packages);
    }

    public function show(Package $package)
    {
        return new PackageResource($package);
    }

    public function search(Request $request)
    {
        $query = $request->query('q');
        $packages = Package::where('name', 'like', "%$query%")->get();
        return PackageResource::collection($packages);
    }
}
