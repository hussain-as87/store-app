<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Profile;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{
    protected $path_avatar = 'pubic/users/avatar';

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $profile = auth()->user()->profile;
        return view('admin.profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $profile = auth()->user()->profile;
        return view('admin.profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $profile = Profile::findOrFail(auth()->id());
            $this->getValidationFactory();

            $profile->first_name = $request->first_name;
            $profile->last_name = $request->last_name;
            $profile->address = $request->address;
            $profile->country = $request->country;
            $profile->phone = $request->phone;
            if ($request->hasFile('avatar_profile')) {
                $images = $request->file('avatar_profile');
                $name = $images->getClientOriginalName();
                $path = $images->storeAs('user/avatar', $name, 'public');
                $profile->avatar = $path;
            }
            $profile->update();
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            return throw $exception;
        }
        toast('Save', 'success');
        return redirect()->route('profile-user.show', $profile);
    }

    protected function getValidationFactory()
    {
        \request()->validate([
            'first_name' => 'sometimes|max:50',
            'last_name' => 'sometimes|max:50',
            'address' => 'sometimes',
            'phone' => 'sometimes|max:12',
            'avatar' => 'image',
            'country' => 'sometimes',
        ]);
    }

    public function change_password()
    {
        return view('admin.profile.changePassword');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reset_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $user = User::find(auth()->id());
        $user->update(['password' => Hash::make($request->new_password)]);

        toast('Save', 'success');
        return redirect()->route('profile.show', auth()->id());
    }
}
