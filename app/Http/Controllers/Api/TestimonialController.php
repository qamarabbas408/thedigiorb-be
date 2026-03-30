<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::query();

        if ($request->has('featured') && $request->featured === 'true') {
            $query->where('featured', true);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'published');
        }

        $testimonials = $query->orderBy('featured', 'DESC')->orderBy('created_at', 'DESC')->get();

        $testimonials = $testimonials->map(function ($testimonial) {
            return $this->formatTestimonial($testimonial);
        });

        return $this->success($testimonials);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'title' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:100',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'image' => 'nullable|string|max:500',
            'featured' => 'nullable|boolean',
            'status' => 'nullable|string|max:20',
        ]);

        $testimonial = Testimonial::create([
            'id' => (string) time(),
            'name' => $validated['name'],
            'title' => $validated['title'] ?? '',
            'company' => $validated['company'] ?? '',
            'content' => $validated['content'],
            'rating' => $validated['rating'] ?? 5,
            'image' => $validated['image'] ?? '',
            'featured' => $validated['featured'] ?? false,
            'status' => $validated['status'] ?? 'published',
        ]);

        return $this->created($this->formatTestimonial($testimonial));
    }

    public function show(string $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return $this->notFound('Testimonial');
        }

        return $this->success($this->formatTestimonial($testimonial));
    }

    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return $this->notFound('Testimonial');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'title' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:100',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'image' => 'nullable|string|max:500',
            'featured' => 'nullable|boolean',
            'status' => 'nullable|string|max:20',
        ]);

        $testimonial->update([
            'name' => $validated['name'],
            'title' => $validated['title'] ?? '',
            'company' => $validated['company'] ?? '',
            'content' => $validated['content'],
            'rating' => $validated['rating'] ?? 5,
            'image' => $validated['image'] ?? '',
            'featured' => $validated['featured'] ?? false,
            'status' => $validated['status'] ?? 'published',
        ]);

        return $this->success($this->formatTestimonial($testimonial->fresh()));
    }

    public function destroy(string $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return $this->notFound('Testimonial');
        }

        $testimonial->delete();

        return $this->deleted();
    }

    private function formatTestimonial($testimonial)
    {
        return [
            'id' => $testimonial->id,
            'name' => $testimonial->name,
            'title' => $testimonial->title,
            'company' => $testimonial->company,
            'content' => $testimonial->content,
            'rating' => $testimonial->rating,
            'image' => $testimonial->image,
            'featured' => (bool) $testimonial->featured,
            'status' => $testimonial->status,
            'created_at' => $testimonial->created_at,
            'updated_at' => $testimonial->updated_at,
        ];
    }
}
