<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function uploadFolder(): string{
        return "public/Image_users";
    }

    public function imageUrl(string $column = 'profile_photo_path'): ?string
   {
       //$imageName = Arr::get($this->data, $column);
       $imageName = $this->$column;
       return $imageName === null
           ? "https://ui-avatars.com/api/?name={$column}&color=7F9CF5&background=EBF4FF"
           : Storage::url("{$this->uploadFolder()}/{$imageName}"); 
   }

   public function deleteImage(string $column = 'profile_photo_path'): void
   {
       $imageName = $this->$column;

       if ($imageName !== null) {
           Storage::delete("{$this->uploadFolder()}/{$imageName}");
       }
   }

  

    public function menus() {
        //dd($this->belongsTo(MenuUser::class));
        return $this->hasMany(MenuUser::class,'id_user');
    }

    public function address(){
        return $this->hasOne(Addresses::class, 'id_user');
    }

    public function roles(){
        return $this->belongsToMany(Role::class,'user_role','user_id','role_id');
    }
}
