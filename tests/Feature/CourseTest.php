 <?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    function testACourseCanBeCreated(){
        $this->withoutExceptionHandling();
        
        $courseSubject = "PHP Unit";
        $courseResponsable = "Bernardo Pérez";
        $courseDate = "2022-06-23";
        $response = $this->post('/courses', [
            'subject'=> $courseSubject,
            'responsable'=> $courseResponsable,
            'date' => $courseDate
        ]);

        $this->assertCount(1, Course::all());
        $course = Course::first();
        $this->assertEquals($course->subject, $courseSubject);
        $this->assertEquals($course->responsable, $courseResponsable);
        $this->assertEquals($course->subject, $courseSubject);

        $response->assertRedirect('/courses/' . $course->id);
    }

    /**
     * @test
     */
    function listOfCoursesCanBeRetrieved(){
        $this->withoutExceptionHandling();
        $numberOfFakeCourses = 5;
        $fakeCourses = Course::factory($numberOfFakeCourses)->create();
        $response = $this->get('/courses');

        $response->assertOk();
        $response->assertViewIs('routes.index');
        $response->assertViewHas('courses', $fakeCourses);
    }

    /**
     * @test
     */
    function aCourseCanBeRetrieved(){
        $this->withoutExceptionHandling();
        $fakeCourse = Course::factory()->create();
        $response = $this->get('/courses/'. $fakeCourse->id);

        $firstFakeCourse = Course::first();

        $response->assertOk();
        $response->assertViewIs('routes.detail');
        $response->assertViewHas('course', $firstFakeCourse);
    }

    /**
     * @test
     */
    function aCourseCanBeDeleted(){
        $this->withoutExceptionHandling();
        $fakeCourse = Course::factory()->create();
        $this->assertCount(1, Course::all());

        $response = $this->delete('/courses/'. $fakeCourse->id);

        $this->assertCount(0, Course::all());

        $response->assertOk();
        $response->assertViewIs('routes.index');
    }


    //TODO: function aCourseCanBeDeleted(){}
    //TODO: function aCourseCanBeUpdated(){}
}
