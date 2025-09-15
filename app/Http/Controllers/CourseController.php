<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Content;
use Illuminate\Support\Facades\DB;
class CourseController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function create()
    {
        return view('dashboard.create');
    }
    public function view()
    {
        $courses = Course::with(['modules.contents'])->get();
        return view('dashboard.view', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_title' => 'required|string|max:255',
            'course_feature_video' => 'nullable|string|max:255',
            'course_level' => 'nullable|string|max:255',
            'course_category' => 'nullable|string|max:255',
            'course_fee' => 'nullable|string|max:255',
            'course_summary' => 'nullable|string',
            'course_feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'module_title.*' => 'required|string|max:255',
            'content_title.*.*' => 'required|string|max:255',
            'video_source_type.*.*' => 'nullable|integer|in:1,2',
            'video_url.*.*' => 'nullable|string|max:255',
            'video_length.*.*' => 'nullable|string|max:255',
        ]);
        DB::beginTransaction();
        try {
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('course_feature_image')) {
                $image = $request->file('course_feature_image');
                $path = $image->store('uploads');

                $imagePath = $path;
            }

            // Save course
            $course = Course::create([
                'title' => $request->course_title,
                'feature_video' => $request->course_feature_video,
                'level' => $request->course_level,
                'category' => $request->course_category,
                'fee' => $request->course_fee,
                'summary' => $request->course_summary,
                'feature_image' => $imagePath,
            ]);

            $moduleTitles = $request->module_title ?? [];
            $contents = $request->content_title ?? [];
            $videoTypes = $request->video_source_type ?? [];
            $videoUrls = $request->video_url ?? [];
            $videoLengths = $request->video_length ?? [];

            foreach ($moduleTitles as $moduleIndex => $moduleTitle) {
                $module = Module::create([
                    'course_id' => $course->id,
                    'title' => $moduleTitle,
                ]);

                if (isset($contents[$moduleIndex])) {
                    foreach ($contents[$moduleIndex] as $contentIndex => $contentTitle) {
                        Content::create([
                            'module_id' => $module->id,
                            'title' => $contentTitle,
                            'video_source_type' => $videoTypes[$moduleIndex][$contentIndex] ?? null,
                            'video_url' => $videoUrls[$moduleIndex][$contentIndex] ?? null,
                            'video_length' => $videoLengths[$moduleIndex][$contentIndex] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('course.view')->with('success', 'Course created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
