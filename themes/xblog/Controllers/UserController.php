<?php

namespace Themes\Xblog\Controllers;

use App\Http\Repositories\ImageRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Requests;
use Gate;

class UserController extends Controller
{
    protected $imageRepository;

    protected $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param ImageRepository $imageRepository
     */
    public function __construct(UserRepository $userRepository, ImageRepository $imageRepository)
    {
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
        $this->middleware('auth', ['except' => 'show']);
    }

    public function show($name)
    {
        $user = $this->userRepository->get($name);
        return view('user.show', compact('user'));
    }

    public function notifications()
    {
        $notifications = auth()->user()->unreadNotifications;
        return view('user.notifications', compact('notifications'));
    }
}
