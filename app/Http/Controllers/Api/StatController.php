<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use App\Models\GlobalStat;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index(Request $request)
    {
        $query = Stat::query();

        if ($request->has('section')) {
            $query->where('section', $request->section);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $stats = $query->orderBy('section')->orderBy('display_order')->orderBy('created_at', 'DESC')->get();

        $stats = $stats->map(function ($stat) {
            return $this->formatStat($stat);
        });

        if ($request->boolean('include_global', false) && $request->has('section')) {
            $section = $request->section;
            $globalStats = GlobalStat::where('status', 'published')
                ->get()
                ->filter(fn($stat) => $stat->shouldAppearIn($section))
                ->sortBy('display_order')
                ->map(fn($stat) => $stat->toStatFormat($section))
                ->values();

            $stats = $globalStats->merge($stats)->values()->all();
        }

        return $this->success($stats);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section' => 'required|string|max:50',
            'label' => 'required|string|max:100',
            'value' => 'required|string|max:50',
            'icon' => 'nullable|string|max:100',
            'displayOrder' => 'nullable|integer',
            'status' => 'nullable|string|max:20',
        ]);

        $stat = Stat::create([
            'id' => (string) time(),
            'section' => $validated['section'],
            'label' => $validated['label'],
            'value' => $validated['value'],
            'icon' => $validated['icon'] ?? '',
            'display_order' => $validated['displayOrder'] ?? 0,
            'status' => $validated['status'] ?? 'published',
        ]);

        return $this->created($this->formatStat($stat));
    }

    public function show(string $id)
    {
        $stat = Stat::find($id);

        if (!$stat) {
            return $this->notFound('Stat');
        }

        return $this->success($this->formatStat($stat));
    }

    public function update(Request $request, string $id)
    {
        $stat = Stat::find($id);

        if (!$stat) {
            return $this->notFound('Stat');
        }

        $validated = $request->validate([
            'section' => 'required|string|max:50',
            'label' => 'required|string|max:100',
            'value' => 'required|string|max:50',
            'icon' => 'nullable|string|max:100',
            'displayOrder' => 'nullable|integer',
            'status' => 'nullable|string|max:20',
        ]);

        $stat->update([
            'section' => $validated['section'],
            'label' => $validated['label'],
            'value' => $validated['value'],
            'icon' => $validated['icon'] ?? '',
            'display_order' => $validated['displayOrder'] ?? 0,
            'status' => $validated['status'] ?? 'published',
        ]);

        return $this->success($this->formatStat($stat->fresh()));
    }

    public function destroy(string $id)
    {
        $stat = Stat::find($id);

        if (!$stat) {
            return $this->notFound('Stat');
        }

        $stat->delete();

        return $this->deleted();
    }

    private function formatStat($stat)
    {
        return [
            'id' => $stat->id,
            'section' => $stat->section,
            'label' => $stat->label,
            'value' => $stat->value,
            'icon' => $stat->icon,
            'display_order' => $stat->display_order,
            'status' => $stat->status,
            'created_at' => $stat->created_at,
            'updated_at' => $stat->updated_at,
        ];
    }
}
