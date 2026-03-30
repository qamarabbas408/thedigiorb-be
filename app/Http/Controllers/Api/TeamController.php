<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $query = TeamMember::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'active');
        }

        $members = $query->orderBy('display_order')->get();

        $members = $members->map(function ($member) {
            return $this->formatMember($member);
        });

        return $this->success($members);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'role' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'facebook_url' => 'nullable|string|max:500',
            'twitter_url' => 'nullable|string|max:500',
            'linkedin_url' => 'nullable|string|max:500',
            'instagram_url' => 'nullable|string|max:500',
            'display_order' => 'nullable|integer',
            'status' => 'nullable|string|max:20',
        ]);

        $member = TeamMember::create([
            'id' => (string) time(),
            'name' => $validated['name'],
            'role' => $validated['role'] ?? '',
            'bio' => $validated['bio'] ?? '',
            'image' => $validated['image'] ?? '',
            'facebook_url' => $validated['facebook_url'] ?? '#',
            'twitter_url' => $validated['twitter_url'] ?? '#',
            'linkedin_url' => $validated['linkedin_url'] ?? '#',
            'instagram_url' => $validated['instagram_url'] ?? '#',
            'display_order' => $validated['display_order'] ?? 0,
            'status' => $validated['status'] ?? 'active',
        ]);

        return $this->created($this->formatMember($member));
    }

    public function show(string $id)
    {
        $member = TeamMember::find($id);

        if (!$member) {
            return $this->notFound('Team member');
        }

        return $this->success($this->formatMember($member));
    }

    public function update(Request $request, string $id)
    {
        $member = TeamMember::find($id);

        if (!$member) {
            return $this->notFound('Team member');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'role' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'facebook_url' => 'nullable|string|max:500',
            'twitter_url' => 'nullable|string|max:500',
            'linkedin_url' => 'nullable|string|max:500',
            'instagram_url' => 'nullable|string|max:500',
            'display_order' => 'nullable|integer',
            'status' => 'nullable|string|max:20',
        ]);

        $member->update([
            'name' => $validated['name'],
            'role' => $validated['role'] ?? '',
            'bio' => $validated['bio'] ?? '',
            'image' => $validated['image'] ?? '',
            'facebook_url' => $validated['facebook_url'] ?? '#',
            'twitter_url' => $validated['twitter_url'] ?? '#',
            'linkedin_url' => $validated['linkedin_url'] ?? '#',
            'instagram_url' => $validated['instagram_url'] ?? '#',
            'display_order' => $validated['display_order'] ?? 0,
            'status' => $validated['status'] ?? 'active',
        ]);

        return $this->success($this->formatMember($member->fresh()));
    }

    public function destroy(string $id)
    {
        $member = TeamMember::find($id);

        if (!$member) {
            return $this->notFound('Team member');
        }

        $member->delete();

        return $this->deleted();
    }

    private function formatMember($member)
    {
        return [
            'id' => $member->id,
            'name' => $member->name,
            'role' => $member->role,
            'bio' => $member->bio,
            'image' => $member->image 
                ? (str_starts_with($member->image, '/storage/') 
                    ? env('APP_URL', 'http://localhost:8000') . $member->image 
                    : $member->image)
                : '/assets/img/team/person-m-1.webp',
            'facebook_url' => $member->facebook_url,
            'twitter_url' => $member->twitter_url,
            'linkedin_url' => $member->linkedin_url,
            'instagram_url' => $member->instagram_url,
            'display_order' => $member->display_order,
            'status' => $member->status,
            'created_at' => $member->created_at,
        ];
    }
}
