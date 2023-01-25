<?php

namespace App\Http\Controllers;

use App\Models\AjaxForm;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('ajax-crud.ajax');
    }

    //student store data
    public function ajaxStore(Request $request)
    {

        $profile = $this->file_upload($request->file('avatar'), 'images/profile/');
        $data = AjaxForm::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'roll' => $request->roll,
            'reg' => $request->reg,
            'board' => $request->board,
            'avatar' => $profile,
        ]);

        if ($data) {
            $output = ['status' => 'success', 'message' => 'Data insert Successfully'];
        } else {
            $output = ['status' => 'error', 'message' => 'Opps Data Not Inserted'];
        }

        return response()->json($output);
    }

    //student Fetch Data
    public function studentFetchData(Request $request)
    {
        if ($request->ajax()) {
            $getData = AjaxForm::latest('id')->get();
            $code = '';
            foreach ($getData as $key => $student) {
                $serial = $key + 1;

                $code .=    '<tr>
                            <td>' . $serial . '</td>
                            <td>' . $student->name . '</td>
                            <td>
                               <img src="images/profile/' . $student->avatar . '" class="table-image" alt="' . $student->name . '">
                            </td>
                            <td>' . $student->email . '</td>
                            <td>' . $student->phone . '</td>
                            <td>' . $student->roll . '</td>
                            <td>' . $student->reg . '</td>
                            <td>' . $student->board . '</td>
                            <td>
                                <button type="button" class=" btn btn-sm btn-primary edit-btn" data-id="' . $student->id . '"> Edit</button>
                                <button type="button" class=" btn btn-sm btn-danger delete-btn" data-id="' . $student->id . '"> Delete</button>
                            </td>

                        </tr>';
            }
            return response()->json($code);
        }
    }

    //student edit Data
    public function dataedit(Request $request)
    {

        if ($request->ajax()) {
            $student = AjaxForm::findOrFail($request->student_id);
            return response()->json($student);
        }
    }


    //student Update data
    public function dataUpdate(Request $request)
    {
        $student = AjaxForm::findOrFail($request->update);


        if ($request->hasFile('avatar')) {
            if ($student->avatar != null) {
                if (file_exists('images/profile/' . $student->avatar)) {
                    unlink('images/profile/' . $student->avatar);
                }
                $profile = $student->avatar;
                $profile = $request->file('avatar');
                $file_extension = $profile->getClientOriginalExtension();
                $product_image_name = time() . rand() . '.' . $file_extension;
                $profile->move('images/profile/', $product_image_name);
            }
        }else{

        }

        $data = $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'roll' => $request->roll,
            'reg' => $request->reg,
            'board' => $request->board,
             'avatar' => $profile,
        ]);

        if ($data) {
            $output = ['status' => 'success', 'message' => 'Data Updated Successfully'];
        } else {
            $output = ['status' => 'error', 'message' => 'Opps Data Not Update!!'];
        }

        return response()->json($output);
    }


    //student Delete Data
    public function dataDestroy(Request $request)
    {

        if ($request->ajax()) {
            $student = AjaxForm::findOrFail($request->student_id);

            if (file_exists('images/profile/' . $student->avatar)) {
                unlink('images/profile/' . $student->avatar);
            }

            $student->delete();
            $output = ['status' => 'success', 'message' => 'Data Deleted Successfully'];
            return response()->json($output);
        }
    }
}
