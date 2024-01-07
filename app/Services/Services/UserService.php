<?php

namespace App\Services\Services;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Entities\Business;
use App\Entities\PassworReset;
use App\Mail\PasswordResetMail;
use App\Services\Contract\UserServiceInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\PasswordReset;

class UserService implements UserServiceInterface
{

    public function store($data)
    {
        $user = User::create([
            'name' => $data['fullName'],
            'email' => $data['email'],
            'role' => isset($data['role']) ? $data['role'] : 2,
            'contact_number' => $data['contact_number'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    public function update($data)
    {
        $user = User::find($data['id']);
        $user->name = $data['fullName'];
        $user->email = $data['email'];
        $user->contact_number = $data['contact_number'];
        if(isset($data->role))
        {
          $user->role = $data['role'];
        }
        if(isset($data->is_change_pass))
        {
          if($data->is_change_pass)
          {
            $user->password = Hash::make($data['password']);
          }
        }
        $user->save();
        return $user;
    }

    public function forgotPassword($email)
    {
        set_time_limit(0);
        $user = User::where('email',$email)->first();
        if($user)
        {
            $name = $user->name;

            $data = new PassworReset();
            $data->email = $email;
            $data->token = sha1(time());
            $data->save();
            
            // try{
                  $email_data = [
                    'fullname' => $name,
                    'email' => $email,
                    'link' =>  route('password-reset',['token'=> $data->token, 'email'=> $email])
                ];
    
                Mail::to($email)->send(new PasswordResetMail($email_data));
          
                if (Mail::failures()) {
                  return ['message'=> "Mail not Sent"];
                }
                return response()->json(['response'=>'success', 'message' => 'Email Successfully Sent!']);
            // }
            // catch(\Error $th){
            //   return response()->json(['message'=> $th->getMessage()], 422);
            // }
        }
        else{
          return response()->json(['response'=>'error', 'message' => 'No Email Found']);
        }
    }

    public function changeRole($data, $userID) 
    {
        $updateData = [
            'role' => $data
        ];

        $user = User::find($userID);
        $user->update($updateData);

        return $user;
    }

    public function linkBusiness($userID, $businessID) 
    {

        $updateData = [
            'user_id' => $userID
        ];

        $business = Business::find($businessID);
       
        $business->update($updateData);

        return $business;
    }

    public function passwordReset($data){
        $email =  $data['email'];
        $token =  $data['token'];
        $pw_token = PassworReset::where('token',$token)->first();
        if($pw_token){
          $expired = $this->tokenExpire($email);
          if(!$expired)
          {
            return view('page.User.password-reset')->with(['token'=>$token, 'email' => $email]);
          }
          else{
            return redirect('/')->with(session()->flash('message','Invalid Link'));
          }
        }
        else{
          return redirect('/')->with(session()->flash('message','Invalid Link'));
        }
    }
    
    public function savePasswordReset($data){
        $email =  $data['email'];
        $token =  $data['token'];
        $password =  $data['password'];
        $expired = $this->tokenExpire($email);
  
        $token = PassworReset::where('token',$token)->first();
  
        if($token && !$expired){
            $user = User::where('email',$email)->first();
            $data = [
                "password" => Hash::make($password),
            ];
            $user = User::where('email',$email)->update($data);
            $pw_reset = PassworReset::where('email',$email)->delete();
            return $user;
        }
    }
    
    public function tokenExpire($email)
    {
      $pw_reset = PassworReset::where('email',$email)->first('created_at');
      if($pw_reset)
      {
        if(time() - strtotime($pw_reset->created_at) < 3601){
          return false;
        }
        else{
          $pw_reset = PassworReset::where('created_at',$pw_reset->created_at)->delete();
          return true;
        }
      }
      else{
        return true;
      }
    }

}