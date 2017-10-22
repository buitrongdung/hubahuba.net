<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    //xác định tên bảng của model được sử dụng
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'username', 'password', 'level', 'name', 'gender', 'email', 'phone', 'address', 'employer_id'];
    //xác định các cột có thể được insert/update bằng cách gán đồng thời
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public $timestamps = false;
    protected $hidden = ['password', 'remember_token'];
    //được sử dụng để xác định cột không được truyền vào JSON hoặc các mảng dữ liệu để tránh lộ mật khẩu.
    public function isSuperAdmin() {
        return $this->id == 1 && $this->level == 1;
    }
    public function isAdminNhanSu() {
        return $this->level == 3;
    }
    public function isAdminKhachHang() {
        return $this->level == 2;
    }
    public function isNhanVien() {
        return $this->level == 4;
    }
    public function isUser() {
        return $this->level == 0;
    }
}
