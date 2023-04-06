<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    private $table = 'user'; // định nghĩa table
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        $id = $this->id;
        $task = array_search('form-task', request()->input());
        $condAvartar = '';
        $condUserName = '';
        $condEmail = '';
        $condPwd = '';
        $condLevel = '';
        $condStatus = '';
        $condFullName = '';
        switch ($task) {
            case 'add':
                $condAvartar = 'bail|required|mimes:jpeg,jpg,bmp,png,gif|max:1000';
                $condUserName = "required|between:5,100|unique:$this->table,username";
                $condEmail = "bail|required|between:5,100|unique:$this->table,email";
                $condFullName = 'bail|required|min:5';
                $condPwd = 'bail|required|min:3|confirmed';
                $condStatus = 'bail|in:active,inactive';
                $condLevel = 'bail|in:admin,member';
                break;

            case 'edit-info':
                $condAvartar = 'bail|mimes:jpeg,jpg,bmp,png,gif|max:1000';
                $condUserName = "required|between:5,100|unique:$this->table,username,$id";
                $condEmail = "bail|required|between:5,100|unique:$this->table,email,$id";
                $condFullName = 'bail|required|min:5';
                $condStatus = 'bail|in:active,inactive';
                break;

            case 'changePwd':
                $condPwd = 'bail|required|min:3|confirmed';
                break;

            case 'changeLevel':
                $condLevel = 'bail|in:admin,member';
                break;
        }
        return [
            'username' => $condUserName,
            'fullname' => $condFullName,
            'email' => $condEmail,
            'status' => $condStatus,
            'level' => $condLevel,
            'password' => $condPwd,
            'avartar' => $condAvartar,
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => '<strong>- UserName :</strong> không được rỗng',
            'username.min' => '<strong>- UserName :</strong> chiều dài ít nhất phải :min ký tự',
            'username.unique' => '<strong>- UserName :</strong> Đã tồn tại ',
            'email.required' => '<strong>- Email :</strong> không được rỗng',
            'email.unique' => '<strong>- Email :</strong> Đã tồn tại ',
            'fullname.required' => '<strong>- FullName :</strong> không được rỗng',
            'password.required' => '<strong>- PassWord :</strong> không được rỗng',
            'password.confirmed' => '<strong>- PassWord :</strong> mật khẩu và xác nhận mật khẩu không khớp',
            'status.in' => '<strong>- Status :</strong> phải là giá trị khác giá trị mặc định',
            'level.in' => '<strong>- Level :</strong> phải là giá trị khác giá trị mặc định',
            'avartar.required' => '<strong>- Avartar :</strong> không được rỗng',
            'avartar.mimes' => '<strong>- Avartar :</strong> Phải là ảnh',
            // 'thumb.image' => '<strong>- Thumb :</strong> Phải là ảnh',
        ];
    }

    public function response(array $errors)
    {
        echo '<pre>';
        print_r($errors);
        echo '</pre>';
        die();
    }

}
