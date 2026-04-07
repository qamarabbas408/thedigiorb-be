<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->has('categoryId')) {
            $query->where('category_id', $request->categoryId);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by is_active (default true for frontend)
        $query->where('is_active', $request->get('is_active', true));

        // Sort by display_order first, then by created_at
        $query->orderBy('display_order', 'ASC')->orderBy('created_at', 'DESC');

        // Get total count before applying limit/offset
        $total = $query->count();

        // Apply limit and offset for pagination
        if ($request->has('limit')) {
            $query->limit((int) $request->limit);
        }
        
        if ($request->has('offset')) {
            $query->offset((int) $request->offset);
        }

        $projects = $query->get();

        $projects = $projects->map(function ($project) {
            return $this->formatProject($project);
        });

        return response()->json([
            'success' => true,
            'data' => $projects,
            'total' => $total,
        ], 200, ['X-Total-Count' => $total]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'subtitle' => 'nullable|string|max:200',
            'categoryId' => 'required|string|max:50',
            'year' => 'nullable|string|max:20',
            'technologies' => 'nullable|array',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'gallery' => 'nullable|array',
            'featured' => 'nullable|boolean',
            'displayOrder' => 'nullable|integer|min:0',
            'isActive' => 'nullable|boolean',
            'client' => 'nullable|string|max:200',
            'url' => 'nullable|string|max:500',
            'status' => 'nullable|string|max:20',
        ]);

        $project = Project::create([
            'id' => (string) time(),
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? '',
            'category_id' => $validated['categoryId'],
            'year' => $validated['year'] ?? date('Y'),
            'technologies' => json_encode($validated['technologies'] ?? []),
            'description' => $validated['description'] ?? '',
            'image' => $validated['image'] ?? '',
            'gallery' => json_encode($validated['gallery'] ?? []),
            'featured' => $validated['featured'] ?? false,
            'display_order' => $validated['displayOrder'] ?? 0,
            'is_active' => $validated['isActive'] ?? true,
            'client' => $validated['client'] ?? '',
            'url' => $validated['url'] ?? '#',
            'status' => $validated['status'] ?? 'published',
        ]);

        return $this->created($this->formatProject($project));
    }

    public function show(string $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return $this->notFound('Project');
        }

        return $this->success($this->formatProject($project));
    }

    public function update(Request $request, string $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return $this->notFound('Project');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'subtitle' => 'nullable|string|max:200',
            'categoryId' => 'required|string|max:50',
            'year' => 'nullable|string|max:20',
            'technologies' => 'nullable|array',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'gallery' => 'nullable|array',
            'featured' => 'nullable|boolean',
            'displayOrder' => 'nullable|integer|min:0',
            'isActive' => 'nullable|boolean',
            'client' => 'nullable|string|max:200',
            'url' => 'nullable|string|max:500',
            'status' => 'nullable|string|max:20',
        ]);

        $project->update([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? '',
            'category_id' => $validated['categoryId'],
            'year' => $validated['year'] ?? '',
            'technologies' => json_encode($validated['technologies'] ?? []),
            'description' => $validated['description'] ?? '',
            'image' => $validated['image'] ?? '',
            'gallery' => json_encode($validated['gallery'] ?? []),
            'featured' => $validated['featured'] ?? false,
            'display_order' => $validated['displayOrder'] ?? 0,
            'is_active' => $validated['isActive'] ?? true,
            'client' => $validated['client'] ?? '',
            'url' => $validated['url'] ?? '#',
            'status' => $validated['status'] ?? 'published',
        ]);

        return $this->success($this->formatProject($project->fresh()));
    }

    public function destroy(string $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return $this->notFound('Project');
        }

        $project->delete();

        return $this->deleted();
    }

    private function formatProject($project)
    {
        $placeholderImages = [
            'web-design' => '/assets/img/portfolio/portfolio-1.webp',
            'mobile-design' => '/assets/img/portfolio/portfolio-3.webp',
            'branding' => '/assets/img/portfolio/portfolio-5.webp',
            'ui-ux' => '/assets/img/portfolio/portfolio-7.webp',
            'desktop-app' => '/assets/img/portfolio/portfolio-9.webp',
            'default' => '/assets/img/portfolio/portfolio-1.webp',
        ];

        $image = $project->image ?: ($placeholderImages[$project->category_id] ?? $placeholderImages['default']);

        return [
            'id' => $project->id,
            'title' => $project->title,
            'subtitle' => $project->subtitle,
            'category_id' => $project->category_id,
            'year' => $project->year,
            'technologies' => is_array($project->technologies) ? $project->technologies : json_decode($project->technologies, true) ?? [],
            'description' => $project->description,
            'image' => $image,
            'gallery' => is_array($project->gallery) ? $project->gallery : json_decode($project->gallery, true) ?? [],
            'featured' => (bool) $project->featured,
            'display_order' => (int) $project->display_order,
            'is_active' => (bool) $project->is_active,
            'client' => $project->client,
            'url' => $project->url,
            'status' => $project->status,
            'created_at' => $project->created_at,
            'updated_at' => $project->updated_at,
        ];
    }
}
