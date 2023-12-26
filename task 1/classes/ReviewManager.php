<?php

namespace App;

use PDOException;

class ReviewManager
{
    private $db;
    private $validator;

    public function __construct($db, $validator)
    {
        $this->db = $db;
        $this->validator = $validator;
    }

    public function submitReview($data)
    {
        if ($this->validator->validate($data)) {
            if ($this->saveReviewToDatabase($data)) {
                return ['message' => 'Review submitted successfully'];
            } else {
                return ['error' => 'Failed to save review to the database'];
            }
        } else {
            return ['error' => 'Invalid input data'];
        }
    }

    private function saveReviewToDatabase($data)
    {
        try {
            $stmt = $this->db->getDb()->prepare("INSERT INTO reviews (product_id, user_id, review_text) VALUES (:product_id, :user_id, :review_text)");
            $stmt->bindParam(':product_id', $data['product_id']);
            $stmt->bindParam(':user_id', $data['user_id']);
            $stmt->bindParam(':review_text', $data['review_text']);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
