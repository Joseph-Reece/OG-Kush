<?php

namespace App\Models;

use App\Commons\APICode;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'avatar', 'phone_number', 'facebook', 'instagram', 'status', 'is_admin','referrer_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'is_admin' => 'integer',
        'status' => 'integer'
    ];

    protected $appends = ['referral_link'];

    const STATUS_DEACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const USER_DEFAULT = 0;
    const USER_ADMIN = 1;

    public function isAdmin()
    {
        return $this->is_admin === self::USER_ADMIN;
    }

    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function validateLogin($data)
    {
        $validateData = $data->all();
        $resp = (object)[
            'code' => APICode::WRONG_PARAMS,
            'message' => ''
        ];
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        $message_errors = [];
        $validator = Validator::make($validateData, $rules, $message_errors);
        if ($validator->fails()) {
            $resp->message = $validator->messages();
        } else {
            $resp->code = APICode::SUCCESS;
        }
        return $resp;
    }

    public function validateRegister($data)
    {
        $validateData = $data->all();
        $resp = (object)[
            'code' => APICode::WRONG_PARAMS,
            'message' => ''
        ];
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $message_errors = [];
        $validator = Validator::make($validateData, $rules, $message_errors);
        if ($validator->fails()) {
            $resp->message = $validator->messages();
        } else {
            $resp->code = APICode::SUCCESS;
        }
        return $resp;
    }

    public function create($data)
    {
        $this->name = $data->name;
        $this->email = $data->email;
        $this->password = Hash::make($data->password);
        $this->save();
        return $this;
    }

    public static function getUserDetail($user_id)
    {
        $user_detail = self::find($user_id);

        return $user_detail;
    }

    public function updatePassword($data)
    {
        $user = self::find($data->user_id);
        $user->password = bcrypt($data->password_new);
        $user->save();
        return $user;
    }

    /**
     * Roll API Key
     */
    public function generateApiToken()
    {
        do {
            $this->api_token = Str::random(60);
        } while ($this->where('api_token', $this->api_token)->exists());
        $this->save();
    }

    public function generateApiToken1()
    {
        $this->api_token = Str::random(60);
        $this->save();

        return $this->api_token;
    }
    public function getReferralLinkAttribute()
{
    return $this->referral_link = route('register', ['ref' => $this->email]);
}

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }

}
