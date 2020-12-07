<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMaster;
use App\Models\MenuMaster;
use App\Models\GroupMaster;
use App\Models\MenuChild;

class testController extends Controller
{
    

    public function index()
    {

      $user = \Auth::guard('arogyasakhi')->user()->with('userGroup')->first()->toArray(); 
      dd($user);
      $CommonUtils = new \App\Library\CommonUtils();
        foreach (\DB::table('menu_child')->get() as $menumaster) {
          // $slug = \Str::of($menumaster->controllername)->slug('-');
          $slug = $CommonUtils->getSlug($menumaster->controllername);
          // Route::resource($slug, $slug->camel()->ucfirst());
// $slug->singular()->camel()->ucfirst()->finish('Controller')
// $slug = str_replace("-controller", '', \Str::kebab($menumaster->controllername));
                print($slug);
                echo "<br>";
            }
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
}
