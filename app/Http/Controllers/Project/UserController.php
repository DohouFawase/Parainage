<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Reference\Networks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Mail;
use Share;

class UserController extends Controller
{
    //

    public function index()
    {
        return view('auth.register');
    }



    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);


        $codeParain = Str::random(10);
        $token = Str::random(50);

        if (isset($request->referal_code)) {
            # code...
            $userData = User::where('referal_code', $request->referal_code)->get();


            if (count($userData) > 0) {
                # code...
                $user_id = User::insertGetId([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'referal_code' => $codeParain,
                    'remember_token' => $token
                ]);

                Networks::insert([
                    'referal_code' => $request->referal_code,
                    'user_id' => $user_id,
                    'parent_user_id' => $userData[0]['id'],

                ]);
            } else {
                return back()->with('error', 'Veillez entreer un code de Paranainge Valide!');
            }
        } else {
            # code...

            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'referal_code' => $codeParain,
                'remember_token' => $token

            ]);
        }
        //Enoie du liens de Paraiange
        $likn = URL::to('/');
        $url = $likn . '/auth/referal-register?ref=' . $codeParain;
        $data['url'] = $url;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['title'] = 'Inscription';

        Mail::send('emails.registerMail', ['data' => $data], function ($message) use ($data) {
            // $message->from('john@johndoe.com', 'John Doe');
            // $message->sender('john@johndoe.com', 'John Doe');
            $message->to($data['email'])->subject($data['title']);
            // $message->cc('john@johndoe.com', 'John Doe');
            // $message->bcc('john@johndoe.com', 'John Doe');
            // $message->replyTo('john@johndoe.com', 'John Doe');
            // $message->subject('Subject');
            // $message->priority(3);
            // $message->attach('pathToFile');
        });

        //Verification de mail

        $url = $likn . '/auth/email-verification/' . $token;
        $data['url'] = $url;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['title'] = 'Verification du Mail de Parainage';


        Mail::send('emails.VerifieEmail', ['data' => $data], function ($message) use ($data) {
            // $message->from('john@johndoe.com', 'John Doe');
            // $message->sender('john@johndoe.com', 'John Doe');
            $message->to($data['email'])->subject($data['title']);
            // $message->cc('john@johndoe.com', 'John Doe');
            // $message->bcc('john@johndoe.com', 'John Doe');
            // $message->replyTo('john@johndoe.com', 'John Doe');
            // $message->subject('Subject');
            // $message->priority(3);
            // $message->attach('pathToFile');
        });
        return back()->with('success', 'Votre Inscrition a été un success!. Veillez Verifier Votre MAil');
    }


    public function loadReefrences(Request $request)
    {

        if (isset($request->ref)) {
            # code...
            $parainLink = $request->ref;
            $userData = User::where('referal_code', $parainLink)->get();

            if ((count($userData) > 0)) {
                # code...
                return view('auth.referal-register', compact('parainLink'));
            } else {
                return view('error.404');
            }
        } else {
            # code...
            return view('/');
        }
    }

    public function emailVerify($token)
    {
        $userData = User::where('remember_token', $token)->get();

        if (count($userData) > 0) {
            # code...
            if ($userData[0]['is_verified'] == 1) {
                # code...
                return view('auth.email-verification', ['message' => 'Votre mail à été bien Verifier']);
            }

            User::where('id', $userData[0]['id'])->update([
                'is_verified' => 1,
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);
            return view('auth.email-verification', ['message' => 'Votre' . $userData[0]['email'] . 'Mail à été verifier avec sucess']);
        } else {
            return view('auth.email-verification', ['message' => '404 Not Found!']);
        }
    }


    public function loadLogin()
    {
        return view('/login');
    }


    public function userLogin(Request $request)
    {

        $data = $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password' => 'required|min:6'
        ]);

        $userDate = User::where('email', $request->email)->first(); 

        if (!empty($userDate)) {
            # code...
            if ($userDate->is_verified == 0) {
                return back()->with('error', 'Veillez verifier votre mail!');
            }
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            # code...
            return redirect('/dashboard');
        } else {
            return back()->with('error', 'Le Mail et le Pasword sont pas correct');
        }
    }

    public function dashboard()
    {
        $count = Networks::where('parent_user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->id)->count();
        $networ = Networks::with('user')->where('parent_user_id', Auth::user()->id)->get();
        $partage = \Share::page(URL::to('/') . '/auth/referal-register?ref=' . Auth::user()->referal_code, 'Partager et acumullez des poinst')
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp();
        return view('/dashboard', [
            'count' => $count,
            'networ' => $networ,
            'partage' => $partage
        ]);

        return view('/dashboard', [
                'count' => $count,
                'networ' => $networ,
                'partage' => $partage
        ]);

    }


    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return view('/');
    }
}
