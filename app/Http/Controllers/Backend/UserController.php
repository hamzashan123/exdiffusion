<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Mail\UserRoleAssignActive;
use App\Mail\UserSignUp;
use App\Models\User;
use App\Services\ImageService;
use App\Traits\ImageUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ImageUploadTrait;

    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(): View
    {
        $this->authorize('access_user');

        $users = User::role(['user'])
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sortBy ?? 'id', \request()->orderBy ?? 'desc')
            ->paginate(\request()->limitBy ?? 10);

        return view('backend.users.index', compact('users'));
    }

    public function create(): View
    {
        $this->authorize('create_user');

        return view('backend.users.create');
    }

    public function store(Request $request)
    {
        $this->authorize('edit_user');
        //dd($request->hasFile('user_image'));
        if ($request->hasFile('user_image')) {
            
            $userImage = $this->imageService->storeUserImages($request->first_name.'-'.$request->last_name, $request->user_image);
        }

        $password = bcrypt($request->password);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->first_name.'-'.$request->last_name,
            'email' => $request->email,
            'country' => $request->user_country,
            'occupation' => $request->user_occupation,
            'email_verified_at' => now(),
            'password' => $password,
            'status' => $request->status,
            'receive_email' => true,
           'user_image' => $userImage ?? NULL
        ]);

        $user->markEmailAsVerified();
        $user->assignRole('user');

        $userdata = [
            'admin' => false,
            'firstname' => $user->first_name,
            'lastname' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
            'subject' => 'Registration Successful',
            'msg' => "You account has been created to Exdiffusion. <br> You can now <a href='" . route('login') . "'> Sign In </a> to use playground. <br> Your Login Details : email: '".$request->email."' <br> password: '".$request->password."'"
        ];

        try {
            Mail::to($user->email)->send(new UserSignUp($userdata));
            Session::flash('success', 'Registration Successfull!');
        } catch (\Exception $e) {
        }

        return redirect()->route('admin.users.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function saveUser(Request $request)
    {
        $this->authorize('edit_user');
       // dd($request);
    }

    public function show(User $user): View
    {
        $this->authorize('user_show');

        return view('backend.users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        $this->authorize('edit_user');

        return view('backend.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        
        $this->authorize('edit_user');

        if ($request->hasFile('user_image')) {
            if ($user->user_image) {
                $this->imageService->unlinkImage($user->user_image, 'users');
            }
            $userImage = $this->imageService->storeUserImages($request->username, $request->user_image);
        }

        if ($request->password){
            $password = bcrypt($request->password);
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'receive_email' => $request->receive_email,
            'customer_type' => $request->customer_type,
            'user_image' => $userImage ?? $user->user_image,
            'password' => $password ?? $user->password
        ]);

        
        $userdata = [
            'firstname' => $user->first_name,
            'lastname' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
            'subject' => 'Account Activated',
            'msg' => 'Your account has been successfully activated. You can now login and check product prices. '
        ];

        
        try {
            Mail::to($user->email)->send(new UserRoleAssignActive($userdata));
        } catch (\Exception $e) {
          
        }
        

        return redirect()->route('admin.users.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete_user');

        if ($user->user_image) {
            $this->imageService->unlinkImage($user->user_image, 'users');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function get_users(): JsonResponse
    {
        $users = User::role(['user'])
            ->when(\request()->input('query') != '', function ($query) {
                $query->search(\request()->input('query'));
            })
            ->get(['id', 'first_name', 'last_name', 'email'])->toArray();

        return response()->json($users);
    }
}
