# ---------
# Create, populate, and manipulate your own table of data.
# ---------

CREATE TABLE students (
user_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
first_name VARCHAR(20) NOT NULL,
last_name VARCHAR(40) NOT NULL,
email VARCHAR(60) NOT NULL,
secondary_email VARCHAR(60) NOT NULL,
program VARCHAR(20) NOT NULL,
phone char(10) NOT NULL,
registration_date DATETIME NOT NULL,
PRIMARY KEY (user_id)
);

INSERT INTO students (first_name, last_name, email, secondary_email, program, phone, registration_date) VALUES
('Murphy', 'Morris', 'dialworld@msn.com', 'jgwang@live.com', 'Web Designer', '8011234561', NOW()),
('Alicia', 'Rasim', 'ournews@att.net', 'sarahs@mac.com', 'Web Programmer', '7561238475', NOW()),
('Edvin', 'Otho', 'kassiesa@msn.com', 'cantu@me.com', 'Graphic Technician', '4849283941', NOW()),
('Honora', 'Febe', 'jespley@gmail.com', 'ralamosm@mac.com', 'Web Programmer', '1228885767', NOW());