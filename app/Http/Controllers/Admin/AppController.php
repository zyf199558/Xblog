<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\IpRepository;
use Mail;
use Gate;
use Illuminate\Http\Request;

class AppController extends Controller
{
    protected $ipRepository;

    public function __construct(IpRepository $ipRepository)
    {
        $this->ipRepository = $ipRepository;
    }

    public function index()
    {
        return view('admin.app');
    }

    public function sendMail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'content' => 'required',
        ]);
        try {
            $result = Mail::raw($request['content'], function ($message) use ($request) {
                $message->subject('Test email from ' . config('app.name'));
                $message->to($request['email']);
            });
        } catch (\Exception $e) {
            return back()->withErrors('Sent failed! ' . $e->getMessage());
        }
        if ($result == null)
            return back()->withSuccess('Sent succeed!');
    }

}
