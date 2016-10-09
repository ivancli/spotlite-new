<?php
namespace App\Validators\UM\Permission;

use App\Validators\ValidatorAbstract;

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/09/2016
 * Time: 8:01 PM
 */
class StoreValidator extends ValidatorAbstract
{

    /**
     * Get pre-set validation rules
     *
     * @param null $id
     * @return array
     */
    protected function getRules($id = null)
    {
        return array(
            'name' => 'required|max:255|min:1|unique:permissions,name'
        );
    }

    protected function getMessages()
    {
        return array(
            "name.required" => "Permission name is required.",
            "name.max" => "Permission name accepts maximum 255 characters.",
            "name.min" => "Permission name is required.",
            "name.unique" => "Permission name already exists.",
        );
    }
}