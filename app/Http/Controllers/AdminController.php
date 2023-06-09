<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\User;

class AdminController extends Controller
{
    // Add subject
    public function addSubject(Request $request)
    {
        try {
            Subject::create([
                'subject' => $request->subject
            ]);

            return response()->json(['success' => true, 'msg' => 'Subject added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    // Edit subject
    public function editSubject(Request $request)
    {
        try {
            $subject = Subject::find($request->id);

            if (!$subject) {
                return response()->json(['success' => false, 'msg' => 'Subject not found']);
            }

            $subject->subject = $request->subject;
            $subject->save();

            return response()->json(['success' => true, 'msg' => 'Subject updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    // Delete subject
    public function deleteSubject(Request $request)
    {
        try {
            $id = $request->input('id');
            Subject::where('id', $id)->delete();

            return response()->json(['success' => true, 'msg' => 'Subject deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    // Exam dashboard load
    public function examDashboard()
    {
        $subjects = Subject::all();
        $exams = Exam::with('subject')->get();

        return view('admin.exam-dashboard', compact('subjects', 'exams'));
    }

    // Add Exam
    public function addExam(Request $request)
    {
        try {
            $exam = new Exam;
            $exam->exam_name = $request->exam_name;
            $exam->subject_id = $request->subject_id;
            $exam->date = $request->date;
            $exam->time = $request->time;
            $exam->save();

            return response()->json(['success' => true, 'msg' => 'Exam added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function getExamDetail($id)

{
    
    try {
        $exam = Exam::find($id);

        if (!$exam) {
            return response()->json(['success' => false, 'msg' => 'Exam not found']);
        }

        return response()->json(['success' => true, 'data' => $exam]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'msg' => $e->getMessage()]);
    }
}

    
public function updateExam(Request $request)
{
    try {
        $exam = Exam::find($request->exam_id);

        if (!$exam) {
            return response()->json(['success' => true, 'msg' => 'Exam not found']);
        }

        $exam->exam_name = $request->exam_name;
        $exam->subject_id = $request->subject_id;
        $exam->date = $request->date;
        $exam->time = $request->time;
        $exam->save();

        return response()->json(['success' => true, 'msg' => 'Exam updated successfully']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'msg' => $e->getMessage()]);
    }
}
public function studentsDashboard()
{
    $students=User::where('is_admin',0)->get();
    return view('admin.studentsDashboard',compact('students'));
}
//delete exam
public function deleteExam(Request $request)
{
    try{
        Exam::where('id',$request->exam_id)->delete();
        return response()->json(['sucess'=>true,'msg'=>'Exam deleted successfully!']);
    }catch(\Exception $e){
        return response()->json(['sucess'=>false,'msg'=>$e->getMessage()]);
    };
}
public function studentDashboard(){
    $studetn=User::where('is_admin',0)->get();
    return view('admin.studentDashboard',compact('student'));

}
    

    
}
