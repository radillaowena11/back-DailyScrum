<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\dailyScrum;
use DB;
use Illuminate\Support\Facades\Validator;

class dailyScrumController extends Controller
{

    public function index($id)
    {
    	try{
			$dataUser = User::where('id', $id)->first();
            if($dataUser != NULL){
			$data["count"] = dailyScrum::count();
			$dailyScrum = dailyScrum::with('User')->get();
	        // $dailyScrum = array();
	        // $dataDailyScrum = DB::table('daily_scrum')->join('user','user.id','=','daily_scrum.id_user')
            //                                    ->select('daily_scrum.id', 'user.firstname', 'user.lastname', 'daily_scrum.team', 'daily_scrum.activity_yesterday', 'daily_scrum.activity_today', 'daily_scrum.problem_yesterday', 'daily_scrum.solution', 'daily_scrum.date')
			// 								   ->where('daily_scrum.id_user','=', $id)
			// 								   ->get();
											   

	        // foreach ($dataDailyScrum as $p) {
	        //     $item = [
	        //         "id"          		=> $p->id,
	        //         "firstname"  		=> $p->firstname,
	        //         "lastname"  		=> $p->lastname,
	        //         "team"    	  		=> $p->team,
	        //         "activity_yesterday"  => $p->activity_yesterday,
	        //         "activity_today"  		=> $p->activity_today,
	        //         "problem_yesterday"  			=> $p->problem_yesterday,
	        //         "solution" 			=> $p->solution,
	        //         "date" 			=> $p->date
	        //     ];

	        //     array_push($dailyScrum, $item);
	        // }
	        $data["dailyScrum"] = $dailyScrum;
	        $data["status"] = 1;
	        return response($data);

            } else {
                return response([
                  'status' => 0,
                  'message' => 'Data User tidak ditemukan'
                ]);
              }
	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function store(Request $request)
    {
      try{
    		$validator = Validator::make($request->all(), [
    			'id_user'    		=> 'required|numeric',
  				'team'			=> 'required|string',
  				'activity_yesterday'		=> 'required|string',
  				'activity_today'		=> 'required|string',
  				'problem_yesterday'		=> 'required|string',
  				'solution'		=> 'required|string',
  				'date'		=> 'required|string',
    		]);
 
    		if($validator->fails()){
    			return response()->json([
    				'status'	=> 0,
    				'message'	=> $validator->errors()
    			]);
    		}

    		//cek apakah ada id user tersebut
    		if(User::where('id', $request->input('id_user'))->count() > 0){
    				$data = new dailyScrum();
              		$data->id_user = $request->input('id_user');
			        $data->team = $request->input('team');
			        $data->activity_yesterday = $request->input('activity_yesterday');
			        $data->activity_today = $request->input('activity_today');
			        $data->problem_yesterday = $request->input('problem_yesterday');
			        $data->solution = $request->input('solution');
			        $data->date = $request->input('date');
			        $data->save();

		    		return response()->json([
		    			'status'	=> '1',
		    			'message'	=> 'Data berhasil ditambahkan!'
		    		], 201);
    		} else {
    			return response()->json([
	                'status' => '0',
	                'message' => 'Data User tidak ditemukan.'
	            ]);
    		}

    		

      } catch(\Exception $e){
            return response()->json([
                'status' => '0',
                'message' => $e->getMessage()
            ]);
        }
      }
      
      public function delete($id)
      {
          try{
  
              $delete = dailyScrum::where("id", $id)->delete();
              if($delete){
                return response([
                  "status"  => 1,
                    "message"   => "Data berhasil dihapus."
                ]);
              } else {
                return response([
                  "status"  => 0,
                    "message"   => "Data poin pelanggaran gagal dihapus."
                ]);
              }
              
          } catch(\Exception $e){
              return response([
                  "status"	=> 0,
                  "message"   => $e->getMessage()
              ]);
          }
      }
}
