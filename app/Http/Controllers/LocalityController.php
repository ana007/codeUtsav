<?php

namespace App\Http\Controllers;

use App\Locality;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

//use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class LocalityController extends Controller
{
    //

             public function index()
		   {

		       $localitys = Locality::orderBy('name')
			                                       ->paginate(10);


		     	   return view('admin.locality.index',compact('localitys'));


		   	//   return view('admin.store.index');

		   }

		    // create
				public function create()
			{

               return view('admin.locality.create');
			}


             public function store(Request $request)
			{
			              
                               $locality=Request::all();
                               if (Locality::create($locality)) {
			          

			                          	return redirect('admin/locality')->with('success', 'locality Created successfully');
			                    }else{
			                          	  return redirect('admin/locality')->withInput()->with('error', "Error occured while Creating locality");
			                         }


			}


			  public function edit($id)
				{
				   $locality=Locality::find($id);


                   return view('admin.locality.edit',compact('locality'));




				}





				public function update($id)
              {

                        //  return $id;
                         	 $localityUpdate=Request::all();

              	             if(!isset($localityUpdate['popular_flag']))
                               {
                                $localityUpdate['popular_flag'] = 0;
                                
                               }


				             $locality=Locality::find($id);
				 

							  if ($locality->update($localityUpdate)) {



			                          	return redirect('admin/locality')->with('success', 'locality Updated successfully');
			                    }else{
			                          	  return redirect('admin/locality')->withInput()->with('error', "Error occured while Updating locality");
			                         }


				}




				   public function destroy($id)
				{


				    if(Locality::find($id)->delete()){

			                          	return redirect('admin/locality')->with('success', 'locality Deleting successfully');
			                    }else{
			                          	  return redirect('admin/locality')->withInput()->with('error', "Error occured while Deleting locality");
			                         }
				}



        public function locations(Request $request) {

              $response = Locality::select('id','name')->orderBy('name')->get();


        	if($response == '[]') {
              return  response()->json(['success'=>false ,'message'=> "No result found"]);
            } else {
              return  response()->json(['success'=>true ,'message'=> "Success",'data'=> $response]);
            }
        }

        public function search(Request $request)
        {
           $search = \Request::get('search');
           $localitys = Locality::where('name','like','%'.$search.'%')->paginate(10);

           return view('admin.locality.search',compact('localitys'));
        }

}
