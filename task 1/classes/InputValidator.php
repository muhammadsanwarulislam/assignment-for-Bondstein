<?php

namespace App;

class InputValidator
{
    public function validate($data)
    {
        if (empty($data['product_id']) || empty($data['user_id']) || empty($data['review_text'])) {
            return false;
        }

        if (!is_numeric($data['product_id']) || !is_numeric($data['user_id'])) {
            return false;
        }

        return true;
    }
}
