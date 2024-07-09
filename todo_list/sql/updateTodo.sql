UPDATE todo
SET todo = :todo, comment = :comment, updated_at = NOW()
WHERE id = :id AND user_id = :user_id;