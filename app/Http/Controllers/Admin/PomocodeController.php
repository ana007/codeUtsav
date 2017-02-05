<?php

namespace App\Http\Controllers\Admin;

use App\PromoCode;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
//use Illuminate\Http\Request;
use DB;
use DateTime;
use Illuminate\Support\Facades\Session;

use App\Http\Middleware;

class PomocodeController extends Controller
{
        
                   public function __construct()
			 	    {
				        $this->middleware('web');
				    }

          public function index()
		   {			    
			    $codes = PromoCode::orderBy('id', 'asc') 
			    ->paginate(5);   
		   	   return view('admin.code.index',compact('codes'));
		   }

		    // create
				public function create()
			{
               return view('admin.code.create');
			}

			public function store()
			{ 
			    $code=Request::all();
			    $code['code'] = strtoupper(Request('code'));
			   //  return $code['start_date'];
			     // $code['end_date'] = Request('end_date');

			    if (PromoCode::create($code)) {
                       return redirect('admin/diseases');
                  } else {
                      return Redirect::route('admin/diseases');
                  }
			}  

			 public function edit($id)
				{ 		
				    $code=PromoCode::find($id); 
                   return view('admin.code.edit',compact('code'));
				}


				public function update(Request $request,$id)
			{
				   $codeUpdate=Request::all();
				  //$codeUpdate = $request->all();
                    $codeUpdate['code'] = strtoupper(Request('code'));

          

		             $code=PromoCode::find($id);

					  if ($code->update($codeUpdate)) {
	                      return redirect('admin/diseases');
	                  } else {
	                      return Redirect::route('admin/diseases');
	                  }
				}

				public function destroy($id)
				{
				   PromoCode::find($id)->delete();
				   return redirect('admin/diseases');
				}

		public function search(Request $request)
        {
           $search = \Request::get('search');
           $codes = PromoCode::where('code','like','%'.$search.'%')->orderBy('id')->paginate(5);
           return view('admin.code.search',compact('codes'));
        }
}
