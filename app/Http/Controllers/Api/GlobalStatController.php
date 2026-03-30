<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GlobalStat;
use Illuminate\Http\Request;

class GlobalStatController extends Controller
{
    public function index(Request $request)
    {
        $query = GlobalStat::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $stats = $query->orderBy('display_order')->orderBy('created_at', 'DESC')->get();

        $stats = $stats->map(function ($stat) {
            return $stat->toStatFormat('global');
        });

        return $this->success($stats);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'value' => 'required|string|max:50',
            'icon' => 'nullable|string|max:100',
            'displayOrder' => 'nullable|integer',
            'status' => 'nullable|string|max:20',
            'sections' => 'nullable|array',
            'sections.*' => 'string',
        ]);

        $key = \Illuminate\Support\Str::slug($validated['label'], '_');

        $stat = GlobalStat::create([
            'id' => (string) time() . '_' . rand(100, 999),
            'key' => $key,
            'label' => $validated['label'],
            'value' => $validated['value'],
            'icon' => $validated['icon'] ?? '',
            'display_order' => $validated['displayOrder'] ?? 0,
            'status' => $validated['status'] ?? 'published',
            'sections' => $validated['sections'] ?? [],
        ]);

        return $this->created($stat->toStatFormat('global'));
    }

    public function show(string $id)
    {
        $stat = GlobalStat::find($id);

        if (!$stat) {
            return $this->notFound('Global Stat');
        }

        return $this->success($stat->toStatFormat('global'));
    }

    public function update(Request $request, string $id)
    {
        $stat = GlobalStat::find($id);

        if (!$stat) {
            return $this->notFound('Global Stat');
        }

        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'value' => 'required|string|max:50',
            'icon' => 'nullable|string|max:100',
            'displayOrder' => 'nullable|integer',
            'status' => 'nullable|string|max:20',
            'sections' => 'nullable|array',
            'sections.*' => 'string',
        ]);

        $stat->update([
            'label' => $validated['label'],
            'value' => $validated['value'],
            'icon' => $validated['icon'] ?? '',
            'display_order' => $validated['displayOrder'] ?? 0,
            'status' => $validated['status'] ?? 'published',
            'sections' => $validated['sections'] ?? [],
        ]);

        return $this->success($stat->fresh()->toStatFormat('global'));
    }

    public function destroy(string $id)
    {
        $stat = GlobalStat::find($id);

        if (!$stat) {
            return $this->notFound('Global Stat');
        }

        $stat->delete();

        return $this->deleted();
    }
}
