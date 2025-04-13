<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function View(Request $request)
    {
        $testimonials = Testimonial::all();

        $title = 'Delete Testimonial!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view("EasyTourAdmin.Testimonial", [
            'testimonials' => $testimonials
        ]);
    }

    public function Form($id = null)
    {
        $sql = "testimonial.*";
        $testimonials = Testimonial::selectRaw($sql)
            ->where('testimonial.id', '=', $id)->get();
        
        // dd($testimonials);

        return view("EasyTourAdmin.Testimonial-Input", [
            'testimonials' => $testimonials,
        ]);
    }

    public function store(Request $request)
    {
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $model = new Testimonial;
            $model->SenderName = $request->input('SenderName');
            $model->SenderEmail = $request->input('SenderEmail');
            $model->SenderPhone = $request->input('SenderPhone');
            $model->SenderJobTitle = $request->input('SenderJobTitle');
            $model->TestimonnialTitle = $request->input('TestimonnialTitle');
            $model->Testimonnial = $request->input('Testimonnial');
            $model->OtherRemarks = $request->input('OtherRemarks');
            $model->Icon = $request->input('Icon');
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Testimonial Saved Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $id = $request->input('id');
            $model = Testimonial::findOrFail($id);
            $model->SenderName = $request->input('SenderName');
            $model->SenderEmail = $request->input('SenderEmail');
            $model->SenderPhone = $request->input('SenderPhone');
            $model->SenderJobTitle = $request->input('SenderJobTitle');
            $model->TestimonnialTitle = $request->input('TestimonnialTitle');
            $model->Testimonnial = $request->input('Testimonnial');
            $model->OtherRemarks = $request->input('OtherRemarks');
            $model->Icon = $request->input('Icon');
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Testimonial Updated Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function deletedata(Request $request)
    {
        try {
            $testimonial = DB::table('testimonials')
                ->where('id', '=', $request->id)
                ->delete();

            if ($testimonial) {
                alert()->success('Success', 'Delete Testimonial Successfully.');
            } else {
                alert()->error('Error', 'Delete Testimonial Failed.');
            }
            return redirect('testimonials');
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            alert()->error('Error', $e->getMessage());
        }
    }
}
