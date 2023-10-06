-- Inserting sample data into the 'country' table
INSERT INTO country (country_code, country_name) VALUES
('US', 'United States'),
('CA', 'Canada'),
('UK', 'United Kingdom');

-- Inserting sample data into the 'state' table
INSERT INTO state (country_id, state_code, state_name) VALUES
(1, 'CA', 'California'),
(1, 'NY', 'New York'),
(2, 'ON', 'Ontario'),
(3, 'ENG', 'England');

-- Inserting sample data into the 'city' table
INSERT INTO city (state_id, city_code, city_name) VALUES
(1, 'LA', 'Los Angeles'),
(1, 'NYC', 'New York City'),
(2, 'TO', 'Toronto'),
(3, 'LON', 'London');

-- Inserting sample data into the 'course' table
INSERT INTO course (course_code, course_name) VALUES
('BCA', 'Bachelor of Computer Applications'),
('MCA', 'Master of Computer Applications'),
('B-Tech', 'Bachelor of Technology'),
('M-Tech', 'Master of Technology');

-- Inserting sample data into the 'student' table
INSERT INTO student (stu_name, stu_father_name, stu_mother_name, stu_gender, stu_email, stu_mobile, stu_address, state_id, city_id, country_id, date_of_birth, stu_age, course_id, stu_tenth_per, stu_twelfth_per) VALUES
('John Doe', 'Michael Doe', 'Emma Doe', 'Male', 'john.doe@example.com', '1234567890', '123 Main St, Los Angeles', 1, 1, 1, '1995-05-15', 28, 1, 90, 85),
('Alice Johnson', 'David Johnson', 'Lisa Johnson', 'Female', 'alice.j@example.com', '9876543210', '456 Elm St, New York City', 1, 2, 1, '1998-08-20', 24, 2, 92, 88),
('Michael Smith', 'James Smith', 'Emily Smith', 'Male', 'michael.smith@example.com', '9998887777', '789 Oak St, Toronto', 2, 3, 2, '1997-02-10', 26, 3, 88, 82),
('Emma White', 'Daniel White', 'Sophia White', 'Female', 'emma.white@example.com', '1112223333', '101 Pine St, London', 3, 4, 3, '1996-11-05', 27, 4, 95, 90);

-- Inserting sample data into the 'course_fee' table
INSERT INTO course_fee (year,course_id, duration, fee) VALUES
('first',1, 3, 5000),
('second',1, 3, 4000),
('third',1, 3, 5000),
('first', 2, 2, 6000),
('second', 2, 2, 6000),
('third', 2, 2, 6000),
('first',3, 4, 5500),
('second',3, 4, 5500),
('first',4, 2, 6500),
('second',4, 2, 6500);

