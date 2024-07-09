SELECT id, username, password 
FROM users
WHERE email = :email OR username = :username;