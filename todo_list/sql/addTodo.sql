INSERT INTO todo (user_id, todo, comment, created_at)
VALUES (:user_id, :todo, :comment, NOW());