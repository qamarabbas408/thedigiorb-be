<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('featured') && $request->featured === 'true') {
            $query->where('featured', true);
        }

        $services = $query->orderBy('display_order')->orderBy('created_at', 'DESC')->get();

        $services = $services->map(function ($service) {
            return $this->formatService($service);
        });

        return $this->success($services);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'featured' => 'nullable|boolean',
            'displayOrder' => 'nullable|integer',
            'status' => 'nullable|string|max:20',
        ]);

        $service = Service::create([
            'id' => (string) time(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'icon' => $validated['icon'] ?? 'bi-lightbulb',
            'featured' => $validated['featured'] ?? false,
            'display_order' => $validated['displayOrder'] ?? 0,
            'status' => $validated['status'] ?? 'published',
        ]);

        return $this->created($this->formatService($service));
    }

    public function show(string $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return $this->notFound('Service');
        }

        return $this->success($this->formatService($service));
    }

    public function update(Request $request, string $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return $this->notFound('Service');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'featured' => 'nullable|boolean',
            'displayOrder' => 'nullable|integer',
            'status' => 'nullable|string|max:20',
        ]);

        $service->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'icon' => $validated['icon'] ?? 'bi-lightbulb',
            'featured' => $validated['featured'] ?? false,
            'display_order' => $validated['displayOrder'] ?? 0,
            'status' => $validated['status'] ?? 'published',
        ]);

        return $this->success($this->formatService($service->fresh()));
    }

    public function destroy(string $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return $this->notFound('Service');
        }

        $service->delete();

        return $this->deleted();
    }

    private function formatService($service)
    {
        return [
            'id' => $service->id,
            'title' => $service->title,
            'description' => $service->description,
            'icon' => $service->icon,
            'featured' => (bool) $service->featured,
            'displayOrder' => $service->display_order,
            'status' => $service->status,
            'createdAt' => $service->created_at,
        ];
    }
}
