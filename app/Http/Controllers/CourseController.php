<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    //
    function list(){
        $courses = Course::all();
        return view('routes.index', compact('courses'));
    }

    function detail(Course $course){
        return view('routes.detail', compact('course'));
    }

    function store(){
        $data = request()->validate([
            'subject'=> '',
            'responsable'=> '',
            'date' => ''
        ]);

        $newCourse = Course::create($data);

        return redirect('/courses/' . $newCourse->id);
    }

}
