<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMaster;
use App\Models\MenuMaster;
use App\Models\GroupMaster;
use App\Models\MenuChild;

class testController extends Controller
{
    



    function __construct( \App\Models\FAQ $FAQ, \App\Library\Responses $response){
      $this->FAQ = $FAQ;
      $this->response = $response;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  
    public function index()
    {

      $user = \Auth::guard('arogyasakhi')->user()->with('userGroup')->first()->toArray(); 
      return $user;
      // $CommonUtils = new \App\Library\CommonUtils();
//         foreach (\DB::table('menu_child')->get() as $menumaster) {
//           // $slug = \Str::of($menumaster->controllername)->slug('-');
//           $slug = $CommonUtils->getSlug($menumaster->controllername);
//           // Route::resource($slug, $slug->camel()->ucfirst());
// // $slug->singular()->camel()->ucfirst()->finish('Controller')
// // $slug = str_replace("-controller", '', \Str::kebab($menumaster->controllername));
//                 print($slug);
//                 echo "<br>";
//             }
      // $out = snake_case( camel_case( "my-test-string" ) );
      // dd($out);

      //  $user = \Auth::guard('arogyasakhi')->user()->with('userType')->first(); 
      //  $user = \Auth::guard('arogyasakhi')->user()->with('userGroup')->first(); 
    //    $user = \Auth::guard('arogyasakhi')->user()->getMenu();
       
    //   $menu =  MenuMaster::find(1)->with('menuChild')->get();
      // $menu =  GroupMaster::first()->with('MenuChilds')->get();
     
      // $menu =  GroupMaster::first()->with('groupMenu')->get();
      // $group_menu =  GroupMaster::where('group_id',\Auth::guard('arogyasakhi')->user()->userGroup()->first()->group_id)->with('MenuChilds')
      //           ->leftJoin('menu_master', 'menu_master.menu_id','menu_id')->get()->toArray();

        // return MenuMaster::groupMenu();



      // $menu = array();
      // foreach($group_menu as $gm){
      //   $menu[$gm['menu_name']] = array();
      //   foreach($gm['menu_childs'] as $mc){
      //     if($gm['menu_id'] == $mc['menu_id']){
      //       array_push($menu[$gm['menu_name']], $mc);
      //     }
      //   }
      // }
      // $menu_master = MenuMaster::all();
      // foreach($menu_master as $mm){
      //   foreach($menu[0] as $m){
      //     // $finalMenu->$mm->menu_name = $m
      //   }
      // }
      // return $menu;
      //  return $user;
    }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $collection = $this->FAQ->find($id);
      return (!empty($collection))? $this->response->Success($collection) : $this->response->notFound();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }

}
