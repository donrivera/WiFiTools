<?php
namespace App\Modules\User\Services;
use App\Modules\User\Contracts\UserServiceInterface;
use App\Modules\User\Models\User;
use App\Modules\User\Helpers\ResponseHelper;
use App\Http\Requests;
use Auth;
use DB;
class UserService implements UserServiceInterface
{
    
    public function view()
    { 
      return ResponseHelper::jsonSuccess(User::all());
    }
    public function authCheck()
    {
        return ((Auth::check()==1)?ResponseHelper::jsonSuccess("true"):ResponseHelper::jsonFailed("false"));
        //return response()->json("true");
    }
    public function findById($id)
    {
      $findbyid=User::find($id);
      $error="ID Not Found...";
      return (($findbyid)?ResponseHelper::jsonSuccess($findbyid):ResponseHelper::jsonFailed($error));
      
      
    }
    public function logOut()
    {
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        return ResponseHelper::jsonLogOut("logout");
        //return response()->json(null, 204);
    }
    public function store($request)
    {
        $user = new User;
        $user->name     = $request->get('name');
        $user->email    = $request->get('email');
        $user->password = Bcrypt($request->get('password'));
        //$user->save();
        return (($user)?ResponseHelper::jsonSuccess("User Added"):ResponseHelper::jsonFailed("Error"));
    }
    public function update($request,$id) 
    {
        $user = User::find($id);
        $user->name     = $request->get('name');
        $user->email    = $request->get('email');
        $user->password = Bcrypt($request->get('password'));
        $user->save();
        return (($user)?ResponseHelper::jsonSuccess($request->get('name')." Updated..."):ResponseHelper::jsonFailed("Error"));
    }
}