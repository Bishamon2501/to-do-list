SELECT *
FROM users
WHERE email = :email OR username = :username;