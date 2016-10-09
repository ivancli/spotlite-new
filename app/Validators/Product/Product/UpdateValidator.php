<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/09/2016
 * Time: 7:29 PM
 */

namespace App\Validators\Product\Product;


use App\Validators\ValidatorAbstract;

class UpdateValidator extends ValidatorAbstract
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
            "product_name" => "required|max:255"
        );
    }

    protected function getMessages()
    {
        return array(
            "product_name.required" => "Product name is required.",
            "product_name.max" => "Product name accepts maximum 255 characters."
        );
    }
}