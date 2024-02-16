<?php

namespace App\Http\Controllers;

use App\Classes;
use App\ClassArms;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\Structure\ClassStepOneRequest;

use DB;


class ClassController extends Controller
{

	public function index()
	{
	
	}
	
	public function show()
	{
	}

    public function getView($id=NULL)
    {

        if(!is_null($id))
        {
            $id = \Crypt::decrypt($id);
        }

        $classes = Classes::with(
            array('class_arm' => function($q){
                $q = $q->with('class_');
            }))->get();

//        dd($classes);

      return view('admin.class.view_classes', compact('classes'));
    }

    public function getStepOne($id=NULL)
    {
        if(!is_null($id))
        {
            $id = \Crypt::decrypt($id);
        }

        $class_record = !is_null($id) ? Classes::whereId($id)->get() : null;

//        dd($class_record);
		$crypt_class_id = NULL;

        if(!is_null($class_record))
        {
            foreach($class_record as $record)
            {
                $name = $record->name;
                $type = $record->class_type;
                $level = $record->class_level;
            }

            $crypt_class_id = \Crypt::encrypt($id);
        }

        return view('admin.class.step_one', compact('crypt_class_id','name','type','level'));
    }


    public function postStepOne(Request $request)
    {

        $input = \Input::except('_token');

        $rules = array(
            'name' => 'required'
        );
        $msg = array(
            'name.required' => 'You must provide a Class name before you can create a class'
        );

        $validate = \Validator::make($input, $rules, $msg);


        if($validate->fails())
        {
            $str = "";
            $errrs = $validate->messages();
            foreach($errrs->all() as $err)
            {
                $str = $str."".$err."<br>";
            }
			flash()->error($str);
            return \Redirect::back()->withInput()->with('error', $str);

        }else {

//            dd(\Input::get('name'));
			$id1 = NULL;
            if(\Input::has('class_id'))
            {

                $class_id = \Crypt::decrypt(\Input::get('class_id'));

                $update_records = \Input::except('_token','class_id');

//                dd($update_records['name']);

                $status = Classes::Where('id', "=", $class_id)->update(['name' => $update_records['name']]);

                if($status)
                {
					flash()->success('Class has been updated successfully!');
                    return redirect('/admin/class')->with('message', 'Class has been updated successfully!');
                }
            }else{

                $found = Classes::where('name', \Input::get('name'));
                if($found->count()>0){
					flash()->error('Class name already exist!');
                    return \Redirect::back()->withInput();
                }

                $class = \Input::except('_token');

                $new_class = new Classes();
                $new_class->name = $class['name'];

                $new_class->save();
				$id1 = $new_class->id;
				
            }
			

			flash()->success('Class has been created successfully!');
            return redirect('/admin/class/step-two/'.\Crypt::encrypt($id1))->with('message', 'Class has been created successfully! Proceed to Create CLass Arms');
        }

    }
	
	
	public function getDeleteClassArm($id, $arm_id)
	{
		$classArm = ClassArms::where('id', '=', $arm_id)->first();
		if($classArm!=NULL)
		{
			$classArm->delete();
		}
        return \Redirect::back()->withInput()->with('message', 'Class Arm has been deleted successfully');
	}

    public function getStepTwo($id, $arm_id=NULL)
    {
//        dd($arm);

        if(!is_null($id))
        {
            $id = \Crypt::decrypt($id);
        }

        $class_records = Classes::where('id', $id)->get();

        $arm_records = ClassArms::where('id', $arm_id)->get();

        $all_arm_records = ClassArms::where('class_id', $id)->get();

        \Session::put('dept_id', $id);

        $crypt_arm_id = \Crypt::encrypt($arm_id);

        foreach($arm_records  as $record){

            $arm_name = $record->arm_name;
        }

        foreach($class_records  as $record){

            $name = $record->name;
            $class_type = $record->class_type;
            $class_level = $record->class_level;

            $class_name = $name;
        }

        
        return view('admin.class.step_two', compact('class_name', 'arm_name', 'arm_id', 'crypt_arm_id', 'all_arm_records', 'id'));
    }

    public function postStepTwo(Request $request)
    {
        //dd('here');

        $this->validate($request, [
            'class_arm' => 'required'
        ]);

        $class_arm = \Input::get('class_arm');
		
		//dd(\Input::all());
        if(\Input::has('arm_id'))
        {

            $arm_id = \Crypt::decrypt(\Input::get('arm_id'));

            $update_records = \Input::except('_token', 'arm_id');

               //= dd($update_records);

			$status = NULL;
			if($arm_id==NULL)
			{
				$status = new ClassArms();
				$status->arm_name = $update_records['class_arm'];
				$status->class_id = \Crypt::decrypt(\Input::get('class_id'));
			}
			else
			{
            	$status = ClassArms::Where('id', "=", $arm_id)->first();
				$status->arm_name = $update_records['class_arm'];
			}
			//dd($status);
            if($status->save())
            {

                return redirect('/admin/class')->with('message', 'Class has been updated successfully!');
            }

        }

		$new_class_arm = new ClassArms();
		$new_class_arm->class_id = \Crypt::decrypt(\Input('class_id'));
		$new_class_arm->arm_name = $class_arm;
		$new_class_arm->save();

        return redirect('/admin/class');
    }


    public function getDeleteClass($id)
    {
        Classes::find($id)->delete();

        return redirect('admin/class')->with('message', 'Class has been deleted successfully!');
    }

}
