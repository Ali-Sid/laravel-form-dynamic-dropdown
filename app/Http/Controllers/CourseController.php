<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Http\Requests\CourseRequest;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function create(): View
    {
        $categories = Category::all();
        $timezones = \DateTimeZone::listIdentifiers();
        return view('courses.create', compact('categories', 'timezones'));
    }

    public function store(CourseRequest $request)
    {
        $course = Course::create($request->validated());
        
        return redirect()
            ->route('courses.create')
            ->with('success', 'Course created successfully!');
    }
}